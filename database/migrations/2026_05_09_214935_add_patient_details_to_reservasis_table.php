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
        Schema::table('reservasis', function (Blueprint $table) {
            $table->string('nama_pasien')->nullable()->after('id_user');
            $table->enum('jenis_kelamin_pasien', ['Laki-laki', 'Perempuan'])->nullable()->after('nama_pasien');
            $table->date('tanggal_lahir_pasien')->nullable()->after('jenis_kelamin_pasien');
            $table->string('hubungan')->nullable()->after('tanggal_lahir_pasien'); // Hubungan dengan pemilik akun
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservasis', function (Blueprint $table) {
            $table->dropColumn(['nama_pasien', 'jenis_kelamin_pasien', 'tanggal_lahir_pasien', 'hubungan']);
        });
    }
};
