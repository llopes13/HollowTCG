@extends('layouts.master-login')

@section('content')
    <div class="max-w-6xl mx-auto py-10">
        <h1 class="text-2xl font-bold mb-6">Lista de Pedidos</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full bg-white border border-gray-300 rounded shadow">
            <thead>
            <tr class="bg-gray-100 text-left">
                <th class="py-2 px-4 border-b">ID</th>
                <th class="py-2 px-4 border-b">Usuário</th>
                <th class="py-2 px-4 border-b">Status</th>
                <th class="py-2 px-4 border-b">Total</th>
                <th class="py-2 px-4 border-b">Criado em</th>
                <th class="py-2 px-4 border-b">Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($pedidos as $pedido)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $pedido->id }}</td>
                    <td class="py-2 px-4 border-b">{{ $pedido->user->name }}</td>
                    <td class="py-2 px-4 border-b">{{ ucfirst($pedido->status) }}</td>
                    <td class="py-2 px-4 border-b">€{{ number_format($pedido->total, 2) }}</td>
                    <td class="py-2 px-4 border-b">{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                    <td class="py-2 px-4 border-b space-x-2">
                        <a href="{{ route('admin.pedidos.show', $pedido) }}" class="text-blue-600 hover:underline">Ver</a>
                        <a href="{{ route('admin.pedidos.edit', $pedido) }}" class="text-yellow-600 hover:underline">Editar</a>
                        <form action="{{ route('admin.pedidos.destroy', $pedido) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja excluir este pedido?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
