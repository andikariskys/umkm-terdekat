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
                @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                    <div class="flex items-center space-x-2">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <span>{{ $errors->first() }}</span>
                    </div>
                </div>
                @endif

                <form method="POST" action="{{ route('login.store') }}">
                    @csrf

                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2" for="username">
                            <i class="fa-solid fa-user mr-2"></i>Username atau Email
                        </label>
                        <input type="text" id="username" name="username" required value="{{ old('username') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition"
                            placeholder="Masukkan username atau email">
                        @error('username')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2" for="password">
                            <i class="fa-solid fa-lock mr-2"></i>Password
                        </label>
                        <input type="password" id="password" name="password" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition"
                            placeholder="Masukkan password">
                        @error('password')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-6 flex items-center">
                        <input type="checkbox" id="remember" name="remember"
                            class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                        <label for="remember" class="ml-2 text-gray-700">Ingat saya</label>
                    </div>

                    <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-semibold shadow-lg hover:shadow-xl transition transform hover:scale-105 flex items-center justify-center space-x-2">
                        <span>Masuk</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-gray-600">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="text-green-600 hover:text-green-700 font-semibold">
                            Daftar Sekarang
                        </a>
                    </p>
                </div>

                <!-- List Demo Accounts -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <p class="text-sm text-gray-500 font-semibold mb-3 text-center">📝 Akun Demo untuk Testing:</p>
                    <div class="space-y-2 text-xs text-gray-700">
                        <div class="bg-blue-50 p-3 rounded-lg border border-blue-200">
                            <strong class="text-blue-700">👤 Pemilik UMKM:</strong>
                            <div class="mt-1">username: <code class="bg-white px-2 py-1 rounded">owner</code></div>
                            <div>password: <code class="bg-white px-2 py-1 rounded">password123</code></div>
                        </div>
                        <div class="bg-purple-50 p-3 rounded-lg border border-purple-200">
                            <strong class="text-purple-700">🔐 Admin:</strong>
                            <div class="mt-1">username: <code class="bg-white px-2 py-1 rounded">admin</code></div>
                            <div>password: <code class="bg-white px-2 py-1 rounded">password123</code></div>
                        </div>
                    </div>
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