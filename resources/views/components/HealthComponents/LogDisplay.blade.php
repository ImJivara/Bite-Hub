<div class="flex items-center justify-center">
    <div class="container mx-auto mt-8">
        <div class="max-w-lg mx-auto bg-white shadow-xl rounded-lg overflow-hidden p-8 bmi-card">
            <h2 class="text-2xl font-bold mb-4 text-center text-black capitalize">{{Auth::user()->name}}'s Monthly logs</h2>

            <div class="text-center">
                <!-- <button id="calculate-bmi" class="bg-green-500 text-white py-2 px-4 rounded-lg shadow-lg hover:bg-green-600 transition duration-300 ease-in-out">Display Logs</button> -->
            </div>

            <div id="bmi-result" class="mt-4 text-center text-xl font-semibold text-blue-700"></div>

            <div class="mt-8">
                <h3 class="text-lg font-semibold mb-2">Daily Logs</h3>
                <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        
            fetch('{{ route('nutrition.data') }}')
                .then(response => response.json())
                .then(data => {

                    const logsTable = document.getElementById('nutrition-logs-table');
                    logsTable.innerHTML = '';
                    data.logs.forEach(log => {
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
                    document.getElementById('total-calories').textContent = data.totals.calories;
                    document.getElementById('total-carbs').textContent = data.totals.carbs;
                    document.getElementById('total-protein').textContent = data.totals.protein;
                    document.getElementById('total-fat').textContent = data.totals.fat;
                })
                .catch(error => {
                    console.error('Error fetching nutrition data:', error);
                });
        
    });
</script>
