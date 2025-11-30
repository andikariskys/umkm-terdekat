@extends('templates.owner')
@section('title', 'Edit Profil')
@section('content')
    <div class="mb-8">
        <a href="{{ route('owner.dashboard') }}"
            class="text-green-600 hover:text-green-700 font-semibold flex items-center space-x-2">
            <i class="fa-solid fa-chevron-left"></i>
            <span>Kembali ke Dashboard</span>
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Edit Profil UMKM</h2>
                <p class="text-gray-600">Kelola informasi bisnis Anda</p>
            </div>

            <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">

                {{-- Notifikasi Sukses --}}
                @if (session('success'))
                    <div
                        class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center space-x-2">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                {{-- Menampilkan Error Validasi Global --}}
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('owner.profil.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-3" for="business_name">
                            <i class="fa-solid fa-store mr-2"></i>Nama UMKM
                        </label>
                        <input type="text" id="business_name" name="business_name"
                            value="{{ old('business_name', $user->business_name) }}" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                            placeholder="Masukkan nama UMKM">
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-3" for="business_category">
                            <i class="fa-solid fa-tags mr-2"></i>Kategori Bisnis
                        </label>
                        <select id="business_category" name="business_category" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition">
                            <option value="">Pilih Kategori</option>
                            @foreach (['F&B', 'Fashion', 'Kerajinan', 'Elektronik', 'Jasa', 'Pertanian', 'Lainnya'] as $cat)
                                <option value="{{ $cat }}"
                                    {{ old('business_category', $user->business_category) == $cat ? 'selected' : '' }}>
                                    {{ $cat }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-3" for="business_address">
                            <i class="fa-solid fa-location-dot mr-2"></i>Alamat UMKM
                        </label>
                        <textarea id="business_address" name="business_address" rows="4" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                            placeholder="Masukkan alamat lengkap UMKM Anda">{{ old('business_address', $user->business_address) }}</textarea>
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-3" for="business_map">
                            <i class="fa-solid fa-map-location-dot mr-2"></i>Link Google Maps
                        </label>
                        <input type="url" id="business_map" name="business_map"
                            value="{{ old('business_map', $user->business_map) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                            placeholder="https://maps.google.com/...">
                        <p class="text-sm text-gray-500 mt-1">Masukkan link lokasi Google Maps (opsional).</p>
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-3" for="business_address">
                            <i class="fa-solid fa-location-dot mr-2"></i>Maps
                        </label>
                        <div id="map" class="rounded shadow" style="height: 300px;"></div>
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-3" for="business_phone">
                            <i class="fa-solid fa-phone mr-2"></i>Nomor Telepon / WhatsApp
                        </label>
                        <input type="text" id="business_phone" name="business_phone"
                            value="{{ old('business_phone', $user->business_phone) }}" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                            placeholder="Contoh: 082123456789">
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-3" for="business_email">
                            <i class="fa-solid fa-envelope mr-2"></i>Email Bisnis
                        </label>
                        <input type="email" id="business_email" name="business_email"
                            value="{{ old('business_email', $user->business_email) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                            placeholder="email@umkm.com">
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-3" for="business_instagram">
                            <i class="fa-brands fa-instagram mr-2"></i>Akun Instagram
                        </label>
                        <input type="text" id="business_instagram" name="business_instagram"
                            value="{{ old('business_instagram', $user->business_instagram) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                            placeholder="Contoh: @namabisnis atau instagram.com/namabisnis">
                        <p class="text-sm text-gray-500 mt-1">Masukkan username Instagram (dengan atau tanpa @) atau
                            URL profil.</p>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-3" for="business_description">
                            <i class="fa-solid fa-pen-to-square mr-2"></i>Deskripsi Bisnis
                        </label>
                        <textarea id="business_description" name="business_description" rows="4"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                            placeholder="Jelaskan tentang bisnis Anda, produk unggulan, dll...">{{ old('business_description', $user->business_description) }}</textarea>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-3" for="business_photo">
                            <i class="fa-solid fa-image mr-2"></i>Upload Foto Profil
                        </label>
                        @if ($user->business_photo)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $user->business_photo) }}" alt="Current Photo"
                                    class="w-20 h-20 object-cover rounded-full">
                                <p class="text-xs text-gray-500">Foto saat ini</p>
                            </div>
                        @endif
                        <input type="file" id="business_photo" name="business_photo" accept="image/*"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition">
                        <p class="text-sm text-gray-500 mt-1">Format: JPG, PNG. Maksimal 2MB.</p>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-3">
                            <i class="fa-solid fa-boxes-stacked mr-2"></i>Tampilkan Stok Produk
                        </label>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <input type="radio" id="show_stock_yes" name="show_stock" value="1"
                                    {{ old('show_stock', $user->show_stock) ? 'checked' : '' }}
                                    class="w-4 h-4 text-green-600 border-gray-300 focus:ring-2 focus:ring-green-500
                                    cursor-pointer">
                                <label for="show_stock_yes" class="ml-3 text-gray-700 cursor-pointer">Tampilkan</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="show_stock_no" name="show_stock" value="0"
                                    {{ !old('show_stock', $user->show_stock) ? 'checked' : '' }}
                                    class="w-4 h-4 text-green-600 border-gray-300 focus:ring-2 focus:ring-green-500
                                    cursor-pointer">
                                <label for="show_stock_no" class="ml-3 text-gray-700 cursor-pointer">Jangan
                                    Tampilkan</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-3" for="business_hours">
                            <i class="fa-solid fa-clock mr-2"></i>Jam Buka
                        </label>
                        <input type="text" id="business_hours" name="business_hours"
                            value="{{ old('business_hours', $user->business_hours) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                            placeholder="Contoh: 08:00 - 17:00 (Senin-Jumat), Sabtu 09:00 - 14:00">
                        <p class="text-sm text-gray-500 mt-1">Masukkan jam buka usaha. Gunakan format yang mudah
                            dibaca (opsional: tambahkan keterangan hari).</p>
                    </div>

                    <div class="flex items-center gap-4 pt-6 border-t border-gray-200">
                        <button type="submit"
                            class="flex-1 bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-semibold transition transform hover:scale-105 flex items-center justify-center space-x-2">
                            <i class="fa-solid fa-check"></i>
                            <span>Simpan Perubahan</span>
                        </button>
                        <a href="{{ route('owner.dashboard') }}"
                            class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 rounded-lg font-semibold transition flex items-center justify-center space-x-2">
                            <i class="fa-solid fa-times"></i>
                            <span>Batal</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="space-y-8">
            <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Preview Profil</h3>
                <div class="text-center mb-6">
                    @if ($user->business_photo)
                        <img src="{{ asset('storage/' . $user->business_photo) }}" alt="Business Photo"
                            class="w-24 h-24 rounded-full object-cover mx-auto mb-4 border-2 border-green-100">
                    @else
                        <div
                            class="w-24 h-24 bg-gradient-to-br from-green-100 to-green-200 rounded-full flex items-center justify-center text-5xl mx-auto mb-4">
                            ☕
                        </div>
                    @endif
                    <h4 class="font-bold text-gray-900 text-lg">{{ $user->business_name ?? 'Nama Bisnis' }}</h4>
                    <p class="text-sm text-gray-600">{{ $user->business_category ?? 'Kategori' }}</p>
                </div>
                <div class="space-y-3 text-sm">
                    <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                        <i class="fa-solid fa-location-dot text-green-600"></i>
                        <span class="text-gray-700 truncate">{{ $user->business_address ?? 'Alamat belum diisi' }}</span>
                    </div>
                    <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                        <i class="fa-solid fa-phone text-green-600"></i>
                        <span class="text-gray-700">{{ $user->business_phone ?? '-' }}</span>
                    </div>
                    <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                        <i class="fa-solid fa-envelope text-green-600"></i>
                        <span class="text-gray-700">{{ $user->business_email ?? 'Email belum diisi' }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
                <div class="flex items-start space-x-3 mb-3">
                    <i class="fa-solid fa-info-circle text-blue-600 text-xl mt-1"></i>
                    <div>
                        <h4 class="font-semibold text-blue-900 mb-2">Tips Lengkapi Profil</h4>
                        <ul class="text-sm text-blue-800 space-y-1">
                            <li><i class="fa-solid fa-check text-green-600 mr-2"></i>Gunakan nama bisnis yang jelas
                            </li>
                            <li><i class="fa-solid fa-check text-green-600 mr-2"></i>Pilih kategori yang sesuai</li>
                            <li><i class="fa-solid fa-check text-green-600 mr-2"></i>Tambahkan deskripsi menarik
                            </li>
                            <li><i class="fa-solid fa-check text-green-600 mr-2"></i>Pastikan kontak aktif</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        // Inisialisasi map
        var map = L.map('map').setView([ -7.644776, 111.023549 ], 13);

        // Tambahkan tile layer (OpenStreetMap)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap'
        }).addTo(map);

        // Tambah marker
        L.marker([ -7.644776, 111.023549 ])
            .addTo(map)
            .bindPopup('Posisi Anda.')
            .openPopup();
    </script>
@endsection