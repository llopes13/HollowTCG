@extends('layouts.master-login')

@section('content')
    <div class="container mx-auto py-8 px-4">
        <h1 class="text-3xl font-bold text-[#D4C2FC] mb-6">Efectuar compra</h1>

        <div class="bg-[#1A1A2E] rounded-lg shadow-md p-6 border border-[#D4C2FC] max-w-lg mx-auto">
            <form action="{{ route('checkout.process') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="card_number" class="block text-[#D4C2FC] font-semibold">Numero tarjeta</label>
                    <input type="text" name="card_number" id="card_number" maxlength="16"
                           class="w-full p-2 rounded bg-[#16213E] text-[#D4C2FC] border border-[#D4C2FC]/30">
                </div>

                <div class="mb-4">
                    <label for="card_name" class="block text-[#D4C2FC] font-semibold">Nombre</label>
                    <input type="text" name="card_name" id="card_name"
                           class="w-full p-2 rounded bg-[#16213E] text-[#D4C2FC] border border-[#D4C2FC]/30">
                </div>

                <div class="flex gap-4 mb-4">
                    <div class="w-1/2">
                        <label for="expiration" class="block text-[#D4C2FC] font-semibold">Caducidad (MM/AA)</label>
                        <input type="text" name="expiration" id="expiration"
                               class="w-full p-2 rounded bg-[#16213E] text-[#D4C2FC] border border-[#D4C2FC]/30" placeholder="06/25">
                    </div>

                    <div class="w-1/2">
                        <label for="cvv" class="block text-[#D4C2FC] font-semibold">CVV</label>
                        <input type="text" name="cvv" id="cvv" maxlength="3"
                               class="w-full p-2 rounded bg-[#16213E] text-[#D4C2FC] border border-[#D4C2FC]/30">
                    </div>
                </div>

                <div class="text-right">
                    <button type="submit"
                            class="px-6 py-2 bg-[#D4C2FC] text-[#16213E] rounded-md hover:bg-[#c7b0f8] font-bold">
                        Pagar {{ number_format($total, 2) }}€
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
