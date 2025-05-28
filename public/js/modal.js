// Configuración del evento click para todas las cartas
document.addEventListener('DOMContentLoaded', function() {
    // Cargar SweetAlert2 si no está cargado
    if (typeof Swal === 'undefined') {
        const script = document.createElement('script');
        script.src = 'https://cdn.jsdelivr.net/npm/sweetalert2@11';
        document.head.appendChild(script);
    }

    const cards = document.querySelectorAll('.card-container');

    cards.forEach(card => {
        card.addEventListener('click', function(e) {
            // Evitar que se active si se hace click en un enlace dentro de la carta
            if (e.target.tagName === 'A' || e.target.closest('a')) return;

            openModal(
                card.getAttribute('data-card-id'),
                card.getAttribute('data-card-image'),
                card.getAttribute('data-card-name'),
                card.getAttribute('data-card-price'),
                card.getAttribute('data-card-collection') || 'Desconocida', // Valor por defecto
                card.getAttribute('data-card-rarity') || 'Desconocida' // Valor por defecto
            );
        });
    });
});

// Función para abrir el modal
function openModal(cardId, imageUrl, name, price, collection, rarity) {
    // Llenar el modal con los datos
    const modal = document.getElementById('cardModal');
    modal.querySelector('#modalCardImage').src = imageUrl;
    modal.querySelector('#modalCardImage').alt = name;
    modal.querySelector('#modalCardName').textContent = name;
    modal.querySelector('#modalCardPrice').textContent = price;
    modal.querySelector('#modalCardCollection').textContent = collection;
    modal.querySelector('#modalCardRarity').textContent = rarity;

    // Almacenar el ID de la carta
    modal.querySelector('#modalCardName').setAttribute('data-id', cardId);

    // Mostrar el modal
    modal.classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
}

// Función para cerrar el modal
function closeModal() {
    document.getElementById('cardModal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}

// Función para añadir al carrito (versión mejorada)
function addToCart() {
    const cardId = document.getElementById('modalCardName').getAttribute('data-id');
    const csrfToken = getCsrfToken();

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
        .then(response => {
            if (!response.ok) throw new Error('Error en la respuesta del servidor');
            return response.json();
        })
        .then(data => {
            if (data.success) {
                updateCartCount(data.cart_count);
                showSuccess('Carta añadida al carrito!');
                closeModal();
            } else {
                throw new Error(data.message || 'Error al añadir al carrito');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showError(error.message);
        });
}

// Función para obtener el token CSRF
function getCsrfToken() {
    try {
        // 1. Intenta obtenerlo del meta tag
        const metaTag = document.querySelector('meta[name="csrf-token"]');
        if (metaTag) return metaTag.content;

        // 2. Intenta obtenerlo del input hidden
        const inputToken = document.querySelector('input[name="_token"]');
        if (inputToken) return inputToken.value;

        // 3. Si todo falla, lanza excepción
        throw new Error('Token CSRF no encontrado');
    } catch (error) {
        console.error('Error obteniendo CSRF token:', error);
        throw error;
    }
}

// Función para actualizar el contador del carrito
function updateCartCount(count) {
    const counters = document.querySelectorAll('.cart-count');
    counters.forEach(counter => {
        counter.textContent = count;
    });
}

// Función para mostrar notificación de éxito
function showSuccess(message) {
    if (typeof Swal !== 'undefined') {
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: message,
            timer: 2000,
            showConfirmButton: false,
            background: '#1A1A2E',
            color: '#D4C2FC',
            iconColor: '#A76BBE'
        });
    } else {
        alert(message); // Fallback si SweetAlert no está cargado
    }
}

// Función para mostrar errores
function showError(message) {
    if (typeof Swal !== 'undefined') {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: message,
            background: '#1A1A2E',
            color: '#D4C2FC',
            iconColor: '#ff3860'
        });
    } else {
        alert('Error: ' + message); // Fallback
    }
}

// Cerrar modal al presionar ESC
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeModal();
    }
});

// Cerrar modal al hacer click fuera del contenido
document.getElementById('cardModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});
