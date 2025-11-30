<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $userId = $user->id; // Ubah Auth::id() menjadi $user->id (lebih efisien)
        $today = Carbon::today();
        $startOfMonth = Carbon::now()->startOfMonth();
        $startOfWeek = Carbon::now()->startOfWeek();

        // Data Produk (5 Produk Terbaru untuk Dashboard)
        $myProducts = Product::where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        $activeProductCount = Product::where('user_id', $userId)
            ->where('status', 'active')
            ->count();

        // Data Pesanan (3 Pesanan Terbaru untuk Dashboard)
        $incomingOrders = Order::where('user_id', $userId)
            ->with('items')
            ->latest()
            ->take(3)
            ->get();

        // Hitung Statistik
        $todayRevenue = Order::where('user_id', $userId)->whereDate('created_at', $today)->sum('total_amount');
        $weekRevenue = Order::where('user_id', $userId)->whereBetween('created_at', [$startOfWeek, Carbon::now()])->sum('total_amount');
        $monthRevenue = Order::where('user_id', $userId)->whereBetween('created_at', [$startOfMonth, Carbon::now()])->sum('total_amount');
        $totalRevenue = Order::where('user_id', $userId)->sum('total_amount');

        // Hitung jumlah pesanan hari ini
        $todayOrdersCount = Order::where('user_id', $userId)
            ->whereDate('created_at', $today)
            ->count();

        $salesStats = [
            'today' => 'Rp ' . number_format($todayRevenue, 0, ',', '.'),
            'thisWeek' => 'Rp ' . number_format($weekRevenue, 0, ',', '.'),
            'thisMonth' => 'Rp ' . number_format($monthRevenue, 0, ',', '.'),
            'total' => 'Rp ' . number_format($totalRevenue, 0, ',', '.')
        ];

        return view('owner.dashboard', compact('user', 'myProducts', 'incomingOrders', 'salesStats', 'todayOrdersCount', 'activeProductCount'));
    }
}
