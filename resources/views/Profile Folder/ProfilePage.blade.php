@extends('Profile Folder.ProfileLayout')

@section('content')
    <div class="main-content">
        <div class="p-4">
            <img class="w-40 h-40 rounded-full mx-auto" src="{{ asset('imgs/3.jpg') }}" alt="Profile Picture">
            <p class="text-center text-gray-800 mt-2" id="name_sidebar">{{ Auth::user()->name }}</p>
        </div>
        <div class="text-center mt-4">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="changeProfilePicture()">
                Change Profile Picture
            </button>
        </div>
        
        <!-- Liked Recipes Section -->
        <div class="liked-posts mt-8">
            <h2 class="text-center text-2xl font-bold mb-4">Liked Recipes</h2>
            <div class="flex flex-wrap justify-center">
                @forelse($likedRecipes as $recipe)
                    <div class="w-full md:w-1/2 lg:w-1/3 p-4">
                        <div class="bg-white rounded-lg shadow-md p-4">
                            <h3 class="text-xl font-semibold mb-2">{{ $recipe->RecipeName }}</h3>
                            <p class="text-gray-600">{{ $recipe->Description }}</p>
                            <a href="/Recipe/{{$recipe->id}}" class="text-blue-500 hover:underline mt-2 inline-block">Read More</a>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500">You have not liked any recipes yet.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
