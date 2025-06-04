@extends('layouts.master-login')

@section('content')
    <div class="p-6">
        <h2 class="text-xl font-bold mb-4">collecciones</h2>
        <a href="{{ route('admin.collections.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">Nueva Colleccion</a>
        <ul class="mt-4">
            @foreach ($collections as $collection)
                <li class="border-b py-2 flex justify-between items-center">
                    <span>{{ $collection->name }}</span>
                    <div>
                        <a href="{{ route('admin.collections.edit', $collection->id) }}" class="text-blue-600 mr-4">Editar</a>
                        <form action="{{ route('admin.collections.destroy', $collection->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600">Excluir</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
