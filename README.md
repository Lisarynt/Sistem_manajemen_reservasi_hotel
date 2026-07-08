MaRe — Manajemen Reservasi

Sistem Reservasi Hotel berbasis web yang dibangun menggunakan Laravel 12 dengan konsep fullstack development. Dibuat sebagai Tugas Besar UAS mata kuliah Pemrograman Web 2.

📋 Deskripsi

MaRe adalah aplikasi manajemen reservasi hotel yang memungkinkan staf hotel (Admin dan Petugas) untuk mengelola data kamar, tamu, dan proses reservasi mulai dari booking, check-in, hingga check-out secara digital dan terpusat.

✨ Fitur Utama

Fitur Wajib


Autentikasi & Role Management — Login, Register, Logout dengan middleware role (Admin & Petugas)
Manajemen Kamar — CRUD data kamar, tipe kamar, dan status ketersediaan
Manajemen Tamu — CRUD data tamu dengan fitur pencarian
Manajemen Reservasi — Booking, Check-In, Check-Out dengan tracking status otomatis
Manajemen Fasilitas — Fasilitas tambahan opsional yang bisa dipilih saat booking
Dashboard — Statistik total data, grafik reservasi, dan status kamar (Chart.js)
Export Laporan — Export data reservasi ke Excel dan PDF


Fitur Nilai Tambahan


🌓 Dark Mode — Toggle tema gelap/terang dengan preferensi tersimpan
📸 Upload Multiple Images — Upload beberapa foto kamar sekaligus
📱 QR Code — Generate QR Code untuk verifikasi booking
📝 Activity Log — Pencatatan riwayat aktivitas perubahan data sistem
✉️ Email Notification — Notifikasi email otomatis saat booking dikonfirmasi


🗄️ Struktur Database

Tabel Master:


users — Data pengguna sistem (Admin/Petugas)
room_types — Tipe/kategori kamar
rooms — Data kamar
guests — Data tamu
facilities — Fasilitas tambahan hotel


Tabel Transaksi:


bookings — Data reservasi (relasi ke guests & rooms)
payments — Riwayat pembayaran booking
booking_facility — Tabel pivot relasi Many-to-Many antara booking dan fasilitas
room_images — Galeri foto tiap kamar (relasi One-to-Many ke rooms)


Relasi:


room_types → rooms (One-to-Many)
guests → bookings (One-to-Many)
bookings ↔ facilities (Many-to-Many via booking_facility)


🛠️ Tech Stack

KategoriTeknologiBackendLaravel 12, PHP 8.2FrontendBlade Templating, Tailwind CSSDatabaseMySQLAutentikasiLaravel BreezeGrafikChart.jsQR Codesimplesoftwareio/simple-qrcodeActivity Logspatie/laravel-activitylogEmailLaravel Mail

🚀 Instalasi & Menjalankan Secara Lokal

Prasyarat


PHP >= 8.2
Composer
Node.js & NPM
MySQL


Langkah Instalasi

bash# Clone repository
git clone https://github.com/username-kamu/mare.git
cd mare

# Install dependency PHP
composer install

# Install dependency JavaScript
npm install

# Salin file environment
cp .env.example .env

# Generate application key
php artisan key:generate

Sesuaikan konfigurasi database di file .env:

envDB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mare
DB_USERNAME=root
DB_PASSWORD=

Lanjutkan dengan:

bash# Jalankan migration & seeder
php artisan migrate --seed

# Buat symbolic link storage
php artisan storage:link

# Build asset frontend
npm run build

# Jalankan development server
php artisan serve

Aplikasi dapat diakses di http://127.0.0.1:8000

Akun Default (dari Seeder)

RoleEmailPasswordAdminadmin@hotel.testpasswordPetugaspetugas@hotel.testpassword

📁 Struktur Modul CRUD


Tipe Kamar — Khusus Admin (Petugas read-only)
Kamar — Khusus Admin (Petugas read-only), dengan upload multiple images
Fasilitas — Khusus Admin (Petugas read-only)
Tamu — Admin & Petugas (akses penuh)
Reservasi/Booking — Admin & Petugas (akses penuh), termasuk proses Check-In/Check-Out


👥 Role & Hak Akses

ModulAdminPetugasTipe Kamar, Kamar, FasilitasCRUD penuhRead-onlyTamu, Booking, Check-In/OutCRUD penuhCRUD penuhActivity LogAkses penuhTidak dapat diaksesLaporan & ExportAkses penuhAkses penuh

📄 Lisensi

Project ini dibuat untuk keperluan akademik (Tugas Besar UAS) dan bersifat open untuk pembelajaran.

👤 Author

Lisa Ayu Aryanti
NIM: 23552011432
Mata Kuliah: Pemrograman Web 2
