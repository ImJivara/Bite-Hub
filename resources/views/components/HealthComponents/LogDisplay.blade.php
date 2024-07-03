
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
<div id="edit-form-overlay" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
    <div class="bg-white p-6 rounded-lg">
        <h2 class="text-xl font-bold mb-4">Edit Log</h2>
        <form id="edit-form">
            <input type="hidden" id="edit-log-id">
            <div>
                <label for="edit-calories" class="block text-lg font-medium">Calories:</label>
                <input type="text" id="edit-calories" class="w-full p-2 border rounded" min="0">
            </div>
            <div>
                <label for="edit-carbs" class="block text-lg font-medium">Carbs:</label>
                <input type="text" id="edit-carbs" class="w-full p-2 border rounded" min="0">
            </div>
            <div>
                <label for="edit-protein" class="block text-lg font-medium">Protein:</label>
                <input type="text" id="edit-protein" class="w-full p-2 border rounded" min="0">
            </div>
            <div>
                <label for="edit-fat" class="block text-lg font-medium">Fat:</label>
                <input type="text" id="edit-fat" class="w-full p-2 border rounded" min="0">
            </div>
            <div class="mt-4 flex justify-around">
                <button type="submit" class="bg-blue-500 text-white py-1 px-4 rounded">Save</button>
                <button type="button" id="cancel-edit" class="bg-red-500 text-white py-1 px-4 rounded">Cancel</button>
                
            </div>
        </form>
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
                    <td>
                        <button class="edit-btn bg-blue-500 text-white py-1 px-3 rounded" data-id="${log.id}" data-log='${JSON.stringify(log)}'>Edit</button>
                        <button class="delete-btn bg-red-500 text-white py-1 px-1  rounded" data-id="${log.id}">Delete</button>
                    </td>
                `;
                logsTable.appendChild(row);
            });

            const roundToTwoDecimalPlaces = value => Math.round(value * 100) / 100;
            document.getElementById('total-calories').textContent = roundToTwoDecimalPlaces(data.totals.calories);
            document.getElementById('total-carbs').textContent = roundToTwoDecimalPlaces(data.totals.carbs);
            document.getElementById('total-protein').textContent = roundToTwoDecimalPlaces(data.totals.protein);
            document.getElementById('total-fat').textContent = roundToTwoDecimalPlaces(data.totals.fat);

            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const log = JSON.parse(this.getAttribute('data-log'));
                    document.getElementById('edit-log-id').value = log.id;
                    document.getElementById('edit-calories').value = log.calories;
                    document.getElementById('edit-carbs').value = log.carbs;
                    document.getElementById('edit-protein').value = log.protein;
                    document.getElementById('edit-fat').value = log.fat;
                    document.getElementById('edit-form-overlay').classList.remove('hidden');
                });
            });

            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const logId = this.getAttribute('data-id');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'Do you really want to delete this log?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'No, cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/delete-nutrition-log/${logId}`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire({
                                        title: 'Deleted!',
                                        text: 'Your log has been deleted.',
                                        icon: 'success',
                                        showConfirmButton: false,
                                        timer: 3000  // Timer in milliseconds
                                    }).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire('Failed!', 'Failed to delete the log. Please try again.', 'error');
                                }
                            })
                            .catch(error => {
                                console.error('Error deleting log:', error);
                                Swal.fire('Error!', 'An error occurred while deleting the log.', 'error');
                            });
                        }
                    });
                });
            });

            document.getElementById('cancel-edit').addEventListener('click', function() {
                document.getElementById('edit-form-overlay').classList.add('hidden');
            });

            document.getElementById('edit-form').addEventListener('submit', function(event) {
                event.preventDefault();
                const logId = document.getElementById('edit-log-id').value;
                const updatedLog = {
                    calories: document.getElementById('edit-calories').value,
                    carbs: document.getElementById('edit-carbs').value,
                    protein: document.getElementById('edit-protein').value,
                    fat: document.getElementById('edit-fat').value
                };

                fetch(`/update-nutrition-log/${logId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(updatedLog)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Updated!',
                            text: 'Your log has been updated. The page will automatically be refreshed',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 100000  // Timer in milliseconds
                        }).then(() => {
                                location.reload();
                        });  
                    }
                    else {
                        Swal.fire('Failed!', data.message, 'error');
                    } 
                });


            });
        })
        .catch(error => {
            console.error('Error fetching nutrition data:', error);
        });
});

</script>