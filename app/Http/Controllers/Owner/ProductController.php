<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function create()
    {
        $userId = Auth::id();

        // Hitung statistik untuk Quick Stats
        $totalProducts = Product::where('user_id', $userId)->count();
        $activeProducts = Product::where('user_id', $userId)->where('status', 'active')->count();
        $inactiveProducts = Product::where('user_id', $userId)->where('status', 'inactive')->count();

        // Kirim data ke view
        return view('owner.products.create', compact('totalProducts', 'activeProducts', 'inactiveProducts'));
    }

    // ... method store() tetap sama seperti sebelumnya ...
    public function store(Request $request)
    {
        // (Kode validasi dan simpan tetap sama)
        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_category' => 'required|string',
            'product_price' => 'required|numeric|min:0',
            'product_stock' => 'required|integer|min:0',
            'product_description' => 'nullable|string|max:500',
            'product_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('product_image')) {
            $imagePath = $request->file('product_image')->store('products', 'public');
        }

        Product::create([
            'user_id' => Auth::id(),
            'name' => $request->product_name,
            'category' => $request->product_category,
            'price' => $request->product_price,
            'stock' => $request->product_stock,
            'description' => $request->product_description,
            'image' => $imagePath,
            'status' => 'active',
        ]);

        return redirect()->route('owner.dashboard')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $userId = Auth::id();

        // Ambil data produk yang mau diedit
        $product = Product::where('user_id', $userId)->findOrFail($id);

        // === TAMBAHKAN LOGIKA STATISTIK INI (SAMA SEPERTI DI CREATE) ===
        $totalProducts = Product::where('user_id', $userId)->count();
        $activeProducts = Product::where('user_id', $userId)->where('status', 'active')->count();
        $inactiveProducts = Product::where('user_id', $userId)->where('status', 'inactive')->count();

        // Kirim variabel statistik ke view
        return view('owner.products.edit', compact('product', 'totalProducts', 'activeProducts', 'inactiveProducts'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_category' => 'required|string',
            'product_price' => 'required|numeric|min:0',
            'product_stock' => 'required|integer|min:0',
            'product_description' => 'nullable|string|max:500',
            'product_status' => 'required|in:active,inactive', // Status manual
            'product_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'name' => $request->product_name,
            'category' => $request->product_category,
            'price' => $request->product_price,
            'stock' => $request->product_stock,
            'description' => $request->product_description,
            'status' => $request->product_status,
        ];

        // Handle Upload Gambar Baru
        if ($request->hasFile('product_image')) {
            // Hapus gambar lama jika ada
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('product_image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('owner.dashboard')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $product = Product::where('user_id', Auth::id())->findOrFail($id);

        // Hapus gambar dari storage
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return back()->with('success', 'Produk berhasil dihapus!');
    }
}
