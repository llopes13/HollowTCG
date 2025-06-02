@extends('layouts.master-login')

@section('content')
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-4">Editar Usuário</h2>
        <form action="{{ route('admin.usuarios.update', $usuario->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label>Nome</label>
                <input type="text" name="name" value="{{ $usuario->name }}" class="w-full border p-2">
            </div>

            <div>
                <label>Email</label>
                <input type="email" name="email" value="{{ $usuario->email }}" class="w-full border p-2">
            </div>

            <div>
                <label>Função</label>
                <select name="role" class="w-full border p-2">
                    <option value="guest" {{ $usuario->role === 'guest' ? 'selected' : '' }}>Guest</option>
                    <option value="user" {{ $usuario->role === 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ $usuario->role === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <button type="submit" class="bg-purple-600 text-white py-2 px-4 rounded hover:bg-purple-700">Salvar</button>
        </form>
    </div>
@endsection
