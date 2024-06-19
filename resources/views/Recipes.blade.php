@extends('test3tem')
@section('content_body')
<div class="mb-12 mt-12"> 
    @if ($featuredrec==null && $MostRecentRecipe==null)
    <h2 class="text-3xl font-semibold text-center ">Oops Looks Empty</h1>
    @else
        <x-featuredrecipesv2 :featuredrec="$featuredrec" :MostRecentRecipe="$MostRecentRecipe"/>
     @endif
</div>
    
<div class="grid grid-cols-5 md:grid-cols-5 lg:grid-cols-4 gap-6" id="grid">
    @foreach($rec as $r)
        <x-recipecard :r="$r" />
    @endforeach
</div>
@endsection


<!-- SPOONACULAR_API_KEY=a5e5afda0898426ab0bb39484bfdbde9 
YOUR_EDAMAM_APP_ID=7ba1f1e8 
YOUR_EDAMAM_APP_KEY=0bfaa9370bce866584f689af21404aa2
WORKOUT_API_KEY=55715de52a098e66a462f228656ba1c7b0a7ac0c -->