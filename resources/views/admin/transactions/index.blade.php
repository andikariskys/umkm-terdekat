@extends('templates.admin')
@section('title', 'Semua Transaksi')

@section('content')
{{-- Header Section --}}
<div class="bg-gradient-to-r from-red-600 to-red-700 rounded-2xl p-8 mb-8 text-white">
    <div class="flex flex-col md:flex-row items-center justify-between">
        <div>
            <h2 class="text-3xl font-bold mb-2">🛒 Semua Transaksi</h2>
            <p class="text-red-100">Pantau seluruh transaksi yang terjadi di platform</p>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="{{ route('admin.dashboard') }}"
                class="bg-white text-red-600 px-6 py-3 rounded-lg font-semibold hover:bg-red-50 transition inline-flex items-center space-x-2 shadow-lg">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Kembali ke Dashboard</span>
            </a>
        </div>
    </div>
</div>

{{-- Statistik Cards --}}
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
    <div class="bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-blue-100 p-3 rounded-lg">
                <i class="fa-solid fa-shopping-cart text-blue-600 text-xl"></i>
            </div>
            <span class="text-xs text-blue-600 font-semibold">Total</span>
        </div>
        <h3 class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</h3>
        <p class="text-gray-600 text-sm">Total Transaksi</p>
    </div>

    <div class="bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-yellow-100 p-3 rounded-lg">
                <i class="fa-solid fa-clock text-yellow-600 text-xl"></i>
            </div>
            <span class="text-xs text-yellow-600 font-semibold">Pending</span>
        </div>
        <h3 class="text-2xl font-bold text-gray-900">{{ $stats['pending'] }}</h3>
        <p class="text-gray-600 text-sm">Menunggu</p>
    </div>

    <div class="bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-blue-100 p-3 rounded-lg">
                <i class="fa-solid fa-spinner text-blue-600 text-xl"></i>
            </div>
            <span class="text-xs text-blue-600 font-semibold">Proses</span>
        </div>
        <h3 class="text-2xl font-bold text-gray-900">{{ $stats['processing'] }}</h3>
        <p class="text-gray-600 text-sm">Diproses</p>
    </div>

    <div class="bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-green-100 p-3 rounded-lg">
                <i class="fa-solid fa-check-circle text-green-600 text-xl"></i>
            </div>
            <span class="text-xs text-green-600 font-semibold">Selesai</span>
        </div>
        <h3 class="text-2xl font-bold text-gray-900">{{ $stats['completed'] }}</h3>
        <p class="text-gray-600 text-sm">Berhasil</p>
    </div>

    <div class="bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-red-100 p-3 rounded-lg">
                <i class="fa-solid fa-times-circle text-red-600 text-xl"></i>
            </div>
            <span class="text-xs text-red-600 font-semibold">Batal</span>
        </div>
        <h3 class="text-2xl font-bold text-gray-900">{{ $stats['cancelled'] }}</h3>
        <p class="text-gray-600 text-sm">Dibatalkan</p>
    </div>

    <div class="bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-purple-100 p-3 rounded-lg">
                <i class="fa-solid fa-money-bill-wave text-purple-600 text-xl"></i>
            </div>
            <span class="text-xs text-purple-600 font-semibold">Revenue</span>
        </div>
        <h3 class="text-xl font-bold text-gray-900">Rp {{ number_format($stats['revenue'], 0, ',', '.') }}</h3>
        <p class="text-gray-600 text-sm">Pendapatan</p>
    </div>
</div>

