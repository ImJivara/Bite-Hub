<!-- Calorie Counter -->
<div class="max-w-lg mx-auto bg-white shadow-xl rounded-lg overflow-hidden p-8 tool-card mt-8">
    <h2 class="text-2xl font-bold mb-4 text-center">Calorie Counter</h2>
    <form id="calorie-form" class="space-y-4">
        <div>
            <label for="food" class="block text-lg font-medium">Food Item:</label>
            <input type="text" id="food" class="w-full p-2 border rounded" required>
        </div>
        <div>
            <label for="calories" class="block text-lg font-medium">Calories:</label>
            <input type="number" id="calories" class="w-full p-2 border rounded" required>
        </div>
        <div class="text-center">
            <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-lg shadow-lg hover:bg-green-600 transition duration-300 ease-in-out">Add Food</button>
        </div>
    </form>
    <div id="calorie-result" class="mt-4 text-center text-xl font-semibold text-green-700"></div>
    <ul id="food-list" class="mt-4 space-y-2">
    </ul>
</div>
<script>
// Calorie Counter
        document.getElementById('calorie-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const food = document.getElementById('food').value;
            const calories = parseInt(document.getElementById('calories').value);
            const foodList = document.getElementById('food-list');
            const listItem = document.createElement('li');
            listItem.className = "p-4 bg-gray-200 rounded flex justify-between items-center";
            listItem.innerHTML = `<span>${food}</span><span>${calories} cal</span>`;
            foodList.appendChild(listItem);
            updateTotalCalories(calories);
            document.getElementById('calorie-form').reset();
        });

        let totalCalories = 0;

        function updateTotalCalories(calories) {
            totalCalories += calories;
            document.getElementById('calorie-result').innerText = `Total Calories: ${totalCalories}`;
        }
    </script>