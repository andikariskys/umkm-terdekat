<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - UMKMTerdekat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/js/all.min.js"></script>
</head>

<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="bg-green-600 p-2 rounded-xl">
                        <i class="fa-solid fa-store text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-green-700">UMKMTerdekat</h1>
                        <p class="text-xs text-gray-500">Dashboard Admin</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <div class="text-right hidden sm:block">
                            <p class="font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">Administrator</p>
                        </div>
                        <div class="bg-red-100 p-2 rounded-lg">
                            <i class="fa-solid fa-user-shield text-red-600"></i>
                        </div>
                    </div>

                    <!-- LOGOUT BUTTON -->
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
        <!-- Welcome Section -->
        <div class="bg-gradient-to-r from-red-600 to-red-700 rounded-2xl p-8 mb-8 text-white">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold mb-2">Selamat Datang, Admin! 👨‍💼</h2>
                    <p class="text-red-100 mb-4">Kelola seluruh platform UMKMTerdekat dengan mudah</p>
                    <button class="bg-white text-red-600 px-6 py-2 rounded-lg font-semibold hover:bg-red-50 transition">
                        <i class="fa-solid fa-chart-line mr-2"></i>Lihat Laporan Lengkap
                    </button>
                </div>
                <div class="text-6xl mt-4 md:mt-0 hidden md:block">⚙️</div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4 md:gap-6 mb-8">
            <!-- Total UMKM -->
            <div class="bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition">
                <div class="flex items-center justify-center mb-4">
                    <div class="bg-green-100 p-3 rounded-lg"><i class="fa-solid fa-store text-green-600 text-xl"></i>
                    </div>
                </div>
                <h3 class="text-3xl text-center font-bold text-gray-900">{{ $platformStats['totalUMKM'] }}</h3>
                <p class="text-gray-600 text-center text-sm">Total UMKM</p>
            </div>
            <!-- Total Produk -->
            <div class="bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition">
                <div class="flex items-center justify-center mb-4">
                    <div class="bg-blue-100 p-3 rounded-lg"><i class="fa-solid fa-box text-blue-600 text-xl"></i></div>
                </div>
                <h3 class="text-3xl text-center font-bold text-gray-900">{{ $platformStats['totalProducts'] }}</h3>
                <p class="text-gray-600 text-center text-sm">Total Produk</p>
            </div>
            <!-- Total Users -->
            <div class="bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition">
                <div class="flex items-center justify-center mb-4">
                    <div class="bg-purple-100 p-3 rounded-lg"><i class="fa-solid fa-users text-purple-600 text-xl"></i>
                    </div>
                </div>
                <h3 class="text-3xl text-center font-bold text-gray-900">{{ $platformStats['totalUsers'] }}</h3>
                <p class="text-gray-600 text-center text-sm">Total Pengguna</p>
            </div>
            <!-- Total Transaksi -->
            <div class="bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition">
                <div class="flex items-center justify-center mb-4">
                    <div class="bg-orange-100 p-3 rounded-lg"><i
                            class="fa-solid fa-shopping-cart text-orange-600 text-xl"></i></div>
                </div>
                <h3 class="text-3xl text-center font-bold text-gray-900">{{ $platformStats['totalTransactions'] }}</h3>
                <p class="text-gray-600 text-center text-sm">Total Transaksi</p>
            </div>
            <!-- Revenue -->
            <div class="bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition">
                <div class="flex items-center justify-center mb-4">
                    <div class="bg-red-100 p-3 rounded-lg"><i
                            class="fa-solid fa-money-bill-wave text-red-600 text-xl"></i></div>
                </div>
                <h3 class="text-2xl text-center font-bold text-gray-900">{{ $platformStats['revenue'] }}</h3>
                <p class="text-gray-600 text-center text-sm">Total Revenue</p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-8">

                <!-- UMKM Management -->
                <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-900">Kelola UMKM Terdaftar</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b-2 border-gray-200">
                                <tr>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">UMKM</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Pemilik</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Produk</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                                    <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($umkmList as $umkm)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-3">
                                        {{-- Menampilkan nama bisnis atau nama user --}}
                                        <div class="font-medium text-gray-900">{{ $umkm->business ?? $umkm->name }}
                                        </div>
                                        <div class="text-xs text-gray-500">Bergabung: {{ $umkm->created_at->format('d M
                                            Y') }}</div>
                                    </td>
                                    <td class="px-4 py-3 text-gray-700">{{ $umkm->name }}</td>
                                    <td class="px-4 py-3 text-gray-900">{{ $umkm->products_count }}</td>
                                    <td class="px-4 py-3">
                                        <span
                                            class="text-xs px-2 py-1 rounded-full bg-green-100 text-green-700">Aktif</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center justify-center space-x-2">
                                            <button class="text-blue-600 hover:bg-blue-50 p-2 rounded-lg transition"
                                                title="Lihat">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                            <button class="text-red-600 hover:bg-red-50 p-2 rounded-lg transition"
                                                title="Nonaktifkan">
                                                <i class="fa-solid fa-ban"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-6 text-center text-gray-500">Belum ada UMKM
                                        terdaftar.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Transactions -->
                <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Transaksi Terbaru</h3>
                    <div class="space-y-4">
                        @forelse ($recentTransactions as $trx)
                        <div
                            class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                            <div class="flex-1">
                                <p class="font-semibold text-gray-900">#{{ $trx->id }}</p>
                                <p class="text-sm text-gray-600">
                                    {{ $trx->items->first()->product_name ?? 'Produk' }}
                                    <span class="text-xs text-gray-400">({{ $trx->customer_name }})</span>
                                </p>
                                <p class="text-xs text-gray-500">{{ $trx->created_at->format('d M Y H:i') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-gray-900">Rp {{ number_format($trx->total_amount, 0, ',', '.')
                                    }}</p>
                                <span
                                    class="text-xs px-2 py-1 rounded-full {{ $trx->status == 'completed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ ucfirst($trx->status) }}
                                </span>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-4 text-gray-500">Belum ada transaksi.</div>
                        @endforelse
                    </div>
                </div>

                <!-- User Management -->
                <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-900">Kelola Pengguna</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b-2 border-gray-200">
                                <tr>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Nama</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Role</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Email</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Bergabung</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($userList as $usr)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-3 font-medium text-gray-900">{{ $usr->name }}</td>
                                    <td class="px-4 py-3">
                                        <span
                                            class="text-xs px-2 py-1 rounded-full {{ $usr->role === 'owner' ? 'bg-green-100 text-green-700' : ($usr->role === 'admin' ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700') }}">
                                            {{ ucfirst($usr->role) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-gray-700">{{ $usr->email }}</td>
                                    <td class="px-4 py-3 text-gray-600 text-sm">{{ $usr->created_at->format('d M Y') }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4">Belum ada pengguna.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Right Content -->
            <div class="space-y-8">
                <!-- Quick Actions -->
                <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Aksi Cepat</h3>
                    <div class="space-y-3">
                        <button
                            class="w-full bg-green-50 hover:bg-green-100 text-green-700 py-3 rounded-lg font-semibold transition flex items-center justify-center space-x-2">
                            <i class="fa-solid fa-plus"></i>
                            <span>Tambah Admin</span>
                        </button>
                        <button
                            class="w-full bg-blue-50 hover:bg-blue-100 text-blue-700 py-3 rounded-lg font-semibold transition flex items-center justify-center space-x-2">
                            <i class="fa-solid fa-chart-bar"></i>
                            <span>Export Data</span>
                        </button>
                    </div>
                </div>

                <!-- Pending Approvals (Data Hari Ini) -->
                <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Menunggu Persetujuan</h3>
                    <div class="space-y-4">
                        <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-semibold text-gray-900">UMKM Baru (Hari Ini)</span>
                                <span class="text-2xl font-bold text-yellow-600">{{ $pendingApprovals['umkm_new']
                                    }}</span>
                            </div>
                            <button class="text-sm text-yellow-700 hover:text-yellow-800 font-semibold">
                                Lihat Detail →
                            </button>
                        </div>
                        <div class="p-4 bg-blue-50 border border-blue-200 rounded-lg">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-semibold text-gray-900">Produk Baru (Hari Ini)</span>
                                <span class="text-2xl font-bold text-blue-600">{{ $pendingApprovals['product_new']
                                    }}</span>
                            </div>
                            <button class="text-sm text-blue-700 hover:text-blue-800 font-semibold">
                                Lihat Detail →
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>