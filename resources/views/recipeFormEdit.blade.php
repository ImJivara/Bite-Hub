@extends('test3tem')

@section('content_body')
<link rel="stylesheet" href="{{ asset('css/tailwindstyles.css') }}">
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<div class="max-w-4xl mx-auto py-8 mt-">
    <h2 class="text-3xl font-bold mb-4">Edit Recipe</h2>

    <form action="{{ route('recipes.update', $recipe->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
            <label for="RecipeName" class="block font-medium text-gray-700 text-xl">Recipe Name</label>
            <input type="text" id="RecipeName" name="RecipeName" value="{{ old('RecipeName', $recipe->RecipeName) }}"
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('RecipeName') border-red-500 @enderror">
            @error('RecipeName')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="Description" class="block font-medium text-gray-700 text-xl">Description</label>
            <textarea id="Description" name="Description" rows="3" 
                      class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('Description') border-red-500 @enderror">{{ old('Description', $recipe->Description) }}</textarea>
            @error('Description')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="Health_Score" class="block font-medium text-gray-700 text-xl">Health Score</label>
            <input type="number" id="Health_Score" name="Health_Score" value="{{ old('Health_Score', $recipe->Health_Score) }}" 
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('Health_Score') border-red-500 @enderror">
            @error('Health_Score')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="cooking_time" class="block font-medium text-gray-700 text-xl">Cooking Time (minutes)</label>
            <input type="number" id="cooking_time" name="cooking_time" value="{{ old('cooking_time', $recipe->cooking_time) }}" 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('cooking_time') border-red-500 @enderror">
            @error('cooking_time')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="preparation_time" class="block font-medium text-gray-700 text-xl">Preparation Time (minutes)</label>
                <input type="number" id="preparation_time" name="preparation_time" value="{{ old('preparation_time', $recipe->preparation_time) }}" 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('preparation_time') border-red-500 @enderror">
            @error('preparation_time')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="difficulty_level" class="block font-medium text-gray-700 text-xl">Difficulty Level</label>
            <select id="difficulty_level" name="difficulty_level"  class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('difficulty_level') border-red-500 @enderror">
                <option value="Easy" {{ old('difficulty_level', $recipe->difficulty_level) == 'Easy' ? 'selected' : '' }}>Easy</option>
                <option value="Medium" {{ old('difficulty_level', $recipe->difficulty_level) == 'Medium' ? 'selected' : '' }}>Medium</option>
                <option value="Hard" {{ old('difficulty_level', $recipe->difficulty_level) == 'Hard' ? 'selected' : '' }}>Hard</option>
            </select>
            @error('difficulty_level')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
         </div>

        <hr>

        <div id="stepsContainer">
    <label class="block font-medium text-gray-700 text-xl">Steps</label>
    <div id="stepsList">
        @foreach(old('steps', $recipe->steps_details ? json_decode($recipe->steps_details, true) : []) as $indexx => $step)
        
            <div class="flex items-center space-x-2 mb-2">
                <input type="text" name="steps[]" value="{{ $step }}" placeholder="Step {{ $indexx + 1  }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            @if ($indexx === 0)
                 <button type="button" id="addStepBtn" class="btn-add-step bg-indigo-500 text-white px-3 py-2 rounded-md focus:outline-none">+</button>
            @else
                <button type="button" class="btn-remove-step bg-red-500 text-white px-3 py-2 rounded-md focus:outline-none">-</button>
            @endif          
          </div>
        @endforeach
        
    </div>
</div>

<hr>

    <div id="ingredientsContainer">
        <label class="block font-medium text-gray-700 text-xl">Ingredients</label>
        <div id="ingredientsList">
        @foreach(old('ingredients', $recipe->ingredients_details ? json_decode($recipe->ingredients_details, true) : []) as $index => $ingredient)
            <div class="flex items-center space-x-2 mb-2">
                <input type="text" name="ingredients[{{ $index }}][name]" value="{{ $ingredient['name'] ?? ''}}" placeholder="Ingredient Name" 
                    class="w-1/3 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <input type="number" step="any" name="ingredients[{{ $index }}][amount]" value="{{ $ingredient['amount'] ?? '' }}" placeholder="Amount" 
                    class="w-1/3 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <input type="text" name="ingredients[{{ $index }}][unit]" value="{{ $ingredient['unit'] ?? '' }}" placeholder="Unit" 
                    class="w-1/3 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @if ($index === 0)
                    <button type="button" id="addIngredientBtn" class="btn-add-ingredient bg-indigo-500 text-white px-3 py-2 rounded-md focus:outline-none">+</button>
                @else
                    <button type="button" class="btn-remove-ingredient bg-red-500 text-white px-3 py-2 rounded-md focus:outline-none">-</button>
                @endif
            </div>
        @endforeach
    
    </div>

