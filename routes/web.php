<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    $emptyChart = collect([
        ['label' => 'Min', 'value' => 0],
        ['label' => 'Sen', 'value' => 0],
        ['label' => 'Sel', 'value' => 0],
        ['label' => 'Rab', 'value' => 0],
        ['label' => 'Kam', 'value' => 0],
        ['label' => 'Jum', 'value' => 0],
        ['label' => 'Sab', 'value' => 0],
    ]);

    // If user is authenticated, send to their home/dashboard.
    if (Auth::check()) {
        return redirect()->route('home');
    }

    // Public welcome page for guests with safe default data.
    return view('welcome', [
        'user' => null,
        'totalTasks' => 0,
        'doneTasks' => 0,
        'pendingTasks' => 0,
        'projects' => collect(),
        'todayTasks' => collect(),
        'urgentTasks' => collect(),
        'activityChart' => $emptyChart,
    ]);
});

Route::get('/notifications/urgent', function () {
    if (! Auth::check()) {
        return response()->json([
            'authenticated' => false,
            'tasks' => [],
            'message' => 'Masuk dulu untuk melihat notifikasi tugas urgent.',
        ]);
    }

    $projectIds = Project::query()->where('user_id', Auth::id())->pluck('id');
    $urgentTasks = Task::with('project')
        ->whereIn('project_id', $projectIds)
        ->where('status', '!=', 'done')
        ->whereNotNull('deadline')
        ->whereDate('deadline', '<=', now()->addDays(2)->toDateString())
        ->orderBy('deadline')
        ->limit(8)
        ->get()
        ->map(fn ($task) => [
            'id' => $task->id,
            'title' => $task->title,
            'status' => $task->status,
            'deadline' => optional($task->deadline)->format('Y-m-d'),
            'deadline_label' => $task->deadline ? $task->deadline->translatedFormat('d M Y') : '-',
            'project_name' => $task->project?->name,
            'project_id' => $task->project?->id,
            'url' => route('tasks.show', $task->id),
        ])
        ->values();

    return response()->json([
        'authenticated' => true,
        'tasks' => $urgentTasks,
        'message' => $urgentTasks->isEmpty()
            ? 'Tidak ada tugas urgent saat ini.'
            : 'Ada tugas urgent yang perlu segera ditangani.',
    ]);
})->name('notifications.urgent');

Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/login', function () {
        $credentials = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::attempt($credentials, request()->boolean('remember'))) {
            return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
        }

        request()->session()->regenerate();

        return redirect()->route('home');
    })->name('login.attempt');

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    Route::post('/register', function () {
        $validated = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);
        request()->session()->regenerate();

        return redirect()->route('home');
    })->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');
    })->name('logout');

    Route::get('/home', function () {
        $user = Auth::user();
        $projectIds = Project::query()->where('user_id', $user->id)->pluck('id');
        $chartStart = now()->subDays(6)->startOfDay();
        $chartLabels = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
        $activityChart = collect(range(0, 6))->map(function ($offset) use ($chartStart, $projectIds, $chartLabels) {
            $day = $chartStart->copy()->addDays($offset);

            return [
                'label' => $chartLabels[$offset],
                'date' => $day->toDateString(),
                'value' => Task::whereIn('project_id', $projectIds)
                    ->whereDate('created_at', $day)
                    ->count(),
            ];
        });

        $projects = Project::withCount([
            'tasks',
            'tasks as done_tasks_count' => fn ($query) => $query->where('status', 'done'),
        ])->where('user_id', $user->id)->latest()->take(3)->get();

        return view('welcome', [
            'user' => $user,
            'totalTasks' => Task::whereIn('project_id', $projectIds)->count(),
            'doneTasks' => Task::whereIn('project_id', $projectIds)->where('status', 'done')->count(),
            'pendingTasks' => Task::whereIn('project_id', $projectIds)->where('status', 'todo')->count(),
            'projects' => $projects,
            'todayTasks' => Task::with('project')->whereIn('project_id', $projectIds)->latest()->take(5)->get(),
            'urgentTasks' => Task::with('project')
                ->whereIn('project_id', $projectIds)
                ->where('status', '!=', 'done')
                ->whereNotNull('deadline')
                ->whereDate('deadline', '<=', now()->addDays(2)->toDateString())
                ->orderBy('deadline')
                ->limit(8)
                ->get(),
            'activityChart' => $activityChart,
        ]);
    })->name('home');

    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');

    Route::get('/projects/{project}/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::post('/projects/{project}/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::patch('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::patch('/tasks/{task}/checklist', [TaskController::class, 'updateChecklist'])->name('tasks.checklist.update');
    Route::patch('/tasks/{task}/checklist/{index}/toggle', [TaskController::class, 'toggleChecklistItem'])->name('tasks.checklist.toggle');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [TaskController::class, 'storeFromForm'])->name('tasks.store.form');
    Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');

    Route::get('/calendar', function () {
        $selectedDate = request('date', now()->toDateString());
        $projectIds = Project::query()->where('user_id', Auth::id())->pluck('id');

        return view('calendar.index', [
            'selectedDate' => $selectedDate,
            'tasks' => Task::with('project')
                ->whereIn('project_id', $projectIds)
                ->whereDate('deadline', $selectedDate)
                ->orderByRaw("FIELD(status, 'in_progress', 'todo', 'done')")
                ->get(),
        ]);
    })->name('calendar');

    Route::get('/profile', function () {
        $user = Auth::user();
        $projectIds = Project::query()->where('user_id', $user->id)->pluck('id');
        $totalTasks = Task::whereIn('project_id', $projectIds)->count();
        $doneTasks  = Task::whereIn('project_id', $projectIds)->where('status', 'done')->count();
        $productivity = $totalTasks > 0 ? (int) round(($doneTasks / $totalTasks) * 100) : 0;

        return view('profile.index', [
            'user'          => $user,
            'totalTasks'    => $totalTasks,
            'totalProjects' => Project::where('user_id', $user->id)->count(),
            'productivity'  => $productivity,
        ]);
    })->name('profile');

    Route::get('/archive', function () {
        $user       = Auth::user();
        $projects   = Project::where('user_id', $user->id)->latest()->get();
        $projectIds = $projects->pluck('id');

        $doneTasks = Task::with('project')
            ->whereIn('project_id', $projectIds)
            ->where('status', 'done')
            ->latest('updated_at')
            ->paginate(50);

        $grouped = $doneTasks->getCollection()
            ->groupBy(fn ($t) => $t->project?->name ?? 'Tanpa Proyek');

        return view('archive.index', [
            'doneTasks'     => $doneTasks,
            'grouped'       => $grouped,
            'projects'      => $projects,
            'totalProjects' => $projects->count(),
        ]);
    })->name('archive');

    Route::post('/profile/avatar', function () {
        $user = Auth::user();

        // URL avatar
        if (request()->filled('avatar_url')) {
            $user->update(['avatar_url' => request('avatar_url')]);
            return response()->json(['ok' => true, 'avatar_url' => $user->avatar_url]);
        }

        // File upload
        if (request()->hasFile('avatar_file') && request()->file('avatar_file')->isValid()) {
            $path = request()->file('avatar_file')->store('avatars', 'public');
            $url  = '/storage/' . $path;
            $user->update(['avatar_url' => $url]);
            return response()->json(['ok' => true, 'avatar_url' => $url]);
        }

        return response()->json(['ok' => false, 'message' => 'Tidak ada data avatar'], 422);
    })->name('profile.avatar');

    Route::post('/profile', function () {
        $user = Auth::user();

        $validated = request()->validate([
            'name'       => ['required', 'string', 'max:255'],
            'email'      => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'bio'        => ['nullable', 'string', 'max:500'],
            'avatar_url' => ['nullable', 'string', 'max:2048'],
            'avatar_file'=> ['nullable', 'image', 'max:4096'],
        ]);

        $avatarUrl = $user->avatar_url;

        if (request()->hasFile('avatar_file') && request()->file('avatar_file')->isValid()) {
            $path = request()->file('avatar_file')->store('avatars', 'public');
            $avatarUrl = '/storage/' . $path;
        } elseif (!empty($validated['avatar_url'])) {
            $avatarUrl = $validated['avatar_url'];
        }

        $user->update([
            'name'       => $validated['name'],
            'email'      => $validated['email'],
            'bio'        => $validated['bio'] ?? null,
            'avatar_url' => $avatarUrl,
        ]);

        return redirect()->route('profile')->with('success', 'Profil berhasil disimpan.');
    })->name('profile.update');
});