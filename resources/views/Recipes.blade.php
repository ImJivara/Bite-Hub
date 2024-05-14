@extends('test3tem')
@section('content_body')



 <!-- Featured Recipe Section -->
 <div class=" max-w-screen-xl mx-auto px-4 py-8  " id="featured">
    <div class="mb-6">
        <h2 class="text-3xl font-semibold">Our Featured Recipe for Today</h2>
    </div>
    <!-- <div class=" max-h-80 rounded-lg overflow-hidden shadow-xl flex items-center " > -->
    <div class="recipe-card-wrapper max-h-80 rounded-lg overflow-hidden shadow-xl flex items-center transition-transform duration-300 hover:transform hover:scale-105 hover:shadow-lg">

        <!-- Recipe Image -->
        <div class="w-1/3 ">
        <img class="h-auto object-cover" src="{{ asset('imgs/'.$featuredrec->id.'.jpg') }}" alt="Featured Recipe Image">
        </div>
        <!-- Recipe Details -->
        <div class=" h-100 p-6 w-2/3 "> <!-- hun rje3 hut l color-->
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">{{ $featuredrec->RecipeName }}</h2>
            
            @if (strlen($featuredrec->Description) > 600)
                    <p class="text-gray-700 font-medium " >{{ \Illuminate\Support\Str::limit($featuredrec->Description, 600, $end='...') }}</p>
                    <button id="toggleBtn_{{ $featuredrec->id }}" onclick="toggleDescription('{{ $featuredrec->id }}')" class="text-blue-500 font-medium mt-2 focus:outline-none">Show More</button>
                    @else <p class="text-gray-700 font-medium ">{{ $featuredrec->Description }}</p>
            @endif
            <!-- Rating Stars -->
            <div class="flex items-center mb-2">
                <span class="text-gray-600 mr-2">Rate this recipe:</span>
                <!-- Replace 0 with the initial rating value (if available) -->
                <div class="flex">
                    <!-- Star icons -->
                    @for ($i = 1; $i <= 5; $i++)
                    <button class="text-yellow-400 focus:outline-none" onclick="rateRecipe({{ $i }})">
                        <!-- Change the class based on the rating status (e.g., filled, empty) -->
                        @if ($i <= $rec[0]->rating)
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
            <a href="/Recipe/{{ $featuredrec->id }}" class="text-blue-500 font-semibold block">View Recipe</a>
        </div>
    </div>
</div>
<!-- End of Featured Recipe Section -->


    



<div class="grid grid-cols-4 md:grid-cols-3 lg:grid-cols-4 gap-6" id="grid">
    @foreach($rec as $r)
    <div class="recipe-card-wrapper flex items-stretch transition-transform duration-300 hover:transform hover:scale-105 hover:shadow-lg">
        <a href="/Recipe/{{ $r->id }}" class="recipe-card-link block flex-grow"> 
            <div class="max-w-sm mx-auto bg-white rounded-lg overflow-hidden shadow-xl hover:shadow-2xl transition duration-300 flex flex-col">
                <img class="w-full h-56 object-cover object-center" src="{{ asset('imgs/'.$r->id.'.jpg') }}" alt="Recipe Image">
                <div class="p-6 flex-grow">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $r->RecipeName }}</h2>
                    @if (strlen($r->Description) > 100)
                    <p class="text-gray-700 font-medium " >{{ \Illuminate\Support\Str::limit($r->Description, 100, $end='...') }}</p>
                    <button id="toggleBtn_{{ $r->id }}" onclick="toggleDescription('{{ $r->id }}')" class="text-blue-500 font-medium mt-2 focus:outline-none">Show More</button>
                    @else <p class="text-gray-700 font-medium ">{{ $r->Description }}</p>
                    @endif

                    <div class="mt-4">
                        <a href="/Ing/{{ $r->id }}" class="text-blue-500 font-semibold block">Number of Ingredients: {{ $r->NbIngredients }}</a>
                        <a href="/Step/{{ $r->id }}" class="text-blue-500 font-semibold block">Steps: {{ $r->Steps }}</a>
                    </div>
                    <div class="flex justify-between items-center mt-4">
                        <p class="text-gray-600 font-semibold mr-4 flex-2">Number of Likes: <span id="txt_{{ $r->id }}">{{ $r->NbLikes }}</span></p>
                        <!-- <button id="{{ $r->id }}" onclick="updateLike2('{{ $r->id }}')" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none">Like</button> -->
                        @if ( $r->created_at ==null) 
                        <p>Created at../-/-/</p>
                        @else 
                        <time>{{ $r->created_at->diffForHumans() }}</time>
                        @endif
                        <x-bookmarkcomp :recipeId="$r->id" /> 
                    </div>
                </div>
            </div>
        </a>
    </div>
    @endforeach
    
</div>
@endsection

<script>

    // krmel hadded what html elements are excluded mnl route /Recipe/id
    document.querySelectorAll('.recipe-card-wrapper').forEach(item => {
        item.addEventListener('click', function(event) {
            // Check if the clicked element is a link or button
            if (event.target.tagName !== 'A' && event.target.tagName !== 'BUTTON') {
                // If not, trigger navigation to the recipe details page
                const recipeLink = item.querySelector('.recipe-card-link');
                if (recipeLink) {
                    window.location.href = recipeLink.href;
                }
            }
        });
    });

</script>
