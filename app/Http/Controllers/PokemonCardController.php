<?php

namespace App\Http\Controllers;

use App\Models\PokemonCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PokemonCardController extends Controller
{
    public function fetchAndStore()
    {
        $response = Http::withHeaders([
            'X-Api-Key' => '1f2d482b-ab15-47f8-a444-ef88ec023590'
        ])->get('https://api.pokemontcg.io/v2/cards?pageSize=8');

        if ($response->failed()) {
            return response()->json(['error' => 'Error al obtener las cartas'], 500);
        }

        $cards = $response->json()['data'];

        foreach ($cards as $card) {
            $price = $card['tcgplayer']['prices']['normal']['market'] ?? null;

            PokemonCard::updateOrCreate(
                ['card_id' => $card['id']],
                [
                    'name' => $card['name'],
                    'image_url' => $card['images']['small'],
                    'price' => $price
                ]
            );
        }

        return response()->json(['message' => 'Cartas actualizadas']);
    }
    public function index()
{
    $cards = PokemonCard::all();
    return view('seccions.cards', compact('cards')); // Crea una vista Laravel para mostrarlas
}

}
