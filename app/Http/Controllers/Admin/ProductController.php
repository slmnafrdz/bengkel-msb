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
            $query->where('kode_produk', 'like', '%' . $request->search . '%')
                  ->orWhere('nama_produk', 'like', '%' . $request->search . '%');
        }

        $products = $query->orderBy('kode_produk', 'asc')->get();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|unique:products,nama_produk',
            'category_id' => 'required|exists:categories,id',
            'harga_beli'  => 'required|numeric|min:0',
            'harga_jual'  => 'required|numeric|min:0',
            'stok'        => 'required|numeric|min:0',
            'minimum_stok'=> 'nullable|numeric|min:0',
        ], [
            'nama_produk.required' => 'Nama produk wajib diisi.',
            'nama_produk.unique'   => 'Nama produk "' . $request->nama_produk . '" sudah terdaftar. Gunakan nama yang berbeda.',
            'category_id.required' => 'Kategori wajib dipilih.',
            'harga_beli.numeric'   => 'Harga beli harus berupa angka.',
            'harga_jual.numeric'   => 'Harga jual harus berupa angka.',
            'stok.numeric'         => 'Stok harus berupa angka.',
        ]);

        $lastProduct = Product::latest()->first();
        $newNumber   = $lastProduct ? ((int) substr($lastProduct->kode_produk, 3)) + 1 : 1;
        $kodeProduk  = 'SP-' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);

        Product::create([
            'kode_produk'  => $kodeProduk,
            'nama_produk'  => $request->nama_produk,
            'category_id'  => $request->category_id,
            'stok'         => $request->stok,
            'minimum_stok' => $request->minimum_stok ?? 5,
            'harga_beli'   => $request->harga_beli,
            'harga_jual'   => $request->harga_jual,
        ]);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            // ignore produk yang sedang diedit (pakai ,id)
            'nama_produk' => 'required|unique:products,nama_produk,' . $product->id,
            'category_id' => 'required|exists:categories,id',
            'harga_beli'  => 'required|numeric|min:0',
            'harga_jual'  => 'required|numeric|min:0',
            'stok'        => 'required|numeric|min:0',
            'minimum_stok'=> 'nullable|numeric|min:0',
        ], [
            'nama_produk.required' => 'Nama produk wajib diisi.',
            'nama_produk.unique'   => 'Nama produk "' . $request->nama_produk . '" sudah digunakan produk lain.',
            'category_id.required' => 'Kategori wajib dipilih.',
        ]);

        $product->update([
            'nama_produk'  => $request->nama_produk,
            'category_id'  => $request->category_id,
            'stok'         => $request->stok,
            'minimum_stok' => $request->minimum_stok ?? 5,
            'harga_beli'   => $request->harga_beli,
            'harga_jual'   => $request->harga_jual,
        ]);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $isUsedInTransaction = DB::table('transaction_details')
            ->where('product_id', $product->id)
            ->exists();

        if ($isUsedInTransaction) {
            return back()->with(
                'error',
                'Produk "' . $product->nama_produk . '" tidak dapat dihapus karena sudah pernah ada dalam riwayat transaksi.'
            );
        }

        $product->delete();
        return back()->with('success', 'Produk "' . $product->nama_produk . '" berhasil dihapus.');
    }
}