@extends('layouts.master-login')

@section('content')
    <div class="container mx-auto px-4 py-8 text-center">
        <h1 class="text-3xl font-bold text-[#D4C2FC] mb-4">¡Gracias por tu compra!</h1>
        <p class="text-[#D4C2FC] mb-6">Tu pedido ha sido registrado correctamente.</p>
        <a href="{{ route('cards.index') }}" class="px-4 py-2 bg-[#D4C2FC] text-[#16213E] rounded hover:bg-[#c7b0f8] font-bold">
            Volver a la tienda
        </a>
    </div>
@endsection
