<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Daftar semua riwayat transaksi (untuk admin)
     */
    public function index()
    {
        $transactions = DB::table('transactions')
            ->join('users', 'transactions.user_id', '=', 'users.id')
            ->select('transactions.*', 'users.name as nama_kasir')
            ->orderBy('transactions.created_at', 'desc')
            ->get();

        return view('admin.transaksi.index', compact('transactions'));
    }

    /**
     * Detail satu transaksi berdasarkan ID
     */
    public function show($id)
    {
        $transaction = DB::table('transactions')
            ->join('users', 'transactions.user_id', '=', 'users.id')
            ->select('transactions.*', 'users.name as nama_kasir')
            ->where('transactions.id', $id)
            ->first();

        if (!$transaction) {
            return redirect()->route('admin.transaksi.index')
                ->with('error', 'Transaksi tidak ditemukan!');
        }

        $details = DB::table('transaction_details')
            ->join('products', 'transaction_details.product_id', '=', 'products.id')
            ->select('transaction_details.*', 'products.nama_produk', 'products.kode_produk')
            ->where('transaction_details.transaction_id', $id)
            ->get();

        return view('admin.transaksi.detail', compact('transaction', 'details'));
    }
}