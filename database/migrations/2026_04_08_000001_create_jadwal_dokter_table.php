<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jadwal_dokter', function (Blueprint $table) {
            $table->id();
            $table->string('cabang', 50);
            $table->string('dokter_nama', 120);
            $table->string('poli', 80);
            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu']);
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->enum('sesi', ['Pagi', 'Siang', 'Sore']);
            $table->unsignedSmallInteger('kuota');
            $table->timestamps();

            $table->index(['dokter_nama', 'hari']);
            $table->index(['cabang', 'hari']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_dokter');
    }
};
