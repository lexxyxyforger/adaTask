<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Project $project)
    {
        return $project->tasks()->latest()->get();
    }

    public function store(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'priority' => ['nullable', 'in:low,medium,high'],
            'deadline' => ['nullable', 'date'],
            'status' => ['nullable', 'in:todo,in_progress,done'],
        ]);

        $task = $project->tasks()->create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'priority' => $validated['priority'] ?? 'medium',
            'deadline' => $validated['deadline'] ?? null,
            'status' => $validated['status'] ?? 'todo',
        ]);

        return response()->json($task, 201);
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => ['sometimes', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'priority' => ['sometimes', 'in:low,medium,high'],
            'deadline' => ['nullable', 'date'],
            'status' => ['sometimes', 'in:todo,in_progress,done'],
        ]);

        $task->update($validated);

        return response()->json($task->fresh());
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json(['message' => 'deleted']);
    }
}
