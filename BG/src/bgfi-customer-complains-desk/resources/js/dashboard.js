import Chart from 'chart.js/auto';

document.addEventListener('DOMContentLoaded', function () {
    // Récupérer les données depuis les attributs data-* du canvas
    const canvas = document.getElementById('statutChart');
    if (!canvas) return;

    const labels = JSON.parse(canvas.dataset.labels);
    const data = JSON.parse(canvas.dataset.data);

    new Chart(canvas, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                data: data,
                backgroundColor: [
                    '#3b82f6', // bleu
                    '#f59e0b', // orange
                    '#10b981', // vert
                    '#ef4444', // rouge
                    '#8b5cf6', // violet
                    '#6b7280', // gris
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });
});


// Graphique Priorité (Barres)
const canvasPriorite = document.getElementById('prioriteChart');
if (canvasPriorite) {
    const labelsP = JSON.parse(canvasPriorite.dataset.labels);
    const dataP = JSON.parse(canvasPriorite.dataset.data);

    new Chart(canvasPriorite, {
        type: 'bar',
        data: {
            labels: labelsP,
            datasets: [{
                label: 'Nombre de réclamations',
                data: dataP,
                backgroundColor: '#6366f1', // Indigo
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
}

// Graphique Par Agence (Barres horizontales)
const canvasAgence = document.getElementById('agenceChart');
if (canvasAgence) {
    const labelsA = JSON.parse(canvasAgence.dataset.labels);
    const dataA = JSON.parse(canvasAgence.dataset.data);

    new Chart(canvasAgence, {
        type: 'bar',
        data: {
            labels: labelsA,
            datasets: [{
                label: 'Réclamations',
                data: dataA,
                backgroundColor: '#10b981', // Vert
                borderRadius: 4
            }]
        },
        options: {
            indexAxis: 'y', // Barres horizontales
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
}

// Graphique Par Service (Barres verticales)
const canvasService = document.getElementById('serviceChart');
if (canvasService) {
    const labelsS = JSON.parse(canvasService.dataset.labels);
    const dataS = JSON.parse(canvasService.dataset.data);

    new Chart(canvasService, {
        type: 'bar',
        data: {
            labels: labelsS,
            datasets: [{
                label: 'Réclamations',
                data: dataS,
                backgroundColor: '#f59e0b', // Orange
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
}