{{-- Transactions List --}}
<div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-200">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h3 class="text-xl font-bold text-gray-900">Daftar Transaksi</h3>
            <div class="flex items-center space-x-2">
                <span class="text-sm text-gray-600">Menampilkan {{ $transactions->count() }} dari {{ $stats['total'] }}
                    transaksi</span>
            </div>
        </div>
    </div>

    <div class="p-6">
        <div class="space-y-4">
            @forelse ($transactions as $trx)
            <div class="p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition border border-gray-200">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="flex-1">
                        <div class="flex items-center space-x-2 mb-2">
                            <p class="font-bold text-gray-900 text-lg">#{{ $trx->id }}</p>
                            @if($trx->status == 'completed')
                            <span
                                class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700 inline-flex items-center space-x-1">
                                <i class="fa-solid fa-check-circle"></i>
                                <span>Selesai</span>
                            </span>
                            @elseif($trx->status == 'processing')
                            <span
                                class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-700 inline-flex items-center space-x-1">
                                <i class="fa-solid fa-spinner"></i>
                                <span>Diproses</span>
                            </span>
                            @elseif($trx->status == 'pending')
                            <span
                                class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-700 inline-flex items-center space-x-1">
                                <i class="fa-solid fa-clock"></i>
                                <span>Pending</span>
                            </span>
                            @else
                            <span
                                class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700 inline-flex items-center space-x-1">
                                <i class="fa-solid fa-times-circle"></i>
                                <span>Batal</span>
                            </span>
                            @endif
                        </div>
                        <p class="text-sm text-gray-600 mb-1">
                            <i class="fa-solid fa-user"></i> <strong>Pelanggan:</strong> {{
                            $trx->customer_name }}
                        </p>
                        <p class="text-sm text-gray-600 mb-1">
                            <i class="fa-solid fa-store"></i> <strong>UMKM:</strong> {{
                            $trx->user->business_name
                            ?? $trx->user->name }}
                        </p>
                        <p class="text-sm text-gray-600 mb-1">
                            <i class="fa-solid fa-box"></i> <strong>Produk:</strong>
                            @if($trx->items->count() > 0)
                            {{ $trx->items->first()->product_name }}
                            @if($trx->items->count() > 1)
                            <span class="text-xs text-gray-500">(+{{ $trx->items->count() -
                                1 }} produk
                                lainnya)</span>
                            @endif
                            @else
                            <span class="text-gray-400">-</span>
                            @endif
                        </p>
                        <p class="text-xs text-gray-500 mt-2">
                            <i class="fa-solid fa-clock"></i> {{ $trx->created_at->format('d
                            M Y, H:i') }} WIB
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-2xl text-gray-900">Rp {{
                            number_format($trx->total_amount, 0, ',',
                            '.') }}</p>
                        @if($trx->tax_amount > 0)
                        <p class="text-xs text-gray-500 mt-1">Pajak: Rp {{
                            number_format($trx->tax_amount, 0, ',',
                            '.') }}</p>
                        @endif
                        <p class="text-sm text-gray-600 mt-2">
                            <i class="fa-solid fa-shopping-bag"></i> {{
                            $trx->items->sum('quantity') }} item
                        </p>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-12 text-gray-500">
                <div class="bg-gray-100 w-20 h-20 rounded-full flex items-center justify-center mb-4 mx-auto">
                    <i class="fa-solid fa-shopping-cart text-5xl text-gray-400"></i>
                </div>
                <p class="text-lg font-semibold text-gray-700 mb-2">Belum ada transaksi</p>
                <p class="text-sm text-gray-600">Transaksi akan muncul di sini ketika ada
                    pesanan baru</p>
            </div>
            @endforelse
        </div>
    </div>

    {{-- Pagination --}}
    @if ($transactions->hasPages())
    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
        {{ $transactions->links() }}
    </div>
    @endif
</div>

{{-- Quick Actions --}}
<div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
    <a href="{{ route('admin.dashboard') }}"
        class="bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white p-6 rounded-xl shadow-md transition transform hover:scale-105">
        <div class="flex items-center space-x-4">
            <div class="bg-white/20 p-4 rounded-lg">
                <i class="fa-solid fa-chart-line text-2xl"></i>
            </div>
            <div>
                <h4 class="font-bold text-lg">Dashboard Admin</h4>
                <p class="text-red-100 text-sm">Kembali ke dashboard utama</p>
            </div>
        </div>
    </a>

    <a href="{{ route('admin.umkm.index') }}"
        class="bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white p-6 rounded-xl shadow-md transition transform hover:scale-105">
        <div class="flex items-center space-x-4">
            <div class="bg-white/20 p-4 rounded-lg">
                <i class="fa-solid fa-store text-2xl"></i>
            </div>
            <div>
                <h4 class="font-bold text-lg">Kelola UMKM</h4>
                <p class="text-purple-100 text-sm">Lihat semua UMKM terdaftar</p>
            </div>
        </div>
    </a>
</div>
@endsection