<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    protected $primaryKey = 'id_rekam_medis';
    protected $fillable = ['id_reservasi', 'subjective', 'objective', 'assesment', 'planning', 'biaya_tindakan', 'keterangan', 'odontogram'];

    protected $casts = [
        'odontogram' => 'array',
    ];

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'id_reservasi', 'id_reservasi');
    }

    public function resepObats()
    {
        return $this->hasMany(ResepObat::class, 'id_rekam_medis', 'id_rekam_medis');
    }
}
