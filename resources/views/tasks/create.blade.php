<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tugas - WongTask</title>
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
        --text: #2c231a;
        --muted: #9a8e81;
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
        padding: 0 0 100px;
    }

    /* ── HEADER ── */
    .header {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 50px 20px 16px;
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
        color: var(--text);
        flex-shrink: 0;
        transition: border-color .15s;
    }

    .back-btn:hover {
        border-color: var(--brand);
        color: var(--brand);
    }

    .back-btn svg {
        width: 17px;
        height: 17px;
    }

    .header h1 {
        font-size: 1.4rem;
        font-weight: 800;
        letter-spacing: -.3px;
    }

    /* ── FORM CARD ── */
    .form-wrap {
        padding: 0 16px;
    }

    .field {
        margin-bottom: 13px;
    }

    .field label {
        display: block;
        margin-bottom: 6px;
        font-size: .73rem;
        color: var(--muted);
        font-weight: 700;
        letter-spacing: .3px;
        text-transform: uppercase;
    }

    .field input,
    .field textarea,
    .field select {
        width: 100%;
        border: 1px solid var(--line);
        border-radius: 12px;
        padding: 11px 13px;
        background: var(--card);
        font-family: inherit;
        font-size: .86rem;
        color: var(--text);
        outline: none;
        transition: border-color .15s, box-shadow .15s;
        -webkit-appearance: none;
    }

    .field input:focus,
    .field textarea:focus,
    .field select:focus {
        border-color: var(--brand);
        box-shadow: 0 0 0 3px rgba(122, 75, 35, .1);
    }

    .field input::placeholder,
    .field textarea::placeholder {
        color: #c0b4a8;
    }

    .field textarea {
        min-height: 90px;
        resize: vertical;
    }

    /* Select arrow */
    .select-wrap {
        position: relative;
    }

    .select-wrap::after {
        content: '';
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        width: 0;
        height: 0;
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
        border-top: 6px solid var(--muted);
        pointer-events: none;
    }

    /* ── PRIORITY PILLS ── */
    .priority-group {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 8px;
    }

    .priority-group label {
        margin: 0;
        cursor: pointer;
    }

    .priority-group input[type="radio"] {
        display: none;
    }

    .pill {
        display: block;
        border: 1.5px solid var(--line);
        border-radius: 11px;
        padding: 10px 8px;
        text-align: center;
        font-size: .8rem;
        font-weight: 700;
        font-family: inherit;
        background: var(--card);
        color: var(--muted);
        cursor: pointer;
        transition: background .15s, color .15s, border-color .15s;
        user-select: none;
    }

    .priority-group input[type="radio"]:checked+.pill {
        background: var(--brand);
        color: #fff;
        border-color: var(--brand);
    }

    .pill:hover {
        border-color: var(--brand);
        color: var(--brand);
    }

    .priority-group input:checked+.pill:hover {
        color: #fff;
    }

    /* ── DIVIDER ── */
    .divider {
        height: 1px;
        background: var(--line);
        margin: 6px 0 14px;
    }

    /* ── SUBMIT ── */
    .submit-btn {
        width: 100%;
        border: none;
        border-radius: 13px;
        background: var(--brand);
        color: #fff;
        padding: 14px;
        font-size: .95rem;
        font-weight: 800;
        font-family: inherit;
        cursor: pointer;
        margin-top: 6px;
        letter-spacing: .2px;
        transition: background .15s, transform .1s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .submit-btn svg {
        width: 18px;
        height: 18px;
    }

    .submit-btn:hover {
        background: var(--brand-light);
    }

    .submit-btn:active {
        transform: scale(.98);
    }

    /* ── SECTION LABEL ── */
    .section-label {
        font-size: .7rem;
        font-weight: 700;
        color: var(--muted);
        letter-spacing: .5px;
        text-transform: uppercase;
        margin-bottom: 10px;
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

    .form-wrap {
        animation: fadeUp .22s ease .05s both;
    }
    </style>
</head>

<body>
    <div class="phone">

        {{-- ── HEADER ── --}}
        <div class="header">
            <a href="{{ route('projects.index') }}" class="back-btn">
                <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M19 12H5M12 5l-7 7 7 7" />
                </svg>
            </a>
            <h1>Tambah Tugas</h1>
        </div>

        {{-- ── FORM ── --}}
        <div class="form-wrap">
            <form method="POST" action="{{ route('tasks.store.form') }}">
                @csrf

                {{-- Judul --}}
                <div class="field">
                    <label for="title">Judul Tugas</label>
                    <input id="title" name="title" value="{{ old('title') }}" placeholder="Contoh: Buat fitur komentar"
                        required>
                </div>

                {{-- Proyek --}}
                <div class="field">
                    <label for="project_id">Proyek</label>
                    <div class="select-wrap">
                        <select id="project_id" name="project_id" required>
                            @forelse($projects as $project)
                            <option value="{{ $project->id }}"
                                {{ (int) $selectedProjectId === (int) $project->id ? 'selected' : '' }}>
                                {{ $project->name }}
                            </option>
                            @empty
                            <option value="">Belum ada proyek</option>
                            @endforelse
                        </select>
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div class="field">
                    <label for="description">Deskripsi</label>
                    <textarea id="description" name="description"
                        placeholder="Jelaskan detail tugas ini...">{{ old('description') }}</textarea>
                </div>

                <div class="divider"></div>

                {{-- Prioritas --}}
                <div class="field">
                    <label>Prioritas</label>
                    <div class="priority-group">
                        <label>
                            <input type="radio" name="priority" value="low"
                                {{ old('priority', 'medium') === 'low' ? 'checked' : '' }}>
                            <span class="pill">Rendah</span>
                        </label>
                        <label>
                            <input type="radio" name="priority" value="medium"
                                {{ old('priority', 'medium') === 'medium' ? 'checked' : '' }}>
                            <span class="pill">Sedang</span>
                        </label>
                        <label>
                            <input type="radio" name="priority" value="high"
                                {{ old('priority', 'medium') === 'high' ? 'checked' : '' }}>
                            <span class="pill">Tinggi</span>
                        </label>
                    </div>
                </div>

                {{-- Deadline --}}
                <div class="field">
                    <label for="deadline">Deadline</label>
                    <input id="deadline" type="date" name="deadline" value="{{ old('deadline') }}">
                </div>

                {{-- Assignee (opsional) --}}
                <div class="field">
                    <label for="assignee_name">Assignee</label>
                    <input id="assignee_name" name="assignee_name" value="{{ old('assignee_name') }}"
                        placeholder="Tulis nama assignee...">
                </div>

                {{-- Status Awal --}}
                <div class="field">
                    <label for="status">Status Awal</label>
                    <div class="select-wrap">
                        <select id="status" name="status">
                            <option value="todo" {{ old('status','todo') === 'todo'        ? 'selected' : '' }}>To Do
                            </option>
                            <option value="in_progress" {{ old('status','todo') === 'in_progress' ? 'selected' : '' }}>
                                In Progress</option>
                            <option value="done" {{ old('status','todo') === 'done'        ? 'selected' : '' }}>Done
                            </option>
                        </select>
                    </div>
                </div>

                {{-- Submit --}}
                <button class="submit-btn" type="submit">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z" />
                        <polyline points="17 21 17 13 7 13 7 21" />
                        <polyline points="7 3 7 8 15 8" />
                    </svg>
                    Simpan Tugas
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

            <a href="{{ route('tasks.create') }}" class="nav-item active">
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