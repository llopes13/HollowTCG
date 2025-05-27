@extends('layouts.master')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Filtros y Buscador (manteniendo tu estructura original) -->
        <div class="p-6 mb-8">
            <form action="{{ route('cards.index') }}" method="GET" class="space-y-4 md:space-y-0 md:grid md:grid-cols-4 md:gap-4">
                <!-- Buscador -->
                <div>
                    <label for="search" class="block text-sm font-medium text-[#D4C2FC] mb-1">Buscar</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                           class="w-full px-3 py-2 bg-[#16213E] border border-[#D4C2FC] rounded-md text-[#D4C2FC] focus:outline-none focus:ring-2 focus:ring-[#D4C2FC]"
                           placeholder="Nombre de la carta">
                </div>

                <!-- Filtro por Colección -->
                <div>
                    <label for="collection" class="block text-sm font-medium text-[#D4C2FC] mb-1">Colección</label>
                    <select id="collection" name="collection"
                            class="w-full px-3 py-2 bg-[#16213E] border border-[#D4C2FC] rounded-md text-[#D4C2FC] focus:outline-none focus:ring-2 focus:ring-[#D4C2FC]">
                        <option value="">Todas</option>
                        @foreach($collections as $collection)
                            <option value="{{ $collection->id }}" {{ request('collection') == $collection->id ? 'selected' : '' }}>
                                {{ $collection->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filtro por Rareza -->
                <div>
                    <label for="rarity" class="block text-sm font-medium text-[#D4C2FC] mb-1">Rareza</label>
                    <select id="rarity" name="rarity"
                            class="w-full px-3 py-2 bg-[#16213E] border border-[#D4C2FC] rounded-md text-[#D4C2FC] focus:outline-none focus:ring-2 focus:ring-[#D4C2FC]">
                        <option value="">Todas</option>
                        @foreach($rarities as $rarity)
                            <option value="{{ $rarity->id }}" {{ request('rarity') == $rarity->id ? 'selected' : '' }}>
                                {{ $rarity->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filtro por Rango de Precio -->
                <div>
                    <label for="price_range" class="block text-sm font-medium text-[#D4C2FC] mb-1">Rango de Precio</label>
                    <select id="price_range" name="price_range"
                            class="w-full px-3 py-2 bg-[#16213E] border border-[#D4C2FC] rounded-md text-[#D4C2FC] focus:outline-none focus:ring-2 focus:ring-[#D4C2FC]">
                        <option value="">Todos</option>
                        <option value="0-10" {{ request('price_range') == '0-10' ? 'selected' : '' }}>$0 - $10</option>
                        <option value="10-50" {{ request('price_range') == '10-50' ? 'selected' : '' }}>$10 - $50</option>
                        <option value="50-100" {{ request('price_range') == '50-100' ? 'selected' : '' }}>$50 - $100</option>
                        <option value="100+" {{ request('price_range') == '100+' ? 'selected' : '' }}>Más de $100</option>
                    </select>
                </div>

                <!-- Botones -->
                <div class="md:col-span-4 flex space-x-4 pt-2">
                    <button type="submit" class="px-4 py-2 bg-[#D4C2FC] text-[#16213E] rounded-md hover:bg-[#c7b0f8] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#D4C2FC] font-bold">
                        Aplicar Filtros
                    </button>
                    <a href="{{ route('cards.index') }}" class="px-4 py-2 bg-[#16213E] text-[#D4C2FC] border border-[#D4C2FC] rounded-md hover:bg-[#1A1A2E] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#D4C2FC] font-bold">
                        Limpiar
                    </a>
                </div>
            </form>
        </div>

        @if($cards->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($cards as $card)
                    <div class="card-container rounded-lg overflow-hidden transition-shadow duration-300"
                         data-card-id="{{ $card->id }}"
                         data-card-image="{{ $card->image_url  }}"
                         data-card-name="{{ $card->name }}"
                         data-card-price="{{ $card->price ? number_format($card->price, 2) . '€' : 'Valor não disponível' }}"
                         data-card-collection="{{ $card->collection->name ?? 'Desconhecida' }}"
                         data-card-rarity="{{ $card->rarity->name ?? 'Desconhecida' }}">

                        @if($card->image_url)
                            <div class="p-4 flex justify-center">
                                <img src="{{ $card->image_url }}" alt="{{ $card->name }}" class="h-64 object-contain hover:scale-105">
                            </div>
                        @endif

                        <div class="p-4 text-center">
                            <h2 class="text-xl font-semibold text-[#D4C2FC] mb-2">{{ $card->name }}</h2>
                            <div class="space-y-2 text-center">
                                @if($card->price)
                                    <p class="text-[#D4C2FC]">
                                        <span class="font-medium">{{ number_format($card->price, 2) }}€</span>
                                    </p>
                                @else
                                    <p class="text-gray-500 italic">Valor no disponible</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Paginación -->
            <div class="mt-8">
                {{ $cards->appends(request()->query())->links() }}
            </div>
        @else
            <div class="bg-[#1A1A2E] rounded-lg shadow-md p-8 text-center border border-[#D4C2FC]">
                <p class="text-[#D4C2FC]">No se encontraron cartas con los filtros seleccionados.</p>
                <a href="{{ route('cards.index') }}" class="mt-4 inline-block px-4 py-2 bg-[#D4C2FC] text-[#16213E] rounded-md hover:bg-[#c7b0f8] font-bold">
                    Mostrar todas las cartas
                </a>
            </div>
        @endif

        <!-- Modal -->
        <div id="cardModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Fondo oscuro -->
                <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeModal()"></div>

                <!-- Contenido del modal -->
                <div class="inline-block align-bottom bg-[#1A1A2E] rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl w-full border-2 border-[#D4C2FC]">
                    <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <!-- Imagen de la carta -->
                            <div class="flex-shrink-0 mx-auto sm:mx-0 sm:w-1/2 p-4">
                                <img id="modalCardImage" src="" alt="" class="w-full h-auto max-h-96 object-contain rounded-lg">
                            </div>

                            <!-- Detalles de la carta -->
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 id="modalCardName" class="text-2xl leading-6 font-bold text-[#D4C2FC] mb-2"></h3>

                                <div class="mt-4 space-y-3">
                                    <p class="text-[#D4C2FC]">
                                        <span class="font-medium">Precio: </span>
                                        <span id="modalCardPrice" class="text-[#E2D1FF]"></span>
                                    </p>

                                    <p class="text-[#D4C2FC]">
                                        <span class="font-medium">Colección: </span>
                                        <span id="modalCardCollection" class="text-[#E2D1FF]"></span>
                                    </p>

                                    <p class="text-[#D4C2FC]">
                                        <span class="font-medium">Rareza: </span>
                                        <span id="modalCardRarity" class="text-[#E2D1FF]"></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Botones del modal -->
                    <div class="bg-[#16213E] px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse space-x-3">
                        <button type="button" onclick="addToCart()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-[#D4C2FC] text-[#16213E] font-bold hover:bg-[#c7b0f8] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#D4C2FC] sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                            Adicionar al Carrito
                        </button>
                        <button type="button" onclick="closeModal()" class="w-full inline-flex justify-center rounded-md border border-[#D4C2FC] shadow-sm px-4 py-2 bg-transparent text-[#D4C2FC] font-bold hover:bg-[#D4C2FC]/10 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#D4C2FC] sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                            Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/modal.js') }}"></script>
@endsection
