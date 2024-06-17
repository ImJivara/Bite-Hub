@extends('Profile Folder.ProfileLayout')

@section('content')
    <div class="">
        {{-- <div class="p-4">
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
                            <h3 class="text-xl font-semibold mb-2">{{ $recipe->title }}</h3>
                            <p class="text-gray-600">{{ $recipe->excerpt }}</p>
                            <a href="{{ route('recipes.show', $recipe->id) }}" class="text-blue-500 hover:underline mt-2 inline-block">Read More</a>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500">You have not liked any recipes yet.</p>
                @endforelse
            </div>
        </div> --}}

    

                {{-- <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Liked Comments</div>
    
                        <div class="card-body">
                            @foreach($activities as $activity)
                                @if($activity->type === 'like' && $activity->subject_type === 'App\Models\Comment')
                                    <div class="main-content bg-white shadow-md rounded-lg p-8 mb-8">
                                        <!-- Display liked comment details -->
                                        <p>{{ $activity->description }}</p>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Liked Posts</div>
    
                        <div class="card-body">
                            @foreach($activities as $activity)
                                @if($activity->type === 'like' && $activity->subject_type === 'App\Models\Recipe')
                                    <div class="main-content bg-white shadow-md rounded-lg p-8 mb-8">
                                        <!-- Display liked post details -->
                                        <p>{{ $activity->description }}</p>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- resources/views/recent_activities.blade.php -->
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-xl">Recent Activities</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="sortType" class="form-label">Sort by Type:</label>
                        <select class="form-select" id="sortType" onchange="sortActivities(this.value)">
                            <option value="" {{ is_null($currentType) ? 'selected' : '' }}>All</option>
                            <option value="like_recipe" {{ $currentType == 'like_recipe' ? 'selected' : '' }}>Like Recipe</option>
                            <option value="like_comment" {{ $currentType == 'like_comment' ? 'selected' : '' }}>Like Comment</option>
                            <option value="post_recipe" {{ $currentType == 'post_recipe' ? 'selected' : '' }}>Post Recipe</option>
                            <option value="post_comment" {{ $currentType == 'post_comment' ? 'selected' : '' }}>Post Comment</option>
                        </select>
                    </div>
                    @if($activities->isEmpty())
                    <div class="absolute  flex justify-center items-center text-gray-400">
                        <p class="text-lg ml-2">No recent activities found</p>
                    </div>
                    @else
                    @foreach($activities as $activity)
                        <div class="activity-card bg-white shadow-md rounded-lg p-4 mb-4">
                            <p>{{ $activity->description }}</p>
                            <small class="text-muted">{{ $activity->created_at->format('d M Y, h:i A') }}</small>
                        </div>
                    @endforeach
                    @endif
                   <p> {{ $activities->links() }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function sortActivities(type) {
        // Build the URL based on the selected type
        let url = '{{ route("recent-activities") }}';
        if (type) {
            url += '/' + type;
        }
        window.location = url;
    }
</script>
        
        


        
        

        {{-- <!-- Followers / Following Section -->
        <div class="followers-following mt-8">
            <h2 class="text-center text-2xl font-bold mb-4">Followers & Following</h2>
            <div class="flex justify-around">
                <div class="followers text-center">
                    <h3 class="text-xl font-semibold">{{ $user->followers->count() }}</h3>
                    <p class="text-gray-600">Followers</p>
                </div>
                <div class="following text-center">
                    <h3 class="text-xl font-semibold">{{ $user->following->count() }}</h3>
                    <p class="text-gray-600">Following</p>
                </div>
            </div>
        </div>

        <!-- Saved Recipes Section -->
        <div class="saved-recipes mt-8">
            <h2 class="text-center text-2xl font-bold mb-4">Saved Recipes</h2>
            <div class="flex flex-wrap justify-center">
                @forelse($savedRecipes as $recipe)
                    <div class="w-full md:w-1/2 lg:w-1/3 p-4">
                        <div class="bg-white rounded-lg shadow-md p-4">
                            <h3 class="text-xl font-semibold mb-2">{{ $recipe->title }}</h3>
                            <p class="text-gray-600">{{ $recipe->excerpt }}</p>
                            <a href="{{ route('recipes.show', $recipe->id) }}" class="text-blue-500 hover:underline mt-2 inline-block">Read More</a>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500">You have not saved any recipes yet.</p>
                @endforelse
            </div>
        </div> --}}
    </div>
@endsection
