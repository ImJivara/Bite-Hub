<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Nutritional Facts Radar Chart</title>
    <link href="{{ asset('css/tailwindstyles.css') }}" rel="stylesheet">>>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-sm w-full">
        <h2 class="text-2xl font-bold mb-4 text-center">Nutritional Facts</h2>
        <canvas id="nutritionRadarChart" width="400" height="400"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('nutritionRadarChart').getContext('2d');
        const nutritionData = {
            labels: ['Proteins', 'Carbs', 'Sugars', 'Fats'],
            datasets: [{
                label: 'Nutritional Facts',
                data: [10, 20, 30, 40], // Example data
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 2,
                pointBackgroundColor: 'rgba(255, 99, 132, 1)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgba(255, 99, 132, 1)'
            }]
        };

        const config = {
            type: 'radar',
            data: nutritionData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        labels: {
                            color: '#333', // Set legend label color
                            font: {
                                size: 15
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(255, 255, 255, 0.8)',
                        borderColor: 'rgba(0, 0, 0, 0.1)',
                        borderWidth: 2,
                        titleColor: '#333',
                        bodyColor: '#333',
                        footerColor: '#333'
                    }
                },
                scales: {
                    r: {
                        angleLines: {
                            display: true,
                            color: 'rgba(0, 0, 0, 0.7)', // Set color of radial lines
                            lineWidth: 1 // Set width of radial lines
                        },
                        suggestedMin: 0,
                        suggestedMax: 50, // Adjust max value as needed
                        ticks: {
                            stepSize: 10,
                            font: {
                                size: 13,
                                weight: 'bold',

                            },
                            color: '#333' // Set color of tick labels
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.2)' // Set color of grid lines
                        }
                    }
                }
            }
        };

        new Chart(ctx, config);
    </script>
</body>
</html>
