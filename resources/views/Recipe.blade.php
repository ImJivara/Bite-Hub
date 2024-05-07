@extends('test3tem')

@section('content_body')

<!-- Recipe Details Section -->
<section class="max-w-screen-xl mx-auto px-4 py-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Recipe Image -->
        <div>
            <img class="w-full h-auto rounded-lg shadow-xl" src="{{ asset('imgs/'.$r->id.'.jpg') }}" alt="Recipe Image">
        </div>
        <!-- Recipe Information -->
        <div class="flex flex-col justify-center">
            <h1 class="text-4xl font-semibold mb-4">{{ $r->RecipeName }}</h1>
            <p class="text-lg text-gray-700 mb-4">{{ $r->Description }}</p>
            <div class="flex items-center mb-4">
                <span class="text-gray-600 mr-2">Rate this recipe:</span>
                <div class="flex">
                    @for ($i = 1; $i <= 5; $i++)
                    <button class="text-yellow-400 focus:outline-none" onclick="rateRecipe({{ $i }})">
                        @if ($i <= $r->rating)
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 filled-star" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l4 4m0 0l4-4m-4 4V4"></path>
                        </svg>
                        @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 empty-star" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l4 4m0 0l4-4m-4 4V4"></path>
                        </svg>
                        @endif
                    </button>
                    @endfor
                </div>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600 mr-2">Number of Ingredients:</span>
                <p class="text-lg font-semibold">{{ $r->NbIngredients }}</p> 
                <span class="text-gray-600 mr-2">Number of Steps:</span>
                <p class="text-lg font-semibold">{{ $r->Steps }}</p>   
                <span class="text-gray-600 mr-2">Number of Likes:</span>
                <p class="text-lg font-semibold">{{ $r->NbLikes }}</p>
                
                
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
                @foreach ($ing as $ingredient)
                <li class="text-lg text-gray-700">{{ $ingredient }}</li>
                @endforeach
            </ul>
        </div>
        <!-- steps  -->
        <div class="bg-white rounded-lg shadow-xl p-4 transition-transform duration-500 hover:transform hover:scale-105 hover:shadow-lg">
            <h2 class="text-2xl font-semibold mb-4">Steps</h2>
            <ol class="list-decimal list-inside">
                @foreach ($steps as $step)
                <li class="text-lg text-gray-700">{{ $step }}</li>
                @endforeach
            </ol>
        </div>


        
        <!-- nutritional info -->
        <div class="bg-white rounded-lg shadow-xl p-6 flex flex-col justify-between">
            <div>
                <h3 class="text-xl font-semibold mb-4">Nutritional Information</h3>
                <ul class="list-disc list-inside">
                    <li class="text-lg text-gray-700">Calories: 250</li>
                    <li class="text-lg text-gray-700">Protein: 10g</li>
                    <li class="text-lg text-gray-700">Fat 15g</li>
                    <li class="text-lg text-gray-700">Carbohydrates: 20g</li>
                    <li class="text-lg text-gray-700">Fiber: 5g</li>
                </ul>
            </div>
            <!-- comment section -->
            <div class="mt-8">
                <h3 class="text-xl font-semibold mb-4">Comments</h3>
                <div class="mb-4">
                    <!-- hun mnhut l comments -->
                    <div id="comment-placer"></div>
                            <x-comment/>
                            <x-comment/>
                            <x-comment/>
                            <x-comment/>
                            <x-comment/>
                            <x-comment/>
                            <x-comment/>
                    </div>
            </div>
            <div>
                <form id="commentForm">
                    @csrf
                    <input type="text" name="txt_comment" placeholder="Write your comment..." class="border border-gray-300 rounded-lg px-4 py-2 w-full focus:outline-none focus:border-blue-500">
                    <button type="button" id="submitcomment" class="bg-blue-500 text-white px-4 py-2 mt-4 rounded-lg hover:bg-blue-600 focus:outline-none">Publish</button>
                </form>
            </div>
        </div>
        <div>
            <img class="w-full h-auto rounded-lg shadow-xl" src="{{ asset('imgs/'.$r->id.'.jpg') }}" alt="Recipe Image">
        </div>
    </div>
</section>
<!-- End of Ingredients and Steps Section -->
<script>
        $(document).ready(function()
         {
            $("#submitcomment").click(function()
             {
                
               
                $.ajax
                ({  
                    success: function(output) 
                    {
                        // URL of the external HTML component
                        var externalComponentURL = "{{asset('\components\sidebar')}}";

                        // Element to which the external component will be appended
                        var targetElement = $('#comment-placer');

                        // Load the external HTML component and append it to the target element
                        targetElement.load(externalComponentURL);
                        
                    }
                })
            });
        });
    </script>

@endsection
