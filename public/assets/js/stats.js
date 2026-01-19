/* ========== Graphique statistiques menus ========== */

// Récupération du canvas du graphique
const canvas = document.getElementById('graphMenus');

if (canvas) {
    // Données injectées depuis le HTML (data-attributes)
    const rawLabels = JSON.parse(canvas.dataset.labels);
    const values = JSON.parse(canvas.dataset.values);

    // Nettoyage des libellés (suppression du préfixe "Menu")
    const displayLabels = rawLabels.map(label =>
        label.replace(/^Menu\s+/i, '')
    );

    // Initialisation du graphique Chart.js
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
