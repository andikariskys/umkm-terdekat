<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pemilik - UMKMTerdekat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/js/all.min.js"></script>
    <script>
        function printReceipt(id) {
            var url = "{{ route('owner.pesanan.print', ':id') }}";
            url = url.replace(':id', id);
            
            // Membuka popup window khusus print dengan ukuran struk thermal
            window.open(url, '_blank', 'width=1000,height=600');
        }
    </script>
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
                        <p class="text-xs text-gray-500">Dashboard Pemilik</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <div class="text-right hidden sm:block">
                            <p class="font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->business_name ?? 'Nama Usaha' }}</p>
                        </div>

                        @if(Auth::user()->business_photo)
                        <img src="{{ asset('storage/' . Auth::user()->business_photo) }}" alt="Profile"
                            class="w-10 h-10 rounded-lg object-cover border border-green-100">
                        @else
                        <div class="bg-green-100 p-2 rounded-lg w-10 h-10 flex items-center justify-center">
                            <i class="fa-solid fa-store text-green-600"></i>
                        </div>
                        @endif
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-red-600 hover:bg-red-50 p-2 rounded-lg transition"
                            title="Logout">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Flash Message Success --}}
        @if (session('success'))
        <div
            class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center space-x-2 animate-fade-in-down">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        <div class="bg-gradient-to-r from-green-600 to-green-700 rounded-2xl p-8 mb-8 text-white">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold mb-2">Selamat Datang, {{ explode(' ', Auth::user()->name)[0] }}! 🏪
                    </h2>
                    <p class="text-green-100 mb-4">Kelola usaha <strong>{{ Auth::user()->business_name ?? 'Anda'
                            }}</strong> dengan mudah</p>
                    <a href="{{ route('owner.produk.create') }}"
                        class="bg-white text-green-600 px-6 py-2 rounded-lg font-semibold hover:bg-green-50 transition inline-flex items-center space-x-2">
                        <i class="fa-solid fa-plus mr-2"></i>
                        <span>Tambah Produk Baru</span>
                    </a>
                </div>
                <div class="text-6xl mt-4 md:mt-0 hidden md:block">📊</div>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 mb-8">
            <div class="bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-green-100 p-3 rounded-lg"><i
                            class="fa-solid fa-money-bill-wave text-green-600 text-xl"></i></div>
                    <span class="text-xs text-green-600 font-semibold">Hari Ini</span>
                </div>
                <h3 class="text-2xl font-bold text-gray-900">{{ $salesStats['today'] }}</h3>
                <p class="text-gray-600 text-sm">Pendapatan</p>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-blue-100 p-3 rounded-lg"><i class="fa-solid fa-box text-blue-600 text-xl"></i></div>
                    <span class="text-xs text-blue-600 font-semibold">Total</span>
                </div>
                <h3 class="text-2xl font-bold text-gray-900">{{ $activeProductCount }}</h3>
                <p class="text-gray-600 text-sm">Produk Aktif</p>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-orange-100 p-3 rounded-lg"><i
                            class="fa-solid fa-shopping-cart text-orange-600 text-xl"></i></div>
                    <span class="text-xs text-orange-600 font-semibold">Baru</span>
                </div>
                <h3 class="text-2xl font-bold text-gray-900">{{ $todayOrdersCount }}</h3>
                <p class="text-gray-600 text-sm">Pesanan Masuk (Hari Ini)</p>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-purple-100 p-3 rounded-lg"><i
                            class="fa-solid fa-chart-line text-purple-600 text-xl"></i></div>
                    <span class="text-xs text-purple-600 font-semibold">Bulan Ini</span>
                </div>
                <h3 class="text-2xl font-bold text-gray-900">{{ $salesStats['thisMonth'] }}</h3>
                <p class="text-gray-600 text-sm">Total Penjualan</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-8">

                <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-900">Kelola Produk</h3>
                        <a href="{{ route('owner.produk.create') }}"
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-semibold text-sm transition inline-flex items-center space-x-2">
                            <i class="fa-solid fa-plus"></i>
                            <span>Tambah Produk</span>
                        </a>
                    </div>

                    <div class="w-full overflow-x-auto">
                        <table class="min-w-max w-full border-collapse">
                            <thead class="bg-gray-50 border-b-2 border-gray-200">
                                <tr>
                                    <th
                                        class="px-4 py-3 text-left text-sm font-semibold text-gray-700 whitespace-nowrap">
                                        Produk</th>
                                    <th
                                        class="px-4 py-3 text-left text-sm font-semibold text-gray-700 whitespace-nowrap">
                                        Harga</th>
                                    <th
                                        class="px-4 py-3 text-left text-sm font-semibold text-gray-700 whitespace-nowrap">
                                        Stok</th>
                                    <th
                                        class="px-4 py-3 text-left text-sm font-semibold text-gray-700 whitespace-nowrap">
                                        Terjual</th>
                                    <th
                                        class="px-4 py-3 text-left text-sm font-semibold text-gray-700 whitespace-nowrap">
                                        Status</th>
                                    <th
                                        class="px-4 py-3 text-center text-sm font-semibold text-gray-700 whitespace-nowrap">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($myProducts as $product)
                                <tr class="hover:bg-gray-50 transition whitespace-nowrap">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center space-x-3">
                                            @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}"
                                                class="w-10 h-10 rounded-lg object-cover bg-gray-100"
                                                alt="{{ $product->name }}">
                                            @else
                                            <span class="text-2xl">☕</span>
                                            @endif
                                            <div>
                                                <span class="font-medium text-gray-900 block">{{ $product->name
                                                    }}</span>
                                                <span class="text-xs text-gray-500 capitalize">{{ $product->category
                                                    }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-gray-900 font-semibold">Rp {{
                                        number_format($product->price, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3">
                                        <span
                                            class="{{ $product->stock == 0 ? 'text-red-600 font-bold' : 'text-gray-900' }}">
                                            {{ $product->stock }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-gray-900 text-center">{{ $product->sold }}</td>
                                    <td class="px-4 py-3">
                                        {{-- LOGIKA STATUS --}}
                                        @if($product->stock == 0)
                                        <span
                                            class="text-xs px-2 py-1 rounded-full bg-red-100 text-red-700 font-semibold">
                                            Stok Habis
                                        </span>
                                        @elseif($product->status == 'active')
                                        <span
                                            class="text-xs px-2 py-1 rounded-full bg-green-100 text-green-700 font-semibold">
                                            Aktif
                                        </span>
                                        @else
                                        <span
                                            class="text-xs px-2 py-1 rounded-full bg-gray-100 text-gray-600 font-semibold">
                                            Nonaktif
                                        </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center justify-center space-x-2">
                                            <a href="{{ route('owner.produk.edit', $product->id) }}"
                                                class="text-blue-600 hover:bg-blue-50 p-2 rounded-lg transition"
                                                title="Edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>

                                            <form action="{{ route('owner.produk.destroy', $product->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus produk {{ $product->name }}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:bg-red-50 p-2 rounded-lg transition"
                                                    title="Hapus">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-8 text-center">
                                        <div class="flex flex-col items-center justify-center text-gray-500">
                                            <div class="bg-gray-100 p-4 rounded-full mb-3">
                                                <i class="fa-solid fa-box-open text-4xl text-gray-400"></i>
                                            </div>
                                            <p class="text-lg font-semibold text-gray-700">Belum ada produk</p>
                                            <p class="text-sm mb-4">Toko Anda masih kosong. Yuk, mulai tambahkan produk!
                                            </p>
                                            <a href="{{ route('owner.produk.create') }}"
                                                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                                                <i class="fa-solid fa-plus mr-1"></i> Tambah Produk Pertama
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-900">Pesanan Masuk</h3>
                        <a href="{{ route('owner.pesanan.create') }}"
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-semibold text-sm transition inline-flex items-center space-x-2">
                            <i class="fa-solid fa-plus"></i>
                            <span>Buat Pesanan</span>
                        </a>
                    </div>
                    @if(empty($incomingOrders))
                    <div class="text-center py-8 text-gray-500">
                        <i class="fa-solid fa-clipboard-list text-3xl mb-2 text-gray-300"></i>
                        <p>Belum ada pesanan masuk.</p>
                    </div>
                    @else
                    {{-- Loop Pesanan akan ditempatkan disini nanti --}}

                    <div class="space-y-4">
                        @forelse ($incomingOrders as $order)
                        <div class="border border-gray-200 rounded-lg p-4 hover:border-green-300 transition">
                            <div class="flex items-start justify-between mb-3">
                                <div>
                                    <p class="font-semibold text-gray-900">#{{ $order->id }} - {{ $order->customer_name
                                        }}</p>
                                    <p class="text-sm text-gray-600">
                                        {{ $order->items->first()->product_name ?? 'Item' }}
                                        @if($order->items->count() > 1)
                                        <span class="text-gray-400 text-xs">(+{{ $order->items->count() - 1 }}
                                            lainnya)</span>
                                        @endif
                                    </p>
                                    <p class="text-xs text-gray-400 mt-1">{{ $order->created_at->diffForHumans() }}</p>
                                </div>

                                {{-- LOGIKA BADGE STATUS --}}
                                @if($order->status == 'pending')
                                <span
                                    class="text-xs px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 font-semibold">
                                    <i class="fa-regular fa-clock mr-1"></i> Menunggu
                                </span>
                                @elseif($order->status == 'processing')
                                <span class="text-xs px-3 py-1 rounded-full bg-blue-100 text-blue-700 font-semibold">
                                    <i class="fa-solid fa-spinner fa-spin mr-1"></i> Diproses
                                </span>
                                @elseif($order->status == 'completed')
                                <span class="text-xs px-3 py-1 rounded-full bg-green-100 text-green-700 font-semibold">
                                    <i class="fa-solid fa-check mr-1"></i> Selesai
                                </span>
                                @endif
                            </div>

                            <div class="flex items-center justify-between border-t border-gray-100 pt-3">
                                <span class="text-lg font-bold text-green-600">Rp {{ number_format($order->total_amount,
                                    0, ',', '.') }}</span>

                                {{-- LOGIKA TOMBOL AKSI --}}
                                <div class="flex space-x-2">

                                    @if($order->status == 'pending')
                                    <form action="{{ route('owner.pesanan.update-status', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="processing">
                                        <button type="submit"
                                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-1.5 rounded-lg text-sm font-semibold transition shadow-sm">
                                            <i class="fa-solid fa-fire-burner mr-1"></i> Proses
                                        </button>
                                    </form>

                                    @elseif($order->status == 'processing')
                                    <form action="{{ route('owner.pesanan.update-status', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="completed">
                                        <button type="submit"
                                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-1.5 rounded-lg text-sm font-semibold transition shadow-sm">
                                            <i class="fa-solid fa-check mr-1"></i> Selesai
                                        </button>
                                    </form>

                                    @elseif($order->status == 'completed')
                                    <button onclick="printReceipt({{ $order->id }})"
                                        class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-1.5 rounded-lg text-sm font-semibold transition border border-gray-300">
                                        <i class="fa-solid fa-print mr-1"></i> Cetak Struk
                                    </button>
                                    @endif

                                </div>
                            </div>
                        </div>
                        @empty
                        {{-- EMPTY STATE --}}
                        <div class="text-center py-10">
                            <div
                                class="bg-gray-50 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fa-solid fa-clipboard-list text-2xl text-gray-400"></i>
                            </div>
                            <h4 class="text-gray-900 font-medium mb-1">Belum ada pesanan</h4>
                            <p class="text-gray-500 text-sm mb-4">Pesanan yang masuk akan muncul di sini.</p>
                            <a href="{{ route('owner.pesanan.create') }}"
                                class="text-green-600 font-semibold hover:underline text-sm">
                                Buat Pesanan Sekarang
                            </a>
                        </div>
                        @endforelse
                    </div>

                    @endif
                </div>
            </div>

            <div class="space-y-8">
                <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Profil Usaha</h3>
                    <div class="text-center mb-6">
                        @if(Auth::user()->business_photo)
                        <img src="{{ asset('storage/' . Auth::user()->business_photo) }}" alt="Logo Bisnis"
                            class="w-24 h-24 rounded-full object-cover mx-auto mb-4 border-4 border-green-50 shadow-sm">
                        @else
                        <div
                            class="w-24 h-24 bg-gradient-to-br from-green-100 to-green-200 rounded-full flex items-center justify-center text-5xl mx-auto mb-4">
                            ☕</div>
                        @endif

                        <h4 class="font-bold text-gray-900 text-lg">{{ Auth::user()->business_name ?? 'Nama Bisnis Belum
                            Diisi' }}</h4>
                        <p class="text-sm text-gray-600">{{ Auth::user()->business_category ?? 'Kategori Belum Diatur'
                            }}</p>
                    </div>

                    <div class="space-y-3 mb-6">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-600">Total Produk</span>
                            <span class="font-semibold text-gray-900">{{ count($myProducts) }}</span>
                        </div>
                    </div>

                    <a href="{{ route('owner.profil') }}"
                        class="w-full bg-green-50 hover:bg-green-100 text-green-700 py-2 rounded-lg font-semibold transition inline-block text-center">
                        <i class="fa-solid fa-pen-to-square mr-2"></i>Edit Profil
                    </a>
                </div>

                <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Statistik Cepat</h3>
                    <div class="space-y-4">
                        <div class="p-4 bg-green-50 rounded-lg">
                            <p class="text-sm text-gray-600 mb-1">Minggu Ini</p>
                            {{-- Menggunakan data dari controller. Jika tidak ada transaksi, akan muncul Rp 0 --}}
                            <p class="text-2xl font-bold text-green-600">{{ $salesStats['thisWeek'] }}</p>
                        </div>
                        <div class="p-4 bg-blue-50 rounded-lg">
                            <p class="text-sm text-gray-600 mb-1">Total Pendapatan</p>
                            {{-- Menggunakan data dari controller. Jika tidak ada transaksi, akan muncul Rp 0 --}}
                            <p class="text-2xl font-bold text-blue-600">{{ $salesStats['total'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Aksi Cepat</h3>
                    <div class="space-y-3">
                        <a href="{{ route('owner.produk.create') }}"
                            class="w-full bg-green-50 hover:bg-green-100 text-green-700 py-3 rounded-lg font-semibold transition flex items-center justify-center space-x-2">
                            <i class="fa-solid fa-plus"></i>
                            <span>Tambah Produk</span>
                        </a>
                        <a href="#"
                            class="w-full bg-blue-50 hover:bg-blue-100 text-blue-700 py-3 rounded-lg font-semibold transition flex items-center justify-center space-x-2">
                            <i class="fa-solid fa-chart-line"></i>
                            <span>Lihat Laporan</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>