<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutrition Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="{{asset('jquery-3.7.1.js')}}"></script>
    
</head>
<div class=" flex items-center justify-center mt-8">
    <div class="container mx-auto"> 
        <div class="max-w-lg mx-auto bg-white shadow-xl rounded-lg overflow-hidden p-8 tool-card">
       <center> <button id="showNutritionTracker" class="bg-blue-500 text-white px-4 py-2 rounded-lg mt-4">Show Nutritional Tracker's Pie Chart</button></center>
            <h2 class="text-2xl font-bold mb-4 text-center">Log Your Food</h2>
            <form id="nutrition-form" class="space-y-4">
                <div>
                    <label for="food" class="block text-lg font-medium">Food Item:</label>
                    <input type="text" id="food" class="w-full p-2 border rounded" required>
                </div>
                <div>
                    <label for="calories2" class="block text-lg font-medium">calories:</label>
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
                <div class="text-center">
                    <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-lg shadow-lg hover:bg-green-600 transition duration-300 ease-in-out">Add Food</button>
                </div>
            </form>
            <div id="nutrition-result" class="mt-4 text-center text-xl font-semibold text-green-700"></div>
            <ul id="food-list2" class="mt-4 space-y-2">
            </ul>
        </div>
    </div>
    </div>
    
    </html>

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
        
        // Call sendNutritionalValues after updating the values
        sendNutritionalValues(totalCarbs, totalProtein, totalFat);
    }

    $(document).ready(function() {
        $('#nutrition-form').on('submit', function(event) {
            event.preventDefault();

            const food = $('#food').val();
            const calories2 = parseInt($('#calories2').val()) || 0;
            const carbs = parseInt($('#carbs').val()) || 0;
            const protein = parseInt($('#protein').val()) || 0;
            const fat = parseInt($('#fat').val()) || 0;

            const listItem = `
                <li class="p-4 bg-gray-200 rounded flex justify-between items-center">
                    <div>
                        <span class="text-sm calories">Calories: ${calories2} cal</span>
                        <span class="text-sm carbs">Carbs: ${carbs} g</span>
                        <span class="text-sm protein">Protein: ${protein} g</span>
                        <span class="text-sm fat">Fat: ${fat} g</span>
                    </div>
                    <button class="remove-food bg-red-500 text-white px-2 py-1 rounded">Remove</button>
                </li>
            `;

            $('#food-list2').append(listItem); // Append the list item to the food list

            updateNutritionalIntake(calories2, carbs, protein, fat); // Update nutritional intake

            $('#nutrition-form')[0].reset(); // Reset the form
        });

        $(document).on('click', '.remove-food', function(event) {
            const foodItem = $(this).closest('li'); // Find the parent <li> element

            // Extract numeric values using specific classes
            const calories = parseInt(foodItem.find('.calories').text().match(/\d+/)[0]);
            const carbs = parseInt(foodItem.find('.carbs').text().match(/\d+/)[0]);
            const protein = parseInt(foodItem.find('.protein').text().match(/\d+/)[0]);
            const fat = parseInt(foodItem.find('.fat').text().match(/\d+/)[0]);

            // Decrement the total intake
            totalCal -= calories;
            totalCarbs -= carbs;
            totalProtein -= protein;
            totalFat -= fat;

            // Update the total intake display
            $('#nutrition-result').text(`Total Intake - Calories: ${totalCal} cal, Carbs: ${totalCarbs} g, Protein: ${totalProtein} g, Fat: ${totalFat} g`);

            // Trigger event to update the chart with the latest total values
            const updateEvent = new CustomEvent('nutritionalValuesUpdated', { 
                detail: { carbs: totalCarbs, proteins: totalProtein,  fats: totalFat } 
            });
            document.dispatchEvent(updateEvent);

            foodItem.remove(); // Remove the food item from the list
        });

        function sendNutritionalValues(carbs, protein, fat) {
            const event = new CustomEvent('nutritionalValuesUpdated', { 
                detail: { carbs: carbs, proteins: protein,  fats: fat } 
            });
            document.dispatchEvent(event);
        }
    });
</script>



   
