<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;
use App\Http\Controllers\Kasir\TransactionController;
use App\Http\Controllers\Kasir\ReturController;
use App\Http\Controllers\Admin\SparepartController;
use App\Http\Controllers\Admin\UserController;

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
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');
        Route::resource('users', UserController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
        Route::resource('spareparts', SparepartController::class);

        // Riwayat Transaksi (Admin)
        Route::get('/riwayat-transaksi', [AdminTransactionController::class, 'index'])
            ->name('transaksi.index');
        Route::get('/riwayat-transaksi/{id}', [AdminTransactionController::class, 'show'])
            ->name('transaksi.show');

        // Laporan Transaksi (Admin)
        Route::get('/laporan-transaksi', [AdminTransactionController::class, 'laporan'])
            ->name('transaksi.laporan');
    });

// ==========================================
// GRUP ROLE: KASIR
// ==========================================
Route::middleware(['role:kasir'])->group(function () {

    Route::get('/kasir/dashboard', [DashboardController::class, 'kasir'])->name('kasir.dashboard');

    // Rute Kasir Utama & Proses Checkout
    Route::get('/transaksi', [TransactionController::class, 'index'])->name('transaksi.index');
    Route::post('/transaksi', [TransactionController::class, 'store'])->name('transaksi.store');

    // Keranjang Belanja
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

    // ==========================================
    // RETUR BARANG (Tukar Barang / Kembali Uang)
    // ==========================================
    Route::get('/retur', [ReturController::class, 'index'])->name('retur.index');
    Route::post('/retur/cari', [ReturController::class, 'cari'])->name('retur.cari');
    Route::get('/retur/riwayat', [ReturController::class, 'history'])->name('retur.history');
    Route::get('/retur/{transaction}/create', [ReturController::class, 'create'])->name('retur.create');
    Route::post('/retur/{transaction}/store', [ReturController::class, 'store'])->name('retur.store');
    Route::get('/retur/nota/{noRetur}', [ReturController::class, 'show'])->name('retur.show');
});