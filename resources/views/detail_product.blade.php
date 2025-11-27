<?php
// Simple product dataset and selection logic
$products = [
    ['id'=>0, 'name' => 'Sablon Kaos Custom Premium', 'price' => 'Rp 50.000', 'image' => '👕', 'seller' => 'Sablon Kreatif', 'description' => 'Sablon kaos custom dengan tinta berkualitas, cocok untuk komunitas, event, dan brand kecil. Pilihan bahan: Combed 20s / 30s.', 'features' => ['Cetak berkualitas tinggi', 'Bisa desain custom', 'Fast turnaround 3-5 hari'], 'stock'=>25, 'maps'=>'https://www.google.com/maps/search/?api=1&query=Sablon+Kreatif+Indonesia', 'whatsapp'=>'+6281234567890', 'address'=>'Jl. Merdeka No.10, Bandung'],
    ['id'=>1, 'name' => 'Keripik Singkong Original', 'price' => 'Rp 15.000', 'image' => '🥔', 'seller' => 'Keripik Renyah', 'description' => 'Keripik singkong gurih dan renyah tanpa pengawet, dikemas rapi untuk oleh-oleh dan snack harian.', 'features' => ['Tanpa pengawet', 'Kemasan 150gr', 'Cemilan favorit keluarga'], 'stock'=>50, 'maps'=>'https://www.google.com/maps/search/?api=1&query=Keripik+Renyah+Indonesia', 'whatsapp'=>'+628219876543', 'address'=>'Jl. Pahlawan No.5, Yogyakarta'],
    ['id'=>2, 'name' => 'Kopi Arabika Lokal Premium', 'price' => 'Rp 25.000', 'image' => '☕', 'seller' => 'Warung Kopi Seduh', 'description' => 'Biji kopi Arabika pilihan, dipanggang medium roast untuk aroma dan rasa seimbang. Cocok untuk espresso dan manual brew.', 'features' => ['Asal: Gayo/Sumatera', 'Kemasan 250gr', 'Aroma kuat, body seimbang'], 'stock'=>10, 'maps'=>'https://www.google.com/maps/search/?api=1&query=Warung+Kopi+Seduh+Indonesia', 'whatsapp'=>'+628135792468', 'address'=>'Jl. Teuku Umar No.21, Aceh'],
    ['id'=>3, 'name' => 'Tas Rajut Handmade', 'price' => 'Rp 75.000', 'image' => '👜', 'seller' => 'Rajut Cantik', 'description' => 'Tas rajut tangan unik, cocok untuk hadiah dan fashion sehari-hari. Setiap tas unik dengan sedikit variasi warna.', 'features' => ['Handmade', 'Bahan katun premium', 'Beragam warna tersedia'], 'stock'=>5, 'maps'=>'https://www.google.com/maps/search/?api=1&query=Rajut+Cantik+Indonesia', 'whatsapp'=>'+628778665544', 'address'=>'Jl. Anyelir No.3, Bali'],
    ['id'=>4, 'name' => 'Roti Manis Coklat Lembut', 'price' => 'Rp 12.000', 'image' => '🍞', 'seller' => 'Roti Mama', 'description' => 'Roti manis dengan isian coklat yang lembut, dipanggang tiap pagi untuk kesegaran maksimal.', 'features' => ['Fresh daily', 'Isian coklat premium', 'Cocok untuk sarapan'], 'stock'=>0, 'maps'=>'https://www.google.com/maps/search/?api=1&query=Roti+Mama+Indonesia', 'whatsapp'=>'+6281122334455', 'address'=>'Jl. Raya No.12, Jakarta'],
    ['id'=>5, 'name' => 'Nasi Goreng Spesial', 'price' => 'Rp 18.000', 'image' => '🍛', 'seller' => 'Nasi Goreng Enak', 'description' => 'Nasi goreng dengan resep rumahan, porsi besar dan bumbu meresap. Bisa request level pedas.', 'features' => ['Porsi besar', 'Dilengkapi telur & acar', 'Bisa pesan antar'], 'stock'=>20, 'maps'=>'https://www.google.com/maps/search/?api=1&query=Nasi+Goreng+Enak+Indonesia', 'whatsapp'=>'+628998877665', 'address'=>'Jl. Sudirman No.45, Surabaya'],
];

