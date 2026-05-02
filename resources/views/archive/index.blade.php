<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    @include('partials.settings-boot')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arsip – WongTask</title>
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
        --done-border: #c4e8cc;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

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
        padding: 50px 20px 14px;
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

    .back-btn:hover { border-color: var(--brand); color: var(--brand); }
    .back-btn svg { width: 17px; height: 17px; }

    .header-text { flex: 1; min-width: 0; }

    .header-text h1 {
        font-size: 1.3rem;
        font-weight: 800;
        letter-spacing: -.2px;
    }

    .header-text p {
        font-size: .74rem;
        color: var(--muted);
        font-weight: 500;
        margin-top: 2px;
    }

    /* ── STATS STRIP ── */
    .stats-strip {
        display: flex;
        gap: 8px;
        padding: 0 16px 14px;
    }

    .stat-pill {
        display: flex;
        align-items: center;
        gap: 6px;
        background: var(--done-bg);
        border: 1px solid var(--done-border);
        border-radius: 99px;
        padding: 5px 11px;
        font-size: .74rem;
        font-weight: 700;
        color: var(--done-color);
    }

    .stat-pill svg { width: 13px; height: 13px; }

    .stat-pill.neutral {
        background: var(--card);
        border-color: var(--line);
        color: var(--muted);
    }

    /* ── FILTER / SEARCH ── */
    .filter-bar {
        padding: 0 16px 12px;
        display: flex;
        gap: 8px;
    }

    .search-wrap {
        flex: 1;
        position: relative;
    }

    .search-wrap svg {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        width: 15px;
        height: 15px;
        color: var(--muted);
        pointer-events: none;
    }

    .search-input {
        width: 100%;
        border: 1px solid var(--line);
        border-radius: 11px;
        padding: 9px 12px 9px 32px;
        font-size: .82rem;
        font-family: inherit;
        background: var(--card);
        color: var(--ink);
        outline: none;
        transition: border-color .15s;
    }

    .search-input:focus { border-color: var(--brand); }
    .search-input::placeholder { color: #c0b4a8; }

    .filter-select {
        border: 1px solid var(--line);
        border-radius: 11px;
        padding: 9px 10px;
        font-size: .78rem;
        font-family: inherit;
        background: var(--card);
        color: var(--ink);
        outline: none;
        cursor: pointer;
        transition: border-color .15s;
        max-width: 120px;
    }

    .filter-select:focus { border-color: var(--brand); }

    /* ── GROUP HEADER ── */
    .group-label {
        font-size: .7rem;
        font-weight: 800;
        color: var(--muted);
        letter-spacing: .5px;
        text-transform: uppercase;
        padding: 10px 16px 5px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .group-label::after {
        content: '';
        flex: 1;
        height: 1px;
        background: var(--line);
    }

    /* ── TASK LIST ── */
    .task-list {
        padding: 0 16px;
        display: grid;
        gap: 7px;
        margin-bottom: 6px;
    }

    .task-item {
        display: flex;
        align-items: center;
        gap: 11px;
        background: var(--card);
        border: 1px solid var(--line);
        border-radius: 14px;
        padding: 11px 13px;
        transition: box-shadow .15s;
        animation: fadeUp .2s ease both;
    }

    .task-item:hover { box-shadow: 0 4px 16px rgba(122,75,35,.09); }

    /* Checked icon */
    .done-icon {
        width: 24px;
        height: 24px;
        border-radius: 7px;
        background: var(--done-color);
        border: 1.5px solid var(--done-color);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .done-icon svg { width: 13px; height: 13px; color: #fff; }

    /* Task body */
    .task-body { flex: 1; min-width: 0; }

    .task-name {
        font-size: .86rem;
        font-weight: 700;
        text-decoration: line-through;
        color: #b0a49a;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: block;
        margin-bottom: 2px;
        text-decoration-color: #cfc5bb;
    }

    .task-name:hover { color: var(--brand); text-decoration-color: var(--brand); }

    .task-meta {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .task-date {
        font-size: .69rem;
        color: var(--muted);
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 3px;
    }

    .task-date svg { width: 10px; height: 10px; }

    .priority-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .priority-dot.low    { background: #7ab87a; }
    .priority-dot.medium { background: #f0a030; }
    .priority-dot.high   { background: #e05050; }

    /* Restore button */
    .restore-form { flex-shrink: 0; }

    .restore-btn {
        border: 1px solid var(--line);
        border-radius: 9px;
        background: none;
        color: var(--muted);
        padding: 5px 9px;
        font-size: .7rem;
        font-weight: 700;
        font-family: inherit;
        cursor: pointer;
        transition: border-color .15s, color .15s, background .15s;
        display: flex;
        align-items: center;
        gap: 4px;
        white-space: nowrap;
    }

    .restore-btn:hover {
        border-color: var(--brand);
        color: var(--brand);
        background: rgba(122,75,35,.05);
    }

    .restore-btn svg { width: 12px; height: 12px; }

    /* ── EMPTY ── */
    .empty {
        text-align: center;
        padding: 52px 16px;
        color: var(--muted);
    }

    .empty-icon {
        width: 52px;
        height: 52px;
        margin: 0 auto 14px;
        background: var(--card);
        border: 1px solid var(--line);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .empty-icon svg { width: 26px; height: 26px; color: #d0c8bc; }

    .empty h2 {
        font-size: .94rem;
        font-weight: 800;
        margin-bottom: 5px;
        color: var(--ink);
    }

    .empty p {
        font-size: .78rem;
        font-weight: 500;
        line-height: 1.5;
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
        box-shadow: 0 -4px 20px rgba(0,0,0,.06);
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

    .nav-item:hover { color: var(--brand); }
    .nav-item.active { color: var(--brand); }
    .nav-item svg { width: 22px; height: 22px; }

    .nav-dot {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: var(--brand);
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(8px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .task-item:nth-child(1) { animation-delay: .04s; }
    .task-item:nth-child(2) { animation-delay: .08s; }
    .task-item:nth-child(3) { animation-delay: .12s; }
    .task-item:nth-child(4) { animation-delay: .16s; }
    .task-item:nth-child(n+5) { animation-delay: .20s; }
    </style>
</head>

<body>
    <div class="phone">

        {{-- ── HEADER ── --}}
        <div class="header">
            <a href="{{ route('profile') }}" class="back-btn">
                <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M19 12H5M12 5l-7 7 7 7" />
                </svg>
            </a>
            <div class="header-text">
                <h1>Arsip</h1>
                <p>Semua tugas yang telah selesai</p>
            </div>
        </div>

        {{-- ── STATS STRIP ── --}}
        <div class="stats-strip">
            <div class="stat-pill">
                <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M20 6L9 17l-5-5" />
                </svg>
                {{ $doneTasks->total() }} selesai
            </div>
            <div class="stat-pill neutral">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <rect x="2" y="3" width="20" height="14" rx="2"/>
                    <line x1="8" y1="21" x2="16" y2="21"/>
                    <line x1="12" y1="17" x2="12" y2="21"/>
                </svg>
                {{ $totalProjects }} proyek
            </div>
        </div>

        {{-- ── FILTER BAR ── --}}
        <div class="filter-bar">
            <div class="search-wrap">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input type="text" id="search-input" class="search-input" placeholder="Cari tugas selesai...">
            </div>
            <select class="filter-select" id="project-filter">
                <option value="">Semua</option>
                @foreach($projects as $proj)
                <option value="{{ $proj->id }}">{{ Str::limit($proj->name, 14) }}</option>
                @endforeach
            </select>
        </div>

        {{-- ── GROUPED TASK LIST ── --}}
        <div id="task-container">
            @forelse($grouped as $projectName => $tasks)
            <div class="group" data-project-id="{{ $tasks->first()->project_id }}">
                <div class="group-label">{{ $projectName }}</div>
                <div class="task-list">
                    @foreach($tasks as $task)
                    <div class="task-item" data-title="{{ strtolower($task->title) }}">

                        {{-- Done checkmark --}}
                        <div class="done-icon">
                            <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path d="M20 6L9 17l-5-5" />
                            </svg>
                        </div>

                        {{-- Task info --}}
                        <div class="task-body">
                            <a href="{{ route('tasks.show', $task->id) }}" class="task-name">{{ $task->title }}</a>
                            <div class="task-meta">
                                @if($task->deadline)
                                <span class="task-date">
                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <rect x="3" y="4" width="18" height="18" rx="2"/>
                                        <line x1="3" y1="10" x2="21" y2="10"/>
                                    </svg>
                                    {{ $task->deadline->format('d M Y') }}
                                </span>
                                @endif
                                @if($task->priority)
                                <span class="priority-dot {{ $task->priority }}"></span>
                                @endif
                                @if($task->assignee_name)
                                <span class="task-date">{{ $task->assignee_name }}</span>
                                @endif
                            </div>
                        </div>

                        {{-- Restore button --}}
                        <form class="restore-form" method="POST" action="{{ route('tasks.update', $task->id) }}">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="todo">
                            <button type="submit" class="restore-btn" title="Kembalikan ke To Do">
                                <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                    <polyline points="1 4 1 10 7 10"/>
                                    <path d="M3.51 15a9 9 0 102.13-9.36L1 10"/>
                                </svg>
                                Pulihkan
                            </button>
                        </form>

                    </div>
                    @endforeach
                </div>
            </div>
            @empty
            <div class="empty" id="empty-state">
                <div class="empty-icon">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <polyline points="21 8 21 21 3 21 3 8"/>
                        <rect x="1" y="3" width="22" height="5"/>
                        <line x1="10" y1="12" x2="14" y2="12"/>
                    </svg>
                </div>
                <h2>Arsip masih kosong</h2>
                <p>Selesaikan tugas kamu, dan<br>semuanya akan tersimpan di sini.</p>
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

            <a href="{{ route('home') }}" class="nav-item">
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

            <a href="{{ route('profile') }}" class="nav-item active">
                <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <circle cx="12" cy="8" r="4" />
                    <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
                </svg>
                Profil
                <span class="nav-dot"></span>
            </a>

        </nav>

        <script>
        // ── Live search + filter ──
        const searchInput   = document.getElementById('search-input');
        const projectFilter = document.getElementById('project-filter');

        function applyFilters() {
            const q    = searchInput.value.toLowerCase().trim();
            const pid  = projectFilter.value;
            let totalVisible = 0;

            document.querySelectorAll('.group').forEach(group => {
                const groupPid  = group.dataset.projectId;
                const matchProj = !pid || groupPid === pid;
                let groupHas = false;

                group.querySelectorAll('.task-item').forEach(item => {
                    const title    = item.dataset.title || '';
                    const matchQ   = !q || title.includes(q);
                    const visible  = matchProj && matchQ;
                    item.style.display = visible ? '' : 'none';
                    if (visible) { groupHas = true; totalVisible++; }
                });

                group.style.display = groupHas ? '' : 'none';
            });

            // show empty state if nothing visible
            let emptyEl = document.getElementById('empty-search');
            if (totalVisible === 0 && (q || pid)) {
                if (!emptyEl) {
                    emptyEl = document.createElement('div');
                    emptyEl.id = 'empty-search';
                    emptyEl.className = 'empty';
                    emptyEl.innerHTML = `
                        <div class="empty-icon">
                            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                            </svg>
                        </div>
                        <h2>Tidak ditemukan</h2>
                        <p>Coba ubah kata kunci<br>atau filter proyek.</p>`;
                    document.getElementById('task-container').appendChild(emptyEl);
                }
                emptyEl.style.display = '';
            } else if (emptyEl) {
                emptyEl.style.display = 'none';
            }
        }

        searchInput.addEventListener('input', applyFilters);
        projectFilter.addEventListener('change', applyFilters);
        </script>

    </div>
</body>

</html>
