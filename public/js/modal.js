// Configuración del evento click para todas las cartas
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.card-container');

    cards.forEach(card => {
        card.addEventListener('click', function(e) {
            // Evitar que se active si se hace click en un enlace dentro de la carta
            if (e.target.tagName === 'A') return;

            openModal(
                card.getAttribute('data-card-id'),
                card.getAttribute('data-card-image'),
                card.getAttribute('data-card-name'),
                card.getAttribute('data-card-price'),
                card.getAttribute('data-card-collection'),
                card.getAttribute('data-card-rarity')
            );
        });
    });
});

// Función para abrir el modal
function openModal(cardId, imageUrl, name, price, collection, rarity) {
    // Llenar el modal con los datos
    document.getElementById('modalCardImage').src = imageUrl;
    document.getElementById('modalCardImage').alt = name;
    document.getElementById('modalCardName').textContent = name;
    document.getElementById('modalCardPrice').textContent = price;
    document.getElementById('modalCardCollection').textContent = collection;
    document.getElementById('modalCardRarity').textContent = rarity;

    // Almacenar el ID de la carta en el botón (para el carrito)
    document.getElementById('modalCardName').setAttribute('data-id', cardId);

    // Mostrar el modal
    document.getElementById('cardModal').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
}

// Función para cerrar el modal
function closeModal() {
    document.getElementById('cardModal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}

// Función para añadir al carrito
function addToCart() {
    const cardId = document.getElementById('modalCardName').getAttribute('data-id');

    // Aquí implementarías la lógica para añadir al carrito
    fetch('/cart/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            card_id: cardId,
            quantity: 1
        })
    })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                alert('Carta añadida al carrito!');
                closeModal();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al añadir al carrito');
        });
}

// Cerrar modal al presionar ESC
document.addEventListener('keydown', function(event) {
    if(event.key === 'Escape') {
        closeModal();
    }
});
function addToCart() {
    const cardId = document.getElementById('modalCardName').getAttribute('data-id');
    const csrfToken = getCsrfToken(); // Usamos nuestra nueva función

    fetch('/cart/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            card_id: cardId,
            quantity: 1
        })
    })
        .then(response => response.json())
        .then(data => {
            // Manejar respuesta
        })
        .catch(error => console.error('Error:', error));
}

// Nueva función para obtener el token CSRF de forma segura
function getCsrfToken() {
    // 1. Intenta obtenerlo del meta tag
    const metaTag = document.querySelector('meta[name="csrf-token"]');
    if (metaTag) return metaTag.content;

    // 2. Intenta obtenerlo del input hidden (formularios tradicionales)
    const inputToken = document.querySelector('input[name="_token"]');
    if (inputToken) return inputToken.value;

    // 3. Si todo falla, muestra error y lanza excepción
    console.error('CSRF token no encontrado');
    throw new Error('CSRF token no configurado');
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
