<?php

?>
@extends('templates.anonymous')
@section('title', 'Usaha')
@section('content')
    <main class="py-12">
        <div class="max-w-7xl mx-auto px-6 mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
                <div class="flex items-center space-x-3">
                    <div class="text-green-600 bg-green-50 p-3 rounded-lg">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Lokasi</p>
                        <p class="text-lg font-semibold text-gray-900">Matesih, Jawa Tengah <span
                                class="text-xs text-gray-400">(Ubah lokasi sesuai kebutuhan)</span></p>
                    </div>
                </div>
                <div class="text-sm text-gray-500">
                    Koordinat: <span class="font-medium">-7.644776, 111.023549</span>
                </div>
            </div>

            <form action="{{ route('business') }}" method="get" class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                    <label for="q" class="sr-only">Cari usaha</label>
                    <input id="q" name="q" type="search" placeholder="Cari nama, kategori, atau alamat..."
                        class="w-full sm:flex-1 border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-200" value="{{ request('q') }}" />

                    <select name="category" class="w-full sm:w-48 border border-gray-200 rounded-lg px-3 py-3 bg-white">
                        <option value="" selected>Semua Kategori</option>
                        @foreach (['F&B', 'Fashion', 'Kerajinan', 'Elektronik', 'Jasa', 'Pertanian', 'Lainnya'] as $cat)
                            <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                                {{ $cat }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit"
                        class="bg-green-600 text-white px-4 py-3 rounded-lg font-semibold hover:bg-green-700 flex items-center justify-center">
                        <i class="fa-solid fa-magnifying-glass mr-2"></i> Cari
                    </button>
                </div>
            </form>
        </div>

        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900">Semua Profil Usaha</h2>
                    <p class="text-gray-600">Daftar lengkap profil UMKM yang terdaftar di platform</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse ($umkmList as $umkm)
                    <div
                        class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 p-6 text-center border border-gray-100 hover:border-green-200 transform hover:-translate-y-1">

                        {{-- Foto / Emoji --}}
                        <div
                            class="w-24 h-24 mx-auto mb-4 bg-gradient-to-br from-green-100 to-green-200 rounded-full flex items-center justify-center text-5xl shadow-lg">
                            @if ($umkm->business_photo)
                                <img src="{{ asset('storage/' . $umkm->business_photo) }}"
                                    alt="{{ $umkm->business_name }}"
                                    class="w-full h-full object-cover rounded-full">
                            @else
                                {{ $umkm->emoji ?? '🏪' }}
                            @endif
                        </div>

                        {{-- Kategori --}}
                        <div class="mb-2">
                            <span class="text-xs bg-green-100 text-green-700 px-3 py-1 rounded-full font-medium">
                                {{ $umkm->business_category }}
                            </span>
                        </div>

                        {{-- Nama UMKM --}}
                        <h4 class="font-semibold text-gray-900 mb-2 text-base">
                            {{ $umkm->business_name }}
                        </h4>

                        {{-- Alamat --}}
                        <p class="text-gray-500 text-sm mb-4 flex items-center justify-center">
                            <i class="fa-solid fa-location-dot mr-2"></i>
                            {{ $umkm->business_address }}
                        </p>

                        {{-- Tombol Profil --}}
                        <a href="{{ route('business.profile', $umkm->id) }}"
                            class="w-full inline-block bg-green-50 hover:bg-green-600 hover:text-white text-green-700 py-2.5 rounded-lg text-sm font-semibold transition-all text-center">
                            Buka Profil
                        </a>
                    </div>

                @empty
                    <div class="col-span-6 text-center py-12 bg-white rounded-xl border border-dashed border-gray-300">
                        <i class="fa-solid fa-store text-4xl text-gray-300 mb-3"></i>
                        <p class="text-gray-500">Belum ada UMKM terdaftar.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </main>
@endsection
