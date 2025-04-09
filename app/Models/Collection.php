<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    // Adicionando 'id' à propriedade $fillable
    protected $fillable = ['id', 'name'];  // Adicione os outros campos conforme necessário

    // Relacionamento com PokemonCard (uma coleção pode ter várias cartas)
    public function cards()
    {
        return $this->hasMany(PokemonCard::class, 'collection_id');
    }
}


