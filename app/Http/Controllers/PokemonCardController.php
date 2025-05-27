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

        for ($i = 1; $i < 50; $i++) {
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

    public function index(Request $request)
    {
        $query = PokemonCard::with(['collection', 'rarity']);

        // Búsqueda por nombre
        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }

        // Filtro por colección
        if ($request->has('collection') && !empty($request->collection)) {
            $query->whereHas('collection', function($q) use ($request) {
                $q->where('id', $request->collection);
            });
        }

        // Filtro por rareza
        if ($request->has('rarity') && !empty($request->rarity)) {
            $query->whereHas('rarity', function($q) use ($request) {
                $q->where('id', $request->rarity);
            });
        }

        // Filtro por precio
        if ($request->has('price_range') && !empty($request->price_range)) {
            switch ($request->price_range) {
                case '0-10':
                    $query->whereBetween('price', [0, 10]);
                    break;
                case '10-50':
                    $query->whereBetween('price', [10, 50]);
                    break;
                case '50-100':
                    $query->whereBetween('price', [50, 100]);
                    break;
                case '100+':
                    $query->where('price', '>', 100);
                    break;
            }
        }

        $cards = $query->orderBy('name')->paginate(20);
        $collections = \App\Models\Collection::orderBy('name')->get();
        $rarities = \App\Models\Rarity::orderBy('name')->get();

        return view('seccions.cards', compact('cards', 'collections', 'rarities'));
    }

}
