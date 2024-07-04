@extends('test3tem')

@section('content_body')
<style>
    .nutrient-bar {
        height: 20px;
        display: flex;
        align-items: center;
        color: white;
        border-radius: 5px;
        font-weight: bold;
        margin-bottom: 4px;
    }

    .nutrient-label {
        margin-bottom: 4px;
        font-weight: bold;
    }
</style>
</head>
<!-- Recipe Details Section -->
<section class="max-w-screen-xl mx-auto px-4 py-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Recipe Image -->
         
        <div>
            <img class="w-full h-auto rounded-lg shadow-xl" src="{{asset('storage/' . $r->thumbnail)}}" alt="Recipe Image">
        </div>
        <!-- Recipe Information -->
        <div class="flex flex-col justify-center ">
            <div class="w-18 mb-4">   
            <x-extracomponents.Backbtn To="" Url="{{url()->previous()}}"/>

            </div>

            @if (Auth::user() && Auth::user()->id==$r->author->id)
                <div class="relative inline-block text-left">
                    <div>
                        <button id="options-menu" aria-haspopup="true" aria-expanded="true" 
                                class="absolute top-2 right-2 inline-flex justify-end w-8 h-8 rounded-lg border border-gray-300 shadow-sm p-1 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12h.01M12 12h.01M18 12h.01"></path>
                            </svg>
                        </button>
                    </div>
                    <div id="dropdown-menu" class="origin-top-right absolute right-0 mt-10 w-60 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none hidden">
                        <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                            <a href="{{ route('recipes.edit', $r->id) }}" class="block px-4 py-2 text-md text-blue-500 hover:bg-gray-100 " role="menuitem">Edit Post</a>
                        </div>
                        <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                            <button onclick="deleteRecipe('{{$r->id}}')" class="block px-4 py-2 text-md text-gray-700 text-red-500 hover:bg-gray-100 w-full text-left" role="menuitem">Delete Post</buttom>
                        </div>
                    </div>
                </div>
            @endif
            <div class="flex items-center space-x-4 mb-6">
                <div class="relative w-16 h-16 rounded-full overflow-hidden bg-gray-200">
                    <img class="absolute inset-0 w-full h-full object-cover" src="{{ asset('profileimgs/' . $r->author->profile_picture) }}" alt="Profile Picture">
                </div>
                <div>
                    <a href="/profile/{{$r->author->id}}" class="text-3xl font-semibold text-blue-500 hover:underline">
                        <span class="capitalize"> {{ $r->author->name }} </span>
                    </a>
                    <p class="text-gray-600 text-lg">Username: {{ $r->author->username }}</p>
                </div>
            </div>

            <div class="grid content-between mb-4">
                <div>
                    <h1 class="text-4xl font-semibold mb-4">{{ $r->RecipeName }}</h1>
                    <p class="text-xl text-gray-700 mb-4">{{ $r->Description }}</p>
                </div>
                <div class="flex justify-between mb-4">
                    <div>
                        <span class="text-gray-600 mr-2 text-xl"> Ingredients:</span>
                        <p class="text-lg font-semibold">{{ $r->NbIngredients }}</p>
                    </div>
                    <div>
                        <span class="text-gray-600 mr-2 text-xl"> Steps:</span>
                        <p class="text-lg font-semibold">{{ $r->Steps }}</p>
                    </div>
                    <div>
                        <span class="text-gray-600 mr-2 text-xl"> Likes:</span>
                        <p class="text-lg font-semibold"><span id="txt_{{ $r->id }}">{{ $r->NbLikes }}</span></p>
                    </div>
                    <div>
                        @if (!is_null($r->difficulty_level))
                        <span class="text-gray-600 mr-2 text-xl">Difficulty level:</span>
                        <p class="text-lg font-semibold">{{ $r->difficulty_level }}</p>
                        @endif
                    </div>
                    <div>
                        @if (!is_null($r->cooking_time))
                        <span class="text-gray-600 mr-2 text-xl">Cooking Time:</span>
                        <p class="text-lg font-semibold">{{ $r->cooking_time }}</p>
                        @endif
                    </div>
                    <div>
                        @if (!is_null($r->preparation_time))
                        <span class="text-gray-600 mr-2 text-xl">Preparation time:</span>
                        <p class="text-lg font-semibold">{{ $r->preparation_time }}</p>
                        @endif
                    </div>
                </div>

                <div class="Likes-class flex justify-between">
                    @php
                    $likedRecipes = Auth::check() ? Auth::user()->likedRecipes->pluck('id')->toArray() : [];
                    @endphp

                    @if (in_array($r->id, $likedRecipes))
                    <x-extracomponents.modernlikebutton :recipeId="$r->id" :IsLiked="true" data-likebtn />
                    @else
                    <x-extracomponents.modernlikebutton :recipeId="$r->id" :IsLiked="false" data-likebtn />
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- End of Recipe Details Section -->

<!-- Ingredients and Steps Section -->
<section class="max-w-screen-xl mx-auto  px-4 py-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- ingredients  -->
        <div class="bg-white rounded-lg shadow-xl p-4 transition-transform duration-500 hover:transform hover:scale-105 hover:shadow-lg overflow-y-scroll max-h-96">
            <h2 class="text-2xl font-semibold mb-4">Ingredients</h2>
            <ol>
                @foreach ($ing as $ingredient)
                <li class="text-lg text-gray-700">{{ $ingredient['amount'] }} {{ $ingredient['unit'] }} {{ $ingredient['name'] }}</li>
                @endforeach
            </ol>
        </div>
        @php
        $r->steps_details = json_decode($r->steps_details, true);
        @endphp
        <!-- steps  -->
        <div class="bg-white rounded-lg shadow-xl p-4 transition-transform duration-500 hover:transform hover:scale-105 hover:shadow-lg overflow-y-scroll max-h-96 ">
            <h2 class="text-2xl font-semibold mb-4">Steps</h2>
            <ol class="list-decimal">
                @foreach ($r->steps_details as $index => $step)
                <p class="text-lg text-gray-700">
                <h3 class="text-xl font-semibold mb-2">Step {{ $index + 1 }}</h3>{{ $step }}</p>
                @endforeach
            </ol>
        </div>
    </div>
