<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Owner\OrderController;
use App\Http\Controllers\Owner\ProductController;
use App\Http\Controllers\Owner\ProfileController;
use App\Http\Controllers\Owner\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\VisitorController;

// Halaman Pengunjung
Route::get('/', [VisitorController::class, 'index'])->name('home');
Route::get('/business', [VisitorController::class, 'business'])->name('business');
Route::get('/business-profile/{id}', [VisitorController::class, 'business_profile'])->name('business.profile');
Route::get('/products', [VisitorController::class, 'products'])->name('products');
Route::get('/detail-product/{id}', [VisitorController::class, 'detail_product'])->name('product.detail');
Route::get('/contact', [VisitorController::class, 'contact'])->name('contact');

// ===== AUTHENTICATION ROUTES =====
// Login
Route::get('/auth/login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::post('/auth/login', [AuthenticatedSessionController::class, 'store'])
    ->name('login.store');

// Register
Route::get('/auth/register', [RegisterController::class, 'index'])->name('register');

Route::post('/auth/register', [RegisterController::class, 'store'])->name('register.store');

// Logout (harus login)
Route::middleware('auth')->group(function () {
    Route::post('/auth/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

// ===== OWNER/PEMILIK ROUTES (Harus Login + Role Owner) =====
Route::prefix('owner')->middleware(['auth', 'role:owner'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('owner.dashboard');

    // Kelola Produk
    Route::get('/produk', function () {
        return view('owner.produk');
    })->name('owner.produk');

    Route::get('/produk/tambah', [ProductController::class, 'create'])->name('owner.produk.create'); // Form
    Route::post('/produk/tambah', [ProductController::class, 'store'])->name('owner.produk.store');   // Action Simpan

    Route::get('/produk/{id}/edit', [ProductController::class, 'edit'])->name('owner.produk.edit');
    Route::put('/produk/{id}', [ProductController::class, 'update'])->name('owner.produk.update');
    Route::delete('/produk/{id}', [ProductController::class, 'destroy'])->name('owner.produk.destroy');

    // Pesanan/POS
    Route::get('/pesanan/tambah', [OrderController::class, 'create'])->name('owner.pesanan.create');
    Route::post('/pesanan/simpan', [OrderController::class, 'store'])->name('owner.pesanan.store');
    Route::patch('/pesanan/{id}/status', [OrderController::class, 'updateStatus'])->name('owner.pesanan.update-status');
    Route::get('/pesanan/{id}/struk', [OrderController::class, 'printReceipt'])->name('owner.pesanan.print');

    // Profil Usaha
    Route::get('/profil', [ProfileController::class, 'edit'])->name('owner.profil');
    Route::put('/profil', [ProfileController::class, 'update'])->name('owner.profil.update');

    // Laporan
    Route::get('/laporan', function () {
        return view('owner.laporan');
    })->name('owner.laporan');
});

// ===== ADMIN ROUTES (Harus Login + Role Admin) =====
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});
