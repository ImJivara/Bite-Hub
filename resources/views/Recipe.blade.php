@extends('test3tem')

@section('content_body')

<!-- Recipe Details Section -->
<section class="max-w-screen-xl mx-auto px-4 py-8">


    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Recipe Image -->
        <div>
            <img class="w-full h-auto rounded-lg shadow-xl" src="{{asset('storage/' . $r->thumbnail)}}" alt="Recipe Image">
        </div>
        <!-- Recipe Information -->
        <div class="flex flex-col justify-center">
            <div class="flex items-center space-x-4">
                <div class="relative w-16 h-16 rounded-full overflow-hidden bg-gray-200">
                    <img class="absolute inset-0 w-full h-full object-cover" src="{{ asset('profileimgs/'.$r->author->id.'.jpg') }}" alt="Profile Picture">
                </div>
                <div>
                    <a href="/profile/{{$r->author->id}}" class="text-3xl    font-semibold text-blue-500 hover:underline">
                        {{ $r->author->name }}
                    </a>
                    <p class="text-gray-600 text-lg">Username: {{ $r->author->username }}</p>
                </div>
            </div>
            <div>
                <h1 class="text-4xl font-semibold mb-4">{{ $r->RecipeName }}</h1>
                <p class="text-lg text-gray-700 mb-4">{{ $r->Description }}</p>
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
                    <div>
                        @if (!is_null($r->difficulty_level))
                        <span class="text-gray-600 mr-2">Difficulty level:</span>
                        <p class="text-lg font-semibold">{{ $r->difficulty_level }}</p>
                        @endif
                    </div>
                    <div>
                        @if (!is_null($r->cooking_time))
                        <span class="text-gray-600 mr-2">Cooking Time:</span>
                        <p class="text-lg font-semibold">{{ $r->cooking_time }}</p>
                        @endif
                    </div>
                    <div>
                        @if (!is_null($r->preparation_time))
                        <span class="text-gray-600 mr-2">Preparation time:</span>
                        <p class="text-lg font-semibold">{{ $r->preparation_time }}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div>

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

        <body class="p-6">
            <div class="bg-white rounded-lg shadow-xl p-6 overflow-hidden">
                <div class="flex flex-col justify-between">
                    <div class="Nutritional Information">
                        <h3 class="text-xl font-semibold mb-4">Nutritional Information</h3>
                        @if ($r->nutritionalData)
                        <!-- <div id="overall-nutrients" class="mb-8">
                        @foreach ($r->nutritionalData->nutrients as $nutrient)
                            <div class="mb-4">
                                <span class="nutrient-label">{{ $nutrient->name }}: {{ $nutrient->amount }} {{ $nutrient->unit }}</span>
                                <div class="relative w-full bg-gray-200 rounded">
                                    <div class="nutrient-bar bg-blue-500" style="width: {{ $nutrient->percentOfDailyNeeds }}%;">
                                        {{ $nutrient->percentOfDailyNeeds }}% DV
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div> -->

                        <h3 class="text-xl font-semibold mb-4">Bad Nutrients and % Of Recommended Daily Needs</h3>
                        <div id="bad-nutrients" class="mb-8">
                            @foreach ($r->nutritionalData->bad as $nutrient)
                            <div class="mb-4">
                                <span class="nutrient-label">{{ $nutrient->title }}: {{ $nutrient->amount }} {{ $nutrient->indented ? 'g' : '' }}</span>
                                <div class="relative w-full bg-gray-200 rounded">
                                    <div class="nutrient-bar bg-red-500" style="width:' {{ $nutrient->percentOfDailyNeeds }}%';">
                                        {{ $nutrient->percentOfDailyNeeds }}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <h3 class="text-xl font-semibold mb-4">Good Nutrients % Of Recommended Daily Needs</h3>
                        <div id="good-nutrients">
                            @foreach ($r->nutritionalData->good as $nutrient)
                            <div class="mb-4">
                                <span class="nutrient-label">{{ $nutrient->title }}: {{ $nutrient->amount }} {{ $nutrient->indented ? 'g' : '' }} {{ $nutrient->percentOfDailyNeeds }}%</span>
                                <div class="relative w-full bg-gray-200 rounded">
                                    <div class="nutrient-bar bg-blue-500" style="width: '{{ $nutrient->percentOfDailyNeeds }}%';">

                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <p>No nutritional data available</p>
                        @endif

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
            </div>

            <!-- Image beside Nutritional Information -->
            <div>
                <!-- <img class="w-full h-auto rounded-lg shadow-xl" src="{{ asset('imgs/'.$r->id.'.jpg') }}" alt="Recipe Image"> -->
                <!-- <img class="w-full h-auto rounded-lg shadow-xl" src="{{ asset('storage/' . $r->thumbnail) }}" alt="Recipe Image"> -->
                @if ($r->nutritionalData)
                @php
                $nutrients = collect($r->nutritionalData->nutrients)->map(function($nutrient) {
                return [
                'name' => $nutrient->name,
                'amount' => str_replace(['g', 'mg', 'IU'], '', $nutrient->amount)
                ];
                });
                @endphp
                <x-piecharts.piechart :nutrients="$nutrients" />
                @else
                <p>No nutritional data available</p>
                @endif
            </div>
    </div>
    </div>
</section>

@endsection