<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PokemonCard;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'card_id' => 'required|exists:pokemon_cards,id',
            'quantity' => 'sometimes|integer|min:1'
        ]);

        $card = PokemonCard::findOrFail($request->card_id);
        $cart = Session::get('cart', []);

        if(isset($cart[$card->id])) {
            $cart[$card->id]['quantity'] += $request->quantity ?? 1;
        } else {
            $cart[$card->id] = [
                "id" => $card->id,
                "name" => $card->name,
                "quantity" => $request->quantity ?? 1,
                "price" => $card->price,
                "image" => $card->image_url
            ];
        }

        Session::put('cart', $cart);

        return response()->json([
            'success' => true,
            'cart_count' => array_sum(array_column($cart, 'quantity')),
            'message' => 'Carta añadida al carrito!'
        ]);
    }

    public function index()
    {
        $cart = Session::get('cart', []);
        $total = 0;

        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('seccions.shoppingCart', compact('cart', 'total'));
    }

    public function remove($id)
    {
        $cart = Session::get('cart', []);

        if(isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }

        return redirect()->route('seccions.shoppingCart')->with('success', 'Carta eliminada del carrito');
    }

    public function update(Request $request)
    {
        $request->validate([
            'card_id' => 'required|exists:pokemon_cards,id',
            'change' => 'required|integer'
        ]);

        $cart = Session::get('cart', []);
        $cardId = $request->card_id;

        if (!isset($cart[$cardId])) {
            return response()->json([
                'success' => false,
                'message' => 'Carta no encontrada en el carrito'
            ], 404);
        }

        // Actualizar cantidad
        $cart[$cardId]['quantity'] += $request->change;

        // Eliminar si cantidad es <= 0
        if ($cart[$cardId]['quantity'] <= 0) {
            unset($cart[$cardId]);
            $removed = true;
        }

        Session::put('cart', $cart);

        // Calcular nuevo total
        $total = array_reduce($cart, function($sum, $item) {
            return $sum + ($item['price'] * $item['quantity']);
        }, 0);

        return response()->json([
            'success' => true,
            'removed' => $removed ?? false,
            'new_quantity' => $cart[$cardId]['quantity'] ?? 0,
            'new_total' => $total,
            'cart_count' => count($cart)
        ]);
    }
}
