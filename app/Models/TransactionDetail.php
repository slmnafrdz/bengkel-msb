<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $fillable = [
        'transaction_id',
        'product_id',
        'qty',
        'harga',
        'subtotal'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }


    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function returDetails()
    {
        return $this->hasMany(ReturDetail::class, 'transaction_detail_id');
    }

    /**
     * Total qty item ini yang sudah pernah diretur (dikembalikan) sebelumnya.
     */
    public function getQtySudahDireturAttribute()
    {
        return (int) $this->returDetails()->where('tipe', 'dikembalikan')->sum('qty');
    }

    /**
     * Sisa qty yang masih boleh diretur untuk item ini.
     */
    public function getSisaBisaDireturAttribute()
    {
        return max(0, $this->qty - $this->qty_sudah_diretur);
    }
}
