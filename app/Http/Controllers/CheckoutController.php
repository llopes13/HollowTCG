<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = array_reduce($cart, function ($sum, $item) {
            return $sum + ($item['price'] * $item['quantity']);
        }, 0);

        return view('checkout.index', compact('cart', 'total'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'card_number' => 'required|digits:16',
            'card_name' => 'required|string',
            'expiration' => 'required|date_format:m/y',
            'cvv' => 'required|digits:3',
        ]);

        $user = Auth::user();
        $cart = session('cart', []);


        $total = array_reduce($cart, function ($sum, $item) {
            return $sum + ($item['price'] * $item['quantity']);
        }, 0);

        // Cria o pedido
        $order = Order::create([
            'user_id' => $user->id,
            'total' => $total,
            'total_price' => $total,
            'status' => 'pendente',
        ]);


        // Salva os itens do pedido
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'pokemon_card_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);

        }

        // Limpa o carrinho
        if (Auth::check()) {
            \App\Models\CartItem::where('user_id', Auth::id())->delete(); // limpa o carrinho persistido
        } else {
            session()->forget('cart'); // limpa o carrinho da sessão
        }


        return redirect()->route('checkout.success');
    }

}
