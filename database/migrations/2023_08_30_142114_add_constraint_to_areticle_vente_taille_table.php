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
        Schema::table('areticle_vente_tailles', function (Blueprint $table) {
            $table->unique(['article_vente_id', 'taille_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('areticle_vente_tailles', function (Blueprint $table) {
            $table->dropUnique(['article_vente_id', 'taille_id']);
        });
    }
};
