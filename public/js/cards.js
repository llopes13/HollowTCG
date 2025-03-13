async function fetchPokemonCards() {
    try {
        const response = await fetch('https://api.pokemontcg.io/v2/cards?pageSize=8', {
            headers: { 'X-Api-Key': '1f2d482b-ab15-47f8-a444-ef88ec023590' }
        });
        const data = await response.json();
        const cards = data.data;
        
        const container = document.getElementById('cards-container');
        container.innerHTML = '';
        
        cards.forEach(card => {
            const cardElement = document.createElement('div');
            cardElement.classList.add('card', 'holo-effect', 'p-4', 'rounded-lg', 'shadow-md', 'text-center');
            
            cardElement.innerHTML = `
                <img src="${card.images.small}" alt="${card.name}" class="w-full h-48 object-contain mb-2 rounded-lg">
                <h2 class="font-bold text-lg text-white">${card.name}</h2>
                <p class="text-gray-200">Precio: $${(Math.random() * 50 + 5).toFixed(2)}</p>
            `;
            
            container.appendChild(cardElement);
        });
    } catch (error) {
        console.error('Error obteniendo cartas:', error);
    }
}

fetchPokemonCards();