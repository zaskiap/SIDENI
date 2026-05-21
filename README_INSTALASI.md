# SIDENI Laravel Jetstream — Panduan Instalasi Lengkap

## PRASYARAT
- PHP >= 8.2
- Composer
- Node.js >= 18 + NPM
- MySQL / MariaDB (Laragon sudah include)

## LANGKAH INSTALASI

### 1. Extract ke Laragon
```
C:\laragon\www\sideni_jetstream\
```

### 2. Install PHP dependencies
```bash
composer install
```

### 3. Setup .env
```bash
copy .env.example .env
php artisan key:generate
```
Edit `.env` — sesuaikan:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sideni_jetstream
DB_USERNAME=root
DB_PASSWORD=
SESSION_DRIVER=database
APP_URL=http://127.0.0.1:8000
```

### 4. Buat database di phpMyAdmin
```sql
CREATE DATABASE sideni_jetstream CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 5. Jalankan migration + seeder
```bash
php artisan migrate
php artisan db:seed
php artisan storage:link
```

### 6. Jalankan server
```bash
php artisan serve
```
Buka: **http://127.0.0.1:8000**

---

## AKUN DEFAULT

### Admin Panel
- URL: **http://127.0.0.1:8000/admin**
- Email: `admin@sideni.com`
- Password: `admin123`

### User Biasa
- Daftar via: **http://127.0.0.1:8000/register**

---

## FITUR LENGKAP

### Halaman User
| Halaman | URL | Akses |
|---|---|---|
| Homepage | / | Publik |
| Login | /login | Publik |
| Register | /register | Publik (3 step) |
| Beranda | /beranda | Auth |
| Skrining | /skrinning | Auth |
| Hasil Skrining | /hasil | Auth |
| Riwayat Skrining | /riwayat | Auth |
| Faktor Risiko | /faktor-risiko | Auth |
| Berita | /berita | Auth |
| Tentang | /tentang | Auth |
| Profil | /user/profile | Auth (Jetstream) |

### Panel Admin
| Halaman | URL |
|---|---|
| Login Admin | /admin/login |
| Beranda | /admin/beranda |
| Berita - List | /admin/berita |
| Berita - Tambah | /admin/berita/tambah |
| Berita - Detail | /admin/berita/{id} |
| Berita - Edit | /admin/berita/{id}/edit |
| Daftar Pengguna | /admin/pengguna |
| Pelaporan | /admin/pelaporan |
| Cetak Laporan | /admin/pelaporan/cetak |

---

## TROUBLESHOOTING

### Login/Register tidak bisa diklik
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan key:generate
php artisan serve
```

### Session error
Pastikan `.env`:
```
SESSION_DRIVER=database
```
Lalu:
```bash
php artisan session:table
php artisan migrate
```

### Storage tidak terbaca
```bash
php artisan storage:link
```
