<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Retur extends Model
{
    protected $table = 'returns';

    protected $fillable = [
        'no_retur',
        'transaction_id',
        'user_id',
        'jenis_retur',
        'alasan',
        'catatan',
        'total_barang_retur',
        'total_barang_pengganti',
        'selisih',
        'status',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(ReturDetail::class, 'retur_id');
    }

    /**
     * Item barang yang dikembalikan pelanggan.
     */
    public function itemDikembalikan()
    {
        return $this->details()->where('tipe', 'dikembalikan');
    }

    /**
     * Item barang pengganti yang diberikan ke pelanggan (khusus tukar barang).
     */
    public function itemPengganti()
    {
        return $this->details()->where('tipe', 'pengganti');
    }
}
