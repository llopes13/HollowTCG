<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PokemonCard;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;


class CartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'card_id' => 'required|exists:pokemon_cards,id',
            'quantity' => 'sometimes|integer|min:1'
        ]);

        $card = PokemonCard::findOrFail($request->card_id);
        $quantity = $request->quantity ?? 1;

        if (Auth::check()) {
            $userId = Auth::id();

            $item = CartItem::where('user_id', $userId)
                ->where('pokemon_card_id', $card->id)
                ->first();

            if ($item) {
                $item->quantity += $quantity;
                $item->save();
            } else {
                CartItem::create([
                    'user_id' => $userId,
                    'pokemon_card_id' => $card->id,
                    'quantity' => $quantity
                ]);
            }

            // contar itens
            $count = CartItem::where('user_id', $userId)->sum('quantity');

            return response()->json([
                'success' => true,
                'cart_count' => $count,
                'message' => 'Carta añadida al carrito!'
            ]);
        }


        $cart = Session::get('cart', []);

        if (isset($cart[$card->id])) {
            $cart[$card->id]['quantity'] += $quantity;
        } else {
            $cart[$card->id] = [
                "id" => $card->id,
                "name" => $card->name,
                "quantity" => $quantity,
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
        $cart = [];
        $total = 0;

        if (Auth::check()) {
            $items = CartItem::with('pokemonCard')
                ->where('user_id', Auth::id())
                ->get();

            foreach ($items as $item) {
                $cart[$item->pokemonCard->id] = [
                    'id' => $item->pokemonCard->id,
                    'name' => $item->pokemonCard->name,
                    'quantity' => $item->quantity,
                    'price' => $item->pokemonCard->price,
                    'image' => $item->pokemonCard->image_url
                ];

                $total += $item->pokemonCard->price * $item->quantity;
            }
        } else {
            $cart = Session::get('cart', []);
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }
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
    public function import(Request $request)
    {
        $items = $request->input('items', []);
        $cart = session()->get('cart', []);

        foreach ($items as $id => $item) {
            if (is_array($item) && isset($item['id'])) {
                if (isset($cart[$id])) {
                    $cart[$id]['quantity'] += $item['quantity'];
                } else {
                    $cart[$id] = $item;
                }
            }
        }


        session()->put('cart', $cart);

        return response()->json(['success' => true]);
    }

}
