<?php
// all_businesses.php
// Halaman menampilkan semua profil usaha (bentuk card sama seperti sebelumnya)

$businesses = [
    ['id' => 0, 'name' => 'Warung Kopi Seduh', 'address' => 'Jl. Raya No. 12, Serang', 'image' => '☕', 'category' => 'F&B', 'phone' => '+62 812-0000-0000', 'email' => 'kopiseduh@example.com', 'description' => 'Kopi arabika lokal, suasana nyaman untuk nongkrong.'],
    ['id' => 1, 'name' => 'Toko Kelontong Berkah', 'address' => 'Jl. Pasar No. 45, Serang', 'image' => '🏪', 'category' => 'Retail', 'phone' => '+62 812-1111-1111', 'email' => 'berkah@example.com', 'description' => 'Toko kelontong lengkap dengan kebutuhan sehari-hari.'],
    ['id' => 2, 'name' => 'Sablon Kreatif', 'address' => 'Jl. Industri No. 8, Serang', 'image' => '👕', 'category' => 'Jasa', 'phone' => '+62 812-2222-2222', 'email' => 'sablon@example.com', 'description' => 'Sablon kaos custom untuk komunitas dan event.'],
    ['id' => 3, 'name' => 'Keripik Singkong Renyah', 'address' => 'Jl. Sudirman No. 23, Serang', 'image' => '🥔', 'category' => 'F&B', 'phone' => '+62 812-3333-3333', 'email' => 'keripik@example.com', 'description' => 'Keripik singkong homemade tanpa pengawet.'],
    ['id' => 4, 'name' => 'Bakso Mas Anto', 'address' => 'Jl. Merdeka No. 67, Serang', 'image' => '🍜', 'category' => 'F&B', 'phone' => '+62 812-4444-4444', 'email' => 'baksoanto@example.com', 'description' => 'Bakso sapi original dengan kuah gurih.'],
    ['id' => 5, 'name' => 'Roti Mama', 'address' => 'Jl. Melati No. 23, Serang', 'image' => '🍞', 'category' => 'F&B', 'phone' => '+62 812-5555-5555', 'email' => 'rotimama@example.com', 'description' => 'Roti harian, kue basah, dan pesanan ulang tahun.'],
];

