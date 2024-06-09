<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<x-setting heading="Publish New Post">
    <form method="POST" action="/admin/posts" enctype="multipart/form-data">
        @csrf
        <x-form.input name="User_Id" label="User Id" required />
        <x-form.input name="RecipeName" label="Recipe Name" required />
        <x-form.textarea name="Description" label="Description" required />
        <x-form.input name="steps" label="Steps" type="number" required />
        <x-form.textarea name="steps_details" label="Steps Details" required />
        <x-form.input name="NbIng" label="Number Of Ingredients" type="number" required />
        <x-form.textarea name="ingredient_details" label="Ingredient Details" required />
        <x-form.input name="NbLikes" label="Number Of Likes" type="number" />
        <x-form.input name="IsApproved" label="Is Approved" required />
        <x-form.input name="Difficulty_level" label="Difficulty Level" required />

        <x-form.button>Publish</x-form.button>
    </form>

    @if ($errors->any())
        <div class="mt-6">
            <ul class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</x-setting>
