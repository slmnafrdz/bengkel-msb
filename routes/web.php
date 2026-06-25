<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Kasir\TransactionController;
use App\Http\Controllers\Admin\SparepartController;

// ==========================================
// RUTE AUTHENTICATION
// ==========================================
Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// ==========================================
// GRUP ROLE: ADMIN
// ==========================================
Route::middleware(['role:admin'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'admin']);
        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
        Route::resource('spareparts', SparepartController::class);
    });

// ==========================================
// GRUP ROLE: KASIR
// ==========================================
Route::middleware(['role:kasir'])->group(function () {

    Route::get('/kasir/dashboard', [DashboardController::class, 'kasir']);
    
    // Rute Kasir Utama & Proses Checkout (POST)
    Route::get('/transaksi', [TransactionController::class, 'index'])->name('transaksi.index');
    Route::post('/transaksi', [TransactionController::class, 'store'])->name('transaksi.store');

    // Pengelolaan Sesi Keranjang Belanja (Wajib POST & DELETE/POST agar tidak merusak form lain)
    Route::post('/cart/add', [TransactionController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/remove', [TransactionController::class, 'removeFromCart'])->name('cart.remove');

    // Riwayat Transaksi Kasir
    Route::get('/riwayat-transaksi', [TransactionController::class, 'history'])->name('transaksi.history');
    Route::get('/riwayat-transaksi/{id}', [TransactionController::class, 'show'])->name('transaksi.show');
    Route::get('/kasir/spareparts', [SparepartController::class, 'index'])->name('kasir.spareparts.index');

    // Detail Dashboard Kasir
    Route::get('/kasir/detail-trx-hari-ini', [TransactionController::class, 'trxHariIni'])->name('kasir.detail.trx_hari_ini');
    Route::get('/kasir/detail-omset-hari-ini', [TransactionController::class, 'omsetHariIni'])->name('kasir.detail.omset_hari_ini');
    Route::get('/kasir/detail-produk-terjual', [TransactionController::class, 'produkTerjual'])->name('kasir.detail.produk_terjual');
});