<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    @include('partials.settings-boot')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WongTask – Beranda</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: #F0E6D3;
        min-height: 100vh;
    }

    :root {
        --brown: #5C3317;
        --brown-dark: #3E200E;
        --brown-mid: #7A4528;
        --cream: #FDFAF5;
        --cream-bg: #F5EDE0;
        --orange: #E07B39;
        --yellow: #F5C842;
        --green: #4CAF50;
        --blue: #1976D2;
        --red: #E53935;
        --text: #2C1A0E;
        --muted: #9E8272;
        --border: #EAE0D5;
    }

    /* ── Wrapper ── */
    .wrap {
        max-width: 430px;
        margin: 0 auto;
        background: var(--cream-bg);
        min-height: 100vh;
        position: relative;
        overflow-x: hidden;
        padding-bottom: 80px;
    }

    /* ── Scrollbar ── */
    ::-webkit-scrollbar {
        width: 3px;
    }

    ::-webkit-scrollbar-thumb {
        background: var(--border);
        border-radius: 99px;
    }

    /* ══════════════════════════════
       TOP HEADER
    ══════════════════════════════ */
    .header {
        background: var(--brown);
        padding: 48px 20px 80px;
        position: relative;
        border-radius: 0 0 36px 36px;
        overflow: hidden;
    }

    .header::before {
        content: '';
        position: absolute;
        width: 220px;
        height: 220px;
        background: rgba(255, 255, 255, .06);
        border-radius: 50%;
        top: -70px;
        right: -50px;
    }

    .header::after {
        content: '';
        position: absolute;
        width: 130px;
        height: 130px;
        background: rgba(255, 255, 255, .04);
        border-radius: 50%;
        bottom: -30px;
        left: 10px;
    }

    .header-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 22px;
        position: relative;
        z-index: 2;
    }

    .icon-btn {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .16);
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: #fff;
        text-decoration: none;
        transition: background .2s;
    }

    .icon-btn:hover {
        background: rgba(255, 255, 255, .24);
    }

    .header-right {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .notif-wrap {
        position: relative;
    }

    .notif-dot {
        width: 8px;
        height: 8px;
        background: var(--orange);
        border-radius: 50%;
        position: absolute;
        top: 7px;
        right: 7px;
        border: 1.5px solid var(--brown);
    }

    .notif-badge {
        position: absolute;
        top: -5px;
        right: -4px;
        min-width: 18px;
        height: 18px;
        padding: 0 4px;
        border-radius: 99px;
        background: var(--orange);
        color: #fff;
        font-size: .62rem;
        font-weight: 800;
        display: none;
        align-items: center;
        justify-content: center;
        border: 2px solid var(--brown);
    }

    .notif-badge.show {
        display: inline-flex;
    }

    /* Greeting */
    .greeting {
        position: relative;
        z-index: 2;
    }

    .greeting h1 {
        color: #fff;
        font-size: 1.35rem;
        font-weight: 800;
        margin-bottom: 4px;
    }

    .greeting p {
        color: rgba(255, 255, 255, .7);
        font-size: .83rem;
    }

    /* ── Clock ── */
    .clock-box {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        margin-top: 14px;
        background: rgba(255, 255, 255, .12);
        border: 1px solid rgba(255, 255, 255, .18);
        backdrop-filter: blur(6px);
        border-radius: 14px;
        padding: 8px 14px;
    }

    .clock-time {
        font-size: 1.55rem;
        font-weight: 800;
        color: #fff;
        letter-spacing: 2px;
        font-variant-numeric: tabular-nums;
        line-height: 1;
    }

    .clock-time .clock-colon {
        opacity: 1;
        animation: blinkColon 1s step-start infinite;
    }

    @keyframes blinkColon {
        0%, 100% { opacity: 1; }
        50%       { opacity: 0.25; }
    }

    .clock-divider {
        width: 1px;
        height: 28px;
        background: rgba(255, 255, 255, .25);
        border-radius: 99px;
    }

    .clock-right {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .clock-date {
        font-size: .72rem;
        font-weight: 700;
        color: rgba(255, 255, 255, .9);
        white-space: nowrap;
    }

    .clock-day {
        font-size: .65rem;
        color: rgba(255, 255, 255, .6);
        font-weight: 600;
    }



    /* ══════════════════════════════
       RINGKASAN CARD
    ══════════════════════════════ */
    .summary-card {
        margin: 16px 16px 0;
        background: #fff;
        border-radius: 20px;
        padding: 16px 8px 14px;
        box-shadow: 0 4px 20px rgba(92, 61, 46, .1);
        position: relative;
        z-index: 10;
    }

    .summary-label {
        font-size: .78rem;
        font-weight: 700;
        color: var(--text);
        padding: 0 8px 12px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .summary-label a {
        color: var(--brown-mid);
        font-size: .74rem;
        text-decoration: none;
        font-weight: 600;
    }

    .summary-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
    }

    .summary-item {
        text-align: center;
        padding: 4px 6px 2px;
    }

    .summary-item+.summary-item {
        border-left: 1px solid var(--border);
    }

    .summary-num {
        font-size: 1.6rem;
        font-weight: 800;
        color: var(--text);
        line-height: 1;
        margin-bottom: 4px;
    }

    .summary-num.green {
        color: var(--green);
    }

    .summary-num.orange {
        color: var(--orange);
    }

    .summary-sub {
        font-size: .7rem;
        color: var(--muted);
        font-weight: 500;
    }

    /* ══════════════════════════════
       GRAPH CARD
    ══════════════════════════════ */
    .graph-card {
        margin: 16px 16px 0;
        background: linear-gradient(180deg, #fff 0%, #fffaf4 100%);
        border-radius: 20px;
        padding: 16px;
        box-shadow: 0 4px 20px rgba(92, 61, 46, .08);
        border: 1px solid rgba(234, 224, 213, .8);
    }

    .graph-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 14px;
    }

    .graph-title {
        font-size: .82rem;
        font-weight: 800;
        color: var(--text);
        margin-bottom: 3px;
    }

    .graph-subtitle {
        font-size: .72rem;
        color: var(--muted);
        line-height: 1.4;
    }

    .graph-legend {
        font-size: .68rem;
        font-weight: 700;
        color: var(--brown-mid);
        background: var(--cream-bg);
        padding: 6px 10px;
        border-radius: 999px;
        white-space: nowrap;
    }

    .graph-wrap {
        display: grid;
        grid-template-columns: repeat(7, minmax(0, 1fr));
        gap: 8px;
        align-items: end;
        min-height: 132px;
        padding-top: 6px;
    }

    .graph-col {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
        min-width: 0;
    }

    .graph-bar-track {
        width: 100%;
        min-height: 96px;
        display: flex;
        align-items: flex-end;
        justify-content: center;
        position: relative;
    }

    .graph-bar {
        width: 100%;
        max-width: 18px;
        border-radius: 999px 999px 8px 8px;
        background: linear-gradient(180deg, rgba(224, 123, 57, .16), rgba(224, 123, 57, .32));
        position: relative;
        overflow: hidden;
        box-shadow: inset 0 -1px 0 rgba(255, 255, 255, .3);
    }

    .graph-bar > span {
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        border-radius: inherit;
        background: linear-gradient(180deg, #F5C842 0%, #E07B39 100%);
        box-shadow: 0 8px 16px rgba(224, 123, 57, .18);
    }

    .graph-value {
        position: absolute;
        top: -22px;
        left: 50%;
        transform: translateX(-50%);
        font-size: .66rem;
        font-weight: 800;
        color: var(--text);
        background: rgba(255, 255, 255, .92);
        padding: 2px 6px;
        border-radius: 999px;
        box-shadow: 0 2px 8px rgba(92, 61, 46, .08);
    }

    .graph-label {
        font-size: .66rem;
        color: var(--muted);
        font-weight: 700;
    }

    .graph-empty {
        grid-column: 1 / -1;
        text-align: center;
        padding: 16px 10px 8px;
        color: var(--muted);
        font-size: .8rem;
    }

    /* ══════════════════════════════
       SECTION HEADER
    ══════════════════════════════ */
    .sec-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 20px 10px;
    }

    .sec-head h2 {
        font-size: .93rem;
        font-weight: 700;
        color: var(--text);
    }

    .sec-head a {
        font-size: .76rem;
        color: var(--brown-mid);
        font-weight: 600;
        text-decoration: none;
    }

    /* ══════════════════════════════
       PROJECT CARDS
    ══════════════════════════════ */
    .proj-list {
        padding: 0 16px;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .proj-card {
        background: #fff;
        border-radius: 16px;
        padding: 14px 16px;
        display: flex;
        align-items: center;
        gap: 14px;
        box-shadow: 0 2px 10px rgba(92, 61, 46, .07);
        border: 1px solid var(--border);
        text-decoration: none;
        transition: transform .18s, box-shadow .18s;
    }

    .proj-card:active {
        transform: scale(.98);
    }

    .proj-card:hover {
        box-shadow: 0 4px 18px rgba(92, 61, 46, .14);
    }

    .proj-icon {
        width: 46px;
        height: 46px;
        border-radius: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        font-weight: 800;
        flex-shrink: 0;
    }

    .proj-body {
        flex: 1;
        min-width: 0;
    }

    .proj-name {
        font-size: .9rem;
        font-weight: 700;
        color: var(--text);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-bottom: 2px;
    }

    .proj-meta {
        font-size: .73rem;
        color: var(--muted);
        margin-bottom: 7px;
    }

    .prog-track {
        background: var(--cream-bg);
        border-radius: 99px;
        height: 5px;
        overflow: hidden;
    }

    .prog-fill {
        height: 100%;
        border-radius: 99px;
        transition: width .5s ease;
    }

    .proj-pct {
        font-size: .72rem;
        font-weight: 700;
        color: var(--muted);
        flex-shrink: 0;
    }

    /* ══════════════════════════════
       TASK ITEMS
    ══════════════════════════════ */
    .task-list {
        padding: 0 16px;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .task-item {
        background: #fff;
        border-radius: 14px;
        padding: 12px 14px;
        display: flex;
        align-items: center;
        gap: 12px;
        box-shadow: 0 2px 8px rgba(92, 61, 46, .06);
        border: 1px solid var(--border);
        text-decoration: none;
        color: inherit;
        transition: transform .15s, box-shadow .18s, border-color .18s;
        position: relative;
        overflow: hidden;
    }

    .task-item:active {
        transform: scale(.99);
    }

    .task-item:hover {
        box-shadow: 0 6px 18px rgba(92, 61, 46, .12);
        border-color: rgba(224, 123, 57, .35);
    }

    .task-item.is-progress::after {
        content: '';
        position: absolute;
        left: 14px;
        right: 14px;
        bottom: 8px;
        height: 4px;
        border-radius: 99px;
        background: rgba(224, 123, 57, .14);
        opacity: 0;
        transform: translateY(4px);
        transition: opacity .18s ease, transform .18s ease;
    }

    .task-item.is-progress:hover::after {
        opacity: 1;
        transform: translateY(0);
    }

    .task-item.is-progress .task-progress {
        position: absolute;
        left: 14px;
        right: 14px;
        bottom: 8px;
        height: 4px;
        border-radius: 99px;
        background: rgba(224, 123, 57, .14);
        overflow: hidden;
        opacity: 0;
        transform: translateY(4px);
        transition: opacity .18s ease, transform .18s ease;
        pointer-events: none;
    }

    .task-item.is-progress:hover .task-progress {
        opacity: 1;
        transform: translateY(0);
    }

    .task-item.is-progress .task-progress span {
        display: block;
        width: 64%;
        height: 100%;
        border-radius: 99px;
        background: linear-gradient(90deg, var(--orange), #F5C842);
        box-shadow: 0 0 12px rgba(224, 123, 57, .35);
        animation: taskBarFlow 1.8s ease-in-out infinite;
    }

    @keyframes taskBarFlow {

        0%,
        100% {
            transform: translateX(-10%);
        }

        50% {
            transform: translateX(10%);
        }
    }

    @media (hover: none) {

        .task-item.is-progress .task-progress,
        .task-item.is-progress::after {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .task-check {
        width: 22px;
        height: 22px;
        border-radius: 7px;
        border: 2px solid var(--border);
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background .2s, border-color .2s;
    }

    .task-check.done {
        background: var(--green);
        border-color: var(--green);
    }

    .task-check.done svg {
        display: block !important;
    }

    .task-check svg {
        display: none;
        color: #fff;
    }

    .task-body {
        flex: 1;
        min-width: 0;
    }

    .task-title {
        font-size: .87rem;
        font-weight: 600;
        color: var(--text);
        margin-bottom: 2px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .task-title.striked {
        text-decoration: line-through;
        color: var(--muted);
    }

    .task-due {
        font-size: .72rem;
        color: var(--muted);
        display: flex;
        align-items: center;
        gap: 3px;
    }

    .badge {
        font-size: .63rem;
        font-weight: 700;
        padding: 3px 9px;
        border-radius: 99px;
        flex-shrink: 0;
    }

    .b-todo {
        background: #FFF3E0;
        color: #E07B39;
    }

    .b-prog {
        background: #E3F2FD;
        color: #1976D2;
    }

    .b-done {
        background: #E8F5E9;
        color: #388E3C;
    }

    .b-high {
        background: #FFEBEE;
        color: #E53935;
    }

    /* ══════════════════════════════
       QUOTE BOX
    ══════════════════════════════ */
    .quote {
        margin: 16px 16px 0;
        background: linear-gradient(135deg, var(--brown), var(--brown-dark));
        border-radius: 18px;
        padding: 18px 22px;
        color: rgba(255, 255, 255, .85);
        font-size: .82rem;
        font-style: italic;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .quote::before {
        content: '"';
        position: absolute;
        font-size: 6rem;
        font-style: normal;
        color: rgba(255, 255, 255, .06);
        line-height: 1;
        top: -12px;
        left: 10px;
    }

    /* ══════════════════════════════
       EMPTY STATE
    ══════════════════════════════ */
    .empty {
        text-align: center;
        padding: 22px;
        color: var(--muted);
        font-size: .82rem;
    }

    /* ══════════════════════════════
       FAB
    ══════════════════════════════ */
    .fab {
        position: fixed;
        bottom: 80px;
        right: calc(50% - 215px + 16px);
        width: 54px;
        height: 54px;
        border-radius: 50%;
        background: var(--brown);
        border: none;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 6px 22px rgba(92, 61, 46, .4);
        cursor: pointer;
        z-index: 100;
        text-decoration: none;
        transition: transform .15s, box-shadow .15s;
    }

    .fab:active {
        transform: scale(.91);
    }

    .fab:hover {
        box-shadow: 0 8px 28px rgba(92, 61, 46, .5);
    }

    /* ══════════════════════════════
       BOTTOM NAV
    ══════════════════════════════ */
    .bot-nav {
        position: fixed;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100%;
        max-width: 430px;
        background: #fff;
        border-top: 1px solid var(--border);
        display: flex;
        justify-content: space-around;
        align-items: center;
        height: 66px;
        z-index: 99;
        padding: 0 8px;
    }

    .nav-a {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 3px;
        color: var(--muted);
        text-decoration: none;
        flex: 1;
        padding: 8px 0;
        font-size: .64rem;
        font-weight: 600;
        transition: color .15s;
    }

    .nav-a svg {
        width: 22px;
        height: 22px;
    }

    .nav-a.on {
        color: var(--brown);
    }

    .nav-dot {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: var(--brown);
        margin: 0 auto;
    }

    /* ══════════════════════════════
       NOTIFICATION MODAL
    ══════════════════════════════ */
    .notif-modal {
        position: fixed;
        inset: 0;
        background: rgba(20, 12, 6, .55);
        display: none;
        align-items: flex-end;
        justify-content: center;
        z-index: 200;
        padding: 16px 12px;
        backdrop-filter: blur(8px);
    }

    .notif-modal.open {
        display: flex;
    }

    .notif-sheet {
        width: 100%;
        max-width: 430px;
        background: #fff;
        border-radius: 24px;
        padding: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, .28);
        max-height: 75vh;
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .nsh-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
    }

    .nsh-title {
        font-size: 1rem;
        font-weight: 800;
        color: var(--text);
    }

    .nsh-sub {
        margin-top: 3px;
        font-size: .77rem;
        color: var(--muted);
    }

    .nsh-close {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        border: none;
        background: var(--cream-bg);
        color: var(--text);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        flex-shrink: 0;
    }

    .nsh-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
        overflow: auto;
    }

    .nsh-item {
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 12px 14px;
        display: flex;
        gap: 12px;
        align-items: flex-start;
        text-decoration: none;
        color: inherit;
        transition: transform .15s;
    }

    .nsh-item:active {
        transform: scale(.99);
    }

    .nsh-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        margin-top: 6px;
        flex-shrink: 0;
        background: var(--orange);
        box-shadow: 0 0 0 6px rgba(224, 123, 57, .12);
    }

    .nsh-body {
        flex: 1;
        min-width: 0;
    }

    .nsh-item-title {
        font-size: .88rem;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 3px;
    }

    .nsh-item-meta {
        font-size: .73rem;
        color: var(--muted);
        margin-bottom: 8px;
    }

    .nsh-item-foot {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: .71rem;
        color: var(--brown-mid);
        font-weight: 700;
    }

    .nsh-empty {
        border: 1px dashed var(--border);
        border-radius: 14px;
        padding: 18px;
        text-align: center;
        color: var(--muted);
        font-size: .82rem;
        line-height: 1.5;
    }

    /* ── Responsive clamp ── */
    @media (max-width: 430px) {
        .fab {
            right: 16px;
        }
    }
    </style>
</head>

<body>
    <div class="wrap">

        @php
        $urgentTasks = $urgentTasks ?? collect();
        $primaryProject = $projects->first() ?? null;
        @endphp

        {{-- ════════ TOP HEADER ════════ --}}
        <div class="header">
            <div class="header-row">
                {{-- Menu --}}
                <a class="icon-btn" href="{{ auth()->check() ? route('projects.index') : route('register') }}"
                    aria-label="Menu">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5"
                        viewBox="0 0 24 24">
                        <line x1="3" y1="6" x2="21" y2="6" />
                        <line x1="3" y1="12" x2="21" y2="12" />
                        <line x1="3" y1="18" x2="16" y2="18" />
                    </svg>
                </a>

                <div class="header-right">
                    {{-- Notification --}}
                    <div class="notif-wrap">
                        <button class="icon-btn" type="button" aria-label="Notifikasi urgent" data-notif-open
                            data-notif-endpoint="{{ route('notifications.urgent') }}">
                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5"
                                viewBox="0 0 24 24">
                                <path d="M18 8a6 6 0 00-12 0c0 7-3 9-3 9h18s-3-2-3-9" />
                                <path d="M13.73 21a2 2 0 01-3.46 0" />
                            </svg>
                            <span class="notif-dot"></span>
                            <span class="notif-badge" data-notif-count>0</span>
                        </button>
                    </div>

                    {{-- Avatar --}}
                    <a class="icon-btn" href="{{ auth()->check() ? route('profile') : route('register') }}"
                        aria-label="Profil">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5"
                            viewBox="0 0 24 24">
                            <circle cx="12" cy="8" r="4" />
                            <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Greeting --}}
            <div class="greeting">
                <h1>Halo, {{ $user->name ?? 'User' }} 👋</h1>
                <p>Semangat ya ngerjain tugas hari ini!</p>

                {{-- Realtime Clock --}}
                <div class="clock-box">
                    <div class="clock-time" id="clockTime">
                        <span id="clockH">--</span><span class="clock-colon">:</span><span id="clockM">--</span><span class="clock-colon">:</span><span id="clockS">--</span>
                    </div>
                    <div class="clock-divider"></div>
                    <div class="clock-right">
                        <div class="clock-date" id="clockDate">---</div>
                        <div class="clock-day" id="clockDay">---</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ════════ RINGKASAN HARI INI ════════ --}}
        <div class="summary-card">
            <div class="summary-label">
                Ringkasan Hari Ini
                <a href="{{ route('projects.index') }}">›</a>
            </div>
            <div class="summary-grid">
                <div class="summary-item">
                    <div class="summary-num">{{ $totalTasks }}</div>
                    <div class="summary-sub">Tugas<br>Semua</div>
                </div>
                <div class="summary-item">
                    <div class="summary-num green">{{ $doneTasks }}</div>
                    <div class="summary-sub">Selesai<br>Hari ini</div>
                </div>
                <div class="summary-item">
                    <div class="summary-num orange">{{ $pendingTasks }}</div>
                    <div class="summary-sub">Tertunda<br>Hari ini</div>
                </div>
            </div>
        </div>

        {{-- ════════ PROYEK AKTIF ════════ --}}
        <div class="sec-head">
            <h2>Proyek Aktif</h2>
            <a href="{{ route('projects.index') }}">Lihat semua</a>
        </div>

        <div class="proj-list">
            @php
            $iconColors = ['#5C3D2E','#E07B39','#F5C842','#4CAF50','#1976D2','#9C27B0'];
            $iconBg = ['#F5EFE6','#FFF3E0','#FFFDE7','#E8F5E9','#E3F2FD','#F3E5F5'];
            @endphp

            @forelse($projects as $project)
            @php
            $total = max($project->tasks_count, 1);
            $done = $project->done_tasks_count ?? 0;
            $pct = round(($done / $total) * 100);
            $ci = $loop->index % count($iconColors);
            @endphp
            <a href="{{ route('projects.show', $project->id) }}" class="proj-card">
                <div class="proj-icon" style="background:{{ $iconBg[$ci] }}; color:{{ $iconColors[$ci] }};">
                    {{ mb_strtoupper(mb_substr($project->name, 0, 1)) }}
                </div>
                <div class="proj-body">
                    <div class="proj-name">{{ $project->name }}</div>
                    <div class="proj-meta">{{ $done }}/{{ $project->tasks_count }} tugas</div>
                    <div class="prog-track">
                        <div class="prog-fill" style="width:{{ $pct }}%; background:{{ $iconColors[$ci] }};"></div>
                    </div>
                </div>
                <div class="proj-pct">{{ $pct }}%</div>
            </a>
            @empty
            <div class="empty">Belum ada proyek aktif.</div>
            @endforelse
        </div>

        {{-- ════════ TUGAS HARI INI ════════ --}}
        <div class="sec-head">
            <h2>Tugas Hari Ini</h2>
            <a href="{{ $primaryProject
                ? route('projects.show', ['project' => $primaryProject->id, 'tab' => 'tasks'])
                : route('projects.index') }}">Lihat semua</a>
        </div>

        <div class="task-list">
            @forelse($todayTasks as $task)
            @php
            $isDone = $task->status === 'done';
            $isProgress = $task->status === 'in_progress';
            $isHigh = ($task->priority ?? '') === 'high';
            @endphp
            <a href="{{ route('tasks.show', $task->id) }}" class="task-item {{ $isProgress ? 'is-progress' : '' }}">
                <div class="task-check {{ $isDone ? 'done' : '' }}">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12" />
                    </svg>
                </div>
                <div class="task-body">
                    <div class="task-title {{ $isDone ? 'striked' : '' }}">{{ $task->title }}</div>
                    @if($task->deadline)
                    <div class="task-due">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5">
                            <rect x="3" y="4" width="18" height="18" rx="3" />
                            <line x1="16" y1="2" x2="16" y2="6" />
                            <line x1="8" y1="2" x2="8" y2="6" />
                            <line x1="3" y1="10" x2="21" y2="10" />
                        </svg>
                        {{ \Carbon\Carbon::parse($task->deadline)->translatedFormat('d M Y') }}
                    </div>
                    @endif
                </div>
                @if($isDone)
                <span class="badge b-done">
                    <svg width="9" height="9" fill="none" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg>
                    Done
                </span>
                @elseif($isProgress)
                <span class="badge b-prog">● Progress</span>
                @elseif($isHigh)
                <span class="badge b-high">! Urgent</span>
                @else
                <span class="badge b-todo">
                    <svg width="8" height="8" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="8"/></svg>
                    To Do
                </span>
                @endif
                @if($isProgress)
                <div class="task-progress" aria-hidden="true"><span></span></div>
                @endif
            </a>
            @empty
            <div class="empty">
                <svg width="32" height="32" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" style="display:block;margin:0 auto 8px;color:#c8bfb5">
                    <path d="M9 11l3 3L22 4"/>
                    <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/>
                </svg>
                Tidak ada tugas untuk hari ini
            </div>
            @endforelse
        </div>

        {{-- ════════ QUOTE ════════ --}}
        <div class="quote">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"
                 style="display:inline-block;vertical-align:middle;margin-right:6px;opacity:.7">
                <path d="M22 11.08V12a10 10 0 11-5.93-9.14"/>
                <polyline points="22 4 12 14.01 9 11.01"/>
            </svg>
            Santai tapi selesai
        </div>

        <div style="height:90px;"></div>

        {{-- ════════ FAB ════════ --}}
        <a href="{{ route('tasks.create', ['project_id' => $primaryProject?->id]) }}" class="fab"
            aria-label="Tambah Tugas">
            <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                viewBox="0 0 24 24">
                <line x1="12" y1="5" x2="12" y2="19" />
                <line x1="5" y1="12" x2="19" y2="12" />
            </svg>
        </a>

        {{-- ════════ BOTTOM NAV ════════ --}}
        <nav class="bot-nav">
            <a href="{{ route('home') }}" class="nav-a on">
                <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                    <polyline points="9 22 9 12 15 12 15 22" />
                </svg>
                Beranda
                <span class="nav-dot"></span>
            </a>
            <a href="{{ route('projects.index') }}" class="nav-a">
                <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <rect x="2" y="3" width="20" height="14" rx="2" />
                    <line x1="8" y1="21" x2="16" y2="21" />
                    <line x1="12" y1="17" x2="12" y2="21" />
                </svg>
                Proyek
            </a>
            <a href="{{ $primaryProject
                ? route('projects.show', ['project' => $primaryProject->id, 'tab' => 'tasks'])
                : route('projects.index') }}" class="nav-a">
                <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <path d="M9 11l3 3L22 4" />
                    <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11" />
                </svg>
                Tugas
            </a>
            <a href="{{ route('calendar') }}" class="nav-a">
                <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <rect x="3" y="4" width="18" height="18" rx="2" />
                    <line x1="16" y1="2" x2="16" y2="6" />
                    <line x1="8" y1="2" x2="8" y2="6" />
                    <line x1="3" y1="10" x2="21" y2="10" />
                </svg>
                Kalender
            </a>
            <a href="{{ route('profile') }}" class="nav-a">
                <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <circle cx="12" cy="8" r="4" />
                    <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
                </svg>
                Profil
            </a>
        </nav>

        {{-- ════════ NOTIFICATION MODAL ════════ --}}

        {{-- ════════ GRAFIK MINGGUAN ════════ --}}
        @php
        $activityChart = collect($activityChart ?? []);
        $maxActivityValue = max(1, (int) ($activityChart->max('value') ?? 0));
        @endphp
        <div class="graph-card">
            <div class="graph-head">
                <div>
                    <div class="graph-title">Grafik Aktivitas 7 Hari</div>
                    <div class="graph-subtitle">Pergerakan tugas yang dibuat dalam seminggu terakhir.</div>
                </div>
                <div class="graph-legend">{{ $activityChart->sum('value') }} tugas</div>
            </div>

            <div class="graph-wrap">
                @forelse($activityChart as $bar)
                @php
                $value = (int) ($bar['value'] ?? 0);
                $height = $value > 0 ? max(14, (int) round(($value / $maxActivityValue) * 92)) : 10;
                @endphp
                <div class="graph-col">
                    <div class="graph-bar-track">
                        <div class="graph-bar" style="height:{{ $height }}px;">
                            <span style="height:100%;"></span>
                            <div class="graph-value">{{ $value }}</div>
                        </div>
                    </div>
                    <div class="graph-label">{{ $bar['label'] ?? '-' }}</div>
                </div>
                @empty
                <div class="graph-empty">Belum ada aktivitas yang cukup untuk ditampilkan.</div>
                @endforelse
            </div>
        </div>
        <div class="notif-modal" data-notif-modal aria-hidden="true">
            <div class="notif-sheet" role="dialog" aria-modal="true" aria-labelledby="nsh-title">
                <div class="nsh-head">
                    <div>
                        <div class="nsh-title" id="nsh-title">Notifikasi Tugas Urgent</div>
                        <div class="nsh-sub" data-notif-status>Memuat data terbaru...</div>
                    </div>
                    <button type="button" class="nsh-close" aria-label="Tutup" data-notif-close>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5">
                            <line x1="18" y1="6" x2="6" y2="18" />
                            <line x1="6" y1="6" x2="18" y2="18" />
                        </svg>
                    </button>
                </div>
                <div class="nsh-list" data-notif-list>
                    <div class="nsh-empty">Memuat notifikasi urgent...</div>
                </div>
            </div>
        </div>

    </div><!-- end .wrap -->

    <script>
    (() => {
        const modal = document.querySelector('[data-notif-modal]');
        const openBtn = document.querySelector('[data-notif-open]');
        const closeBtn = document.querySelector('[data-notif-close]');
        const list = document.querySelector('[data-notif-list]');
        const statusEl = document.querySelector('[data-notif-status]');
        const countBadge = document.querySelector('[data-notif-count]');
        const endpoint = openBtn?.dataset.notifEndpoint;

        let cache = null;

        const setBadge = (n) => {
            if (!countBadge) return;
            countBadge.textContent = String(n);
            countBadge.classList.toggle('show', n > 0);
        };

        const render = (payload) => {
            const tasks = payload?.tasks ?? [];
            if (!list) return;

            if (!payload?.authenticated) {
                list.innerHTML = `
                <div class="nsh-empty">
                    ${payload?.message ?? 'Masuk dulu untuk melihat notifikasi tugas urgent.'}
                    <div style="display:flex;gap:12px;justify-content:center;margin-top:12px;flex-wrap:wrap;">
                        <a href="{{ route('login') }}"    style="color:var(--brown);font-weight:800;text-decoration:none;">Masuk</a>
                        <a href="{{ route('register') }}" style="color:var(--brown-mid);font-weight:800;text-decoration:none;">Daftar</a>
                    </div>
                </div>`;
                setBadge(0);
                if (statusEl) statusEl.textContent = payload?.message ?? 'Masuk untuk melihat notifikasi.';
                return;
            }

            setBadge(tasks.length);
            if (statusEl) statusEl.textContent = payload?.message ??
                'Ada tugas urgent yang perlu diperhatikan.';

            if (!tasks.length) {
                list.innerHTML = '<div class="nsh-empty">Tidak ada tugas urgent saat ini. Semua aman! 🎉</div>';
                return;
            }

            list.innerHTML = tasks.map(t => `
            <a class="nsh-item" href="${t.url}">
                <span class="nsh-dot"></span>
                <div class="nsh-body">
                    <div class="nsh-item-title">${t.title}</div>
                    <div class="nsh-item-meta">${t.project_name ?? 'Tanpa proyek'} · Deadline ${t.deadline_label ?? '-'}</div>
                    <div class="nsh-item-foot">
                        <span>${t.status === 'in_progress' ? 'Sedang dikerjakan' : 'Belum selesai'}</span>
                        <span>Lihat tugas →</span>
                    </div>
                </div>
            </a>`).join('');
        };

        const fetchData = async () => {
            if (!endpoint) return;
            try {
                const res = await fetch(endpoint, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    credentials: 'same-origin',
                });
                cache = await res.json();
                if (modal?.classList.contains('open')) render(cache);
                else setBadge(cache?.tasks?.length ?? 0);
            } catch {
                if (statusEl) statusEl.textContent = 'Gagal memuat notifikasi urgent.';
            }
        };

        const open = () => {
            modal?.classList.add('open');
            modal?.setAttribute('aria-hidden', 'false');
            render(cache ?? {
                authenticated: true,
                tasks: [],
                message: 'Memuat data terbaru...'
            });
            fetchData();
        };

        const close = () => {
            modal?.classList.remove('open');
            modal?.setAttribute('aria-hidden', 'true');
        };

        openBtn?.addEventListener('click', open);
        closeBtn?.addEventListener('click', close);
        modal?.addEventListener('click', e => {
            if (e.target === modal) close();
        });
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') close();
        });

        fetchData();
        setInterval(fetchData, 15000);
    })();

    /* ── Realtime Clock ── */
    (function () {
        const hEl   = document.getElementById('clockH');
        const mEl   = document.getElementById('clockM');
        const sEl   = document.getElementById('clockS');
        const dEl   = document.getElementById('clockDate');
        const dayEl = document.getElementById('clockDay');

        const DAYS  = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
        const MONTHS = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];

        function pad(n) { return String(n).padStart(2, '0'); }

        function tick() {
            const now = new Date();
            if (hEl) hEl.textContent   = pad(now.getHours());
            if (mEl) mEl.textContent   = pad(now.getMinutes());
            if (sEl) sEl.textContent   = pad(now.getSeconds());
            if (dEl) dEl.textContent   = `${pad(now.getDate())} ${MONTHS[now.getMonth()]} ${now.getFullYear()}`;
            if (dayEl) dayEl.textContent = DAYS[now.getDay()];
        }

        tick();
        setInterval(tick, 1000);
    })();
    </script>

        {{-- ════════ ROAST MODAL ════════ --}}
        <div id="roast-overlay" aria-modal="true" role="dialog" aria-label="Pemberitahuan Penting">
            <div id="roast-card">

                {{-- Holographic shimmer bar --}}
                <div id="roast-shimmer"></div>

                {{-- Crown icon --}}
                <div id="roast-crown">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2 20h20M4 20l2-8 6 4 6-4 2 8"/>
                        <circle cx="12" cy="8" r="2"/>
                        <circle cx="4" cy="12" r="2"/>
                        <circle cx="20" cy="12" r="2"/>
                    </svg>
                </div>

                {{-- Badge --}}
                <div id="roast-badge">
                    <span>NOTICE</span>
                </div>

                <h2 id="roast-title">Hei, Kamu! 👋</h2>

                <div id="roast-divider"></div>

                <p id="roast-body">
                    <span id="roast-emoji-lock">🔒</span><br>
                    Dilarang mengatur<br>selagi bukan
                    <strong>Donatur</strong>
                </p>

                <div id="roast-tag">#IZINNN</div>

                <div id="roast-stamp">Yahahaha</div>

                <button id="roast-btn">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path d="M20 6L9 17l-5-5"/>
                    </svg>
                    Oke, Paham 👍
                </button>

                <p id="roast-footer">Terima kasih atas pengertiannya ✨</p>
            </div>
        </div>

        <style>
        /* ── OVERLAY ── */
        #roast-overlay {
            display: none;
            position: fixed; inset: 0; z-index: 9999;
            background: rgba(10, 5, 2, .72);
            backdrop-filter: blur(10px) saturate(1.4);
            -webkit-backdrop-filter: blur(10px) saturate(1.4);
            align-items: center; justify-content: center;
            padding: 20px;
        }
        #roast-overlay.open {
            display: flex;
            animation: roastFadeIn .3s ease;
        }
        @keyframes roastFadeIn {
            from { opacity: 0; }
            to   { opacity: 1; }
        }

        /* ── CARD ── */
        #roast-card {
            position: relative;
            width: 100%; max-width: 320px;
            background: #1a0f07;
            border: 1px solid rgba(245, 197, 122, .25);
            border-radius: 24px;
            padding: 32px 24px 24px;
            text-align: center;
            overflow: hidden;
            box-shadow:
                0 0 0 1px rgba(245,197,122,.08),
                0 20px 60px rgba(0,0,0,.6),
                0 0 80px rgba(122,75,35,.15);
            animation: roastSlideUp .4s cubic-bezier(.16,1,.3,1) both;
        }
        @keyframes roastSlideUp {
            from { transform: translateY(40px) scale(.95); opacity: 0; }
            to   { transform: translateY(0) scale(1);     opacity: 1; }
        }

        /* shimmer bar */
        #roast-shimmer {
            position: absolute; top: 0; left: 0; right: 0; height: 3px;
            background: linear-gradient(90deg,
                transparent 0%,
                #f5c57a 30%,
                #fff8e7 50%,
                #f5c57a 70%,
                transparent 100%);
            background-size: 200% 100%;
            animation: shimmerMove 2s linear infinite;
        }
        @keyframes shimmerMove {
            from { background-position: 200% 0; }
            to   { background-position: -200% 0; }
        }

        /* crown */
        #roast-crown {
            display: inline-flex; align-items: center; justify-content: center;
            width: 64px; height: 64px; border-radius: 50%;
            background: linear-gradient(135deg, #3a1e08, #6a3a18);
            border: 2px solid rgba(245,197,122,.35);
            color: #f5c57a;
            margin-bottom: 14px;
            box-shadow: 0 4px 20px rgba(245,197,122,.2);
            animation: roastPop .5s .25s cubic-bezier(.34,1.56,.64,1) both;
        }
        @keyframes roastPop {
            from { transform: scale(0) rotate(-20deg); opacity: 0; }
            to   { transform: scale(1) rotate(0deg);   opacity: 1; }
        }

        /* badge */
        #roast-badge {
            display: inline-flex; align-items: center; gap: 5px;
            background: rgba(245,197,122,.12);
            border: 1px solid rgba(245,197,122,.3);
            border-radius: 99px; padding: 3px 12px; margin-bottom: 12px;
        }
        #roast-badge span {
            font-size: .6rem; font-weight: 800; letter-spacing: 2px;
            color: #f5c57a;
        }

        /* title */
        #roast-title {
            font-size: 1.25rem; font-weight: 800;
            color: #fff; margin-bottom: 12px;
            letter-spacing: -.3px;
        }

        /* divider */
        #roast-divider {
            width: 40px; height: 2px; margin: 0 auto 16px;
            background: linear-gradient(90deg, transparent, #f5c57a, transparent);
        }

        /* body */
        #roast-body {
            font-size: .95rem; font-weight: 500;
            color: rgba(255,255,255,.75);
            line-height: 1.8; margin-bottom: 16px;
        }
        #roast-body strong {
            color: #f5c57a; font-weight: 800;
            text-decoration: underline;
            text-underline-offset: 3px;
            text-decoration-color: rgba(245,197,122,.4);
        }
        #roast-emoji-lock {
            font-size: 2rem; display: block; margin-bottom: 8px;
            animation: lockShake 1s .6s ease both;
        }
        @keyframes lockShake {
            0%,100% { transform: rotate(0); }
            20% { transform: rotate(-12deg); }
            40% { transform: rotate(12deg); }
            60% { transform: rotate(-8deg); }
            80% { transform: rotate(8deg); }
        }

        /* tag */
        #roast-tag {
            font-size: 1.1rem; font-weight: 900;
            letter-spacing: 1px; margin-bottom: 20px;
            background: linear-gradient(135deg, #f5c57a, #e07b39);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* rubber stamp */
        #roast-stamp {
            position: absolute; top: 22px; right: -14px;
            background: transparent;
            border: 3px solid rgba(220, 50, 50, .55);
            color: rgba(220, 50, 50, .55);
            font-size: .55rem; font-weight: 900; letter-spacing: 2px;
            padding: 4px 10px; border-radius: 4px;
            transform: rotate(18deg);
            pointer-events: none;
        }

        /* button */
        #roast-btn {
            display: inline-flex; align-items: center; gap: 7px;
            background: linear-gradient(135deg, #7a4b23, #c07c3a);
            border: none; border-radius: 12px;
            color: #fff; font-size: .88rem; font-weight: 700;
            font-family: inherit; padding: 12px 28px;
            cursor: pointer; width: 100%;
            justify-content: center;
            box-shadow: 0 4px 18px rgba(122,75,35,.4);
            transition: transform .12s, box-shadow .12s;
        }
        #roast-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 24px rgba(122,75,35,.5);
        }
        #roast-btn:active { transform: scale(.97); }

        /* footer */
        #roast-footer {
            font-size: .7rem; color: rgba(255,255,255,.3);
            margin-top: 12px; font-weight: 500;
        }
        </style>

        <script>
        /* ── ROAST MODAL ── */
        (function() {
            const overlay = document.getElementById('roast-overlay');
            const btn     = document.getElementById('roast-btn');

            // Tampil setiap kali halaman dibuka (tanpa sessionStorage agar selalu muncul)
            setTimeout(() => {
                overlay.classList.add('open');
            }, 600);

            btn.addEventListener('click', () => {
                overlay.style.animation = 'roastFadeIn .2s ease reverse forwards';
                setTimeout(() => overlay.classList.remove('open'), 200);
            });

            // Klik backdrop juga tutup
            overlay.addEventListener('click', e => {
                if (e.target === overlay) btn.click();
            });
        })();
        </script>

        {{-- END ROAST MODAL --}}
</body>

</html>