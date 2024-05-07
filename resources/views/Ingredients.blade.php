@extends('test3tem')

@section('content_body')
<div class="bg-gray-100 p-8">
    <h1 class="text-2xl font-bold">{{ $rec->RecipeName }}'s Ingredients</h1>
    <ol class="list-lower-alpha mt-4">
        @foreach($Ing as $i)
            <li class="text-lg" type="1">{{ $i }}</li>
        @endforeach
    </ol>
    <a href="/Recipes" class="inline-block mt-4 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Go to Recipes</a>
</div>
@endsection
