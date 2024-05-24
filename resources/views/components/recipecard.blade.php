@props(['r' ])

<div class="recipe-card-wrapper flex items-stretch transition-transform duration-300 hover:transform hover:scale-105 hover:shadow-lg"> 
    <a href="/Recipe/{{ $r->id }}" class="recipe-card-link block flex-grow"> 
         <div class="max-w-sm mx-auto bg-white rounded-lg overflow-hidden shadow-xl hover:shadow-2xl transition duration-300 flex flex-col">
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
                <div class="flex justify-between items-center mt-4">
                    <p class="text-gray-600 font-semibold mr-4 flex-2">Number of Likes: <span id="txt_{{ $r->id }}">{{ $r->NbLikes }}</span></p>
                    
                    @if ($r->created_at == null) 
                    <p>Created at../-/-/</p>
                    @else 
                    <time>{{ $r->created_at->diffForHumans() }}</time>
                    @endif
                    @php
                        $user=Auth::user();
                        if($user)
                        $likedRecipes = Auth::user()->likedRecipes->pluck('id')->toArray();
                        else $likedRecipes=[];
                    @endphp
                    @if (in_array($r->id, $likedRecipes))
                        <x-Likebtncomp :recipeId="$r->id" :User='$user' :IsLiked='True' data-likebtn />
                    @else
                        <x-Likebtncomp :recipeId="$r->id" :User='$user' :IsLiked='False' data-likebtn />
                    @endif

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
