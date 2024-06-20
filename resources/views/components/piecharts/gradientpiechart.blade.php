<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Nutritional Facts Gradient Pie Chart</title>
    <link href="{{ asset('css/tailwindstyles.css') }}" rel="stylesheet">>>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-sm w-full">
        <h2 class="text-2xl font-bold mb-4 text-center">Nutritional Facts Gradient Pie Chart</h2>
        <canvas id="nutritionGradientPieChart" width="400" height="400"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('nutritionGradientPieChart').getContext('2d');
        const data = {
            labels: ['Proteins', 'Carbs', 'Sugars'],
            datasets: [{
                label: 'Nutritional Facts',
                data: [25, 40, 15],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)'
                ],
                borderColor: '#fff',
                hoverOffset: 4
            }]
        };

        const config = {
            type: 'pie',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#333',
                            font: {
                                size: 14
                            }
                        }
                    }
                }
            }
        };

        new Chart(ctx, config);
    </script>
</body>
</html>
