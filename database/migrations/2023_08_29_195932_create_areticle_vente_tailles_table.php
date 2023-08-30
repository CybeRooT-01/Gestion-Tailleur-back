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
        Schema::create('areticle_vente_tailles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('taille_id');
            $table->unsignedBigInteger('article_vente_id');
            $table->foreign('article_vente_id')->references('id')->on('article_ventes')->onDelete('cascade');
            $table->foreign('taille_id')->references('id')->on('tailles')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('areticle_vente_tailles');
    }
};
