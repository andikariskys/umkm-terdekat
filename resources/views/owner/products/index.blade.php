@extends('templates.owner')
@section('title', 'Kelola Produk')

@section('content')
{{-- Flash Message Success --}}
@if (session('success'))
<div
    class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center space-x-2 animate-fade-in-down">
    <i class="fa-solid fa-circle-check"></i>
    <span>{{ session('success') }}</span>
</div>
@endif

{{-- Header Section --}}
<div class="bg-gradient-to-r from-green-600 to-green-700 rounded-2xl p-8 mb-8 text-white">
    <div class="flex flex-col md:flex-row items-center justify-between">
        <div>
            <h2 class="text-3xl font-bold mb-2">📦 Kelola Produk</h2>
            <p class="text-green-100">Kelola semua produk {{ Auth::user()->business_name ?? 'toko Anda' }}</p>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="{{ route('owner.produk.create') }}"
                class="bg-white text-green-600 px-6 py-3 rounded-lg font-semibold hover:bg-green-50 transition inline-flex items-center space-x-2 shadow-lg">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Produk Baru</span>
            </a>
        </div>
    </div>
</div>

{{-- Statistik Cards --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 mb-8">
    <div class="bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-green-100 p-3 rounded-lg">
                <i class="fa-solid fa-box text-green-600 text-xl"></i>
            </div>
            <span class="text-xs text-green-600 font-semibold">Total</span>
        </div>
        <h3 class="text-2xl font-bold text-gray-900">{{ $totalProducts }}</h3>
        <p class="text-gray-600 text-sm">Total Produk</p>
    </div>

    <div class="bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-blue-100 p-3 rounded-lg">
                <i class="fa-solid fa-check-circle text-blue-600 text-xl"></i>
            </div>
            <span class="text-xs text-blue-600 font-semibold">Aktif</span>
        </div>
        <h3 class="text-2xl font-bold text-gray-900">{{ $activeProducts }}</h3>
        <p class="text-gray-600 text-sm">Produk Aktif</p>
    </div>

    <div class="bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-gray-100 p-3 rounded-lg">
                <i class="fa-solid fa-pause-circle text-gray-600 text-xl"></i>
            </div>
            <span class="text-xs text-gray-600 font-semibold">Nonaktif</span>
        </div>
        <h3 class="text-2xl font-bold text-gray-900">{{ $inactiveProducts }}</h3>
        <p class="text-gray-600 text-sm">Produk Nonaktif</p>
    </div>

    <div class="bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-orange-100 p-3 rounded-lg">
                <i class="fa-solid fa-exclamation-circle text-orange-600 text-xl"></i>
            </div>
            <span class="text-xs text-orange-600 font-semibold">Habis</span>
        </div>
        <h3 class="text-2xl font-bold text-gray-900">{{ $outOfStock }}</h3>
        <p class="text-gray-600 text-sm">Stok Habis</p>
    </div>
</div>

{{-- Table Produk --}}
<div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-200">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h3 class="text-xl font-bold text-gray-900">Daftar Produk</h3>
            <div class="flex items-center space-x-2">
                <a href="{{ route('owner.dashboard') }}"
                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-semibold text-sm transition inline-flex items-center space-x-2">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Kembali ke Dashboard</span>
                </a>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Produk
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Kategori
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Harga
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Stok
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Terjual
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Status
                    </th>
                    <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($products as $product)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center space-x-4">
                            @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}"
                                class="w-12 h-12 rounded-lg object-cover bg-gray-100 shadow-sm"
                                alt="{{ $product->name }}">
                            @else
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-green-100 to-green-200 rounded-lg flex items-center justify-center">
                                <span class="text-2xl">📦</span>
                            </div>
                            @endif
                            <div>
                                <p class="font-semibold text-gray-900">{{ $product->name }}</p>
                                @if ($product->description)
                                <p class="text-xs text-gray-500">{{ Str::limit($product->description, 40) }}</p>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 text-xs font-medium bg-gray-100 text-gray-700 rounded-full capitalize">
                            {{ $product->category }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-gray-900 font-semibold">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if ($product->stock == 0)
                        <span class="text-red-600 font-bold">{{ $product->stock }}</span>
                        @elseif($product->stock <= 10) <span class="text-orange-600 font-semibold">{{ $product->stock
                            }}</span>
                            @else
                            <span class="text-gray-900">{{ $product->stock }}</span>
                            @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 text-center">
                        {{ $product->sold }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if ($product->stock == 0)
                        <span
                            class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700 inline-flex items-center space-x-1">
                            <i class="fa-solid fa-ban"></i>
                            <span>Stok Habis</span>
                        </span>
                        @elseif($product->status == 'active')
                        <span
                            class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700 inline-flex items-center space-x-1">
                            <i class="fa-solid fa-check-circle"></i>
                            <span>Aktif</span>
                        </span>
                        @else
                        <span
                            class="px-3 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-600 inline-flex items-center space-x-1">
                            <i class="fa-solid fa-pause-circle"></i>
                            <span>Nonaktif</span>
                        </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <div class="flex items-center justify-center space-x-2">
                            <a href="{{ route('owner.produk.edit', $product->id) }}"
                                class="text-blue-600 hover:bg-blue-50 p-2 rounded-lg transition" title="Edit">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>

                            <form action="{{ route('owner.produk.destroy', $product->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus produk {{ $product->name }}?');"
                                class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:bg-red-50 p-2 rounded-lg transition"
                                    title="Hapus">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center justify-center text-gray-500">
                            <div class="bg-gray-100 w-20 h-20 rounded-full flex items-center justify-center mb-4">
                                <i class="fa-solid fa-box-open text-5xl text-gray-400"></i>
                            </div>
                            <p class="text-lg font-semibold text-gray-700 mb-2">Belum ada produk</p>
                            <p class="text-sm text-gray-600 mb-6">Mulai tambahkan produk pertama Anda sekarang!</p>
                            <a href="{{ route('owner.produk.create') }}"
                                class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg text-sm font-semibold transition inline-flex items-center space-x-2 shadow-md">
                                <i class="fa-solid fa-plus"></i>
                                <span>Tambah Produk Pertama</span>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if ($products->hasPages())
    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
        {{ $products->links() }}
    </div>
    @endif
</div>

{{-- Quick Actions --}}
<div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
    <a href="{{ route('owner.produk.create') }}"
        class="bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white p-6 rounded-xl shadow-md transition transform hover:scale-105">
        <div class="flex items-center space-x-4">
            <div class="bg-white/20 p-4 rounded-lg">
                <i class="fa-solid fa-plus text-2xl"></i>
            </div>
            <div>
                <h4 class="font-bold text-lg">Tambah Produk</h4>
                <p class="text-green-100 text-sm">Tambah produk baru ke toko</p>
            </div>
        </div>
    </a>

    <a href="{{ route('owner.dashboard') }}"
        class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white p-6 rounded-xl shadow-md transition transform hover:scale-105">
        <div class="flex items-center space-x-4">
            <div class="bg-white/20 p-4 rounded-lg">
                <i class="fa-solid fa-chart-line text-2xl"></i>
            </div>
            <div>
                <h4 class="font-bold text-lg">Dashboard</h4>
                <p class="text-blue-100 text-sm">Lihat statistik penjualan</p>
            </div>
        </div>
    </a>

    <a href="{{ route('owner.pesanan.create') }}"
        class="bg-gradient-to-r from-orange-600 to-orange-700 hover:from-orange-700 hover:to-orange-800 text-white p-6 rounded-xl shadow-md transition transform hover:scale-105">
        <div class="flex items-center space-x-4">
            <div class="bg-white/20 p-4 rounded-lg">
                <i class="fa-solid fa-shopping-cart text-2xl"></i>
            </div>
            <div>
                <h4 class="font-bold text-lg">Buat Pesanan</h4>
                <p class="text-orange-100 text-sm">Buat pesanan baru (POS)</p>
            </div>
        </div>
    </a>
</div>
@endsection