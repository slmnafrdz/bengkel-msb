<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();

        if ($request->search) {
            $query->where('kode_kategori', 'like', '%' . $request->search . '%')
                  ->orWhere('nama_kategori', 'like', '%' . $request->search . '%');
        }

        $categories = $query->orderBy('kode_kategori')->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|unique:categories,nama_kategori',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique'   => 'Nama kategori "' . $request->nama_kategori . '" sudah terdaftar. Gunakan nama yang berbeda.',
        ]);

        $lastCategory = Category::latest()->first();
        $newNumber    = $lastCategory ? ((int) substr($lastCategory->kode_kategori, 4)) + 1 : 1;
        $kodeKategori = 'KAT-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        Category::create([
            'kode_kategori' => $kodeKategori,
            'nama_kategori' => $request->nama_kategori,
            'deskripsi'     => $request->deskripsi,
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'kode_kategori' => 'required|unique:categories,kode_kategori,' . $category->id,
            // ignore kategori yang sedang diedit
            'nama_kategori' => 'required|unique:categories,nama_kategori,' . $category->id,
        ], [
            'kode_kategori.required' => 'Kode kategori wajib diisi.',
            'kode_kategori.unique'   => 'Kode kategori sudah digunakan.',
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique'   => 'Nama kategori "' . $request->nama_kategori . '" sudah digunakan kategori lain.',
        ]);

        $category->update([
            'kode_kategori' => $request->kode_kategori,
            'nama_kategori' => $request->nama_kategori,
            'deskripsi'     => $request->deskripsi,
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success', 'Kategori berhasil dihapus.');
    }
}