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
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id('id_reservasi');
            $table->unsignedBigInteger('id_user');
            $table->string('cabang');
            $table->date('tanggal');
            $table->string('jam', 20); // Pagi, Siang, Sore
            $table->string('dokter_nama');
            $table->text('keluhan')->nullable();
            $table->enum('status', ['Menunggu', 'Dikonfirmasi', 'Diperiksa', 'Menunggu Obat', 'Menunggu Pembayaran', 'Selesai', 'Dibatalkan'])->default('Menunggu');
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasis');
    }
};
