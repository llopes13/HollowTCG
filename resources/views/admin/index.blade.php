@extends('layouts.master-login')

@section('content')
    <div class="max-w-7xl mx-auto py-10 min-h-screen flex flex-col">
        <h1 class="text-3xl font-bold mb-4">Painel do Administrador</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <a href="{{ route('admin.usuarios.index') }}" class="p-4 bg-[#1A1A2E] text-[#D4C2FC] shadow rounded hover:scale-105 transition">Gerenciar Usuários</a>
            <a href="{{ route('admin.collections.index') }}" class="p-4 bg-[#1A1A2E] text-[#D4C2FC] shadow rounded hover:scale-105 transition">Gerenciar Collecciones</a>
            <a href="{{ route('admin.rarities.index') }}" class="p-4 bg-[#1A1A2E] text-[#D4C2FC] shadow rounded hover:scale-105 transition">Gerenciar Rarezas</a>
            <a href="{{ route('admin.productos.index') }}" class="p-4 bg-[#1A1A2E] text-[#D4C2FC] shadow rounded hover:scale-105 transition">Gerenciar Productos</a>
            <a href="{{ route('admin.pedidos.index') }}" class="p-4 bg-[#1A1A2E] text-[#D4C2FC] shadow rounded hover:scale-105 transition">Gerenciar Comandas</a>
            <a href="{{ route('admin.vendas') }}" class="p-4 bg-[#1A1A2E] text-[#D4C2FC] shadow rounded hover:scale-105 transition">Datos de la tienda</a>

        </div>
    </div>



@endsection
