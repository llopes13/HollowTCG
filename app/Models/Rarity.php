<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rarity extends Model
{
    use HasFactory;

    // Adicionando 'id' à propriedade $fillable
    protected $fillable = ['id', 'name']; // Adicione os campos necessários aqui

    // Relacionamento com PokemonCard (uma raridade pode ter várias cartas)
    public function cards()
    {
        return $this->hasMany(PokemonCard::class, 'rarity_id');
    }
}

