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
        Schema::create('vente_conf', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('article_vente_id');
            $table->unsignedBigInteger('article_conf_id');
            $table->foreign('article_vente_id')->references('id')->on('article_ventes')->onDelete('cascade');
            $table->foreign('article_conf_id')->references('id')->on('articles')->onDelete('cascade');
            $table->integer('quantite')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vente_conf_tables');
    }
};
