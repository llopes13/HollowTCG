<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\PedidoItem;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{


    public function index()
    {
        $cart = session('cart', []);
        $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

        return view('checkout.index', compact('cart', 'total'));
    }

    public function process(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) return redirect()->back()->with('error', 'El carrito está vacío.');

        $pedido = Pedido::create([
            'user_id' => Auth::id(),
            'total' => array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)),
            'status' => 'pendiente',
        ]);

        foreach ($cart as $item) {
            PedidoItem::create([
                'pedido_id' => $pedido->id,
                'pokemon_card_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('dashboard')->with('success', 'Pedido realizado con éxito.');
    }

}
