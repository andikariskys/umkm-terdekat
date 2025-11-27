<?php
$businesses = [
    ['id' => 0, 'name' => 'Warung Kopi Seduh', 'address' => 'Jl. Raya No. 12, Serang', 'image' => '☕', 'category' => 'F&B', 'phone' => '+62 812-0000-0000', 'email' => 'kopiseduh@example.com', 'description' => 'Kopi arabika lokal, suasana nyaman untuk nongkrong.'],
    ['id' => 1, 'name' => 'Toko Kelontong Berkah', 'address' => 'Jl. Pasar No. 45, Serang', 'image' => '🏪', 'category' => 'Retail', 'phone' => '+62 812-1111-1111', 'email' => 'berkah@example.com', 'description' => 'Toko kelontong lengkap dengan kebutuhan sehari-hari.'],
    ['id' => 2, 'name' => 'Sablon Kreatif', 'address' => 'Jl. Industri No. 8, Serang', 'image' => '👕', 'category' => 'Jasa', 'phone' => '+62 812-2222-2222', 'email' => 'sablon@example.com', 'description' => 'Sablon kaos custom untuk komunitas dan event.'],
    ['id' => 3, 'name' => 'Keripik Singkong Renyah', 'address' => 'Jl. Sudirman No. 23, Serang', 'image' => '🥔', 'category' => 'F&B', 'phone' => '+62 812-3333-3333', 'email' => 'keripik@example.com', 'description' => 'Keripik singkong homemade tanpa pengawet.'],
    ['id' => 4, 'name' => 'Bakso Mas Anto', 'address' => 'Jl. Merdeka No. 67, Serang', 'image' => '🍜', 'category' => 'F&B', 'phone' => '+62 812-4444-4444', 'email' => 'baksoanto@example.com', 'description' => 'Bakso sapi original dengan kuah gurih.'],
    ['id' => 5, 'name' => 'Roti Mama', 'address' => 'Jl. Melati No. 23, Serang', 'image' => '🍞', 'category' => 'F&B', 'phone' => '+62 812-5555-5555', 'email' => 'rotimama@example.com', 'description' => 'Roti harian, kue basah, dan pesanan ulang tahun.'],
];

?>
@extends('templates.anonymous')
@section('title', 'Usaha')
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
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900">Semua Profil Usaha</h2>
                    <p class="text-gray-600">Daftar lengkap profil UMKM yang terdaftar di platform</p>
                </div>
                <div>
                    <a href="{{ route('business') }}" class="text-green-600 hover:text-green-700 font-semibold">←
                        Kembali ke
                        Beranda</a>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php foreach ($businesses as $b): ?>
                <div
                    class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 p-6 border border-gray-100 hover:border-green-200 transform hover:-translate-y-1">
                    <div
                        class="w-20 h-20 mx-auto mb-4 bg-gradient-to-br from-green-100 to-green-200 rounded-full flex items-center justify-center text-4xl shadow-lg">
                        <?= htmlspecialchars($b['image'], ENT_QUOTES, 'UTF-8') ?>
                    </div>

                    <div class="mb-2 text-center">
                        <span class="text-xs bg-green-100 text-green-700 px-3 py-1 rounded-full font-medium">
                            <?= htmlspecialchars($b['category'], ENT_QUOTES, 'UTF-8') ?>
                        </span>
                    </div>

                    <h3 class="font-semibold text-gray-900 mb-1 text-lg text-center">
                        <?= htmlspecialchars($b['name'], ENT_QUOTES, 'UTF-8') ?>
                    </h3>

                    <p class="text-gray-500 text-sm mb-3 text-center"><i class="fa-solid fa-location-dot mr-2"></i>
                        <?= htmlspecialchars($b['address'], ENT_QUOTES, 'UTF-8') ?>
                    </p>

                    <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                        <?= htmlspecialchars($b['description'], ENT_QUOTES, 'UTF-8') ?>
                    </p>

                    <div class="text-sm text-gray-700 mb-3 space-y-1">
                        <div class="flex items-center justify-center space-x-2">
                            <i class="fa-solid fa-phone text-green-600"></i>
                            <span>
                                <?= htmlspecialchars($b['phone'], ENT_QUOTES, 'UTF-8') ?>
                            </span>
                        </div>
                        <div class="flex items-center justify-center space-x-2">
                            <i class="fa-solid fa-envelope text-green-600"></i>
                            <span>
                                <?= htmlspecialchars($b['email'], ENT_QUOTES, 'UTF-8') ?>
                            </span>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('business-profile') }}?id=<?= urlencode($b['id']) ?>"
                            class="w-full inline-block bg-green-600 hover:bg-green-700 text-white py-2.5 rounded-lg text-sm font-semibold transition-all text-center">
                            Buka Profil
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>
@endsection