@extends('templates.anonymous')
@section('title', $product['name'])
@section('content')
    <main class="py-12">
        <div class="max-w-6xl mx-auto px-6">
            <nav class="text-sm text-gray-500 mb-6">
                <a href="{{ route('home') }}" class="hover:text-green-600">Beranda</a> / <a href="{{ route('products') }}"
                    class="hover:text-green-600">Produk</a> <span class="text-gray-800"> /
                    {{ $product['name'] }}
                </span>
            </nav>

            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6 items-start">
                    <!-- Image -->
                    <div class="md:col-span-1 flex items-center justify-center">
                        @if ($product['image'])
                            <div class="w-full bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-0 text-center">
                                <img src="{{ asset('storage/' . $product['image']) }}" alt="{{ $product['name'] }}"
                                    class="w-full h-[28rem] object-cover rounded-2xl">
                            </div>
                        @else
                            <div class="w-full bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-0 text-center flex items-center justify-center h-[28rem] text-8xl">
                                {{ '🛍️' }}
                            </div>
                        @endif
                    </div>

                    <!-- Info -->
                    <div class="md:col-span-2">
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">
                            {{ $product['name'] }}
                        </h1>
                        <div class="flex items-center justify-between md:justify-start gap-6 mb-4">
                            <div class="text-2xl font-bold text-green-600">
                                {{ $product['price'] }}
                            </div>
                            <div class="text-sm text-gray-500">Stok: <span class="font-semibold text-gray-700">
                                    {{ (int) $product['stock'] }}
                                </span></div>
                        </div>

                        <p class="text-gray-700 mb-6">
                            {{ $product['description'] }}
                        </p>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                            <div>
                                <h4 class="text-sm font-semibold mb-2">Informasi Penjual</h4>
                                <a href="<?= route('business.profile', ['id' => $product['user_id']]) ?>"
                                    class="inline-flex items-center gap-3 w-full sm:w-auto justify-center border-2 border-green-600 text-green-600 hover:bg-green-50 px-4 py-2 rounded-xl text-sm font-semibold transition">
                                    <i class="fa-solid fa-store"></i>
                                    <div class="text-left">
                                        <div class="font-semibold">
                                            {{ $product['business_name'] }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ $product['address'] }}
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4">
                            @php
                                // prepare whatsapp and maps links
                                $phone = preg_replace('/\D+/', '', $product['whatsapp']); // remove any non-digit chars
                                $waText = rawurlencode(
                                    "Halo, saya tertarik dengan produk \"{$product['name']}\". Apakah masih tersedia?",
                                );
                                $waLink = "https://wa.me/{$phone}?text={$waText}";
                                $mapsLink = $product['map'] ?? 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode($product['business_name']);
                            @endphp
                            <a href="{{ $mapsLink }}" target="_blank" rel="noopener noreferrer"
                                class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl text-sm font-semibold transition shadow-md flex items-center gap-2">
                                <i class="fa-solid fa-location-dot"></i> Lihat Rute Ke Penjual
                            </a>

                            <a href="{{ $waLink }}" target="_blank" rel="noopener noreferrer"
                                class="bg-white border-2 border-green-600 text-green-600 hover:bg-green-50 px-6 py-3 rounded-xl text-sm font-semibold transition flex items-center gap-2">
                                <i class="fa-brands fa-whatsapp"></i> Hubungi Penjual via WhatsApp
                            </a>
                        </div>

                        @if ($product['stock'] <= 0)
                            <div class="mt-4 text-sm text-red-600">Stok habis — silakan hubungi penjual untuk ketersediaan.
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Other Products -->
            <section id="produk" class="mt-12">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Produk Lainnya</h2>
                    <a href="{{ route('home') }}#produk" class="text-green-600 hover:underline text-sm">Lihat Semua</a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @forelse ($products as $p)
                    @if ($p['id'] === $product['id']) @continue @endif
                        <div
                            class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-green-200 transform hover:-translate-y-2">

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

                            <div class="p-5">
                                <div class="text-xs text-gray-500 mb-2">
                                    {{ $p->seller_name ?? 'UMKM Lokal' }}
                                </div>

                                <h4 class="font-semibold text-gray-900 mb-2 text-base">
                                    {{ $p->name }}
                                </h4>

                                <p class="text-green-600 font-bold text-xl mb-4">
                                    Rp {{ number_format($p->price, 0, ',', '.') }}
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
            </section>
        </div>
    </main>
@endsection
