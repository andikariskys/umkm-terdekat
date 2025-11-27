@extends('templates.owner')
@section('title', 'Tambah Produk Baru')
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
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Tambah Produk Baru</h2>
                <p class="text-gray-600">Tambahkan produk baru ke toko Anda</p>
            </div>

            <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">

                {{-- Error Validation --}}
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('owner.produk.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2" for="product_name">
                            Nama Produk <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="product_name" name="product_name" value="{{ old('product_name') }}"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                            placeholder="Contoh: Kopi Arabika Premium">
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2" for="product_category">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <select id="product_category" name="product_category" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach (['minuman' => 'Minuman', 'makanan' => 'Makanan', 'snack' => 'Snack', 'lainnya' => 'Lainnya'] as $val => $label)
                                <option value="{{ $val }}" {{ old('product_category') == $val ? 'selected' : '' }}>
                                    {{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2" for="product_price">
                                Harga (Rp) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" id="product_price" name="product_price" value="{{ old('product_price') }}"
                                min="0" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                                placeholder="25000">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2" for="product_stock">
                                Stok <span class="text-red-500">*</span>
                            </label>
                            <input type="number" id="product_stock" name="product_stock" value="{{ old('product_stock') }}"
                                min="0" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                                placeholder="50">
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2" for="product_description">
                            Deskripsi Produk
                        </label>
                        <textarea id="product_description" name="product_description" rows="4"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                            placeholder="Jelaskan detail produk Anda...">{{ old('product_description') }}</textarea>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2" for="product_image">
                            <i class="fa-solid fa-image mr-2"></i>Upload Foto Produk
                        </label>
                        <input type="file" id="product_image" name="product_image" accept="image/*"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition">
                        <p class="text-sm text-gray-500 mt-1">Format: JPG, PNG. Maksimal 2MB.</p>
                    </div>

                    <div class="flex items-center space-x-4 pt-6 border-t border-gray-200">
                        <a href="{{ route('owner.dashboard') }}"
                            class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 rounded-lg font-semibold transition text-center">
                            Batal
                        </a>
                        <button type="submit"
                            class="flex-1 bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-semibold transition flex items-center justify-center space-x-2">
                            <i class="fa-solid fa-check-circle"></i>
                            <span>Simpan Produk</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="space-y-8">

            <div class="bg-blue-50 border border-blue-200 rounded-2xl p-6">
                <div class="flex items-start space-x-3 mb-3">
                    <div class="bg-blue-100 p-3 rounded-lg">
                        <i class="fa-solid fa-lightbulb text-blue-600 text-lg"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-blue-900 mb-2">Tips Menambah Produk</h4>
                        <ul class="space-y-2 text-sm text-blue-800">
                            <li class="flex items-start space-x-2">
                                <i class="fa-solid fa-check text-blue-600 mt-1"></i>
                                <span>Gunakan nama produk yang jelas</span>
                            </li>
                            <li class="flex items-start space-x-2">
                                <i class="fa-solid fa-check text-blue-600 mt-1"></i>
                                <span>Atur harga yang kompetitif</span>
                            </li>
                            <li class="flex items-start space-x-2">
                                <i class="fa-solid fa-check text-blue-600 mt-1"></i>
                                <span>Foto produk yang menarik</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Produk Anda</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Total Produk</span>
                        <span class="text-2xl font-bold text-green-600">{{ $totalProducts }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Aktif</span>
                        <span class="text-2xl font-bold text-green-600">{{ $activeProducts }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Tidak Aktif</span>
                        <span class="text-2xl font-bold text-red-600">{{ $inactiveProducts }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection