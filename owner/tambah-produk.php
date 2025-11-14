<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'pemilik') {
    header('Location: ../login.php');
    exit;
}

$user = $_SESSION['user'];
$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name = trim($_POST['product_name'] ?? '');
    $product_category = trim($_POST['product_category'] ?? '');
    $product_price = trim($_POST['product_price'] ?? '');
    $product_stock = trim($_POST['product_stock'] ?? '');
    $product_description = trim($_POST['product_description'] ?? '');
    $product_image = trim($_POST['product_image'] ?? '');

    if (!$product_name || !$product_category || !$product_price || !$product_stock) {
        $error = 'Semua field yang bertanda * harus diisi!';
    } elseif (!is_numeric($product_price) || $product_price <= 0) {
        $error = 'Harga harus berupa angka positif!';
    } elseif (!is_numeric($product_stock) || $product_stock < 0) {
        $error = 'Stok harus berupa angka!';
    } else {
        // Simpan ke database
        $success = true;
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - UMKMTerdekat</title>
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
                        <p class="text-xs text-gray-500">Tambah Produk Baru</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="dashboard.php" class="text-gray-600 hover:text-gray-900 flex items-center space-x-2">
                        <i class="fa-solid fa-arrow-left"></i>
                        <span class="hidden sm:inline">Kembali</span>
                    </a>
                    <a href="../logout.php" class="text-red-600 hover:bg-red-50 p-2 rounded-lg transition">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Back Button -->
        <div class="mb-8">
            <a href="dashboard.php" class="text-green-600 hover:text-green-700 font-semibold flex items-center space-x-2">
                <i class="fa-solid fa-chevron-left"></i>
                <span>Kembali ke Dashboard</span>
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Title -->
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Tambah Produk Baru</h2>
                    <p class="text-gray-600">Tambahkan produk baru ke toko Anda</p>
                </div>

                <!-- Form Card -->
                <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
                    <?php if ($success): ?>
                        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center space-x-2">
                            <i class="fa-solid fa-check-circle"></i>
                            <span>Produk berhasil ditambahkan!</span>
                        </div>
                    <?php endif; ?>

                    <?php if ($error): ?>
                        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg flex items-center space-x-2">
                            <i class="fa-solid fa-exclamation-circle"></i>
                            <span><?= $error ?></span>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="" enctype="multipart/form-data">
                        <!-- Nama Produk -->
                        <div class="mb-6">
                            <label class="block text-gray-700 font-semibold mb-2" for="product_name">
                                Nama Produk <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                id="product_name"
                                name="product_name"
                                placeholder="Contoh: Kopi Arabika Premium"
                                value="<?= $_POST['product_name'] ?? '' ?>"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition">
                        </div>

                        <!-- Kategori Produk -->
                        <div class="mb-6">
                            <label class="block text-gray-700 font-semibold mb-2" for="product_category">
                                Kategori <span class="text-red-500">*</span>
                            </label>
                            <select
                                id="product_category"
                                name="product_category"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition">
                                <option value="">-- Pilih Kategori --</option>
                                <option value="minuman" <?= ($_POST['product_category'] ?? '') === 'minuman' ? 'selected' : '' ?>>Minuman</option>
                                <option value="makanan" <?= ($_POST['product_category'] ?? '') === 'makanan' ? 'selected' : '' ?>>Makanan</option>
                                <option value="snack" <?= ($_POST['product_category'] ?? '') === 'snack' ? 'selected' : '' ?>>Snack</option>
                                <option value="lainnya" <?= ($_POST['product_category'] ?? '') === 'lainnya' ? 'selected' : '' ?>>Lainnya</option>
                            </select>
                        </div>

                        <!-- Harga -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2" for="product_price">
                                    Harga (Rp) <span class="text-red-500">*</span>
                                </label>
                                <input
                                    type="number"
                                    id="product_price"
                                    name="product_price"
                                    placeholder="25000"
                                    value="<?= $_POST['product_price'] ?? '' ?>"
                                    min="0"
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition">
                            </div>

                            <!-- Stok -->
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2" for="product_stock">
                                    Stok <span class="text-red-500">*</span>
                                </label>
                                <input
                                    type="number"
                                    id="product_stock"
                                    name="product_stock"
                                    placeholder="50"
                                    value="<?= $_POST['product_stock'] ?? '' ?>"
                                    min="0"
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition">
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-6">
                            <label class="block text-gray-700 font-semibold mb-2" for="product_description">
                                Deskripsi Produk
                            </label>
                            <textarea
                                id="product_description"
                                name="product_description"
                                placeholder="Jelaskan detail produk Anda..."
                                rows="4"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition"><?= $_POST['product_description'] ?? '' ?></textarea>
                            <p class="text-sm text-gray-500 mt-1">Maksimal 500 karakter</p>
                        </div>

                        <!-- Upload Foto Produk -->
                        <div class="mb-6">
                            <label class="block text-gray-700 font-semibold mb-2" for="product_image">
                                <i class="fa-solid fa-image mr-2"></i>Upload Foto Produk
                            </label>
                            <input
                                type="file"
                                id="product_image"
                                name="product_image"
                                accept="image/*"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition">
                            <p class="text-sm text-gray-500 mt-1">Format: JPG, PNG. Maksimal 2MB.</p>
                        </div>

                        <!-- Buttons -->
                        <div class="flex items-center space-x-4 pt-6 border-t border-gray-200">
                            <a href="dashboard.php" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 rounded-lg font-semibold transition text-center">
                                Batal
                            </a>
                            <button type="submit" class="flex-1 bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-semibold transition flex items-center justify-center space-x-2">
                                <i class="fa-solid fa-check-circle"></i>
                                <span>Tambah Produk</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="space-y-8">
                <!-- Info Box -->
                <div class="bg-blue-50 border border-blue-200 rounded-2xl p-6">
                    <div class="flex items-start space-x-3 mb-3">
                        <div class="bg-blue-100 p-3 rounded-lg">
                            <i class="fa-solid fa-lightbulb text-blue-600 text-lg"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-blue-900 mb-2">Tips Menambah Produk</h4>
                            <ul class="space-y-2 text-sm text-blue-800">
                                <li class="flex items-start space-x-2">
                                    <i class="fa-solid fa-check text-blue-600 mt-1"></i>
                                    <span>Gunakan nama produk yang jelas dan deskriptif</span>
                                </li>
                                <li class="flex items-start space-x-2">
                                    <i class="fa-solid fa-check text-blue-600 mt-1"></i>
                                    <span>Atur harga yang kompetitif</span>
                                </li>
                                <li class="flex items-start space-x-2">
                                    <i class="fa-solid fa-check text-blue-600 mt-1"></i>
                                    <span>Tambahkan foto produk yang menarik</span>
                                </li>
                                <li class="flex items-start space-x-2">
                                    <i class="fa-solid fa-check text-blue-600 mt-1"></i>
                                    <span>Kelola stok dengan baik</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Kategori Populer -->
                <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Kategori Populer</h3>
                    <div class="space-y-2">
                        <button class="w-full text-left px-4 py-3 rounded-lg bg-gray-50 hover:bg-green-50 hover:text-green-700 transition font-medium text-sm">
                            <i class="fa-solid fa-coffee mr-2"></i>Minuman
                        </button>
                        <button class="w-full text-left px-4 py-3 rounded-lg bg-gray-50 hover:bg-green-50 hover:text-green-700 transition font-medium text-sm">
                            <i class="fa-solid fa-utensils mr-2"></i>Makanan
                        </button>
                        <button class="w-full text-left px-4 py-3 rounded-lg bg-gray-50 hover:bg-green-50 hover:text-green-700 transition font-medium text-sm">
                            <i class="fa-solid fa-cookie mr-2"></i>Snack
                        </button>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Produk Anda</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Total Produk</span>
                            <span class="text-2xl font-bold text-green-600">4</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Aktif</span>
                            <span class="text-2xl font-bold text-green-600">3</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Tidak Aktif</span>
                            <span class="text-2xl font-bold text-red-600">1</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>