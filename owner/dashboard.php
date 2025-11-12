<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'pemilik') {
    header('Location: ../login.php');
    exit;
}

$user = $_SESSION['user'];

// Data produk dummy
$myProducts = [
    ['id' => 1, 'name' => 'Kopi Arabika Premium', 'price' => 'Rp 25.000', 'stock' => 50, 'sold' => 120, 'image' => '☕', 'status' => 'Aktif'],
    ['id' => 2, 'name' => 'Kopi Robusta Lokal', 'price' => 'Rp 20.000', 'stock' => 30, 'sold' => 80, 'image' => '☕', 'status' => 'Aktif'],
    ['id' => 3, 'name' => 'Kopi Luwak Special', 'price' => 'Rp 45.000', 'stock' => 0, 'sold' => 45, 'image' => '☕', 'status' => 'Stok Habis'],
    ['id' => 4, 'name' => 'Paket Kopi Mix', 'price' => 'Rp 60.000', 'stock' => 20, 'sold' => 35, 'image' => '☕', 'status' => 'Aktif'],
];

// Data transaksi masuk
$incomingOrders = [
    ['id' => '#ORD001', 'customer' => 'Budi Santoso', 'product' => 'Kopi Arabika Premium', 'qty' => 2, 'total' => 'Rp 50.000', 'status' => 'Menunggu'],
    ['id' => '#ORD002', 'customer' => 'Siti Aminah', 'product' => 'Kopi Robusta Lokal', 'qty' => 3, 'total' => 'Rp 60.000', 'status' => 'Diproses'],
    ['id' => '#ORD003', 'customer' => 'Ahmad Yani', 'product' => 'Paket Kopi Mix', 'qty' => 1, 'total' => 'Rp 60.000', 'status' => 'Selesai'],
];

// Statistik penjualan
$salesStats = [
    'today' => 'Rp 350.000',
    'thisWeek' => 'Rp 2.100.000',
    'thisMonth' => 'Rp 8.500.000',
    'total' => 'Rp 25.000.000'
];
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pemilik - UMKMTerdekat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/js/all.min.js"></script>
</head>

