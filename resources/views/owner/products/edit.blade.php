<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - UMKMTerdekat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/js/all.min.js"></script>
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
                        <p class="text-xs text-gray-500">Edit Data Produk</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('owner.dashboard') }}"
                        class="text-gray-600 hover:text-gray-900 flex items-center space-x-2">
                        <i class="fa-solid fa-arrow-left"></i>
                        <span class="hidden sm:inline">Kembali</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
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
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Edit Produk</h2>
                    <p class="text-gray-600">Perbarui informasi produk: <strong>{{ $product->name }}</strong></p>
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

                    <form method="POST" action="{{ route('owner.produk.update', $product->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <div class="mb-6">
                            <label class="block text-gray-700 font-semibold mb-2" for="product_name">
                                Nama Produk <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="product_name" name="product_name"
                                value="{{ old('product_name', $product->name) }}" required
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
                                @foreach(['minuman' => 'Minuman', 'makanan' => 'Makanan', 'snack' => 'Snack', 'lainnya'
                                => 'Lainnya'] as $val => $label)
                                <option value="{{ $val }}" {{ old('product_category', $product->category) == $val ?
                                    'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2" for="product_price">
                                    Harga (Rp) <span class="text-red-500">*</span>
                                </label>
                                <input type="number" id="product_price" name="product_price"
                                    value="{{ old('product_price', $product->price) }}" min="0" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2" for="product_stock">
                                    Stok <span class="text-red-500">*</span>
                                </label>
                                <input type="number" id="product_stock" name="product_stock"
                                    value="{{ old('product_stock', $product->stock) }}" min="0" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Status</label>
                                <select name="product_status"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition">
                                    <option value="active" {{ old('product_status', $product->status) == 'active' ?
                                        'selected' : '' }}>Aktif</option>
                                    <option value="inactive" {{ old('product_status', $product->status) == 'inactive' ?
                                        'selected' : '' }}>Arsipkan</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 font-semibold mb-2" for="product_description">
                                Deskripsi Produk
                            </label>
                            <textarea id="product_description" name="product_description" rows="4"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                                placeholder="Jelaskan detail produk Anda...">{{ old('product_description', $product->description) }}</textarea>
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 font-semibold mb-2" for="product_image">
                                <i class="fa-solid fa-image mr-2"></i>Update Foto Produk
                            </label>

                            @if($product->image)
                            <div
                                class="mb-3 flex items-center space-x-4 p-3 bg-gray-50 rounded-lg border border-gray-200">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Foto Lama"
                                    class="w-16 h-16 object-cover rounded-md">
                                <div>
                                    <p class="text-sm font-medium text-gray-700">Foto saat ini</p>
                                    <p class="text-xs text-gray-500">Biarkan input kosong jika tidak ingin mengganti.
                                    </p>
                                </div>
                            </div>
                            @endif

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
                                class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold transition flex items-center justify-center space-x-2">
                                <i class="fa-solid fa-save"></i>
                                <span>Simpan Perubahan</span>
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
                            <h4 class="font-bold text-blue-900 mb-2">Mode Edit</h4>
                            <p class="text-sm text-blue-800 mb-2">Anda sedang mengubah data produk. Pastikan:</p>
                            <ul class="space-y-2 text-sm text-blue-800">
                                <li class="flex items-start space-x-2">
                                    <i class="fa-solid fa-check text-blue-600 mt-1"></i>
                                    <span>Stok diupdate jika ada penyesuaian fisik</span>
                                </li>
                                <li class="flex items-start space-x-2">
                                    <i class="fa-solid fa-check text-blue-600 mt-1"></i>
                                    <span>Harga update tidak mempengaruhi pesanan lama</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Statistik Produk</h3>
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
    </div>
</body>

</html>