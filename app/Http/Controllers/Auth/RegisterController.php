<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // Validasi form registrasi
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'business_name' => 'required|string|max:255',
            'business_address' => 'required|string|max:500',
            'business_phone' => 'required|string|max:20',
            'business_category' => 'required|string|max:100',
        ]);

        // Transaksi jika nanti ada 2 tabel (lebih aman)
        DB::transaction(function () use ($validated) {
            User::create([
                'name' => $validated['name'],
                'username' => $validated['username'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'owner',
                'business_name' => $validated['business_name'],
                'business_address' => $validated['business_address'],
                'business_phone' => $validated['business_phone'],
                'business_category' => $validated['business_category'],
            ]);
        });

        return redirect()
            ->route('register')
            ->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
