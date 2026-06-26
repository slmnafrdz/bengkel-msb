<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->search) {

            $query->where(
                'kode_produk',
                'like',
                '%' . $request->search . '%'
            );
        }

        $products = $query
            ->orderBy('kode_produk', 'asc')
            ->get();

        return view(
            'admin.products.index',
            compact('products')
        );
    }

    public function create()
    {
        $categories = Category::all();

        return view(
            'admin.products.create',
            compact('categories')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'category_id' => 'required|exists:categories,id',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);

        // Ambil produk terakhir
        $lastProduct = Product::latest()->first();

        if ($lastProduct) {

            $lastNumber = (int) substr(
                $lastProduct->kode_produk,
                3
            );

            $newNumber = $lastNumber + 1;
        } else {

            $newNumber = 1;
        }

        $kodeProduk = 'SP-' . str_pad(
            $newNumber,
            4,
            '0',
            STR_PAD_LEFT
        );

        Product::create([
            'kode_produk' => $kodeProduk,
            'nama_produk' => $request->nama_produk,
            'category_id' => $request->category_id,
            'stok' => $request->stok,
            'minimum_stok' => $request->minimum_stok,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
        ]);

        return redirect()
            ->route('products.index')
            ->with(
                'success',
                'Produk berhasil ditambahkan'
            );
    }

    public function edit(Product $product)
    {
        $categories = Category::all();

        return view(
            'admin.products.edit',
            compact(
                'product',
                'categories'
            )
        );
    }

    public function update(
        Request $request,
        Product $product
    ) {
        $product->update($request->all());

        return redirect()
            ->route('products.index');
    }

    public function destroy(Product $product)
    {
        // Cek apakah produk ini pernah masuk ke transaksi
        $isUsedInTransaction = DB::table('transaction_details')
            ->where('product_id', $product->id)
            ->exists();

        if ($isUsedInTransaction) {
            // Jika sudah pernah terjual, jangan hapus — nonaktifkan saja (soft approach)
            // agar histori transaksi tetap valid dan tidak rusak.
            return back()->with(
                'error',
                'Produk "' . $product->nama_produk . '" tidak dapat dihapus karena sudah pernah ada dalam riwayat transaksi. Kosongkan stok jika ingin menonaktifkan produk ini.'
            );
        }

        $product->delete();

        return back()->with('success', 'Produk "' . $product->nama_produk . '" berhasil dihapus.');
    }
}
