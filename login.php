<?php
session_start();

$users = [
    // Pemilik UMKM
    ['username' => 'pemilik', 'password' => 'pemilik123', 'role' => 'pemilik', 'name' => 'Anto Wijaya', 'business' => 'Warung Kopi Seduh'],
    ['username' => 'owner1', 'password' => 'owner123', 'role' => 'pemilik', 'name' => 'Dewi Lestari', 'business' => 'Toko Kelontong Berkah'],

    // Admin
    ['username' => 'admin', 'password' => 'admin123', 'role' => 'admin', 'name' => 'Administrator'],
];

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $found = false;
    foreach ($users as $user) {
        if ($user['username'] === $username && $user['password'] === $password) {
            $_SESSION['user'] = $user;
            $found = true;

            // Redirect sesuai role
            switch ($user['role']) {
                case 'pemilik':
                    header('Location: owner/dashboard.php');
                    break;
                case 'admin':
                    header('Location: admin/dashboard.php');
                    break;
            }
            exit;
        }
    }

    if (!$found) {
        $error = 'Username atau password salah!';
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - UMKMTerdekat</title>
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
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Selamat Datang Kembali</h2>
                <p class="text-gray-600">Masuk ke akun Anda untuk melanjutkan</p>
            </div>

            <!-- Login Form -->
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                <?php if ($error): ?>
                    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg flex items-center space-x-2">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <span><?= $error ?></span>
                    </div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2" for="username">
                            <i class="fa-solid fa-user mr-2"></i>Username
                        </label>
                        <input
                            type="text"
                            id="username"
                            name="username"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition"
                            placeholder="Masukkan username">
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2" for="password">
                            <i class="fa-solid fa-lock mr-2"></i>Password
                        </label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition"
                            placeholder="Masukkan password">
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-semibold shadow-lg hover:shadow-xl transition transform hover:scale-105 flex items-center justify-center space-x-2">
                        <span>Masuk</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-gray-600">Belum punya akun?
                        <a href="register.php" class="text-green-600 hover:text-green-700 font-semibold">Daftar Sekarang</a>
                    </p>
                </div>

                <!-- List Demo Accounts -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <p class="text-sm text-gray-500 font-semibold mb-3 text-center">Akun Demo untuk Testing:</p>
                    <div class="space-y-2 text-xs text-gray-600">
                        <div class="bg-gray-50 p-3 rounded-lg">
                            <strong>Pemilik UMKM:</strong> pemilik / pemilik123
                        </div>
                        <div class="bg-gray-50 p-3 rounded-lg">
                            <strong>Admin:</strong> admin / admin123
                        </div>
                    </div>
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