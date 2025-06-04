@extends('layouts.master-login')

@section('content')
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-4">Usuários Registrados</h2>
        <table class="min-w-full bg-[#1A1A2E] text-[#D4C2FC]">
            <thead>
            <tr>
                <th class="py-2 px-4 ">Nombre</th>
                <th class="py-2 px-4 ">Email</th>
                <th class="py-2 px-4 ">Role</th>
            </tr>
            </thead>
            <tbody>
            @foreach($usuarios as $usuario)
                <tr class="text-center">
                    <td class="py-2 px-4 ">{{ $usuario->name }}</td>
                    <td class="py-2 px-4 ">{{ $usuario->email }}</td>
                    <td class="py-2 px-4 ">{{ $usuario->role }}</td>
                    <td class="py-2 px-4 ">
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
