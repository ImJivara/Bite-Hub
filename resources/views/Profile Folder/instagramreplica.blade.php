<!-- resources/views/profile/show.blade.php -->

<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
@php $user=Auth::user(); @endphp
<div class="container mx-auto p-4">
    <!-- Cover Photo -->
    <div class="bg-gray-200 mb-8 rounded-lg overflow-hidden">
        <!-- Your cover photo here -->
        <!-- <img src="{{ asset('storage/' . $user->cover_photo) }}" alt="Cover Photo" class="w-full h-auto"> -->
    </div>

    <!-- Profile Header -->
    <div class="flex justify-between items-center mb-8">
        <div class="flex items-center">
            <!-- Profile Image with Verification Badge -->
            <div class="w-20 h-20 relative rounded-full overflow-hidden border-4 border-white">
                <img src="{{ asset('storage/' . $user->profile_image) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                @if ($user->is_verified)
                <div class="absolute bottom-0 right-0 bg-blue-500 text-white px-2 py-1 rounded-full text-xs font-bold">
                    Verified
                </div>
                @endif
            </div>
            <!-- User Details -->
            <div class="ml-6">
                <h1 class="text-3xl font-bold">{{ $user->name }}</h1>
                <p class="text-lg text-gray-600">{{ $user->bio }}</p>
            </div>
        </div>
        <!-- Social Media Links -->
        <div class="flex items-center">
            <a href="#" class="text-gray-600 hover:text-blue-500 mr-4">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <!-- Your social media icon here (e.g., Twitter) -->
                </svg>
            </a>
            <a href="#" class="text-gray-600 hover:text-blue-500 mr-4">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <!-- Your social media icon here (e.g., Facebook) -->
                </svg>
            </a>
            <!-- Add more social media links as needed -->
        </div>
    </div>

    <!-- Statistics -->
    <div class="flex justify-between mb-8">
        <div class="text-center">
            <p class="text-lg font-semibold">{{ $user->followers()->count() }}</p>
            <p class="text-gray-600">Followers</p>
        </div>
        <div class="text-center">
            <p class="text-lg font-semibold">{{ $user->following()->count() }}</p>
            <p class="text-gray-600">Following</p>
        </div>
        <div class="text-center">
            <p class="text-lg font-semibold">{{ $user->posts()->count() }}</p>
            <p class="text-gray-600">Posts</p>
        </div>
        <!-- Add more statistics as needed -->
    </div>

    <!-- Toggle buttons for Feed and Liked Posts -->
    <div class="flex justify-center mb-4">
        <button id="showFeed" class="mr-4 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded transition duration-300">
            My Feed
        </button>
        <button id="showLiked" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded transition duration-300">
            Liked Posts
        </button>
    </div>

    <!-- Feed or Liked posts content -->
    <div id="feedContent" class="hidden">
        <!-- Your feed content here -->
    </div>
    <div id="likedContent" class="hidden">
        <!-- Your liked posts content here -->
    </div>
</div>

<!-- JavaScript to handle toggling content -->
<script>
    const showFeedBtn = document.getElementById('showFeed');
    const showLikedBtn = document.getElementById('showLiked');
    const feedContent = document.getElementById('feedContent');
    const likedContent = document.getElementById('likedContent');

    showFeedBtn.addEventListener('click', () => {
        showFeedBtn.classList.add('bg-blue-500', 'text-white');
        showFeedBtn.classList.remove('bg-gray-300', 'text-gray-800');
        showLikedBtn.classList.add('bg-gray-300', 'text-gray-800');
        showLikedBtn.classList.remove('bg-blue-500', 'text-white');
        feedContent.classList.remove('hidden', 'opacity-0');
        likedContent.classList.add('hidden', 'opacity-0');
        setTimeout(() => {
            likedContent.classList.add('hidden');
        }, 300); // Duration should match transition duration
    });

    showLikedBtn.addEventListener('click', () => {
        showLikedBtn.classList.add('bg-blue-500', 'text-white');
        showLikedBtn.classList.remove('bg-gray-300', 'text-gray-800');
        showFeedBtn.classList.add('bg-gray-300', 'text-gray-800');
        showFeedBtn.classList.remove('bg-blue-500', 'text-white');
        likedContent.classList.remove('hidden', 'opacity-0');
        feedContent.classList.add('hidden', 'opacity-0');
        setTimeout(() => {
            feedContent.classList.add('hidden');
        }, 300); // Duration should match transition duration
    });
</script>

