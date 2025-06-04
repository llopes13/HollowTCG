<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PedidoItem extends Model
{
    use HasFactory;
    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function card()
    {
        return $this->belongsTo(PokemonCard::class, 'pokemon_card_id');
    }

}
