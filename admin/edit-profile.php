<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

$user = $_SESSION['user'];
$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $business_name = trim($_POST['business_name'] ?? '');
    $business_category = trim($_POST['business_category'] ?? '');
    $business_address = trim($_POST['business_address'] ?? '');
    $business_phone = trim($_POST['business_phone'] ?? '');
    $business_email = trim($_POST['business_email'] ?? '');
    $business_description = trim($_POST['business_description'] ?? '');

    if (!$business_name || !$business_category || !$business_address || !$business_phone) {
        $error = 'Semua field harus diisi!';
    } else {
        // TODO: Simpan ke database
        $success = true;
        // Update session
        $_SESSION['user']['business'] = $business_name;
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil UMKM - UMKMTerdekat</title>
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
                        <p class="text-xs text-gray-500">Edit Profil UMKM</p>
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
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Edit Profil UMKMTerdekat</h2>
                    <p class="text-gray-600">Kelola informasi admin UMKM</p>
                </div>

                <!-- Form Card -->
                <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100 mb-8">
                    <?php if ($success): ?>
                        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center space-x-2">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Profil UMKM berhasil diperbarui!</span>
                        </div>
                    <?php endif; ?>

                    <?php if ($error): ?>
                        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg flex items-center space-x-2">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            <span><?= htmlspecialchars($error) ?></span>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="">
                        <!-- Nama Admin UMKM -->
                        <div class="mb-6">
                            <label class="block text-gray-700 font-semibold mb-3" for="business_name">
                                <i class="fa-solid fa-store mr-2"></i>Nama Admin UMKM
                            </label>
                            <input
                                type="text"
                                id="admin_name"
                                name="admin_name"
                                value="Andika Risky Septiawan"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                                placeholder="Masukkan nama admin UMKM">
                        </div>

                        <!-- Buttons -->
                        <div class="flex items-center gap-4 pt-6 border-t border-gray-200">
                            <button
                                type="submit"
                                class="flex-1 bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-semibold transition transform hover:scale-105 flex items-center justify-center space-x-2">
                                <i class="fa-solid fa-check"></i>
                                <span>Simpan Perubahan</span>
                            </button>
                            <a href="dashboard.php" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 rounded-lg font-semibold transition flex items-center justify-center space-x-2">
                                <i class="fa-solid fa-times"></i>
                                <span>Batal</span>
                            </a>
                        </div>
                    </form>
                </div>

                <div class="mb-8">
                    <p class="text-gray-600">Kelola informasi website UMKM</p>
                </div>

                <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100 mt-8">
                    <?php if ($success): ?>
                        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center space-x-2">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Profil UMKM berhasil diperbarui!</span>
                        </div>
                    <?php endif; ?>

                    <?php if ($error): ?>
                        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg flex items-center space-x-2">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            <span><?= htmlspecialchars($error) ?></span>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="">
                        <!-- Nomor Telepon -->
                        <div class="mb-6">
                            <label class="block text-gray-700 font-semibold mb-3" for="business_phone">
                                <i class="fa-solid fa-phone mr-2"></i>Nomor Telepon / WhatsApp
                            </label>
                            <input
                                type="text"
                                id="business_phone"
                                name="business_phone"
                                value="0812-3456-7890"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                                placeholder="Contoh: 0812-3456-7890">
                        </div>

                        <!-- Email -->
                        <div class="mb-6">
                            <label class="block text-gray-700 font-semibold mb-3" for="business_email">
                                <i class="fa-solid fa-envelope mr-2"></i>Email
                            </label>
                            <input
                                type="email"
                                id="business_email"
                                name="business_email"
                                value="info@umkmterdekat.com"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                                placeholder="email@umkm.com">
                        </div>

                        <!-- Akun Instagram -->
                        <div class="mb-6">
                            <label class="block text-gray-700 font-semibold mb-3" for="business_instagram">
                                <i class="fa-brands fa-instagram mr-2"></i>Akun Instagram
                            </label>
                            <input
                                type="text"
                                id="business_instagram"
                                name="business_instagram"
                                value="<?= htmlspecialchars($user['business_instagram'] ?? '@umkmterdekat') ?>"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                                placeholder="Contoh: @namabisnis atau instagram.com/namabisnis">
                            <p class="text-sm text-gray-500 mt-1">Masukkan username Instagram (dengan atau tanpa @) atau URL profil.</p>
                        </div>

                        <!-- Upload Logo Website -->
                        <div class="mb-6">
                            <label class="block text-gray-700 font-semibold mb-3" for="business_photo">
                                <i class="fa-solid fa-image mr-2"></i>Upload Logo Website
                            </label>
                            <input
                                type="file"
                                id="logo"
                                name="logo"
                                accept="image/*"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition">
                            <p class="text-sm text-gray-500 mt-1">Format: JPG, PNG. Maksimal 2MB.</p>
                        </div>

                        <!-- Buttons -->
                        <div class="flex items-center gap-4 pt-6 border-t border-gray-200">
                            <button
                                type="submit"
                                class="flex-1 bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-semibold transition transform hover:scale-105 flex items-center justify-center space-x-2">
                                <i class="fa-solid fa-check"></i>
                                <span>Simpan Perubahan</span>
                            </button>
                            <a href="dashboard.php" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 rounded-lg font-semibold transition flex items-center justify-center space-x-2">
                                <i class="fa-solid fa-times"></i>
                                <span>Batal</span>
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="space-y-8">
                <!-- Preview Profil -->
                <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Preview Profil</h3>
                    <div class="text-center mb-6">
                        <div class="w-24 h-24 bg-green-600 rounded-full flex items-center justify-center text-5xl mx-auto mb-4">
                            <i class="fa-solid fa-store text-white text-xl"></i>
                        </div>
                        <h4 class="font-bold text-gray-900 text-lg">UMKMTerdekat</h4>
                        <p class="text-sm text-gray-600">F&B - Kopi & Minuman</p>
                    </div>
                    <div class="space-y-3 text-sm">
                        <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                            <i class="fa-solid fa-phone text-green-600"></i>
                            <span class="text-gray-700">082123456789</span>
                        </div>
                        <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                            <i class="fa-solid fa-envelope text-green-600"></i>
                            <span class="text-gray-700">umkm@example.com</span>
                        </div>
                        <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                            <i class="fa-brands fa-instagram text-green-600"></i>
                            <span class="text-gray-700">@umkmterdekat</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>