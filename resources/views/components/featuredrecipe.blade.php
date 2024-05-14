@props(['featuredrec'])

<!-- Featured Recipe Section -->
<div class=" max-w-screen-xl mx-auto px-4 py-8  " id="featured">
    <div class="mb-6">
        <h2 class="text-3xl font-semibold">Our Featured Recipe for Today</h2>
    </div>
    <!-- <div class=" max-h-80 rounded-lg overflow-hidden shadow-xl flex items-center " > -->
    <div class="recipe-card-wrapper max-h-80 rounded-lg overflow-hidden shadow-xl flex items-center">

        <!-- Recipe Image -->
        <div class="w-1/3  ">
        <img class="h-auto object-cover  transition-transform duration-300 hover:transform hover:scale-105 hover:shadow-lg" src="{{ asset('imgs/'.$featuredrec->id.'.jpg') }}" alt="Featured Recipe Image">
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
                        @if ($i <= $featuredrec->rating)
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