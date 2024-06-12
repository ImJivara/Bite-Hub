@extends('test3tem')

@section('content_body')

<!-- Recipe Details Section -->
<section class="max-w-screen-xl mx-auto px-4 py-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Recipe Image -->
        <div>
            @if($recipe[0]['image'])
                    <img class="w-full h-auto rounded-lg shadow-xl" src="{{ $recipe[0]['image'] }}" alt="{{ $recipe[0]['title'] }}" style="max-width: 100%;">
                @else
                    <img class="w-full h-auto rounded-lg shadow-xl" src="" alt="{{ $recipe['title'] }}" style="max-width: 100%;">
                @endif
        </div>
        <!-- Recipe Information -->
        <div class="flex flex-col justify-center">
            <div>
                <h1 class="text-4xl font-semibold mb-4">{{ $recipe[0]['title'] }}</h1>
                <p class="text-lg text-gray-700 mb-4">Ready in: {{ $recipe[0]['readyInMinutes'] }} minutes</p>
                <p class="text-lg text-gray-700 mb-4">Servings: {{ $recipe[0]['servings'] }}</p>
                <p class="text-lg text-gray-700 mb-4">{!! $recipe[0]['summary'] !!}</p>
                <div class="flex items-center mb-4">
                    <span class="text-gray-600 mr-2">Rate this recipe:</span>
                    <div class="flex">
                      
                    </div>
                </div>
                <div class="flex justify-between mb-4">
                    <div>
                        <span class="text-gray-600 mr-2">Number of Ingredients:</span>
                        <p class="text-lg font-semibold">{{ count($recipe[0]['extendedIngredients']) ?? 'Not available'  }}</p> 
                    </div>
                    <div>
                        <span class="text-gray-600 mr-2">Number of Steps:</span>
                        <p class="text-lg font-semibold">{{ count($recipe[0]['analyzedInstructions'][0]['steps']) ?? 'Not available' }}</p>   
                    </div>
                    <div>
                        <span class="text-gray-600 mr-2">Number of Likes:</span>
                        <p class="text-lg font-semibold"></p>
                    </div>
                </div>
            </div>
            <div class="Recipe-Pie-chart flex justify-center mt-4">
                <x-piecharts.piechart :Proteins="70" :Carbs="50" :Fats="20" />
            </div>
        </div>
    </div>
</section>

<!-- End of Recipe Details Section -->

<!-- Ingredients and Steps Section -->
<section class="max-w-screen-xl mx-auto px-4 py-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- ingredients  -->
        <div class="bg-white rounded-lg shadow-xl p-4 transition-transform duration-500 hover:transform hover:scale-105 hover:shadow-lg">
            <h2 class="text-2xl font-semibold mb-4">Ingredients</h2>
            <ul class="list-disc list-inside">               
                @foreach($recipe[0]['extendedIngredients'] as $ingredient)
                        <li class="text-lg text-gray-700">{{ $ingredient['amount'] }} {{ $ingredient['unit'] }} {{ $ingredient['name'] }}</li>
                @endforeach
            </ul>
        </div>
        <!-- steps  -->
        <div class="bg-white rounded-lg shadow-xl p-4 transition-transform duration-500 hover:transform hover:scale-105 hover:shadow-lg">
            <h2 class="text-2xl font-semibold mb-4">Steps</h2>
            <ol class="list-decimal list-inside">
                @foreach($recipe[0]['analyzedInstructions'][0]['steps'] as $step)
                        <li  class="text-lg text-gray-700">{{ $step['step'] }}</li>
                @endforeach
            </ol>
        </div>

        <!-- nutritional info -->
        <div class="bg-white rounded-lg shadow-xl p-6 flex flex-col justify-between ">
            <div>
                <h3 class="text-xl font-semibold mb-4">Nutritional Information</h3>
                <ul class="list-disc list-inside">
                        @foreach ($selected_nutritional_values as $nutritional_value)
                                @if (isset($nutritionalData[$nutritional_value]))
                                    <li class="text-lg text-gray-700">{{ ucfirst($nutritional_value) }}: {{ $nutritionalData[$nutritional_value] }}</p>
                                @else
                                    <li class="text-lg text-gray-700">{{ ucfirst($nutritional_value) }}: Not available</p>
                                @endif
                        @endforeach
                </ul>
            </div>
            
        
            </div>
            
        </div>
        <div>
            <img class="w-full h-auto rounded-lg shadow-xl" src="{{ $recipe[0]['image'] }}" alt="Recipe Image">
        </div>
    </div>
</section>
<!-- End of Ingredients and Steps Section -->


@endsection
