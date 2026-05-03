<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    @include('partials.settings-boot')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Profil - WongTask</title>
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
        --success-bg: #e6f7ea;
        --success-color: #2a8f43;
        --success-border: #c4e8cc;
        --error-bg: #fff0f0;
        --error-color: #b83232;
        --error-border: #ffd0d0;
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

    /* ── HEADER AREA ── */
    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 52px 20px 16px;
    }

    .page-title {
        font-size: 1.45rem;
        font-weight: 800;
        letter-spacing: -.3px;
    }

    .settings-btn {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: var(--card);
        border: 1px solid var(--line);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: var(--muted);
        text-decoration: none;
        transition: color .15s, border-color .15s;
    }

    .settings-btn:hover {
        color: var(--brand);
        border-color: var(--brand);
    }

    /* ── FLASH / ERROR ── */
    .flash-area {
        padding: 0 16px;
        margin-bottom: 4px;
    }

    .flash {
        background: var(--success-bg);
        color: var(--success-color);
        border: 1px solid var(--success-border);
        padding: 10px 13px;
        border-radius: 12px;
        font-size: .8rem;
        font-weight: 600;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .flash svg {
        width: 14px;
        height: 14px;
        flex-shrink: 0;
    }

    .errors {
        background: var(--error-bg);
        color: var(--error-color);
        border: 1px solid var(--error-border);
        padding: 10px 13px;
        border-radius: 12px;
        font-size: .8rem;
        font-weight: 600;
        margin-bottom: 8px;
    }

    /* ── AVATAR ── */
    .avatar-wrap {
        position: relative;
        flex-shrink: 0;
        width: 68px;
        height: 68px;
    }

    .avatar {
        width: 68px;
        height: 68px;
        border-radius: 50%;
        background: linear-gradient(135deg, #7a4b23, #c07c3a);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: 800;
        box-shadow: 0 4px 14px rgba(122, 75, 35, .3);
        overflow: hidden;
        object-fit: cover;
    }

    .avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }

    .avatar-edit-btn {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: var(--brand);
        border: 2px solid var(--bg);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 2px 6px rgba(0,0,0,.2);
        transition: background .15s, transform .12s;
    }

    .avatar-edit-btn:hover {
        background: var(--brand-light);
        transform: scale(1.1);
    }

    .avatar-edit-btn svg {
        width: 12px;
        height: 12px;
        color: #fff;
    }

    /* ── PROFILE HERO ── */
    .profile-hero {
        padding: 0 16px 14px;
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .profile-info {
        flex: 1;
        min-width: 0;
    }

    .profile-name {
        font-size: 1.1rem;
        font-weight: 800;
        margin-bottom: 2px;
    }

    .profile-email {
        font-size: .76rem;
        color: var(--muted);
        font-weight: 500;
        margin-bottom: 4px;
    }

    .profile-bio {
        font-size: .76rem;
        color: #7a6e65;
        font-style: italic;
    }

    /* ── STATS ROW ── */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 8px;
        padding: 0 16px 14px;
    }

    .stat-card {
        background: var(--card);
        border: 1px solid var(--line);
        border-radius: 14px;
        padding: 13px 8px;
        text-align: center;
    }

    .stat-value {
        display: block;
        font-size: 1.25rem;
        font-weight: 800;
        color: var(--brand);
        margin-bottom: 3px;
    }

    .stat-label {
        font-size: .67rem;
        color: var(--muted);
        font-weight: 600;
    }

    /* ── FORM CARD ── */
    .section-label {
        font-size: .72rem;
        font-weight: 700;
        color: var(--muted);
        letter-spacing: .5px;
        text-transform: uppercase;
        padding: 0 16px;
        margin-bottom: 8px;
    }

    .form-card {
        background: var(--card);
        border: 1px solid var(--line);
        border-radius: 16px;
        padding: 14px;
        margin: 0 16px 14px;
        box-shadow: 0 2px 10px rgba(122, 75, 35, .06);
    }

    .field {
        margin-bottom: 11px;
    }

    .field:last-child {
        margin-bottom: 0;
    }

    .field label {
        display: block;
        font-size: .72rem;
        color: var(--muted);
        font-weight: 700;
        margin-bottom: 5px;
        letter-spacing: .2px;
    }

    .field input,
    .field textarea {
        width: 100%;
        border: 1px solid var(--line);
        border-radius: 10px;
        padding: 10px 12px;
        font-size: .84rem;
        font-family: inherit;
        color: var(--ink);
        background: #fdfaf6;
        transition: border-color .15s, box-shadow .15s;
        outline: none;
    }

    .field input:focus,
    .field textarea:focus {
        border-color: var(--brand);
        box-shadow: 0 0 0 3px rgba(122, 75, 35, .1);
    }

    .field textarea {
        min-height: 76px;
        resize: vertical;
    }

    .save-btn {
        width: 100%;
        border: none;
        border-radius: 11px;
        background: var(--brand);
        color: #fff;
        padding: 12px;
        font-size: .87rem;
        font-weight: 700;
        font-family: inherit;
        cursor: pointer;
        margin-top: 13px;
        transition: background .15s, transform .1s;
        letter-spacing: .2px;
    }

    .save-btn:hover {
        background: var(--brand-light);
    }

    .save-btn:active {
        transform: scale(.98);
    }

    /* ── MENU LIST ── */
    .menu-card {
        background: var(--card);
        border: 1px solid var(--line);
        border-radius: 16px;
        overflow: hidden;
        margin: 0 16px 14px;
        box-shadow: 0 2px 10px rgba(122, 75, 35, .06);
    }

    .menu-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 13px 15px;
        text-decoration: none;
        color: var(--ink);
        border-bottom: 1px solid #f1e8dc;
        font-size: .86rem;
        font-weight: 600;
        transition: background .12s;
        cursor: pointer;
    }

    .menu-item:last-child {
        border-bottom: none;
    }

    .menu-item:hover {
        background: #faf5ef;
    }

    .menu-item-left {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .menu-item-icon {
        width: 32px;
        height: 32px;
        border-radius: 9px;
        background: var(--bg);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--brand);
    }

    .menu-item-icon svg {
        width: 16px;
        height: 16px;
    }

    .menu-chevron {
        color: #c8bfb5;
        font-size: 1.1rem;
    }

    .menu-item.logout {
        color: #c0392b;
    }

    .menu-item.logout .menu-item-icon {
        background: #fff0f0;
        color: #c0392b;
    }

    .menu-form {
        margin: 0;
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

    .form-card {
        animation: fadeUp .25s ease .05s both;
    }

    .stats-row {
        animation: fadeUp .25s ease .10s both;
    }

    .menu-card {
        animation: fadeUp .25s ease .15s both;
    }
    /* ── AVATAR MODAL ── */
    .modal-backdrop {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,.45);
        z-index: 200;
        align-items: flex-end;
        justify-content: center;
    }

    .modal-backdrop.open {
        display: flex;
        animation: fadeIn .18s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to   { opacity: 1; }
    }

    .modal-sheet {
        background: var(--card);
        border-radius: 22px 22px 0 0;
        padding: 20px 20px 36px;
        width: 100%;
        max-width: 430px;
        animation: slideUp .22s ease;
    }

    @keyframes slideUp {
        from { transform: translateY(40px); opacity: 0; }
        to   { transform: translateY(0);    opacity: 1; }
    }

    .modal-title {
        font-size: .95rem;
        font-weight: 800;
        margin-bottom: 16px;
        text-align: center;
    }

    .modal-tabs {
        display: flex;
        gap: 6px;
        margin-bottom: 14px;
        background: var(--bg);
        border-radius: 10px;
        padding: 3px;
    }

    .modal-tab {
        flex: 1;
        border: none;
        background: none;
        border-radius: 8px;
        padding: 7px;
        font: inherit;
        font-size: .78rem;
        font-weight: 700;
        color: var(--muted);
        cursor: pointer;
        transition: background .15s, color .15s;
    }

    .modal-tab.active {
        background: var(--card);
        color: var(--brand);
        box-shadow: 0 1px 6px rgba(0,0,0,.08);
    }

    .modal-panel { display: none; }
    .modal-panel.active { display: block; }

    /* URL input */
    .url-input-wrap {
        display: flex;
        gap: 8px;
    }

    .url-input {
        flex: 1;
        border: 1px solid var(--line);
        border-radius: 10px;
        padding: 10px 12px;
        font: inherit;
        font-size: .84rem;
        color: var(--ink);
        background: #fdfaf6;
        outline: none;
        transition: border-color .15s, box-shadow .15s;
    }

    .url-input:focus {
        border-color: var(--brand);
        box-shadow: 0 0 0 3px rgba(122,75,35,.1);
    }

    .url-preview {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid var(--line);
        flex-shrink: 0;
        background: var(--bg);
        display: none;
    }

    /* Drag & drop zone */
    .drop-zone {
        border: 2px dashed var(--line);
        border-radius: 14px;
        padding: 28px 16px;
        text-align: center;
        cursor: pointer;
        transition: border-color .18s, background .18s;
        background: #fdfaf6;
    }

    .drop-zone.drag-over {
        border-color: var(--brand);
        background: rgba(122,75,35,.05);
    }

    .drop-zone-icon {
        width: 40px;
        height: 40px;
        margin: 0 auto 10px;
        color: var(--muted);
    }

    .drop-zone-text {
        font-size: .82rem;
        color: var(--muted);
        font-weight: 600;
        margin-bottom: 4px;
    }

    .drop-zone-sub {
        font-size: .72rem;
        color: #c0b5a8;
    }

    .drop-preview {
        margin-top: 12px;
        display: none;
        flex-direction: column;
        align-items: center;
        gap: 6px;
    }

    .drop-preview img {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid var(--brand);
    }

    .drop-preview-name {
        font-size: .74rem;
        color: var(--muted);
    }

    .modal-apply-btn {
        width: 100%;
        border: none;
        border-radius: 11px;
        background: var(--brand);
        color: #fff;
        padding: 12px;
        font: inherit;
        font-size: .87rem;
        font-weight: 700;
        cursor: pointer;
        margin-top: 14px;
        transition: background .15s;
    }

    .modal-apply-btn:hover { background: var(--brand-light); }

    .modal-close {
        width: 100%;
        border: 1px solid var(--line);
        border-radius: 11px;
        background: none;
        color: var(--muted);
        padding: 10px;
        font: inherit;
        font-size: .84rem;
        font-weight: 600;
        cursor: pointer;
        margin-top: 8px;
        transition: background .15s;
    }

    .modal-close:hover { background: var(--bg); }

    /* ── SETTINGS MODAL ── */
    .settings-section-title {
        font-size: .7rem;
        font-weight: 800;
        color: var(--muted);
        letter-spacing: .5px;
        text-transform: uppercase;
        margin-bottom: 8px;
        margin-top: 16px;
    }

    .settings-section-title:first-child { margin-top: 0; }

    /* Toggle switch */
    .setting-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: var(--bg);
        border-radius: 12px;
        padding: 13px 14px;
        margin-bottom: 7px;
    }

    .setting-row:last-of-type { margin-bottom: 0; }

    .setting-label {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .setting-icon {
        width: 34px;
        height: 34px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .setting-icon svg { width: 17px; height: 17px; }

    .setting-icon.green  { background: #e6f7ea; color: #2a8f43; }
    .setting-icon.orange { background: #fff3e0; color: #b8692a; }
    .setting-icon.blue   { background: #e3f1ff; color: #2f70a9; }

    .setting-text strong {
        display: block;
        font-size: .84rem;
        font-weight: 700;
        color: var(--ink);
    }

    .setting-text small {
        font-size: .72rem;
        color: var(--muted);
        font-weight: 500;
    }

    /* Toggle */
    .toggle-wrap {
        position: relative;
        width: 44px;
        height: 26px;
        flex-shrink: 0;
    }

    .toggle-wrap input { opacity: 0; width: 0; height: 0; position: absolute; }

    .toggle-slider {
        position: absolute;
        inset: 0;
        background: #d8d0c4;
        border-radius: 99px;
        cursor: pointer;
        transition: background .25s;
    }

    .toggle-slider::before {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #fff;
        top: 3px;
        left: 3px;
        transition: transform .25s;
        box-shadow: 0 1px 4px rgba(0,0,0,.18);
    }

    .toggle-wrap input:checked + .toggle-slider {
        background: var(--brand);
    }

    .toggle-wrap input:checked + .toggle-slider::before {
        transform: translateX(18px);
    }

    /* Profile card in settings */
    .settings-profile-card {
        background: var(--bg);
        border-radius: 14px;
        padding: 14px;
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 7px;
    }

    .settings-avatar {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        background: linear-gradient(135deg, #7a4b23, #c07c3a);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        font-weight: 800;
        flex-shrink: 0;
        overflow: hidden;
    }

    .settings-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }

    .settings-profile-info strong {
        display: block;
        font-size: .9rem;
        font-weight: 800;
        color: var(--ink);
    }

    .settings-profile-info span {
        font-size: .74rem;
        color: var(--muted);
        font-weight: 500;
    }

    .settings-stats-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 6px;
        margin-bottom: 14px;
    }

    .settings-stat {
        background: var(--bg);
        border-radius: 10px;
        padding: 10px 6px;
        text-align: center;
    }

    .settings-stat strong {
        display: block;
        font-size: 1rem;
        font-weight: 800;
        color: var(--brand);
    }

    .settings-stat small {
        font-size: .65rem;
        color: var(--muted);
        font-weight: 600;
    }

    /* Power-saving mode: reduce animations */
    body.power-save * {
        animation: none !important;
        transition: none !important;
    }
    </style>
</head>

<body>
    <div class="phone">

        {{-- ── PAGE HEADER ── --}}
        <div class="page-header">
            <h1 class="page-title">Profil</h1>
            <a href="{{ route('settings') }}" class="settings-btn" title="Pengaturan">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="3" />
                    <path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z" />
                </svg>
            </a>
        </div>

        {{-- ── FLASH / ERROR MESSAGES ── --}}
        <div class="flash-area">
            @if(session('success'))
            <div class="flash">
                <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M20 6L9 17l-5-5" />
                </svg>
                {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="errors">
                @foreach($errors->all() as $error)
                <div>• {{ $error }}</div>
                @endforeach
            </div>
            @endif
        </div>

        {{-- ── PROFILE HERO ── --}}
        <div class="profile-hero">
            <div class="avatar-wrap">
                @if($user->avatar_url)
                    <img src="{{ $user->avatar_url }}" class="avatar" alt="Foto profil">
                @else
                    <div class="avatar">{{ strtoupper(mb_substr($user->name ?? 'W', 0, 1)) }}</div>
                @endif
                <button type="button" class="avatar-edit-btn" onclick="openAvatarModal()" title="Ubah foto profil">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                        <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                    </svg>
                </button>
            </div>
            <div class="profile-info">
                <div class="profile-name">{{ $user->name ?? 'Wong' }}</div>
                <div class="profile-email">{{ $user->email ?? 'wong@sobatcoding.id' }}</div>
                <div class="profile-bio">{{ $user?->bio ?: 'Isi profil kamu biar makin personal ✨' }}</div>
            </div>
        </div>

        {{-- ── STATS ── --}}
        <div class="stats-row">
            <div class="stat-card">
                <span class="stat-value">{{ $totalTasks ?? 0 }}</span>
                <span class="stat-label">Tugas Selesai</span>
            </div>
            <div class="stat-card">
                <span class="stat-value">{{ $totalProjects ?? 0 }}</span>
                <span class="stat-label">Proyek Aktif</span>
            </div>
            <div class="stat-card">
                <span class="stat-value">{{ $productivity ?? 0 }}%</span>
                <span class="stat-label">Produktivitas</span>
            </div>
        </div>

        {{-- ── EDIT PROFILE FORM ── --}}
        <p class="section-label">Edit Profil</p>
        <div class="form-card">
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" id="profile-form">
                @csrf
                {{-- hidden fields set by avatar modal --}}
                <input type="hidden" name="avatar_url" id="avatar_url_input" value="{{ old('avatar_url', $user->avatar_url) }}">
                <input type="file" name="avatar_file" id="avatar_file_input" style="display:none" accept="image/*">

                <div class="field">
                    <label for="name">Nama</label>
                    <input id="name" name="name" type="text" value="{{ old('name', $user?->name) }}"
                        placeholder="Nama lengkap kamu" required>
                </div>

                <div class="field">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email', $user?->email) }}"
                        placeholder="email@kamu.id" required>
                </div>

                <div class="field">
                    <label for="bio">Bio</label>
                    <textarea id="bio" name="bio"
                        placeholder="Ceritain sedikit tentang kamu...">{{ old('bio', $user?->bio) }}</textarea>
                </div>

                <button class="save-btn" type="submit">Simpan Profil</button>
            </form>
        </div>

        {{-- ── MENU ── --}}
        <p class="section-label">Lainnya</p>
        <div class="menu-card">

            <a href="{{ route('projects.index') }}" class="menu-item">
                <div class="menu-item-left">
                    <div class="menu-item-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                            <line x1="18" y1="20" x2="18" y2="10" />
                            <line x1="12" y1="20" x2="12" y2="4" />
                            <line x1="6" y1="20" x2="6" y2="14" />
                        </svg>
                    </div>
                    Statistik
                </div>
                <span class="menu-chevron">›</span>
            </a>

            <a href="{{ route('projects.index') }}" class="menu-item">
                <div class="menu-item-left">
                    <div class="menu-item-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                            <path d="M9 11l3 3L22 4" />
                            <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11" />
                        </svg>
                    </div>
                    Tugas Saya
                </div>
                <span class="menu-chevron">›</span>
            </a>

            <a href="{{ route('archive') }}" class="menu-item">
                <div class="menu-item-left">
                    <div class="menu-item-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                            <polyline points="21 8 21 21 3 21 3 8" />
                            <rect x="1" y="3" width="22" height="5" />
                            <line x1="10" y1="12" x2="14" y2="12" />
                        </svg>
                    </div>
                    Arsip
                </div>
                <span class="menu-chevron">›</span>
            </a>

            <a href="{{ route('settings') }}" class="menu-item">
                <div class="menu-item-left">
                    <div class="menu-item-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="3" />
                            <path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z" />
                        </svg>
                    </div>
                    Pengaturan
                </div>
                <span class="menu-chevron">›</span>
            </a>

            <form class="menu-form" method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="menu-item logout"
                    style="width:100%;background:none;font-family:inherit;text-align:left;">
                    <div class="menu-item-left">
                        <div class="menu-item-icon">
                            <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4" />
                                <polyline points="16 17 21 12 16 7" />
                                <line x1="21" y1="12" x2="9" y2="12" />
                            </svg>
                        </div>
                        Keluar
                    </div>
                    <span class="menu-chevron">›</span>
                </button>
            </form>

        </div>

        @php
        $profileTasksProjectId = \App\Models\Project::query()->where('user_id', $user?->id)->value('id');
        @endphp

        {{-- ── SETTINGS MODAL ── --}}
        <div class="modal-backdrop" id="settings-modal" onclick="closeSettingsModal(event)">
            <div class="modal-sheet">
                <p class="modal-title">Pengaturan</p>

                {{-- Profil Gw --}}
                <div class="settings-section-title">Profil Gw</div>

                <div class="settings-profile-card">
                    <div class="settings-avatar">
                        @if($user->avatar_url)
                            <img src="{{ $user->avatar_url }}" alt="avatar">
                        @else
                            {{ strtoupper(mb_substr($user->name ?? 'W', 0, 1)) }}
                        @endif
                    </div>
                    <div class="settings-profile-info">
                        <strong>{{ $user->name ?? 'Wong' }}</strong>
                        <span>{{ $user->email ?? '' }}</span>
                        @if($user->bio)
                        <span style="display:block;margin-top:2px;font-style:italic;">{{ $user->bio }}</span>
                        @endif
                    </div>
                </div>

                <div class="settings-stats-row">
                    <div class="settings-stat">
                        <strong>{{ $totalTasks ?? 0 }}</strong>
                        <small>Total Tugas</small>
                    </div>
                    <div class="settings-stat">
                        <strong>{{ $totalProjects ?? 0 }}</strong>
                        <small>Proyek</small>
                    </div>
                    <div class="settings-stat">
                        <strong>{{ $productivity ?? 0 }}%</strong>
                        <small>Produktivitas</small>
                    </div>
                </div>

                {{-- Preferensi --}}
                <div class="settings-section-title">Preferensi</div>

                <div class="setting-row">
                    <div class="setting-label">
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
                        <input type="checkbox" id="power-save-toggle" onchange="togglePowerSave(this.checked)">
                        <span class="toggle-slider"></span>
                    </label>
                </div>

                <div class="setting-row">
                    <div class="setting-label">
                        <div class="setting-icon orange">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M18 8h1a4 4 0 010 8h-1"/>
                                <path d="M2 8h16v9a4 4 0 01-4 4H6a4 4 0 01-4-4V8z"/>
                                <line x1="6" y1="1" x2="6" y2="4"/>
                                <line x1="10" y1="1" x2="10" y2="4"/>
                                <line x1="14" y1="1" x2="14" y2="4"/>
                            </svg>
                        </div>
                        <div class="setting-text">
                            <strong>Notifikasi Deadline</strong>
                            <small>Ingatkan tugas yang mendekati deadline</small>
                        </div>
                    </div>
                    <label class="toggle-wrap">
                        <input type="checkbox" id="notif-toggle" onchange="toggleSetting('notif', this.checked)" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>

                <div class="setting-row">
                    <div class="setting-label">
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
                        <input type="checkbox" id="deadline-toggle" onchange="toggleSetting('showDeadline', this.checked)" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>

                <button class="modal-close" onclick="closeSettingsModalBtn()">Tutup</button>
            </div>
        </div>

        {{-- ── AVATAR MODAL ── --}}
        <div class="modal-backdrop" id="avatar-modal" onclick="closeAvatarModal(event)">
            <div class="modal-sheet">
                <p class="modal-title">Foto Profil</p>

                <div class="modal-tabs">
                    <button class="modal-tab active" id="tab-url" onclick="switchTab('url')">🔗 URL</button>
                    <button class="modal-tab" id="tab-upload" onclick="switchTab('upload')">📁 Upload File</button>
                </div>

                {{-- URL TAB --}}
                <div class="modal-panel active" id="panel-url">
                    <div class="url-input-wrap" style="margin-bottom:10px">
                        <img id="url-preview" class="url-preview" alt="preview">
                        <input type="url" id="url-input" class="url-input" placeholder="https://contoh.com/foto.jpg"
                               oninput="previewUrl(this.value)">
                    </div>
                    <p style="font-size:.72rem;color:var(--muted)">Tempelkan URL gambar langsung</p>
                    <button class="modal-apply-btn" onclick="applyUrl()">Gunakan URL Ini</button>
                </div>

                {{-- UPLOAD TAB --}}
                <div class="modal-panel" id="panel-upload">
                    <div class="drop-zone" id="drop-zone"
                         onclick="document.getElementById('file-picker').click()"
                         ondragover="dragOver(event)" ondragleave="dragLeave(event)" ondrop="dropFile(event)">
                        <svg class="drop-zone-icon" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                        </svg>
                        <p class="drop-zone-text">Drag & drop foto di sini</p>
                        <p class="drop-zone-sub">atau klik untuk pilih file (JPG, PNG, WebP maks. 4MB)</p>
                        <div class="drop-preview" id="drop-preview">
                            <img id="drop-preview-img" src="" alt="preview">
                            <span class="drop-preview-name" id="drop-preview-name"></span>
                        </div>
                    </div>
                    <input type="file" id="file-picker" accept="image/*" style="display:none" onchange="fileChosen(event)">
                    <button class="modal-apply-btn" onclick="applyUpload()">Gunakan Foto Ini</button>
                </div>

                <button class="modal-close" onclick="closeAvatarModalBtn()">Batal</button>
            </div>
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

            <a href="{{ $profileTasksProjectId ? route('tasks.index', ['project' => $profileTasksProjectId]) : route('projects.index') }}" class="nav-item">
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

        {{-- Avatar modal JS --}}
        <script>
        const CSRF = document.querySelector('meta[name="csrf-token"]').content;
        let chosenFile = null;

        function openAvatarModal() {
            document.getElementById('avatar-modal').classList.add('open');
        }

        function closeAvatarModal(e) {
            if (e.target === document.getElementById('avatar-modal')) closeAvatarModalBtn();
        }

        function closeAvatarModalBtn() {
            document.getElementById('avatar-modal').classList.remove('open');
            chosenFile = null;
        }

        function switchTab(tab) {
            ['url','upload'].forEach(t => {
                document.getElementById('tab-' + t).classList.toggle('active', t === tab);
                document.getElementById('panel-' + t).classList.toggle('active', t === tab);
            });
        }

        function previewUrl(url) {
            const img = document.getElementById('url-preview');
            if (!url) { img.style.display = 'none'; return; }
            img.src = url;
            img.style.display = 'block';
            img.onerror = () => { img.style.display = 'none'; };
        }

        // ── Simpan avatar via AJAX, langsung ke DB ──
        function saveAvatarUrl(url) {
            const fd = new FormData();
            fd.append('avatar_url', url);
            fd.append('_token', CSRF);
            return fetch('{{ route("profile.avatar") }}', { method: 'POST', body: fd })
                .then(r => r.json());
        }

        function saveAvatarFile(file) {
            const fd = new FormData();
            fd.append('avatar_file', file);
            fd.append('_token', CSRF);
            return fetch('{{ route("profile.avatar") }}', { method: 'POST', body: fd })
                .then(r => r.json());
        }

        function showToast(msg, ok = true) {
            let t = document.getElementById('avatar-toast');
            if (!t) {
                t = document.createElement('div');
                t.id = 'avatar-toast';
                t.style.cssText = 'position:fixed;bottom:80px;left:50%;transform:translateX(-50%);background:#2a8f43;color:#fff;padding:9px 18px;border-radius:99px;font-size:.78rem;font-weight:700;z-index:300;box-shadow:0 4px 16px rgba(0,0,0,.2);transition:opacity .3s';
                document.body.appendChild(t);
            }
            t.textContent = msg;
            t.style.background = ok ? '#2a8f43' : '#b83232';
            t.style.opacity = '1';
            clearTimeout(t._tid);
            t._tid = setTimeout(() => { t.style.opacity = '0'; }, 2500);
        }

        function applyUrl() {
            const url = document.getElementById('url-input').value.trim();
            if (!url) return;

            // Update hidden input juga (untuk form save profil)
            document.getElementById('avatar_url_input').value = url;
            document.getElementById('avatar_file_input').value = '';

            // Preview dulu
            updateAvatarPreview(url, null);
            closeAvatarModalBtn();

            // Auto-save ke DB
            saveAvatarUrl(url)
                .then(data => {
                    if (data.ok) showToast('✓ Foto profil disimpan!');
                    else showToast('Gagal menyimpan foto', false);
                })
                .catch(() => showToast('Gagal menyimpan foto', false));
        }

        function dragOver(e) {
            e.preventDefault();
            document.getElementById('drop-zone').classList.add('drag-over');
        }

        function dragLeave() {
            document.getElementById('drop-zone').classList.remove('drag-over');
        }

        function dropFile(e) {
            e.preventDefault();
            dragLeave();
            const file = e.dataTransfer.files[0];
            if (file) handleFile(file);
        }

        function fileChosen(e) {
            const file = e.target.files[0];
            if (file) handleFile(file);
        }

        function handleFile(file) {
            if (!file.type.startsWith('image/')) { alert('Pilih file gambar ya (JPG, PNG, WebP)'); return; }
            if (file.size > 4 * 1024 * 1024) { alert('Ukuran file maksimal 4MB'); return; }
            chosenFile = file;
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('drop-preview-img').src = e.target.result;
                document.getElementById('drop-preview-name').textContent = file.name;
                document.getElementById('drop-preview').style.display = 'flex';
            };
            reader.readAsDataURL(file);
        }

        function applyUpload() {
            if (!chosenFile) { alert('Pilih file dulu ya!'); return; }

            // Preview optimistic
            const reader = new FileReader();
            reader.onload = e => updateAvatarPreview(null, e.target.result);
            reader.readAsDataURL(chosenFile);

            // Transfer ke hidden input juga (untuk form)
            const dt = new DataTransfer();
            dt.items.add(chosenFile);
            document.getElementById('avatar_file_input').files = dt.files;
            document.getElementById('avatar_url_input').value = '';

            closeAvatarModalBtn();

            // Auto-save ke DB
            saveAvatarFile(chosenFile)
                .then(data => {
                    if (data.ok) {
                        showToast('✓ Foto profil disimpan!');
                        // Update hidden URL input dengan path hasil upload
                        document.getElementById('avatar_url_input').value = data.avatar_url;
                        updateAvatarPreview(data.avatar_url, null);
                    } else {
                        showToast('Gagal menyimpan foto', false);
                    }
                })
                .catch(() => showToast('Gagal menyimpan foto', false));
        }

        function updateAvatarPreview(url, dataUrl) {
            const wrap = document.querySelector('.avatar-wrap');
            const src = url || dataUrl;
            let img = wrap.querySelector('img.avatar');
            let div = wrap.querySelector('div.avatar');
            if (src) {
                if (!img) {
                    img = document.createElement('img');
                    img.className = 'avatar';
                    img.alt = 'Foto profil';
                    if (div) div.replaceWith(img);
                    else wrap.insertBefore(img, wrap.querySelector('.avatar-edit-btn'));
                }
                img.src = src;
            }
        }

        // \u2500\u2500 Settings modal \u2500\u2500
        function openSettingsModal() {
            document.getElementById('settings-modal').classList.add('open');
        }

        function closeSettingsModal(e) {
            if (e.target === document.getElementById('settings-modal')) closeSettingsModalBtn();
        }

        function closeSettingsModalBtn() {
            document.getElementById('settings-modal').classList.remove('open');
        }

        // Hemat daya: matikan semua animasi & transition
        function togglePowerSave(on) {
            document.body.classList.toggle('power-save', on);
            localStorage.setItem('wongtask_power_save', on ? '1' : '0');
        }

        // Generic setting toggle (disimpan di localStorage)
        function toggleSetting(key, val) {
            localStorage.setItem('wongtask_' + key, val ? '1' : '0');
        }

        // ── Init: baca semua preferensi dari localStorage ──
        (function initSettings() {
            // Hemat daya
            const ps = localStorage.getItem('wongtask_power_save') === '1';
            const psEl = document.getElementById('power-save-toggle');
            if (ps) { document.body.classList.add('power-save'); if (psEl) psEl.checked = true; }

            // Notifikasi
            const notif = localStorage.getItem('wongtask_notif');
            const notifEl = document.getElementById('notif-toggle');
            if (notif === '0' && notifEl) notifEl.checked = false;

            // Tampilkan Deadline
            const dl = localStorage.getItem('wongtask_showDeadline');
            const dlEl = document.getElementById('deadline-toggle');
            if (dl === '0' && dlEl) dlEl.checked = false;
        })();
        </script>

    </div>
</body>

</html>