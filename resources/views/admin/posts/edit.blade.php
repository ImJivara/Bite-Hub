<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
 
    
    
        <x-setting :heading="'Edit post: ' . $post->RecipeName">
        <div class=" shadow-lg rounded-lg p-8 mb-8">
            <form method="POST" action="/admin/posts/{{ $post->id }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <x-form.input name="RecipeName" :value="old('RecipeName', $post->RecipeName)" required />
                <x-form.textarea name="Description" :value="old('Description', $post->Description)" required>{{ old('Description', $post->Description) }}</x-form.textarea>
                <x-form.input name="steps" :value="old('Steps', $post->Steps)" required />
                <x-form.textarea name="steps_details" :value=" old('steps_details', $post->steps_details) " required>{{ old('steps_details', $post->steps_details) }}</x-form.textarea>
                <x-form.input name="NbIngredients" :value="old('NbIng', $post->NbIngredients)" required />
                <x-form.textarea name="ingredients_details" :value=" old('ingredients_details', $post->ingredients_details) "  required>{{ old('ingredients_details', $post->ingredients_details) }}</x-form.textarea>
                <x-form.input name="NbLikes" :value="old('NbLikes', $post->NbLikes)" />
                <x-form.input name="IsApproved"   :value= "old('IsApproved', $post->IsApproved)"  >
                <x-form.input name="Difficulty_level" :value="old('difficulty_level', $post->difficulty_level)" required />

                <x-form.button>Update</x-form.button>
            </form>
        </div>
        </x-setting>
  
