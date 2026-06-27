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
     * Laporan transaksi — rekap per produk dengan filter tanggal
     */
    public function laporan(\Illuminate\Http\Request $request)
    {
        $dari   = $request->get('dari',   now()->startOfMonth()->format('Y-m-d'));
        $sampai = $request->get('sampai', now()->format('Y-m-d'));

        // Rekap per produk dalam rentang tanggal
        $laporanProduk = DB::table('transaction_details')
            ->join('products', 'transaction_details.product_id', '=', 'products.id')
            ->join('transactions', 'transaction_details.transaction_id', '=', 'transactions.id')
            ->whereBetween(DB::raw('DATE(transactions.created_at)'), [$dari, $sampai])
            ->select(
                'products.kode_produk',
                'products.nama_produk',
                'transaction_details.harga as harga_satuan',
                DB::raw('SUM(transaction_details.qty) as total_qty'),
                DB::raw('SUM(transaction_details.subtotal) as total_pendapatan')
            )
            ->groupBy('products.id', 'products.kode_produk', 'products.nama_produk', 'transaction_details.harga')
            ->orderBy('total_pendapatan', 'desc')
            ->get();

        // Ringkasan keseluruhan
        $ringkasan = DB::table('transactions')
            ->whereBetween(DB::raw('DATE(created_at)'), [$dari, $sampai])
            ->selectRaw('COUNT(*) as total_trx, SUM(total) as total_omset')
            ->first();

        // Transaksi per kasir
        $perKasir = DB::table('transactions')
            ->join('users', 'transactions.user_id', '=', 'users.id')
            ->whereBetween(DB::raw('DATE(transactions.created_at)'), [$dari, $sampai])
            ->select('users.name as nama_kasir',
                DB::raw('COUNT(*) as total_trx'),
                DB::raw('SUM(transactions.total) as total_omset'))
            ->groupBy('users.id', 'users.name')
            ->orderBy('total_omset', 'desc')
            ->get();

        return view('admin.transaksi.laporan', compact(
            'laporanProduk', 'ringkasan', 'perKasir', 'dari', 'sampai'
        ));
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