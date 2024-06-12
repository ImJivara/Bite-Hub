@props(['r' ])

<div class="recipe-card-wrapper flex items-stretch "> 
    <a href="/Recipe/{{ $r->id }}" class="recipe-card-link block "> 
        <div class="max-w-sm mx-auto bg-white rounded-lg border border-0.5-black overflow-hidden transition-transform duration-300 hover:transform hover:scale-105 hover:shadow-lg">
            <img class="w-full h-56 object-cover object-center" src="{{ asset('imgs/'.$r->id.'.jpg') }}" alt="Recipe Image">
            <div class="p-6 flex-grow">
                <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $r->RecipeName }}</h2>
                @if (strlen($r->Description) > 100)
                    <p class="text-gray-700 font-medium">{{ \Illuminate\Support\Str::limit($r->Description, 100, $end='...') }}</p>
                    <button id="toggleBtn_{{ $r->id }}" onclick="toggleDescription('{{ $r->id }}')" class="text-blue-500 font-medium mt-2 focus:outline-none">Show More</button>
                @else
                <p class="text-gray-700 font-medium">{{ $r->Description }}</p>
                @endif

                <div class="mt-4">
                    <a href="/Ing/{{ $r->id }}" class="text-blue-500 font-semibold block">Number of Ingredients: {{ $r->NbIngredients }}</a>
                    <a href="/Step/{{ $r->id }}" class="text-blue-500 font-semibold block">Steps: {{ $r->Steps }}</a>
                </div>
                <div class="flex justify-between items-center mt-2 relative space-x-4 ">
                    <p class="text-gray-600 font-semibold mr-4 flex-2">Number of Likes: <span id="txt_{{ $r->id }}" class="text-red-500 text-semibold">{{ $r->NbLikes }}</span></p>
                    <div class="   bg-gray-200 text-xs px-4 py-2 rounded-lg">
                            @if ($r->created_at == null) 
                                <p class="text-gray-600">Created at../-/-/</p>
                            @else 
                                <time class="text-gray-600">{{ $r->created_at->diffForHumans() }}</time>
                            @endif
                    </div>
                    <div  class="display:block">
                        @php                     
                            if(Auth::user())
                            $likedRecipes = Auth::user()->likedRecipes->pluck('id')->toArray();
                            else $likedRecipes=[];
                        @endphp
                        @if (in_array($r->id, $likedRecipes))                         
                                <x-extracomponents.modernlikebutton :recipeId="$r->id" :IsLiked='True' data-likebtn />                           
                        @else                           
                                <x-extracomponents.modernlikebutton :recipeId="$r->id"  :IsLiked='False' data-likebtn />                           
                        @endif
                        
                        
                    </div>
                    
                </div>
            </div>   
        </div>
    </a>
</div>

<script>
// Prevent navigation when clicking on like button
//it checks if the element contains an anchor aw btn w aa asesa bt2arer aa shu l click event btekhod
document.querySelectorAll('.recipe-card-wrapper').forEach(item => {
    item.addEventListener('click', function(event) {
        if (event.target.tagName !== 'A' && event.target.tagName == 'BUTTON') {
            const recipeLink = item.querySelector('.recipe-card-link');
            if (recipeLink)
            {
                window.location.href = recipeLink.href;
            }
        }
    });
});
</script>