// Choose product by ?id (default 0)
$selectedId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$selected = null;
foreach ($products as $p) {
    if ($p['id'] === $selectedId) { $selected = $p; break; }
}
if ($selected === null) { $selected = $products[0]; $selectedId = $products[0]['id']; }

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        <?= htmlspecialchars($selected['name']) ?> — UMKMTerdekat
    </title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/js/all.min.js" crossorigin="anonymous">
    </script>
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
                    <a href="{{ route('home') }}"
                        class="text-gray-700 hover:text-green-600 transition font-medium">Beranda</a>
                    <a href="{{ route('business') }}"
                        class="text-gray-700 hover:text-green-600 transition font-medium">Usaha</a>
                    <a href="{{ route('products') }}"
                        class="text-gray-700 hover:text-green-600 transition font-medium">Produk</a>
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
                <a href="{{ route('products') }}"
                    class="block text-gray-700 hover:text-green-600 font-medium">Produk</a>
                <a href="{{ route('contact') }}" class="block text-gray-700 hover:text-green-600 font-medium">Kontak</a>
                <a href="{{ route('login') }}" class="block text-gray-700 hover:text-green-600 font-medium">Login</a>
            </div>
        </div>
    </header>

    <!-- Product Detail Section -->
    <main class="py-12">
        <div class="max-w-6xl mx-auto px-6">
            <nav class="text-sm text-gray-500 mb-6">
                <a href="{{ route('home') }}" class="hover:text-green-600">Beranda</a> <a href="#produk"
                    class="hover:text-green-600">Produk</a> <span class="text-gray-800">
                    <?= htmlspecialchars($selected['name']) ?>
                </span>
            </nav>

            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6 items-start">
                    <!-- Image -->
                    <div class="md:col-span-1 flex items-center justify-center">
                        <div
                            class="w-full max-w-md bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-8 text-center">
                            <div class="text-[8rem] mb-4">
                                <?= htmlspecialchars($selected['image']) ?>
                            </div>
                            <div class="text-sm text-gray-500">Penjual</div>
                            <div class="font-semibold text-lg text-gray-900">
                                <?= htmlspecialchars($selected['seller']) ?>
                            </div>
                        </div>
                    </div>

                    <!-- Info -->
                    <div class="md:col-span-2">
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">
                            <?= htmlspecialchars($selected['name']) ?>
                        </h1>
                        <div class="flex items-center justify-between md:justify-start gap-6 mb-4">
                            <div class="text-2xl font-bold text-green-600">
                                <?= htmlspecialchars($selected['price']) ?>
                            </div>
                            <div class="text-sm text-gray-500">Stok: <span class="font-semibold text-gray-700">
                                    <?= (int)$selected['stock'] ?>
                                </span></div>
                        </div>

                        <p class="text-gray-700 mb-6">
                            <?= htmlspecialchars($selected['description']) ?>
                        </p>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                            <div>
                                <h4 class="text-sm font-semibold mb-2">Fitur</h4>
                                <ul class="list-disc list-inside text-gray-600">
                                    <?php foreach ($selected['features'] as $f): ?>
                                    <li>
                                        <?= htmlspecialchars($f) ?>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold mb-2">Informasi Penjual</h4>
                                <?php
                                    // Jika Anda punya business id terpisah, ganti $businessId dengan nilai tersebut.
                                    $businessId = (int)$selectedId;
                                    $businessUrl = "business_profile.php?id=" . $businessId;
                                ?>
                                <a href="<?= htmlspecialchars($businessUrl) ?>"
                                    class="inline-flex items-center gap-3 w-full sm:w-auto justify-center border-2 border-green-600 text-green-600 hover:bg-green-50 px-4 py-2 rounded-xl text-sm font-semibold transition">
                                    <i class="fa-solid fa-store"></i>
                                    <div class="text-left">
                                        <div class="font-semibold">
                                            <?= htmlspecialchars($selected['seller']) ?>
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            <?= htmlspecialchars($selected['address']) ?>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4">
                            <?php
                                // prepare whatsapp and maps links
                                $phone = preg_replace('/\D+/', '', $selected['whatsapp']); // remove any non-digit chars
                                $waText = rawurlencode("Halo, saya tertarik dengan produk \"{$selected['name']}\". Apakah masih tersedia?");
                                $waLink = "https://wa.me/{$phone}?text={$waText}";
                                $mapsLink = $selected['maps'];
                            ?>
                            <a href="<?= htmlspecialchars($mapsLink) ?>" target="_blank" rel="noopener noreferrer"
                                class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl text-sm font-semibold transition shadow-md flex items-center gap-2">
                                <i class="fa-solid fa-location-dot"></i> Lihat Rute Ke Penjual
                            </a>

                            <a href="<?= htmlspecialchars($waLink) ?>" target="_blank" rel="noopener noreferrer"
                                class="bg-white border-2 border-green-600 text-green-600 hover:bg-green-50 px-6 py-3 rounded-xl text-sm font-semibold transition flex items-center gap-2">
                                <i class="fa-brands fa-whatsapp"></i> Hubungi Penjual via WhatsApp
                            </a>
                        </div>

                        <?php if ($selected['stock'] <= 0): ?>
                        <div class="mt-4 text-sm text-red-600">Stok habis — silakan hubungi penjual untuk ketersediaan.
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Other Products -->
            <section id="produk" class="mt-12">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Produk Lainnya</h2>
                    <a href="{{ route('home') }}#produk" class="text-green-600 hover:underline text-sm">Lihat Semua</a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    <?php foreach ($products as $p): if ($p['id'] === $selectedId) continue; ?>
                    <a href="?id=<?= htmlspecialchars($p['id']) ?>"
                        class="block bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all overflow-hidden border border-gray-100 hover:border-green-200 transform hover:-translate-y-1">
                        <div
                            class="aspect-[4/3] bg-gradient-to-br from-green-50 to-green-100 flex items-center justify-center text-8xl transition-transform duration-300">
                            <?= htmlspecialchars($p['image']) ?>
                        </div>
                        <div class="p-4">
                            <div class="text-xs text-gray-500 mb-1">
                                <?= htmlspecialchars($p['seller']) ?>
                            </div>
                            <h4 class="font-semibold text-gray-900 mb-1">
                                <?= htmlspecialchars($p['name']) ?>
                            </h4>
                            <div class="text-green-600 font-bold">
                                <?= htmlspecialchars($p['price']) ?>
                            </div>
                        </div>
                    </a>
                    <?php endforeach; ?>
                </div>
            </section>
        </div>
    </main>

    <!-- Footer -->
    <footer id="kontak" class="bg-gradient-to-br from-green-600 to-green-700 text-white py-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12 mb-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="bg-white p-2 rounded-xl">
                            <i class="fa-solid fa-store text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold">UMKMTerdekat</h4>
                            <p class="text-green-100 text-xs">Dukung Usaha Lokal</p>
                        </div>
                    </div>
                    <p class="text-green-100 leading-relaxed text-sm">Platform terpercaya untuk menemukan dan mendukung
                        UMKM lokal di seluruh Indonesia</p>
                </div>

                <div>
                    <h5 class="font-bold text-lg mb-4">Tentang Kami</h5>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="text-green-100 hover:text-white transition">Tentang Platform</a></li>
                        <li><a href="#" class="text-green-100 hover:text-white transition">Cara Kerja</a></li>
                        <li><a href="#" class="text-green-100 hover:text-white transition">Kebijakan Privasi</a></li>
                    </ul>
                </div>

                <div>
                    <h5 class="font-bold text-lg mb-4">Hubungi Kami</h5>
                    <div class="space-y-3 text-sm">
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
                    <h5 class="font-bold text-lg mb-4">Ikuti Kami</h5>
                    <div class="flex items-center space-x-3 mb-4">
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

            <div class="border-t border-green-500 pt-6 text-center text-green-100 text-sm">
                &copy;
                <?= date('Y') ?> <strong>UMKMTerdekat</strong>. Semua Hak Dilindungi.
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