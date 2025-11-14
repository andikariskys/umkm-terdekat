<?php
// /c:/laragon/www/umkm-terdekat/contact.php
// Halaman Kontak — berisi informasi tujuan pengembangan dan form kontak sederhana

// Proses form (sederhana)
$success = false;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name === '') $errors[] = 'Nama harus diisi.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Email tidak valid.';
    if ($message === '') $errors[] = 'Pesan tidak boleh kosong.';

    if (empty($errors)) {
        // Jika server mendukung mail(), bisa diaktifkan:
        // $to = 'info@umkmterdekat.com';
        // $subject = "Pesan Kontak dari $name";
        // $body = "Nama: $name\nEmail: $email\n\n$message";
        // $headers = "From: $email\r\nReply-To: $email\r\n";
        // $sent = mail($to, $subject, $body, $headers);
        // $success = $sent;

        // Untuk sekarang tampilkan sukses tanpa mengirim email
        $success = true;
        // reset form
        $name = $email = $message = '';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Kontak — UMKMTerdekat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body class="min-h-screen bg-gray-50 font-sans">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="bg-green-600 p-2 rounded-xl">
                        <i class="fa-solid fa-store text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-green-700">UMKMTerdekat</h1>
                        <p class="text-xs text-gray-500">Dukung Usaha Lokal</p>
                    </div>
                </div>

                <!-- Tombol Menu (Mobile) -->
                <button id="menu-btn" class="lg:hidden text-gray-600 text-2xl focus:outline-none">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <!-- Navbar (Desktop) -->
                <nav id="menu" class="hidden lg:flex items-center space-x-8">
                    <a href="index.php" class="text-gray-700 hover:text-green-600 transition font-medium">Beranda</a>
                    <a href="business.php" class="text-gray-700 hover:text-green-600 transition font-medium">Usaha</a>
                    <a href="products.php" class="text-gray-700 hover:text-green-600 transition font-medium">Produk</a>
                    <a href="contact.php" class="text-green-600 font-semibold">Kontak</a>
                    <a href="login.php" class="text-white px-4 py-2 rounded-lg bg-green-600 transition font-medium">Login</a>
                </nav>
            </div>

            <!-- Navbar (Mobile) -->
            <div id="mobile-menu"
                class="max-h-0 overflow-hidden opacity-0 transform scale-y-95 transition-all duration-300 ease-in-out origin-top lg:hidden flex-col space-y-2 mt-4">
                <a href="index.php" class="block text-gray-700 hover:text-green-600 font-medium">Beranda</a>
                <a href="business.php" class="block text-gray-700 hover:text-green-600 font-medium">Usaha</a>
                <a href="products.php" class="block text-gray-700 hover:text-green-600 font-medium">Produk</a>
                <a href="contact.php" class="block text-green-600 font-semibold">Kontak</a>
                <a href="login.php" class="block text-gray-700 hover:text-green-600 font-medium">Login</a>
            </div>
        </div>
    </header>

    <!-- Hero -->
    <section class="bg-gradient-to-br from-green-50 to-white py-16">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">Hubungi Kami</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Jika Anda memiliki pertanyaan, saran, atau ingin bergabung sebagai pelaku UMKM, silakan hubungi kami melalui formulir di bawah atau melalui kontak resmi.</p>
        </div>
    </section>

    <!-- Konten Utama -->
    <main class="max-w-6xl mx-auto px-6 py-12 grid grid-cols-1 lg:grid-cols-2 gap-10">
        <!-- Tujuan Pengembangan -->
        <section class="bg-white rounded-2xl shadow p-8">
            <h3 class="text-2xl font-semibold text-gray-900 mb-4">Tujuan Pengembangan Aplikasi</h3>
            <p class="text-gray-600 mb-4">UMKMTerdekat dikembangkan untuk mendukung ekosistem UMKM lokal dengan tujuan utama:</p>
            <ul class="list-disc list-inside text-gray-600 space-y-2">
                <li>Membantu konsumen menemukan UMKM terdekat dengan cepat dan mudah.</li>
                <li>Meningkatkan visibilitas dan akses pasar bagi pelaku UMKM skala mikro dan kecil.</li>
                <li>Menyediakan informasi produk & jasa berkualitas dari UMKM lokal.</li>
                <li>Mendorong pemberdayaan ekonomi lokal dan keberlanjutan usaha skala kecil.</li>
                <li>Menyediakan platform yang sederhana, terjangkau, dan mudah digunakan oleh semua pihak.</li>
            </ul>

            <div class="mt-6">
                <h4 class="font-semibold text-gray-900 mb-2">Nilai yang Diutamakan</h4>
                <p class="text-gray-600">Kepercayaan, kemudahan akses, dukungan komunitas, dan keberlanjutan ekonomi lokal menjadi landasan setiap fitur yang dikembangkan.</p>
            </div>

            <div class="mt-6 text-sm text-gray-500">
                Catatan: fitur lanjutan (integrasi pembayaran, pengelolaan pesanan, dan analitik) sedang direncanakan untuk rilis berikutnya.
            </div>
        </section>

        <!-- Form Kontak -->
        <section class="bg-white rounded-2xl shadow p-8">
            <h3 class="text-2xl font-semibold text-gray-900 mb-4">Kirim Pesan</h3>

            <?php if ($success): ?>
                <div class="mb-4 p-4 rounded-lg bg-green-50 border border-green-200 text-green-700">
                    Terima kasih! Pesan Anda telah diterima.
                </div>
            <?php endif; ?>

            <?php if (!empty($errors)): ?>
                <div class="mb-4 p-4 rounded-lg bg-red-50 border border-red-200 text-red-700">
                    <ul class="list-disc list-inside">
                        <?php foreach ($errors as $e): ?>
                            <li><?= htmlspecialchars($e, ENT_QUOTES, 'UTF-8') ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="POST" action="contact.php" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                    <input name="name" value="<?= htmlspecialchars($name ?? '', ENT_QUOTES, 'UTF-8') ?>" required class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:ring-green-500 focus:border-green-500" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input name="email" type="email" value="<?= htmlspecialchars($email ?? '', ENT_QUOTES, 'UTF-8') ?>" required class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:ring-green-500 focus:border-green-500" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pesan</label>
                    <textarea name="message" rows="5" required class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:ring-green-500 focus:border-green-500"><?= htmlspecialchars($message ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
                </div>
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-2 sm:space-y-0 sm:space-x-4">
                    <button type="submit" class="w-full sm:w-auto bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-semibold">Kirim Pesan</button>
                    <div class="text-sm text-gray-500">atau hubungi langsung: <strong class="text-gray-800 block sm:inline">+62 812-3456-7890</strong></div>
                </div>
            </form>

            <div class="mt-6 border-t pt-4 text-sm text-gray-600">
                Email resmi: <a href="mailto:info@umkmterdekat.com" class="text-green-600">info@umkmterdekat.com</a><br>
                Alamat: Jl. Contoh No. 1, Kota Contoh
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer id="kontak" class="bg-gradient-to-br from-green-600 to-green-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                <div>
                    <div class="flex items-center space-x-2 mb-6">
                        <div class="bg-white p-2 rounded-xl">
                            <i class="fa-solid fa-store text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="text-2xl font-bold">UMKMTerdekat</h4>
                            <p class="text-green-100 text-xs">Dukung Usaha Lokal</p>
                        </div>
                    </div>
                    <p class="text-green-100 leading-relaxed">Platform terpercaya untuk menemukan dan mendukung UMKM lokal di seluruh Indonesia</p>
                </div>

                <div>
                    <h5 class="font-bold text-lg mb-6">Tentang Kami</h5>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-green-100 hover:text-white transition">Tentang Platform</a></li>
                        <li><a href="#" class="text-green-100 hover:text-white transition">Cara Kerja</a></li>
                        <li><a href="#" class="text-green-100 hover:text-white transition">Kebijakan Privasi</a></li>
                        <li><a href="#" class="text-green-100 hover:text-white transition">Syarat & Ketentuan</a></li>
                    </ul>
                </div>

                <div>
                    <h5 class="font-bold text-lg mb-6">Hubungi Kami</h5>
                    <div class="space-y-4">
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
                    <h5 class="font-bold text-lg mb-6">Ikuti Kami</h5>
                    <div class="flex items-center space-x-3 mb-6">
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

            <div class="border-t border-green-500 pt-8 text-center text-green-100 text-sm">
                &copy; 2025 <strong>UMKMTerdekat</strong>. Semua Hak Dilindungi.
            </div>
        </div>
    </footer>

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
