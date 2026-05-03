<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'semua'); // semua|aktif|selesai|arsip
        $search = $request->query('q', '');

        $query = Project::withCount([
            'tasks',
            'tasks as done_tasks_count' => fn ($q) => $q->where('status', 'done'),
        ])->where('user_id', Auth::id());

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        $allProjects = $query->latest()->get();

        // Filter client-side (di PHP) berdasarkan completion
        $projects = match ($filter) {
            'aktif'   => $allProjects->filter(fn ($p) => $p->tasks_count > 0 && ($p->done_tasks_count < $p->tasks_count)),
            'selesai' => $allProjects->filter(fn ($p) => $p->tasks_count > 0 && ($p->done_tasks_count >= $p->tasks_count)),
            'arsip'   => $allProjects->filter(fn ($p) => $p->tasks_count === 0),
            default   => $allProjects,
        };

        return view('projects.index', [
            'projects' => $projects,
            'filter'   => $filter,
            'search'   => $search,
            'counts'   => [
                'semua'   => $allProjects->count(),
                'aktif'   => $allProjects->filter(fn ($p) => $p->tasks_count > 0 && $p->done_tasks_count < $p->tasks_count)->count(),
                'selesai' => $allProjects->filter(fn ($p) => $p->tasks_count > 0 && $p->done_tasks_count >= $p->tasks_count)->count(),
                'arsip'   => $allProjects->filter(fn ($p) => $p->tasks_count === 0)->count(),
            ],
        ]);
    }

    public function show(Request $request, Project $project)
    {
        abort_if($project->user_id !== Auth::id(), 404);

        $tab = $request->query('tab', 'tasks');

        $tasks = $project->tasks()->latest()->get();

        $todoTasks = $tasks->where('status', 'todo');
        $progressTasks = $tasks->where('status', 'in_progress');
        $doneTasks = $tasks->where('status', 'done');

        $total = max($tasks->count(), 1);
        $completion = (int) round(($doneTasks->count() / $total) * 100);

        return view('projects.show', [
            'project' => $project,
            'tasks' => $tasks,
            'tab' => $tab,
            'todoTasks' => $todoTasks,
            'progressTasks' => $progressTasks,
            'doneTasks' => $doneTasks,
            'completion' => $completion,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        Project::create([
            'user_id' => Auth::id(),
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->route('projects.index');
    }
}