<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Halaman Lihat Semua Pesanan
    public function index()
    {
        $userId = Auth::id();

        // Ambil semua pesanan dengan pagination
        $orders = Order::where('user_id', $userId)
            ->with('items')
            ->latest()
            ->paginate(10);

        // Statistik pesanan
        $totalOrders = Order::where('user_id', $userId)->count();
        $pendingOrders = Order::where('user_id', $userId)->where('status', 'pending')->count();
        $processingOrders = Order::where('user_id', $userId)->where('status', 'processing')->count();
        $completedOrders = Order::where('user_id', $userId)->where('status', 'completed')->count();

        return view('owner.orders.index', compact('orders', 'totalOrders', 'pendingOrders', 'processingOrders', 'completedOrders'));
    }

    // Halaman POS / Tambah Pesanan
    public function create()
    {
        // Ambil produk aktif milik user
        $products = Product::where('user_id', Auth::id())
            ->where('status', 'active')
            ->where('stock', '>', 0) // Hanya tampilkan yang ada stok
            ->get();

        return view('owner.orders.create', compact('products'));
    }

    // Simpan Pesanan
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string',
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|exists:products,id',
            'items.*.qty' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();

            $totalAmount = 0;

            // 1. Buat Order
            $order = Order::create([
                'user_id' => Auth::id(),
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'total_amount' => 0,
                'tax' => 0,
                'status' => 'pending'
            ]);

            // 2. Proses Item
            foreach ($request->items as $itemData) {
                $product = Product::find($itemData['id']);

                if ($product->stock < $itemData['qty']) {
                    throw new \Exception("Stok produk {$product->name} tidak mencukupi.");
                }

                $subtotal = $product->price * $itemData['qty'];
                $totalAmount += $subtotal;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'quantity' => $itemData['qty'],
                    'price' => $product->price,
                    'subtotal' => $subtotal
                ]);

                $product->decrement('stock', $itemData['qty']);
                $product->increment('sold', $itemData['qty']);
            }

            // 3. Hitung Pajak & Total Akhir
            $tax = $totalAmount * 0.1; // 10% Pajak
            $grandTotal = $totalAmount + $tax;

            $order->update([
                'total_amount' => $grandTotal,
                'tax' => $tax
            ]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Pesanan berhasil disimpan!',
                'redirect_url' => route('owner.dashboard')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    // Update Status
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $order = Order::where('user_id', Auth::id())->findOrFail($id);
        $order->update(['status' => $request->status]);

        return back()->with('success', 'Status pesanan berhasil diperbarui!');
    }

    // [BARU] Cetak Struk
    public function printReceipt($id)
    {
        // Pastikan pesanan milik user yang sedang login
        $order = Order::where('user_id', Auth::id())
            ->with('items') // Load item pesanan
            ->findOrFail($id);

        $user = Auth::user(); // Data pemilik toko untuk header struk

        return view('owner.orders.receipt', compact('order', 'user'));
    }
}
