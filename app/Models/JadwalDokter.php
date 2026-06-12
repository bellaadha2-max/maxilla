<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalDokter extends Model
{
    protected $table = 'jadwal_dokter';

    protected $fillable = [
        'cabang',
        'dokter_nama',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'sesi',
        'kuota',
    ];

    /**
     * Accessor for dokter_nama to prevent double titles.
     */
    public function getDokterNamaAttribute($value)
    {
        if (empty($value)) return $value;
        // Remove existing drg./dr. prefix and normalize to 'Drg. '
        $clean = preg_replace('/^(drg\.|dr\.|drg|dr)\s+/i', '', $value);
        return 'Drg. ' . $clean;
    }
}
