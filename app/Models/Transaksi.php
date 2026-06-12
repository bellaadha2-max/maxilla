<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $primaryKey = 'id_transaksi';
    protected $fillable = [
        'id_reservasi', 
        'total_tindakan', 
        'total_obat', 
        'total_bayar', 
        'jumlah_bayar', 
        'kembalian', 
        'status_pembayaran', 
        'metode_pembayaran'
    ];

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'id_reservasi', 'id_reservasi');
    }
}
