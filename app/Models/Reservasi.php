<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    protected $table = 'reservasis';
    protected $primaryKey = 'id_reservasi';

    protected $fillable = [
        'id_user',
        'nama_pasien',
        'jenis_kelamin_pasien',
        'tanggal_lahir_pasien',
        'hubungan',
        'cabang',
        'tanggal',
        'jam',
        'dokter_nama',
        'keluhan',
        'status',
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

    public function getNamaPasienAttribute($value)
    {
        return $value ?: ($this->user->nama ?? null);
    }

    public function getHubunganAttribute($value)
    {
        return $value ?: 'Diri Sendiri';
    }

    public function getJenisKelaminPasienAttribute($value)
    {
        return $value ?: ($this->user->pasien->jenis_kelamin ?? null);
    }

    public function getTanggalLahirPasienAttribute($value)
    {
        return $value ?: ($this->user->pasien->tanggal_lahir ?? null);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function rekamMedis()
    {
        return $this->hasOne(RekamMedis::class, 'id_reservasi', 'id_reservasi');
    }

    public function transaksi()
    {
        return $this->hasOne(Transaksi::class, 'id_reservasi', 'id_reservasi');
    }
}
