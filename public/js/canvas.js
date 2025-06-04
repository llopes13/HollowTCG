window.renderVendasChart = function (labels, valores) {
    const ctx = document.getElementById('vendasChart').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Cartas mais vendidas',
                data: valores,
                backgroundColor: '#6D67E4'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                title: {
                    display: true,
                    text: 'Top 10 Cartas Vendidas'
                }
            }
        }
    });
}
