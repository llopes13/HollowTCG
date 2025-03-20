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
            // Agregar nuevas columnas en la tabla
            $table->string('rarity')->after('image_url'); // Agrega la columna 'rarity' después de 'id'
            $table->string('collections')->after('rarity'); // Agrega la columna 'collections' después de 'rarity'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pokemon_cards', function (Blueprint $table) {
            // Eliminar las columnas agregadas
            $table->dropColumn(['rarity', 'collections']);
        });
    }
};
