<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Nutritional Facts Doughnut Chart</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-sm w-full">
        <h2 class="text-2xl font-bold mb-4 text-center">Nutritional Facts</h2>
        <canvas id="nutritionDoughnutChart" width="500" height="500"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('nutritionDoughnutChart').getContext('2d');
        const nutritionData = {
            labels: ['Proteins', 'Carbs', 'Sugars', 'Fats'],
            datasets: [{
                label: 'Nutritional Facts',
                data: [10, 20, 30, 40], // Example data
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'],
            }]
        };

        const totalCalories = 500; // Example total calories
        const totalMacros = {
            proteins: 20, // Example grams
            carbs: 40, // Example grams
            sugars: 15, // Example grams
            fats: 10 // Example grams
        };

        const config = {
            type: 'doughnut',
            data: nutritionData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += Math.round(context.raw * 100) / 100;
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
                    },
                    
                }
            }
        };

        new Chart(ctx, config);
    </script>
</body>
</html>
