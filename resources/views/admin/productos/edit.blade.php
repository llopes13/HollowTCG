@extends('layouts.master-login')

@section('content')
    <div class="max-w-4xl mx-auto py-10">
        <h1 class="text-2xl font-bold mb-6">Editar carta: {{ $produto->name }}</h1>

        <form method="POST" action="{{ route('admin.productos.update', $produto) }}">
            @csrf
            @method('PUT')
            @include('admin.productos._form')
        </form>
    </div>
@endsection
