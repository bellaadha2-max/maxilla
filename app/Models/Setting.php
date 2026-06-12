<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'layanan_medis' => 'array',
        'estimasi_harga' => 'array',
        'estimasi_steps' => 'array',
        'alur_pasien' => 'array',
        'cabang_list' => 'array',
        'hero_checkmarks' => 'array',
    ];
}
