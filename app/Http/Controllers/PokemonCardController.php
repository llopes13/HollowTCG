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

        for ($i = 1; $i < 10; $i++) {
            $response = Http::withHeaders([
                'X-Api-Key' => '1f2d482b-ab15-47f8-a444-ef88ec023590'
            ])->get('https://api.pokemontcg.io/v2/cards?page=' . $i);

            if ($response->failed()) {
                return response()->json(['error' => 'Error al obtener las cartas'], 500);
            }

            $cards = $response->json()['data'];

            foreach ($cards as $card) {
                $price = null;

                // Verifica cardmarket
                if (isset($card['cardmarket']['prices']['trendPrice']) && $card['cardmarket']['prices']['trendPrice'] !== null) {
                    $price = $card['cardmarket']['prices']['trendPrice'];
                }
                // Verifica tcgplayer holofoil market
                elseif (isset($card['tcgplayer']['prices']['holofoil']['market']) && $card['tcgplayer']['prices']['holofoil']['market'] !== null) {
                    $price = $card['tcgplayer']['prices']['holofoil']['market'];
                }
                // Verifica tcgplayer normal low
                elseif (isset($card['tcgplayer']['prices']['normal']['low']) && $card['tcgplayer']['prices']['normal']['low'] !== null) {
                    $price = $card['tcgplayer']['prices']['normal']['low'];
                }
                // Verifica tcgplayer holofoil low
                elseif (isset($card['tcgplayer']['prices']['holofoil']['low']) && $card['tcgplayer']['prices']['holofoil']['low'] !== null) {
                    $price = $card['tcgplayer']['prices']['holofoil']['low'];
                }

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

                // Log de cartas sem preço
                if (is_null($price)) {
                    \Log::info('Carta sem preço:', [
                        'id' => $card['id'],
                        'name' => $card['name'],
                        'price' => $price,
                    ]);
                }
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
