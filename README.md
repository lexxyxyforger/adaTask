<div align="center">

# 🟫 WongTask

**Aplikasi manajemen tugas personal berbasis mobile-first**
*Produktif. Tertata. Milik kamu sendiri.*

[![Laravel](https://img.shields.io/badge/Laravel-13.7-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.5-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Vite](https://img.shields.io/badge/Vite-latest-646CFF?style=for-the-badge&logo=vite&logoColor=white)](https://vitejs.dev)
[![Status](https://img.shields.io/badge/Status-Active-success?style=for-the-badge)](#)

</div>

---

## ✨ Tentang WongTask

**WongTask** adalah platform manajemen tugas modern yang dirancang dengan filosofi **mobile-first** dan tampilan premium berkelas. Dibuat untuk membantu kamu mengatur proyek dan tugas sehari-hari dengan cara yang menyenangkan — bukan yang membosankan.

> *"Bukan sekadar to-do list. Ini command center produktivitasmu."*

---

## 📸 Tampilan

| Halaman | Deskripsi |
|---|---|
| 🏠 **Beranda** | Dashboard utama dengan ringkasan harian, jam realtime, proyek aktif |
| 📋 **Proyek** | Daftar proyek dengan filter tab & search realtime |
| ✅ **Tugas** | Detail tugas per proyek dengan checklist interaktif |
| 📅 **Kalender** | Jadwal tugas per tanggal + quick-add langsung dari kalender |
| 👤 **Profil** | Manajemen profil dengan upload foto & bio |
| ⚙️ **Pengaturan** | Preferensi app: hemat daya, notifikasi, tampilkan deadline |
| 🗄️ **Arsip** | Riwayat semua tugas yang telah diselesaikan |

---

## 🚀 Fitur Unggulan

### 📊 Dashboard Realtime
- **Jam digital** dengan detik berdetak (HH:MM:SS), tanggal & hari dalam Bahasa Indonesia
- **Ringkasan harian** — total tugas, selesai hari ini, tertunda
- **Proyek aktif** dengan progress bar visual
- **Auto-refresh** data setiap 15 detik

### 📂 Manajemen Proyek
- Buat proyek baru langsung dari halaman daftar
- **Filter tab** — Semua / Aktif / Selesai / Arsip (dengan badge count)
- **Search realtime** dengan debounce — cari proyek instan
- Progress bar per proyek + persentase penyelesaian
- Badge status berwarna (🟠 Aktif · 🟢 Selesai · ⚫ Arsip)

### ✅ Manajemen Tugas
- Tugas dengan prioritas (Rendah / Medium / Tinggi)
- Status workflow: `Todo` → `In Progress` → `Done`
- **Checklist interaktif** per tugas — toggle via AJAX tanpa reload
- Deadline tracking dengan indikator warna

### 📅 Kalender Interaktif
- Navigasi bulan dengan indikator titik pada tanggal bertugas
- **Quick-add tugas** langsung dari tanggal yang dipilih via bottom sheet modal
- Deadline auto pre-filled sesuai tanggal yang diklik
- AJAX submit tanpa page refresh

### 👤 Profil & Avatar
- **Upload foto** via file drag-drop atau URL langsung
- Auto-save foto via AJAX (tanpa klik simpan)
- Fallback ke inisial nama jika belum ada foto
- Bio singkat yang bisa diedit

### ⚙️ Pengaturan Pintar
- **Hemat Daya** — matikan semua animasi & transisi
- **Notifikasi Deadline** — alert tugas yang mendekati batas waktu
- **Tampilkan/sembunyikan deadline** di daftar tugas
- Semua preferensi disimpan ke `localStorage` (persisten antar halaman)

### 🔔 Notifikasi Urgent
- Bubble notifikasi otomatis muncul untuk tugas yang deadline-nya < 3 hari
- Auto-dismiss setelah 7 detik
- Dapat dinonaktifkan dari halaman Pengaturan

---

## 🛠️ Tech Stack

| Komponen | Teknologi |
|---|---|
| **Backend** | Laravel 13.7 + PHP 8.5 |
| **Frontend** | Vanilla HTML/CSS/JS (Mobile-first) |
| **Build Tool** | Vite |
| **Database** | MySQL |
| **Auth** | Laravel Session Auth |
| **Storage** | Local (`storage/app/public/avatars`) |
| **Font** | Plus Jakarta Sans (Google Fonts) |
| **Design** | Glassmorphism + Coklat Premium Theme |

---

## 📁 Struktur Halaman

```
resources/views/
├── welcome.blade.php          # 🏠 Beranda / Dashboard utama
├── partials/
│   └── settings-boot.blade.php   # ⚙️ Shared: preferensi boot + notif urgent
├── auth/
│   ├── login.blade.php        # 🔐 Halaman login
│   └── register.blade.php     # 📝 Halaman registrasi
├── projects/
│   ├── index.blade.php        # 📂 Daftar proyek + filter + search
│   └── show.blade.php         # 📋 Detail proyek + tab tugas/detail
├── tasks/
│   ├── create.blade.php       # ➕ Form tambah tugas
│   ├── index.blade.php        # 📄 Daftar tugas per proyek
│   └── show.blade.php         # ✅ Detail tugas + checklist
├── calendar/
│   └── index.blade.php        # 📅 Kalender + quick-add tugas
├── profile/
│   └── index.blade.php        # 👤 Profil + upload avatar
├── settings/
│   └── index.blade.php        # ⚙️ Halaman pengaturan
└── archive/
    └── index.blade.php        # 🗄️ Arsip tugas selesai
```

---

## 🗺️ Routes

```
GET  /              → Landing / redirect
GET  /home          → Dashboard utama (auth)
GET  /projects      → Daftar proyek
POST /projects      → Buat proyek baru
GET  /projects/{id} → Detail proyek
GET  /projects/{id}/tasks     → Daftar tugas
POST /projects/{id}/tasks     → Buat tugas baru
GET  /tasks/create  → Form tugas baru
GET  /tasks/{id}    → Detail tugas
PATCH /tasks/{id}   → Update status tugas
GET  /calendar      → Halaman kalender
GET  /profile       → Halaman profil
POST /profile       → Update profil
POST /profile/avatar → Upload/update avatar (AJAX)
GET  /settings      → Halaman pengaturan
GET  /archive       → Arsip tugas selesai
GET  /notifications/urgent → API notifikasi (JSON)
```

---

## 🏃 Cara Menjalankan

### Prasyarat
- PHP >= 8.2
- Composer
- Node.js >= 18
- MySQL

### Instalasi

```bash
# 1. Clone repository
git clone https://github.com/username/wongtask-api.git
cd wongtask-api

# 2. Install dependencies
composer install
npm install

# 3. Setup environment
cp .env.example .env
php artisan key:generate

# 4. Konfigurasi database di .env
DB_DATABASE=wongtask
DB_USERNAME=root
DB_PASSWORD=your_password

# 5. Migrasi & seed
php artisan migrate
php artisan storage:link

# 6. Jalankan server
php artisan serve
npm run dev
```

Akses di: **http://localhost:8000**

---

## 🗄️ Database Schema

```
users
├── id, name, email, password
├── avatar_url (varchar 2048)
└── bio (text, nullable)

projects
├── id, user_id (FK)
├── name, description
└── timestamps

tasks
├── id, project_id (FK)
├── title, description
├── status (todo | in_progress | done)
├── priority (low | medium | high)
├── deadline (date, nullable)
├── checklist (json, nullable)
└── timestamps
```

---

## 🎨 Design System

| Token | Nilai |
|---|---|
| `--brand` | `#7a4b23` (coklat tua) |
| `--brand-light` | `#a0622e` (coklat muda) |
| `--bg` | `#f4f0e8` (krem hangat) |
| `--card` | `#ffffff` |
| `--line` | `#e8e0d0` |
| `--ink` | `#2e241a` |
| `--muted` | `#9a8f85` |

**Font:** Plus Jakarta Sans (400, 500, 600, 700, 800)
**Radius:** 14–24px (card), 10–12px (input), 99px (pill)

---

## ⚠️ Catatan Penting

> **Khusus untuk teman-teman yang bukan Donatur:**
>
> 🔒 *Dilarang mengatur selagi bukan Donatur* **#IZINNN**
>
> *Yahahaha* 😄

---

## 👨‍💻 Developer

**Ada Wong** — Pengembang utama WongTask

---

<div align="center">

Made with ☕ & semangat produktif

*WongTask v1.0 · 2026*

</div>