</div>


    <hr>
    
    <div>
    <label for="calories" class="block font-medium text-gray-700 text-xl">Calories</label>
    <input type="number" id="calories" name="calories" value="{{ old('calories', optional($recipe->nutritionalData)->calories ?? '') }}" 
           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('calories') border-red-500 @enderror">
    @error('calories')
        <span class="text-red-500">{{ $message }}</span>
    @enderror
</div>
<div>
    <label for="carbs" class="block font-medium text-gray-700 text-xl">Carbohydrates (grams)</label>
    <input type="text" id="carbs" name="carbs" value="{{ old('carbs', optional($recipe->nutritionalData)->carbs ?? '') }}" 
           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('carbs') border-red-500 @enderror">
    @error('carbs')
        <span class="text-red-500">{{ $message }}</span>
    @enderror
</div>
<div>
    <label for="fat" class="block font-medium text-gray-700 text-xl">Fat (grams)</label>
    <input type="text" id="fat" name="fat" value="{{ old('fat', optional($recipe->nutritionalData)->fat ?? '') }}" 
           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('fat') border-red-500 @enderror">
    @error('fat')
        <span class="text-red-500">{{ $message }}</span>
    @enderror
</div>
<div>
    <label for="protein" class="block font-medium text-gray-700 text-xl">Protein (grams)</label>
    <input type="text" id="protein" name="protein" value="{{ old('protein', optional($recipe->nutritionalData)->protein ?? '') }}" 
           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('protein') border-red-500 @enderror">
    @error('protein')
        <span class="text-red-500">{{ $message }}</span>
    @enderror
</div>

      
        <hr>
        <div>
            <label for="Category" class="block font-medium text-gray-700 text-xl">Category</label>
            <input type="text" id="Category" name="Category" value="{{ old('Category', $recipe->Category) }}" 
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('Category') border-red-500 @enderror">
            @error('Category')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="thumbnail" class="block font-medium text-gray-700 text-xl">Thumbnail</label>
            <input type="file" id="thumbnail" name="thumbnail" 
                   class="mt-1 block w-full text-gray-500 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('thumbnail') border-red-500 @enderror">
            @if ($recipe->thumbnail)
                <img src="{{ asset('storage/' . $recipe->thumbnail) }}" alt="Recipe Thumbnail" class="mt-2 w-32 h-32 object-cover">
            @endif
            @error('thumbnail')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Update Recipe</button>
    </form>
</div>

<script>
 let stepCount = 0;
    document.getElementById('addStepBtn').addEventListener('click', function () {
        stepCount++;
        var stepsList = document.getElementById('stepsList');
        var newStep = document.createElement('div');
        newStep.classList.add('flex', 'items-center', 'space-x-2', 'mb-2');
        newStep.innerHTML = `
            <input type="text" name="steps[]" placeholder="Steps ${stepCount}" 
                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <button type="button" class="btn-remove-step bg-red-500 text-white px-3 py-2 rounded-md focus:outline-none">-</button>
        `;
        stepsList.appendChild(newStep);
    });

    document.getElementById('stepsList').addEventListener('click', function (e) {
        if (e.target.classList.contains('btn-remove-step')) {
            e.target.parentElement.remove();
        }
    });

</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    var ingredientsList = document.getElementById('ingredientsList');
    var nextIndex = ingredientsList.childElementCount; // Start index based on existing ingredients count

    document.getElementById('addIngredientBtn').addEventListener('click', function () {
        addNewIngredient(nextIndex++);
    });

    ingredientsList.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('btn-remove-ingredient')) {
            e.target.parentElement.remove();
        }
    });

    function addNewIngredient(index) {
        var newIngredient = document.createElement('div');
        newIngredient.classList.add('flex', 'items-center', 'space-x-2', 'mb-2');
        newIngredient.innerHTML = `
            <input type="text" name="ingredients[${index}][name]" placeholder="Ingredient Name" 
                   class="w-1/3 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <input type="number" step="any" name="ingredients[${index}][amount]" placeholder="Amount" 
                   class="w-1/3 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <input type="text" name="ingredients[${index}][unit]" placeholder="Unit" 
                   class="w-1/3 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <button type="button" class="btn-remove-ingredient bg-red-500 text-white px-3 py-2 rounded-md focus:outline-none">-</button>
        `;
        ingredientsList.appendChild(newIngredient);
    }
});

</script>
@endsection
