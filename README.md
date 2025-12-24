# UniVENT

UniVENT adalah aplikasi web manajemen event mahasiswa berbasis PHP native yang digunakan untuk mengelola pembuatan, pendaftaran, dan monitoring event kampus. Sistem ini mendukung peran Admin, Panitia, dan Peserta, serta dilengkapi fitur analitik dan integrasi API.

---

## Teknologi yang Digunakan
- PHP Native (tanpa framework MVC)
- MySQL / MariaDB
- Tailwind CSS
- Chart.js
- Google OAuth 2.0
- PHPMailer
- Composer (library utilitas)

---

## Cara Menjalankan Project (Localhost)

1. Clone repository ini
2. Jalankan Apache dan MySQL (XAMPP)
3. Import database dari file:
db.sql
4. Letakkan folder project di:
htdocs/FinalProjek/univent-frontend
5. Buka browser dan akses:
http://localhost/FinalProjek/univent-frontend/

---

## Konfigurasi Environment (.env)

Buat file `.env` di folder:
univent-frontend/

Isi dengan format berikut:

```env
GOOGLE_CLIENT_ID=isi_client_id
GOOGLE_CLIENT_SECRET=isi_client_secret
GOOGLE_REDIRECT_URI=http://localhost/FinalProjek/univent-frontend/google/callback.php
GOOGLE_CALENDAR_ID=primary
```

Catatan: file .env tidak disertakan di repository demi keamanan.

## Akun Demo

~ Admin ~

Email: admin@gmail.com
Password: admin123

~ Panitia ~

Email: panitia@gmail.com
Password: panitia123

~ Peserta ~

Email: peserta1@gmail.com
Password: 123456

Email: peserta2@gmail.com
Password: 123456

Email: peserta3@gmail.com
Password: 123456

## Fitur Utama

- Autentikasi (Login, Register, Logout)
- Manajemen event oleh Panitia (CRUD Event)
- Verifikasi dan penghapusan event oleh Admin
- Pendaftaran event oleh Peserta
- Notifikasi Email menggunakan PHPMailer
- Dashboard Admin dengan grafik dan analitik
- Analitik jenis event paling diminati
- Export laporan analitik dalam format CSV

## Analitik

Sistem menyediakan fitur analitik untuk mengetahui jenis event yang paling diminati mahasiswa berdasarkan jumlah peserta terdaftar. Hasil analitik ditampilkan pada dashboard admin dalam bentuk ringkasan (cards) dan dapat diunduh dalam format CSV.

## Database & Seed Data

Database sudah disertai seed data berupa:
- Akun Admin
- Akun Panitia
- Akun Peserta
- Data kategori event
- Data event dummy
- Data tiket (relasi peserta dan event)
- Seed data tersedia dalam file db.sql

## Catatan Tambahan

Project ini dibuat untuk memenuhi tugas Final Project mata kuliah Pemrograman Web / Basis Data dengan ketentuan:
- PHP Native
- Database MySQL
- OOP
- CRUD
- Analitik
- Integrasi API
- Notifikasi