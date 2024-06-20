
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div style="width: 800px; margin: auto;">
        <canvas id="clusteredBarChart"></canvas>
    </div>

    <script>
        
    document.addEventListener('DOMContentLoaded', function () {
        fetch('/user/monthly-nutritional-data') 
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
                const ctx = document.getElementById('clusteredBarChart').getContext('2d');
                const myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: 'Calories',
                                data: caloriesData,
                                backgroundColor: 'rgba(255, 99, 132, 0.7)', // Red color
                                barPercentage: 0.25, // Width of bars within cluster
                                categoryPercentage: 0.5, // Spacing between clusters
                            },
                            {
                                label: 'Carbs',
                                data: carbsData,
                                backgroundColor: 'rgba(54, 162, 235, 0.7)', // Blue color
                                barPercentage: 0.25,
                                categoryPercentage: 0.5,
                            },
                            {
                                label: 'Protein',
                                data: proteinData,
                                backgroundColor: 'rgba(255, 206, 86, 0.7)', // Yellow color
                                barPercentage: 0.25,
                                categoryPercentage: 0.5,
                            },
                            {
                                label: 'Fat',
                                data: fatData,
                                backgroundColor: 'rgba(75, 192, 192, 0.7)', // Green color
                                barPercentage: 0.25,
                                categoryPercentage: 0.5,
                            }
                        ]
                    },
                    options: {
                        scales: {
                            x: {
                                stacked: false, // Do not stack bars horizontally
                            },
                            y: {
                                stacked: false, // Do not stack bars vertically
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

 
