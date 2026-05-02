{{-- ════════════════════════════════════════════
     WongTask – Settings Boot
     @include ini di setiap halaman setelah <meta charset>
     ════════════════════════════════════════════ --}}

{{-- CSRF untuk AJAX --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- Power-save: terapkan SEBELUM DOM render agar tidak flash animasi --}}
<script>
(function() {
    if (localStorage.getItem('wongtask_power_save') === '1') {
        document.documentElement.classList.add('power-save-early');
    }
})();
</script>

<style>
/* ── Power Save: disable semua animasi & transisi ── */
.power-save *, .power-save-early *,
.power-save *::before, .power-save *::after,
.power-save-early *::before, .power-save-early *::after {
    animation-duration:    0.001ms !important;
    animation-delay:       0s      !important;
    transition-duration:   0.001ms !important;
    transition-delay:      0s      !important;
}

/* ── Notifikasi Urgent Bubble ── */
#wt-notif-bubble {
    position: fixed;
    top: 14px;
    left: 50%;
    transform: translateX(-50%);
    width: calc(100% - 32px);
    max-width: 398px;
    background: #fff;
    border: 1px solid #ffd0d0;
    border-radius: 16px;
    box-shadow: 0 8px 32px rgba(0,0,0,.15);
    z-index: 600;
    overflow: hidden;
    animation: wt-slide-down .25s ease;
}

@keyframes wt-slide-down {
    from { opacity: 0; transform: translateX(-50%) translateY(-12px); }
    to   { opacity: 1; transform: translateX(-50%) translateY(0); }
}

.wt-notif-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 11px 14px 8px;
    background: #fff0f0;
}

.wt-notif-header-title {
    font-size: .78rem;
    font-weight: 800;
    color: #b83232;
    display: flex;
    align-items: center;
    gap: 6px;
}

.wt-notif-header-title svg { width: 14px; height: 14px; }

.wt-notif-close {
    background: none;
    border: none;
    cursor: pointer;
    color: #b83232;
    font-size: 1.1rem;
    line-height: 1;
    padding: 0 2px;
    font-weight: 700;
}

.wt-notif-items { padding: 6px 0; }

.wt-notif-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 7px 14px;
    text-decoration: none;
    color: inherit;
    transition: background .12s;
}

.wt-notif-item:hover { background: #fdf5f5; }

.wt-notif-dot {
    width: 8px; height: 8px;
    border-radius: 50%;
    background: #e05050;
    flex-shrink: 0;
}

.wt-notif-text { flex: 1; min-width: 0; }

.wt-notif-text strong {
    display: block;
    font-size: .8rem;
    font-weight: 700;
    color: #2e241a;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.wt-notif-text span {
    font-size: .69rem;
    color: #b83232;
    font-weight: 600;
}

.wt-notif-footer {
    padding: 7px 14px 10px;
    font-size: .72rem;
    color: #9a8c7f;
    text-align: center;
    border-top: 1px solid #ffeaea;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // 1. ── HEMAT DAYA ─────────────────────────────────────────────
    if (localStorage.getItem('wongtask_power_save') === '1') {
        document.body.classList.add('power-save');
    }
    // Sinkron toggle di halaman profil (jika ada)
    const psToggle = document.getElementById('power-save-toggle');
    if (psToggle) psToggle.checked = localStorage.getItem('wongtask_power_save') === '1';

    // 2. ── TAMPILKAN DEADLINE ─────────────────────────────────────
    const showDl = localStorage.getItem('wongtask_showDeadline');
    if (showDl === '0') {
        // Sembunyikan semua elemen bertanda kelas .task-date atau .deadline-text
        document.querySelectorAll('.task-date, .deadline-text, [data-deadline-el]')
            .forEach(el => el.style.display = 'none');
    }
    // Sinkron toggle di halaman profil
    const dlToggle = document.getElementById('deadline-toggle');
    if (dlToggle) {
        dlToggle.checked = showDl !== '0';
        dlToggle.addEventListener('change', function () {
            const on = this.checked;
            localStorage.setItem('wongtask_showDeadline', on ? '1' : '0');
            document.querySelectorAll('.task-date, .deadline-text, [data-deadline-el]')
                .forEach(el => el.style.display = on ? '' : 'none');
        });
    }

    // 3. ── NOTIFIKASI DEADLINE ────────────────────────────────────
    const notifEnabled = localStorage.getItem('wongtask_notif') !== '0';
    const notifToggle  = document.getElementById('notif-toggle');
    if (notifToggle) notifToggle.checked = notifEnabled;

    if (notifEnabled) {
        fetch('/notifications/urgent', {
            headers: { 'Accept': 'application/json' }
        })
        .then(r => r.ok ? r.json() : null)
        .then(data => {
            if (!data || !data.authenticated || !data.tasks || data.tasks.length === 0) return;
            buildNotifBubble(data.tasks);
        })
        .catch(() => {});
    }

    // Sinkron power-save toggle handler (di profil)
    const psToggleEl = document.getElementById('power-save-toggle');
    if (psToggleEl && !psToggleEl._bound) {
        psToggleEl._bound = true;
        psToggleEl.addEventListener('change', function() {
            const on = this.checked;
            document.body.classList.toggle('power-save', on);
            localStorage.setItem('wongtask_power_save', on ? '1' : '0');
        });
    }

    // Sinkron notif toggle handler
    const notifToggleEl = document.getElementById('notif-toggle');
    if (notifToggleEl && !notifToggleEl._bound) {
        notifToggleEl._bound = true;
        notifToggleEl.addEventListener('change', function() {
            localStorage.setItem('wongtask_notif', this.checked ? '1' : '0');
        });
    }
});

function buildNotifBubble(tasks) {
    if (document.getElementById('wt-notif-bubble')) return;

    const shown = tasks.slice(0, 3);
    const extra = tasks.length - shown.length;

    const items = shown.map(t => {
        const url = t.url || '#';
        return `<a class="wt-notif-item" href="${url}">
            <div class="wt-notif-dot"></div>
            <div class="wt-notif-text">
                <strong>${escHtml(t.title)}</strong>
                <span>${escHtml(t.project_name || '')} · ${escHtml(t.deadline_label || '')}</span>
            </div>
        </a>`;
    }).join('');

    const footer = extra > 0
        ? `<div class="wt-notif-footer">+${extra} tugas urgent lainnya</div>`
        : '';

    const el = document.createElement('div');
    el.id = 'wt-notif-bubble';
    el.innerHTML = `
        <div class="wt-notif-header">
            <span class="wt-notif-header-title">
                <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                    <line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>
                </svg>
                ${tasks.length} Tugas Mendekati Deadline!
            </span>
            <button class="wt-notif-close" onclick="document.getElementById('wt-notif-bubble').remove()">×</button>
        </div>
        <div class="wt-notif-items">${items}</div>
        ${footer}
    `;
    document.body.appendChild(el);

    // Auto-dismiss setelah 7 detik
    setTimeout(() => { if (el.parentNode) el.remove(); }, 7000);
}

function escHtml(str) {
    const d = document.createElement('div');
    d.textContent = str;
    return d.innerHTML;
}
</script>
