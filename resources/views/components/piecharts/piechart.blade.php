@props(['Proteins', 'Carbs', 'Fats'])

<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

<div class="bg-white  max-w-sm w-full">
    <!-- p-14 rounded-lg shadow-lg -->
    <h2 class="text-2xl font-bold mb-4 text-center">Nutritional Facts</h2>
    <canvas id="nutritionPieChart" width="400" height="400"></canvas>
</div>

<script>
    // Step 3: JavaScript for Pie Chart
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('nutritionPieChart').getContext('2d');
        const data = [{{ $Proteins }}, {{ $Carbs }}, {{ $Fats }}];

        // Calculate the total intake
        const totalIntake = data.reduce((acc, val) => acc + val, 0);

        // Calculate the percentage of each nutrient
        const percentages = data.map(value => (value / totalIntake) * 100);

        const nutritionData = {
            labels: ['Proteins', 'Carbs', 'Fats'],
            datasets: [{
                label: 'Nutritional Facts',
                data: percentages,
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
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
