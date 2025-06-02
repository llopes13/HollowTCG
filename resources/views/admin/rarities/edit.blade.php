@extends('layouts.master-login')

@section('content')
    <div class="max-w-xl mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-4">Editar Raridade</h1>

        <form action="{{ route('admin.rarities.update', $rarity) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block mb-2 font-semibold">Nome:</label>
                <input type="text" name="name" id="name" class="w-full border px-4 py-2 rounded" value="{{ $rarity->name }}" required>
                @error('name')
                <div class="text-red-600 mt-1">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Atualizar</button>
        </form>
    </div>
@endsection