<body class="bg-gray-50 min-h-screen">
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
                        <p class="text-xs text-gray-500">Dashboard Pemilik</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <div class="text-right hidden sm:block">
                            <p class="font-semibold text-gray-900"><?= $user['name'] ?></p>
                            <p class="text-xs text-gray-500"><?= $user['business'] ?></p>
                        </div>
                        <div class="bg-green-100 p-2 rounded-lg">
                            <i class="fa-solid fa-store text-green-600"></i>
                        </div>
                    </div>
                    <a href="../logout.php" class="text-red-600 hover:bg-red-50 p-2 rounded-lg transition">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Welcome Section -->
        <div class="bg-gradient-to-r from-green-600 to-green-700 rounded-2xl p-8 mb-8 text-white">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold mb-2">Selamat Datang, <?= explode(' ', $user['name'])[0] ?>! 🏪</h2>
                    <p class="text-green-100 mb-4">Kelola usaha <strong><?= $user['business'] ?></strong> dengan mudah</p>
                    <button class="bg-white text-green-600 px-6 py-2 rounded-lg font-semibold hover:bg-green-50 transition">
                        <i class="fa-solid fa-plus mr-2"></i>Tambah Produk Baru
                    </button>
                </div>
                <div class="text-6xl mt-4 md:mt-0 hidden md:block">📊</div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 mb-8">
            <div class="bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-green-100 p-3 rounded-lg">
                        <i class="fa-solid fa-money-bill-wave text-green-600 text-xl"></i>
                    </div>
                    <span class="text-xs text-green-600 font-semibold">Hari Ini</span>
                </div>
                <h3 class="text-2xl font-bold text-gray-900"><?= $salesStats['today'] ?></h3>
                <p class="text-gray-600 text-sm">Pendapatan</p>
            </div>
            <div class="bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-blue-100 p-3 rounded-lg">
                        <i class="fa-solid fa-box text-blue-600 text-xl"></i>
                    </div>
                    <span class="text-xs text-blue-600 font-semibold">Total</span>
                </div>
                <h3 class="text-2xl font-bold text-gray-900"><?= count($myProducts) ?></h3>
                <p class="text-gray-600 text-sm">Produk Aktif</p>
            </div>
            <div class="bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-orange-100 p-3 rounded-lg">
                        <i class="fa-solid fa-shopping-cart text-orange-600 text-xl"></i>
                    </div>
                    <span class="text-xs text-orange-600 font-semibold">Baru</span>
                </div>
                <h3 class="text-2xl font-bold text-gray-900">5</h3>
                <p class="text-gray-600 text-sm">Pesanan Masuk</p>
            </div>
            <div class="bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-purple-100 p-3 rounded-lg">
                        <i class="fa-solid fa-chart-line text-purple-600 text-xl"></i>
                    </div>
                    <span class="text-xs text-purple-600 font-semibold">Bulan Ini</span>
                </div>
                <h3 class="text-2xl font-bold text-gray-900"><?= $salesStats['thisMonth'] ?></h3>
                <p class="text-gray-600 text-sm">Total Penjualan</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Kelola Produk -->
                <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-900">Kelola Produk</h3>
                        <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-semibold text-sm transition">
                            <i class="fa-solid fa-plus mr-2"></i>Tambah Produk
                        </button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b-2 border-gray-200">
                                <tr>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Produk</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Harga</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Stok</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Terjual</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                                    <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <?php foreach ($myProducts as $product): ?>
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-4 py-3">
                                            <div class="flex items-center space-x-3">
                                                <span class="text-2xl"><?= $product['image'] ?></span>
                                                <span class="font-medium text-gray-900"><?= $product['name'] ?></span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-gray-900 font-semibold"><?= $product['price'] ?></td>
                                        <td class="px-4 py-3">
                                            <span class="<?= $product['stock'] > 0 ? 'text-gray-900' : 'text-red-600 font-semibold' ?>">
                                                <?= $product['stock'] ?>
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-gray-700"><?= $product['sold'] ?></td>
                                        <td class="px-4 py-3">
                                            <span class="text-xs px-2 py-1 rounded-full <?= $product['status'] === 'Aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' ?>">
                                                <?= $product['status'] ?>
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center justify-center space-x-2">
                                                <button class="text-blue-600 hover:bg-blue-50 p-2 rounded-lg transition" title="Edit">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <button class="text-red-600 hover:bg-red-50 p-2 rounded-lg transition" title="Hapus">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pesanan Masuk -->
                <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-900">Pesanan Masuk</h3>
                        <a href="pesanan.php" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-semibold text-sm transition inline-flex items-center space-x-2">
                            <i class="fa-solid fa-plus"></i>
                            <span>Tambah Pesanan</span>
                        </a>
                    </div>
                    <div class="space-y-4">
                        <?php foreach ($incomingOrders as $order): ?>
                            <div class="border border-gray-200 rounded-lg p-4 hover:border-green-300 transition">
                                <div class="flex items-start justify-between mb-3">
                                    <div>
                                        <p class="font-semibold text-gray-900"><?= $order['id'] ?> - <?= $order['customer'] ?></p>
                                        <p class="text-sm text-gray-600"><?= $order['product'] ?> (<?= $order['qty'] ?>x)</p>
                                    </div>
                                    <span class="text-xs px-3 py-1 rounded-full <?= $order['status'] === 'Selesai' ? 'bg-green-100 text-green-700' : ($order['status'] === 'Diproses' ? 'bg-blue-100 text-blue-700' : 'bg-yellow-100 text-yellow-700') ?>">
                                        <?= $order['status'] ?>
                                    </span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-lg font-bold text-green-600"><?= $order['total'] ?></span>
                                    <?php if ($order['status'] === 'Diproses'): ?>
                                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-1.5 rounded-lg text-sm font-semibold transition">
                                            Selesai
                                        </button>
                                    <?php elseif ($order['status'] === 'Selesai'): ?>
                                        <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-1.5 rounded-lg text-sm font-semibold transition flex items-center space-x-2">
                                            <i class="fa-solid fa-print"></i>
                                            <span>Cetak Struk</span>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Right Content (bottom in mobile) -->
            <div class="space-y-8">
                <!-- Business Profile -->
                <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Profil Usaha</h3>
                    <div class="text-center mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-green-100 to-green-200 rounded-full flex items-center justify-center text-4xl mx-auto mb-3">
                            ☕
                        </div>
                        <h4 class="font-bold text-gray-900 text-lg"><?= $user['business'] ?></h4>
                        <p class="text-sm text-gray-600">F&B - Kopi & Minuman</p>
                    </div>
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-600">Total Produk</span>
                            <span class="font-semibold text-gray-900">4</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-600">Total Penjualan</span>
                            <span class="font-semibold text-gray-900">280</span>
                        </div>
                    </div>
                    <a href="edit-profil.php" class="w-full bg-green-50 hover:bg-green-100 text-green-700 py-2 rounded-lg font-semibold transition inline-block text-center">
                        <i class="fa-solid fa-pen-to-square mr-2"></i>Edit Profil
                    </a>
                </div>

                <!-- Quick Stats -->
                <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Statistik Cepat</h3>
                    <div class="space-y-4">
                        <div class="p-4 bg-green-50 rounded-lg">
                            <p class="text-sm text-gray-600 mb-1">Minggu Ini</p>
                            <p class="text-2xl font-bold text-green-600"><?= $salesStats['thisWeek'] ?></p>
                        </div>
                        <div class="p-4 bg-blue-50 rounded-lg">
                            <p class="text-sm text-gray-600 mb-1">Total Pendapatan</p>
                            <p class="text-2xl font-bold text-blue-600"><?= $salesStats['total'] ?></p>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Aksi Cepat</h3>
                    <div class="space-y-3">
                        <button class="w-full bg-green-50 hover:bg-green-100 text-green-700 py-3 rounded-lg font-semibold transition flex items-center justify-center space-x-2">
                            <i class="fa-solid fa-plus"></i>
                            <span>Tambah Produk</span>
                        </button>
                        <button class="w-full bg-blue-50 hover:bg-blue-100 text-blue-700 py-3 rounded-lg font-semibold transition flex items-center justify-center space-x-2">
                            <i class="fa-solid fa-chart-line"></i>
                            <span>Lihat Laporan</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>