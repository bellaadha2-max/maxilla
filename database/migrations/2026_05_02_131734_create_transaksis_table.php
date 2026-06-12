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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->unsignedBigInteger('id_reservasi');
            $table->integer('total_tindakan')->default(0);
            $table->integer('total_obat')->default(0);
            $table->integer('total_bayar')->default(0);
            $table->enum('status_pembayaran', ['Belum Lunas', 'Lunas'])->default('Belum Lunas');
            $table->string('metode_pembayaran')->nullable();
            $table->timestamps();

            $table->foreign('id_reservasi')->references('id_reservasi')->on('reservasis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
