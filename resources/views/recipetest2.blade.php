<div class="container">
    <h1>Recipes</h1>
    @foreach($recipes as $recipe)
        <div class="recipe">
            <h2>{{ $recipe->RecipeName }}</h2>
            <p>Preparation Time: {{ $recipe->preparation_time ?? 'Not available' }} minutes</p>
            <p>Cooking Time: {{ $recipe->cooking_time ?? 'Not available' }} minutes</p>
            <p>Vegetarian: {{ $recipe->vegetarian ? 'Yes' : 'No' }}</p>
            <p>Vegan: {{ $recipe->vegan ? 'Yes' : 'No' }}</p>
            <p>Gluten Free: {{ $recipe->gluten_free ? 'Yes' : 'No' }}</p>
            <p>Dairy Free: {{ $recipe->dairy_free ? 'Yes' : 'No' }}</p>
            <p>Very Healthy: {{ $recipe->very_healthy ? 'Yes' : 'No' }}</p>
            <p>Cheap: {{ $recipe->cheap ? 'Yes' : 'No' }}</p>
            <p>Ingredients: {{ $recipe->NbIngredients ?? 'Not available' }}</p>
            <p>Instructions: {{ $recipe->Steps ? count(json_decode($recipe->Steps, true)) : 'Not available' }}</p>
            <img src="{{ $recipe->thumbnail }}" alt="{{ $recipe->RecipeName }}" style="max-width: 100%;">

            <h3>Ingredients</h3>
            <ul>
                @foreach(json_decode($recipe->ingredients_details, true) as $ingredient)
                    <li>{{ $ingredient['amount'] }} {{ $ingredient['unit'] }} {{ $ingredient['name'] }}</li>
                @endforeach
            </ul>

            <h3>Instructions</h3>
            <ol>
                @foreach(json_decode($recipe->steps_details, true) as $step)
                    <li>{{ $step['step'] }}</li>
                @endforeach
            </ol>

            <h3>Recipe Nutritional Information</h3>
            <p>Calories: {{ $recipe->nutritionalData->calories ?? 'Not available' }}</p>
            <p>Carbs: {{ $recipe->nutritionalData->carbs ?? 'Not available' }}</p>
            <p>Fat: {{ $recipe->nutritionalData->fat ?? 'Not available' }}</p>
            <p>Protein: {{ $recipe->nutritionalData->protein ?? 'Not available' }}</p>
            <p>Bad: {{ $recipe->nutritionalData->bad ?? 'Not available' }}</p>
            <p>Good: {{ $recipe->nutritionalData->good ?? 'Not available' }}</p>
            <p>Nutrients: {{ $recipe->nutritionalData->nutrients ?? 'Not available' }}</p>

            <h3>Summary</h3>
            <p>{!! $recipe->Description !!}</p>

            <p>Health Score: {{ $recipe->Health_Score }}</p>

            <a href="{{ $recipe->sourceUrl }}" target="_blank">Source: {{ $recipe->sourceName }}</a>
        </div>
        <hr>
    @endforeach
</div>
