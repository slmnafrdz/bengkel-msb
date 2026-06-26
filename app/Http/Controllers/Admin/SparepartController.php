<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SparepartController extends Controller
{
   public function index(Request $request)
{
    $query = Product::with('category');

    if ($request->search) {
        $query->where('kode_produk', 'like', '%' . $request->search . '%')
               ->orWhere('nama_produk', 'like', '%' . $request->search . '%');
    }

    if ($request->status == 'habis') {
        $query->where('stok', 0);
    }

    if ($request->status == 'menipis') {
        $query->whereColumn('stok', '<=', 'minimum_stok');
    }

    if ($request->status == 'tersedia') {
        $query->where('stok', '>', 0);
    }

    // Ambil data produk
    $spareparts = $query->orderBy('kode_produk', 'asc')->paginate(20);

    // DETEKSI KASIR: Jika role yang login kasir, oper ke view kasir
    if (Auth::user()->role === 'kasir') {
        return view('kasir.spareparts.index', compact('spareparts'));
    }

    // Jika admin tetap di halaman admin asli
    return view('admin.spareparts.index', compact('spareparts'));
}
}