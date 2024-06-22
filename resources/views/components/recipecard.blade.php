@props(['r'])

<div class="recipe-card-wrapper flex items-stretch">

    <div class="Card-class max-w-sm mx-auto bg-white rounded-lg border border-0.5-black overflow-hidden transition-transform duration-300 hover:transform hover:scale-105 hover:shadow-lg">
        <a href="/Recipe/{{ $r->id }}" class="recipe-card-link block">
            <img class="w-full h-56 object-cover object-center" src="{{ asset('storage/' . $r->thumbnail) }}"
                alt="Recipe Image">
        </a>
        <div class="Header-class p-6 flex-grow">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $r->RecipeName }}<a href="/profile/{{$r->author->id}}"
                    class="ml-2 text-red-500 capitalize">{{$r->author->name}}</a></h2>
            @if (strlen($r->Description) > 100)
                <p class="text-gray-700 font-medium">{{ \Illuminate\Support\Str::limit($r->Description, 100, $end = '...') }}
                </p>
                <button id="toggleBtn_{{ $r->id }}" onclick="toggleDescription('{{ $r->id }}')"
                    class="text-blue-500 font-medium mt-2 focus:outline-none">Show More</button>
            @else
                <p class="text-gray-700 font-medium">{{ $r->Description }}</p>
            @endif

            <div class="Ingredients-class mt-4">
                <a href="/Ing/{{ $r->id }}" class="text-blue-500 font-semibold block">Number of Ingredients:
                    {{ $r->NbIngredients }}</a>
                <a href="/Step/{{ $r->id }}" class="text-blue-500 font-semibold block">Steps: {{ $r->Steps }}</a>
            </div>
            <div class="Likes-class flex justify-between items-center mt-2 relative space-x-4">
                <p class="text-gray-600 font-semibold mr-4 flex-2">Likes: <span id="txt_{{ $r->id }}"
                        class="text-red-500 text-semibold">{{ $r->NbLikes }}</span></p>
                <div class="created-at-class bg-gray-200 text-xs px-4 py-2 rounded-lg">
                    @if ($r->created_at == null)
                        <p class="text-gray-600">Created at../-/-/</p>
                    @else 
                        <time class="text-gray-600">
                            <p class="w-16">{{ $r->created_at->diffForHumans() }}</p>
                        </time>
                    @endif
                </div>
                <div class="Likebtn-class display:block">
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
</div>
