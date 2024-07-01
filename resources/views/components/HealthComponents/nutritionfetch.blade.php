<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutrition Tracker</title>
    <link href="{{ asset('css/tailwindstyles.css') }}" rel="stylesheet">
    <script src="{{asset('jquery-3.7.1.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
</head>
<body>
    <div class="flex items-center justify-center mt-8">
        <div class="container mx-auto"> 
            <div class="max-w-lg mx-auto bg-white shadow-xl rounded-lg overflow-hidden p-8 tool-card">
                <center>
                <button onclick=validateBackEnd() class="bg-purple-500 text-white px-4 py-2 rounded-lg mt-4 shadow-lg hover:bg-purple-600 transition duration-300 ease-in-out">Log Total Values</button>
                  
                <!-- <button id="showNutritionTracker" class="bg-black text-white px-4 py-2 rounded-lg mt-4">Show Nutritional Tracker's Pie Chart</button> -->
                </center>
                <h2 class="text-2xl font-bold mb-4 text-center">Log Your Food</h2>
                <form id="nutrition-form" class="space-y-4">
                    <div>
                        <label for="food-item-meal" class="block text-lg font-medium" >Food Item:</label>
                        <input type="text" id="food-item-meal" class="w-full p-2 border rounded" required>
                    </div>
                    <div>
                        <label for="quantity" class="block text-lg font-medium" >Quantity:</label>
                        <input type="number" id="quantity" class="w-full p-2 border rounded"  required>
                    </div>
                    <div>
                        <label for="unit" class="block text-lg font-medium" required>Unit:</label>
                        <select id="unit" class="w-full p-2 border rounded">
                            <option value="g">grams (g)</option>
                            <option value="kg">kilograms (kg)</option>
                            <option value="ml">milliliters (ml)</option>
                            <option value="l">liters (l)</option>
                            <option value="oz">ounces (oz)</option>
                            <option value="lb">pounds (lb)</option>
                            <option value="cup">cups</option>
                            <option value="tbsp">tablespoons (tbsp)</option>
                            <option value="tsp">teaspoons (tsp)</option>
                        </select>
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
                    <div>
                        <label for="calories2" class="block text-lg font-medium">Calories (optional):</label>
                        <input type="number" id="calories2" class="w-full p-2 border rounded">
                    </div>
                    <div>
                        <label for="carbs" class="block text-lg font-medium">Carbs (optional):</label>
                        <input type="number" id="carbs" class="w-full p-2 border rounded">
                    </div>
                    <div>
                        <label for="protein" class="block text-lg font-medium">Protein (optional):</label>
                        <input type="number" id="protein" class="w-full p-2 border rounded">
                    </div>
                    <div>
                        <label for="fat" class="block text-lg font-medium">Fat (optional):</label>
                        <input type="number" id="fat" class="w-full p-2 border rounded">
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
        totalCal += parseFloat(calories2);
        totalCarbs += parseFloat(carbs);
        totalProtein += parseFloat(protein);
        totalFat += parseFloat(fat);

        // Round the values to 1 decimal place
        var roundedCal = totalCal.toFixed(1);
        var roundedCarbs = totalCarbs.toFixed(1);
        var roundedProtein = totalProtein.toFixed(1);
        var roundedFat = totalFat.toFixed(1);

        $('#nutrition-result').text(`Total Intake - Calories: ${roundedCal} cal, Carbs: ${roundedCarbs} g, Protein: ${roundedProtein} g, Fat: ${roundedFat} g`);

        sendNutritionalValues(totalCal,totalCarbs, totalProtein, totalFat);
        
    }

    // Click event handler for saving total values button
    function validateBackEnd() {
        if (totalCal===0 || totalCarbs===0 || totalProtein===0 || totalFat===0 ) {
            showToast('You need to add a food and its nutritional values to be able to log','red');   
        }
        else  {
         saveTotalValuesToBackend();
        }
    }

    // Function to send total nutritional values to backend
    function saveTotalValuesToBackend() {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: 'POST',
                url: '/log-nutritional-data', 
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                contentType: 'application/json',
                data: JSON.stringify({
                    calories: totalCal,
                    carbs: totalCarbs,
                    protein: totalProtein,
                    fat: totalFat
                }),
                success: function(response) {
                    if (response.success==true) {
                        console.log('Total values saved successfully:', response);  
                    showToast('Total nutritional values saved successfully!','green');
                    }
                    else if(response.success=="RecordExists")
                     showToast('It seems that you have already logged today, please try again the following day','red');
                    else showToast('Failed to save total nutritional values. Please try again.','red');
                    
                },
                error: function(error) {
                    console.error('Error saving total values:', error);
                    // Handle error, show appropriate message to user
                    showToast('Failed to save total nutritional values. Please try again.','red');
                }
            });
        }
    $(document).ready(function() {
        $('#nutrition-form').on('submit', function(event) {
            event.preventDefault();

            const food = $('#food-item-meal').val();
            const quantity = $('#quantity').val();
            const unit = $('#unit').val();
            const calories2 = parseInt($('#calories2').val()) || 0;
            const carbs = parseInt($('#carbs').val()) || 0;
            const protein = parseInt($('#protein').val()) || 0;
            const fat = parseInt($('#fat').val()) || 0;
            const category = $('#category').val();

            if (category) {
                fetchNutritionalInfo(food, category, quantity, unit);
            } else {
                logFoodItem(food, calories2, carbs, protein, fat);
            }

            $('#nutrition-form')[0].reset();
        });

        $(document).on('click', '.remove-food', function(event) {
            const foodItem = $(this).closest('li');

            const calories = parseFloat(foodItem.find('.calories').text().match(/\d+(\.\d+)?/)[0]);
            const carbs = parseFloat(foodItem.find('.carbs').text().match(/\d+(\.\d+)?/)[0]);
            const protein = parseFloat(foodItem.find('.protein').text().match(/\d+(\.\d+)?/)[0]);
            const fat = parseFloat(foodItem.find('.fat').text().match(/\d+(\.\d+)?/)[0]);

            totalCal -= calories;
            totalCarbs -= carbs;
            totalProtein -= protein;
            totalFat -= fat;

            // Round the values to 1 decimal place
            var roundedCal = totalCal.toFixed(1);
            var roundedCarbs = totalCarbs.toFixed(1);
            var roundedProtein = totalProtein.toFixed(1);
            var roundedFat = totalFat.toFixed(1);

            $('#nutrition-result').text(`Total Intake - Calories: ${roundedCal} cal, Carbs: ${roundedCarbs} g, Protein: ${roundedProtein} g, Fat: ${roundedFat} g`);

            const updateEvent = new CustomEvent('nutritionalValuesUpdated', { 
                detail: { cals:totalCal,carbs: totalCarbs, proteins: totalProtein,  fats: totalFat } 
            });
            document.dispatchEvent(updateEvent);

            foodItem.remove();
        });

        function sendNutritionalValues(cals,carbs, protein, fat) {
            const event = new CustomEvent('nutritionalValuesUpdated', { 
                detail: {cals:totalCal , carbs: carbs, proteins: protein,  fats: fat } 
            });
            document.dispatchEvent(event);
        }

        function logFoodItem(food, calories2, carbs, protein, fat) {
            const listItem = `
                <li class="p-4 bg-gray-200 rounded flex justify-between items-center">
                    <div>
                        <h3 class="text-md calories">Food: ${food} - Calories: ${calories2} cal</h3>
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

        // function fetchNutritionalInfo(food, category, quantity, unit) {
        //     const appId = '7ba1f1e8';
        //     const appKey = '0bfaa9370bce866584f689af21404aa2';
        //     const url = `https://api.edamam.com/api/recipes/v2?type=public&q=${food}&app_id=${appId}&app_key=${appKey}&category=${category}`;

        //     $.ajax({
        //         type: 'GET',
        //         url: url,
        //         success: function(response) {
        //             if (response.hits && response.hits.length > 0) {
        //                 const recipe = response.hits[0].recipe;
        //                 const calories = (recipe.calories * (quantity / recipe.yield)).toFixed(1);
        //                 const carbs = (recipe.totalNutrients.CHOCDF ? (recipe.totalNutrients.CHOCDF.quantity * (quantity / recipe.yield)).toFixed(1) : 0);
        //                 const protein = (recipe.totalNutrients.PROCNT ? (recipe.totalNutrients.PROCNT.quantity * (quantity / recipe.yield)).toFixed(1) : 0);
        //                 const fat = (recipe.totalNutrients.FAT ? (recipe.totalNutrients.FAT.quantity * (quantity / recipe.yield)).toFixed(1) : 0);

        //                 logFoodItem(food, calories, carbs, protein, fat);
        //             } else {
        //                 console.log('Nutritional information not found.');
        //             }
        //         },
        //         error: function(error) {
        //             console.error('Error fetching nutritional info:', error);
        //         }
        //     });
        // }
      
            function fetchNutritionalInfo(food, category, quantity, unit) {
                const appId = '11644371';
                const appKey = 'f77db8f356a217ef456686413e806c72';

                // Construct the request payload
                const payload = {
                    query: `${quantity} ${unit} ${food}`,
                    timezone: 'US/Eastern', // Adjust based on your timezone
                };

                $.ajax({
                    type: 'POST',
                    url: 'https://trackapi.nutritionix.com/v2/natural/nutrients',
                    headers: {
                        'x-app-id': appId,
                        'x-app-key': appKey,
                        'Content-Type': 'application/json'
                    },
                    data: JSON.stringify(payload),
                    success: function(response) {
                        const foods = response.foods;

                        if (foods.length > 0) {
                            const foodData = foods[0]; // Assuming only one food is returned

                            // Extract relevant nutrient values based on your needs
                            const nutrients = foodData.full_nutrients;
                            const calories = getNutrientValue(nutrients, 208); // Nutrient ID for Calories
                            const carbs = getNutrientValue(nutrients, 205); // Nutrient ID for Total Carbohydrate
                            const protein = getNutrientValue(nutrients, 203); // Nutrient ID for Protein
                            const fat = getNutrientValue(nutrients, 204); // Nutrient ID for Total Fat

                            logFoodItem(food, calories, carbs, protein, fat);
                        } else {
                            console.error('No food data found.');
                        }
                    },
                    error: function(error) {
                        console.error('Error fetching nutritional info:', error);
                    }
                });
            }

            // Helper function to extract nutrient value from full_nutrients array
            function getNutrientValue(nutrients, attrId) {
                const nutrient = nutrients.find(n => n.attr_id === attrId);
                return nutrient ? nutrient.value : 0;
            }


});

</script>

</body>
</html>
