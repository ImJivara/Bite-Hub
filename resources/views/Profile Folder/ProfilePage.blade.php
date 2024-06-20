

<link href="{{ asset('css/tailwindstyles.css') }}" rel="stylesheet">
<script src="{{ asset('jquery-3.7.1.js') }}"></script>
<script>
  // Function to open the modal
  function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }

    // Function to close the modal
    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }


    // Event listener to close the Followers modal
    document.getElementById('closeFollowersModal').addEventListener('click', function() {
        closeModal('followersModal');
    });


    // Event listener to close the Following modal
    document.getElementById('closeFollowingModal').addEventListener('click', function() {
        closeModal('followingModal');
    });

    // Optional: Close the modal when clicking outside of it
    window.addEventListener('click', function(event) {
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            if (event.target === modal) {
                modal.classList.add('hidden');
            }
        });
    });
   
</script>

<div class="mx-auto max-w-7xl p-4">

    <!-- Profile Header -->
    <div class="profile-header flex flex-col items-center">
        <div class="flex items-center justify-center w-full mb-8">
            <div class="w-40 h-40 relative">
                <img class="w-full h-full rounded-full object-cover" src="{{ asset('imgs/3.jpg') }}"
                    alt="Profile Picture">
                <button
                    class="absolute bottom-0 right-0 bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-1.5 rounded-full"
                    onclick="changeProfilePicture()">
                    ✏️
                </button>
            </div>
            <div class="ml-8">
                <h1 class="text-3xl font-semibold">{{ Auth::user()->name }}</h1>
                
                <p class="text-gray-600">{{ Auth::user()->location }}</p>
                <div class="flex mt-4 space-x-4">
                    <div class="text-center">
                        <span class="font-bold text-xl">{{$followers->count()}}</span>
                        <p class="text-gray-600">Posts</p>
                    </div>
                    <div class="text-center cursor-pointer" id="openFollowersModal">
                       <span class="font-bold text-xl">66</span>
                       <p class="text-gray-600">Follower</p>
                   </div>
                   <script>
                   document.getElementById('openFollowersModal').addEventListener('click', function() {
                       openModal('followersModal');
                   })
                  
                   
                   </script>
                    <div class="text-center cursor-pointer" id="openFollowingModal">
                       <span class="font-bold text-xl">66</span>
                       <p class="text-gray-600">Following</p>
                   </div>
                   <script>
                     document.getElementById('openFollowingModal').addEventListener('click', function() {
                       openModal('followingModal');
                   })
                   </script>
                   
                </div>
                <a href="/profile/Edit Profile/{{ Auth::user()->id }}"
                    class="block mt-4 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-full text-center">
                    Edit Profile
                </a>
            </div>
        </div>
    </div>

    <!-- Tabs -->
    <div class="tabs mt-8 border-t border-gray-300 flex justify-center">
        <button class="tab p-4 text-center border-t-2 border-black active"
            onclick="showSection('posts')">POSTS</button>
        <button class="tab p-4 text-center text-gray-500 border-t-2"
            onclick="showSection('liked')">SAVED</button>
    </div>

    <div class="main-content">
        @yield('content')
    </div>

    <!-- Content Sections -->
    {{-- <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-8"> --}}
        <!-- Posts Section -->
        <div id="posts" class="tab-content grid grid-cols-2 gap-6 ">
            @forelse($likedRecipes as $post)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg">
                    <!-- User Info -->
                    <div class="flex items-center p-2">
                        <img src="{{ asset('imgs/3.jpg') }}" alt="User profile" class="w-8 h-8 rounded-full mr-2">
                        <div>
                            <p class="font-semibold">{{ Auth::user()->name }}</p>
                            @if ($post->created_at)
                                <p class="text-gray-500 text-sm">{{ $post->created_at->format('M d') }}</p>
                            @endif
                        </div>
                    </div>
                    <!-- Post Image -->
                    <img src="{{ asset('imgs/placeholder.jpg') }}" alt="{{ $post->RecipeName }}"
                        class="w-full h-40 object-cover">
                    <!-- Post Content -->
                    <div class="p-4">
                        <h3 class="text-black font-semibold mb-2">{{ $post->RecipeName }}</h3>
                        <p class="text-gray-600">{{ $post->Description }}</p>
                        <div class="mt-2">
                            <a href="/post/{{ $post->id }}"
                                class="text-blue-500 hover:underline inline-block">Read More</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500 col-span-full">You have not posted anything yet.</p>
            @endforelse
        </div>

        <!-- Liked Recipes Section -->
        <div id="liked" class="tab-content grid grid-cols-1 gap-6 hidden">
            @forelse($likedRecipes as $recipe)
                <div class="bg-white rounded-lg border border-gray shadow-lg overflow-hidden hover:shadow-lg">
                    <!-- User Info -->
                    <div class="flex items-center p-2">
                        <img src="{{ asset('imgs/3.jpg') }}" alt="User profile" class="w-12 h-12 rounded-full mr-2">
                        <div>
                            <p class="font-semibold text-2xl ">{{ Auth::user()->name }}</p>
                            @if ($recipe->created_at)
                                <p class="text-gray-500 text-sm">{{ $recipe->created_at->format('M d') }}</p>
                            @endif
                        </div>
                    </div>
                    <!-- Post Image -->
                    <img src="{{ asset('imgs/3.jpg') }}" alt="{{ $recipe->RecipeName }}"
                        class="w-full h-72  object-cover">
                    <!-- Post Content -->
                    <div class="p-4">
                        <h3 class="text-black text-3xl font-semibold mb-2">{{ $recipe->RecipeName }}</h3>
                        <p class="text-gray-600 text-xl">{{ $recipe->Description }}</p>
                        <div class="mt-2">
                            <a href="/liked/{{ $recipe->id }}"
                                class="text-blue-500 hover:underline inline-block">Read More</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500 col-span-full">You have not liked any posts yet.</p>
            @endforelse
        </div>
    </div>


<script>
    function showSection(section) {
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden');
        });
        document.getElementById(section).classList.remove('hidden');

        document.querySelectorAll('.tab').forEach(tab => {
            tab.classList.remove('border-black', 'text-black');
            tab.classList.add('text-gray-500');
        });
        event.target.classList.add('border-black', 'text-black');
        event.target.classList.remove('text-gray-500');
    }
</script>
<!-- Your existing profile content -->



<!-- Modal or overlay container -->
<x-ProfileComponents.followers :likedRecipes="$likedRecipes"/>
<x-ProfileComponents.followings/>
{{-- @endsection --}}
