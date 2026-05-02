<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    @include('partials.settings-boot')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender - WongTask</title>
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
        --ink: #2e241a;
        --muted: #9a8f85;
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
        align-items: flex-start;
        min-height: 100vh;
    }

    .phone {
        width: 100%;
        max-width: 430px;
        min-height: 100vh;
        background: var(--bg);
        position: relative;
        overflow: hidden;
    }

    /* ── HEADER ── */
    .header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 52px 20px 14px;
        background: var(--bg);
    }

    .header-title {
        font-size: 1.35rem;
        font-weight: 800;
        color: var(--ink);
        letter-spacing: -.3px;
    }

    .header-icon-btn {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: var(--card);
        border: 1px solid var(--line);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: var(--brand);
    }

    /* ── CALENDAR CARD ── */
    .cal-card {
        background: var(--card);
        border: 1px solid var(--line);
        border-radius: 18px;
        margin: 0 16px 14px;
        padding: 16px;
        box-shadow: 0 2px 12px rgba(122, 75, 35, .07);
    }

    /* Month nav */
    .month-nav {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 14px;
    }

    .month-nav-btn {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        border: 1px solid var(--line);
        background: transparent;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--muted);
        font-size: .85rem;
        transition: background .15s, color .15s;
    }

    .month-nav-btn:hover {
        background: var(--brand);
        color: #fff;
        border-color: var(--brand);
    }

    .month-label {
        font-size: .95rem;
        font-weight: 700;
        color: var(--ink);
    }

    /* Day-of-week header */
    .dow-row {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        margin-bottom: 6px;
    }

    .dow-cell {
        text-align: center;
        font-size: .67rem;
        font-weight: 700;
        color: var(--muted);
        padding: 2px 0 6px;
    }

    /* Date grid */
    .dates-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 2px;
    }

    .date-cell {
        text-align: center;
        padding: 5px 2px;
        font-size: .8rem;
        font-weight: 600;
        color: var(--ink);
        border-radius: 50%;
        cursor: pointer;
        position: relative;
        transition: background .15s, color .15s;
        aspect-ratio: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        margin: 0 auto;
    }

    .date-cell:hover {
        background: var(--bg);
    }

    .date-cell.other-month {
        color: #ccc5bb;
    }

    .date-cell.has-task::after {
        content: '';
        position: absolute;
        bottom: 3px;
        left: 50%;
        transform: translateX(-50%);
        width: 4px;
        height: 4px;
        border-radius: 50%;
        background: var(--brand);
    }

    .date-cell.today {
        background: var(--brand);
        color: #fff !important;
        font-weight: 800;
    }

    .date-cell.today::after {
        display: none;
    }

    .date-cell.selected:not(.today) {
        background: var(--bg);
        border: 2px solid var(--brand);
        color: var(--brand);
    }

    /* ── TASKS SECTION ── */
    .tasks-section {
        padding: 0 16px 100px;
    }

    .tasks-header {
        font-size: .92rem;
        font-weight: 700;
        color: var(--ink);
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .tasks-header svg {
        width: 16px;
        height: 16px;
        color: var(--brand);
    }

    /* Task item */
    .task-item {
        display: flex;
        align-items: center;
        gap: 10px;
        background: var(--card);
        border: 1px solid var(--line);
        border-radius: 14px;
        padding: 11px 12px;
        margin-bottom: 8px;
        text-decoration: none;
        color: inherit;
        transition: box-shadow .15s, transform .1s;
        cursor: pointer;
    }

    .task-item:hover {
        box-shadow: 0 4px 16px rgba(122, 75, 35, .1);
        transform: translateY(-1px);
    }

    /* Project icon */
    .task-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: .7rem;
        color: #fff;
        letter-spacing: .5px;
    }

    .task-icon.sc {
        background: linear-gradient(135deg, #4b6cb7, #182848);
    }

    .task-icon.wt {
        background: linear-gradient(135deg, #7a4b23, #c07c3a);
    }

    .task-icon.bl {
        background: linear-gradient(135deg, #e07b39, #b85a1e);
    }

    .task-body {
        flex: 1;
        min-width: 0;
    }

    .task-name {
        font-size: .85rem;
        font-weight: 700;
        color: var(--ink);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-bottom: 2px;
    }

    .task-project {
        font-size: .72rem;
        color: var(--muted);
        font-weight: 500;
    }

    .task-badge {
        flex-shrink: 0;
        border-radius: 999px;
        padding: 4px 9px;
        font-size: .63rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 4px;
        white-space: nowrap;
    }

    .task-badge.todo {
        background: var(--todo-bg);
        color: var(--todo-color);
    }

    .task-badge.progress {
        background: var(--progress-bg);
        color: var(--progress-color);
    }

    .task-badge.done {
        background: var(--done-bg);
        color: var(--done-color);
    }

    .task-badge svg {
        width: 8px;
        height: 8px;
    }

    /* Dot indicator */
    .status-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .status-dot.todo {
        background: var(--todo-color);
    }

    .status-dot.progress {
        background: var(--progress-color);
    }

    .status-dot.done {
        background: var(--done-color);
    }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 32px 16px;
        color: var(--muted);
    }

    .empty-state svg {
        width: 44px;
        height: 44px;
        color: #d8cfbf;
        margin-bottom: 10px;
    }

    .empty-state p {
        font-size: .83rem;
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
        background: #ffffff;
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
        position: relative;
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

    /* Scroll area */
    .scroll-area {
        overflow-y: auto;
        height: 100%;
        padding-bottom: 80px;
    }

    /* Fade-in animation */
    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(12px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .task-item {
        animation: fadeUp .25s ease both;
    }

    .task-item:nth-child(1) {
        animation-delay: .05s;
    }

    .task-item:nth-child(2) {
        animation-delay: .10s;
    }

    .task-item:nth-child(3) {
        animation-delay: .15s;
    }

    .task-item:nth-child(4) {
        animation-delay: .20s;
    }

    .task-item:nth-child(5) {
        animation-delay: .25s;
    }
    </style>
</head>

<body>
    <div class="phone">

        {{-- ── HEADER ── --}}
        <div class="header">
            <h1 class="header-title">Kalender</h1>
            <div class="header-icon-btn">
                {{-- Calendar icon --}}
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <rect x="3" y="4" width="18" height="18" rx="2" />
                    <line x1="16" y1="2" x2="16" y2="6" />
                    <line x1="8" y1="2" x2="8" y2="6" />
                    <line x1="3" y1="10" x2="21" y2="10" />
                </svg>
            </div>
        </div>

        {{-- ── CALENDAR CARD ── --}}
        <div class="cal-card">

            {{-- Month navigation --}}
            <div class="month-nav">
                <a href="{{ route('calendar', ['date' => \Carbon\Carbon::parse($selectedDate)->subMonth()->format('Y-m-d')]) }}"
                    class="month-nav-btn">&#8249;</a>

                <span class="month-label">
                    {{ \Carbon\Carbon::parse($selectedDate)->translatedFormat('F Y') }}
                </span>

                <a href="{{ route('calendar', ['date' => \Carbon\Carbon::parse($selectedDate)->addMonth()->format('Y-m-d')]) }}"
                    class="month-nav-btn">&#8250;</a>
            </div>

            {{-- Day-of-week header --}}
            <div class="dow-row">
                @foreach(['Min','Sen','Sel','Rab','Kam','Jum','Sab'] as $d)
                <div class="dow-cell">{{ $d }}</div>
                @endforeach
            </div>

            {{-- Dates grid --}}
            @php
            $selected = \Carbon\Carbon::parse($selectedDate);
            $today = \Carbon\Carbon::today();
            $firstOfMonth = $selected->copy()->startOfMonth();
            $startDay = $firstOfMonth->copy()->startOfWeek(\Carbon\Carbon::SUNDAY);
            $endDay = $selected->copy()->endOfMonth()->endOfWeek(\Carbon\Carbon::SATURDAY);

            // Build set of dates that have tasks (expects $taskDates = array of 'Y-m-d' strings)
            // If $taskDates is not passed, fall back to empty array
            $taskDateSet = isset($taskDates) ? array_flip($taskDates) : [];
            @endphp

            <div class="dates-grid">
                @for($d = $startDay->copy(); $d->lte($endDay); $d->addDay())
                @php
                $dateStr = $d->format('Y-m-d');
                $isToday = $d->isSameDay($today);
                $isSelected = $d->isSameDay($selected);
                $isOther = !$d->isSameMonth($firstOfMonth);
                $hasTask = isset($taskDateSet[$dateStr]);

                $cls = 'date-cell';
                if ($isOther) $cls .= ' other-month';
                if ($isToday) $cls .= ' today';
                if ($isSelected && !$isToday) $cls .= ' selected';
                if ($hasTask && !$isToday) $cls .= ' has-task';
                @endphp

                <a href="{{ route('calendar', ['date' => $dateStr]) }}" class="{{ $cls }}"
                    style="text-decoration:none;">
                    {{ $d->day }}
                </a>
                @endfor
            </div>

        </div>{{-- /cal-card --}}

        {{-- ── TASKS FOR SELECTED DATE ── --}}
        <div class="tasks-section">

            <div class="tasks-header">
                <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <path d="M9 11l3 3L22 4" />
                    <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11" />
                </svg>
                Tugas pada {{ \Carbon\Carbon::parse($selectedDate)->translatedFormat('d F Y') }}
            </div>

            @forelse($tasks as $task)
            @php
            $iconClass = 'sc'; // default
            $initial = strtoupper(substr($task->project?->name ?? 'T', 0, 2));
            // pick icon bg based on first letter
            $firstChar = strtolower(substr($task->project?->name ?? 'T', 0, 1));
            if (in_array($firstChar, ['a','b','c','d','e'])) $iconClass = 'wt';
            elseif (in_array($firstChar, ['f','g','h','i','j','k'])) $iconClass = 'bl';
            else $iconClass = 'sc';
            @endphp

            <a href="{{ route('tasks.show', $task->id) }}" class="task-item">

                {{-- Project icon --}}
                <div class="task-icon {{ $iconClass }}">{{ $initial }}</div>

                {{-- Task info --}}
                <div class="task-body">
                    <div class="task-name">{{ $task->title }}</div>
                    <div class="task-project">{{ $task->project?->name ?? 'Tanpa proyek' }}</div>
                </div>

                {{-- Status badge --}}
                @if($task->status === 'done')
                <span class="task-badge done">
                    <svg viewBox="0 0 10 10" fill="currentColor">
                        <path d="M1.5 5l2.5 2.5L8.5 2" />
                    </svg>
                    Done
                </span>
                @elseif($task->status === 'in_progress')
                <span class="task-badge progress">
                    <svg viewBox="0 0 10 10" fill="currentColor">
                        <circle cx="5" cy="5" r="4" />
                    </svg>
                    In Progress
                </span>
                @else
                <span class="task-badge todo">
                    <svg viewBox="0 0 10 10" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="5" cy="5" r="3.5" />
                    </svg>
                    To Do
                </span>
                @endif

            </a>
            @empty
            <div class="empty-state">
                <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <rect x="3" y="4" width="18" height="18" rx="2" />
                    <line x1="16" y1="2" x2="16" y2="6" />
                    <line x1="8" y1="2" x2="8" y2="6" />
                    <line x1="3" y1="10" x2="21" y2="10" />
                </svg>
                <p>Tidak ada tugas di tanggal ini.</p>
            </div>
            @endempty

        </div>

        @php
        $calendarTasksProjectId = $tasks->first()?->project?->id;
        @endphp

        {{-- ── BOTTOM NAVIGATION ── --}}
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

            <a href="{{ $calendarTasksProjectId ? route('tasks.index', ['project' => $calendarTasksProjectId]) : route('projects.index') }}" class="nav-item">
                <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <path d="M9 11l3 3L22 4" />
                    <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11" />
                </svg>
                Tugas
            </a>

            <a href="{{ route('calendar') }}" class="nav-item active">
                <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <rect x="3" y="4" width="18" height="18" rx="2" />
                    <line x1="16" y1="2" x2="16" y2="6" />
                    <line x1="8" y1="2" x2="8" y2="6" />
                    <line x1="3" y1="10" x2="21" y2="10" />
                </svg>
                Kalender
                <span class="nav-dot"></span>
            </a>

            <a href="{{ route('profile') }}" class="nav-item">
                <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <circle cx="12" cy="8" r="4" />
                    <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
                </svg>
                Profil
            </a>

        </nav>

        {{-- Auto-reload script --}}
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

    </div>{{-- /phone --}}
</body>

</html>