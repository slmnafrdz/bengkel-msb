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

        $categories = $query
            ->orderBy('kode_kategori')
            ->get();

        return view(
            'admin.categories.index',
            compact('categories')
        );
    }


    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required'
        ]);

        $lastCategory = Category::latest()->first();

        if ($lastCategory) {

            $lastNumber = (int) substr(
                $lastCategory->kode_kategori,
                4
            );

            $newNumber = $lastNumber + 1;
        } else {

            $newNumber = 1;
        }

        $kodeKategori = 'KAT-' . str_pad(
            $newNumber,
            3,
            '0',
            STR_PAD_LEFT
        );

        Category::create([
            'kode_kategori' => $kodeKategori,
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()
            ->route('categories.index')
            ->with(
                'success',
                'Kategori berhasil ditambahkan'
            );
    }

    public function edit(Category $category)
    {
        return view(
            'admin.categories.edit',
            compact('category')
        );
    }

    public function update(
        Request $request,
        Category $category
    ) {
        $request->validate([
            'kode_kategori' => 'required',
            'nama_kategori' => 'required'
        ]);

        $category->update([
            'kode_kategori' => $request->kode_kategori,
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()
            ->route('categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return back();
    }
}
