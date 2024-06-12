<!-- resources/views/recipes.blade.php -->

    <div class="container">
        <h1>Recipes</h1>
        @foreach($recipes as $recipe)
        <h1>Recipe Information</h1>
            <ul>
                <li>Preparation Time: {{ $recipe['preparationMinutes'] ?? 'Not available' }} minutes</li>
                <li>Cooking Time: {{ $recipe['cookingMinutes'] ?? 'Not available' }} minutes</li>
                <li>Vegetarian: {{ $recipe['vegetarian'] ? 'Yes' : 'No' }}</li>
                <li>Vegan: {{ $recipe['vegan'] ? 'Yes' : 'No' }}</li>
                <li>Gluten Free: {{ $recipe['glutenFree'] ? 'Yes' : 'No' }}</li>
                <li>Dairy Free: {{ $recipe['dairyFree'] ? 'Yes' : 'No' }}</li>
                <li>Very Healthy: {{ $recipe['veryHealthy'] ? 'Yes' : 'No' }}</li>
                <li>Cheap: {{ $recipe['cheap'] ? 'Yes' : 'No' }}</li>
                <li>Ingredients {{ count($recipe['extendedIngredients']) ?? 'Not available'  }}</li>  
                <li>Instructions {{ count($recipe['analyzedInstructions'][0]['steps']) ?? 'Not available' }}</li>

            </ul>


            <div class="recipe">
                <h2>{{ $recipe['title'] }}</h2>
                <p>Ready in: {{ $recipe['readyInMinutes'] }} minutes</p>
                <p>Servings: {{ $recipe['servings'] }}</p>
                @if($recipe['image'])
                    <img src="{{ $recipe['image'] }}" alt="{{ $recipe['title'] }}" style="max-width: 100%;">
                @else
                    <img src="" alt="{{ $recipe['title'] }}" style="max-width: 100%;">
                @endif

                <h3>Ingredients</h3>
                <ul>
                    @foreach($recipe['extendedIngredients'] as $ingredient)
                        <li>{{ $ingredient['amount'] }} {{ $ingredient['unit'] }} {{ $ingredient['name'] }}</li>
                    @endforeach
                </ul>

                <h3>Instructions</h3>
                <ol>
                    @foreach($recipe['analyzedInstructions'][0]['steps'] as $step)
                        <li>{{ $step['step'] }}</li>
                    @endforeach
                </ol>
                <h1>Recipe Nutritional Information</h1>
                    @foreach ($selected_nutritional_values as $nutritional_value)
                        @if (isset($nutritionalData[$nutritional_value]))
                            <p>{{ ucfirst($nutritional_value) }}: {{ $nutritionalData[$nutritional_value] }}</p>
                        @else
                            <p>{{ ucfirst($nutritional_value) }}: Not available</p>
                        @endif
                    @endforeach


                <h3>Summary</h3>
                <p>{!! $recipe['summary'] !!}</p>

                <p>Health Score: {{ $recipe['healthScore'] }}</p>

                <!-- Add other details you want to display -->

                <a href="{{ $recipe['sourceUrl'] }}" target="_blank">Source: {{ $recipe['sourceName'] }}</a>
            </div>
            <hr>
        @endforeach
    </div>

