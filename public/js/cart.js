function addToCart() {
    const cardId = document.getElementById('modalCardName').getAttribute('data-id');

    fetch('{{ route("cart.add") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            card_id: cardId,
            quantity: 1
        })
    })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                // Actualizar el contador del carrito
                updateCartCount(data.cart_count);

                // Mostrar notificación con SweetAlert
                Swal.fire({
                    icon: 'success',
                    title: '¡Carta añadida!',
                    text: 'La carta se ha añadido al carrito',
                    showConfirmButton: false,
                    timer: 1500,
                    background: '#1A1A2E',
                    color: '#D4C2FC'
                });

                // Cerrar el modal
                closeModal();
            } else {
                showError(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showError('Error al añadir al carrito');
        });
}

function updateCartCount(count) {
    const cartCountElement = document.getElementById('cart-count');
    if(cartCountElement) {
        cartCountElement.textContent = count;
    }
}

function showError(message) {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: message,
        background: '#1A1A2E',
        color: '#D4C2FC'
    });
}
