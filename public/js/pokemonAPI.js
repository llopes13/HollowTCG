const API_KEY = '1f2d482b-ab15-47f8-a444-ef88ec023590 '; // 🔴 Reemplázalo con tu clave API
        const API_URL = 'https://api.pokemontcg.io/v2/cards';

        async function getCards(query) {
            try {
                const response = await fetch(`${API_URL}?q=name:${query}`, {
                    headers: { 'X-Api-Key': API_KEY }
                });
                const data = await response.json();
                return data.data;
            } catch (error) {
                console.error('Error al obtener las cartas:', error);
                return [];
            }
        }

        async function searchCards() {
            const query = document.getElementById('search').value.trim();
            if (!query) return alert('Por favor ingresa un nombre de Pokémon');
            
            const cards = await getCards(query);
            displayCards(cards);
        }

        function displayCards(cards) {
            const container = document.getElementById('card-container');
            container.innerHTML = ''; // Limpiar el contenedor antes de mostrar nuevas cartas
            
            if (cards.length === 0) {
                container.innerHTML = '<p>No se encontraron cartas</p>';
                return;
            }

            cards.forEach(card => {
                const cardElement = document.createElement('div');
                cardElement.classList.add('card');
                cardElement.innerHTML = `
                    <h2>${card.name}</h2>
                    <img src="${card.images.small}" alt="${card.name}">
                `;
                container.appendChild(cardElement);
            });
        }