<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>UMKMTerdekat - @yield('title')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
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

                @php
                    $currentRoute = Route::currentRouteName();
                @endphp

                <!-- Navbar (Desktop) -->
                <nav id="menu" class="hidden lg:flex items-center space-x-8">
                    <a href="{{ route('home') }}"
                        class="{{ $currentRoute === 'home' ? 'text-green-600 font-semibold' : 'text-gray-700 hover:text-green-600 transition font-medium' }}">Beranda</a>
                    <a href="{{ route('business') }}"
                        class="{{ $currentRoute === 'business' ? 'text-green-600 font-semibold' : 'text-gray-700 hover:text-green-600 transition font-medium' }}">Usaha</a>
                    <a href="{{ route('products') }}"
                        class="{{ $currentRoute === 'products' ? 'text-green-600 font-semibold' : 'text-gray-700 hover:text-green-600 transition font-medium' }}">Produk</a>
                    <a href="{{ route('contact') }}"
                        class="{{ $currentRoute === 'contact' ? 'text-green-600 font-semibold' : 'text-gray-700 hover:text-green-600 transition font-medium' }}">Kontak</a>
                    @auth
                        @if (Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="text-white px-4 py-2 rounded-lg bg-green-600 transition font-medium">Dashboard Admin</a>
                        @else
                        <a href="{{ route('owner.dashboard') }}" class="text-white px-4 py-2 rounded-lg bg-green-600 transition font-medium">Dashboard</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="text-white px-4 py-2 rounded-lg bg-green-600 transition font-medium">Login</a>
                    @endauth
                </nav>
            </div>

            <!-- Navbar (Mobile) -->
            <div id="mobile-menu"
                class="max-h-0 overflow-hidden opacity-0 transform scale-y-95 transition-all duration-300 ease-in-out origin-top lg:hidden flex-col space-y-2 mt-4">
                <a href="{{ route('home') }}"
                    class="block {{ $currentRoute === 'home' ? 'text-green-600 font-semibold' : 'text-gray-700 hover:text-green-600 font-medium' }}">Beranda</a>
                <a href="{{ route('business') }}"
                    class="block {{ $currentRoute === 'business' ? 'text-green-600 font-semibold' : 'text-gray-700 hover:text-green-600 font-medium' }}">Usaha</a>
                <a href="{{ route('products') }}"
                    class="block {{ $currentRoute === 'products' ? 'text-green-600 font-semibold' : 'text-gray-700 hover:text-green-600 font-medium' }}">Produk</a>
                <a href="{{ route('contact') }}"
                    class="block {{ $currentRoute === 'contact' ? 'text-green-600 font-semibold' : 'text-gray-700 hover:text-green-600 font-medium' }}">Kontak</a>
                <a href="{{ route('login') }}"
                    class="block text-gray-700 hover:text-green-600 font-medium">Login</a>
            </div>
        </div>
    </header>

    @yield('content')

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
                    <p class="text-green-100 leading-relaxed">Platform terpercaya untuk menemukan dan mendukung UMKM
                        lokal di seluruh Indonesia</p>
                </div>

                <div>
                    <h5 class="font-bold text-lg mb-6">Tentang Kami</h5>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-green-100 hover:text-white transition">Tentang Platform</a>
                        </li>
                        <li><a href="#" class="text-green-100 hover:text-white transition">Cara Kerja</a></li>
                        <li><a href="#" class="text-green-100 hover:text-white transition">Kebijakan Privasi</a>
                        </li>
                        <li><a href="#" class="text-green-100 hover:text-white transition">Syarat &
                                Ketentuan</a></li>
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
                &copy; 2025 <strong>UMKMTerdekat - Pria Pasti Juara</strong>. Semua Hak Dilindungi.
            </div>
        </div>
    </footer>

    <!-- Mobile Menu Script -->
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

    @yield('other-script')
</body>

</html>
