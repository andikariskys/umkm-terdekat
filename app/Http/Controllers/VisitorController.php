<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    function index()
    {
        $countUmkm = User::where('role', 'owner')->where('status', 'active')->count();
        $countProducts = Product::join('users', 'products.user_id', '=', 'users.id')
            ->where('users.status', 'active')
            ->count();
        $countOrdersToday = Order::whereDate('created_at', today())
            ->count();
        $umkmList = User::where('role', 'owner')
            ->where('status', 'active')
            ->latest()
            ->take(6)
            ->get();
        $products = Product::join('users', 'products.user_id', '=', 'users.id')
            ->where('users.status', 'active')
            ->select('products.*', 'users.business_name as business_name')
            ->latest('products.created_at')
            ->take(6)
            ->get();

        return view('home', compact('products', 'umkmList', 'countUmkm', 'countProducts', 'countOrdersToday'));
    }

    function business()
    {
        if ($category = request('category')) {
            $umkmList = User::where('role', 'owner')
                ->where('status', 'active')
                ->where('business_category', $category)
                ->latest()
                ->get();
        } else if ($q = request('q')) {
            $umkmList = User::where('role', 'owner')
                ->where('status', 'active')
                ->where(function ($query) use ($q) {
                    $query->where('name', 'like', "%{$q}%")
                        ->orWhere('business_name', 'like', "%{$q}%")
                        ->orWhere('business_category', 'like', "%{$q}%")
                        ->orWhere('business_address', 'like', "%{$q}%");
                })
                ->latest()
                ->get();
        } else {
            $umkmList = User::where('role', 'owner')
                ->where('status', 'active')
                ->latest()
                ->get();
        }
        return view('business', compact('umkmList'));
    }

    function business_profile($id)
    {
        $umkm = User::where('id', $id)
            ->where('status', 'active')
            ->firstOrFail();
        $products = Product::where('user_id', $id)
            ->latest()
            ->get();

        return view('business_profile', compact('umkm', 'products'));
    }

    function products()
    {
        if ($category = request('category')) {
            $products = Product::latest()
                ->join('users', 'products.user_id', '=', 'users.id')
                ->where('users.status', 'active')
                ->where('products.category', $category)
                ->select('products.*', 'users.name as owner_name')
                ->get();
        } else if ($q = request('q')) {
            $products = Product::latest()
                ->join('users', 'products.user_id', '=', 'users.id')
                ->where('users.status', 'active')
                ->where(function ($query) use ($q) {
                    $query->where('products.name', 'like', "%{$q}%")
                        ->orWhere('products.category', 'like', "%{$q}%")
                        ->orWhere('products.description', 'like', "%{$q}%");
                })
                ->select('products.*', 'users.name as owner_name')
                ->get();
        } else {
            $products = Product::latest()
                ->join('users', 'products.user_id', '=', 'users.id')
                ->where('users.status', 'active')
                ->select('products.*', 'users.name as owner_name', 'users.business_name as business_name')
                ->get();
        }

        return view('products', compact('products'));
    }

    function detail_product($id)
    {
        $product = Product::where('products.id', $id)
            ->join('users', 'products.user_id', '=', 'users.id')
            ->where('users.status', 'active')
            ->select('products.*', 'users.name as owner_name', 'users.business_name as business_name', 'users.business_address as address', 'users.business_phone as whatsapp', 'users.business_map as map')
            ->firstOrFail();
        $products = Product::join('users', 'products.user_id', '=', 'users.id')
            ->where('users.status', 'active')
            ->select('products.*')
            ->inRandomOrder()
            ->take(6)
            ->get();

        return view('detail_product', compact('product', 'products'));
    }

    function contact()
    {
        return view('contact');
    }
}
