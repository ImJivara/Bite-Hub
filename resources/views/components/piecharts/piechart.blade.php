<!-- resources/views/components/piechart.blade.php -->
@props(['nutrients'])

<link href="{{ asset('css/tailwindstyles.css') }}" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

<div class="bg-white w-full">
    <h2 class="text-2xl font-bold mb-4 text-center">Nutritional Facts</h2>
    <div class="chart-container" style="position: relative; height:800px; width:100%;">
        <canvas id="nutritionPieChart" style="height:100%;" data-nutrients="{{ json_encode($nutrients) }}"></canvas>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const canvas = document.getElementById('nutritionPieChart');
        const ctx = canvas.getContext('2d');

        const nutrientData = JSON.parse(canvas.getAttribute('data-nutrients'));
        const labels = nutrientData.map(nutrient => nutrient.name);
        const data = nutrientData.map(nutrient => parseFloat(nutrient.amount.replace(/[^\d.-]/g, '')));

        const totalIntake = data.reduce((acc, val) => acc + val, 0);
        const percentages = data.map(value => (value / totalIntake) * 100);

        const nutritionData = {
            labels: labels,
            datasets: [{
                label: 'Nutritional Facts',
                data: percentages,
                backgroundColor: [
                    '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', 
                    '#9966FF', '#FF9F40', '#FF6384', '#36A2EB', 
                    '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'
                ],
            }]
        };

        const config = {
            type: 'pie',
            data: nutritionData,
            options: {
                responsive: true,
                maintainAspectRatio: true,
                animation: {
                    animateScale: true,
                    animateRotate: true
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: {
                                size: 14,
                            },
                            color: '#4A5568',
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
                            return value > 2     ? `${Math.round(value)}%` : '';
                            
                        }
                    }
                }
            },
            plugins: [ChartDataLabels],
        };

        new Chart(ctx, config);
    });
</script>
