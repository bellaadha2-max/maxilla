<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $primaryKey = 'id_obat';
    protected $fillable = ['nama_obat', 'stok', 'harga', 'harga_beli', 'cabang'];

    public function resepObats()
    {
        return $this->hasMany(ResepObat::class, 'id_obat', 'id_obat');
    }
}
