<!-- resources/views/recipes/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Search</title>
</head>
<body>
    <h1>Search for Recipes</h1>

    <form action="{{ route('recipes.search') }}" method="GET">
        @csrf
        <label for="query">Enter your recipe search term:</label>
        <input type="text" id="query" name="query" required>
        <button type="submit">Search</button>
    </form>

    @if (!empty($imageUrls))
        <h2>Search Results for "{{ $recipeName }}"</h2>
        <div class="recipe-images">
            @foreach ($imageUrls as $imageUrl)
                <img src="{{ $imageUrl }}" alt="Recipe Image">
            @endforeach
        </div>
    @endif
</body>
</html>
