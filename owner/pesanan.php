<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'pemilik') {
    header('Location: ../login.php');
    exit;
}

$user = $_SESSION['user'];

// Data produk dummy
$products = [
    ['id' => 1, 'name' => 'Kopi Arabika Premium', 'price' => 25000, 'image' => '☕'],
    ['id' => 2, 'name' => 'Kopi Robusta Lokal', 'price' => 20000, 'image' => '☕'],
    ['id' => 3, 'name' => 'Kopi Luwak Special', 'price' => 45000, 'image' => '☕'],
    ['id' => 4, 'name' => 'Paket Kopi Mix', 'price' => 60000, 'image' => '☕'],
];

// Cart items (dari session atau array kosong)
$cartItems = $_SESSION['cart'] ?? [];
$totalPrice = array_sum(array_map(fn($item) => $item['price'] * $item['qty'], $cartItems));
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem POS - UMKMTerdekat</title>
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
                        <p class="text-xs text-gray-500">Sistem POS</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="dashboard.php" class="text-gray-600 hover:text-gray-900">
                        <i class="fa-solid fa-arrow-left mr-2"></i>Kembali
                    </a>
                    <a href="../logout.php" class="text-red-600 hover:bg-red-50 p-2 rounded-lg transition">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content (Daftar Produk) -->
            <div class="lg:col-span-2">
                <!-- Title -->
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Tambah Pesanan</h2>
                    <p class="text-gray-600">Pilih produk untuk membuat pesanan baru</p>
                </div>

                <!-- Daftar Produk -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
                    <?php foreach ($products as $product): ?>
                        <div class="bg-white rounded-xl shadow-md p-4 border border-gray-100 hover:shadow-lg hover:border-green-300 transition cursor-pointer" onclick="addToCart(<?= $product['id'] ?>, '<?= addslashes($product['name']) ?>', <?= $product['price'] ?>)">
                            <div class="text-4xl mb-3"><?= $product['image'] ?></div>
                            <h4 class="font-semibold text-gray-900 mb-2"><?= $product['name'] ?></h4>
                            <p class="text-lg font-bold text-green-600">Rp <?= number_format($product['price'], 0, ',', '.') ?></p>
                            <button class="w-full mt-3 bg-green-100 hover:bg-green-200 text-green-700 py-2 rounded-lg text-sm font-semibold transition">
                                <i class="fa-solid fa-plus mr-2"></i>Tambah
                            </button>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Right Sidebar (Keranjang) -->
            <div>
                <!-- Keranjang Pesanan -->
                <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100 sticky top-24">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">
                        <i class="fa-solid fa-shopping-cart mr-2"></i>Keranjang Pesanan
                    </h3>

                    <!-- Daftar Item -->
                    <div class="space-y-3 mb-6 max-h-96 overflow-y-auto">
                        <?php if (empty($cartItems)): ?>
                            <div class="text-center py-8 text-gray-500">
                                <i class="fa-solid fa-inbox text-4xl mb-3"></i>
                                <p class="text-sm">Keranjang kosong</p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($cartItems as $index => $item): ?>
                                <div class="border border-gray-200 rounded-lg p-3 hover:border-green-300 transition">
                                    <div class="flex items-start justify-between mb-2">
                                        <div>
                                            <p class="font-semibold text-gray-900 text-sm"><?= $item['name'] ?></p>
                                            <p class="text-xs text-gray-600">Rp <?= number_format($item['price'], 0, ',', '.') ?></p>
                                        </div>
                                        <button class="text-red-600 hover:bg-red-50 p-1 rounded text-sm" onclick="removeFromCart(<?= $index ?>)">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <button class="bg-gray-100 hover:bg-gray-200 px-2 py-1 rounded text-xs" onclick="decreaseQty(<?= $index ?>)">
                                            <i class="fa-solid fa-minus"></i>
                                        </button>
                                        <input type="text" value="<?= $item['qty'] ?>" class="w-10 text-center border border-gray-300 rounded text-xs" readonly>
                                        <button class="bg-gray-100 hover:bg-gray-200 px-2 py-1 rounded text-xs" onclick="increaseQty(<?= $index ?>)">
                                            <i class="fa-solid fa-plus"></i>
                                        </button>
                                        <span class="text-xs font-semibold text-gray-900 ml-auto">
                                            Rp <?= number_format($item['price'] * $item['qty'], 0, ',', '.') ?>
                                        </span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <!-- Total -->
                    <div class="border-t border-gray-200 pt-4 mb-6">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-semibold text-gray-900">Rp <?= number_format($totalPrice, 0, ',', '.') ?></span>
                        </div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-gray-600">Pajak (10%)</span>
                            <span class="font-semibold text-gray-900">Rp <?= number_format($totalPrice * 0.1, 0, ',', '.') ?></span>
                        </div>
                        <div class="flex items-center justify-between bg-green-50 p-4 rounded-lg">
                            <span class="font-bold text-gray-900">Total</span>
                            <span class="text-2xl font-bold text-green-600">Rp <?= number_format($totalPrice * 1.1, 0, ',', '.') ?></span>
                        </div>
                    </div>

                    <!-- Form Input Pelanggan -->
                    <div class="space-y-4 mb-6 pb-6 border-b border-gray-200">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Pelanggan</label>
                            <input type="text" id="customerName" placeholder="Masukkan nama" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Telepon</label>
                            <input type="text" id="customerPhone" placeholder="Nomor WhatsApp" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="space-y-3">
                        <button onclick="clearCart()" class="w-full bg-red-50 hover:bg-red-100 text-red-700 py-2 rounded-lg font-semibold text-sm transition">
                            <i class="fa-solid fa-trash mr-2"></i>Kosongkan
                        </button>
                        <button onclick="confirmOrder()" class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-semibold transition flex items-center justify-center space-x-2">
                            <i class="fa-solid fa-check-circle"></i>
                            <span>Simpan Pesanan</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addToCart(id, name, price) {
            // Implementasi tambah ke cart (bisa menggunakan AJAX atau form submission)
            alert(`${name} ditambahkan ke keranjang`);
        }

        function removeFromCart(index) {
            alert(`Item dihapus dari keranjang`);
        }

        function increaseQty(index) {
            alert(`Jumlah ditambah`);
        }

        function decreaseQty(index) {
            alert(`Jumlah dikurangi`);
        }

        function clearCart() {
            if (confirm('Yakin ingin mengosongkan keranjang?')) {
                alert('Keranjang kosong');
            }
        }

        function confirmOrder() {
            const name = document.getElementById('customerName').value;
            if (!name) {
                alert('Masukkan nama pelanggan');
                return;
            }
            alert(`Pesanan untuk ${name} berhasil disimpan`);
        }
    </script>
</body>

</html>