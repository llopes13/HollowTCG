<?php

namespace App\Http\Controllers;

use App\Models\PokemonCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PokemonCardController extends Controller
{
    public function fetchAndStore()
    {
        set_time_limit(999);

        for ($i = 1; $i < 75; $i++) {
            $response = Http::withHeaders([
                'X-Api-Key' => '1f2d482b-ab15-47f8-a444-ef88ec023590'
            ])->get('https://api.pokemontcg.io/v2/cards?page=' . $i);

            if ($response->failed()) {
                return response()->json(['error' => 'Error al obtener las cartas'], 500);
            }

            $cards = $response->json()['data'];

            foreach ($cards as $card) {
                $price = $card['cardmarket']['prices']['trendPrice']
                    ?? $card['tcgplayer']['prices']['holofoil']['market']
                    ?? $card['tcgplayer']['prices']['normal']['low']
                    ?? $card['tcgplayer']['prices']['holofoil']['low']
                    ?? null;

                // Guardar colección
                if (isset($card['set'])) {
                    $collection = \App\Models\Collection::updateOrCreate(
                        ['id' => $card['set']['id']],
                        ['name' => $card['set']['name']]
                    );
                }

                // Guardar rareza
                $rarityId = null;
                if (!empty($card['rarity'])) {
                    $rarity = \App\Models\Rarity::firstOrCreate(['name' => $card['rarity']]);
                    $rarityId = $rarity->id;
                }

                // Guardar carta
                \App\Models\PokemonCard::updateOrCreate(
                    ['card_id' => $card['id']],
                    [
                        'name' => $card['name'],
                        'image_url' => $card['images']['small'] ?? null,
                        'price' => $price,
                        'collection_id' => $card['set']['id'] ?? null,
                        'rarity_id' => $rarityId
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
