<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticatedSessionController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Proses login
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cari user berdasarkan username atau email
        $user = User::where('username', $validated['username'])
            ->orWhere('email', $validated['username'])
            ->first();

        // Cek apakah user ada dan password benar
        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return back()->withErrors([
                'username' => 'Username/Email atau password salah!',
            ])->onlyInput('username');
        }

        // Login user
        Auth::login($user, $request->boolean('remember'));
        $request->session()->regenerate();

        // Redirect berdasarkan role
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('owner.dashboard');
    }

    /**
     * Proses logout
     */
    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
