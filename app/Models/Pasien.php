<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = 'pasiens';
    protected $primaryKey = 'id_pasien';

    protected $fillable = [
        'id_user',
        'alamat',
        'jenis_kelamin',
        'tanggal_lahir',
        'riwayat_penyakit',
        'alergi_obat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
