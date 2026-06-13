# Klinik Kurnia - Sistem Informasi Pendaftaran Pasien

## Nama : Dedi Kurniawan
## NIM : H1H024022
## Mata Kuliah : Pemrograman Web

Aplikasi web berbasis MVC menggunakan CodeIgniter 3 dan Bootstrap 5, dikhususkan untuk sistem pendaftaran mandiri pasien di Klinik Kurnia. Desain antarmuka difokuskan pada fungsionalitas, responsivitas, dan kemudahan pengguna dengan pemisahan akses yang jelas antara area publik (*landing page*) dan area privat (*dashboard* pasien).

## Fitur Utama
- **Area Publik:** *Landing page* informatif yang menampilkan profil klinik, layanan, dan jadwal praktik dokter harian.
- **Autentikasi Pasien:** Sistem Login dan Registrasi yang praktis menggunakan Nomor Handphone (menyimpan data NIK, Nama, dan Alamat).
- **Dashboard Pasien:** Area privat yang memuat informasi statistik pendaftaran, daftar tiket/antrean aktif, serta riwayat kunjungan selesai.
- **Pendaftaran Mandiri:** Form pendaftaran interaktif yang mencakup pemilihan jadwal dokter, input keluhan penyakit, serta opsi metode pembayaran (Umum / BPJS / Asuransi).
- **E-Tiket & Kode Booking:** Pencetakan tiket digital otomatis (*print ready*) yang menampilkan detail hari, jam, poli tujuan, nama dokter, dan kode booking unik.
- **Sistem Keamanan & Routing:** Navigasi ketat menggunakan sistem Controller (`base_url`), terkonfigurasi dengan `.htaccess` untuk URL *friendly* (tanpa `index.php`).

## Instalasi & Konfigurasi (XAMPP/Laragon)
1. Pindahkan folder proyek ke `htdocs` (XAMPP) atau `www` (Laragon). Pastikan nama folder proyek adalah `klinik_kurnia`.
2. Buat database baru di MySQL (via phpMyAdmin) dengan nama `db_klinik_kurnia`.
3. Import file `db_klinik_kurnia.sql` ke dalam database tersebut.
4. Buka file konfigurasi `application/config/database.php` dan sesuaikan kredensial berikut:
```php
   'username' => 'root',
   'password' => '',
   'database' => 'db_klinik_kurnia',