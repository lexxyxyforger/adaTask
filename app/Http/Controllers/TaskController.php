<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Project $project)
    {
        abort_if($project->user_id !== Auth::id(), 404);

        return redirect()->route('projects.show', ['project' => $project->id, 'tab' => 'tasks']);
    }

    public function create(Request $request)
    {
        $projects = Project::where('user_id', Auth::id())->latest()->get();
        $selectedProjectId = $request->integer('project_id') ?: $projects->first()?->id;

        return view('tasks.create', [
            'projects' => $projects,
            'selectedProjectId' => $selectedProjectId,
        ]);
    }

    public function show(Task $task)
    {
        $task->load('project');
        abort_if(!$task->project || $task->project->user_id !== Auth::id(), 404);

        return view('tasks.show', compact('task'));
    }

    public function storeFromForm(Request $request)
    {
        $validated = $request->validate([
            'project_id' => ['required', 'exists:projects,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'assignee_name' => ['nullable', 'string', 'max:255'],
            'priority' => ['required', 'in:low,medium,high'],
            'deadline' => ['nullable', 'date'],
            'status' => ['nullable', 'in:todo,in_progress,done'],
        ]);

        $project = Project::where('id', $validated['project_id'])
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $task = Task::create([
            'project_id' => $project->id,
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'assignee_name' => $validated['assignee_name'] ?? null,
            'priority' => $validated['priority'],
            'deadline' => $validated['deadline'] ?? null,
            'status' => $validated['status'] ?? 'todo',
        ]);

        return redirect()->route('tasks.show', $task->id);
    }

    public function store(Request $request, Project $project)
    {
        abort_if($project->user_id !== Auth::id(), 404);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'assignee_name' => ['nullable', 'string', 'max:255'],
            'priority' => ['nullable', 'in:low,medium,high'],
            'deadline' => ['nullable', 'date'],
        ]);

        $project->tasks()->create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'assignee_name' => $validated['assignee_name'] ?? null,
            'status' => 'todo',
            'priority' => $validated['priority'] ?? 'medium',
            'deadline' => $validated['deadline'] ?? null,
        ]);

        return redirect()->route('projects.show', ['project' => $project->id, 'tab' => 'tasks']);
    }

    public function update(Request $request, Task $task)
    {
        $task->load('project');
        abort_if(!$task->project || $task->project->user_id !== Auth::id(), 404);

        $validated = $request->validate([
            'status' => ['nullable', 'in:todo,in_progress,done'],
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'assignee_name' => ['nullable', 'string', 'max:255'],
            'priority' => ['nullable', 'in:low,medium,high'],
            'deadline' => ['nullable', 'date'],
        ]);

        $newStatus = $validated['status'] ?? ($task->status === 'done' ? 'todo' : 'done');

        $task->update([
            'title' => $validated['title'] ?? $task->title,
            'description' => array_key_exists('description', $validated) ? $validated['description'] : $task->description,
            'assignee_name' => array_key_exists('assignee_name', $validated) ? $validated['assignee_name'] : $task->assignee_name,
            'priority' => $validated['priority'] ?? $task->priority,
            'deadline' => array_key_exists('deadline', $validated) ? $validated['deadline'] : $task->deadline,
            'status' => $newStatus,
        ]);

        return back()->with('success', 'Task berhasil diperbarui.');
    }

    public function updateChecklist(Request $request, Task $task)
    {
        $task->load('project');
        abort_if(!$task->project || $task->project->user_id !== Auth::id(), 404);

        $validated = $request->validate([
            'checklist' => ['nullable', 'string', 'max:5000'],
        ]);

        // Preserve done status for existing items, default false for new ones
        $existingItems = collect($task->checklist ?? []);
        $existingDoneMap = $existingItems->mapWithKeys(function ($item) {
            $text = is_array($item) ? ($item['text'] ?? '') : $item;
            $done = is_array($item) ? ($item['done'] ?? false) : false;
            return [$text => $done];
        });

        $items = collect(preg_split('/\r\n|\r|\n/', $validated['checklist'] ?? ''))
            ->map(fn ($item) => trim($item))
            ->filter()
            ->values()
            ->map(fn ($text) => [
                'text' => $text,
                'done' => $existingDoneMap->get($text, false),
            ])
            ->all();

        $task->update([
            'checklist' => $items,
        ]);

        return back()->with('success', 'Checklist berhasil disimpan.');
    }

    public function toggleChecklistItem(Request $request, Task $task, int $index)
    {
        $task->load('project');

        if (!$task->project || $task->project->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Default items (sama dengan yang ditampilkan di view saat checklist kosong)
        $defaultItems = [
            'Install package yang dibutuhkan',
            'Setup konfigurasi lingkungan',
            'Implementasi fitur utama',
            'Uji coba dan finalisasi',
        ];

        // Ambil dari DB, kalau null pakai default
        $rawItems = $task->checklist ?? $defaultItems;

        // Normalize ke format [{text, done}], re-index supaya key 0,1,2,...
        $items = collect($rawItems)
            ->map(function ($item) {
                return is_array($item) ? $item : ['text' => $item, 'done' => false];
            })
            ->values()
            ->toArray();

        if (!array_key_exists($index, $items)) {
            return response()->json(['error' => 'Item not found at index ' . $index], 404);
        }

        $items[$index]['done'] = !($items[$index]['done'] ?? false);

        $task->update(['checklist' => array_values($items)]);

        $doneCount  = collect($items)->where('done', true)->count();
        $totalCount = count($items);

        return response()->json([
            'done'        => $items[$index]['done'],
            'done_count'  => $doneCount,
            'total_count' => $totalCount,
        ]);
    }

    public function destroy(Task $task)
    {
        $task->load('project');
        abort_if(!$task->project || $task->project->user_id !== Auth::id(), 404);

        $projectId = $task->project_id;
        $task->delete();

        return redirect()->route('projects.show', ['project' => $projectId, 'tab' => 'tasks'])
            ->with('success', 'Task berhasil dihapus.');
    }

}