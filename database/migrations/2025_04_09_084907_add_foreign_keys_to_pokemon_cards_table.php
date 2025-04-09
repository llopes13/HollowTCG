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
        Schema::table('pokemon_cards', function (Blueprint $table) {
            // Adiciona apenas as chaves estrangeiras
            $table->foreign('collection_id')->references('id')->on('collections')->onDelete('set null');
            $table->foreign('rarity_id')->references('id')->on('rarities')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('pokemon_cards', function (Blueprint $table) {
            $table->dropForeign(['collection_id']);
            $table->dropForeign(['rarity_id']);
        });
    }


};
