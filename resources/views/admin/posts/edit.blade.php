<link href="{{ asset('css/tailwindstyles.css') }}" rel="stylesheet">

<x-setting :heading="'Edit post: ' . $post->RecipeName">
    <div class="shadow-lg rounded-lg p-8 mb-8">
        <form method="POST" action="/admin/posts/{{ $post->id }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <x-form.input name="RecipeName" :value="old('RecipeName', $post->RecipeName)" required />
            <x-form.textarea name="Description" required>{{ old('Description', $post->Description) }}</x-form.textarea>
            <x-form.input name="Steps" :value="old('Steps', $post->Steps)" required />
            <x-form.textarea name="steps_details" required>{{ old('steps_details', $post->steps_details) }}</x-form.textarea>
            <x-form.input name="NbIngredients" :value="old('NbIngredients', $post->NbIngredients)" required />
            <x-form.textarea name="ingredients_details" required>{{ old('ingredients_details', $post->ingredients_details) }}</x-form.textarea>
            <x-form.input name="NbLikes" :value="old('NbLikes', $post->NbLikes)" />
            <x-form.input name="IsApproved" :value="old('IsApproved', $post->IsApproved)" />
            <x-form.input name="difficulty_level" :value="old('difficulty_level', $post->difficulty_level)" required />
            <x-form.input name="cooking_time" :value="old('cooking_time', $post->cooking_time)" required />
            <x-form.input name="preparation_time" :value="old('preparation_time', $post->preparation_time)" required />
            <x-form.input name="Category" :value="old('Category', $post->Category)" required />
            <x-form.input name="Health_Score" :value="old('Health_Score', $post->Health_Score)" required />

            <x-form.button>Update</x-form.button>
        </form>
    </div>
</x-setting>
@php
$ingredients_details=$post->ingredients_details;

@endphp
@php
$post->steps_details = json_decode($post->steps_details, true);
$post->ingredients_details = json_decode($post->ingredients_details, true);
@endphp
    @foreach ($post->steps_details as $index => $step)
        <div>
            @if ( $step)
            
            
            <label for="step{{ $index }}">Step {{ $index + 1 }}</label>
            <textarea id="step{{ $index }}" name="stepsDetails[]" rows="4" cols="50" placeholder="Enter step description">{{ $step }}</textarea>
            @else <p>empty</p>
            @endif
        </div>
    @endforeach 
    <br>
    <br>
@foreach ($post->ingredients_details as $index => $ingredient)
        <div>
            <label for="ingredient{{ $index }}">Ingredient {{ $index + 1 }}</label>
            <input type="text" id="ingredient{{ $index }}" name="ingredients[{{ $index }}][name]" value="{{ $ingredient['name'] }}" placeholder="Name">
            <input type="text" name="ingredients[{{ $index }}][amount]" value="{{ $ingredient['amount'] }}" placeholder="Amount">
            <input type="text" name="ingredients[{{ $index }}][unit]" value="{{ $ingredient['unit'] }}" placeholder="Unit">
        </div>
    @endforeach
