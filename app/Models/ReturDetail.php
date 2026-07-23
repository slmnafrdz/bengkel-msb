<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturDetail extends Model
{
    protected $table = 'return_details';

    protected $fillable = [
        'retur_id',
        'tipe',
        'transaction_detail_id',
        'product_id',
        'qty',
        'harga',
        'subtotal',
    ];

    public function retur()
    {
        return $this->belongsTo(Retur::class, 'retur_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function transactionDetail()
    {
        return $this->belongsTo(TransactionDetail::class);
    }
}
