
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div style="width: 800px; margin: auto;">
        <canvas id="stackedBarChart"></canvas>
    </div>

   
        <script>
    document.addEventListener('DOMContentLoaded', function () {
        fetch('/user/monthly-nutritional-data') // Replace with your endpoint to fetch data
            .then(response => response.json())
            .then(data => {
                const logs = data.logs;

                // Extracting data for the chart
                const labels = logs.map(log => log.log_date); // Array of dates
                const caloriesData = logs.map(log => log.calories);
                const carbsData = logs.map(log => log.carbs);
                const proteinData = logs.map(log => log.protein);
                const fatData = logs.map(log => log.fat);

                // Chart.js configuration
                const ctx = document.getElementById('stackedBarChart').getContext('2d');
                const myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: 'Calories',
                                data: caloriesData,
                                backgroundColor: 'rgba(255, 99, 132, 0.7)', // Red color
                            },
                            {
                                label: 'Carbs',
                                data: carbsData,
                                backgroundColor: 'rgba(54, 162, 235, 0.7)', // Blue color
                            },
                            {
                                label: 'Protein',
                                data: proteinData,
                                backgroundColor: 'rgba(255, 206, 86, 0.7)', // Yellow color
                            },
                            {
                                label: 'Fat',
                                data: fatData,
                                backgroundColor: 'rgba(75, 192, 192, 0.7)', // Green color
                            }
                        ]
                    },
                    options: {
                        scales: {
                            x: {
                                stacked: true, // Stack bars horizontally
                            },
                            y: {
                                stacked: true, // Stack bars vertically
                            }
                        },
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    label: function (tooltipItem) {
                                        return tooltipItem.label + ': ' + tooltipItem.raw.toLocaleString(); // Format tooltip
                                    }
                                }
                            }
                        }
                    }
                });
            });
    });
</script>

