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
        $countUmkm = User::where('role', 'owner')->count();
        $countProducts = Product::count();
        $countOrdersToday = Order::whereDate('created_at', today())
            ->count();
        $umkmList = User::where('role', 'owner')
            ->latest()
            ->take(6)
            ->get();
        $products = Product::latest()
            ->take(6)
            ->get();

        return view('home', compact('products', 'umkmList', 'countUmkm', 'countProducts', 'countOrdersToday'));
    }

    function business()
    {
        $umkmList = User::where('role', 'owner')
            ->latest()
            ->get();

        return view('business', compact('umkmList'));
    }

    function products() {
        $products = Product::latest()
            ->join('users', 'products.user_id', '=', 'users.id')
            ->select('products.*', 'users.name as owner_name')
            ->get();
        
        return view('products', compact('products'));
    }

    function contact() {
        return view('contact');
    }
}
