<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Detail Tugas - WongTask</title>
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
        --muted: #9a8e81;
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
        padding: 0 0 100px;
    }

    /* ── TOP BAR ── */
    .top-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
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

    .more-btn {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        background: var(--card);
        border: 1px solid var(--line);
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        color: var(--muted);
        font-size: 1.2rem;
        letter-spacing: 1px;
        line-height: 1;
        transition: border-color .15s, color .15s;
    }

    .more-btn:hover {
        border-color: var(--brand);
        color: var(--brand);
    }

    /* ── TITLE AREA ── */
    .title-area {
        padding: 0 20px 16px;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        border-radius: 999px;
        padding: 5px 11px;
        font-size: .72rem;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .status-badge svg {
        width: 10px;
        height: 10px;
    }

    .status-badge.todo {
        background: var(--todo-bg);
        color: var(--todo-color);
    }

    .status-badge.progress {
        background: var(--progress-bg);
        color: var(--progress-color);
    }

    .status-badge.done {
        background: var(--done-bg);
        color: var(--done-color);
    }

    .task-title {
        font-size: 1.5rem;
        font-weight: 800;
        line-height: 1.25;
        letter-spacing: -.3px;
        margin-bottom: 4px;
    }

    /* ── META CARD ── */
    .card {
        background: var(--card);
        border: 1px solid var(--line);
        border-radius: 16px;
        margin: 0 16px 12px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(122, 75, 35, .06);
    }

    .meta-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 15px;
        border-bottom: 1px solid #f1e8dc;
        font-size: .85rem;
    }

    .meta-row:last-child {
        border-bottom: none;
    }

    .meta-label {
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--muted);
        font-weight: 600;
        font-size: .82rem;
    }

    .meta-label svg {
        width: 15px;
        height: 15px;
        color: #c8b9a8;
    }

    .meta-value {
        font-weight: 700;
        font-size: .84rem;
    }

    .priority-dot {
        display: inline-block;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        margin-right: 5px;
    }

    .priority-dot.low {
        background: #7ab87a;
    }

    .priority-dot.medium {
        background: #f0a030;
    }

    .priority-dot.high {
        background: #e05050;
    }

    /* ── DESCRIPTION ── */
    .desc-card {
        background: var(--card);
        border: 1px solid var(--line);
        border-radius: 16px;
        margin: 0 16px 12px;
        padding: 14px 15px;
        box-shadow: 0 2px 10px rgba(122, 75, 35, .06);
    }

    .card-heading {
        font-size: .8rem;
        font-weight: 800;
        color: var(--muted);
        letter-spacing: .4px;
        text-transform: uppercase;
        margin-bottom: 8px;
    }

    .desc-text {
        font-size: .86rem;
        color: #5c5148;
        line-height: 1.6;
    }

    /* ── CHECKLIST ── */
    .checklist-list {
        list-style: none;
        display: grid;
        gap: 6px;
    }

    .checklist-editor {
        margin-top: 14px;
        padding-top: 14px;
        border-top: 1px dashed var(--line);
    }

    .checklist-editor label {
        display: block;
        font-size: .72rem;
        font-weight: 800;
        color: var(--muted);
        text-transform: uppercase;
        letter-spacing: .4px;
        margin-bottom: 8px;
    }

    .checklist-input {
        width: 100%;
        min-height: 120px;
        resize: vertical;
        border: 1px solid var(--line);
        border-radius: 12px;
        padding: 12px 13px;
        font: inherit;
        font-size: .84rem;
        color: var(--ink);
        background: #fbfaf8;
        outline: none;
    }

    .checklist-input:focus {
        border-color: var(--brand);
        box-shadow: 0 0 0 3px rgba(122, 75, 35, .08);
    }

    .checklist-help {
        margin-top: 7px;
        font-size: .72rem;
        color: var(--muted);
        line-height: 1.5;
    }


    .checklist-item {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: .84rem;
        color: #4f453d;
    }

    .check-box {
        width: 18px;
        height: 18px;
        border-radius: 5px;
        border: 1.5px solid var(--line);
        background: #faf5ef;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background .18s, border-color .18s, transform .12s;
        user-select: none;
    }

    .check-box:hover {
        border-color: var(--brand);
        transform: scale(1.08);
    }

    .check-box:active {
        transform: scale(.92);
    }

    .check-box.checked {
        background: var(--done-color);
        border-color: var(--done-color);
    }

    .check-box svg {
        width: 11px;
        height: 11px;
        color: #fff;
    }

    .checklist-item.is-done .item-text {
        text-decoration: line-through;
        color: #b0a498;
    }

    .checklist-progress {
        margin-bottom: 10px;
    }

    .checklist-progress-bar-wrap {
        background: #ede5da;
        border-radius: 99px;
        height: 5px;
        overflow: hidden;
        margin-top: 5px;
    }

    .checklist-progress-bar {
        height: 100%;
        border-radius: 99px;
        background: var(--done-color);
        transition: width .3s ease;
    }

    .checklist-progress-label {
        font-size: .72rem;
        color: var(--muted);
        font-weight: 700;
    }

    /* ── ACTIONS ── */
    .actions {
        padding: 0 16px;
        display: grid;
        gap: 9px;
    }

    .actions form {
        margin: 0;
    }

    .btn {
        width: 100%;
        border: none;
        border-radius: 13px;
        padding: 13px;
        font-size: .88rem;
        font-weight: 700;
        font-family: inherit;
        cursor: pointer;
        transition: background .15s, transform .1s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none;
    }

    .btn svg {
        width: 17px;
        height: 17px;
    }

    .btn:active {
        transform: scale(.98);
    }

    .btn-primary {
        background: var(--brand);
        color: #fff;
    }

    .btn-primary:hover {
        background: var(--brand-light);
    }

    .btn-alt {
        background: #ede5da;
        color: #53331d;
    }

    .btn-alt:hover {
        background: #e0d4c4;
    }

    .btn-danger {
        background: #fff0f0;
        color: #b83232;
        border: 1px solid #ffd0d0;
    }

    .btn-danger:hover {
        background: #ffe0e0;
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
            transform: translateY(8px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .title-area {
        animation: fadeUp .2s ease .04s both;
    }

    .card {
        animation: fadeUp .2s ease .08s both;
    }

    .desc-card {
        animation: fadeUp .2s ease .12s both;
    }

    .actions {
        animation: fadeUp .2s ease .16s both;
    }
    </style>
</head>

<body>
    <div class="phone">
        @php
        $checklistItems = collect($task->checklist ?? []);
        if ($checklistItems->isEmpty()) {
            $checklistItems = collect([
                'Install package yang dibutuhkan',
                'Setup konfigurasi lingkungan',
                'Implementasi fitur utama',
                'Uji coba dan finalisasi',
            ]);
        }
        @endphp

        {{-- ── TOP BAR ── --}}
        <div class="top-bar">
            <a href="{{ route('projects.show', $task->project_id) }}" class="back-btn">
                <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M19 12H5M12 5l-7 7 7 7" />
                </svg>
            </a>
            <a href="{{ route('tasks.create', ['project_id' => $task->project_id]) }}" class="more-btn">
                ···
            </a>
        </div>

        {{-- ── TITLE AREA ── --}}
        <div class="title-area">
            {{-- Status badge --}}
            @if($task->status === 'done')
            <span class="status-badge done">
                <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M20 6L9 17l-5-5" />
                </svg>
                Done
            </span>
            @elseif($task->status === 'in_progress')
            <span class="status-badge progress">
                <svg viewBox="0 0 10 10" fill="currentColor">
                    <circle cx="5" cy="5" r="4" />
                </svg>
                In Progress
            </span>
            @else
            <span class="status-badge todo">
                <svg viewBox="0 0 10 10" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="5" cy="5" r="3.5" />
                </svg>
                To Do
            </span>
            @endif

            <h1 class="task-title">{{ $task->title }}</h1>
        </div>

        {{-- ── META INFO ── --}}
        <div class="card">

            <div class="meta-row">
                <span class="meta-label">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <rect x="2" y="3" width="20" height="14" rx="2" />
                        <line x1="8" y1="21" x2="16" y2="21" />
                        <line x1="12" y1="17" x2="12" y2="21" />
                    </svg>
                    Proyek
                </span>
                <span class="meta-value">{{ $task->project?->name ?? '-' }}</span>
            </div>

            <div class="meta-row">
                <span class="meta-label">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <rect x="3" y="4" width="18" height="18" rx="2" />
                        <line x1="16" y1="2" x2="16" y2="6" />
                        <line x1="8" y1="2" x2="8" y2="6" />
                        <line x1="3" y1="10" x2="21" y2="10" />
                    </svg>
                    Deadline
                </span>
                <span class="meta-value">
                    {{ $task->deadline ? $task->deadline->format('d M Y') : '-' }}
                </span>
            </div>

            <div class="meta-row">
                <span class="meta-label">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                        <line x1="12" y1="9" x2="12" y2="13" />
                        <line x1="12" y1="17" x2="12.01" y2="17" />
                    </svg>
                    Prioritas
                </span>
                <span class="meta-value">
                    @php $p = $task->priority ?? 'medium'; @endphp
                    <span class="priority-dot {{ $p }}"></span>{{ ucfirst($p) }}
                </span>
            </div>

            <div class="meta-row">
                <span class="meta-label">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="8" r="4" />
                        <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
                    </svg>
                    Assignee
                </span>
                <span class="meta-value">{{ $task->assignee_name ?? 'Wong' }}</span>
            </div>

        </div>

        {{-- ── DESCRIPTION ── --}}
        <div class="desc-card">
            <p class="card-heading">Deskripsi</p>
            <p class="desc-text">{{ $task->description ?: 'Belum ada deskripsi.' }}</p>
        </div>

        {{-- ── CHECKLIST ── --}}
        @php
        $checklistForView = collect($checklistItems)->map(function($item) {
            if (is_array($item)) return $item;
            return ['text' => $item, 'done' => false];
        });
        $doneCount = $checklistForView->where('done', true)->count();
        $totalCount = $checklistForView->count();
        $progressPct = $totalCount > 0 ? round(($doneCount / $totalCount) * 100) : 0;
        @endphp
        <div class="desc-card">
            <p class="card-heading">Checklist</p>

            {{-- Progress bar --}}
            @if($totalCount > 0)
            <div class="checklist-progress">
                <span class="checklist-progress-label" id="cl-progress-label">{{ $doneCount }}/{{ $totalCount }} selesai</span>
                <div class="checklist-progress-bar-wrap">
                    <div class="checklist-progress-bar" id="cl-progress-bar" style="width:{{ $progressPct }}%"></div>
                </div>
            </div>
            @endif

            <ul class="checklist-list" id="checklist-list">
                @foreach($checklistForView as $idx => $item)
                @php $isDone = $item['done'] ?? false; @endphp
                <li class="checklist-item {{ $isDone ? 'is-done' : '' }}" data-index="{{ $idx }}">
                    <div class="check-box {{ $isDone ? 'checked' : '' }}"
                         onclick="toggleCheck(this, {{ $task->id }}, {{ $idx }})"
                         title="{{ $isDone ? 'Klik untuk batalkan' : 'Klik untuk tandai selesai' }}">
                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"
                             style="{{ $isDone ? '' : 'display:none' }}">
                            <path d="M20 6L9 17l-5-5" />
                        </svg>
                    </div>
                    <span class="item-text">{{ $item['text'] }}</span>
                </li>
                @endforeach
            </ul>

            <form class="checklist-editor" method="POST" action="{{ route('tasks.checklist.update', $task->id) }}">
                @csrf
                @method('PATCH')

                <label for="checklist">Edit Checklist</label>
                <textarea id="checklist" name="checklist" class="checklist-input"
                    placeholder="Tulis satu item checklist per baris">{{ old('checklist', $checklistForView->pluck('text')->implode("\n")) }}</textarea>
                <p class="checklist-help">Satu baris = satu item. Hapus baris yang tidak diperlukan, lalu simpan.</p>

                <button class="btn btn-primary" type="submit" style="margin-top:12px;">
                    <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                        <path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z" />
                        <polyline points="17 21 17 13 7 13 7 21" />
                        <polyline points="7 3 7 8 15 8" />
                    </svg>
                    Simpan Checklist
                </button>
            </form>
        </div>

        {{-- ── ACTIONS ── --}}
        <div class="actions">

            {{-- Status toggle --}}
            <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                @csrf
                @method('PATCH')

                @if($task->status === 'todo')
                <input type="hidden" name="status" value="in_progress">
                <button class="btn btn-alt" type="submit">
                    <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12 6 12 12 16 14" />
                    </svg>
                    Pindahkan ke In Progress
                </button>

                @elseif($task->status === 'in_progress')
                <input type="hidden" name="status" value="done">
                <button class="btn btn-alt" type="submit">
                    <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                        <path d="M20 6L9 17l-5-5" />
                    </svg>
                    Tandai Selesai
                </button>

                @else
                <input type="hidden" name="status" value="todo">
                <button class="btn btn-alt" type="submit">
                    <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                        <polyline points="1 4 1 10 7 10" />
                        <path d="M3.51 15a9 9 0 102.13-9.36L1 10" />
                    </svg>
                    Kembalikan ke To Do
                </button>
                @endif
            </form>

            {{-- Edit --}}
            <a class="btn btn-primary" href="{{ route('tasks.create', ['project_id' => $task->project_id]) }}">
                <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" />
                    <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                </svg>
                Edit Tugas
            </a>

            {{-- Delete --}}
            <form method="POST" action="{{ route('tasks.destroy', $task->id) }}">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit" onclick="return confirm('Hapus tugas ini?')">
                    <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                        <polyline points="3 6 5 6 21 6" />
                        <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6" />
                        <path d="M10 11v6M14 11v6" />
                        <path d="M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2" />
                    </svg>
                    Hapus Tugas
                </button>
            </form>

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

            <a href="{{ route('projects.show', ['project' => $task->project_id, 'tab' => 'tasks']) }}"
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
        // ── Checklist toggle ──
        const CSRF = document.querySelector('meta[name="csrf-token"]').content;

        function revertBox(box, svg, li, wasDone) {
            box.classList.toggle('checked', wasDone);
            svg.style.display = wasDone ? '' : 'none';
            li.classList.toggle('is-done', wasDone);
            updateProgress();
        }

        function toggleCheck(box, taskId, index) {
            const li     = box.closest('.checklist-item');
            const svg    = box.querySelector('svg');
            const isDone = box.classList.contains('checked');

            // Optimistic update
            box.classList.toggle('checked', !isDone);
            svg.style.display = isDone ? 'none' : '';
            li.classList.toggle('is-done', !isDone);
            updateProgress();

            fetch(`/tasks/${taskId}/checklist/${index}/toggle`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF,
                    'Accept': 'application/json',
                },
            })
            .then(r => {
                if (!r.ok) {
                    // Server error (4xx/5xx) — revert
                    revertBox(box, svg, li, isDone);
                    return null;
                }
                return r.json();
            })
            .then(data => {
                if (!data) return;
                if (data.error) {
                    revertBox(box, svg, li, isDone);
                    return;
                }
                // Confirm server state on progress label
                const label = document.getElementById('cl-progress-label');
                const bar   = document.getElementById('cl-progress-bar');
                if (label) label.textContent = `${data.done_count}/${data.total_count} selesai`;
                if (bar)   bar.style.width   = `${Math.round((data.done_count / data.total_count) * 100)}%`;
            })
            .catch(() => revertBox(box, svg, li, isDone));
        }

        function updateProgress() {
            const total = document.querySelectorAll('#checklist-list .checklist-item').length;
            const done  = document.querySelectorAll('#checklist-list .check-box.checked').length;
            const label = document.getElementById('cl-progress-label');
            const bar   = document.getElementById('cl-progress-bar');
            if (label) label.textContent = `${done}/${total} selesai`;
            if (bar && total > 0) bar.style.width = `${Math.round((done / total) * 100)}%`;
        }
        </script>

    </div>
</body>

</html>