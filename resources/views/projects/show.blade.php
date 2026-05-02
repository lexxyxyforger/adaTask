<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    @include('partials.settings-boot')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $project->name }} - WongTask</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
    :root {
        --bg: #f4f0e8;
        --card: #ffffff;
        --ink: #2e2319;
        --muted: #9a8c7f;
        --line: #e8e0d0;
        --brand: #7a4b23;
        --brand-light: #a0622e;
        --soft: #f4e8da;
        --todo-bg: #fff3e0;
        --todo-color: #b8692a;
        --progress-bg: #e3f1ff;
        --progress-color: #2f70a9;
        --done-bg: #e6f7ea;
        --done-color: #2a8f43;
    }

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        background: #d8d0c0;
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: var(--ink);
        display: flex;
        justify-content: center;
        min-height: 100vh;
    }

    .phone {
        width: 100%;
        max-width: 430px;
        min-height: 100vh;
        background: var(--bg);
        padding-bottom: 94px;
    }

    /* ── HERO HEADER ── */
    .hero {
        padding: 48px 20px 20px;
        background: linear-gradient(140deg, #6b3d1a, #9a5c2c);
        color: #fff;
        border-bottom-left-radius: 26px;
        border-bottom-right-radius: 26px;
        position: relative;
    }

    .hero-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 14px;
    }

    .back-btn {
        display: flex;
        align-items: center;
        gap: 6px;
        color: rgba(255, 255, 255, .85);
        text-decoration: none;
        font-size: .82rem;
        font-weight: 600;
    }

    .back-btn svg {
        width: 18px;
        height: 18px;
    }

    .hero-add {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .2);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        font-size: 1.3rem;
        line-height: 1;
        transition: background .15s;
    }

    .hero-add:hover {
        background: rgba(255, 255, 255, .35);
    }

    .hero-title {
        font-size: 1.5rem;
        font-weight: 800;
        margin-bottom: 4px;
        letter-spacing: -.3px;
    }

    .hero-meta {
        font-size: .82rem;
        opacity: .85;
        margin-bottom: 14px;
    }

    .hero-track {
        height: 8px;
        border-radius: 99px;
        background: rgba(255, 255, 255, .25);
        overflow: hidden;
    }

    .hero-fill {
        height: 100%;

        width: {
                {
                $completion
            }
        }

        %;
        background: #f5c57a;
        border-radius: 99px;
        transition: width .5s ease;
    }

    .hero-pct {
        position: absolute;
        right: 20px;
        bottom: 20px;
        font-size: .78rem;
        font-weight: 700;
        opacity: .9;
    }

    /* ── TABS ── */
    .tabs-wrap {
        padding: 14px 16px 10px;
    }

    .tabs {
        background: var(--card);
        border-radius: 13px;
        border: 1px solid var(--line);
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        overflow: hidden;
    }

    .tabs a {
        text-align: center;
        padding: 11px 8px;
        text-decoration: none;
        color: #7b6f63;
        font-size: .83rem;
        font-weight: 600;
        transition: background .15s, color .15s;
    }

    .tabs a:not(:last-child) {
        border-right: 1px solid var(--line);
    }

    .tabs a.active {
        background: var(--soft);
        color: var(--brand);
        font-weight: 800;
    }

    .tabs a:not(.active):hover {
        background: #faf5ef;
    }

    /* ── SECTION CONTAINER ── */
    .section {
        padding: 0 16px;
    }

    /* ── TASK LIST (Tugas tab) ── */
    .task-link {
        text-decoration: none;
        color: inherit;
        display: block;
    }

    .task-item {
        background: var(--card);
        border: 1px solid var(--line);
        border-radius: 14px;
        padding: 12px 13px;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 11px;
        transition: box-shadow .15s, transform .1s;
    }

    .task-item:hover {
        box-shadow: 0 4px 16px rgba(122, 75, 35, .1);
        transform: translateY(-1px);
    }

    .task-body {
        flex: 1;
        min-width: 0;
    }

    .task-title {
        font-size: .9rem;
        font-weight: 700;
        margin-bottom: 3px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .task-meta {
        font-size: .73rem;
        color: var(--muted);
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .task-meta svg {
        width: 12px;
        height: 12px;
    }

    .badge {
        flex-shrink: 0;
        border-radius: 99px;
        padding: 5px 10px;
        font-size: .65rem;
        font-weight: 700;
        white-space: nowrap;
    }

    .badge.todo {
        background: var(--todo-bg);
        color: var(--todo-color);
    }

    .badge.progress {
        background: var(--progress-bg);
        color: var(--progress-color);
    }

    .badge.done {
        background: var(--done-bg);
        color: var(--done-color);
    }

    /* ── BOARD tab ── */
    .board {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 8px;
        padding: 0 16px;
    }

    .col {
        background: var(--card);
        border: 1px solid var(--line);
        border-radius: 13px;
        padding: 10px 8px;
        min-height: 200px;
    }

    .col-header {
        font-size: .75rem;
        font-weight: 800;
        color: var(--ink);
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .col-count {
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: var(--bg);
        font-size: .65rem;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--brand);
    }

    .board-card {
        border: 1px solid var(--line);
        border-radius: 9px;
        padding: 7px 8px;
        margin-bottom: 6px;
        background: #fffdf9;
        font-size: .74rem;
        font-weight: 600;
        color: var(--ink);
        text-decoration: none;
        display: block;
        transition: box-shadow .12s;
        line-height: 1.35;
    }

    .board-card:hover {
        box-shadow: 0 2px 8px rgba(122, 75, 35, .1);
    }

    .board-card-date {
        font-size: .66rem;
        color: var(--muted);
        margin-top: 3px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 3px;
    }

    .board-card-date svg {
        width: 10px;
        height: 10px;
    }

    .board-empty {
        font-size: .72rem;
        color: #c0b4a8;
        text-align: center;
        padding: 10px 4px;
        font-weight: 500;
    }

    /* ── DETAIL tab ── */
    .detail-box {
        background: var(--card);
        border: 1px solid var(--line);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(122, 75, 35, .06);
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 13px 15px;
        font-size: .84rem;
        border-bottom: 1px dashed #f0e8dd;
    }

    .detail-row:last-child {
        border-bottom: none;
    }

    .detail-label {
        color: var(--muted);
        font-weight: 600;
    }

    .detail-value {
        font-weight: 700;
        text-align: right;
        max-width: 55%;
    }

    .detail-bar-wrap {
        padding: 13px 15px;
        border-bottom: 1px dashed #f0e8dd;
    }

    .detail-bar-label {
        display: flex;
        justify-content: space-between;
        font-size: .78rem;
        font-weight: 700;
        margin-bottom: 7px;
    }

    .detail-bar-label span:first-child {
        color: var(--muted);
    }

    .detail-bar-label span:last-child {
        color: var(--brand);
    }

    .detail-track {
        height: 8px;
        border-radius: 99px;
        background: #efe8de;
        overflow: hidden;
    }

    .detail-fill {
        height: 100%;

        width: {
                {
                $completion
            }
        }

        %;
        border-radius: 99px;
        background: linear-gradient(90deg, #d08e38, #8e5124);
    }

    /* ── FAB ── */
    .fab {
        position: fixed;
        bottom: 82px;
        right: calc(50% - 215px + 16px);
        width: 54px;
        height: 54px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        font-size: 1.8rem;
        color: #fff;
        background: var(--brand);
        box-shadow: 0 8px 22px rgba(88, 51, 24, .38);
        transition: background .15s, transform .1s;
        z-index: 90;
        line-height: 1;
    }

    .fab:hover {
        background: var(--brand-light);
    }

    .fab:active {
        transform: scale(.93);
    }

    /* ── BOTTOM NAV ── */
    .bottom-nav {
        position: fixed;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100%;
        max-width: 430px;
        background: #fff;
        border-top: 1px solid var(--line);
        display: flex;
        justify-content: space-around;
        align-items: center;
        height: 68px;
        z-index: 99;
        padding: 0 4px;
        box-shadow: 0 -4px 20px rgba(0, 0, 0, .06);
    }

    .nav-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 3px;
        color: #b0a498;
        text-decoration: none;
        flex: 1;
        padding: 8px 0 4px;
        font-size: .62rem;
        font-weight: 700;
        letter-spacing: .2px;
        transition: color .15s;
    }

    .nav-item:hover {
        color: var(--brand);
    }

    .nav-item.active {
        color: var(--brand);
    }

    .nav-item svg {
        width: 22px;
        height: 22px;
    }

    .nav-dot {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: var(--brand);
    }

    /* Animations */
    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .task-item {
        animation: fadeUp .22s ease both;
    }

    .task-item:nth-child(1) {
        animation-delay: .04s;
    }

    .task-item:nth-child(2) {
        animation-delay: .08s;
    }

    .task-item:nth-child(3) {
        animation-delay: .12s;
    }

    .task-item:nth-child(4) {
        animation-delay: .16s;
    }

    .task-item:nth-child(n+5) {
        animation-delay: .20s;
    }
    </style>
</head>

<body>
    <div class="phone">

        {{-- ── HERO ── --}}
        <header class="hero">
            <div class="hero-top">
                <a href="{{ route('projects.index') }}" class="back-btn">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path d="M19 12H5M12 5l-7 7 7 7" />
                    </svg>
                    Proyek
                </a>
                <a href="{{ route('tasks.create', ['project_id' => $project->id]) }}" class="hero-add">+</a>
            </div>
            <h1 class="hero-title">{{ $project->name }}</h1>
            <p class="hero-meta">{{ $doneTasks->count() }} / {{ $tasks->count() }} tugas selesai</p>
            <div class="hero-track">
                <div class="hero-fill"></div>
            </div>
            <span class="hero-pct">{{ $completion }}%</span>
        </header>

        {{-- ── TABS ── --}}
        <div class="tabs-wrap">
            <nav class="tabs">
                <a class="{{ $tab === 'tasks'  ? 'active' : '' }}"
                    href="{{ route('projects.show', ['project' => $project->id, 'tab' => 'tasks']) }}">Tugas</a>
                <a class="{{ $tab === 'board'  ? 'active' : '' }}"
                    href="{{ route('projects.show', ['project' => $project->id, 'tab' => 'board']) }}">Board</a>
                <a class="{{ $tab === 'detail' ? 'active' : '' }}"
                    href="{{ route('projects.show', ['project' => $project->id, 'tab' => 'detail']) }}">Detail</a>
            </nav>
        </div>

        {{-- ── TAB: TUGAS ── --}}
        @if($tab === 'tasks')
        <div class="section">
            @forelse($tasks as $task)
            <a class="task-link" href="{{ route('tasks.show', $task->id) }}">
                <article class="task-item">
                    <div class="task-body">
                        <p class="task-title">{{ $task->title }}</p>
                        <p class="task-meta">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <rect x="3" y="4" width="18" height="18" rx="2" />
                                <line x1="16" y1="2" x2="16" y2="6" />
                                <line x1="8" y1="2" x2="8" y2="6" />
                                <line x1="3" y1="10" x2="21" y2="10" />
                            </svg>
                            {{ $task->deadline ? $task->deadline->format('d M Y') : 'Tanpa deadline' }}
                        </p>
                    </div>
                    @if($task->status === 'done')
                    <span class="badge done">Done</span>
                    @elseif($task->status === 'in_progress')
                    <span class="badge progress">In Progress</span>
                    @else
                    <span class="badge todo">To Do</span>
                    @endif
                </article>
            </a>
            @empty
            <article class="task-item"
                style="justify-content:center;color:var(--muted);font-size:.84rem;font-weight:600;">
                Belum ada tugas di proyek ini.
            </article>
            @endforelse
        </div>

        {{-- ── TAB: BOARD ── --}}
        @elseif($tab === 'board')
        <div class="board">

            {{-- To Do --}}
            <div class="col">
                <div class="col-header">
                    To Do
                    <span class="col-count">{{ $todoTasks->count() }}</span>
                </div>
                @forelse($todoTasks as $task)
                <a class="board-card" href="{{ route('tasks.show', $task->id) }}">
                    {{ $task->title }}
                    @if($task->deadline)
                    <div class="board-card-date">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="18" rx="2" />
                            <line x1="3" y1="10" x2="21" y2="10" />
                        </svg>
                        {{ $task->deadline->format('d M') }}
                    </div>
                    @endif
                </a>
                @empty
                <div class="board-empty">Belum ada</div>
                @endforelse
            </div>

            {{-- In Progress --}}
            <div class="col">
                <div class="col-header">
                    In Progress
                    <span class="col-count">{{ $progressTasks->count() }}</span>
                </div>
                @forelse($progressTasks as $task)
                <a class="board-card" href="{{ route('tasks.show', $task->id) }}">
                    {{ $task->title }}
                    @if($task->deadline)
                    <div class="board-card-date">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="18" rx="2" />
                            <line x1="3" y1="10" x2="21" y2="10" />
                        </svg>
                        {{ $task->deadline->format('d M') }}
                    </div>
                    @endif
                </a>
                @empty
                <div class="board-empty">Belum ada</div>
                @endforelse
            </div>

            {{-- Done --}}
            <div class="col">
                <div class="col-header">
                    Done
                    <span class="col-count">{{ $doneTasks->count() }}</span>
                </div>
                @forelse($doneTasks as $task)
                <a class="board-card" href="{{ route('tasks.show', $task->id) }}">
                    {{ $task->title }}
                    @if($task->deadline)
                    <div class="board-card-date">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="18" rx="2" />
                            <line x1="3" y1="10" x2="21" y2="10" />
                        </svg>
                        {{ $task->deadline->format('d M') }}
                    </div>
                    @endif
                </a>
                @empty
                <div class="board-empty">Belum ada</div>
                @endforelse
            </div>

        </div>

        {{-- ── TAB: DETAIL ── --}}
        @elseif($tab === 'detail')
        <div class="section">
            <div class="detail-box">

                <div class="detail-bar-wrap">
                    <div class="detail-bar-label">
                        <span>Progress</span>
                        <span>{{ $completion }}%</span>
                    </div>
                    <div class="detail-track">
                        <div class="detail-fill"></div>
                    </div>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Total Tugas</span>
                    <span class="detail-value">{{ $tasks->count() }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Selesai</span>
                    <span class="detail-value" style="color:var(--done-color)">{{ $doneTasks->count() }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">In Progress</span>
                    <span class="detail-value" style="color:var(--progress-color)">{{ $progressTasks->count() }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">To Do</span>
                    <span class="detail-value" style="color:var(--todo-color)">{{ $todoTasks->count() }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Deskripsi</span>
                    <span class="detail-value">{{ $project->description ?: '-' }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Dibuat</span>
                    <span class="detail-value">{{ $project->created_at->format('d M Y') }}</span>
                </div>

            </div>
        </div>
        @endif

        {{-- ── FAB ── --}}
        <a class="fab" href="{{ route('tasks.create', ['project_id' => $project->id]) }}">+</a>

        {{-- ── BOTTOM NAV ── --}}
        <nav class="bottom-nav">

            <a href="{{ route('home') }}" class="nav-item">
                <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                    <polyline points="9 22 9 12 15 12 15 22" />
                </svg>
                Beranda
            </a>

            <a href="{{ route('projects.index') }}" class="nav-item active">
                <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <rect x="2" y="3" width="20" height="14" rx="2" />
                    <line x1="8" y1="21" x2="16" y2="21" />
                    <line x1="12" y1="17" x2="12" y2="21" />
                </svg>
                Proyek
                <span class="nav-dot"></span>
            </a>

            <a href="{{ route('projects.show', ['project' => $project->id, 'tab' => 'tasks']) }}" class="nav-item">
                <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <path d="M9 11l3 3L22 4" />
                    <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11" />
                </svg>
                Tugas
            </a>

            <a href="{{ route('calendar') }}" class="nav-item">
                <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <rect x="3" y="4" width="18" height="18" rx="2" />
                    <line x1="16" y1="2" x2="16" y2="6" />
                    <line x1="8" y1="2" x2="8" y2="6" />
                    <line x1="3" y1="10" x2="21" y2="10" />
                </svg>
                Kalender
            </a>

            <a href="{{ route('profile') }}" class="nav-item">
                <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <circle cx="12" cy="8" r="4" />
                    <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
                </svg>
                Profil
            </a>

        </nav>

        <script>
        (() => {
            const ms = 15000;
            setInterval(() => {
                const focused = !!document.querySelector('input:focus,textarea:focus,select:focus');
                if (document.visibilityState === 'visible' && !focused) {
                    window.location.reload();
                }
            }, ms);
        })();
        </script>

    </div>
</body>

</html>