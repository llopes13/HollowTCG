@extends('layouts.master-login')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-[#D4C2FC] mb-8">Tu Carrito de Compras</h1>

        @if(count($cart) > 0)
            <div class="bg-[#1A1A2E] rounded-lg shadow-md p-6 border border-[#D4C2FC]">
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-4 font-bold text-[#D4C2FC]">
                    <div class="col-span-2">Carta</div>
                    <div>Precio Unitario</div>
                    <div>Cantidad</div>
                    <div>Subtotal</div>
                </div>

                @foreach($cart as $item)
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 items-center mb-4 pb-4 border-b border-[#D4C2FC]/30">
                        <div class="col-span-2 flex items-center">
                            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="h-16 w-16 object-contain mr-4">
                            <span>{{ $item['name'] }}</span>
                        </div>
                        <div class="text-[#D4C2FC]">{{ number_format($item['price'], 2) }}€</div>
                        <div class="text-[#D4C2FC]">
                            <div class="flex items-center">
                                <button class="decrease-quantity px-2 py-1 bg-[#5E1675] rounded-l"
                                        data-card-id="{{ $item['id'] }}">-</button>
                                <span class="quantity px-3 py-1 bg-[#16213E]">{{ $item['quantity'] }}</span>
                                <button class="increase-quantity px-2 py-1 bg-[#5E1675] rounded-r"
                                        data-card-id="{{ $item['id'] }}">+</button>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-[#D4C2FC]">{{ number_format($item['price'] * $item['quantity'], 2) }}€</span>
                            <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach

                <div class="flex justify-end mt-6">
                    <div class="text-xl font-bold text-[#D4C2FC]">
                        Total: {{ number_format($total, 2) }}€
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <form action="{{ route('checkout.store') }}" method="POST">
                        @csrf
                        <button type="submit" class="px-6 py-2 bg-[#D4C2FC] text-[#16213E] rounded-md hover:bg-[#c7b0f8] font-bold">
                            Proceder al Pago
                        </button>
                    </form>

                </div>
            </div>
        @else
            <div class="bg-[#1A1A2E] rounded-lg shadow-md p-8 text-center border border-[#D4C2FC]">
                <p class="text-[#D4C2FC]">Tu carrito está vacío</p>
                <a href="{{ route('cards.index') }}" class="mt-4 inline-block px-4 py-2 bg-[#D4C2FC] text-[#16213E] rounded-md hover:bg-[#c7b0f8] font-bold">
                    Ver Cartas
                </a>
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Manejar aumento de cantidad
            document.querySelectorAll('.increase-quantity').forEach(button => {
                button.addEventListener('click', function() {
                    const cardId = this.getAttribute('data-card-id');
                    updateQuantity(cardId, 1);
                });
            });

            // Manejar disminución de cantidad
            document.querySelectorAll('.decrease-quantity').forEach(button => {
                button.addEventListener('click', function() {
                    const cardId = this.getAttribute('data-card-id');
                    updateQuantity(cardId, -1);
                });
            });

            function updateQuantity(cardId, change) {
                fetch('{{ route("cart.update") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        card_id: cardId,
                        change: change
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (!data.success) throw new Error(data.message);

                        // Actualizar cantidad
                        const quantityElement = document.querySelector(`.cart-item[data-card-id="${cardId}"] .quantity`);
                        if (quantityElement) {
                            quantityElement.textContent = data.new_quantity;
                        }

                        // Actualizar total
                        const totalElement = document.querySelector('.cart-total');
                        if (totalElement) {
                            totalElement.textContent = `${data.new_total.toFixed(2)}€`;
                        }

                        // Actualizar contador en navbar
                        updateCartCount(data.cart_count);

                        // Si se eliminó, quitar el elemento
                        if (data.removed) {
                            document.querySelector(`.cart-item[data-card-id="${cardId}"]`).remove();

                            // Mostrar mensaje si el carrito queda vacío
                            if (data.cart_count === 0) {
                                window.location.reload();
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: error.message,
                            background: '#1A1A2E',
                            color: '#D4C2FC'
                        });
                    });
            }

// Función auxiliar para actualizar contador
            function updateCartCount(count) {
                const countElements = document.querySelectorAll('.cart-count');
                countElements.forEach(el => {
                    el.textContent = count;
                });
            }

// Función auxiliar para actualizar el total
            function updateCartTotal(newTotal) {
                const totalElement = document.querySelector('.cart-total');
                if (totalElement) {
                    totalElement.textContent = `${newTotal.toFixed(2)}€`;
                }
            }
        });
    </script>
@endsection
