<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResepObat extends Model
{
    protected $primaryKey = 'id_resep';
    protected $fillable = ['id_rekam_medis', 'id_obat', 'jumlah', 'aturan_pakai'];

    public function rekamMedis()
    {
        return $this->belongsTo(RekamMedis::class, 'id_rekam_medis', 'id_rekam_medis');
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'id_obat', 'id_obat');
    }
}
