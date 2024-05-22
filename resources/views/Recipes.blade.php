@extends('test3tem')
@section('content_body')
<div class="mb-12 mt-12"> 
    @if ($featuredrec==null)
        <h1>Oops Looks Empty</h1>
    @else
        <x-featuredrecipesv2 :featuredrec="$featuredrec"/>
     @endif
</div>
    
<div class="grid grid-cols-4 md:grid-cols-3 lg:grid-cols-4 gap-6" id="grid">
    @foreach($rec as $r)
        <x-recipecard :r="$r" />
    @endforeach
</div>
@endsection


