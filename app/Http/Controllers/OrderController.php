<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\PokemonCard;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Tu carrito está vacío.');
        }

        $total = 0;
        $items = [];

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
            $items[] = [
                'card_id' => $item['id'],
                'name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ];
        }

        $order = Order::create([
            'user_id' => Auth::id(), // opcional, se o usuário estiver logado
            'total_price' => $total,
            'status' => 'pendiente',
            'items' => json_encode($items)
        ]);

        session()->forget('cart'); // Limpar carrinho

        return redirect()->route('order.success')->with('success', 'Pedido realizado com sucesso!');
    }

}
