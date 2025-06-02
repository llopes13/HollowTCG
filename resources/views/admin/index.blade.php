@extends('layouts.master-login')

@section('content')
    <div class="max-w-7xl mx-auto py-10">
        <h1 class="text-3xl font-bold mb-4">Painel do Administrador</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <a href="{{ route('admin.usuarios.index') }}" class="p-4 bg-white shadow rounded hover:scale-105 transition">Gerenciar Usuários</a>
            <a href="{{ route('admin.collections.index') }}" class="p-4 bg-white shadow rounded hover:scale-105 transition">Gerenciar Categorias</a>
            <a href="{{ route('admin.rarities.index') }}" class="p-4 bg-white shadow rounded hover:scale-105 transition">Gerenciar Subcategorias</a>
            <a href="{{ route('admin.productos.index') }}" class="p-4 bg-white shadow rounded hover:scale-105 transition">Gerenciar Produtos</a>
            <a href="{{ route('admin.pedidos.index') }}" class="p-4 bg-white shadow rounded hover:scale-105 transition">Gerenciar Pedidos</a>
        </div>
    </div>
@endsection
