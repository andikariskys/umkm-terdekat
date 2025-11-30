<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();

        // Filter periode (default: bulan ini)
        $period = $request->input('period', 'month');
        $startDate = null;
        $endDate = Carbon::now();

        switch ($period) {
            case 'today':
                $startDate = Carbon::today();
                break;
            case 'week':
                $startDate = Carbon::now()->startOfWeek();
                break;
            case 'month':
                $startDate = Carbon::now()->startOfMonth();
                break;
            case 'year':
                $startDate = Carbon::now()->startOfYear();
                break;
            case 'all':
                $startDate = Carbon::create(2020, 1, 1); // Dari awal data
                break;
            default:
                $startDate = Carbon::now()->startOfMonth();
        }

        // 1. Statistik Penjualan
        $totalRevenue = Order::where('user_id', $userId)
            ->where('status', 'completed')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('total_amount');

        $totalOrders = Order::where('user_id', $userId)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        $completedOrders = Order::where('user_id', $userId)
            ->where('status', 'completed')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        $totalTax = Order::where('user_id', $userId)
            ->where('status', 'completed')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('tax');

        // 2. Produk Terlaris
        $topProducts = OrderItem::join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.user_id', $userId)
            ->where('orders.status', 'completed')
            ->whereBetween('orders.created_at', [$startDate, $endDate])
            ->select(
                'order_items.product_name',
                DB::raw('SUM(order_items.quantity) as total_sold'),
                DB::raw('SUM(order_items.subtotal) as total_revenue')
            )
            ->groupBy('order_items.product_name')
            ->orderBy('total_sold', 'desc')
            ->take(5)
            ->get();

        // 3. Transaksi Terbaru
        $recentTransactions = Order::where('user_id', $userId)
            ->with('items')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->latest()
            ->take(10)
            ->get();

        // 4. Grafik Penjualan (7 hari terakhir untuk semua periode kecuali "today")
        $salesChart = [];
        if ($period == 'today') {
            // Untuk hari ini, tampilkan per jam
            for ($hour = 0; $hour < 24; $hour++) {
                $hourStart = Carbon::today()->addHours($hour);
                $hourEnd = Carbon::today()->addHours($hour + 1);

                $revenue = Order::where('user_id', $userId)
                    ->where('status', 'completed')
                    ->whereBetween('created_at', [$hourStart, $hourEnd])
                    ->sum('total_amount');

                $salesChart[] = [
                    'label' => $hourStart->format('H:00'),
                    'value' => $revenue
                ];
            }
        } else {
            // Untuk periode lain, tampilkan 7 hari terakhir
            for ($i = 6; $i >= 0; $i--) {
                $date = Carbon::now()->subDays($i)->startOfDay();

                $revenue = Order::where('user_id', $userId)
                    ->where('status', 'completed')
                    ->whereDate('created_at', $date)
                    ->sum('total_amount');

                $salesChart[] = [
                    'label' => $date->format('d M'),
                    'value' => $revenue
                ];
            }
        }

        // 5. Status Pesanan
        $orderStatus = [
            'pending' => Order::where('user_id', $userId)
                ->where('status', 'pending')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->count(),
            'processing' => Order::where('user_id', $userId)
                ->where('status', 'processing')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->count(),
            'completed' => $completedOrders,
            'cancelled' => Order::where('user_id', $userId)
                ->where('status', 'cancelled')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->count(),
        ];

        return view('owner.reports.index', compact(
            'totalRevenue',
            'totalOrders',
            'completedOrders',
            'totalTax',
            'topProducts',
            'recentTransactions',
            'salesChart',
            'orderStatus',
            'period',
            'startDate',
            'endDate'
        ));
    }
}
