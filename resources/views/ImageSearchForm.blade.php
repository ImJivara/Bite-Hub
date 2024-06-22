<!-- resources/views/image_search_form.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search for Images</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<div class=" p-8  w-full">
        <div class="flex flex-col items-center mb-4">
            <div class="logo flex items-center space-x-4">
                <div>
                    <a href="/" class="text-3xl font-bold text-black">Bite-Hub.com</a>
                    <p class="text-gray-600 text-xl">Exploring the Art of Food</p>
                </div>
                <div>
                    <img src="{{ asset('imgs/Website Logo Cropped.png') }}" class="w-28 h-28 p-0">
                </div>
            </div>
        </div>
        
        <form action="{{ route('image.search') }}" method="GET" class="flex items-center">
            @csrf
            <input type="text" name="query" placeholder="Enter search query"
                class="form-input rounded-full px-4 py-2 border border-gray-300 focus:outline-none focus:border-black w-full" value="{{ old('query') }}" required>
            <button type="submit"
                class="form-button bg-black text-white rounded-lg px-4 py-2 ml-2 focus:outline-none"  >Search</button>
            <button type="button"
             onclick="confirmDownload()" class="form-button bg-black text-white rounded-full px-4 py-4 ml-2 focus:outline-none ">Save</button>
        </form>

        <div class="mt-6">
        @yield('content_body')
        </div>
    
</div>    

</html>
