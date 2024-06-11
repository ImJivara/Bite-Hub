<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

<div class="bg-white p-8 rounded-lg shadow-lg max-w-sm w-full">
    <h2 class="text-2xl font-bold mb-4 text-center">Nutritional Facts</h2>
    <canvas id="nutritionPieChart" width="400" height="400"></canvas>
</div>

<script>
    // Step 3: JavaScript for Pie Chart
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('nutritionPieChart').getContext('2d');
        const nutritionData = {
            labels: ['Proteins', 'Carbs', 'Sugars', 'Fats'],
            datasets: [{
                label: 'Nutritional Facts',
                data: [10, 20, 30, 40], // Example data
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'],
            }]
        };

        const config = {
            type: 'pie',
            data: nutritionData,
            options: {
                responsive: true,
                animation: {
                    animateScale: true,
                    animateRotate: true
                },
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                size: 14,
                            },
                            color: '#4A5568', // Gray-700
                        },
                    },
                    tooltip: {
                        callbacks: {
                            label: function (tooltipItem) {
                                let label = tooltipItem.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += Math.round(tooltipItem.raw * 100) / 100;
                                label += '%';
                                return label;
                            }
                        }
                    },
                    datalabels: {
                        color: '#ffffff',
                        formatter: (value, context) => {
                            return `${Math.round(value)}%`;
                        }
                    }
                }
            },
            plugins: [ChartDataLabels],
        };

        new Chart(ctx, config);
    });
</script>
