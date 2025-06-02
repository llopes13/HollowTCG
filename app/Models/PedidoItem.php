<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoItem extends Model
{
    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function card()
    {
        return $this->belongsTo(PokemonCard::class, 'pokemon_card_id');
    }

}
