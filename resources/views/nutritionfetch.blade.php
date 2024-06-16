<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutrition Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="{{ asset('jquery-3.7.1.js') }}"></script>
</head>
<body>
    <div class="flex items-center justify-center mt-8">
        <div class="container mx-auto">
            <div class="max-w-lg mx-auto bg-white shadow-xl rounded-lg overflow-hidden p-8 tool-card">
                <center>
                    <button id="showNutritionTracker" class="bg-blue-500 text-white px-4 py-2 rounded-lg mt-4">Show Nutritional Tracker's Pie Chart</button>
                </center>
                <h2 class="text-2xl font-bold mb-4 text-center">Log Your Food</h2>
                <form id="nutrition-form" class="space-y-4">
                    <div>
                        <label for="food-item-meal" class="block text-lg font-medium">Food Item:</label>
                        <input type="text" id="food-item-meal" class="w-full p-2 border rounded" required>
                    </div>
                    <div>
                        <label for="calories2" class="block text-lg font-medium">Calories:</label>
                        <input type="number" id="calories2" class="w-full p-2 border rounded" required>
                    </div>
                    <div>
                        <label for="carbs" class="block text-lg font-medium">Carbohydrates (g):</label>
                        <input type="number" id="carbs" class="w-full p-2 border rounded" required>
                    </div>
                    <div>
                        <label for="protein" class="block text-lg font-medium">Protein (g):</label>
                        <input type="number" id="protein" class="w-full p-2 border rounded" required>
                    </div>
                    <div>
                        <label for="fat" class="block text-lg font-medium">Fat (g):</label>
                        <input type="number" id="fat" class="w-full p-2 border rounded" required>
                    </div>
                    <div>
                        <label for="category" class="block text-lg font-medium">Category:</label>
                        <select id="category" name="category" class="w-full p-2 border rounded">
                            <option value="">Select a category</option>
                            <option value="main course">Main Course</option>
                            <option value="side dish">Side Dish</option>
                            <option value="dessert">Dessert</option>
                            <option value="appetizer">Appetizer</option>
                            <option value="salad">Salad</option>
                            <option value="bread">Bread</option>
                            <option value="breakfast">Breakfast</option>
                            <option value="soup">Soup</option>
                            <option value="beverage">Beverage</option>
                            <option value="sauce">Sauce</option>
                            <option value="marinade">Marinade</option>
                            <option value="fingerfood">Fingerfood</option>
                            <option value="snack">Snack</option>
                            <option value="drink">Drink</option>
                            <option value="condiment">Condiment</option>
                            <option value="preserve">Preserve</option>
                            <option value="preparation">Preparation</option>
                            <option value="leftovers">Leftovers</option>
                            <option value="meal">Meal</option>
                            <option value="side">Side</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-lg shadow-lg hover:bg-green-600 transition duration-300 ease-in-out">Add Food</button>
                    </div>
                </form>
                <div id="nutrition-result" class="mt-4 text-center text-xl font-semibold text-green-700"></div>
                <ul id="food-list2" class="mt-4 space-y-2"></ul>
            </div>
        </div>
    </div>

    <script>
        var totalCal = 0;
        var totalCarbs = 0;
        var totalProtein = 0;
        var totalFat = 0;

        function updateNutritionalIntake(calories2, carbs, protein, fat) {
            totalCal += calories2;
            totalCarbs += carbs;
            totalProtein += protein;
            totalFat += fat;

            $('#nutrition-result').text(`Total Intake - Calories: ${totalCal} cal, Carbs: ${totalCarbs} g, Protein: ${totalProtein} g, Fat: ${totalFat} g`);

            sendNutritionalValues(totalCarbs, totalProtein, totalFat);
        }

        $(document).ready(function() {
            $('#nutrition-form').on('submit', function(event) {
                event.preventDefault();

                const food = $('#food-item-meal').val();
                const calories2 = parseInt($('#calories2').val()) || 0;
                const carbs = parseInt($('#carbs').val()) || 0;
                const protein = parseInt($('#protein').val()) || 0;
                const fat = parseInt($('#fat').val()) || 0;
                const category = $('#category').val();

                if (category) {
                    fetchNutritionalInfo(food, category);
                } else {
                    logFoodItem(food, calories2, carbs, protein, fat);
                }

                $('#nutrition-form')[0].reset();
            });

            $(document).on('click', '.remove-food', function(event) {
                const foodItem = $(this).closest('li');

                const calories = parseInt(foodItem.find('.calories').text().match(/\d+/)[0]);
                const carbs = parseInt(foodItem.find('.carbs').text().match(/\d+/)[0]);
                const protein = parseInt(foodItem.find('.protein').text().match(/\d+/)[0]);
                const fat = parseInt(foodItem.find('.fat').text().match(/\d+/)[0]);

                totalCal -= calories;
                totalCarbs -= carbs;
                totalProtein -= protein;
                totalFat -= fat;

                $('#nutrition-result').text(`Total Intake - Calories: ${totalCal} cal, Carbs: ${totalCarbs} g, Protein: ${totalProtein} g, Fat: ${totalFat} g`);

                const updateEvent = new CustomEvent('nutritionalValuesUpdated', { 
                    detail: { carbs: totalCarbs, proteins: totalProtein, fats: totalFat } 
                });
                document.dispatchEvent(updateEvent);

                foodItem.remove();
            });

            function sendNutritionalValues(carbs, protein, fat) {
                const event = new CustomEvent('nutritionalValuesUpdated', { 
                    detail: { carbs: carbs, proteins: protein, fats: fat } 
                });
                document.dispatchEvent(event);
            }

            function logFoodItem(food, calories2, carbs, protein, fat) {
                const listItem = `
                    <li class="p-4 bg-gray-200 rounded flex justify-between items-center">
                        <div>
                            <h3 class="text-md calories">Food: ${food}-Calories: ${calories2} cal</h3>
                            <span class="text-sm carbs">Carbs: ${carbs} g</span>
                            <span class="text-sm protein">Protein: ${protein} g</span>
                            <span class="text-sm fat">Fat: ${fat} g</span>
                        </div>
                        <button class="remove-food bg-red-500 text-white px-2 py-1 rounded">Remove</button>
                    </li>
                `;

                $('#food-list2').append(listItem);

                updateNutritionalIntake(calories2, carbs, protein, fat);
            }

            function fetchNutritionalInfo(food, category) {
    fetch('/fetch-nutritional-info', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            recipeName: food,
            category: category
        })
    })
    .then(response => {
        // Log the raw response for debugging
        return response.text().then(text => {
            try {
                return JSON.parse(text);
            } catch (err) {
                console.error('Failed to parse JSON:', err);
                console.error('Response:', text);
                throw new Error('Invalid JSON response');
            }
        });
    })
    .then(data => {
        if (data.error) {
            console.error('Error:', data.error);
        } else {
            console.log(data);

            const nutrients = data.results[0].nutrition.nutrients;
            const calories = nutrients.find(n => n.title === 'Calories');
            const carbs = nutrients.find(n => n.title === 'Carbohydrates');
            const protein = nutrients.find(n => n.title === 'Protein');
            const fat = nutrients.find(n => n.title === 'Fat');

            if (calories && carbs && protein && fat) {
                logFoodItem(food, calories.amount, carbs.amount, protein.amount, fat.amount);
            } else {
                console.log('Nutritional information not found.');
            }
        }
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}

        });
    </script>
</body>
</html>
