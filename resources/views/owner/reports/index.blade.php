@extends('templates.owner')
@section('title', 'Laporan Penjualan')

@section('content')
{{-- Header Section --}}
<div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-2xl p-8 mb-8 text-white">
    <div class="flex flex-col md:flex-row items-center justify-between">
        <div>
            <h2 class="text-3xl font-bold mb-2">📊 Laporan Penjualan</h2>
            <p class="text-blue-100">Analisis performa penjualan {{ Auth::user()->business_name ?? 'toko Anda' }}</p>
            <p class="text-sm text-blue-200 mt-2">
                Periode: {{ $startDate->format('d M Y') }} - {{ $endDate->format('d M Y') }}
            </p>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="{{ route('owner.dashboard') }}"
                class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-blue-50 transition inline-flex items-center space-x-2 shadow-lg">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Kembali ke Dashboard</span>
            </a>
        </div>
    </div>
</div>

{{-- Filter Periode --}}
<div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100 mb-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <h3 class="text-lg font-bold text-gray-900">Filter Periode</h3>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('owner.laporan', ['period' => 'today']) }}"
                class="px-4 py-2 rounded-lg font-semibold text-sm transition {{ $period == 'today' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Hari Ini
            </a>
            <a href="{{ route('owner.laporan', ['period' => 'week']) }}"
                class="px-4 py-2 rounded-lg font-semibold text-sm transition {{ $period == 'week' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Minggu Ini
            </a>
            <a href="{{ route('owner.laporan', ['period' => 'month']) }}"
                class="px-4 py-2 rounded-lg font-semibold text-sm transition {{ $period == 'month' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Bulan Ini
            </a>
            <a href="{{ route('owner.laporan', ['period' => 'year']) }}"
                class="px-4 py-2 rounded-lg font-semibold text-sm transition {{ $period == 'year' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Tahun Ini
            </a>
            <a href="{{ route('owner.laporan', ['period' => 'all']) }}"
                class="px-4 py-2 rounded-lg font-semibold text-sm transition {{ $period == 'all' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Semua
            </a>
        </div>
    </div>
</div>

