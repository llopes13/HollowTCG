@extends('layouts.master-login')

@section('content')
    <div class="max-w-2xl mx-auto py-10">
        <h1 class="text-2xl font-bold mb-6">Editar Pedido #{{ $pedido->id }}</h1>

        <form action="{{ route('admin.pedidos.update', $pedido) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="status" class="block font-medium mb-2">Status</label>
            <select name="status" id="status" class="w-full border-gray-300 rounded px-4 py-2 mb-4">
                <option value="pendente" {{ $pedido->status == 'pendente' ? 'selected' : '' }}>Pendente</option>
                <option value="processando" {{ $pedido->status == 'processando' ? 'selected' : '' }}>Processando</option>
                <option value="enviado" {{ $pedido->status == 'enviado' ? 'selected' : '' }}>Enviado</option>
                <option value="concluído" {{ $pedido->status == 'concluído' ? 'selected' : '' }}>Concluído</option>
                <option value="cancelado" {{ $pedido->status == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
            </select>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Salvar</button>
        </form>
    </div>
@endsection
