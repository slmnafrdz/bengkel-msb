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

        // Rekap retur per transaksi, agar tiap nota bisa ditandai jika pernah diretur
        $returSummary = DB::table('returns')
            ->select(
                'transaction_id',
                DB::raw('COUNT(*) as jumlah_retur'),
                DB::raw('SUM(total_barang_retur) as total_nilai_retur')
            )
            ->groupBy('transaction_id')
            ->get()
            ->keyBy('transaction_id');

        $transactions->transform(function ($trx) use ($returSummary) {
            $retur = $returSummary->get($trx->id);
            $trx->jumlah_retur = $retur->jumlah_retur ?? 0;
            $trx->total_nilai_retur = $retur->total_nilai_retur ?? 0;
            return $trx;
        });

        return view('admin.transaksi.index', compact('transactions'));
    }

    /**
     * Laporan transaksi — rekap per produk dengan filter tanggal
     * (termasuk rekap barang yang diretur / ditukar / dikembalikan uangnya)
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

        // ==========================================
        // REKAP RETUR / TUKAR BARANG / KEMBALI UANG
        // ==========================================

        // Ringkasan retur keseluruhan dalam rentang tanggal.
        // total_kas_keluar  = uang yang benar-benar dikembalikan tunai ke pelanggan
        //                     (retur uang cash, atau selisih minus pada tukar barang)
        // total_kas_tambahan = uang tambahan yang dibayar pelanggan saat tukar barang
        //                     dengan produk pengganti yang harganya lebih mahal
        $ringkasanRetur = DB::table('returns')
            ->whereBetween(DB::raw('DATE(created_at)'), [$dari, $sampai])
            ->selectRaw('
                COUNT(*) as total_retur,
                COALESCE(SUM(total_barang_retur), 0) as total_nilai_barang_retur,
                COALESCE(SUM(CASE WHEN selisih < 0 THEN ABS(selisih) ELSE 0 END), 0) as total_kas_keluar,
                COALESCE(SUM(CASE WHEN selisih > 0 THEN selisih ELSE 0 END), 0) as total_kas_tambahan,
                COALESCE(SUM(CASE WHEN jenis_retur = "uang_cash" THEN 1 ELSE 0 END), 0) as jumlah_retur_uang,
                COALESCE(SUM(CASE WHEN jenis_retur = "tukar_barang" THEN 1 ELSE 0 END), 0) as jumlah_tukar_barang
            ')
            ->first();

        // Omset bersih = omset kotor - uang yang keluar untuk retur + uang tambahan dari tukar barang
        $omsetBersih = ($ringkasan->total_omset ?? 0)
            - $ringkasanRetur->total_kas_keluar
            + $ringkasanRetur->total_kas_tambahan;

        // Rekap produk yang paling sering diretur/dikembalikan pelanggan
        $laporanReturProduk = DB::table('return_details')
            ->join('returns', 'return_details.retur_id', '=', 'returns.id')
            ->join('products', 'return_details.product_id', '=', 'products.id')
            ->where('return_details.tipe', 'dikembalikan')
            ->whereBetween(DB::raw('DATE(returns.created_at)'), [$dari, $sampai])
            ->select(
                'products.kode_produk',
                'products.nama_produk',
                DB::raw('SUM(return_details.qty) as total_qty_retur'),
                DB::raw('SUM(return_details.subtotal) as total_nilai_retur')
            )
            ->groupBy('products.id', 'products.kode_produk', 'products.nama_produk')
            ->orderBy('total_nilai_retur', 'desc')
            ->get();

        // Daftar transaksi retur dalam rentang tanggal (untuk tabel rincian)
        $daftarRetur = DB::table('returns')
            ->join('users', 'returns.user_id', '=', 'users.id')
            ->join('transactions', 'returns.transaction_id', '=', 'transactions.id')
            ->whereBetween(DB::raw('DATE(returns.created_at)'), [$dari, $sampai])
            ->select(
                'returns.*',
                'users.name as nama_kasir',
                'transactions.no_nota'
            )
            ->orderBy('returns.created_at', 'desc')
            ->get();

        return view('admin.transaksi.laporan', compact(
            'laporanProduk', 'ringkasan', 'perKasir', 'dari', 'sampai',
            'ringkasanRetur', 'omsetBersih', 'laporanReturProduk', 'daftarRetur'
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

        // Riwayat retur/tukar barang untuk transaksi ini (jika ada)
        $returs = DB::table('returns')
            ->join('users', 'returns.user_id', '=', 'users.id')
            ->select('returns.*', 'users.name as nama_kasir_retur')
            ->where('returns.transaction_id', $id)
            ->orderBy('returns.created_at', 'desc')
            ->get();

        foreach ($returs as $retur) {
            $retur->details = DB::table('return_details')
                ->join('products', 'return_details.product_id', '=', 'products.id')
                ->select('return_details.*', 'products.nama_produk')
                ->where('return_details.retur_id', $retur->id)
                ->get();
        }

        return view('admin.transaksi.detail', compact('transaction', 'details', 'returs'));
    }
}
