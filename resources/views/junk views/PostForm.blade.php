@extends('test3tem')
@section('content_body')

<!-- Recipe Submission Form -->
<div class="max-w-screen-xl mx-auto px-4 py-8 bg-gray-200 rounded-lg shadow-lg">
    <div class="flex justify-center">
        <div class="w-full max-w-lg">
            <h2 class="text-3xl font-bold text-gray-900 mb-6 text-center">Submit Your Recipe</h2>
            <form action="/submit-recipe" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <!-- Recipe Name -->
                <div>
                    <label for="recipeName" class="block text-sm font-bold text-gray-700">Recipe Name</label>
                    <input type="text" name="recipeName" id="recipeName" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-bold text-gray-700">Description</label>
                    <textarea name="description" id="description" rows="3" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                </div>
                <!-- Steps -->
                <div>
                    <label for="steps" class="block text-sm font-bold text-gray-700">Steps</label>
                    <textarea name="steps" id="steps" rows="5" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                </div>
                <!-- Steps Details -->
                <div>
                    <label for="stepsDetails" class="block text-sm font-bold text-gray-700">Steps Details</label>
                    <input type="text" name="stepsDetails" id="stepsDetails" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <!-- Number of Ingredients -->
                <div>
                    <label for="nbIngredients" class="block text-sm font-bold text-gray-700">Number of Ingredients</label>
                    <input type="number" name="nbIngredients" id="nbIngredients" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <!-- Ingredients Details -->
                <div>
                    <label for="ingredientsDetails" class="block text-sm font-bold text-gray-700">Ingredients Details</label>
                    <input type="text" name="ingredientsDetails" id="ingredientsDetails" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <!-- Difficulty Level -->
                <div>
                    <label for="difficultyLevel" class="block text-sm font-bold text-gray-700">Difficulty Level</label>
                    <select name="difficultyLevel" id="difficultyLevel" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="easy">Easy</option>
                        <option value="moderate">Moderate</option>
                        <option value="challenging">Challenging</option>
                    </select>
                </div>
                <!-- Thumbnail Image -->
                <div>
                    <label for="thumbnail" class="block text-sm font-bold text-gray-700">Thumbnail Image</label>
                    <input type="file" name="thumbnail" id="thumbnail" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <!-- Submit Button -->
                <div>
                    <button type="submit" class="w-full flex justify-center py-3 px-6 border border-transparent rounded-md shadow-sm text-sm font-bold text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Submit Recipe
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Recipe Submission Form -->




@endsection 