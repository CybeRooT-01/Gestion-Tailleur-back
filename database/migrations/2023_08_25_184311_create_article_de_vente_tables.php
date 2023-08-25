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
        Schema::create('article_vente', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->string('categorie');
            $table->string('reference');
            $table->integer('quantite');
            $table->integer('valeur_promo');
            $table->integer('cout_fabrication');
            $table->integer('prix_vente');
            $table->integer('marge');
            $table->unsignedBigInteger('article_confection_id');
            $table->foreign('article_confection_id')->references('id')->on('articles')->onDelete('cascade');
            $table->integer('quantite_stock')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_vente');
    }
};
