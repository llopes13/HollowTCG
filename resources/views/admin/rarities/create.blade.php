@extends('layouts.master-login')

@section('content')
    <div class="max-w-xl mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-4">Criar Nova Raridade</h1>

        <form action="{{ route('admin.rarities.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block mb-2 font-semibold">Nome:</label>
                <input type="text" name="name" id="name" class="w-full border px-4 py-2 rounded" required>
                @error('name')
                <div class="text-red-600 mt-1">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Salvar</button>
        </form>
    </div>
@endsection
