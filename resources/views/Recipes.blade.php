@extends('test3tem')

@section('content_body')
<div class="mb-8 mt-12"> 
    @if ($featuredrec==null && $MostRecentRecipe==null)
    <h2 class="text-3xl font-semibold text-center">Oops Looks Empty</h2>
    @else
        <x-featuredrecipesv2 :featuredrec="$featuredrec" :MostRecentRecipe="$MostRecentRecipe"/>
    @endif
</div>


<div class="flex mb-6 space-x-4 justify-center text-white">
    <a href="{{ route('recipes.sorted', ['sort_by' => 'created_at', 'sort_order' => 'desc']) }}"
        class="px-4 py-2 bg-black rounded-lg">Newest to Oldest</a>
    <a href="{{ route('recipes.sorted', ['sort_by' => 'created_at', 'sort_order' => 'asc']) }}"
        class="px-4 py-2 bg-black rounded-lg">Oldest to Newest</a>
    <a href="{{ route('recipes.sorted', ['sort_by' => 'NbLikes', 'sort_order' => 'desc']) }}"
        class="px-4 py-2 bg-black rounded-lg">Most Liked to Least Liked</a>
   
</div>


<!-- Recipes Grid -->
<div class="grid grid-cols-5  sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6" id="recipes-grid">
    @foreach($rec as $r)
        <x-recipecard :r="$r" />
    @endforeach
</div>
<div id="recipes-grid-2"></div>
<!-- Pagination Links -->
<div class="mb-2 items-center">
    <p>{{ $rec->links() }}</p>
</div>

@endsection
