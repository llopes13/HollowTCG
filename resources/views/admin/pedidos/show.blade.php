@extends('layouts.master-login')

@section('content')
    <div class="max-w-4xl mx-auto py-10">
        <h1 class="text-2xl font-bold mb-6">Detalhes do Pedido #{{ $pedido->id }}</h1>

        <p><strong>Usuário:</strong> {{ $pedido->user->name }}</p>
        <p><strong>Status:</strong> {{ ucfirst($pedido->status) }}</p>
        <p><strong>Total:</strong> €{{ number_format($pedido->total, 2) }}</p>
        <p><strong>Criado em:</strong> {{ $pedido->created_at->format('d/m/Y H:i') }}</p>

        <h2 class="text-xl font-semibold mt-6 mb-2">Itens do Pedido</h2>
        <ul class="list-disc list-inside">
            @foreach ($pedido->items as $item)
                <li>{{ $item->pokemonCard->name }} (x{{ $item->quantity }}) - €{{ number_format($item->price, 2) }}</li>
            @endforeach
        </ul>

        <a href="{{ route('admin.pedidos.index') }}" class="mt-6 inline-block text-blue-600 hover:underline">← Voltar</a>
    </div>
@endsection
