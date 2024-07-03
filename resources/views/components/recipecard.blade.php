@props(['r'])

<div class="recipe-card-wrapper flex items-stretch">

    <div class="Card-class flex flex-col max-w-sm mx-auto bg-white rounded-lg border border-0.5-black overflow-hidden transition-transform duration-300 hover:transform hover:scale-105 hover:shadow-lg">
        <a href="/Recipe/{{ $r->id }}" class="recipe-card-link block">
            <img class="w-full h-56 object-cover object-center" src="{{ asset('storage/' . $r->thumbnail) }}"alt="Recipe Image">
        </a>
        <div class="Header-class p-4 flex-grow flex flex-col">
            <div class="flex items-center space-x-4 mb-4">
                <div class="relative w-12 h-12 rounded-full overflow-hidden">
                    <img class="absolute inset-0 w-full h-full object-cover" src="{{ asset('profileimgs/' . $r->author->profile_picture) }}" alt="Profile Picture">
                </div>
                <a href="/profile/{{$r->author->id}}" class="text-xl font-semibold text-red-500">
                    <span class="capitalize">{{ $r->author->username }}</span>
                    <p class="text-black text-sm">{{ $r->created_at->diffForHumans() }}</p>
                </a>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $r->RecipeName }}</h2>
            @if (strlen($r->Description) > 150)
                <p class="text-gray-700 font-medium flex-grow">{{ \Illuminate\Support\Str::limit($r->Description, 150, $end = '...') }}
                <a href="/Recipe/{{$r->id}}" onclick="toggleDescription('{{ $r->id }}')" class="text-blue-500 font-medium mt-2 focus:outline-none">Show More</a></p>
            @else
                <p class="text-gray-700 font-medium flex-grow">{{ $r->Description }}</p>
            @endif

            <div class="Ingredients-class mt-2 flex justify-between items-center">
                <p class="text-gray-600 font-semibold mr-4 flex-2 text-lg">Likes: <span id="txt_{{ $r->id }}" class="text-red-500 text-semibold">{{ $r->NbLikes }}</span></p>
                <div class="Likes-class">
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
</div>
