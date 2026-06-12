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
        Schema::table('settings', function (Blueprint $table) {
            $table->string('hero_badge')->nullable();
            $table->text('hero_subheadline')->nullable();
            $table->string('solusi_badge')->nullable();
            $table->string('solusi_judul')->nullable();
            $table->text('solusi_deskripsi')->nullable();
            $table->string('estimasi_badge')->nullable();
            $table->string('estimasi_judul')->nullable();
            $table->text('estimasi_deskripsi')->nullable();
            $table->string('alur_judul')->nullable();
            $table->text('alur_deskripsi')->nullable();
            $table->string('cabang_judul')->nullable();
            $table->text('footer_deskripsi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'hero_badge', 'hero_subheadline',
                'solusi_badge', 'solusi_judul', 'solusi_deskripsi',
                'estimasi_badge', 'estimasi_judul', 'estimasi_deskripsi',
                'alur_judul', 'alur_deskripsi',
                'cabang_judul', 'footer_deskripsi'
            ]);
        });
    }
};
