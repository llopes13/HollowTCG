<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PokemonCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'card_id', 'name', 'image_url', 'price', 'collection_id', 'rarity_id'
    ];

    // Relacionamento com Collection (uma coleção)
    public function collection()
    {
        return $this->belongsTo(Collection::class, 'collection_id');
    }

    // Relacionamento com Rarity (uma raridade)
    public function rarity()
    {
        return $this->belongsTo(Rarity::class, 'rarity_id');
    }
}

