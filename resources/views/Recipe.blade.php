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
            <div>
                <h1 class="text-4xl font-semibold mb-4">{{ $r->RecipeName }}</h1>
                <p class="text-lg text-gray-700 mb-4">{{ $r->Description }}</p>
                <div class="flex items-center mb-4">
                    <span class="text-gray-600 mr-2">Rate this recipe:</span>
                    <div class="flex">
                        @for ($i = 1; $i <= 5; $i++) <button class="text-yellow-400 focus:outline-none" onclick="rateRecipe({{ $i }})">
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
                <div class="flex justify-between mb-4">
                    <div>
                        <span class="text-gray-600 mr-2">Number of Ingredients:</span>
                        <p class="text-lg font-semibold">{{ $r->NbIngredients }}</p>
                    </div>
                    <div>
                        <span class="text-gray-600 mr-2">Number of Steps:</span>
                        <p class="text-lg font-semibold">{{ $r->Steps }}</p>
                    </div>
                    <div>
                        <span class="text-gray-600 mr-2">Number of Likes:</span>
                        <p class="text-lg font-semibold">{{ $r->NbLikes }}</p>
                    </div>
                </div>
            </div>
            <div class="Recipe-Pie-chart flex justify-center mt-4">
                <x-piecharts.piechart :Proteins="  str_replace('g', '', $r->nutritionalData->protein) " :Carbs=" str_replace('g', '', $r->nutritionalData->carbs)" :Fats=" str_replace('g', '', $r->nutritionalData->fat)" />
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
            <ul>
                @foreach ($ing as $ingredient)
                <li class="text-lg text-gray-700">{{ $ingredient['amount'] }} {{ $ingredient['unit'] }} {{ $ingredient['name'] }}</li>
                @endforeach
            </ul>
        </div>
        <!-- steps  -->
        <div class="bg-white rounded-lg shadow-xl p-4 transition-transform duration-500 hover:transform hover:scale-105 hover:shadow-lg">
            <h2 class="text-2xl font-semibold mb-4">Steps</h2>
                <!-- steps  -->
                 {{$steps}}
        </div>
    </div>
</section>
<!-- End of Ingredients and Steps Section -->

<!-- Nutritional Information and Comments Section -->
<section class="max-w-screen-xl mx-auto px-4 py-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Nutritional Information -->
        <div class="bg-white rounded-lg shadow-xl p-6">
            <h3 class="text-xl font-semibold mb-4">Nutritional Information</h3>
            @if ($r->nutritionalData)
            <ul class="list-disc list-inside">
                <li class="text-lg text-gray-700">Calories: {{ $r->nutritionalData->calories }}</li>
                <li class="text-lg text-gray-700">Carbs: {{ $r->nutritionalData->carbs }}</li>
                <li class="text-lg text-gray-700">Fat: {{ $r->nutritionalData->fat }}</li>
                <li class="text-lg text-gray-700">Protein: {{ $r->nutritionalData->protein }}</li>
            </ul>
            @else
            <p>No nutritional data available</p>
            @endif
            <!-- Comments Section -->

            <h3 class="text-xl font-semibold mb-4">Comments</h3>
            <div class="mb-4">
                <!-- Comments -->
                <div id="comment-placer"></div>
                @if(!$comments)
                <h2 class="text-3xl font-semibold">Oops Looks Empty</h1>
                    @else
                    @foreach ($comments as $comment)
                    <x-comment :comment="$comment" />
                    @endforeach
                    @endif
            </div>

            <!-- Comment Form -->
            @if (!Auth::user())
            <div class="flex items-center justify-between">
                <h1 class="text-l font-semibold text-red-500">You should be signed in as a user to comment</h1>
                <a href="/Login" style="color:#DD0525; font-weight: bolder;">Login</a>
            </div>
            @else
            <h5>Add a Comment</h5>
            <form action="{{ route('comments.store') }}" method="POST">
                @csrf
                <input type="hidden" name="recipe_id" value="{{ $r->id }}">
                <div class="form-group">
                    <input type="text" name="body" placeholder="Your comment" id="commentInput" maxlength="300" class="border border-gray-300 rounded-lg px-4 py-2 w-full focus:outline-none 
                    focus:border-red-500" value="{{ $body->value ?? '' }}">
                    <p id="charCount" class="text-xs text-gray-500 mt-1">0 / 300 characters</p>
                </div>
                <button type="submit" class="bg-red-500 text-white px-4 py-2 mt-4 rounded-lg hover:bg-red-600 focus:outline-none">Submit</button>
            </form>
            <script>
                const commentInput = document.getElementById('commentInput');
                const charCount = document.getElementById('charCount');
                commentInput.addEventListener('input', function() {
                    const length = commentInput.value.length;
                    charCount.textContent = length + ' / 300 characters';
                });
            </script>
            @endif
        </div>

        <!-- Image beside Nutritional Information -->
        <div>
            <img class="w-full h-auto rounded-lg shadow-xl" src="{{ asset('imgs/'.$r->id.'.jpg') }}" alt="Recipe Image">
        </div>
    </div>



</section>

@endsection