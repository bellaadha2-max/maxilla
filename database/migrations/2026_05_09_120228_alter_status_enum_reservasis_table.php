<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Perluas enum status reservasis untuk mendukung alur lengkap:
     * Menunggu → Hadir → Menunggu Antrian → Diperiksa → Menunggu Obat → Menunggu Pembayaran → Selesai
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE reservasis MODIFY COLUMN status ENUM(
            'Menunggu',
            'Dikonfirmasi',
            'Hadir',
            'Menunggu Antrian',
            'Diperiksa',
            'Menunggu Obat',
            'Menunggu Pembayaran',
            'Selesai',
            'Dibatalkan'
        ) NOT NULL DEFAULT 'Menunggu'");
    }

    /**
     * Rollback: kembalikan ke enum sebelumnya.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE reservasis MODIFY COLUMN status ENUM(
            'Menunggu',
            'Dikonfirmasi',
            'Diperiksa',
            'Menunggu Obat',
            'Menunggu Pembayaran',
            'Selesai',
            'Dibatalkan'
        ) NOT NULL DEFAULT 'Menunggu'");
    }
};
