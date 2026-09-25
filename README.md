# Activity Manager — Modul 3 Laravel Basic

Aplikasi manajemen kegiatan sederhana (Activity Manager v1) dibangun dengan Laravel 13 sebagai bagian dari Proyek 3 - Pengembangan Perangkat Lunak Berbasis Web, Modul 3: Frameworks in Programming - Laravel Basic.

## Informasi Versi

- PHP: 8.3.33
- Composer: 2.10.2
- Laravel Framework: 13.32.0
- Database: SQLite

## Fitur

- Melihat daftar dan detail kegiatan
- Menambah, mengubah, dan menghapus kegiatan (CRUD)
- Validasi input lewat Form Request (judul 5-100 karakter, tanggal wajib, status terbatas)
- Aturan transisi status (Planned → Ongoing → Done, tidak bisa mundur) lewat `ActivityService`
- Filter daftar kegiatan berdasarkan status lewat query string (`?status=Planned`)

## Cara Menjalankan Proyek

1. Clone repository ini:
```bash
    git clone https://github.com/rainissa/Proyek-3-Modul-3-.git
    cd Proyek-3-Modul-3-
```
2. Install dependency:
```bash
    composer install
```
3. Salin file environment:
```bash
    copy .env.example .env
```
4. Generate application key:
```bash
    php artisan key:generate
```
5. Buat file database SQLite:
```bash
    type nul > database\database.sqlite
```
6. Jalankan migration:
```bash
    php artisan migrate
```
7. Jalankan seeder (mengisi 5 data kegiatan contoh):
```bash
    php artisan db:seed --class=ActivitySeeder
```
8. Jalankan server pengembangan:
```bash
    php artisan serve
```
9. Buka aplikasi di browser: http://127.0.0.1:8000/activities

## Route Utama
| Method | URI | Nama Route | Deskripsi |
|---|---|---|---|
| GET | `/activities` | `activities.index` | Daftar kegiatan (bisa difilter `?status=Planned/Ongoing/Done`) |
| GET | `/activities/create` | `activities.create` | Form tambah kegiatan |
| POST | `/activities` | `activities.store` | Simpan kegiatan baru |
| GET | `/activities/{activity}` | `activities.show` | Detail kegiatan |
| GET | `/activities/{activity}/edit` | `activities.edit` | Form ubah kegiatan |
| PUT/PATCH | `/activities/{activity}` | `activities.update` | Simpan perubahan kegiatan |
| DELETE | `/activities/{activity}` | `activities.destroy` | Hapus kegiatan |

Lihat daftar lengkap dengan:
```bash
php artisan route:list --path=activities
```
## Struktur Kode Utama
- `app/Http/Controllers/ActivityController.php` : orkestrasi request dan response
- `app/Http/Requests/StoreActivityRequest.php`, `UpdateActivityRequest.php` : validasi input (BR-01 s/d BR-03)
- `app/Traits/ValidatesActivityData.php` : aturan validasi bersama, dipakai kedua Form Request
- `app/Services/ActivityService.php` : business logic transisi status (BR-03A)
- `app/Models/Activity.php` : Eloquent model
- `database/migrations/` : struktur tabel `activities`
- `database/seeders/ActivitySeeder.php` : data awal
- `resources/views/activities/` : Blade view (index, show, create, edit, partial `_form`)

## Static Analysis
Proyek ini dianalisis menggunakan SonarQube Cloud, project key `rainissa_Proyek-3-Modul-3-`.