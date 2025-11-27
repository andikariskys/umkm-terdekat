# UMKMTerdekat

Ringkasan singkat  
UMKMTerdekat adalah aplikasi pemasaran lokal yang membantu usaha mikro, kecil, dan menengah (UMKM) meningkatkan visibilitas dan penjualan dengan menghubungkan mereka ke pelanggan di sekitar. Aplikasi ini menampilkan profil usaha, lokasi di peta, promosi, dan alat analitik sederhana untuk memantau performa.

Fitur utama
- Pendaftaran & profil usaha (foto, deskripsi, dll)
- Pencarian berdasarkan lokasi dan kategori
- Peta interaktif dan rute menuju usaha
- Manajemen produk dan stok sederhana
- Kasir sederhana & Statistik dasar penjualan
- Integrasi metode kontak (telepon, WhatsApp, media sosial)

Manfaat untuk UMKM
- Meningkatkan jangkauan pelanggan lokal
- Mempermudah pelanggan menemukan dan menghubungi usaha
- Menyediakan alat promosi tanpa biaya pemasaran besar

Cara cepat mulai (pengembang)
1. Clone repository ke environment pengembangan (mis. Laragon).
2. Salin file `.env.example` menjadi `.env` lali modifikasi pada database
3. Jalankan perintah `composer i` untuk menginstall dependency yang dibutuhkan
5. Jalankan perintah `php artisan migrate` untuk melakukan migrasi database
6. Jalankan aplikasi dengan perintah `php artisan serve`
7. Buka aplikasi di browser.

Lisensi
- Free for commercial use

Arsitektur Sistem
- FullStack: Laravel 12
- Template: TailwindCSS
- Database: MySQL
- Library: tarfin-labs/laravel-spatial & Leaflet.js

Kontak / kontribusi  
Untuk kontribusi atau pertanyaan, tambahkan issue atau pull request pada repository ini.