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
        Schema::table('rekam_medis', function (Blueprint $table) {
            $table->renameColumn('anamnesa', 'subjective');
            $table->renameColumn('diagnosa', 'assesment');
            $table->renameColumn('tindakan', 'planning');
            $table->text('objective')->nullable();
            $table->json('odontogram')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rekam_medis', function (Blueprint $table) {
            $table->renameColumn('subjective', 'anamnesa');
            $table->renameColumn('assesment', 'diagnosa');
            $table->renameColumn('planning', 'tindakan');
            $table->dropColumn('objective');
            $table->dropColumn('odontogram');
        });
    }
};
