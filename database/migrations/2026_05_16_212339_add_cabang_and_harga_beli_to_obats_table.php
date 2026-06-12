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
        Schema::table('obats', function (Blueprint $table) {
            $table->string('cabang')->nullable()->after('harga');
            $table->integer('harga_beli')->default(0)->after('stok');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('obats', function (Blueprint $table) {
            $table->dropColumn('cabang');
            $table->dropColumn('harga_beli');
        });
    }
};
