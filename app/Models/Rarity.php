<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rarity extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name'];

    public function cards()
    {
        return $this->hasMany(PokemonCard::class, 'rarity_id');
    }
}

