<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PokemonCard;
use App\Models\Collection;
use App\Models\Rarity;
use Illuminate\Http\Request;

class AdminProdutoController extends Controller
{
    public function index()
    {
        $produtos = PokemonCard::with(['collection', 'rarity'])->get();
        return view('admin.productos.index', compact('produtos'));
    }

    public function create()
    {
        $collections = Collection::all();
        $rarities = Rarity::all();
        return view('admin.productos.create', compact('collections', 'rarities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'card_id' => 'required|unique:pokemon_cards,card_id',
            'name' => 'required',
            'image_url' => 'required|url',
            'price' => 'nullable|numeric',
            'collection_id' => 'nullable|exists:collections,id',
            'rarity_id' => 'nullable|exists:rarities,id',
        ]);

        PokemonCard::create($request->all());

        return redirect()->route('admin.productos.index')->with('success', 'Carta criada com sucesso!');
    }

    public function edit(PokemonCard $produto)
    {
        $collections = Collection::all();
        $rarities = Rarity::all();

        return view('admin.productos.edit', compact('produto', 'collections', 'rarities'));
    }


    public function update(Request $request, PokemonCard $produto)
    {
        $request->validate([
            'card_id' => 'required|unique:pokemon_cards,card_id,' . $produto->id,
            'name' => 'required',
            'image_url' => 'required|url',
            'price' => 'nullable|numeric',
            'collection_id' => 'nullable|exists:collections,id',
            'rarity_id' => 'nullable|exists:rarities,id',
        ]);

        $produto->update($request->all());

        return redirect()->route('admin.productos.index')->with('success', 'Carta atualizada com sucesso!');
    }

    public function destroy(PokemonCard $produto)
    {
        $produto->delete();

        return redirect()->route('admin.productos.index')->with('success', 'Carta excluída com sucesso!');
    }
}
