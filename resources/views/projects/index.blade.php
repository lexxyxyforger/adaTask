<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WongTask - Proyek</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
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
    }

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

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
        padding: 0 0 96px;
    }

    /* ── HEADER ── */
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 52px 20px 14px;
    }

    .header h1 {
        font-size: 1.55rem;
        font-weight: 800;
        letter-spacing: -.3px;
    }

    .add-btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border: none;
        background: var(--brand);
        color: #fff;
        font-size: 1.4rem;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        box-shadow: 0 4px 14px rgba(122, 75, 35, .35);
        cursor: pointer;
        transition: background .15s, transform .1s;
        line-height: 1;
    }

    .add-btn:hover {
        background: var(--brand-light);
    }

    .add-btn:active {
        transform: scale(.93);
    }

    /* ── SEARCH ── */
    .search-wrap {
        padding: 0 16px 12px;
        position: relative;
    }

    .search-wrap svg {
        position: absolute;
        left: 28px;
        top: 50%;
        transform: translateY(-50%);
        width: 16px;
        height: 16px;
        color: var(--muted);
    }

    .search-input {
        width: 100%;
        border: 1px solid var(--line);
        border-radius: 12px;
        padding: 10px 14px 10px 38px;
        font-size: .84rem;
        font-family: inherit;
        background: var(--card);
        color: var(--text);
        outline: none;
        transition: border-color .15s;
    }

    .search-input:focus {
        border-color: var(--brand);
    }

    .search-input::placeholder {
        color: #b8ac9f;
    }

    /* ── TABS ── */
    .tabs {
        display: flex;
        gap: 7px;
        padding: 0 16px 14px;
        overflow-x: auto;
        scrollbar-width: none;
    }

    .tabs::-webkit-scrollbar {
        display: none;
    }

    .tab {
        border: none;
        border-radius: 10px;
        padding: 8px 14px;
        font-size: .78rem;
        font-weight: 700;
        font-family: inherit;
        cursor: pointer;
        white-space: nowrap;
        transition: background .15s, color .15s;
    }

    .tab.active {
        background: var(--brand);
        color: #fff;
    }

    .tab:not(.active) {
        background: #edeae5;
        color: #7b6f63;
    }

    .tab:not(.active):hover {
        background: #e0d8ce;
    }

    /* ── CREATE FORM ── */
    .create-form {
        background: var(--card);
        border: 1px solid var(--line);
        border-radius: 16px;
        padding: 14px;
        margin: 0 16px 14px;
        box-shadow: 0 2px 10px rgba(122, 75, 35, .06);
    }

    .create-form input {
        width: 100%;
        border: 1px solid var(--line);
        border-radius: 10px;
        padding: 10px 12px;
        margin-bottom: 8px;
        font-size: .84rem;
        font-family: inherit;
        color: var(--text);
        background: #fdfaf6;
        outline: none;
        transition: border-color .15s;
    }

    .create-form input:focus {
        border-color: var(--brand);
    }

    .create-form input::placeholder {
        color: #b8ac9f;
    }

    .create-form button {
        width: 100%;
        border: none;
        border-radius: 10px;
        background: var(--brand);
        color: #fff;
        padding: 11px;
        font-size: .86rem;
        font-weight: 700;
        font-family: inherit;
        cursor: pointer;
        transition: background .15s;
    }

    .create-form button:hover {
        background: var(--brand-light);
    }

    /* ── PROJECT LIST ── */
    .list {
        display: grid;
        gap: 9px;
        padding: 0 16px;
    }

    .item {
        display: flex;
        gap: 13px;
        align-items: center;
        text-decoration: none;
        background: var(--card);
        border: 1px solid var(--line);
        border-radius: 16px;
        padding: 13px 13px;
        color: inherit;
        transition: box-shadow .15s, transform .1s;
    }

    .item:hover {
        box-shadow: 0 4px 18px rgba(122, 75, 35, .1);
        transform: translateY(-1px);
    }

    .logo {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-weight: 800;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .item-body {
        flex: 1;
        min-width: 0;
    }

    .item-title {
        font-size: .93rem;
        font-weight: 700;
        margin-bottom: 2px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .item-meta {
        font-size: .74rem;
        color: var(--muted);
        font-weight: 500;
        margin-bottom: 7px;
    }

    .track {
        height: 6px;
        border-radius: 99px;
        background: #efe8de;
        overflow: hidden;
    }

    .fill {
        height: 100%;
        border-radius: 99px;
        background: linear-gradient(90deg, #d08e38, #8e5124);
        transition: width .4s ease;
    }

    .pct {
        font-size: .74rem;
        font-weight: 700;
        color: var(--muted);
        flex-shrink: 0;
    }

    /* Empty state */
    .empty {
        text-align: center;
        padding: 36px 16px;
        color: var(--muted);
    }

    .empty svg {
        width: 48px;
        height: 48px;
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

    .item:nth-child(1) {
        animation: fadeUp .2s ease .05s both;
    }

    .item:nth-child(2) {
        animation: fadeUp .2s ease .10s both;
    }

    .item:nth-child(3) {
        animation: fadeUp .2s ease .15s both;
    }

    .item:nth-child(4) {
        animation: fadeUp .2s ease .20s both;
    }

    .item:nth-child(5) {
        animation: fadeUp .2s ease .25s both;
    }

    .item:nth-child(n+6) {
        animation: fadeUp .2s ease .30s both;
    }
    </style>
</head>

<body>
    <div class="phone">

        {{-- ── HEADER ── --}}
        <div class="header">
            <h1>Proyek Saya</h1>
            <a href="{{ route('tasks.create') }}" class="add-btn" aria-label="Tambah proyek">+</a>
        </div>

        {{-- ── SEARCH ── --}}
        <div class="search-wrap">
            <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                <circle cx="11" cy="11" r="8" />
                <line x1="21" y1="21" x2="16.65" y2="16.65" />
            </svg>
            <input class="search-input" type="text" placeholder="Cari proyek...">
        </div>

        {{-- ── TABS ── --}}
        <div class="tabs">
            <button class="tab active">Semua</button>
            <button class="tab">Aktif</button>
            <button class="tab">Selesai</button>
            <button class="tab">Arsip</button>
        </div>

        {{-- ── CREATE FORM ── --}}
        <form method="POST" action="{{ route('projects.store') }}" class="create-form">
            @csrf
            <input type="text" name="name" placeholder="Nama proyek baru" required>
            <input type="text" name="description" placeholder="Deskripsi singkat (opsional)">
            <button type="submit">+ Tambah Proyek</button>
        </form>

        {{-- ── PROJECT LIST ── --}}
        <div class="list">
            @php
            $palette = [
            ['#4b6cb7','#182848'],
            ['#6cae53','#3a7a26'],
            ['#f3a63d','#c07820'],
            ['#d86a5a','#a03828'],
            ['#8b7ed1','#5b4ea1'],
            ['#3aacb8','#1a7280'],
            ];
            @endphp

            @forelse($projects as $project)
            @php
            $total = max($project->tasks_count, 1);
            $done = $project->done_tasks_count ?? 0;
            $pct = (int) round(($done / $total) * 100);
            [$from, $to] = $palette[$loop->index % count($palette)];
            @endphp

            <a href="{{ route('projects.show', $project->id) }}" class="item">
                <div class="logo" style="background: linear-gradient(135deg, {{ $from }}, {{ $to }});">
                    {{ strtoupper(mb_substr($project->name, 0, 2)) }}
                </div>
                <div class="item-body">
                    <p class="item-title">{{ $project->name }}</p>
                    <p class="item-meta">{{ $done }}/{{ $project->tasks_count }} tugas</p>
                    <div class="track">
                        <div class="fill" style="width: {{ $pct }}%"></div>
                    </div>
                </div>
                <div class="pct">{{ $pct }}%</div>
            </a>

            @empty
            <div class="empty">
                <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <rect x="2" y="3" width="20" height="14" rx="2" />
                    <line x1="8" y1="21" x2="16" y2="21" />
                    <line x1="12" y1="17" x2="12" y2="21" />
                </svg>
                <p>Belum ada proyek. Tambahkan proyek pertama kamu!</p>
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

            <a href="{{ route('projects.index') }}" class="nav-item active">
                <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <rect x="2" y="3" width="20" height="14" rx="2" />
                    <line x1="8" y1="21" x2="16" y2="21" />
                    <line x1="12" y1="17" x2="12" y2="21" />
                </svg>
                Proyek
                <span class="nav-dot"></span>
            </a>

            <a href="{{ $projects->first() ? route('projects.show', ['project' => $projects->first()->id, 'tab' => 'tasks']) : route('tasks.create') }}"
                class="nav-item">
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