<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMKMTerdekat - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/js/all.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</head>

<body class="bg-gray-50 min-h-screen">
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
                    @php
                        $currentRoute = Route::currentRouteName();
                    @endphp

                    {{-- @if ($currentRoute === 'owner.dashboard') --}}
                    <div class="flex items-center space-x-2">
                        <div class="text-right hidden sm:block">
                            <p class="font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->business_name ?? 'Nama Usaha' }}</p>
                        </div>

                        @if (Auth::user()->business_photo)
                            <img src="{{ asset('storage/' . Auth::user()->business_photo) }}" alt="Profile"
                                class="w-10 h-10 rounded-lg object-cover border border-green-100">
                        @else
                            <div class="bg-green-100 p-2 rounded-lg w-10 h-10 flex items-center justify-center">
                                <i class="fa-solid fa-store text-green-600"></i>
                            </div>
                        @endif
                    </div>
                    {{-- @else
                        <a href="{{ route('owner.dashboard') }}"
                            class="text-gray-600 hover:text-gray-900 flex items-center space-x-2">
                            <i class="fa-solid fa-arrow-left"></i>
                            <span class="hidden sm:inline">Kembali</span>
                        </a>
                    @endif --}}

                    {{-- Tombol Logout --}}
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-red-600 hover:bg-red-50 p-2 rounded-lg transition">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </div>

    @yield('scripts')
</body>

</html>
