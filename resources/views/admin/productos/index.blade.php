@extends('layouts.master-login')

@section('content')
    <h1>Lista de Cartas</h1>
    <a href="{{ route('admin.productos.create') }}">Criar nova carta</a>

    <table>
        <thead>
        <tr>
            <th>Imagem</th>
            <th>Nome</th>
            <th>Preço</th>
            <th>Coleção</th>
            <th>Raridade</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach($produtos as $produto)
            <tr>
                <td><img src="{{ $produto->image_url }}" width="80"></td>
                <td>{{ $produto->name }}</td>
                <td>{{ $produto->price }}€</td>
                <td>{{ $produto->collection->name ?? '—' }}</td>
                <td>{{ $produto->rarity->name ?? '—' }}</td>
                <td>
                    <a href="{{ route('admin.productos.edit', $produto) }}">Editar</a>
                    <form method="POST" action="{{ route('admin.productos.destroy', $produto) }}" style="display:inline">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Tem certeza que deseja excluir esta carta?')">Excluir</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
