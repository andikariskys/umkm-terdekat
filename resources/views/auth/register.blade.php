<?php
session_start();

$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Data diri
    $name = trim($_POST['name'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $role = $_POST['role'] ?? 'pemilik';

    // Data UMKM
    $business_name = trim($_POST['business_name'] ?? '');
    $business_address = trim($_POST['business_address'] ?? '');
    $business_phone = trim($_POST['business_phone'] ?? '');
    $business_category = trim($_POST['business_category'] ?? '');

    if (!$name || !$username || !$password || !$confirm_password) {
        $error = 'Semua field data diri harus diisi!';
    } elseif ($password !== $confirm_password) {
        $error = 'Password dan konfirmasi password tidak cocok.';
    } else {
        if ($role === 'pemilik' && (!$business_name || !$business_address || !$business_phone || !$business_category)) {
            $error = 'Semua field data UMKM harus diisi untuk pendaftaran sebagai Pemilik UMKM.';
        } else {
            // Logic simpan ke db
            $success = true;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - UMKMTerdekat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/js/all.min.js"></script>
</head>

<body class="min-h-screen bg-gradient-to-br from-green-50 via-white to-green-50/30">
    <div class="min-h-screen flex items-center justify-center px-4 py-12">
        <div class="max-w-4xl w-full">
            <!-- Logo -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center space-x-3 mb-4">
                    <div class="bg-green-600 p-3 rounded-xl">
                        <i class="fa-solid fa-store text-white text-2xl"></i>
                    </div>
                    <div class="text-left">
                        <h1 class="text-3xl font-bold text-green-700">UMKMTerdekat</h1>
                        <p class="text-sm text-gray-500">Dukung Usaha Lokal</p>
                    </div>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Daftar Akun Baru</h2>
                <p class="text-gray-600">Bergabunglah dengan komunitas UMKM kami</p>
            </div>

            <!-- Register Form (dua kolom pada layar besar) -->
            <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-100">
                <?php if ($success): ?>
                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                    <div class="flex items-center space-x-2 mb-2">
                        <i class="fa-solid fa-circle-check"></i>
                        <span class="font-semibold">Registrasi Berhasil!</span>
                    </div>
                    <p class="text-sm">Akun Anda telah terdaftar. Silakan <a href="{{ route('login') }}"
                            class="underline font-semibold">login</a> untuk melanjutkan.</p>
                </div>
                <?php endif; ?>

                <?php if ($error): ?>
                <div
                    class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg flex items-center space-x-2">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span>
                        <?= htmlspecialchars($error) ?>
                    </span>
                </div>
                <?php endif; ?>

                <form method="POST" action="">
                    <input type="hidden" name="role" value="pemilik">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Kolom 1: Data Diri -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Data Diri</h3>

                            <div class="mb-4">
                                <label class="block text-gray-700 font-semibold mb-2" for="name">
                                    <i class="fa-solid fa-id-card mr-2"></i>Nama Lengkap
                                </label>
                                <input type="text" id="name" name="name"
                                    value="<?= isset($name) ? htmlspecialchars($name) : '' ?>" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                                    placeholder="Masukkan nama lengkap">
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 font-semibold mb-2" for="username">
                                    <i class="fa-solid fa-user mr-2"></i>Username
                                </label>
                                <input type="text" id="username" name="username"
                                    value="<?= isset($username) ? htmlspecialchars($username) : '' ?>" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                                    placeholder="Pilih username">
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 font-semibold mb-2" for="password">
                                    <i class="fa-solid fa-lock mr-2"></i>Password
                                </label>
                                <input type="password" id="password" name="password" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                                    placeholder="Buat password">
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 font-semibold mb-2" for="confirm-password">
                                    <i class="fa-solid fa-lock mr-2"></i>Confirm Password
                                </label>
                                <input type="password" id="confirm-password" name="confirm_password" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                                    placeholder="Ulangi password">
                            </div>
                        </div>

                        <!-- Kolom 2: Data UMKM -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Data UMKM (otomatis terdaftar sebagai
                                Pemilik)</h3>

                            <div class="mb-4">
                                <label class="block text-gray-700 font-semibold mb-2" for="business_name">
                                    <i class="fa-solid fa-store mr-2"></i>Nama UMKM
                                </label>
                                <input type="text" id="business_name" name="business_name"
                                    value="<?= isset($business_name) ? htmlspecialchars($business_name) : '' ?>"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                                    placeholder="Masukkan nama UMKM">
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 font-semibold mb-2" for="business_address">
                                    <i class="fa-solid fa-location-dot mr-2"></i>Alamat UMKM
                                </label>
                                <textarea id="business_address" name="business_address"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                                    placeholder="Masukkan alamat lengkap"><?= isset($business_address) ? htmlspecialchars($business_address) : '' ?></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 font-semibold mb-2" for="business_phone">
                                    <i class="fa-solid fa-phone mr-2"></i>Telepon / Kontak
                                </label>
                                <input type="text" id="business_phone" name="business_phone"
                                    value="<?= isset($business_phone) ? htmlspecialchars($business_phone) : '' ?>"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                                    placeholder="Nomor telepon / WhatsApp">
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 font-semibold mb-2" for="business_category">
                                    <i class="fa-solid fa-tags mr-2"></i>Kategori
                                </label>
                                <input type="text" id="business_category" name="business_category"
                                    value="<?= isset($business_category) ? htmlspecialchars($business_category) : '' ?>"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                                    placeholder="Mis: Makanan, Fashion, Jasa, dsb.">
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit"
                            class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-semibold shadow-lg hover:shadow-xl transition transform hover:scale-105 flex items-center justify-center space-x-2">
                            <span>Daftar Sekarang</span>
                            <i class="fa-solid fa-user-plus"></i>
                        </button>
                    </div>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-gray-600">Sudah punya akun?
                        <a href="{{ route('login') }}" class="text-green-600 hover:text-green-700 font-semibold">Login</a>
                    </p>
                </div>
            </div>

            <div class="text-center mt-6">
                <a href="{{ route('home') }}"
                    class="text-green-600 hover:text-green-700 font-semibold flex items-center justify-center space-x-2">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Kembali ke Beranda</span>
                </a>
            </div>
        </div>
    </div>
</body>

</html>