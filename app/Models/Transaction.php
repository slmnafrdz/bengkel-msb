<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'no_nota',
        'user_id',
        'total',
        'bayar',
        'kembalian'
    ];

    public function details()
    {
        return $this->hasMany(
            TransactionDetail::class
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function returs()
    {
        return $this->hasMany(Retur::class);
    }
}