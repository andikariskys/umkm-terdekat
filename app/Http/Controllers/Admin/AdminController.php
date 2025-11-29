<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // 1. Statistik Platform
        $revenueRaw = Order::where('status', 'completed')->sum('total_amount');

        $platformStats = [
            'totalUMKM' => User::where('role', 'owner')->count(),
            'totalProducts' => Product::count(),
            'totalUsers' => User::where('role', 'owner')->where('status', 'active')->count(),
            'totalTransactions' => Order::count(),
            'revenue' => 'Rp ' . number_format($revenueRaw, 0, ',', '.')
        ];

        // 2. Daftar UMKM (5 Terbaru)
        // PERBAIKAN: Hapus ->map() agar data tetap berbentuk Object
        $umkmList = User::where('role', 'owner')
            ->withCount('products') // Mengambil jumlah produk otomatis (field: products_count)
            ->latest()
            ->take(5)
            ->get();

        // 3. Transaksi Terbaru (5 Terbaru)
        // PERBAIKAN: Hapus ->map()
        $recentTransactions = Order::with(['items'])
            ->latest()
            ->take(5)
            ->get();

        // 4. Daftar Pengguna Baru (5 Terbaru)
        // PERBAIKAN: Hapus ->map()
        $userList = User::latest()
            ->take(5)
            ->get();

        // 5. Widget Menunggu Persetujuan
        $today = Carbon::today();
        $pendingApprovals = [
            'umkm_new' => User::where('role', 'owner')->whereDate('created_at', $today)->count(),
            'product_new' => Product::whereDate('created_at', $today)->count()
        ];

        return view('admin.dashboard', compact(
            'user',
            'platformStats',
            'umkmList',
            'recentTransactions',
            'userList',
            'pendingApprovals'
        ));
    }

    // Update Status UMKM
    public function updateUmkmStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:active,inactive,pending'
        ]);

        $umkm = User::findOrFail($id);
        // Pastikan kolom 'status' sudah ada di tabel users (via migration)
        $umkm->status = $request->status;
        $umkm->save();

        return back()->with('success', 'Status UMKM berhasil diperbarui!');
    }
}
