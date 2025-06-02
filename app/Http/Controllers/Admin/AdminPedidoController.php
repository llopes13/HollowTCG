<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class AdminPedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::with('user', 'items.card')->orderByDesc('created_at')->get();
        return view('admin.pedidos.index', compact('pedidos'));
    }


    public function show(Order $pedido)
    {
        $pedido->load('user', 'items.pokemonCard'); // Carrega os dados completos do pedido
        return view('admin.pedidos.show', compact('pedido'));
    }

    public function edit(Order $pedido)
    {
        return view('admin.pedidos.edit', compact('pedido'));
    }

    public function update(Request $request, Order $pedido)
    {
        $request->validate([
            'status' => 'required|in:pendente,processando,enviado,concluído,cancelado',
        ]);

        $pedido->status = $request->status;
        $pedido->save();

        return redirect()->route('admin.pedidos.index')->with('success', 'Status do pedido atualizado!');
    }

    public function destroy(Order $pedido)
    {
        $pedido->delete();
        return redirect()->route('admin.pedidos.index')->with('success', 'Pedido excluído com sucesso!');
    }

}
