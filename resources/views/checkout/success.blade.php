@extends('layouts.master-login')

@section('content')
    <div class="container mx-auto py-8 px-4 text-center">
        <h1 class="text-3xl font-bold text-[#D4C2FC] mb-4">¡Pago exitoso!</h1>
        <p class="text-[#D4C2FC] mb-4">Gracias por tu compra. Tu pedido ha sido procesado correctamente.</p>
        <a href="{{ route('cards.index') }}"
           class="px-4 py-2 bg-[#D4C2FC] text-[#16213E] rounded-md hover:bg-[#c7b0f8] font-bold">
            Seguir Comprando
        </a>
    </div>
@endsection
