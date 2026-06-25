<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'kode_produk',
        'category_id',
        'nama_produk',
        'stok',
        'minimum_stok',
        'harga_beli',
        'harga_jual',
        'gambar'
    ];
    public function category()
    {
        return $this->belongsTo(
            Category::class,
            'category_id'
        );
    }

}
