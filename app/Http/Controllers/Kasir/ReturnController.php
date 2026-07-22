<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Retur;
use App\Models\ReturDetail;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReturnController extends Controller
{
    /**
     * Halaman pencarian nota untuk memulai proses retur.
     */
    public function index()
    {
        $returTerbaru = Retur::with(['transaction', 'user'])
            ->latest()
            ->take(10)
            ->get();

        return view('kasir.retur.index', compact('returTerbaru'));
    }

    /**
     * Cari transaksi berdasarkan No. Nota lalu arahkan ke form retur.
     */
    public function cari(Request $request)
    {
        $request->validate([
            'no_nota' => 'required|string',
        ]);

        $transaction = Transaction::where('no_nota', trim($request->no_nota))->first();

        if (!$transaction) {
            return back()->with('error', 'Nota dengan nomor "' . $request->no_nota . '" tidak ditemukan!');
        }

        return redirect()->route('retur.create', $transaction->id);
    }

    /**
     * Form proses retur untuk sebuah transaksi.
     */
    public function create($transactionId)
    {
        $transaction = Transaction::with(['details.product', 'user'])->find($transactionId);

        if (!$transaction) {
            return redirect()->route('retur.index')->with('error', 'Transaksi tidak ditemukan!');
        }

        // Hanya tampilkan item yang masih memiliki sisa qty yang bisa diretur
        $details = $transaction->details;

        // Produk lain untuk opsi tukar barang
        $products = Product::where('stok', '>', 0)
            ->orderBy('nama_produk', 'asc')
            ->get();

        $adaSisaBisaDiretur = $details->contains(function ($d) {
            return $d->sisa_bisa_diretur > 0;
        });

        return view('kasir.retur.create', compact('transaction', 'details', 'products', 'adaSisaBisaDiretur'));
    }

    /**
     * Simpan proses retur (baik tukar barang maupun retur uang cash).
     */
    public function store(Request $request, $transactionId)
    {
        $transaction = Transaction::with('details.product')->find($transactionId);

        if (!$transaction) {
            return back()->with('error', 'Transaksi tidak ditemukan!');
        }

        $request->validate([
            'jenis_retur'      => 'required|in:tukar_barang,uang_cash',
            'alasan'           => 'required|string|max:255',
            'catatan'          => 'nullable|string|max:1000',
            'retur_items'      => 'required|array',
            'pengganti_produk' => 'nullable|array',
            'pengganti_qty'    => 'nullable|array',
        ]);

        // ==========================================
        // 1. VALIDASI & SIAPKAN ITEM YANG DIRETUR
        // ==========================================
        $itemsRetur = [];
        $totalBarangRetur = 0;

        foreach ($request->retur_items as $transactionDetailId => $qtyRetur) {
            $qtyRetur = (int) $qtyRetur;

            if ($qtyRetur <= 0) {
                continue;
            }

            $detail = $transaction->details->firstWhere('id', (int) $transactionDetailId);

            if (!$detail) {
                return back()->withInput()->with('error', 'Item transaksi tidak valid!');
            }

            if ($qtyRetur > $detail->sisa_bisa_diretur) {
                return back()->withInput()->with(
                    'error',
                    'Qty retur untuk "' . $detail->product->nama_produk . '" melebihi sisa yang bisa diretur (maks ' . $detail->sisa_bisa_diretur . ').'
                );
            }

            $subtotal = $detail->harga * $qtyRetur;
            $totalBarangRetur += $subtotal;

            $itemsRetur[] = [
                'transaction_detail_id' => $detail->id,
                'product_id'            => $detail->product_id,
                'qty'                   => $qtyRetur,
                'harga'                 => $detail->harga,
                'subtotal'              => $subtotal,
            ];
        }

        if (empty($itemsRetur)) {
            return back()->withInput()->with('error', 'Pilih minimal 1 barang beserta jumlah yang ingin diretur!');
        }

        // ==========================================
        // 2. SIAPKAN ITEM PENGGANTI (JIKA TUKAR BARANG)
        // ==========================================
        $itemsPengganti = [];
        $totalBarangPengganti = 0;

        if ($request->jenis_retur === 'tukar_barang') {
            $produkPengganti = $request->pengganti_produk ?? [];
            $qtyPengganti = $request->pengganti_qty ?? [];

            foreach ($produkPengganti as $index => $productId) {
                $qty = (int) ($qtyPengganti[$index] ?? 0);

                if (!$productId || $qty <= 0) {
                    continue;
                }

                $product = Product::find($productId);

                if (!$product) {
                    return back()->withInput()->with('error', 'Produk pengganti tidak ditemukan!');
                }

                if ($qty > $product->stok) {
                    return back()->withInput()->with('error', 'Stok "' . $product->nama_produk . '" tidak mencukupi untuk barang pengganti!');
                }

                $subtotal = $product->harga_jual * $qty;
                $totalBarangPengganti += $subtotal;

                $itemsPengganti[] = [
                    'product_id' => $product->id,
                    'qty'        => $qty,
                    'harga'      => $product->harga_jual,
                    'subtotal'   => $subtotal,
                ];
            }

            if (empty($itemsPengganti)) {
                return back()->withInput()->with('error', 'Pilih minimal 1 barang pengganti untuk proses tukar barang!');
            }
        }

        $selisih = $totalBarangPengganti - $totalBarangRetur;
        $noRetur = 'RTR-' . date('YmdHis');

        // ==========================================
        // 3. SIMPAN KE DATABASE (DALAM 1 TRANSACTION)
        // ==========================================
        DB::transaction(function () use (
            $transaction,
            $request,
            $itemsRetur,
            $itemsPengganti,
            $totalBarangRetur,
            $totalBarangPengganti,
            $selisih,
            $noRetur
        ) {
            $returId = DB::table('returns')->insertGetId([
                'no_retur'               => $noRetur,
                'transaction_id'         => $transaction->id,
                'user_id'                => Auth::id(),
                'jenis_retur'            => $request->jenis_retur,
                'alasan'                 => $request->alasan,
                'catatan'                => $request->catatan,
                'total_barang_retur'     => $totalBarangRetur,
                'total_barang_pengganti' => $totalBarangPengganti,
                'selisih'                => $selisih,
                'status'                 => 'selesai',
                'created_at'             => now(),
                'updated_at'             => now(),
            ]);

            // Barang yang dikembalikan pelanggan -> stok bertambah kembali,
            // kecuali alasannya barang cacat/rusak (tidak layak dijual lagi).
            $barangLayakDijualLagi = $request->alasan !== 'Barang Cacat/Rusak';

            foreach ($itemsRetur as $item) {
                DB::table('return_details')->insert([
                    'retur_id'               => $returId,
                    'tipe'                   => 'dikembalikan',
                    'transaction_detail_id'  => $item['transaction_detail_id'],
                    'product_id'             => $item['product_id'],
                    'qty'                    => $item['qty'],
                    'harga'                  => $item['harga'],
                    'subtotal'               => $item['subtotal'],
                    'created_at'             => now(),
                    'updated_at'             => now(),
                ]);

                if ($barangLayakDijualLagi) {
                    Product::where('id', $item['product_id'])->increment('stok', $item['qty']);
                }
            }

            // Barang pengganti yang diberikan ke pelanggan -> stok berkurang
            foreach ($itemsPengganti as $item) {
                DB::table('return_details')->insert([
                    'retur_id'               => $returId,
                    'tipe'                   => 'pengganti',
                    'transaction_detail_id'  => null,
                    'product_id'             => $item['product_id'],
                    'qty'                    => $item['qty'],
                    'harga'                  => $item['harga'],
                    'subtotal'               => $item['subtotal'],
                    'created_at'             => now(),
                    'updated_at'             => now(),
                ]);

                Product::where('id', $item['product_id'])->decrement('stok', $item['qty']);
            }
        });

        $pesan = 'Retur berhasil diproses. No. Retur: ' . $noRetur . '. ';

        if ($request->jenis_retur === 'uang_cash') {
            $pesan .= 'Uang yang dikembalikan ke pelanggan: Rp ' . number_format($totalBarangRetur, 0, ',', '.');
        } else {
            if ($selisih > 0) {
                $pesan .= 'Pelanggan perlu menambah bayar: Rp ' . number_format($selisih, 0, ',', '.');
            } elseif ($selisih < 0) {
                $pesan .= 'Uang kembali ke pelanggan: Rp ' . number_format(abs($selisih), 0, ',', '.');
            } else {
                $pesan .= 'Nilai barang pengganti sama dengan barang yang diretur (impas).';
            }
        }

        return redirect()->route('retur.show', $noRetur)->with('success', $pesan);
    }

    /**
     * Riwayat semua retur yang pernah diproses.
     */
    public function history()
    {
        $returs = DB::table('returns')
            ->join('users', 'returns.user_id', '=', 'users.id')
            ->join('transactions', 'returns.transaction_id', '=', 'transactions.id')
            ->select(
                'returns.*',
                'users.name as nama_kasir',
                'transactions.no_nota'
            )
            ->orderBy('returns.created_at', 'desc')
            ->get();

        return view('kasir.retur.history', compact('returs'));
    }

    /**
     * Nota detail retur (bisa dicetak).
     */
    public function show($noRetur)
    {
        $retur = Retur::with(['transaction', 'user', 'details.product'])
            ->where('no_retur', $noRetur)
            ->orWhere('id', $noRetur)
            ->first();

        if (!$retur) {
            return redirect()->route('retur.history')->with('error', 'Data retur tidak ditemukan!');
        }

        return view('kasir.retur.detail', compact('retur'));
    }
}
