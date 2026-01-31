# Unicourse - Sistem Pendaftaran Kursus Online

Unicourse adalah platform LMS (Learning Management System) sederhana namun powerful yang dibangun dengan **Laravel 11**. Sistem ini memungkinkan pengguna untuk menjelajahi kursus, mendaftar, dan mengakses materi pembelajaran. Dilengkapi dengan Panel Admin yang responsif (Mobile & Desktop) untuk pengelolaan konten.

![Unicourse Preview](/public/storage/logo-unicourse.png)
_(Ganti link gambar jika ada preview)_

## 🚀 Fitur Utama

### 1. Public & User

- **Landing Page Modern**: Desain responsif dengan Hero section dan daftar kursus unggulan.
- **Katalog Kursus**: Fitur pencarian (Search) dan paginasi (Pagination) untuk menjelajahi kursus.
- **Autentikasi**: Login & Register dengan pemisahan role (User vs Admin).
- **Dashboard Siswa**: Halaman "My Learning" untuk melihat kursus yang telah diikuti.
- **Enrollment System**: Alur pendaftaran kursus yang mudah.

### 2. Admin Panel

- **Manajemen Kursus**: Tambah, Edit, Hapus data kursus (Judul, Deskripsi, Harga, Gambar).
- **Manajemen User (BARU)**: CRUD lengkap untuk mengelola pengguna terdaftar.
- **Mobile Responsive**: Sidebar yang bisa di-toggle dan desain ramah layar sentuh.
- **Statistik Ringkas**: Melihat total user dan kursus aktif.

### 3. Teknis

- **Keamanan**: Proteksi CSRF, Validasi Input, dan Enkripsi Password (Bcrypt).
- **Optimasi**: Sudah dikonfigurasi untuk deployment production (Railway/Nixpacks).
- **Storage**: Dukungan upload gambar kursus.

## 🛠️ Teknologi yang Digunakan

- **Backend**: Laravel 11 (PHP 8.2 compatible)
- **Frontend**: Blade Templating, Tailwind CSS (Styling), Alpine.js (Interactivity)
- **Database**: MySQL
- **Build Tool**: Vite

## 💻 Cara Instalasi (Lokal)

Ikuti langkah ini untuk menjalankan project di komputer Anda:

1. **Clone Repository**

    ```bash
    git clone https://github.com/username/unicourse.git
    cd unicourse
    ```

2. **Install Dependencies**

    ```bash
    composer install
    npm install
    ```

3. **Setup Environment**
    - Copy file `.env.example` menjadi `.env`.
    - Atur koneksi database Anda (DB_DATABASE, dll).

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Migrate & Seed Database**

    ```bash
    php artisan migrate --seed
    ```

    _Command ini akan membuat tabel dan mengisi data dummy awal._

5. **Jalankan Aplikasi**
   Buka dua terminal terpisah:

    ```bash
    # Terminal 1 (Backend)
    php artisan serve

    # Terminal 2 (Frontend Build)
    npm run dev
    ```

6. **Akses Website**
   Buka browser di `http://127.0.0.1:8000`

## ☁️ Panduan Deployment (Railway)

Project ini sudah dilengkapi dengan `nixpacks.toml` dan `Procfile` untuk deployment otomatis di Railway.

### Langkah Penting di Railway:

1. **Environment Variables**:
   Pastikan variabel berikut diisi di menu **Variables**:
    - `APP_KEY`: (Generate pakai `php artisan key:generate --show` dan copy hasilnya, harus ada `base64:...`)
    - `APP_URL`: `https://nama-aplikasi-kamu.up.railway.app`
    - `DB_CONNECTION`: `mysql`
    - `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`: (Isi sesuai kredensial MySQL Service).
    - `SESSION_DRIVER`: `database` (Recommended) atau `file`.

2. **Setup Awal**:
   Setelah deploy berhasil (Status Active), buka link berikut sekali saja untuk setup database otomatis:
   `https://nama-aplikasi-kamu.up.railway.app/deploy-setup`

3. **Akun Admin Default**:
   Setelah menjalankan setup/seeder, gunakan akun ini untuk login admin:
    - **Email**: `admin@unicourse.com`
    - **Password**: `password123`

## 📂 Struktur Folder Penting

- `app/Http/Controllers`: Logika backend (Admin, Course, Auth).
- `resources/views`: Tampilan antarmuka (Blade).
- `routes/web.php`: Definisi jalur URL web.
- `database/migrations`: Skema database.
- `public/storage`: Tempat file gambar tersimpan (pastikan di-symlink).

---

_Dibuat dengan ❤️ oleh Tim Unicourse_
