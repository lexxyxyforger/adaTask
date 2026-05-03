<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    @include('partials.settings-boot')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WongTask – Proyek</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
    :root {
        --bg: #f4f0e8;
        --card: #ffffff;
        --text: #2a1f16;
        --muted: #9a8c7f;
        --line: #e8e0d0;
        --brand: #7a4b23;
        --brand-light: #a0622e;
        --brand-soft: #f2e4d3;
        --orange: #E07B39;
        --green: #4CAF50;
    }
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
        background: #d8d0c0;
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: var(--text);
        display: flex;
        justify-content: center;
        min-height: 100vh;
    }
    .phone {
        width: 100%;
        max-width: 430px;
        min-height: 100vh;
        background: var(--bg);
        padding-bottom: 96px;
    }

    /* ── HEADER ── */
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 52px 20px 14px;
    }
    .header h1 { font-size: 1.55rem; font-weight: 800; letter-spacing: -.3px; }
    .add-btn {
        width: 36px; height: 36px; border-radius: 50%; border: none;
        background: var(--brand); color: #fff; font-size: 1.4rem;
        display: flex; align-items: center; justify-content: center;
        text-decoration: none; box-shadow: 0 4px 14px rgba(122,75,35,.35);
        cursor: pointer; transition: background .15s, transform .1s; line-height: 1;
    }
    .add-btn:hover { background: var(--brand-light); }
    .add-btn:active { transform: scale(.93); }

    /* ── SEARCH ── */
    .search-wrap { padding: 0 16px 12px; position: relative; }
    .search-wrap svg {
        position: absolute; left: 28px; top: 50%; transform: translateY(-50%);
        width: 16px; height: 16px; color: var(--muted); pointer-events: none;
    }
    .search-input {
        width: 100%; border: 1px solid var(--line); border-radius: 12px;
        padding: 10px 36px 10px 38px; font-size: .84rem; font-family: inherit;
        background: var(--card); color: var(--text); outline: none;
        transition: border-color .15s, box-shadow .15s;
    }
    .search-input:focus { border-color: var(--brand); box-shadow: 0 0 0 3px rgba(122,75,35,.1); }
    .search-input::placeholder { color: #b8ac9f; }
    .search-clear {
        position: absolute; right: 28px; top: 50%; transform: translateY(-50%);
        width: 18px; height: 18px; border-radius: 50%; background: var(--muted);
        color: #fff; border: none; cursor: pointer; font-size: .75rem;
        display: none; align-items: center; justify-content: center; font-weight: 700;
    }
    .search-clear.show { display: flex; }

    /* ── TABS ── */
    .tabs {
        display: flex; gap: 6px; padding: 0 16px 14px;
        overflow-x: auto; scrollbar-width: none;
    }
    .tabs::-webkit-scrollbar { display: none; }
    .tab {
        border: none; border-radius: 10px; padding: 7px 13px;
        font-size: .77rem; font-weight: 700; font-family: inherit;
        cursor: pointer; white-space: nowrap;
        transition: background .15s, color .15s;
        display: flex; align-items: center; gap: 5px;
        text-decoration: none;
    }
    .tab.active { background: var(--brand); color: #fff; }
    .tab:not(.active) { background: #edeae5; color: #7b6f63; }
    .tab:not(.active):hover { background: #e0d8ce; }
    .tab-badge {
        min-width: 18px; height: 18px; border-radius: 99px;
        padding: 0 5px; font-size: .65rem; font-weight: 800;
        display: inline-flex; align-items: center; justify-content: center;
    }
    .tab.active .tab-badge { background: rgba(255,255,255,.25); color: #fff; }
    .tab:not(.active) .tab-badge { background: rgba(0,0,0,.08); color: var(--muted); }

    /* ── FILTER LABEL ── */
    .filter-label {
        padding: 0 16px 8px;
        font-size: .72rem; font-weight: 700; color: var(--muted);
        letter-spacing: .4px; text-transform: uppercase;
        display: flex; align-items: center; justify-content: space-between;
    }
    .filter-dot {
        width: 8px; height: 8px; border-radius: 50%; margin-right: 6px;
        display: inline-block;
    }
    .dot-aktif   { background: var(--orange); }
    .dot-selesai { background: var(--green); }
    .dot-arsip   { background: var(--muted); }

    /* ── CREATE FORM ── */
    .create-form {
        background: var(--card); border: 1px solid var(--line);
        border-radius: 16px; padding: 14px; margin: 0 16px 16px;
        box-shadow: 0 2px 10px rgba(122,75,35,.06);
    }
    .create-form input {
        width: 100%; border: 1px solid var(--line); border-radius: 10px;
        padding: 10px 12px; margin-bottom: 8px; font-size: .84rem;
        font-family: inherit; color: var(--text); background: #fdfaf6;
        outline: none; transition: border-color .15s;
    }
    .create-form input:focus { border-color: var(--brand); }
    .create-form input::placeholder { color: #b8ac9f; }
    .create-form input:last-of-type { margin-bottom: 0; }
    .create-form button {
        width: 100%; border: none; border-radius: 10px;
        background: var(--brand); color: #fff; padding: 11px;
        font-size: .86rem; font-weight: 700; font-family: inherit;
        cursor: pointer; transition: background .15s; margin-top: 8px;
    }
    .create-form button:hover { background: var(--brand-light); }

    /* ── PROJECT LIST ── */
    .list { display: grid; gap: 9px; padding: 0 16px; }
    .item {
        display: flex; gap: 13px; align-items: center;
        text-decoration: none; background: var(--card);
        border: 1px solid var(--line); border-radius: 16px;
        padding: 13px; color: inherit;
        transition: box-shadow .15s, transform .1s;
        animation: fadeUp .22s ease both;
    }
    .item:hover { box-shadow: 0 4px 18px rgba(122,75,35,.12); transform: translateY(-1px); }
    .logo {
        width: 46px; height: 46px; border-radius: 13px; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
        color: #fff; font-weight: 800; font-size: 1rem;
    }
    .item-body { flex: 1; min-width: 0; }
    .item-title {
        font-size: .93rem; font-weight: 700; margin-bottom: 2px;
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }
    .item-meta { font-size: .73rem; color: var(--muted); font-weight: 500; margin-bottom: 7px; }
    .track { height: 6px; border-radius: 99px; background: #efe8de; overflow: hidden; }
    .fill { height: 100%; border-radius: 99px; transition: width .5s ease; }
    .pct { font-size: .74rem; font-weight: 700; color: var(--muted); flex-shrink: 0; }
    .status-badge {
        font-size: .62rem; font-weight: 800; padding: 3px 8px;
        border-radius: 99px; flex-shrink: 0; margin-left: 4px;
    }
    .badge-aktif   { background: #FFF3E0; color: var(--orange); }
    .badge-selesai { background: #E8F5E9; color: #388E3C; }
    .badge-arsip   { background: #F5F5F5; color: var(--muted); }

    /* ── EMPTY ── */
    .empty { text-align: center; padding: 40px 20px; color: var(--muted); }
    .empty-icon { font-size: 2.8rem; margin-bottom: 10px; }
    .empty h3 { font-size: .95rem; font-weight: 700; margin-bottom: 4px; color: var(--text); }
    .empty p  { font-size: .8rem; font-weight: 500; line-height: 1.5; }

    /* ── SEARCH RESULT INFO ── */
    .result-info {
        padding: 0 16px 10px;
        font-size: .75rem; font-weight: 600; color: var(--muted);
    }
    .result-info span { color: var(--brand); font-weight: 800; }

    /* ── BOTTOM NAV ── */
    .bottom-nav {
        position: fixed; bottom: 0; left: 50%; transform: translateX(-50%);
        width: 100%; max-width: 430px; background: #fff;
        border-top: 1px solid var(--line);
        display: flex; justify-content: space-around; align-items: center;
        height: 68px; z-index: 99; padding: 0 4px;
        box-shadow: 0 -4px 20px rgba(0,0,0,.06);
    }
    .nav-item {
        display: flex; flex-direction: column; align-items: center; gap: 3px;
        color: #b0a498; text-decoration: none; flex: 1; padding: 8px 0 4px;
        font-size: .62rem; font-weight: 700; letter-spacing: .2px; transition: color .15s;
    }
    .nav-item:hover { color: var(--brand); }
    .nav-item.active { color: var(--brand); }
    .nav-item svg { width: 22px; height: 22px; }
    .nav-dot { width: 5px; height: 5px; border-radius: 50%; background: var(--brand); }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(10px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .item:nth-child(1) { animation-delay: .04s; }
    .item:nth-child(2) { animation-delay: .08s; }
    .item:nth-child(3) { animation-delay: .12s; }
    .item:nth-child(4) { animation-delay: .16s; }
    .item:nth-child(n+5) { animation-delay: .20s; }
    </style>
</head>
<body>
<div class="phone">

    {{-- HEADER --}}
    <div class="header">
        <h1>Proyek Saya</h1>
        <a href="{{ route('tasks.create') }}" class="add-btn" aria-label="Tambah tugas">+</a>
    </div>

    {{-- SEARCH --}}
    <form method="GET" action="{{ route('projects.index') }}" id="search-form">
        <input type="hidden" name="filter" value="{{ $filter }}">
        <div class="search-wrap">
            <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
            </svg>
            <input class="search-input" type="text" name="q"
                   placeholder="Cari proyek atau tugas..."
                   value="{{ $search }}"
                   id="search-input"
                   autocomplete="off">
            <button type="button" class="search-clear {{ $search ? 'show' : '' }}"
                    id="search-clear" aria-label="Hapus pencarian">✕</button>
        </div>
    </form>

    {{-- TABS --}}
    <div class="tabs">
        @php
        $tabs = [
            'semua'   => 'Semua',
            'aktif'   => 'Aktif',
            'selesai' => 'Selesai',
            'arsip'   => 'Arsip',
        ];
        @endphp
        @foreach($tabs as $key => $label)
        <a href="{{ route('projects.index', array_filter(['filter' => $key, 'q' => $search])) }}"
           class="tab {{ $filter === $key ? 'active' : '' }}">
            {{ $label }}
            <span class="tab-badge">{{ $counts[$key] }}</span>
        </a>
        @endforeach
    </div>

    {{-- FILTER LABEL --}}
    @if($filter !== 'semua')
    <div class="filter-label">
        <span>
            <span class="filter-dot dot-{{ $filter }}"></span>
            @if($filter === 'aktif') Proyek masih berjalan
            @elseif($filter === 'selesai') Proyek 100% selesai
            @else Proyek tanpa tugas
            @endif
        </span>
        <span>{{ $projects->count() }} proyek</span>
    </div>
    @endif

    {{-- SEARCH RESULT INFO --}}
    @if($search)
    <div class="result-info">
        Hasil pencarian: <span>"{{ $search }}"</span> — {{ $projects->count() }} proyek ditemukan
    </div>
    @endif

    {{-- CREATE FORM (hanya tampil di tab semua) --}}
    @if($filter === 'semua' && !$search)
    <form method="POST" action="{{ route('projects.store') }}" class="create-form">
        @csrf
        <input type="text" name="name" placeholder="Nama proyek baru" required>
        <input type="text" name="description" placeholder="Deskripsi singkat (opsional)">
        <button type="submit">+ Tambah Proyek</button>
    </form>
    @endif

    {{-- PROJECT LIST --}}
    @php
    $palette = [
        ['#4b6cb7','#182848'], ['#6cae53','#3a7a26'], ['#f3a63d','#c07820'],
        ['#d86a5a','#a03828'], ['#8b7ed1','#5b4ea1'], ['#3aacb8','#1a7280'],
    ];
    @endphp

    <div class="list" id="proj-list">
        @forelse($projects as $i => $project)
        @php
        $total  = max($project->tasks_count, 1);
        $done   = $project->done_tasks_count ?? 0;
        $pct    = (int) round(($done / $total) * 100);
        $raw    = $project->tasks_count;
        [$from, $to] = $palette[$i % count($palette)];

        if ($raw === 0)        { $statusClass = 'badge-arsip';   $statusLabel = 'Arsip'; }
        elseif ($pct >= 100)   { $statusClass = 'badge-selesai'; $statusLabel = 'Selesai'; }
        else                   { $statusClass = 'badge-aktif';   $statusLabel = 'Aktif'; }

        $barColor = $pct >= 100 ? '#4CAF50' : 'linear-gradient(90deg,#d08e38,#8e5124)';
        @endphp
        <a href="{{ route('projects.show', $project->id) }}" class="item" data-name="{{ strtolower($project->name) }}">
            <div class="logo" style="background:linear-gradient(135deg,{{ $from }},{{ $to }})">
                {{ strtoupper(mb_substr($project->name, 0, 2)) }}
            </div>
            <div class="item-body">
                <p class="item-title">{{ $project->name }}</p>
                <p class="item-meta">{{ $done }}/{{ $project->tasks_count }} tugas selesai</p>
                <div class="track">
                    <div class="fill" style="width:{{ $pct }}%; background:{{ $barColor }}"></div>
                </div>
            </div>
            <div style="display:flex;flex-direction:column;align-items:flex-end;gap:4px;flex-shrink:0">
                <div class="pct">{{ $pct }}%</div>
                <span class="status-badge {{ $statusClass }}">{{ $statusLabel }}</span>
            </div>
        </a>
        @empty
        <div class="empty">
            @if($search)
                <div class="empty-icon">🔍</div>
                <h3>Tidak ditemukan</h3>
                <p>Tidak ada proyek dengan nama<br><strong>"{{ $search }}"</strong></p>
            @elseif($filter === 'aktif')
                <div class="empty-icon">🚀</div>
                <h3>Tidak ada proyek aktif</h3>
                <p>Semua proyek sudah selesai atau belum ada tugas.</p>
            @elseif($filter === 'selesai')
                <div class="empty-icon">🎉</div>
                <h3>Belum ada yang selesai</h3>
                <p>Selesaikan semua tugas di suatu proyek agar muncul di sini.</p>
            @elseif($filter === 'arsip')
                <div class="empty-icon">📦</div>
                <h3>Tidak ada arsip</h3>
                <p>Proyek tanpa tugas akan muncul di sini.</p>
            @else
                <div class="empty-icon">📋</div>
                <h3>Belum ada proyek</h3>
                <p>Tambahkan proyek pertama kamu di atas!</p>
            @endif
        </div>
        @endforelse
    </div>

    {{-- BOTTOM NAV --}}
    <nav class="bottom-nav">
        <a href="{{ route('home') }}" class="nav-item">
            <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                <polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
            Beranda
        </a>
        <a href="{{ route('projects.index') }}" class="nav-item active">
            <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                <rect x="2" y="3" width="20" height="14" rx="2"/>
                <line x1="8" y1="21" x2="16" y2="21"/>
                <line x1="12" y1="17" x2="12" y2="21"/>
            </svg>
            Proyek
            <span class="nav-dot"></span>
        </a>
        <a href="{{ $projects->first() ? route('projects.show', ['project' => $projects->first()->id, 'tab' => 'tasks']) : route('tasks.create') }}"
           class="nav-item">
            <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                <path d="M9 11l3 3L22 4"/>
                <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/>
            </svg>
            Tugas
        </a>
        <a href="{{ route('calendar') }}" class="nav-item">
            <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                <rect x="3" y="4" width="18" height="18" rx="2"/>
                <line x1="16" y1="2" x2="16" y2="6"/>
                <line x1="8" y1="2" x2="8" y2="6"/>
                <line x1="3" y1="10" x2="21" y2="10"/>
            </svg>
            Kalender
        </a>
        <a href="{{ route('profile') }}" class="nav-item">
            <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                <circle cx="12" cy="8" r="4"/>
                <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
            </svg>
            Profil
        </a>
    </nav>

    <script>
    // ── Realtime search (debounce 350ms, submit form) ──
    (() => {
        const input  = document.getElementById('search-input');
        const clear  = document.getElementById('search-clear');
        const form   = document.getElementById('search-form');
        let timer;

        input?.addEventListener('input', () => {
            clear?.classList.toggle('show', input.value.length > 0);
            clearTimeout(timer);
            timer = setTimeout(() => form?.submit(), 350);
        });

        clear?.addEventListener('click', () => {
            input.value = '';
            clear.classList.remove('show');
            form?.submit();
        });
    })();

    // ── Auto-reload (skip saat ada focus input) ──
    (() => {
        setInterval(() => {
            const focused = !!document.querySelector('input:focus,textarea:focus');
            if (document.visibilityState === 'visible' && !focused) {
                window.location.reload();
            }
        }, 30000);
    })();
    </script>

</div>
</body>
</html>