<?php

namespace App\Http\Controllers;

use App\Models\PokemonCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PokemonCardController extends Controller
{
    public function fetchAndStore()
    {
        set_time_limit(120);
        for ($i = 1; $i < 10; $i++) {
        $response = Http::withHeaders([
            'X-Api-Key' => '1f2d482b-ab15-47f8-a444-ef88ec023590'
        ])->get('https://api.pokemontcg.io/v2/cards?page='.$i);

        if ($response->failed()) {
            return response()->json(['error' => 'Error al obtener las cartas'], 500);
        }

        $cards = $response->json()['data'];


        foreach ($cards as $card) {
            $price = $card['cardmarket']['prices']['trendPrice'] ?? $card['tcgplayer']['prices']['holofoil']['market'] ?? $card['tcgplayer']['prices']['normal']['low'] ?? $card['tcgplayer']['prices']['holofoil']['low'] ?? null;

            $rarity = $card['rarity'] ?? 'Desconocida';

            PokemonCard::updateOrCreate(
                ['card_id' => $card['id']],
                [
                    'name' => $card['name'],
                    'image_url' => $card['images']['small'],
                    'rarity' => $rarity,
                    'collections' => $card['set']['id'],
                    'price' => $price
                ]
            );
        }
    }

        return response()->json(['message' => 'Cartas actualizadas']);
    }
    public function index()
{
    $cards = PokemonCard::all();
    return view('seccions.cards', compact('cards')); // Crea una vista Laravel para mostrarlas
}

}
