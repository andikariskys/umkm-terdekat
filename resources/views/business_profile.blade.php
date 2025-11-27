<?php
// Simple business dataset and selection logic
$businesses = [
    ['id' => 0, 'name' => 'Sablon Kreatif', 'category' => 'Jasa Sablon', 'owner' => 'Andi Prasetyo', 'phone' => '+62 812-3456-7890', 'whatsapp' => '+6281234567890', 'address' => 'Jalan Melati No.12, Jakarta', 'logo' => '👕', 'description' => 'Sablon kaos custom dengan tinta berkualitas, cocok untuk komunitas, event, dan brand kecil. Pilihan bahan: Combed 20s / 30s.', 'services' => ['Sablon Manual', 'Sablon Digital', 'Desain Custom'], 'opening_hours' => 'Senin - Sabtu, 09:00 - 17:00', 'maps' => 'https://www.google.com/maps/search/?api=1&query=Sablon+Kreatif+Indonesia', 'instagram' => '@sablonkreatif', 'email' => 'sablon@kreatif.co'],
    ['id' => 1, 'name' => 'Keripik Renyah', 'category' => 'Makanan Ringan', 'owner' => 'Siti Rahma', 'phone' => '+62 821-9876-5432', 'whatsapp' => '+628219876543', 'address' => 'Komplek UKM Blok B, Bandung', 'logo' => '🥔', 'description' => 'Keripik singkong gurih dan renyah tanpa pengawet, dikemas rapi untuk oleh-oleh dan snack harian.', 'services' => ['Kemasan 150gr', 'Kemasan 500gr', 'Pesan Grosir'], 'opening_hours' => 'Setiap Hari, 07:00 - 20:00', 'maps' => 'https://www.google.com/maps/search/?api=1&query=Keripik+Renyah+Indonesia', 'instagram' => '@keripikrenyah', 'email' => 'info@keripikrenyah.id'],
    ['id' => 2, 'name' => 'Warung Kopi Seduh', 'category' => 'Kopi & Kafe', 'owner' => 'Budi Santoso', 'phone' => '+62 813-5792-468', 'whatsapp' => '+628135792468', 'address' => 'Jl. Kopi No.8, Aceh', 'logo' => '☕', 'description' => 'Biji kopi Arabika pilihan, dipanggang medium roast untuk aroma dan rasa seimbang. Cocok untuk espresso dan manual brew.', 'services' => ['Kopi Espresso', 'Manual Brew', 'Biji Kemasan 250gr'], 'opening_hours' => 'Selasa - Minggu, 08:00 - 18:00', 'maps' => 'https://www.google.com/maps/search/?api=1&query=Warung+Kopi+Seduh+Indonesia', 'instagram' => '@warungkopiseduh', 'email' => 'halo@kopiseduh.id'],
    ['id' => 3, 'name' => 'Toko Kelontong Berkah', 'category' => 'Retail', 'owner' => 'Agus Santoso', 'phone' => '+62 812-3456-7789', 'whatsapp' => '+6281234567789', 'address' => 'Jl. Pasar No. 45, Serang', 'logo' => '🏪', 'description' => 'Toko kelontong lengkap dengan kebutuhan harian, sembako, dan layanan pulsa serta pembayaran tagihan. Ramah dan buka hingga malam.', 'services' => ['Sembako', 'Pulsa & Token', 'Pembayaran Tagihan'], 'opening_hours' => 'Setiap Hari, 06:30 - 21:00', 'maps' => 'https://www.google.com/maps/search/?api=1&query=Toko+Kelontong+Berkah+Serang', 'instagram' => '@tokoberkah_serang', 'email' => 'tokoberkah.serang@gmail.com'],
    ['id' => 4, 'name' => 'Bakso Mas Anto', 'category' => 'F&B', 'owner' => 'Anto Wijaya', 'phone' => '+62 813-2223-5566', 'whatsapp' => '+6281322235566', 'address' => 'Jl. Merdeka No. 67, Serang', 'logo' => '🍜', 'description' => 'Bakso rumahan dengan kuah gurih dan bakso kenyal. Favorit warga setempat, tersedia paket keluarga dan level pedas sesuai selera.', 'services' => ['Bakso Original', 'Bakso Spesial', 'Paket Keluarga'], 'opening_hours' => 'Setiap Hari, 11:00 - 22:00', 'maps' => 'https://www.google.com/maps/search/?api=1&query=Bakso+Mas+Anto+Serang', 'instagram' => '@baksomasanto', 'email' => 'masanto.bakso@gmail.com'],
    ['id' => 5, 'name' => 'Roti Mama', 'category' => 'F&B', 'owner' => 'Siti Nurhayati', 'phone' => '+62 819-3344-1122', 'whatsapp' => '+6281933441122', 'address' => 'Jl. Melati No. 23, Serang', 'logo' => '🍞', 'description' => 'Toko roti & kue rumahan, menyediakan roti tawar, pastry, dan kue untuk berbagai acara. Dikenal karena roti yang selalu fresh setiap pagi.', 'services' => ['Roti Tawar', 'Kue & Pastry', 'Pesan Katering'], 'opening_hours' => 'Senin - Sabtu, 05:00 - 15:00', 'maps' => 'https://www.google.com/maps/search/?api=1&query=Roti+Mama+Serang', 'instagram' => '@rotimama_serang', 'email' => 'rotimama.serang@gmail.com'],
];

// Choose business by ?id (default 0)
$selectedId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$selected = null;
foreach ($businesses as $b) {
    if ($b['id'] === $selectedId) {
        $selected = $b;
        break;
    }
}
if ($selected === null) {
    $selected = $businesses[0];
    $selectedId = $businesses[0]['id'];
}

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        <?= htmlspecialchars($selected['name']) ?> — Profil Bisnis — UMKMTerdekat
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
                <div class="flex items-center space-x-3">
                    <div class="bg-green-600 p-2 rounded-xl">
                        <i class="fa-solid fa-store text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-green-700">UMKMTerdekat</h1>
                        <p class="text-xs text-gray-500">Dukung Usaha Lokal</p>
                    </div>
                </div>

                <button id="menu-btn" class="lg:hidden text-gray-600 text-2xl focus:outline-none">
                    <i class="fa-solid fa-bars"></i>
                </button>

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

    <!-- Business Profile -->
    <main class="py-12">
        <div class="max-w-6xl mx-auto px-6">
            <nav class="text-sm text-gray-500 mb-6">
                <a href="{{ route('home') }}" class="hover:text-green-600">Beranda</a> <span class="mx-2">/</span>
                <a href="{{ route('business') }}" class="hover:text-green-600">Usaha</a> <span class="mx-2">/</span>
                <span class="text-gray-800">
                    <?= htmlspecialchars($selected['name']) ?>
                </span>
            </nav>

            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6 items-start">
                    <!-- Logo & Basic -->
                    <div class="md:col-span-1 flex items-center justify-center">
                        <div
                            class="w-full max-w-md bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-8 text-center">
                            <div class="text-[6rem] mb-4">
                                <?= htmlspecialchars($selected['logo']) ?>
                            </div>
                            <div class="text-sm text-gray-500">
                                <?= htmlspecialchars($selected['category']) ?>
                            </div>
                            <div class="font-semibold text-lg text-gray-900">
                                <?= htmlspecialchars($selected['name']) ?>
                            </div>
                            <div class="text-xs text-gray-500">Pemilik:
                                <?= htmlspecialchars($selected['owner']) ?>
                            </div>

                            <div class="mt-4 flex items-center justify-center gap-2">
                                <div class="text-xs text-gray-500">
                                    <?= htmlspecialchars($selected['opening_hours']) ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Info -->
                    <div class="md:col-span-2">
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">
                            <?= htmlspecialchars($selected['name']) ?>
                        </h1>

                        <p class="text-gray-700 mb-4">
                            <?= htmlspecialchars($selected['description']) ?>
                        </p>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                            <div>
                                <h4 class="text-sm font-semibold mb-2">Layanan / Produk</h4>
                                <ul class="list-disc list-inside text-gray-600">
                                    <?php foreach ($selected['services'] as $s): ?>
                                    <li>
                                        <?= htmlspecialchars($s) ?>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold mb-2">Detail Kontak & Lokasi</h4>
                                <div class="text-gray-600 space-y-1">
                                    <div><strong>Alamat:</strong>
                                        <?= htmlspecialchars($selected['address']) ?>
                                    </div>
                                    <div><strong>Telepon:</strong>
                                        <?= htmlspecialchars($selected['phone']) ?>
                                    </div>
                                    <div><strong>Email:</strong>
                                        <?= htmlspecialchars($selected['email']) ?>
                                    </div>
                                    <div><strong>Instagram:</strong>
                                        <?= htmlspecialchars($selected['instagram']) ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4">
                            <?php
                            // prepare whatsapp and maps links
                            $phoneDigits = preg_replace('/\D+/', '', $selected['whatsapp']); // remove any non-digit chars
                            $waText = rawurlencode("Halo, saya ingin menanyakan tentang usaha \"%s\". Apakah bisa dibantu?"); // will replace below
                            $waText = rawurlencode(sprintf("Halo, saya ingin menanyakan tentang usaha \"%s\". Apakah masih buka hari ini?", $selected['name']));
                            $waLink = "https://wa.me/{$phoneDigits}?text={$waText}";
                            $mapsLink = $selected['maps'];
                            $telLink = 'tel:' . preg_replace('/\D+/', '', $selected['phone']);
                            ?>
                            <a href="<?= htmlspecialchars($mapsLink) ?>" target="_blank" rel="noopener noreferrer"
                                class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl text-sm font-semibold transition shadow-md flex items-center gap-2">
                                <i class="fa-solid fa-location-dot"></i> Lihat Lokasi & Rute
                            </a>

                            <a href="<?= htmlspecialchars($waLink) ?>" target="_blank" rel="noopener noreferrer"
                                class="bg-white border-2 border-green-600 text-green-600 hover:bg-green-50 px-6 py-3 rounded-xl text-sm font-semibold transition flex items-center gap-2">
                                <i class="fa-brands fa-whatsapp"></i> Hubungi via WhatsApp
                            </a>
                        </div>

                        <div class="mt-4 text-sm text-gray-500">
                            <strong>Jam Operasional:</strong>
                            <?= htmlspecialchars($selected['opening_hours']) ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Produk Toko (static sample data) -->
            <?php
            $products = [
                ['id' => 0, 'name' => 'Kaos Sablon Custom', 'price' => 'Rp 70.000', 'image' => '👕', 'desc' => 'Kaos cotton combed 20s, sablon manual. Minimum 1 pcs.'],
                ['id' => 1, 'name' => 'Paket Keripik 500gr', 'price' => 'Rp 25.000', 'image' => '🥔', 'desc' => 'Keripik singkong renyah, tanpa pengawet, cocok untuk oleh-oleh.'],
                ['id' => 2, 'name' => 'Kopi Kemasan 250gr', 'price' => 'Rp 50.000', 'image' => '☕', 'desc' => 'Biji Arabika medium roast, cocok untuk espresso dan manual brew.'],
                ['id' => 3, 'name' => 'Gula Premium 1000gr', 'price' => 'Rp 20.000', 'image' => '🍬', 'desc' => 'Gula premium berkualitas tinggi, cocok untuk kebutuhan rumah tangga dan usaha.'],
                ['id' => 4, 'name' => 'Bakso Spesial', 'price' => 'Rp 40.000', 'image' => '🍜', 'desc' => 'Bakso kenyal dengan kuah gurih, tersedia dalam paket keluarga.'],
            ];
            ?>
            <section id="produk" class="mt-12">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Produk dari
                        <?= htmlspecialchars($selected['name']) ?>
                    </h2>
                    <a href="{{ route('home') }}#produk" class="text-green-600 hover:underline text-sm">Lihat Semua</a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    <?php foreach ($products as $p): ?>
                    <div
                        class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-green-200 transform hover:-translate-y-2">
                        <div
                            class="aspect-[4/3] bg-gradient-to-br from-green-50 to-green-100 flex items-center justify-center text-8xl transition-transform duration-300">
                            <?= htmlspecialchars($p['image'], ENT_QUOTES, 'UTF-8') ?>
                        </div>
                        <div class="p-5">
                            <h4 class="font-semibold text-gray-900 mb-2 text-base">
                                <?= htmlspecialchars($p['name'], ENT_QUOTES, 'UTF-8') ?>
                            </h4>
                            <p class="text-green-600 font-bold text-xl mb-4">
                                <?= htmlspecialchars($p['price'], ENT_QUOTES, 'UTF-8') ?>
                            </p>
                            <a href="detail_product.php?id=<?= urlencode($p['id']) ?>"
                                class="w-full inline-block bg-green-600 hover:bg-green-700 text-white py-2.5 rounded-lg text-sm font-semibold transition-all shadow-md hover:shadow-lg text-center">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </section></a>
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