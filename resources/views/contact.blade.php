<?php
// /c:/laragon/www/umkm-terdekat/{{ route('contact') }}
// Halaman Kontak — berisi informasi tujuan pengembangan dan form kontak sederhana

// Proses form (sederhana)
$success = false;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name === '') {
        $errors[] = 'Nama harus diisi.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email tidak valid.';
    }
    if ($message === '') {
        $errors[] = 'Pesan tidak boleh kosong.';
    }

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
@extends('templates.anonymous')
@section('title', 'Kontak')
@section('content')
    <section class="bg-gradient-to-br from-green-50 to-white py-16">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">Hubungi Kami</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Jika Anda memiliki pertanyaan, saran, atau ingin bergabung
                sebagai pelaku UMKM, silakan hubungi kami melalui formulir di bawah atau melalui kontak resmi.</p>
        </div>
    </section>

    <!-- Konten Utama -->
    <main class="max-w-6xl mx-auto px-6 py-12 grid grid-cols-1 lg:grid-cols-2 gap-10">
        <!-- Tujuan Pengembangan -->
        <section class="bg-white rounded-2xl shadow p-8">
            <h3 class="text-2xl font-semibold text-gray-900 mb-4">Tujuan Pengembangan Aplikasi</h3>
            <p class="text-gray-600 mb-4">UMKMTerdekat dikembangkan untuk mendukung ekosistem UMKM lokal dengan tujuan
                utama:</p>
            <ul class="list-disc list-inside text-gray-600 space-y-2">
                <li>Membantu konsumen menemukan UMKM terdekat dengan cepat dan mudah.</li>
                <li>Meningkatkan visibilitas dan akses pasar bagi pelaku UMKM skala mikro dan kecil.</li>
                <li>Menyediakan informasi produk & jasa berkualitas dari UMKM lokal.</li>
                <li>Mendorong pemberdayaan ekonomi lokal dan keberlanjutan usaha skala kecil.</li>
                <li>Menyediakan platform yang sederhana, terjangkau, dan mudah digunakan oleh semua pihak.</li>
            </ul>

            <div class="mt-6">
                <h4 class="font-semibold text-gray-900 mb-2">Nilai yang Diutamakan</h4>
                <p class="text-gray-600">Kepercayaan, kemudahan akses, dukungan komunitas, dan keberlanjutan ekonomi
                    lokal menjadi landasan setiap fitur yang dikembangkan.</p>
            </div>

            <div class="mt-6 text-sm text-gray-500">
                Catatan: fitur lanjutan (integrasi pembayaran, pengelolaan pesanan, dan analitik) sedang direncanakan
                untuk rilis berikutnya.
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
                    <li>
                        <?= htmlspecialchars($e, ENT_QUOTES, 'UTF-8') ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <form method="POST" action="{{ route('contact') }}" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                    <input name="name" value="<?= htmlspecialchars($name ?? '', ENT_QUOTES, 'UTF-8') ?>" required
                        class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:ring-green-500 focus:border-green-500" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input name="email" type="email" value="<?= htmlspecialchars($email ?? '', ENT_QUOTES, 'UTF-8') ?>"
                        required
                        class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:ring-green-500 focus:border-green-500" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pesan</label>
                    <textarea name="message" rows="5" required
                        class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:ring-green-500 focus:border-green-500"><?= htmlspecialchars($message ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
                </div>
                <div
                    class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-2 sm:space-y-0 sm:space-x-4">
                    <button type="submit"
                        class="w-full sm:w-auto bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-semibold">Kirim
                        Pesan</button>
                    <div class="text-sm text-gray-500">atau hubungi langsung: <strong
                            class="text-gray-800 block sm:inline">+62 812-3456-7890</strong></div>
                </div>
            </form>

            <div class="mt-6 border-t pt-4 text-sm text-gray-600">
                Email resmi: <a href="mailto:info@umkmterdekat.com" class="text-green-600">info@umkmterdekat.com</a><br>
                Alamat: Jl. Contoh No. 1, Kota Contoh
            </div>
        </section>
    </main>
@endsection