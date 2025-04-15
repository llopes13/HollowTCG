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
        Schema::create('pokemon_cards', function (Blueprint $table) {
            $table->id();
            $table->string('card_id')->unique();
            $table->string('name');
            $table->string('image_url');
            $table->decimal('price', 8, 2)->nullable();

            $table->string('collection_id')->nullable(); // FK com string
            $table->foreign('collection_id')->references('id')->on('collections')->nullOnDelete();

            $table->unsignedBigInteger('rarity_id')->nullable(); // FK com int
            $table->foreign('rarity_id')->references('id')->on('rarities')->nullOnDelete();

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokemon_cards');
    }
};
