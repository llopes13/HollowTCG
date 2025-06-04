<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
    public function vendas()
    {
        // Total arrecadado
        $totalVendas = Order::sum('total');

        // Total de pedidos
        $totalPedidos = Order::count();

        // Total de itens vendidos
        $totalItensVendidos = OrderItem::sum('quantity');

        // Gráfico: top 10 cartas mais vendidas
        $maisVendidas = OrderItem::selectRaw('pokemon_card_id, SUM(quantity) as total')
            ->groupBy('pokemon_card_id')
            ->orderByDesc('total')
            ->with('pokemonCard') // carrega a relação para pegar o nome da carta
            ->limit(10)
            ->get();

        $graficoNomes = $maisVendidas->map(function ($item) {
            return $item->pokemonCard->name ?? 'Desconhecida';
        });

        $graficoValores = $maisVendidas->pluck('total');

        return view('admin.vendas.index', compact(
            'totalVendas',
            'totalPedidos',
            'totalItensVendidos',
            'graficoNomes',
            'graficoValores'
        ));
    }





}
