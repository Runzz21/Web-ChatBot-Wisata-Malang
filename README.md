# Web Wisata Alam Malang

Aplikasi web informasi wisata alam di Malang Raya berbasis Laravel 12.

## Persyaratan Sistem

- PHP 8.3+
- Composer 2.x
- Node.js 20+ dan npm 10+
- MySQL 8+
- Web Server (Apache/Nginx) atau Laravel Sail

## Instalasi

### 1. Clone atau salin project ke server

```bash
cd /var/www/html
# atau copy folder project ke sini
```

### 2. Install dependencies PHP

```bash
composer install
```

### 3. Install dependencies JavaScript

```bash
npm install
```

### 4. Copy file environment

```bash
copy .env.example .env
```

### 5. Generate application key

```bash
php artisan key:generate
```

### 6. Konfigurasi database

Edit file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lereng_db
DB_USERNAME=root
DB_PASSWORD=
```

### 7. Migrasi database (hanya tabel yang belum ada)

```bash
php artisan migrate
```

### 8. Buat symbolic link storage

```bash
php artisan storage:link
```

### 9. Build asset frontend

```bash
npm run build
```

### 10. Jalankan development server

```bash
php artisan serve
```

Akses di: http://localhost:8000

## Struktur Direktori

```
app/
├── Http/
│   ├── Controllers/       # Controller (Public + Admin)
│   ├── Middleware/         # AdminMiddleware
│   └── Requests/          # Form Request Validation
├── Models/                # Eloquent Models
├── Providers/             # Service Providers
├── Repositories/          # Repository Pattern
└── Services/              # Service Layer

resources/views/
├── layouts/               # Layout template
├── components/            # Navbar, Footer
├── home/                  # Halaman beranda
├── destinasi/             # Daftar & detail destinasi
├── tentang/               # Halaman tentang
├── kontak/                # Halaman kontak
├── chatbot/               # Chatbot rekomendasi
├── admin/                 # Admin panel
└── errors/                # Error pages
```

## Route

| URL | Method | Keterangan |
|-----|--------|------------|
| `/` | GET | Beranda |
| `/destinasi` | GET | Daftar destinasi |
| `/destinasi/{nama}` | GET | Detail destinasi |
| `/tentang` | GET | Tentang kami |
| `/kontak` | GET | Kontak |
| `/chatbot` | GET | Chatbot rekomendasi |
| `/chatbot/process` | POST | Proses chatbot |
| `/chatbot/final` | POST | Hasil akhir chatbot |
| `/sitemap.xml` | GET | Sitemap SEO |
| `/admin/login` | GET | Login admin |
| `/admin/dashboard` | GET | Dashboard admin |
| `/admin/kategori/*` | GET/POST/PUT/DELETE | CRUD kategori |
| `/admin/destinasi/*` | GET/POST/PUT/DELETE | CRUD destinasi |
| `/admin/destinasi/{id}/galeri/*` | GET/POST/DELETE/PUT | CRUD galeri |
| `/admin/chatbot-log/*` | GET | Histori chatbot |

## Akun Admin

Buat akun admin melalui database langsung atau gunakan Tinker:
```bash
php artisan tinker
> DB::table('admin')->insert(['username' => 'admin', 'password_hash' => password_hash('password', PASSWORD_BCRYPT)]);
```

## Optimasi

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Fitur

- Halaman beranda dengan hero section, statistik, kategori populer, destinasi populer
- Pencarian dan filter destinasi realtime
- Detail destinasi dengan galeri foto, fasilitas, rekomendasi serupa
- Chatbot rekomendasi wisata interaktif
- Admin panel lengkap (CRUD kategori, destinasi, galeri, log chatbot)
- SEO friendly (meta tags, Open Graph, canonical URL, sitemap.xml)
- Responsive (mobile-first dengan Tailwind CSS)
- SweetAlert2 untuk notifikasi
- Alpine.js untuk interaktivitas
- Repository + Service Pattern
- Caching kategori & destinasi populer
- Rate limiter untuk chatbot
- Error pages (404, 419, 500)
