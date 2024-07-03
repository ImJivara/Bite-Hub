<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/kTcsm6FQ4RSAP9z9b8fqjeanU/6lmV4DJEFuOWzTpBdaJ98loG8mGbB6iTP6y7H5NU6tuGt+OMj8w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<style>
    .montserrat {
        font-family: "Montserrat", sans-serif;
        font-optical-sizing: auto;
        font-weight: <weight>;
        font-style: normal;
    }
</style>
<link href="{{ asset('css/tailwindstyles.css') }}" rel="stylesheet">
<script src="{{ asset('jquery-3.7.1.js') }}"></script>

<div class="mx-auto max-w-7xl p-4 Montserrat">

    <!-- Profile Header -->
    <div class="profile-header flex flex-col items-center">
        <div class="flex items-center justify-center w-full mb-8">
            <form id="profilePictureForm" method="POST" action="{{ route('pfp.update') }}" enctype="multipart/form-data">
                @csrf
                <div class="w-40 h-40 relative ">
                    <img id="profileImage" class=" enhanced-image w-full h-full rounded-full object-cover border-2 overflow-hidden shadow-md border-black" src="{{ asset('profileimgs/' . auth()->user()->profile_picture) }}" alt="Profile Picture">
                    <input type="file" name="profile_picture" id="uploadProfilePicture" class="hidden" accept="image/*">
                    <button id="editProfilePicture" type="button" class="absolute bottom-0 right-0 bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-1.5 rounded-full">
                        ✏️
                    </button>
                    <style>
                        .enhanced-image {
                            filter: brightness(0.9) contrast(1.2);
                        }
                    </style>
                </div>
            </form>
            <div class="ml-8">
                <h1 class="text-3xl font-semibold">@ {{ Auth::user()->username }}</h1>

                <p class="text-gray-600">{{ Auth::user()->location }}</p>
                <div class="flex mt-4 space-x-4">
                    <div class="text-center">
                        <span class="font-bold text-xl">{{ $posts->count() }}</span>
                        <p class="text-gray-600">Posts</p>
                    </div>
                    <div class="text-center cursor-pointer" id="openFollowersModal">
                        <span class="font-bold text-xl">{{ $followers->count() }}</span>
                        <p class="text-gray-600">Follower</p>
                    </div>

                    <div class="text-center cursor-pointer" id="openFollowingModal">
                        <span class="font-bold text-xl">{{ $following->count() }}</span>
                        <p class="text-gray-600">Following</p>
                    </div>


                </div>
                <a href="/profile/Edit Profile/{{ Auth::user()->id }}" class="block mt-4 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-full text-center">
                    Edit Profile
                </a>
            </div>
        </div>
    </div>

    <!-- Tabs -->
    <div class="tabs mt-8 border-t border-gray-300 flex justify-center">
        <button class="tab p-4 text-center border-t-2 border-black active" onclick="showSection('posts')">POSTS</button>
        <button class="tab p-4 text-center text-gray-500 border-t-2" onclick="showSection('liked')">LIKED</button>
    </div>
    <!-- Posts Section -->

    <div id="posts" class="tab-content grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-1">
        @forelse($posts as $post)
        <div class="relative bg-white rounded-md border border-gray-300 shadow-lg overflow-hidden hover:shadow-lg group">
            <!-- Post Image -->
            <div class="relative">
                <img src="{{asset('storage/' . $post->thumbnail)}}" alt="{{ $post->RecipeName }}" class="w-full h-64 object-cover">
                <!-- Hover effect -->
                <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                    <div class="text-white text-center">
                        <p class="text-lg"><i class="fas fa-heart"></i> {{$post->NbLikes}}</p>
                        <p class="text-lg"><i class="fas fa-comment"></i> {{$post->comments->count()}}</p>
                    </div>
                </div></a>
            </div>

        </div>
        @empty
        <p class="text-center text-gray-500 col-span-full">You have not posted any content yet.</p>
        @endforelse
    </div>



    <!-- Liked Recipes Section -->
    <div id="liked" class="tab-content grid grid-cols-1 gap-2 hidden">
        @forelse($likedRecipes as $recipe)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg">
            <!-- User Info -->
            <div class="flex items-center p-2">
                <a href="/profile/{{$recipe->author->id}}"><img src="{{ asset('profileimgs/'.$recipe->author->profile_picture) }}" alt="User profile" class="w-12 h-12 rounded-full mr-2 object-cover"></a>
                <div>
                    <a href="/profile/{{$recipe->author->id}}">
                        <p class="font-semibold">{{ Auth::user()->username }}</p>
                    </a>
                    @if ($recipe->created_at)
                    <p class="text-gray-500 text-sm">{{ $recipe->created_at->format('M d') }}</p>
                    @endif
                </div>
            </div>
            <!-- Post Image -->
            <a href="/Recipe/{{$recipe->id}}"><img src="{{asset('storage/' . $recipe->thumbnail)}}" alt="{{ $recipe->RecipeName }}" class="w-full h-72 object-cover"></a>
            <!-- Post Content -->
            <div class="p-4">
                <h3 class="text-black font-semibold mb-2">{{ $recipe->RecipeName }}</h3>
            </div>
        </div>
        @empty
        <p class="text-center text-gray-500 col-span-full">You have not liked anything yet.</p>
        @endforelse
    </div>
</div>
<!-- Modal or overlay container -->
<x-ProfileComponents.followers :followers='$followers' />
<x-ProfileComponents.followings :following='$following' />




<script>
    document.addEventListener('DOMContentLoaded', function() {
        const profileImage = document.getElementById('profileImage');
        const uploadProfilePicture = document.getElementById('uploadProfilePicture');
        const editProfilePicture = document.getElementById('editProfilePicture');
        const profilePictureForm = document.getElementById('profilePictureForm');

        // Trigger the file input click when the edit button is clicked
        editProfilePicture.addEventListener('click', function() {
            uploadProfilePicture.click();
        });

        // Update the image preview when a new image is selected and submit the form
        uploadProfilePicture.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    profileImage.src = e.target.result;
                }
                reader.readAsDataURL(file);

                // Submit the form to upload the profile picture
                profilePictureForm.submit();
            }
        });
    });
</script>