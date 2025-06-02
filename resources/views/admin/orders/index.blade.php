@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold text-[#D4C2FC] mb-4">Pedidos</h1>

        <table class="w-full text-[#D4C2FC] bg-[#1A1A2E] border border-[#D4C2FC]">
            <thead>
            <tr>
                <th class="p-3 border-b border-[#D4C2FC]">ID</th>
                <th class="p-3 border-b border-[#D4C2FC]">Usuário</th>
                <th class="p-3 border-b border-[#D4C2FC]">Total</th>
                <th class="p-3 border-b border-[#D4C2FC]">Status</th>
                <th class="p-3 border-b border-[#D4C2FC]">Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr class="text-center border-b border-[#D4C2FC]/30">
                    <td class="p-3">{{ $order->id }}</td>
                    <td class="p-3">{{ $order->user->name ?? 'Visitante' }}</td>
                    <td class="p-3">{{ number_format($order->total_price, 2) }}€</td>
                    <td class="p-3">{{ ucfirst($order->status) }}</td>
                    <td class="p-3">
                        <a href="{{ route('admin.pedidos.show', $order->id) }}" class="text-blue-400 hover:underline">Ver</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mt-6">{{ $orders->links() }}</div>
    </div>
@endsection
