<?php
// {{ route('products') }}
$products = [
    ['id' => 0, 'name' => 'Kopi Arabika 250g', 'price' => 'Rp35.000', 'image' => '☕', 'category' => 'F&B', 'seller' => 'Warung Kopi Seduh', 'description' => 'Kopi arabika sangrai medium roast, aroma wangi.'],
    ['id' => 1, 'name' => 'Roti Tawar 1kg', 'price' => 'Rp20.000', 'image' => '🍞', 'category' => 'F&B', 'seller' => 'Roti Mama', 'description' => 'Roti harian, empuk dan segar.'],
    ['id' => 2, 'name' => 'Kaos Custom Sablon', 'price' => 'Rp60.000', 'image' => '👕', 'category' => 'Retail', 'seller' => 'Sablon Kreatif', 'description' => 'Kaos katun 100% - desain custom.'],
    ['id' => 3, 'name' => 'Keripik Singkong 200g', 'price' => 'Rp12.000', 'image' => '🥔', 'category' => 'F&B', 'seller' => 'Keripik Singkong Renyah', 'description' => 'Renah, gurih, tanpa pengawet.'],
    ['id' => 4, 'name' => 'Bakso 10 pcs', 'price' => 'Rp25.000', 'image' => '🍜', 'category' => 'F&B', 'seller' => 'Bakso Mas Anto', 'description' => 'Bakso sapi original, cocok untuk keluarga.'],
    ['id' => 5, 'name' => 'Paket Sembako Mini', 'price' => 'Rp75.000', 'image' => '🛒', 'category' => 'Retail', 'seller' => 'Toko Kelontong Berkah', 'description' => 'Berisi beras, minyak, gula, dan kebutuhan pokok.'],
];
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Produk - UMKMTerdekat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/js/all.min.js" crossorigin="anonymous">
    </script>
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
                    <a href="{{ route('home') }}"
                        class="text-gray-700 hover:text-green-600 transition font-medium">Beranda</a>
                    <a href="{{ route('business') }}"
                        class="text-gray-700 hover:text-green-600 transition font-medium">Usaha</a>
                    <a href="{{ route('products') }}" class="text-green-600 font-semibold">Produk</a>
                    <a href="{{ route('contact') }}"
                        class="text-gray-700 hover:text-green-600 transition font-medium">Kontak</a>
                    <a href="{{ route('login') }}"
                        class="text-white px-4 py-2 rounded-lg bg-green-600 transition font-medium">Login</a>
                </nav>
            </div>

            <!-- Navbar (Mobile) -->
            <div id="mobile-menu"
                class="max-h-0 overflow-hidden opacity-0 transform scale-y-95 transition-all duration-300 ease-in-out origin-top lg:hidden flex-col space-y-2 mt-4">
                <a href="{{ route('home') }}" class="block text-gray-700 hover:text-green-600 font-medium">Beranda</a>
                <a href="{{ route('business') }}" class="block text-gray-700 hover:text-green-600 font-medium">Usaha</a>
                <a href="{{ route('products') }}" class="block text-green-600 font-semibold">Produk</a>
                <a href="{{ route('contact') }}" class="block text-gray-700 hover:text-green-600 font-medium">Kontak</a>
                <a href="{{ route('login') }}" class="block text-gray-700 hover:text-green-600 font-medium">Login</a>
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
                        <p class="text-lg font-semibold text-gray-900">Serang, Banten <span
                                class="text-xs text-gray-400">(Ubah lokasi sesuai kebutuhan)</span></p>
                    </div>
                </div>
                <div class="text-sm text-gray-500">
                    Koordinat: <span class="font-medium">-6.1200, 106.1500</span>
                </div>
            </div>

            <form action="all_businesses.php" method="get"
                class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                    <label for="q" class="sr-only">Cari usaha</label>
                    <input id="q" name="q" type="search" placeholder="Cari nama, kategori, atau alamat..."
                        class="w-full sm:flex-1 border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-200" />

                    <select name="category" class="w-full sm:w-48 border border-gray-200 rounded-lg px-3 py-3 bg-white">
                        <option value="">Semua Kategori</option>
                        <option value="F&B">F&B</option>
                        <option value="Retail">Retail</option>
                        <option value="Jasa">Jasa</option>
                    </select>

                    <button type="submit"
                        class="bg-green-600 text-white px-4 py-3 rounded-lg font-semibold hover:bg-green-700 flex items-center justify-center">
                        <i class="fa-solid fa-magnifying-glass mr-2"></i> Cari
                    </button>
                </div>
            </form>
        </div>

        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900">Produk</h2>
                    <p class="text-gray-600">Temukan produk lokal dari pelaku UMKM</p>
                </div>
                <a href="{{ route('business') }}" class="text-green-600 hover:underline">← Kembali</a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php foreach ($products as $p): ?>
                <div
                    class="bg-white rounded-2xl shadow-md p-6 border border-gray-100 hover:shadow-2xl transition transform hover:-translate-y-1">
                    <div
                        class="w-20 h-20 mx-auto mb-4 bg-gradient-to-br from-green-100 to-green-200 rounded-full flex items-center justify-center text-4xl shadow-lg">
                        <?= htmlspecialchars($p['image'], ENT_QUOTES, 'UTF-8') ?>
                    </div>
                    <div class="text-center mb-2">
                        <span class="text-xs bg-green-100 text-green-700 px-3 py-1 rounded-full">
                            <?= htmlspecialchars($p['category'], ENT_QUOTES, 'UTF-8') ?>
                        </span>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-1 text-lg text-center">
                        <?= htmlspecialchars($p['name'], ENT_QUOTES, 'UTF-8') ?>
                    </h3>
                    <p class="text-green-600 font-bold text-center">
                        <?= htmlspecialchars($p['price'], ENT_QUOTES, 'UTF-8') ?>
                    </p>
                    <p class="text-gray-500 text-sm mb-3 text-center"><i class="fa-solid fa-shop mr-2"></i>
                        <?= htmlspecialchars($p['seller'], ENT_QUOTES, 'UTF-8') ?>
                    </p>
                    <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                        <?= htmlspecialchars($p['description'], ENT_QUOTES, 'UTF-8') ?>
                    </p>
                    <div class="mt-4">
                        <a href="{{ route('detail-product') }}?id=<?= urlencode($p['id']) ?>"
                            class="w-full inline-block bg-green-600 hover:bg-green-700 text-white py-2.5 rounded-lg text-sm font-semibold text-center">Lihat
                            Produk</a>
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
                    <p class="text-green-100 leading-relaxed">Platform terpercaya untuk menemukan dan mendukung UMKM
                        lokal di seluruh Indonesia</p>
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