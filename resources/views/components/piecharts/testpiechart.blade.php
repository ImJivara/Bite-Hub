<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script src="{{asset('jquery-3.7.1.js')}}"></script>

<div class="bg-white p-8 rounded-lg shadow-lg max-w-sm w-full mt-8" id="nutritionTrackerContent" style="display: none;">
    <h2 class="text-2xl font-bold mb-4 text-center">Nutritional Facts</h2>
    <canvas id="nutritionPieChart" width="400" height="400"></canvas>
</div>



<script>
    // Define the sendNutritionalValues function
function sendNutritionalValues(cals,carbs, proteins, fats) {
    const event = new CustomEvent('nutritionalValuesUpdated', { 
        detail: {cals:cals ,  carbs: carbs, proteins: proteins, fats: fats } 
    });
    document.dispatchEvent(event);
}

    // Function to initialize the nutritional tracker
function initializeNutritionalTracker(data,totalCalories) 
{
    // Calculate the total intake
    const totalIntake = data.reduce((acc, val) => acc + val, 0);

    // Calculate the percentage of each nutrient
    const percentages = data.map(value => (value / totalIntake) * 100);

    const ctx = document.getElementById('nutritionPieChart').getContext('2d');

    // Destroy existing chart instance if it exists
    if (Chart.getChart(ctx)) {
        Chart.getChart(ctx).destroy();
    }

    const nutritionData = {
        labels: ['Proteins', 'Carbs', 'Fats'],
        datasets: [{
            label: 'Nutritional Facts',
            data: percentages, // Use percentages instead of absolute values
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
                    title: {
                        display: true,
                        text: `Nutritional Facts (Total Calories: ${totalCalories})`, 
                        font: {
                            size: 18,
                            weight: 'bold'
                        },
                        color: '#4A5568' 
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

    // Create the chart
    new Chart(ctx, config);
}


document.getElementById('showNutritionTracker').addEventListener('click', function () {
    const nutritionTrackerContent = document.getElementById('nutritionTrackerContent');
    if (nutritionTrackerContent.style.display === 'none') {
        nutritionTrackerContent.style.display = 'block'; // Show the nutritional tracker content
        
        // Initialize the nutritional tracker with the updated total values
        document.addEventListener('nutritionalValuesUpdated', function (event) {
            const { cals, carbs, proteins, fats } = event.detail;
            
            initializeNutritionalTracker([carbs, proteins, fats], cals);
        });

        // Trigger event to update the chart with the latest total values
        const event = new CustomEvent('nutritionalValuesUpdated', { 
            detail: { cals: totalCalories, proteins: totalProtein, carbs: totalCarbs, fats: totalFat } 
        });
        document.dispatchEvent(event);
    }
});
    

</script>
