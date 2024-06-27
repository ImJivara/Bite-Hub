
@extends('test3tem')

@section('content_body')
<link rel="stylesheet" href="{{ asset('css/tailwindstyles.css') }}">
<div class="max-w-4xl mx-auto py-8 mt-">
    <h2 class="text-3xl font-bold mb-4">Add New Recipe</h2>

    <form action="{{ route('recipes.create') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
            <label for="RecipeName" class="block font-medium text-gray-700 text-xl">Recipe Name</label>
            <input type="text" id="RecipeName" name="RecipeName" value="{{ old('RecipeName') }}"
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('RecipeName') border-red-500 @enderror">
            @error('RecipeName')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="Description" class="block font-medium text-gray-700 text-xl">Description</label>
            <textarea id="Description" name="Description" rows="3" 
                      class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('Description') border-red-500 @enderror">{{ old('Description') }}</textarea>
            @error('Description')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="Health_Score" class="block font-medium text-gray-700 text-xl">Health Score</label>
            <input type="number" id="Health_Score" name="Health_Score" value="{{ old('Health_Score') }}" 
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('Health_Score') border-red-500 @enderror">
            @error('Health_Score')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="cooking_time" class="block font-medium text-gray-700 text-xl">Cooking Time (minutes)</label>
            <input type="number" id="cooking_time" name="cooking_time" value="{{ old('cooking_time') }}" 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('cooking_time') border-red-500 @enderror">
            @error('cooking_time')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="preparation_time" class="block font-medium text-gray-700 text-xl">Preparation Time (minutes)</label>
                <input type="number" id="preparation_time" name="preparation_time" value="{{ old('preparation_time') }}" 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('preparation_time') border-red-500 @enderror">
            @error('preparation_time')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="difficulty_level" class="block font-medium text-gray-700 text-xl">Difficulty Level</label>
            <select id="difficulty_level" name="difficulty_level"  class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('difficulty_level') border-red-500 @enderror">>
                <option value="Easy" {{ old('difficulty_level') == 'Easy' ? 'selected' : '' }}>Easy</option>
                <option value="Medium" {{ old('difficulty_level') == 'Medium' ? 'selected' : '' }}>Medium</option>
                <option value="Hard" {{ old('difficulty_level') == 'Hard' ? 'selected' : '' }}>Hard</option>
            </select>
            @error('difficulty_level')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
         </div>

        <hr>

    <div id="stepsContainer">
        <label class="block font-medium text-gray-700 text-xl">Steps</label>
        <div id="stepsList">
            <div class="flex items-center space-x-2 mb-2">
                <input type="text" name="steps[]" placeholder="Step 1" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <button type="button" id="addStepBtn" class="btn-add-step bg-indigo-500 text-white px-3 py-2 rounded-md focus:outline-none">+</button>
            </div>
        </div>
    </div>

        <hr>

        <div id="ingredientsContainer">
        <label class="block font-medium text-gray-700 text-xl">Ingredients</label>
        <div id="ingredientsList">
            <div class="flex items-center space-x-2 mb-2">
                <input type="text" name="ingredients[0][name]" placeholder="Ingredient Name" 
                       class="w-1/3 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <input type="number" step="any" name="ingredients[0][amount]" placeholder="Amount" 
                       class="w-1/3 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <input type="text" name="ingredients[0][unit]" placeholder="Unit" 
                       class="w-1/3 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <button type="button" id="addIngredientBtn" class="btn-add-ingredient bg-indigo-500 text-white px-3 py-2 rounded-md focus:outline-none">+</button>
            </div>
        </div>
    </div>
    <div class="flex flex-wrap space-x-4">
        <div class="flex-1">
            <label for="calories" class="block font-medium text-gray-700 text-center ">Calories</label>
            <input type="text" id="calories" name="calories" value="{{ old('calories') }}"
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('calories') border-red-500 @enderror">
            @error('calories')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex-1">
            <label for="carbs" class="block font-medium text-gray-700 text-center">Carbohydrates</label>
            <input type="text" id="carbs" name="carbs" value="{{ old('carbs') }}" placeholder="grams"
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('carbs') border-red-500 @enderror">
            @error('carbs')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex-1">
            <label for="fat" class="block font-medium text-gray-700 text-center">Fat</label>
            <input type="text" id="fat" name="fat" value="{{ old('fat') }}" placeholder="grams"
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('fat') border-red-500 @enderror">
            @error('fat')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex-1">
            <label for="protein" class="block font-medium text-gray-700 text-center">Protein</label>
            <input type="text" id="protein" name="protein" value="{{ old('protein') }}" placeholder="grams"
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('protein') border-red-500 @enderror">
            @error('protein')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
    </div>

        <div>
            <label for="Category" class="block font-medium text-gray-700 text-xl">Category</label>
            <input type="text" id="Category" name="Category" value="{{ old('Category') }}"
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('Category') border-red-500 @enderror">
            @error('Category')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>w

        <div>
            <div class="flex items-center space-x-2 mb-2">
                <div> 
                    <label for="thumbnail" class="block font-medium text-gray-700 text-xl">Thumbnail</label>
                    <div class="flex items-center space-x-2 mb-2">
                        <input type="file" id="thumbnail" name="thumbnail" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('thumbnail') border-red-500 @enderror">
                       <a href="/image-search-form">
                         <span class="block font-medium text-gray-700 text-xl text-center text-bold 
                         transition-transform duration-300 hover:transform hover:scale-110 ">Try our <span class="text-red-500 " >New </span>Image Search Engine</span>
                        </a>
                </div>
            </div>
                @error('thumbnail')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
         @enderror
            
        </div>

       
            <button type="submit" class="recipe-form-submit bg-green-500 text-white py-2 px-4 rounded-lg shadow-lg hover:bg-green-200 transition duration-300 ease-in-out text-xl">
            Add Recipe
            </button>
       
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let stepCount = 1;
        let ingredientCount = 1;

        document.querySelector('#stepsContainer').addEventListener('click', function (event) {
            if (event.target.classList.contains('btn-add-step')) {
                event.preventDefault();
                addStep();
            } else if (event.target.classList.contains('btn-remove-step')) {
                event.preventDefault();
                removeStep(event.target);
            }
        });

        document.querySelector('#ingredientsContainer').addEventListener('click', function (event) {
            if (event.target.classList.contains('btn-add-ingredient')) {
                event.preventDefault();
                addIngredient();
            } else if (event.target.classList.contains('btn-remove-ingredient')) {
                event.preventDefault();
                removeIngredient(event.target);
            }
        });

        function addStep() {
            stepCount++;
            const stepsList = document.querySelector('#stepsList');
            const newStep = document.createElement('div');
            newStep.className = 'flex items-center space-x-2 mb-2';
            newStep.innerHTML = `
                <input type="text" name="steps[]" placeholder="Step ${stepCount}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <button type="button" class="btn-remove-step bg-red-500 text-white px-3 py-2 rounded-md focus:outline-none">-</button>
            `;
            stepsList.appendChild(newStep);
        }

        function removeStep(button) {
            const stepDiv = button.parentNode;
            stepDiv.parentNode.removeChild(stepDiv);
            stepCount--;
        }

        function addIngredient() {
            ingredientCount++;
            const ingredientsList = document.querySelector('#ingredientsList');
            const newIngredient = document.createElement('div');
            newIngredient.className = 'flex items-center space-x-2 mb-2';
            newIngredient.innerHTML = `
                <input type="text" name="ingredients[${ingredientCount}][name]" placeholder="Ingredient" class="w-1/2 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <input type="number" name="ingredients[${ingredientCount}][amount]" placeholder="Amount" class="w-1/4 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <input type="text" name="ingredients[${ingredientCount}][unit]" placeholder="Unit" class="w-1/4 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <button type="button" class="btn-remove-ingredient bg-red-500 text-white px-3 py-2 rounded-md focus:outline-none">-</button>
            `;
            ingredientsList.appendChild(newIngredient);
        }

        function removeIngredient(button) {
            const ingredientDiv = button.parentNode;
            ingredientDiv.parentNode.removeChild(ingredientDiv);
            ingredientCount--;
        }
    });
</script>

@endsection