@extends('templates.anonymous')

@section('title', 'Dashboard')

@section('content')
    <section id="beranda" class="bg-gradient-to-br from-green-50 via-white to-green-50/30 py-20">
        <div class="max-w-7xl mx-auto px-6 flex flex-col lg:flex-row items-center justify-between gap-16">

            <!-- Left: Hero Image (hidden on mobile) -->
            <div class="hidden lg:flex w-1/2 items-center justify-center">
                <div class="relative">
                    <img src="assets/3d-small-store.png"
                        class="max-h-[420px] w-auto object-contain mx-auto relative z-10 drop-shadow-[0_0_60px_rgba(34,197,94,0.35)] transform-gpu transition-transform hover:scale-[1.02]" />
                </div>
            </div>

            <!-- Right: Hero Text -->
            <div class="w-full lg:w-1/2 text-center lg:text-left">
                <div class="inline-block bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-semibold mb-6">
                    🎉 Platform UMKM Terpercaya
                </div>
                <h2 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                    Temukan <span class="text-green-600">UMKM Terdekat</span> di Sekitar Anda
                </h2>
                <p class="text-gray-600 text-lg md:text-xl mb-8 leading-relaxed">
                    Dukung usaha lokal dan temukan produk berkualitas dari UMKM di sekitar Anda dengan mudah dan cepat.
                </p>

                <!-- CTA Buttons -->
                <div
                    class="flex flex-col sm:flex-row items-center justify-center lg:justify-start space-y-4 sm:space-y-0 sm:space-x-4 mb-8">
                    <a href="{{ route('register') }}"
                        class="bg-green-600 hover:bg-green-700 text-white px-10 py-4 rounded-xl text-lg font-semibold shadow-lg hover:shadow-xl transition transform hover:scale-105 flex items-center space-x-2">
                        <span>Daftar UMKMTerdekat</span>
                        <i class="fa-solid fa-store w-5 h-5"></i>
                    </a>
                    <a href="{{ route('contact') }}"
                        class="border-2 border-green-600 text-green-600 hover:bg-green-50 px-8 py-4 rounded-xl text-lg font-semibold transition">
                        Pelajari Lebih Lanjut
                    </a>
                </div>

                <!-- Stats -->
                <div
                    class="flex flex-col sm:flex-row items-center justify-center lg:justify-start space-y-6 sm:space-y-0 sm:space-x-12 pt-6 border-t border-gray-200">
                    <div class="text-center lg:text-left">
                        <div class="text-3xl font-bold text-green-600">{{ $countUmkm }}</div>
                        <div class="text-gray-600">UMKM Terdaftar</div>
                    </div>
                    <div class="text-center lg:text-left">
                        <div class="text-3xl font-bold text-green-600">{{ $countProducts }}</div>
                        <div class="text-gray-600">Produk & Jasa</div>
                    </div>
                    <div class="text-center lg:text-left">
                        <div class="text-3xl font-bold text-green-600">{{ $countOrdersToday }}</div>
                        <div class="text-gray-600">Transaksi Hari Ini</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Businesses Section -->
    <section id="usaha" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between mb-12 text-center sm:text-left">
                <div>
                    <h3 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">Usaha Terdaftar</h3>
                    <p class="text-gray-600 text-base md:text-lg">Jelajahi berbagai UMKM yang telah bergabung</p>
                </div>
                <a href="{{ route('business') }}"
                    class="text-green-600 hover:text-green-700 font-semibold text-base md:text-lg flex items-center justify-center space-x-2 mt-4 sm:mt-0">
                    <span>Lihat Semua</span><span>→</span>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                @forelse ($umkmList as $umkm)
                    <div
                        class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 p-6 text-center border border-gray-100 hover:border-green-200 transform hover:-translate-y-1">

                        {{-- Foto / Emoji --}}
                        <div
                            class="w-24 h-24 mx-auto mb-4 bg-gradient-to-br from-green-100 to-green-200 rounded-full flex items-center justify-center text-5xl shadow-lg">
                            @if ($umkm->business_photo)
                                <img src="{{ asset('storage/' . $umkm->business_photo) }}" alt="{{ $umkm->business ?? $umkm->name }}"
                                    class="w-full h-full object-cover rounded-full">
                            @else
                                {{ $umkm->emoji ?? '🏪' }}
                            @endif
                        </div>

                        {{-- Kategori --}}
                        <div class="mb-2">
                            <span class="text-xs bg-green-100 text-green-700 px-3 py-1 rounded-full font-medium">
                                {{ $umkm->business_category ?? 'UMKM' }}
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
    </section>

    <!-- Products Section -->
    <section id="produk" class="py-20 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between mb-12 text-center sm:text-left">
                <div>
                    <h3 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">Produk & Jasa Unggulan</h3>
                    <p class="text-gray-600 text-base md:text-lg">
                        Temukan produk dan jasa berkualitas dari UMKM lokal
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @forelse ($products as $p)
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
                                <i class="fa-solid fa-shop"></i> {{ $p->business_name }}
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

            <div class="text-center mt-12">
                <a href="{{ route('products') }}"
                    class="bg-white hover:bg-green-50 text-green-600 border-2 border-green-600 px-10 py-4 rounded-xl font-semibold text-lg transition-all shadow-md hover:shadow-lg">
                    Lihat Produk Lainnya →
                </a>
            </div>
        </div>
    </section>
@endsection
