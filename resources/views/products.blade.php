@extends('templates.anonymous')

@section('title', 'Produk')

@section('content')
@use('\Illuminate\Support\Str')
    <main class="py-12">
        <div class="max-w-7xl mx-auto px-6 mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
                <div class="flex items-center space-x-3">
                    <div class="text-green-600 bg-green-50 p-3 rounded-lg">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Lokasi</p>
                        <p class="text-lg font-semibold text-gray-900">Serang, Banten <span
                                class="text-xs text-gray-400">(Ubah lokasi sesuai kebutuhan)</span></p>
                    </div>
                </div>
                <div class="text-sm text-gray-500">
                    Koordinat: <span class="font-medium">-6.1200, 106.1500</span>
                </div>
            </div>

            <form action="all_businesses.php" method="get"
                class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                    <label for="q" class="sr-only">Cari usaha</label>
                    <input id="q" name="q" type="search" placeholder="Cari nama, kategori, atau alamat..."
                        class="w-full sm:flex-1 border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-200" />

                    <select name="category" class="w-full sm:w-48 border border-gray-200 rounded-lg px-3 py-3 bg-white">
                        <option value="">Semua Kategori</option>
                        <option value="F&B">F&B</option>
                        <option value="Retail">Retail</option>
                        <option value="Jasa">Jasa</option>
                    </select>

                    <button type="submit"
                        class="bg-green-600 text-white px-4 py-3 rounded-lg font-semibold hover:bg-green-700 flex items-center justify-center">
                        <i class="fa-solid fa-magnifying-glass mr-2"></i> Cari
                    </button>
                </div>
            </form>
        </div>

        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900">Produk</h2>
                    <p class="text-gray-600">Temukan produk lokal dari pelaku UMKM</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse ($products as $p)
                    <div class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-green-200 transform hover:-translate-y-2">

                        {{-- Gambar Produk --}}
                        <div
                            class="aspect-[4/3] bg-gradient-to-br from-green-50 to-green-100 flex items-center justify-center text-8xl transition-transform duration-300">
                            @if ($p->image)
                                <img src="{{ asset('storage/' . $p->image) }}" alt="{{ $p->name }}"
                                    class="h-full w-full object-cover">
                            @else
                                {{-- Pakai emoji jika tidak ada gambar --}}
                                {{ $p->emoji ?? '🛍️' }}
                            @endif
                        </div>

                        <div class="text-center mb-2 p-5">
                            <span class="text-xs bg-green-100 text-green-700 px-3 py-1 rounded-full">{{ $p->category }}</span>
                            <h4 class="font-semibold text-gray-900 mb-2 text-base">
                                {{ $p->name }}
                            </h4>

                            <p class="text-green-600 font-bold text-lg mb-4">
                                Rp {{ number_format($p->price, 0, ',', '.') }}
                            </p>

                            <div class="text-sm text-gray-500 mb-2">
                                <i class="fa-solid fa-shop"></i> {{ $p->owner_name }}
                            </div>

                            <p class="text-gray-500 text-sm mb-3">
                                {{ Str::limit($p->description, 60, '...') }}
                            </p>

                            <a href="{{ route('product.detail', $p->id) }}"
                                class="w-full inline-block bg-green-600 hover:bg-green-700 text-white py-2.5 rounded-lg text-sm font-semibold transition-all shadow-md hover:shadow-lg text-center">
                                Lihat Detail
                            </a>
                        </div>
                    </div>

                @empty
                    <div class="col-span-3 text-center py-12 bg-white rounded-xl border border-dashed border-gray-300">
                        <i class="fa-solid fa-box-open text-4xl text-gray-300 mb-3"></i>
                        <p class="text-gray-500">Belum ada produk tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </main>
@endsection
