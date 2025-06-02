@extends('layouts.master-login')

@section('content')
    <div class="max-w-lg mx-auto p-6 bg-white rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Criar Nova Categoria</h2>

        @if ($errors->any())
            <div class="mb-4 text-red-600">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.collections.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="id" class="block text-gray-700">ID (único)</label>
                <input type="text" name="id" id="id" class="w-full p-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label for="name" class="block text-gray-700">Nome</label>
                <input type="text" name="name" id="name" class="w-full p-2 border rounded" required>
            </div>

            <button type="submit" class="bg-purple-700 text-white px-4 py-2 rounded hover:bg-purple-800">Salvar</button>
        </form>
    </div>
@endsection
