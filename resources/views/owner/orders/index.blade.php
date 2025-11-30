@extends('templates.owner')
@section('title', 'Kelola Pesanan')

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
            <h2 class="text-3xl font-bold mb-2">🛒 Kelola Pesanan</h2>
            <p class="text-green-100">Kelola semua pesanan {{ Auth::user()->business_name ?? 'toko Anda' }}</p>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="{{ route('owner.pesanan.create') }}"
                class="bg-white text-green-600 px-6 py-3 rounded-lg font-semibold hover:bg-green-50 transition inline-flex items-center space-x-2 shadow-lg">
                <i class="fa-solid fa-plus"></i>
                <span>Buat Pesanan Baru</span>
            </a>
        </div>
    </div>
</div>

{{-- Statistik Cards --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 mb-8">
    <div class="bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-green-100 p-3 rounded-lg">
                <i class="fa-solid fa-shopping-cart text-green-600 text-xl"></i>
            </div>
            <span class="text-xs text-green-600 font-semibold">Total</span>
        </div>
        <h3 class="text-2xl font-bold text-gray-900">{{ $totalOrders }}</h3>
        <p class="text-gray-600 text-sm">Total Pesanan</p>
    </div>

    <div class="bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-yellow-100 p-3 rounded-lg">
                <i class="fa-solid fa-clock text-yellow-600 text-xl"></i>
            </div>
            <span class="text-xs text-yellow-600 font-semibold">Menunggu</span>
        </div>
        <h3 class="text-2xl font-bold text-gray-900">{{ $pendingOrders }}</h3>
        <p class="text-gray-600 text-sm">Pesanan Pending</p>
    </div>

    <div class="bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-blue-100 p-3 rounded-lg">
                <i class="fa-solid fa-spinner text-blue-600 text-xl"></i>
            </div>
            <span class="text-xs text-blue-600 font-semibold">Diproses</span>
        </div>
        <h3 class="text-2xl font-bold text-gray-900">{{ $processingOrders }}</h3>
        <p class="text-gray-600 text-sm">Sedang Diproses</p>
    </div>

    <div class="bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-purple-100 p-3 rounded-lg">
                <i class="fa-solid fa-check-circle text-purple-600 text-xl"></i>
            </div>
            <span class="text-xs text-purple-600 font-semibold">Selesai</span>
        </div>
        <h3 class="text-2xl font-bold text-gray-900">{{ $completedOrders }}</h3>
        <p class="text-gray-600 text-sm">Pesanan Selesai</p>
    </div>
</div>

{{-- Daftar Pesanan --}}
<div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-200">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h3 class="text-xl font-bold text-gray-900">Daftar Pesanan</h3>
            <div class="flex items-center space-x-2">
                <a href="{{ route('owner.dashboard') }}"
                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-semibold text-sm transition inline-flex items-center space-x-2">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Kembali ke Dashboard</span>
                </a>
            </div>
        </div>
    </div>

    <div class="p-6">
        <div class="space-y-4">
            @forelse ($orders as $order)
            <div class="border border-gray-200 rounded-xl p-5 hover:border-green-300 transition hover:shadow-md">
                <div class="flex flex-col md:flex-row md:items-start justify-between gap-4 mb-4">
                    <div class="flex-1">
                        <div class="flex items-center space-x-3 mb-2">
                            <h4 class="text-lg font-bold text-gray-900">#{{ $order->id }}</h4>
                            @if ($order->status == 'pending')
                            <span
                                class="text-xs px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 font-semibold inline-flex items-center space-x-1">
                                <i class="fa-regular fa-clock"></i>
                                <span>Menunggu</span>
                            </span>
                            @elseif($order->status == 'processing')
                            <span
                                class="text-xs px-3 py-1 rounded-full bg-blue-100 text-blue-700 font-semibold inline-flex items-center space-x-1">
                                <i class="fa-solid fa-spinner fa-spin"></i>
                                <span>Diproses</span>
                            </span>
                            @elseif($order->status == 'completed')
                            <span
                                class="text-xs px-3 py-1 rounded-full bg-green-100 text-green-700 font-semibold inline-flex items-center space-x-1">
                                <i class="fa-solid fa-check"></i>
                                <span>Selesai</span>
                            </span>
                            @else
                            <span
                                class="text-xs px-3 py-1 rounded-full bg-red-100 text-red-700 font-semibold inline-flex items-center space-x-1">
                                <i class="fa-solid fa-times"></i>
                                <span>Dibatalkan</span>
                            </span>
                            @endif
                        </div>

                        <div class="space-y-1 mb-3">
                            <p class="text-sm text-gray-600">
                                <i class="fa-solid fa-user mr-1"></i>
                                <span class="font-semibold">{{ $order->customer_name }}</span>
                                @if ($order->customer_phone)
                                <span class="text-gray-400 ml-2">
                                    <i class="fa-solid fa-phone mr-1"></i>{{ $order->customer_phone }}
                                </span>
                                @endif
                            </p>
                            <p class="text-xs text-gray-500">
                                <i class="fa-solid fa-calendar mr-1"></i>
                                {{ $order->created_at->format('d M Y, H:i') }}
                                <span class="text-gray-400">({{ $order->created_at->diffForHumans() }})</span>
                            </p>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-3">
                            <p class="text-xs font-semibold text-gray-700 mb-2">Item Pesanan:</p>
                            <div class="space-y-1">
                                @foreach ($order->items as $item)
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-700">
                                        <i class="fa-solid fa-box text-gray-400 mr-1"></i>
                                        {{ $item->product_name }}
                                        @if ($item->quantity > 1)
                                        <span class="text-gray-500 text-xs">(x{{ $item->quantity }})</span>
                                        @endif
                                    </span>
                                    <span class="font-semibold text-gray-900">
                                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                    </span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="md:text-right space-y-3">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Total Pembayaran</p>
                            <p class="text-2xl font-bold text-green-600">
                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                            </p>
                            @if ($order->tax > 0)
                            <p class="text-xs text-gray-500">
                                (Termasuk pajak Rp {{ number_format($order->tax, 0, ',', '.') }})
                            </p>
                            @endif
                        </div>

                        <div class="flex md:flex-col gap-2">
                            @if ($order->status == 'pending')
                            <form action="{{ route('owner.pesanan.update-status', $order->id) }}" method="POST"
                                class="w-full">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="processing">
                                <button type="submit"
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition shadow-sm inline-flex items-center justify-center space-x-1">
                                    <i class="fa-solid fa-fire-burner"></i>
                                    <span>Proses Pesanan</span>
                                </button>
                            </form>
                            @elseif($order->status == 'processing')
                            <form action="{{ route('owner.pesanan.update-status', $order->id) }}" method="POST"
                                class="w-full">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="completed">
                                <button type="submit"
                                    class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition shadow-sm inline-flex items-center justify-center space-x-1">
                                    <i class="fa-solid fa-check"></i>
                                    <span>Selesaikan</span>
                                </button>
                            </form>
                            @elseif($order->status == 'completed')
                            <a href="{{ route('owner.pesanan.print', $order->id) }}" target="_blank"
                                class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-semibold transition border border-gray-300 inline-flex items-center justify-center space-x-1">
                                <i class="fa-solid fa-print"></i>
                                <span>Cetak Struk</span>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-16">
                <div class="bg-gray-100 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-clipboard-list text-5xl text-gray-400"></i>
                </div>
                <p class="text-lg font-semibold text-gray-700 mb-2">Belum ada pesanan</p>
                <p class="text-sm text-gray-600 mb-6">Pesanan yang masuk akan muncul di sini.</p>
                <a href="{{ route('owner.pesanan.create') }}"
                    class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg text-sm font-semibold transition inline-flex items-center space-x-2 shadow-md">
                    <i class="fa-solid fa-plus"></i>
                    <span>Buat Pesanan Pertama</span>
                </a>
            </div>
            @endforelse
        </div>
    </div>

    {{-- Pagination --}}
    @if ($orders->hasPages())
    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
        {{ $orders->links() }}
    </div>
    @endif
</div>

{{-- Quick Actions --}}
<div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
    <a href="{{ route('owner.pesanan.create') }}"
        class="bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white p-6 rounded-xl shadow-md transition transform hover:scale-105">
        <div class="flex items-center space-x-4">
            <div class="bg-white/20 p-4 rounded-lg">
                <i class="fa-solid fa-plus text-2xl"></i>
            </div>
            <div>
                <h4 class="font-bold text-lg">Buat Pesanan</h4>
                <p class="text-green-100 text-sm">Tambah pesanan baru (POS)</p>
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

    <a href="{{ route('owner.produk.index') }}"
        class="bg-gradient-to-r from-orange-600 to-orange-700 hover:from-orange-700 hover:to-orange-800 text-white p-6 rounded-xl shadow-md transition transform hover:scale-105">
        <div class="flex items-center space-x-4">
            <div class="bg-white/20 p-4 rounded-lg">
                <i class="fa-solid fa-box text-2xl"></i>
            </div>
            <div>
                <h4 class="font-bold text-lg">Kelola Produk</h4>
                <p class="text-orange-100 text-sm">Lihat semua produk</p>
            </div>
        </div>
    </a>
</div>
@endsection