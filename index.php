<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>UMKMTerdekat</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="min-h-screen bg-gray-50 font-sans">
    <!-- Header -->
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
                    <a href="index.php" class="text-green-600 font-semibold">Beranda</a>
                    <a href="business.php" class="text-gray-700 hover:text-green-600 transition font-medium">Usaha</a>
                    <a href="products.php" class="text-gray-700 hover:text-green-600 transition font-medium">Produk</a>
                    <a href="contact.php" class="text-gray-700 hover:text-green-600 transition font-medium">Kontak</a>
                    <a href="login.php" class="text-white px-4 py-2 rounded-lg bg-green-600 transition font-medium">Login</a>
                </nav>
            </div>

            <!-- Navbar (Mobile) -->
            <div id="mobile-menu"
                class="max-h-0 overflow-hidden opacity-0 transform scale-y-95 transition-all duration-300 ease-in-out origin-top lg:hidden flex-col space-y-2 mt-4">
                <a href="index.php" class="block text-green-600 font-semibold">Beranda</a>
                <a href="business.php" class="block text-gray-700 hover:text-green-600 font-medium">Usaha</a>
                <a href="products.php" class="block text-gray-700 hover:text-green-600 font-medium">Produk</a>
                <a href="contact.php" class="block text-gray-700 hover:text-green-600 font-medium">Kontak</a>
                <a href="login.php" class="block text-gray-700 hover:text-green-600 font-medium">Login</a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="beranda" class="bg-gradient-to-br from-green-50 via-white to-green-50/30 py-20">
        <div class="max-w-7xl mx-auto px-6 flex flex-col lg:flex-row items-center justify-between gap-16">

            <!-- Left: Hero Image (hidden on mobile) -->
            <div class="hidden lg:block w-1/2">
                <div class="relative">
                    <div class="absolute -top-4 -left-4 w-72 h-72 bg-green-200/40 rounded-full blur-3xl"></div>
                    <div class="absolute -bottom-4 -right-4 w-64 h-64 bg-green-300/30 rounded-full blur-3xl"></div>
                    <div class="relative w-full h-[500px] bg-gradient-to-br from-green-100 via-green-50 to-white rounded-3xl shadow-2xl flex items-center justify-center overflow-hidden">
                        <div class="text-center relative z-10">
                            <div class="text-9xl mb-6 animate-bounce">🏪</div>
                            <div class="flex justify-center space-x-6 text-7xl mb-4">
                                <span class="hover:scale-125 transition cursor-pointer">☕</span>
                                <span class="hover:scale-125 transition cursor-pointer">🍜</span>
                                <span class="hover:scale-125 transition cursor-pointer">👕</span>
                            </div>
                            <div class="flex justify-center space-x-6 text-6xl">
                                <span class="hover:scale-125 transition cursor-pointer">🥔</span>
                                <span class="hover:scale-125 transition cursor-pointer">🍞</span>
                            </div>
                        </div>
                        <div class="absolute top-8 left-8 w-20 h-20 bg-green-200 rounded-full opacity-40"></div>
                        <div class="absolute bottom-12 right-12 w-32 h-32 bg-green-300 rounded-full opacity-30"></div>
                    </div>
                </div>
            </div>

            <!-- Right: Hero Text -->
            <div class="w-full lg:w-1/2 text-center lg:text-left">
                <div class="inline-block bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-semibold mb-6">
                    🎉 Platform UMKM Terpercaya
                </div>
                <h2 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                    Temukan <span class="text-green-600">UMKM Terdekat</span> di Sekitar Anda
                </h2>
                <p class="text-gray-600 text-lg md:text-xl mb-8 leading-relaxed">
                    Dukung usaha lokal dan temukan produk berkualitas dari UMKM di sekitar Anda dengan mudah dan cepat.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start space-y-4 sm:space-y-0 sm:space-x-4 mb-8">
                    <a href="register.php" role="button" class="bg-green-600 hover:bg-green-700 text-white px-10 py-4 rounded-xl text-lg font-semibold shadow-lg hover:shadow-xl transition transform hover:scale-105 flex items-center space-x-2">
                        <span>Daftar UMKMTerdekat</span>
                        <i class="fa-solid fa-store w-5 h-5"></i>
                    </a>
                    <a href="contacts.php" role="button" class="border-2 border-green-600 text-green-600 hover:bg-green-50 px-8 py-4 rounded-xl text-lg font-semibold transition">
                        Pelajari Lebih Lanjut
                    </a>
                </div>

                <!-- Stats -->
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start space-y-6 sm:space-y-0 sm:space-x-12 pt-6 border-t border-gray-200">
                    <div class="text-center lg:text-left">
                        <div class="text-3xl font-bold text-green-600">500+</div>
                        <div class="text-gray-600">UMKM Terdaftar</div>
                    </div>
                    <div class="text-center lg:text-left">
                        <div class="text-3xl font-bold text-green-600">2000+</div>
                        <div class="text-gray-600">Produk & Jasa</div>
                    </div>
                    <div class="text-center lg:text-left">
                        <div class="text-3xl font-bold text-green-600">5000+</div>
                        <div class="text-gray-600">Pengguna Aktif</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Businesses Section -->
    <section id="usaha" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between mb-12 text-center sm:text-left">
                <div>
                    <h3 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">Usaha Terdaftar</h3>
                    <p class="text-gray-600 text-base md:text-lg">Jelajahi berbagai UMKM yang telah bergabung</p>
                </div>
                <button class="text-green-600 hover:text-green-700 font-semibold text-base md:text-lg flex items-center justify-center space-x-2 mt-4 sm:mt-0">
                    <span>Lihat Semua</span><span>→</span>
                </button>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                <?php
                $businesses = [
                    ['id' => 0, 'name' => 'Sablon Kreatif', 'address' => 'Jl. Industri No. 8, Serang', 'image' => '👕', 'category' => 'Jasa'],
                    ['id' => 1, 'name' => 'Keripik Singkong Renyah', 'address' => 'Jl. Sudirman No. 23, Serang', 'image' => '🥔', 'category' => 'F&B'],
                    ['id' => 2, 'name' => 'Warung Kopi Seduh', 'address' => 'Jl. Raya No. 12, Serang', 'image' => '☕', 'category' => 'F&B'],
                    ['id' => 3, 'name' => 'Toko Kelontong Berkah', 'address' => 'Jl. Pasar No. 45, Serang', 'image' => '🏪', 'category' => 'Retail'],
                    ['id' => 4, 'name' => 'Bakso Mas Anto', 'address' => 'Jl. Merdeka No. 67, Serang', 'image' => '🍜', 'category' => 'F&B'],
                    ['id' => 5, 'name' => 'Roti Mama', 'address' => 'Jl. Melati No. 23, Serang', 'image' => '🍞', 'category' => 'F&B'],
                ];
                foreach ($businesses as $b): ?>
                    <div class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 p-6 text-center border border-gray-100 hover:border-green-200 transform hover:-translate-y-1">
                        <div class="w-24 h-24 mx-auto mb-4 bg-gradient-to-br from-green-100 to-green-200 rounded-full flex items-center justify-center text-5xl shadow-lg">
                            <?= $b['image'] ?>
                        </div>
                        <div class="mb-2">
                            <span class="text-xs bg-green-100 text-green-700 px-3 py-1 rounded-full font-medium"><?= $b['category'] ?></span>
                        </div>
                        <h4 class="font-semibold text-gray-900 mb-2 text-base"><?= $b['name'] ?></h4>
                        <p class="text-gray-500 text-sm mb-4 flex items-center justify-center">
                            <i class="fa-solid fa-location-dot mr-2"></i> <?= $b['address'] ?>
                        </p>
                        <a href="business_profile.php?id=<?= urlencode($b['id']) ?>" role="button" class="w-full inline-block bg-green-50 hover:bg-green-600 hover:text-white text-green-700 py-2.5 rounded-lg text-sm font-semibold transition-all text-center">
                            Buka Profil
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section id="produk" class="py-20 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between mb-12 text-center sm:text-left">
                <div>
                    <h3 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">Produk & Jasa Unggulan</h3>
                    <p class="text-gray-600 text-base md:text-lg">Temukan produk dan jasa berkualitas dari UMKM lokal</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <?php
                $products = [
                    ['id' => 0, 'name' => 'Sablon Kaos Custom Premium', 'price' => 'Rp 50.000', 'image' => '👕', 'seller' => 'Sablon Kreatif'],
                    ['id' => 1, 'name' => 'Keripik Singkong Original', 'price' => 'Rp 15.000', 'image' => '🥔', 'seller' => 'Keripik Renyah'],
                    ['id' => 2, 'name' => 'Kopi Arabika Lokal Premium', 'price' => 'Rp 25.000', 'image' => '☕', 'seller' => 'Warung Kopi Seduh'],
                    ['id' => 3, 'name' => 'Tas Rajut Handmade', 'price' => 'Rp 75.000', 'image' => '👜', 'seller' => 'Rajut Cantik'],
                    ['id' => 4, 'name' => 'Roti Manis Coklat Lembut', 'price' => 'Rp 12.000', 'image' => '🍞', 'seller' => 'Roti Mama'],
                    ['id' => 5, 'name' => 'Nasi Goreng Spesial', 'price' => 'Rp 18.000', 'image' => '🍛', 'seller' => 'Nasi Goreng Enak'],
                ];
                foreach ($products as $p): ?>
                    <div class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-green-200 transform hover:-translate-y-2">
                        <div class="aspect-[4/3] bg-gradient-to-br from-green-50 to-green-100 flex items-center justify-center text-8xl transition-transform duration-300">
                            <?= htmlspecialchars($p['image'], ENT_QUOTES, 'UTF-8') ?>
                        </div>
                        <div class="p-5">
                            <div class="text-xs text-gray-500 mb-2"><?= htmlspecialchars($p['seller'], ENT_QUOTES, 'UTF-8') ?></div>
                            <h4 class="font-semibold text-gray-900 mb-2 text-base"><?= htmlspecialchars($p['name'], ENT_QUOTES, 'UTF-8') ?></h4>
                            <p class="text-green-600 font-bold text-xl mb-4"><?= htmlspecialchars($p['price'], ENT_QUOTES, 'UTF-8') ?></p>
                            <a href="detail_product.php?id=<?= urlencode($p['id']) ?>" class="w-full inline-block bg-green-600 hover:bg-green-700 text-white py-2.5 rounded-lg text-sm font-semibold transition-all shadow-md hover:shadow-lg text-center">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="text-center mt-12">
                <button class="bg-white hover:bg-green-50 text-green-600 border-2 border-green-600 px-10 py-4 rounded-xl font-semibold text-lg transition-all shadow-md hover:shadow-lg">
                    Lihat Produk Lainnya →
                </button>
            </div>
        </div>
    </section>

    <!-- Footer -->
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

    <!-- Mobile Menu Script -->
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