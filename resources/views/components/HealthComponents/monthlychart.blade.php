
    <title>Nutritional Tracker</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 

    <div class="container">
    <h3 class="text-lg font-semibold mb-2 text-center">Monthly Nutritional Data</h1>
        <canvas id="nutritionalChart"></canvas>
    </div>

    <script>
        function initializeBarGraph() {
            fetch('/user/monthly-nutritional-data')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    // Check if data.logs is an array before using map
                    if (!Array.isArray(data.logs)) {
                        throw new Error('Data logs is not an array');
                    }

                    const logs = data.logs;
                    const labels = logs.map(log => log.log_date);
                    const calories = logs.map(log => log.calories);
                    const carbs = logs.map(log => log.carbs);
                    const protein = logs.map(log => log.protein);
                    const fat = logs.map(log => log.fat);

                    const ctx = document.getElementById('nutritionalChart').getContext('2d');
                    myChart =new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [
                                {
                                    label: 'Calories',
                                    data: calories,
                                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                    borderColor: 'rgba(255, 99, 132, 1)',
                                    borderWidth: 1
                                },
                                {
                                    label: 'Carbs',
                                    data: carbs,
                                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                    borderColor: 'rgba(54, 162, 235, 1)',
                                    borderWidth: 1
                                },
                                {
                                    label: 'Protein',
                                    data: protein,
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1
                                },
                                {
                                    label: 'Fat',
                                    data: fat,
                                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                                    borderColor: 'rgba(153, 102, 255, 1)',
                                    borderWidth: 1
                                }
                            ]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                });
        }
    </script>