{{-- Statistik Cards --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-green-100 p-3 rounded-lg">
                <i class="fa-solid fa-money-bill-wave text-green-600 text-2xl"></i>
            </div>
        </div>
        <p class="text-sm text-gray-600 mb-1">Total Pendapatan</p>
        <h3 class="text-2xl font-bold text-gray-900">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
        @if($totalTax > 0)
        <p class="text-xs text-gray-500 mt-1">Pajak: Rp {{ number_format($totalTax, 0, ',', '.') }}</p>
        @endif
    </div>

    <div class="bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-blue-100 p-3 rounded-lg">
                <i class="fa-solid fa-shopping-cart text-blue-600 text-2xl"></i>
            </div>
        </div>
        <p class="text-sm text-gray-600 mb-1">Total Pesanan</p>
        <h3 class="text-2xl font-bold text-gray-900">{{ $totalOrders }}</h3>
        <p class="text-xs text-gray-500 mt-1">Semua status</p>
    </div>

    <div class="bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-purple-100 p-3 rounded-lg">
                <i class="fa-solid fa-check-circle text-purple-600 text-2xl"></i>
            </div>
        </div>
        <p class="text-sm text-gray-600 mb-1">Pesanan Selesai</p>
        <h3 class="text-2xl font-bold text-gray-900">{{ $completedOrders }}</h3>
        <p class="text-xs text-gray-500 mt-1">
            {{ $totalOrders > 0 ? number_format(($completedOrders / $totalOrders) * 100, 1) : 0 }}% dari total
        </p>
    </div>

    <div class="bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-orange-100 p-3 rounded-lg">
                <i class="fa-solid fa-chart-line text-orange-600 text-2xl"></i>
            </div>
        </div>
        <p class="text-sm text-gray-600 mb-1">Rata-rata Pesanan</p>
        <h3 class="text-2xl font-bold text-gray-900">
            Rp {{ $completedOrders > 0 ? number_format($totalRevenue / $completedOrders, 0, ',', '.') : 0 }}
        </h3>
        <p class="text-xs text-gray-500 mt-1">Per transaksi</p>
    </div>
</div>

{{-- Main Content --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2 space-y-8">
        {{-- Grafik Penjualan --}}
        <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
            <h3 class="text-xl font-bold text-gray-900 mb-6">Grafik Penjualan</h3>
            <div class="h-64 flex items-end justify-between space-x-2">
                @php
                $maxValue = max(array_column($salesChart, 'value'));
                $maxValue = $maxValue > 0 ? $maxValue : 1;
                @endphp
                @foreach($salesChart as $data)
                <div class="flex-1 flex flex-col items-center">
                    <div class="w-full bg-gradient-to-t from-blue-600 to-blue-400 rounded-t-lg transition hover:from-blue-700 hover:to-blue-500 cursor-pointer"
                        style="height: {{ $maxValue > 0 ? ($data['value'] / $maxValue) * 100 : 0 }}%"
                        title="Rp {{ number_format($data['value'], 0, ',', '.') }}">
                    </div>
                    <p class="text-xs text-gray-600 mt-2 transform -rotate-45 origin-top-left">{{ $data['label'] }}</p>
                </div>
                @endforeach
            </div>
            <div class="mt-8 pt-4 border-t border-gray-200">
                <p class="text-sm text-gray-600 text-center">
                    <i class="fa-solid fa-info-circle mr-1"></i>
                    {{ $period == 'today' ? 'Penjualan per jam hari ini' : 'Penjualan 7 hari terakhir' }}
                </p>
            </div>
        </div>

        {{-- Produk Terlaris --}}
        <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
            <h3 class="text-xl font-bold text-gray-900 mb-6">Produk Terlaris</h3>
            @forelse($topProducts as $index => $product)
            <div
                class="flex items-center justify-between p-4 {{ $index % 2 == 0 ? 'bg-gray-50' : '' }} rounded-lg mb-2">
                <div class="flex items-center space-x-4">
                    <div
                        class="w-10 h-10 rounded-full {{ $index == 0 ? 'bg-yellow-100 text-yellow-600' : ($index == 1 ? 'bg-gray-100 text-gray-600' : ($index == 2 ? 'bg-orange-100 text-orange-600' : 'bg-blue-100 text-blue-600')) }} flex items-center justify-center font-bold">
                        {{ $index + 1 }}
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">{{ $product->product_name }}</p>
                        <p class="text-sm text-gray-600">{{ $product->total_sold }} terjual</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="font-bold text-green-600">Rp {{ number_format($product->total_revenue, 0, ',', '.') }}</p>
                </div>
            </div>
            @empty
            <div class="text-center py-8 text-gray-500">
                <i class="fa-solid fa-chart-bar text-3xl mb-2 text-gray-300"></i>
                <p>Belum ada data produk terlaris.</p>
            </div>
            @endforelse
        </div>

        {{-- Transaksi Terbaru --}}
        <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-gray-900">Transaksi Terbaru</h3>
                <a href="{{ route('owner.pesanan.index') }}"
                    class="text-blue-600 hover:text-blue-700 font-semibold text-sm">
                    Lihat Semua →
                </a>
            </div>
            <div class="space-y-3">
                @forelse($recentTransactions as $transaction)
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                    <div class="flex-1">
                        <p class="font-semibold text-gray-900">#{{ $transaction->id }} - {{ $transaction->customer_name
                            }}</p>
                        <p class="text-sm text-gray-600">
                            {{ $transaction->items->count() }} item | {{ $transaction->created_at->format('d M Y, H:i')
                            }}
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-gray-900">Rp {{ number_format($transaction->total_amount, 0, ',', '.')
                            }}</p>
                        @if($transaction->status == 'completed')
                        <span class="text-xs px-2 py-1 rounded-full bg-green-100 text-green-700">Selesai</span>
                        @elseif($transaction->status == 'processing')
                        <span class="text-xs px-2 py-1 rounded-full bg-blue-100 text-blue-700">Diproses</span>
                        @elseif($transaction->status == 'pending')
                        <span class="text-xs px-2 py-1 rounded-full bg-yellow-100 text-yellow-700">Pending</span>
                        @else
                        <span class="text-xs px-2 py-1 rounded-full bg-red-100 text-red-700">Batal</span>
                        @endif
                    </div>
                </div>
                @empty
                <div class="text-center py-8 text-gray-500">
                    <i class="fa-solid fa-receipt text-3xl mb-2 text-gray-300"></i>
                    <p>Belum ada transaksi.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Sidebar --}}
    <div class="space-y-8">
        {{-- Status Pesanan --}}
        <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
            <h3 class="text-xl font-bold text-gray-900 mb-6">Status Pesanan</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-3 bg-yellow-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                        <span class="text-gray-700 font-medium">Pending</span>
                    </div>
                    <span class="text-lg font-bold text-yellow-600">{{ $orderStatus['pending'] }}</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                        <span class="text-gray-700 font-medium">Diproses</span>
                    </div>
                    <span class="text-lg font-bold text-blue-600">{{ $orderStatus['processing'] }}</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                        <span class="text-gray-700 font-medium">Selesai</span>
                    </div>
                    <span class="text-lg font-bold text-green-600">{{ $orderStatus['completed'] }}</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-red-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                        <span class="text-gray-700 font-medium">Dibatalkan</span>
                    </div>
                    <span class="text-lg font-bold text-red-600">{{ $orderStatus['cancelled'] }}</span>
                </div>
            </div>
        </div>

        {{-- Ringkasan Statistik --}}
        <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
            <h3 class="text-xl font-bold text-gray-900 mb-6">Ringkasan</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-gray-200">
                    <span class="text-gray-600">Total Penjualan</span>
                    <span class="font-bold text-gray-900">{{ $totalOrders }} pesanan</span>
                </div>
                <div class="flex items-center justify-between pb-3 border-b border-gray-200">
                    <span class="text-gray-600">Tingkat Keberhasilan</span>
                    <span class="font-bold text-green-600">
                        {{ $totalOrders > 0 ? number_format(($completedOrders / $totalOrders) * 100, 1) : 0 }}%
                    </span>
                </div>
                <div class="flex items-center justify-between pb-3 border-b border-gray-200">
                    <span class="text-gray-600">Total Pendapatan</span>
                    <span class="font-bold text-gray-900">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Rata-rata/Pesanan</span>
                    <span class="font-bold text-gray-900">
                        Rp {{ $completedOrders > 0 ? number_format($totalRevenue / $completedOrders, 0, ',', '.') : 0 }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
            <h3 class="text-xl font-bold text-gray-900 mb-6">Aksi Cepat</h3>
            <div class="space-y-3">
                <a href="{{ route('owner.pesanan.create') }}"
                    class="w-full bg-green-50 hover:bg-green-100 text-green-700 py-3 rounded-lg font-semibold transition flex items-center justify-center space-x-2">
                    <i class="fa-solid fa-plus"></i>
                    <span>Buat Pesanan</span>
                </a>
                <a href="{{ route('owner.produk.index') }}"
                    class="w-full bg-blue-50 hover:bg-blue-100 text-blue-700 py-3 rounded-lg font-semibold transition flex items-center justify-center space-x-2">
                    <i class="fa-solid fa-box"></i>
                    <span>Kelola Produk</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection