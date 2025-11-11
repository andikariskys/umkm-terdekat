<?php
session_start();

$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? 'pemilik';

    if ($name && $username && $password && $role) {
        $success = true;
        // Logic simpan ke db
    } else {
        $error = 'Semua field harus diisi!';
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
        <div class="max-w-md w-full">
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

            <!-- Register Form -->
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                <?php if ($success): ?>
                    <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                        <div class="flex items-center space-x-2 mb-2">
                            <i class="fa-solid fa-circle-check"></i>
                            <span class="font-semibold">Registrasi Berhasil!</span>
                        </div>
                        <p class="text-sm">Akun Anda telah terdaftar. Silakan <a href="login.php" class="underline font-semibold">login</a> untuk melanjutkan.</p>
                    </div>
                <?php endif; ?>

                <?php if ($error): ?>
                    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg flex items-center space-x-2">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <span><?= $error ?></span>
                    </div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="mb-5">
                        <label class="block text-gray-700 font-semibold mb-2" for="name">
                            <i class="fa-solid fa-id-card mr-2"></i>Nama Lengkap
                        </label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition"
                            placeholder="Masukkan nama lengkap">
                    </div>

                    <div class="mb-5">
                        <label class="block text-gray-700 font-semibold mb-2" for="username">
                            <i class="fa-solid fa-user mr-2"></i>Username
                        </label>
                        <input
                            type="text"
                            id="username"
                            name="username"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition"
                            placeholder="Pilih username">
                    </div>

                    <div class="mb-5">
                        <label class="block text-gray-700 font-semibold mb-2" for="password">
                            <i class="fa-solid fa-lock mr-2"></i>Password
                        </label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition"
                            placeholder="Buat password">
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-semibold shadow-lg hover:shadow-xl transition transform hover:scale-105 flex items-center justify-center space-x-2">
                        <span>Daftar Sekarang</span>
                        <i class="fa-solid fa-user-plus"></i>
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-gray-600">Sudah punya akun?
                        <a href="login.php" class="text-green-600 hover:text-green-700 font-semibold">Login</a>
                    </p>
                </div>
            </div>

            <div class="text-center mt-6">
                <a href="index.php" class="text-green-600 hover:text-green-700 font-semibold flex items-center justify-center space-x-2">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Kembali ke Beranda</span>
                </a>
            </div>
        </div>
    </div>
</body>

</html>