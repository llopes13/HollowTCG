@extends('layouts.master-login')

@section('content')
    <div class="mt-10  p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-6">📊 Datos de la tienda</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-[#1A1A2E]  p-4 rounded text-center shadow">
                <h3 class="text-xl font-semibold"> Facturamiento total</h3>
                <p class="text-2xl mt-2 text-green-600 font-bold">€ {{ number_format($totalVendas, 2, ',', '.') }}</p>
            </div>
            <div class="bg-[#1A1A2E]  p-4 rounded text-center shadow">
                <h3 class="text-xl font-semibold">Comandas Realizadas</h3>
                <p class="text-2xl mt-2 text-blue-600 font-bold">{{ $totalPedidos }}</p>
            </div>
            <div class="bg-[#1A1A2E]  p-4 rounded text-center shadow">
                <h3 class="text-xl font-semibold">Productos Vendidos</h3>
                <p class="text-2xl mt-2 text-purple-600 font-bold">{{ $totalItensVendidos }}</p>
            </div>
        </div>

        <canvas id="vendasChart" height="100"></canvas>
    </div>
@endsection

@section('scripts')
        <script src="{{ asset('js/canvas.js') }}"></script>
    <script>
        renderVendasChart(@json($graficoNomes), @json($graficoValores));
    </script>
@endsection