</section>
<!-- End of Ingredients and Steps Section -->

<!-- Nutritional Information and Comments Section -->
<section class="max-w-screen-xl mx-auto px-4 py-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Nutritional Information -->
        <div class="bg-white rounded-lg shadow-xl p-6 overflow-hidden">
            <div class="flex flex-col justify-between">
                <div class="Nutritional Information">
                    <h3 class="text-xl font-semibold mb-4">Nutritional Information</h3>
                    @if( $r->nutritionalData->nutrients)
                    <h3 class="text-xl font-semibold mb-4">Bad Nutrients and % Of Recommended Daily Needs</h3>
                    <div id="bad-nutrients" class="mb-8">
                        @forelse ($r->nutritionalData->bad as $nutrient)
                        <div class="mb-4">
                            <span class="nutrient-label">{{ $nutrient->title }}: {{ $nutrient->amount }} {{ $nutrient->percentOfDailyNeeds }}% </span>
                            <!-- {{ $nutrient->indented ? 'g' : '' }} -->
                            <div class="relative w-full bg-gray-200 rounded">
                                <div class="nutrient-bar bg-red-500" style="width: {{ $nutrient->percentOfDailyNeeds }}%;">
                                </div>
                            </div>
                        </div>
                        @empty
                        @endforelse
                    </div>
                    <div>
                        @php
                        $nutrients = collect($r->nutritionalData->nutrients)->map(function($nutrient) {
                        return [
                        'name' => $nutrient->name,
                        'amount' =>$nutrient->amount,
                        'unit' =>$nutrient->unit,
                        ];
                        });
                        @endphp
                        <!-- Placeholder for the pie chart -->
                        <x-piecharts.piechart :nutrients="$nutrients" placeholder="pie-chart-placeholder" />
                        @else
                        <ul class="list-disc list-inside">
                            <li class="text-lg text-gray-700">Calories: {{ $r->nutritionalData->calories }}</li>
                            <li class="text-lg text-gray-700">Carbs: {{ $r->nutritionalData->carbs }}</li>
                            <li class="text-lg text-gray-700">Fat: {{ $r->nutritionalData->fat }}</li>
                            <li class="text-lg text-gray-700">Protein: {{ $r->nutritionalData->protein }}</li>
                        </ul>
                        @endif
                    </div>
                </div>

                <div class="Comment-Form grid content-between ">
                    <!-- Comments Section -->
                    <div>
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
                    </div>
                    <!-- Comment Form -->
                    @if (!Auth::user())
                    <div class="flex items-center justify-between">
                        <h1 class="text-l font-semibold text-red-500">You should be signed in as a user to comment</h1>
                        <a href="/Login" style="color:#DD0525; font-weight: bolder;">Login</a>
                    </div>
                    @else
                    <div>
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
                    </div>
                    @endif
                </div>
            </div>
       
        @if ($r->nutritionalData->good)
        </div>
            <section>
                <div class="bg-white rounded-lg shadow-xl p-6 overflow-hidden">
                    
                        <h3 class="text-xl font-semibold mb-4">Good Nutrients % Of Recommended Daily Needs</h3>
                        <div id="good-nutrients">
                            @foreach ($r->nutritionalData->good as $nutrient)
                                <div class="mb-4">
                                    <span class="nutrient-label">{{ $nutrient->title }}: {{ $nutrient->amount }} {{ $nutrient->indented ? 'g' : '' }} {{ $nutrient->percentOfDailyNeeds }}%</span>
                                    <div class="relative w-full bg-gray-200 rounded">
                                        <div class="nutrient-bar bg-blue-500" style="width: {{ $nutrient->percentOfDailyNeeds }}%;"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                </div>
            </section>
        @else
            <div>     
                <x-piecharts.UserRecipePieChart
                    :Proteins=" str_replace('g', '', $r->nutritionalData->protein)"
                    :Carbs=" str_replace('g', '', $r->nutritionalData->carbs)"
                    :Fats=" str_replace('g', '', $r->nutritionalData->fat)"
                />
            </div>
        @endif
    </div>
</section>
<script>
    document.getElementById('options-menu').addEventListener('click', function() {
        let dropdownMenu = document.getElementById('dropdown-menu');
        dropdownMenu.classList.toggle('hidden');
    });

    document.addEventListener('click', function(event) {
        let dropdownMenu = document.getElementById('dropdown-menu');
        let optionsMenu = document.getElementById('options-menu');

        if (!optionsMenu.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });
</script>

    
<script>
function deleteRecipe(id) {
    $.ajax({
        url: '/recipes/' + id+ '/delete',  // Make sure this URL matches your delete route
        type: 'GET',
        data: {
            _token: '{{ csrf_token() }}'  // Include CSRF token for Laravel
        },
        success: function(response) {
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Deleted!',
                    text: response.message,
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.href = '{{ route("recipes.sorted") }}';
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: response.message,
                });
            }
        },
        error: function(xhr) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'An error occurred while trying to delete the recipe.',
            });
        }
    });
}
</script>

@endsection