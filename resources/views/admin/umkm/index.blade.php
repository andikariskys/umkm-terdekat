@extends('templates.admin')
@section('title', 'Kelola UMKM')

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
<div class="bg-gradient-to-r from-red-600 to-red-700 rounded-2xl p-8 mb-8 text-white">
    <div class="flex flex-col md:flex-row items-center justify-between">
        <div>
            <h2 class="text-3xl font-bold mb-2">📋 Kelola UMKM Terdaftar</h2>
            <p class="text-red-100">Lihat dan kelola seluruh UMKM yang terdaftar di platform</p>
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
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 mb-8">
    <div class="bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-blue-100 p-3 rounded-lg">
                <i class="fa-solid fa-store text-blue-600 text-xl"></i>
            </div>
            <span class="text-xs text-blue-600 font-semibold">Total</span>
        </div>
        <h3 class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</h3>
        <p class="text-gray-600 text-sm">Total UMKM</p>
    </div>

    <div class="bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-green-100 p-3 rounded-lg">
                <i class="fa-solid fa-check-circle text-green-600 text-xl"></i>
            </div>
            <span class="text-xs text-green-600 font-semibold">Aktif</span>
        </div>
        <h3 class="text-2xl font-bold text-gray-900">{{ $stats['active'] }}</h3>
        <p class="text-gray-600 text-sm">UMKM Aktif</p>
    </div>

    <div class="bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-red-100 p-3 rounded-lg">
                <i class="fa-solid fa-ban text-red-600 text-xl"></i>
            </div>
            <span class="text-xs text-red-600 font-semibold">Nonaktif</span>
        </div>
        <h3 class="text-2xl font-bold text-gray-900">{{ $stats['inactive'] }}</h3>
        <p class="text-gray-600 text-sm">UMKM Nonaktif</p>
    </div>

    <div class="bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-yellow-100 p-3 rounded-lg">
                <i class="fa-solid fa-clock text-yellow-600 text-xl"></i>
            </div>
            <span class="text-xs text-yellow-600 font-semibold">Pending</span>
        </div>
        <h3 class="text-2xl font-bold text-gray-900">{{ $stats['pending'] }}</h3>
        <p class="text-gray-600 text-sm">Menunggu Verifikasi</p>
    </div>
</div>

{{-- UMKM Table --}}
<div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-200">
        <h3 class="text-xl font-bold text-gray-900">Daftar UMKM</h3>
        <p class="text-gray-600 text-sm">Kelola status dan informasi UMKM terdaftar</p>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">UMKM
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Pemilik
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Email
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Produk
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status
                    </th>
                    <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($umkmList as $umkm)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm font-medium text-gray-600">#{{ $umkm->id }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="font-semibold text-gray-900">{{ $umkm->business ?? $umkm->business_name }}</div>
                        <div class="text-xs text-gray-500">Bergabung: {{ $umkm->created_at->format('d M Y') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-gray-900">{{ $umkm->name }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-gray-600 text-sm">{{ $umkm->email }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-gray-900 font-medium">{{ $umkm->products_count ?? 0 }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($umkm->status == 'active')
                        <span
                            class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700 inline-flex items-center space-x-1">
                            <i class="fa-solid fa-check-circle"></i>
                            <span>Aktif</span>
                        </span>
                        @elseif($umkm->status == 'inactive')
                        <span
                            class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700 inline-flex items-center space-x-1">
                            <i class="fa-solid fa-ban"></i>
                            <span>Nonaktif</span>
                        </span>
                        @else
                        <span
                            class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-700 inline-flex items-center space-x-1">
                            <i class="fa-solid fa-clock"></i>
                            <span>Pending</span>
                        </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center justify-center space-x-2">
                            <a href="{{ route('business.profile', $umkm->id) }}"
                                class="text-blue-600 hover:bg-blue-50 p-2 rounded-lg transition" title="Lihat Detail">
                                <i class="fa-solid fa-eye"></i>
                            </a>

                            @if($umkm->status == 'active')
                            {{-- Tombol Nonaktifkan --}}
                            <form action="{{ route('admin.umkm.update-status', $umkm->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menonaktifkan UMKM {{ $umkm->business_name ?? $umkm->name }}?');"
                                class="inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="inactive">
                                <button type="submit" class="text-red-600 hover:bg-red-50 p-2 rounded-lg transition"
                                    title="Nonaktifkan">
                                    <i class="fa-solid fa-ban"></i>
                                </button>
                            </form>
                            @else
                            {{-- Tombol Aktifkan --}}
                            <form action="{{ route('admin.umkm.update-status', $umkm->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin mengaktifkan UMKM {{ $umkm->business_name ?? $umkm->name }}?');"
                                class="inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="active">
                                <button type="submit" class="text-green-600 hover:bg-green-50 p-2 rounded-lg transition"
                                    title="Aktifkan">
                                    <i class="fa-solid fa-check-circle"></i>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center justify-center text-gray-500">
                            <div class="bg-gray-100 w-20 h-20 rounded-full flex items-center justify-center mb-4">
                                <i class="fa-solid fa-store text-5xl text-gray-400"></i>
                            </div>
                            <p class="text-lg font-semibold text-gray-700 mb-2">Belum ada UMKM terdaftar</p>
                            <p class="text-sm text-gray-600">UMKM yang mendaftar akan muncul di sini</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if ($umkmList->hasPages())
    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
        {{ $umkmList->links() }}
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

    <a href="{{ route('admin.transactions.index') }}"
        class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white p-6 rounded-xl shadow-md transition transform hover:scale-105">
        <div class="flex items-center space-x-4">
            <div class="bg-white/20 p-4 rounded-lg">
                <i class="fa-solid fa-shopping-cart text-2xl"></i>
            </div>
            <div>
                <h4 class="font-bold text-lg">Lihat Transaksi</h4>
                <p class="text-blue-100 text-sm">Pantau semua transaksi platform</p>
            </div>
        </div>
    </a>
</div>
@endsection