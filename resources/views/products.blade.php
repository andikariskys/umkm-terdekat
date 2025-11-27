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

@extends('templates.anonymous')

@section('title', 'Produk')

@section('content')
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
@endsection