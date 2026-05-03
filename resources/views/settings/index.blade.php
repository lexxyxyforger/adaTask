<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    @include('partials.settings-boot')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan – WongTask</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
    :root {
        --bg: #f4f0e8; --card: #fff; --line: #e8e0d0;
        --brand: #7a4b23; --brand-light: #a0622e; --brand-soft: #f2e4d3;
        --ink: #2e241a; --muted: #9a8f85;
    }
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
        background: #d8d0c0;
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: var(--ink);
        display: flex; justify-content: center; min-height: 100vh;
    }
    .phone {
        width: 100%; max-width: 430px; min-height: 100vh;
        background: var(--bg); padding-bottom: 96px;
    }

    /* ── HEADER ── */
    .header {
        display: flex; align-items: center; gap: 12px;
        padding: 52px 20px 16px;
    }
    .back-btn {
        width: 36px; height: 36px; border-radius: 10px;
        background: var(--card); border: 1px solid var(--line);
        display: flex; align-items: center; justify-content: center;
        color: var(--ink); text-decoration: none; flex-shrink: 0;
        transition: background .15s;
    }
    .back-btn:hover { background: var(--brand-soft); }
    .back-btn svg { width: 18px; height: 18px; }
    .header h1 { font-size: 1.35rem; font-weight: 800; letter-spacing: -.3px; }

    /* ── PROFILE CARD ── */
    .profile-card {
        margin: 0 16px 6px;
        background: var(--card); border: 1px solid var(--line);
        border-radius: 18px; padding: 14px;
        display: flex; align-items: center; gap: 13px;
        box-shadow: 0 2px 10px rgba(122,75,35,.06);
    }
    .profile-avatar {
        width: 52px; height: 52px; border-radius: 50%; flex-shrink: 0;
        background: linear-gradient(135deg, #7a4b23, #c07c3a);
        color: #fff; font-weight: 800; font-size: 1.2rem;
        display: flex; align-items: center; justify-content: center;
        overflow: hidden;
    }
    .profile-avatar img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; }
    .profile-info { flex: 1; min-width: 0; }
    .profile-name { font-size: .95rem; font-weight: 800; margin-bottom: 2px; }
    .profile-email { font-size: .74rem; color: var(--muted); font-weight: 500; }
    .profile-edit-btn {
        font-size: .72rem; font-weight: 700; color: var(--brand);
        text-decoration: none; padding: 5px 11px; border-radius: 99px;
        background: var(--brand-soft); white-space: nowrap;
        transition: background .15s;
    }
    .profile-edit-btn:hover { background: #e8d5c0; }

    /* ── STATS ── */
    .stats-row {
        display: grid; grid-template-columns: repeat(3,1fr); gap: 8px;
        margin: 0 16px 14px;
    }
    .stat-card {
        background: var(--card); border: 1px solid var(--line);
        border-radius: 14px; padding: 12px 8px; text-align: center;
    }
    .stat-value { display: block; font-size: 1.2rem; font-weight: 800; color: var(--brand); margin-bottom: 2px; }
    .stat-label { font-size: .65rem; color: var(--muted); font-weight: 600; }

    /* ── SECTION TITLE ── */
    .sec-title {
        font-size: .7rem; font-weight: 800; color: var(--muted);
        letter-spacing: .5px; text-transform: uppercase;
        padding: 14px 20px 6px;
    }

    /* ── SETTINGS CARD ── */
    .settings-card {
        background: var(--card); border: 1px solid var(--line);
        border-radius: 16px; overflow: hidden; margin: 0 16px 10px;
        box-shadow: 0 2px 10px rgba(122,75,35,.06);
    }
    .setting-row {
        display: flex; align-items: center; justify-content: space-between;
        padding: 13px 14px; border-bottom: 1px solid #f1e8dc;
    }
    .setting-row:last-child { border-bottom: none; }
    .setting-left { display: flex; align-items: center; gap: 12px; flex: 1; min-width: 0; }
    .setting-icon {
        width: 34px; height: 34px; border-radius: 9px; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
    }
    .setting-icon svg { width: 17px; height: 17px; }
    .setting-icon.green  { background: #e6f7ea; color: #2a8f43; }
    .setting-icon.orange { background: #fff3e0; color: #b8692a; }
    .setting-icon.blue   { background: #e3f1ff; color: #2f70a9; }
    .setting-icon.red    { background: #fff0f0; color: #b83232; }
    .setting-icon.purple { background: #f3e5f5; color: #7b1fa2; }
    .setting-icon.brown  { background: var(--brand-soft); color: var(--brand); }
    .setting-text strong { display: block; font-size: .85rem; font-weight: 700; color: var(--ink); }
    .setting-text small  { font-size: .71rem; color: var(--muted); font-weight: 500; }

    /* Toggle */
    .toggle-wrap { position: relative; width: 44px; height: 26px; flex-shrink: 0; }
    .toggle-wrap input { opacity: 0; width: 0; height: 0; position: absolute; }
    .toggle-slider {
        position: absolute; inset: 0; background: #d8d0c4;
        border-radius: 99px; cursor: pointer; transition: background .25s;
    }
    .toggle-slider::before {
        content: ''; position: absolute;
        width: 20px; height: 20px; border-radius: 50%; background: #fff;
        top: 3px; left: 3px; transition: transform .25s;
        box-shadow: 0 1px 4px rgba(0,0,0,.18);
    }
    .toggle-wrap input:checked + .toggle-slider { background: var(--brand); }
    .toggle-wrap input:checked + .toggle-slider::before { transform: translateX(18px); }

    /* ── MENU ITEM (links) ── */
    .menu-item {
        display: flex; align-items: center; justify-content: space-between;
        padding: 13px 14px; text-decoration: none; color: var(--ink);
        border-bottom: 1px solid #f1e8dc; transition: background .12s;
    }
    .menu-item:last-child { border-bottom: none; }
    .menu-item:hover { background: #faf5ef; }
    .menu-chevron { color: #c8bfb5; font-size: 1.1rem; }

    /* Danger */
    .menu-item.danger { color: #c0392b; }
    .menu-item.danger .setting-icon { background: #fff0f0; color: #c0392b; }

    /* ── VERSION ── */
    .version-text {
        text-align: center; font-size: .72rem; color: #c8bfb5;
        font-weight: 600; padding: 16px;
    }

    /* ── TOAST ── */
    #settings-toast {
        position: fixed; bottom: 88px; left: 50%; transform: translateX(-50%);
        background: #2a8f43; color: #fff; padding: 9px 18px;
        border-radius: 99px; font-size: .78rem; font-weight: 700;
        z-index: 300; box-shadow: 0 4px 16px rgba(0,0,0,.2);
        transition: opacity .3s; opacity: 0; pointer-events: none;
    }
    #settings-toast.show { opacity: 1; }

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
    .nav-item:hover, .nav-item.active { color: var(--brand); }
    .nav-item svg { width: 22px; height: 22px; }
    .nav-dot { width: 5px; height: 5px; border-radius: 50%; background: var(--brand); }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(10px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .settings-card { animation: fadeUp .22s ease both; }
    .settings-card:nth-child(2) { animation-delay: .04s; }
    .settings-card:nth-child(3) { animation-delay: .08s; }
    </style>
</head>
<body>
<div class="phone">

    {{-- HEADER --}}
    <div class="header">
        <a href="{{ route('profile') }}" class="back-btn" aria-label="Kembali">
            <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path d="M19 12H5M12 5l-7 7 7 7"/>
            </svg>
        </a>
        <h1>Pengaturan</h1>
    </div>

    {{-- PROFILE CARD --}}
    @auth
    @php
        $u = auth()->user()->fresh();
    @endphp
    <div class="profile-card">
        <div class="profile-avatar">
            @if($u->avatar_url)
                <img src="{{ $u->avatar_url }}" alt="Foto profil"
                     onerror="this.style.display='none'">
            @else
                {{ strtoupper(mb_substr($u->name ?? 'W', 0, 1)) }}
            @endif
        </div>
        <div class="profile-info">
            <div class="profile-name">{{ $u->name }}</div>
            <div class="profile-email">{{ $u->email }}</div>
        </div>
        <a href="{{ route('profile') }}" class="profile-edit-btn">Edit Profil</a>
    </div>

    {{-- STATS --}}
    @php
        $projectIds = \App\Models\Project::where('user_id', $u->id)->pluck('id');
        $totalT = \App\Models\Task::whereIn('project_id', $projectIds)->count();
        $doneT  = \App\Models\Task::whereIn('project_id', $projectIds)->where('status','done')->count();
        $totalP = \App\Models\Project::where('user_id', $u->id)->count();
        $prod   = $totalT > 0 ? (int) round($doneT / $totalT * 100) : 0;
    @endphp
    <div class="stats-row">
        <div class="stat-card">
            <span class="stat-value">{{ $totalT }}</span>
            <span class="stat-label">Total Tugas</span>
        </div>
        <div class="stat-card">
            <span class="stat-value">{{ $totalP }}</span>
            <span class="stat-label">Proyek</span>
        </div>
        <div class="stat-card">
            <span class="stat-value">{{ $prod }}%</span>
            <span class="stat-label">Produktivitas</span>
        </div>
    </div>
    @endauth

    {{-- SECTION: PREFERENSI --}}
    <div class="sec-title">Preferensi</div>
    <div class="settings-card">

        {{-- Hemat Daya --}}
        <div class="setting-row">
            <div class="setting-left">
                <div class="setting-icon green">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
                    </svg>
                </div>
                <div class="setting-text">
                    <strong>Hemat Daya</strong>
                    <small>Matikan animasi &amp; efek gerak</small>
                </div>
            </div>
            <label class="toggle-wrap">
                <input type="checkbox" id="power-save-toggle" onchange="onToggle('power_save', this.checked)">
                <span class="toggle-slider"></span>
            </label>
        </div>

        {{-- Notifikasi Deadline --}}
        <div class="setting-row">
            <div class="setting-left">
                <div class="setting-icon orange">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M18 8h1a4 4 0 010 8h-1"/>
                        <path d="M2 8h16v9a4 4 0 01-4 4H6a4 4 0 01-4-4V8z"/>
                        <line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/>
                    </svg>
                </div>
                <div class="setting-text">
                    <strong>Notifikasi Deadline</strong>
                    <small>Ingatkan tugas yang mendekati deadline</small>
                </div>
            </div>
            <label class="toggle-wrap">
                <input type="checkbox" id="notif-toggle" onchange="onToggle('notif', this.checked)" checked>
                <span class="toggle-slider"></span>
            </label>
        </div>

        {{-- Tampilkan Deadline --}}
        <div class="setting-row">
            <div class="setting-left">
                <div class="setting-icon blue">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12 6 12 12 16 14"/>
                    </svg>
                </div>
                <div class="setting-text">
                    <strong>Tampilkan Deadline</strong>
                    <small>Tampilkan tanggal di daftar tugas</small>
                </div>
            </div>
            <label class="toggle-wrap">
                <input type="checkbox" id="deadline-toggle" onchange="onToggle('showDeadline', this.checked)" checked>
                <span class="toggle-slider"></span>
            </label>
        </div>

    </div>

    {{-- SECTION: APLIKASI --}}
    <div class="sec-title">Aplikasi</div>
    <div class="settings-card">

        <a href="{{ route('projects.index') }}" class="menu-item">
            <div class="setting-left">
                <div class="setting-icon brown">
                    <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                        <rect x="2" y="3" width="20" height="14" rx="2"/>
                        <line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/>
                    </svg>
                </div>
                <div class="setting-text">
                    <strong>Proyek Saya</strong>
                    <small>Kelola semua proyek</small>
                </div>
            </div>
            <span class="menu-chevron">›</span>
        </a>

        <a href="{{ route('archive') }}" class="menu-item">
            <div class="setting-left">
                <div class="setting-icon purple">
                    <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                        <polyline points="21 8 21 21 3 21 3 8"/>
                        <rect x="1" y="3" width="22" height="5"/>
                        <line x1="10" y1="12" x2="14" y2="12"/>
                    </svg>
                </div>
                <div class="setting-text">
                    <strong>Arsip Tugas</strong>
                    <small>Lihat tugas yang sudah selesai</small>
                </div>
            </div>
            <span class="menu-chevron">›</span>
        </a>

        <a href="{{ route('calendar') }}" class="menu-item">
            <div class="setting-left">
                <div class="setting-icon blue">
                    <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                        <rect x="3" y="4" width="18" height="18" rx="2"/>
                        <line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/>
                        <line x1="3" y1="10" x2="21" y2="10"/>
                    </svg>
                </div>
                <div class="setting-text">
                    <strong>Kalender</strong>
                    <small>Lihat jadwal tugas per tanggal</small>
                </div>
            </div>
            <span class="menu-chevron">›</span>
        </a>

    </div>

    {{-- SECTION: AKUN --}}
    <div class="sec-title">Akun</div>
    <div class="settings-card">

        <a href="{{ route('profile') }}" class="menu-item">
            <div class="setting-left">
                <div class="setting-icon brown">
                    <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                        <circle cx="12" cy="8" r="4"/>
                        <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                    </svg>
                </div>
                <div class="setting-text">
                    <strong>Edit Profil</strong>
                    <small>Ubah nama, email, bio &amp; foto</small>
                </div>
            </div>
            <span class="menu-chevron">›</span>
        </a>

        <form method="POST" action="{{ route('logout') }}" style="margin:0">
            @csrf
            <button type="submit" class="menu-item danger"
                    style="width:100%;background:none;font-family:inherit;border:none;text-align:left;cursor:pointer;">
                <div class="setting-left">
                    <div class="setting-icon red">
                        <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                            <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/>
                            <polyline points="16 17 21 12 16 7"/>
                            <line x1="21" y1="12" x2="9" y2="12"/>
                        </svg>
                    </div>
                    <div class="setting-text">
                        <strong style="color:#c0392b">Keluar</strong>
                        <small>Logout dari akun ini</small>
                    </div>
                </div>
                <span class="menu-chevron" style="color:#c0392b">›</span>
            </button>
        </form>

    </div>

    <div class="version-text">WongTask v1.0 · Made with ☕</div>

    {{-- BOTTOM NAV --}}
    <nav class="bottom-nav">
        <a href="{{ route('home') }}" class="nav-item">
            <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                <polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
            Beranda
        </a>
        <a href="{{ route('projects.index') }}" class="nav-item">
            <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                <rect x="2" y="3" width="20" height="14" rx="2"/>
                <line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/>
            </svg>
            Proyek
        </a>
        <a href="{{ route('tasks.create') }}" class="nav-item">
            <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                <path d="M9 11l3 3L22 4"/>
                <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/>
            </svg>
            Tugas
        </a>
        <a href="{{ route('calendar') }}" class="nav-item">
            <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                <rect x="3" y="4" width="18" height="18" rx="2"/>
                <line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/>
                <line x1="3" y1="10" x2="21" y2="10"/>
            </svg>
            Kalender
        </a>
        <a href="{{ route('profile') }}" class="nav-item active">
            <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                <circle cx="12" cy="8" r="4"/>
                <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
            </svg>
            Profil
            <span class="nav-dot"></span>
        </a>
    </nav>

    <div id="settings-toast"></div>

    <script>
    // ── Baca state dari localStorage ──
    (function init() {
        const ps = localStorage.getItem('wongtask_power_save') === '1';
        document.getElementById('power-save-toggle').checked = ps;

        const notif = localStorage.getItem('wongtask_notif');
        document.getElementById('notif-toggle').checked = notif !== '0';

        const dl = localStorage.getItem('wongtask_showDeadline');
        document.getElementById('deadline-toggle').checked = dl !== '0';
    })();

    function onToggle(key, val) {
        localStorage.setItem('wongtask_' + key, val ? '1' : '0');

        // Apply immediately
        if (key === 'power_save') {
            document.body.classList.toggle('power-save', val);
        }

        showToast(val ? '✓ Pengaturan diaktifkan' : 'Pengaturan dinonaktifkan');
    }

    function showToast(msg) {
        const t = document.getElementById('settings-toast');
        t.textContent = msg;
        t.classList.add('show');
        clearTimeout(t._tid);
        t._tid = setTimeout(() => t.classList.remove('show'), 2200);
    }

    // ── Realtime: reload stats setiap 30 detik ──
    setInterval(() => {
        if (document.visibilityState === 'visible') {
            window.location.reload();
        }
    }, 30000);
    </script>

</div>
</body>
</html>