?><!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Semua Profil Usaha - UMKMTerdekat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body class="min-h-screen bg-gray-50 font-sans">
    <header class="bg-white shadow-sm sticky top-0 z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="bg-green-600 p-2 rounded-xl">
                        <i class="fa-solid fa-store text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-green-700">UMKMTerdekat</h1>
                        <p class="text-xs text-gray-500">Dukung Usaha Lokal</p>
                    </div>
                </div>

                <!-- Tombol Menu (Mobile) -->
                <button id="menu-btn" class="lg:hidden text-gray-600 text-2xl focus:outline-none">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <!-- Navbar (Desktop) -->
                <nav id="menu" class="hidden lg:flex items-center space-x-8">
                    <a href="index.php" class="text-gray-700 hover:text-green-600 transition font-medium">Beranda</a>
                    <a href="business.php" class="text-green-600 font-semibold">Usaha</a>
                    <a href="products.php" class="text-gray-700 hover:text-green-600 transition font-medium">Produk</a>
                    <a href="contact.php" class="text-gray-700 hover:text-green-600 transition font-medium">Kontak</a>
                    <a href="login.php" class="text-white px-4 py-2 rounded-lg bg-green-600 transition font-medium">Login</a>
                </nav>
            </div>

            <!-- Navbar (Mobile) -->
            <div id="mobile-menu"
                class="max-h-0 overflow-hidden opacity-0 transform scale-y-95 transition-all duration-300 ease-in-out origin-top lg:hidden flex-col space-y-2 mt-4">
                <a href="index.php" class="block text-gray-700 hover:text-green-600 font-medium">Beranda</a>
                <a href="business.php" class="block text-green-600 font-semibold">Usaha</a>
                <a href="products.php" class="block text-gray-700 hover:text-green-600 font-medium">Produk</a>
                <a href="contact.php" class="block text-gray-700 hover:text-green-600 font-medium">Kontak</a>
                <a href="login.php" class="block text-gray-700 hover:text-green-600 font-medium">Login</a>
            </div>
        </div>
    </header>

    <main class="py-12">
        <div class="max-w-7xl mx-auto px-6 mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
                <div class="flex items-center space-x-3">
                    <div class="text-green-600 bg-green-50 p-3 rounded-lg">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Lokasi</p>
                        <p class="text-lg font-semibold text-gray-900">Serang, Banten <span class="text-xs text-gray-400">(Ubah lokasi sesuai kebutuhan)</span></p>
                    </div>
                </div>
                <div class="text-sm text-gray-500">
                    Koordinat: <span class="font-medium">-6.1200, 106.1500</span>
                </div>
            </div>

            <form action="all_businesses.php" method="get" class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                    <label for="q" class="sr-only">Cari usaha</label>
                    <input id="q" name="q" type="search" placeholder="Cari nama, kategori, atau alamat..." class="w-full sm:flex-1 border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-200" />

                    <select name="category" class="w-full sm:w-48 border border-gray-200 rounded-lg px-3 py-3 bg-white">
                        <option value="">Semua Kategori</option>
                        <option value="F&B">F&B</option>
                        <option value="Retail">Retail</option>
                        <option value="Jasa">Jasa</option>
                    </select>

                    <button type="submit" class="bg-green-600 text-white px-4 py-3 rounded-lg font-semibold hover:bg-green-700 flex items-center justify-center">
                        <i class="fa-solid fa-magnifying-glass mr-2"></i> Cari
                    </button>
                </div>
            </form>
        </div>

        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900">Semua Profil Usaha</h2>
                    <p class="text-gray-600">Daftar lengkap profil UMKM yang terdaftar di platform</p>
                </div>
                <div>
                    <a href="business.php" class="text-green-600 hover:text-green-700 font-semibold">← Kembali ke Beranda</a>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php foreach ($businesses as $b): ?>
                    <div class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 p-6 border border-gray-100 hover:border-green-200 transform hover:-translate-y-1">
                        <div class="w-20 h-20 mx-auto mb-4 bg-gradient-to-br from-green-100 to-green-200 rounded-full flex items-center justify-center text-4xl shadow-lg">
                            <?= htmlspecialchars($b['image'], ENT_QUOTES, 'UTF-8') ?>
                        </div>

                        <div class="mb-2 text-center">
                            <span class="text-xs bg-green-100 text-green-700 px-3 py-1 rounded-full font-medium"><?= htmlspecialchars($b['category'], ENT_QUOTES, 'UTF-8') ?></span>
                        </div>

                        <h3 class="font-semibold text-gray-900 mb-1 text-lg text-center"><?= htmlspecialchars($b['name'], ENT_QUOTES, 'UTF-8') ?></h3>

                        <p class="text-gray-500 text-sm mb-3 text-center"><i class="fa-solid fa-location-dot mr-2"></i> <?= htmlspecialchars($b['address'], ENT_QUOTES, 'UTF-8') ?></p>

                        <p class="text-gray-600 text-sm mb-4 leading-relaxed"><?= htmlspecialchars($b['description'], ENT_QUOTES, 'UTF-8') ?></p>

                        <div class="text-sm text-gray-700 mb-3 space-y-1">
                            <div class="flex items-center justify-center space-x-2">
                                <i class="fa-solid fa-phone text-green-600"></i>
                                <span><?= htmlspecialchars($b['phone'], ENT_QUOTES, 'UTF-8') ?></span>
                            </div>
                            <div class="flex items-center justify-center space-x-2">
                                <i class="fa-solid fa-envelope text-green-600"></i>
                                <span><?= htmlspecialchars($b['email'], ENT_QUOTES, 'UTF-8') ?></span>
                            </div>
                        </div>

                        <div class="mt-4">
                            <a href="business_profile.php?id=<?= urlencode($b['id']) ?>" class="w-full inline-block bg-green-600 hover:bg-green-700 text-white py-2.5 rounded-lg text-sm font-semibold transition-all text-center">
                                Buka Profil
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

    <footer id="kontak" class="bg-gradient-to-br from-green-600 to-green-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                <div>
                    <div class="flex items-center space-x-2 mb-6">
                        <div class="bg-white p-2 rounded-xl">
                            <i class="fa-solid fa-store text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="text-2xl font-bold">UMKMTerdekat</h4>
                            <p class="text-green-100 text-xs">Dukung Usaha Lokal</p>
                        </div>
                    </div>
                    <p class="text-green-100 leading-relaxed">Platform terpercaya untuk menemukan dan mendukung UMKM lokal di seluruh Indonesia</p>
                </div>

                <div>
                    <h5 class="font-bold text-lg mb-6">Tentang Kami</h5>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-green-100 hover:text-white transition">Tentang Platform</a></li>
                        <li><a href="#" class="text-green-100 hover:text-white transition">Cara Kerja</a></li>
                        <li><a href="#" class="text-green-100 hover:text-white transition">Kebijakan Privasi</a></li>
                        <li><a href="#" class="text-green-100 hover:text-white transition">Syarat & Ketentuan</a></li>
                    </ul>
                </div>

                <div>
                    <h5 class="font-bold text-lg mb-6">Hubungi Kami</h5>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <div class="bg-green-500 p-2 rounded-lg">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <div>
                                <div class="text-sm text-green-100">WhatsApp</div>
                                <div class="font-semibold">+62 812-3456-7890</div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="bg-green-500 p-2 rounded-lg">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <div>
                                <div class="text-sm text-green-100">Email</div>
                                <div class="font-semibold">info@umkmterdekat.com</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <h5 class="font-bold text-lg mb-6">Ikuti Kami</h5>
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="bg-gradient-to-br from-purple-500 to-pink-500 p-2 rounded-lg">
                            <i class="fa-brands fa-instagram"></i>
                        </div>
                        <div>
                            <div class="text-sm text-green-100">Instagram</div>
                            <div class="font-semibold">@umkmterdekat</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-t border-green-500 pt-8 text-center text-green-100 text-sm">
                &copy; 2025 <strong>UMKMTerdekat</strong>. Semua Hak Dilindungi.
            </div>
        </div>
    </footer>

    <script>
        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        let menuOpen = false;

        menuBtn.addEventListener('click', () => {
            menuOpen = !menuOpen;

            if (menuOpen) {
                mobileMenu.classList.remove('max-h-0', 'opacity-0', 'scale-y-95');
                mobileMenu.classList.add('max-h-96', 'opacity-100', 'scale-y-100');
            } else {
                mobileMenu.classList.add('max-h-0', 'opacity-0', 'scale-y-95');
                mobileMenu.classList.remove('max-h-96', 'opacity-100', 'scale-y-100');
            }
        });
    </script>
</body>
</html>
