<div class="flex justify-center items-center">
    <div class=" mx-auto mt-8">
        <div class="max-w-lg bg-white shadow-xl rounded-lg overflow-hidden p-8">
            <h2 class="text-2xl font-bold mb-4 text-center text-black capitalize">{{ Auth::user()->name }}'s Monthly Logs</h2>
            <div class="mt-8 flex flex-col">
                <h3 class="text-lg font-semibold mb-2 text-center">Daily Logs</h3>
                <x-HealthComponents.monthlychart />
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden mb-4">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="py-2 px-4">Date</th>
                                <th class="py-2 px-4">Calories</th>
                                <th class="py-2 px-4">Carbs</th>
                                <th class="py-2 px-4">Protein</th>
                                <th class="py-2 px-4">Fat</th>
                            </tr>
                        </thead>
                        <tbody id="nutrition-logs-table">
                            <!-- Logs will be dynamically added here -->
                        </tbody>
                        <tfoot class="bg-gray-200">
                            <tr>
                                <th class="py-2 px-4" colspan="1">Totals:</th>
                                <th class="py-2 px-4" id="total-calories"></th>
                                <th class="py-2 px-4" id="total-carbs"></th>
                                <th class="py-2 px-4" id="total-protein"></th>
                                <th class="py-2 px-4" id="total-fat"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        
            fetch('{{ route('nutrition.data') }}')
                .then(response => response.json())
                .then(data => {

                    const logsTable = document.getElementById('nutrition-logs-table');
                    const logs = data.logs;
                    logsTable.innerHTML = '';
                    logs.forEach(log => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td class="py-2 px-4">${log.log_date}</td>
                            <td class="py-2 px-4">${log.calories}</td>
                            <td class="py-2 px-4">${log.carbs}</td>
                            <td class="py-2 px-4">${log.protein}</td>
                            <td class="py-2 px-4">${log.fat}</td>
                        `;
                        logsTable.appendChild(row);
                    });
                
                const roundToTwoDecimalPlaces = (value) => Math.round(value * 100) / 100;

                document.getElementById('total-calories').textContent = roundToTwoDecimalPlaces(data.totals.calories);
                document.getElementById('total-carbs').textContent = roundToTwoDecimalPlaces(data.totals.carbs);
                document.getElementById('total-protein').textContent = roundToTwoDecimalPlaces(data.totals.protein);
                document.getElementById('total-fat').textContent = roundToTwoDecimalPlaces(data.totals.fat);
                })
                .catch(error => {
                    console.error('Error fetching nutrition data:', error);
                });
        
    });
</script>
