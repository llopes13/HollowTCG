@extends('layouts.master-login')

@section('content')
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-4">Usuários Registrados</h2>
        <table class="min-w-full bg-white">
            <thead>
            <tr>
                <th class="py-2 px-4 border">Nome</th>
                <th class="py-2 px-4 border">Email</th>
                <th class="py-2 px-4 border">Função</th>
                <th class="py-2 px-4 border">Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($usuarios as $usuario)
                <tr>
                    <td class="py-2 px-4 border">{{ $usuario->name }}</td>
                    <td class="py-2 px-4 border">{{ $usuario->email }}</td>
                    <td class="py-2 px-4 border">{{ $usuario->role }}</td>
                    <td class="py-2 px-4 border">
                        <a href="{{ route('admin.usuarios.edit', $usuario->id) }}" class="text-blue-500">Editar</a> |
                        <form action="{{ route('admin.usuarios.destroy', $usuario->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500" onclick="return confirm('Tem certeza que deseja excluir este usuário?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
