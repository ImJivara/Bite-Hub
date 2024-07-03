<!-- resources/views/components/piechart.blade.php -->
@props(['nutrients'])

<link href="{{ asset('css/tailwindstyles.css') }}" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

<div class="bg-white w-full">
    <h2 class="text-2xl font-bold mb-4 text-center">Nutritional Facts</h2>
    <div class="chart-container" style="position: relative; height:600px; width:100%;">
        <canvas id="nutritionPieChart" style="height:100%;" data-nutrients="{{ json_encode($nutrients) }}"></canvas>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const canvas = document.getElementById('nutritionPieChart');
        const ctx = canvas.getContext('2d');

        const nutrientData = JSON.parse(canvas.getAttribute('data-nutrients'));
        const labels = nutrientData.map(nutrient => nutrient.name);

        const data = nutrientData.map(nutrient => {
            const amountInGrams = convertToGrams(parseFloat(nutrient.amount), nutrient.unit);
            return amountInGrams;
        });

        const totalIntake = data.reduce((acc, val) => acc + val, 0);
        const percentages = data.map(value => (value / totalIntake) * 100);

        const nutritionData = {
            labels: labels,
            datasets: [{
                label: 'Nutritional Facts',
                data: percentages,
                backgroundColor: [
                    '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', 
                    '#9966FF', '#FF9F40', '#FF5733', '#C70039', 
                    '#900C3F', '#581845', '#2C3E50', '#E74C3C', 
                    '#3498DB', '#8E44AD', '#2ECC71', '#F39C12', 
                    '#1ABC9C', '#9B59B6', '#34495E', '#16A085', 
                    '#27AE60', '#2980B9', '#8E44AD', '#D35400', 
                    '#C0392B', '#BDC3C7', '#7F8C8D', '#2ECC71', 
                    '#F1C40F', '#E67E22', '#ECF0F1', '#95A5A6',
                    '#D4AC0D', '#F4D03F', '#B03A2E', '#1F618D', 
                    '#117A65', '#AF601A', '#B7950B', '#E59866'
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
                            return value > 2 ? `${Math.round(value)}%` : '';
                        }
                    }
                }
            },
            plugins: [ChartDataLabels],
        };

        new Chart(ctx, config);

        // Function to convert different units to grams
        function convertToGrams(amount, unit) {
            switch (unit) {
                case 'g':
                    return amount;
                case 'mg':
                    return amount / 1000;
                case 'IU':
                    // Adjust the conversion factor for IU if needed
                    return amount * 0.000001; // Example conversion, adjust as per your requirement
                case 'µg':
                    return amount * 0.000001; // Micrograms to grams
                default:
                    return amount; // Default to returning the original amount for unknown units
            }
        }

    });
</script>