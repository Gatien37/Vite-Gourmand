const canvas = document.getElementById('graphMenus');

if (canvas) {
    const rawLabels = JSON.parse(canvas.dataset.labels);
    const values = JSON.parse(canvas.dataset.values);

    const displayLabels = rawLabels.map(label =>
        label.replace(/^Menu\s+/i, '')
    );

    new Chart(canvas, {
        type: 'bar',
        data: {
            labels: displayLabels,
            datasets: [{
                label: 'Nombre de commandes',
                data: values,
                backgroundColor: '#A43F3B'
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: { precision: 0 }
                }
            }
        }
    });
}
