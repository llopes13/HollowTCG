@extends('layouts.master-login')

@section('content')
    <div class="max-w-4xl mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-4">Gerenciar Raridades</h1>

        <a href="{{ route('admin.rarities.create') }}" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">+ Nova Raridade</a>

        @if(session('success'))
            <div class="mt-4 text-green-600">{{ session('success') }}</div>
        @endif

        <table class="mt-6 w-full border">
            <thead>
            <tr class="bg-gray-200">
                <th class="py-2 px-4 border">ID</th>
                <th class="py-2 px-4 border">Nome</th>
                <th class="py-2 px-4 border">Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rarities as $rarity)
                <tr>
                    <td class="py-2 px-4 border">{{ $rarity->id }}</td>
                    <td class="py-2 px-4 border">{{ $rarity->name }}</td>
                    <td class="py-2 px-4 border flex gap-2">
                        <a href="{{ route('admin.rarities.edit', $rarity) }}" class="text-blue-600 hover:underline">Editar</a>
                        <form action="{{ route('admin.rarities.destroy', $rarity) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir?')">
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
