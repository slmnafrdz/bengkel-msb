<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil semua produk untuk pilihan di dropdown select
        $products = Product::where('stok', '>', 0)
            ->orderBy('nama_produk', 'asc')
            ->get();

        // 2. Definisikan semua variabel dengan nilai default agar Blade tidak Error Undefined
        $selected_product_id = $request->product_id;
        $qty = $request->qty ?? 1;
        $bayar = $request->bayar ?? 0;

        $selected_product = null;
        $total_harga = 0;
        $kembalian = 0;

        // 3. Proses perhitungan jika produk sudah dipilih oleh kasir
        // ... potongan kode di dalam public function index() ...
        if ($selected_product_id) {
            $selected_product = Product::find($selected_product_id);
            if ($selected_product) {
                if ($qty > $selected_product->stok) {
                    $qty = $selected_product->stok;
                }

                // 🟢 JIKA DI DATABASE NAMANYA harga_jual, UBAH SEPERTI INI:
                $total_harga = $selected_product->harga_jual * $qty;

                $kembalian = $bayar > 0 ? ($bayar - $total_harga) : 0;
            }
        }

        // 4. Kirimkan SEMUA variabel ke view (Pastikan 'qty' dan 'selected_product_id' ada di sini)
        return view('kasir.transaksi.index', compact(
            'products',
            'selected_product_id',
            'qty',
            'bayar',
            'selected_product',
            'total_harga',
            'kembalian'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bayar' => 'required|numeric|min:1'
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Keranjang masih kosong!');
        }

        $total_harga = 0;

        foreach ($cart as $item) {
            $product = Product::find($item['id']);

            if (!$product) {
                return back()->with('error', 'Produk tidak ditemukan!');
            }

            if ($product->stok < $item['qty']) {
                return back()->with('error', 'Stok ' . $product->nama_produk . ' tidak mencukupi!');
            }

            $total_harga += ($item['harga'] * $item['qty']);
        }

        if ($request->bayar < $total_harga) {
            return back()->with('error', 'Uang pembayaran kurang!');
        }

        $kembalian = $request->bayar - $total_harga;
        $no_nota = 'NOTA-' . date('YmdHis');

        DB::transaction(function () use ($cart, $request, $total_harga, $kembalian, $no_nota) {

            $transactionId = DB::table('transactions')
                ->insertGetId([
                    'no_nota'     => $no_nota,
                    'user_id'     => Auth::id(),
                    'total'       => $total_harga,
                    'bayar'       => $request->bayar,
                    'kembalian'   => $kembalian,
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]);

            foreach ($cart as $item) {
                $product = Product::find($item['id']);

                DB::table('transaction_details')
                    ->insert([
                        'transaction_id' => $transactionId,
                        'product_id'     => $product->id,
                        'qty'            => $item['qty'],
                        'harga'          => $product->harga_jual,
                        'subtotal'       => $product->harga_jual * $item['qty'],
                        'created_at'     => now(),
                        'updated_at'     => now(),
                    ]);

                // Kurangi stok di database
                $product->decrement('stok', $item['qty']);

                return back()->with('success', 'Transaksi berhasil disimpan! No Nota: ' . $no_nota);
            }
        }); // Batas akhir DB::transaction

        // ========================================================
        // PROSES PEMBERSIHAN KERANJANG (DI SINI KUNCI PERBAIKANNYA)
        // ========================================================
        session()->forget('cart');

        // Menggunakan back() jauh lebih aman untuk menghindari putaran redirect (loop)
        return back()->with(
            'success',
            'Transaksi berhasil disimpan. No Nota: ' . $no_nota .
                ' | Kembalian: Rp ' . number_format($kembalian, 0, ',', '.')
        );

        if ($request->bayar < $total_harga) {
            // Gunakan with('error', '...') untuk mengirim pesan kesalahan
            return back()->with('error', 'Uang pembayaran kurang! Total: Rp ' . number_format($total_harga, 0, ',', '.'));
        }
    }

    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->input('product_id')); // ← pakai input()

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['qty']++;
        } else {
            $cart[$product->id] = [
                'id'    => $product->id,
                'nama'  => $product->nama_produk,
                'harga' => $product->harga_jual,
                'qty'   => 1
            ];
        }

        session()->put('cart', $cart);

        return response()->json(['success' => true]); // ← return JSON, bukan back()
    }

    public function removeFromCart(Request $request)
    {
        // Ambil dari JSON body (karena dikirim via fetch POST dengan Content-Type: application/json)
        $productId = $request->input('product_id'); // ← GANTI INI

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }
        return response()->json([
            'success' => true,
            'message' => 'Produk telah dihapus dari keranjang.'
        ]);
    }

    // ==========================================
    // TAMBAHKAN METHOD DI BAWAH INI
    // ==========================================

    /**
     * Menampilkan semua daftar riwayat transaksi (Lihat Semua)
     */
    public function history()
    {
        // Mengambil semua data transaksi dari database, diurutkan dari yang terbaru
        $transactions = DB::table('transactions')
            ->join('users', 'transactions.user_id', '=', 'users.id')
            ->select('transactions.*', 'users.name as nama_kasir')
            ->orderBy('transactions.created_at', 'desc')
            ->get();

        // Mengembalikan ke view riwayat Anda
        // Pastikan Anda sudah membuat file: resources/views/kasir/riwayat/index.blade.php (atau sesuaikan jalurnya)
        return view('kasir.transaksi.history', compact('transactions'));
    }

    /**
     * Menampilkan detail dari satu transaksi berdasarkan ID (Tombol Detail)
     */
    public function show($id)
    {
        // Ambil data induk transaksi
        $transaction = DB::table('transactions')
            ->join('users', 'transactions.user_id', '=', 'users.id')
            ->select('transactions.*', 'users.name as nama_kasir')
            ->where('transactions.id', $id)
            ->first();

        // Jika transaksi tidak ditemukan, balikkan dengan error
        if (!$transaction) {
            return redirect()->route('transaksi.history')->with('error', 'Transaksi tidak ditemukan!');
        }

        // Ambil semua item produk yang ada di dalam transaksi tersebut
        $details = DB::table('transaction_details')
            ->join('products', 'transaction_details.product_id', '=', 'products.id')
            ->select('transaction_details.*', 'products.nama_produk', 'products.kode_produk')
            ->where('transaction_details.transaction_id', $id)
            ->get();

        // Mengembalikan ke view detail riwayat Anda
        // Pastikan Anda sudah membuat file: resources/views/kasir/riwayat/show.blade.php (atau sesuaikan jalurnya)
        return view('kasir.transaksi.detail', compact('transaction', 'details'));
    }



    /**
     * 1. Detail Kotak: TRX Hari Ini
     */
    public function trxHariIni()
    {
        // Mengambil daftar transaksi khusus hari ini saja
        $transactions = DB::table('transactions')
            ->join('users', 'transactions.user_id', '=', 'users.id')
            ->select('transactions.*', 'users.name as nama_kasir')
            ->whereDate('transactions.created_at', Carbon::today())
            ->orderBy('transactions.created_at', 'desc')
            ->get();

        return view('kasir.transaksi.detail_trx_hari_ini', compact('transactions'));
    }

    /**
     * 2. Detail Kotak: Omset Hari Ini
     */
    public function omsetHariIni()
    {
        // Mengambil riwayat transaksi hari ini beserta total uang masuk
        $transactions = DB::table('transactions')
            ->join('users', 'transactions.user_id', '=', 'users.id')
            ->select('transactions.*', 'users.name as nama_kasir')
            ->whereDate('transactions.created_at', Carbon::today())
            ->orderBy('transactions.created_at', 'desc')
            ->get();

        $totalOmset = $transactions->sum('total');

        return view('kasir.transaksi.detail_omset_hari_ini', compact('transactions', 'totalOmset'));
    }

    /**
     * 3. Detail Kotak: Produk Terjual (Hari Ini / Total)
     */
    public function produkTerjual()
    {
        // Mengambil rincian item produk yang sukses terjual hari ini beserta kuantitasnya
        $items = DB::table('transaction_details')
            ->join('transactions', 'transaction_details.transaction_id', '=', 'transactions.id')
            ->join('products', 'transaction_details.product_id', '=', 'products.id')
            ->select(
                'products.kode_produk',
                'products.nama_produk',
                DB::raw('SUM(transaction_details.qty) as total_qty'),
                'transaction_details.harga',
                DB::raw('SUM(transaction_details.subtotal) as total_pendapatan')
            )
            ->whereDate('transactions.created_at', Carbon::today())
            ->groupBy('product_id', 'products.kode_produk', 'products.nama_produk', 'transaction_details.harga')
            ->orderBy('total_qty', 'desc')
            ->get();

        return view('kasir.transaksi.detail_produk_terjual', compact('items'));
    }
}
