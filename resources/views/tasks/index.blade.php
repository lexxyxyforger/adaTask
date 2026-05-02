<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    @include('partials.settings-boot')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $project->name }} – Tugas - WongTask</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
    :root {
        --bg: #f4f0e8;
        --card: #ffffff;
        --line: #e8e0d0;
        --brand: #7a4b23;
        --brand-light: #a0622e;
        --ink: #2a1f16;
        --muted: #9a8c7f;
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
        padding: 0 0 96px;
    }

    /* ── HEADER ── */
    .header {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 50px 20px 6px;
    }

    .back-btn {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        background: var(--card);
        border: 1px solid var(--line);
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        color: var(--ink);
        flex-shrink: 0;
        transition: border-color .15s, color .15s;
    }

    .back-btn:hover {
        border-color: var(--brand);
        color: var(--brand);
    }

    .back-btn svg {
        width: 17px;
        height: 17px;
    }

    .header-text {
        flex: 1;
        min-width: 0;
    }

    .header-text h1 {
        font-size: 1.3rem;
        font-weight: 800;
        letter-spacing: -.2px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .header-text p {
        font-size: .74rem;
        color: var(--muted);
        font-weight: 500;
        margin-top: 2px;
    }

    .add-btn {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: var(--brand);
        color: #fff;
        border: none;
        font-size: 1.3rem;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        flex-shrink: 0;
        box-shadow: 0 3px 12px rgba(122, 75, 35, .3);
        transition: background .15s;
        line-height: 1;
    }

    .add-btn:hover {
        background: var(--brand-light);
    }

    /* ── ADD FORM ── */
    .add-form {
        padding: 12px 16px;
    }

    .add-form form {
        display: flex;
        gap: 8px;
    }

    .add-input {
        flex: 1;
        border: 1px solid var(--line);
        border-radius: 11px;
        padding: 10px 13px;
        font-size: .84rem;
        font-family: inherit;
        background: var(--card);
        color: var(--ink);
        outline: none;
        transition: border-color .15s;
    }

    .add-input:focus {
        border-color: var(--brand);
    }

    .add-input::placeholder {
        color: #c0b4a8;
    }

    .add-submit {
        border: none;
        border-radius: 11px;
        background: var(--brand);
        color: #fff;
        padding: 10px 16px;
        font-size: .84rem;
        font-weight: 700;
        font-family: inherit;
        cursor: pointer;
        transition: background .15s;
        white-space: nowrap;
    }

    .add-submit:hover {
        background: var(--brand-light);
    }

    /* ── TASK LIST ── */
    .task-list {
        padding: 0 16px;
        display: grid;
        gap: 8px;
    }

    .task-item {
        display: flex;
        align-items: center;
        gap: 11px;
        background: var(--card);
        border: 1px solid var(--line);
        border-radius: 14px;
        padding: 12px 13px;
        transition: box-shadow .15s;
    }

    .task-item:hover {
        box-shadow: 0 4px 16px rgba(122, 75, 35, .09);
    }

    /* Toggle form */
    .toggle-form {
        flex-shrink: 0;
    }

    .toggle-btn {
        width: 24px;
        height: 24px;
        border-radius: 7px;
        border: 1.5px solid var(--line);
        background: #faf5ef;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background .15s, border-color .15s;
        padding: 0;
    }

    .toggle-btn.is-done {
        background: var(--done-color);
        border-color: var(--done-color);
    }

    .toggle-btn svg {
        width: 13px;
        height: 13px;
        color: #fff;
    }

    /* Task body */
    .task-body {
        flex: 1;
        min-width: 0;
    }

    .task-name {
        font-size: .88rem;
        font-weight: 700;
        margin-bottom: 1px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        text-decoration: none;
        color: var(--ink);
        display: block;
    }

    .task-name.strikethrough {
        text-decoration: line-through;
        color: #b0a49a;
    }

    .task-date {
        font-size: .71rem;
        color: var(--muted);
        font-weight: 500;
    }

    /* Done badge */
    .done-badge {
        background: var(--done-bg);
        color: var(--done-color);
        font-size: .65rem;
        font-weight: 700;
        border-radius: 999px;
        padding: 3px 8px;
        flex-shrink: 0;
    }

    /* Empty */
    .empty {
        text-align: center;
        padding: 40px 16px;
        color: var(--muted);
    }

    .empty svg {
        width: 44px;
        height: 44px;
        color: #d4c9bb;
        margin-bottom: 10px;
    }

    .empty p {
        font-size: .84rem;
        font-weight: 600;
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

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(8px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .task-item {
        animation: fadeUp .2s ease both;
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

        {{-- ── HEADER ── --}}
        <div class="header">
            <a href="/projects" class="back-btn">
                <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M19 12H5M12 5l-7 7 7 7" />
                </svg>
            </a>
            <div class="header-text">
                <h1>{{ $project->name }}</h1>
                <p>{{ $tasks->count() }} tugas</p>
            </div>
            <a href="{{ route('tasks.create', ['project_id' => $project->id]) }}" class="add-btn">+</a>
        </div>

        {{-- ── QUICK ADD FORM ── --}}
        <div class="add-form">
            <form method="POST" action="{{ route('tasks.store', $project->id) }}">
                @csrf
                <input class="add-input" type="text" name="title" placeholder="Tambah task baru..." required>
                <button class="add-submit" type="submit">Tambah</button>
            </form>
        </div>

        {{-- ── TASK LIST ── --}}
        <div class="task-list">
            @forelse($tasks as $task)
            <div class="task-item">

                {{-- Toggle done --}}
                <form class="toggle-form" method="POST" action="{{ route('tasks.update', $task->id) }}">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="{{ $task->status === 'done' ? 'todo' : 'done' }}">
                    <button type="submit" class="toggle-btn {{ $task->status === 'done' ? 'is-done' : '' }}">
                        @if($task->status === 'done')
                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path d="M20 6L9 17l-5-5" />
                        </svg>
                        @endif
                    </button>
                </form>

                {{-- Task info --}}
                <div class="task-body">
                    <a href="{{ route('tasks.show', $task->id) }}"
                        class="task-name {{ $task->status === 'done' ? 'strikethrough' : '' }}">
                        {{ $task->title }}
                    </a>
                    @if($task->deadline)
                    <span class="task-date">
                        {{ $task->deadline->format('d M Y') }}
                    </span>
                    @endif
                </div>

                {{-- Done badge --}}
                @if($task->status === 'done')
                <span class="done-badge">Done</span>
                @endif

            </div>
            @empty
            <div class="empty">
                <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path d="M9 11l3 3L22 4" />
                    <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11" />
                </svg>
                <p>Belum ada task. Tambahkan task pertama!</p>
            </div>
            @endforelse
        </div>

        {{-- ── BOTTOM NAV ── --}}
        <nav class="bottom-nav">

            <a href="{{ route('home') }}" class="nav-item">
                <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                    <polyline points="9 22 9 12 15 12 15 22" />
                </svg>
                Beranda
            </a>

            <a href="{{ route('projects.index') }}" class="nav-item">
                <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <rect x="2" y="3" width="20" height="14" rx="2" />
                    <line x1="8" y1="21" x2="16" y2="21" />
                    <line x1="12" y1="17" x2="12" y2="21" />
                </svg>
                Proyek
            </a>

            <a href="{{ route('projects.show', ['project' => $project->id, 'tab' => 'tasks']) }}"
                class="nav-item active">
                <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <path d="M9 11l3 3L22 4" />
                    <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11" />
                </svg>
                Tugas
                <span class="nav-dot"></span>
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