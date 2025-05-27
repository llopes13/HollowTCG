<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PokemonCard extends Model
{
    protected $fillable = ['card_id', 'name', 'image_url', 'price', 'collection_id', 'rarity_id'];

    public function collection()
    {
        return $this->belongsTo(\App\Models\Collection::class);
    }

    public function rarity()
    {
        return $this->belongsTo(\App\Models\Rarity::class);
    }
}
