<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    integrity="sha512-Fo3rlrZj/kTcsm6FQ4RSAP9z9b8fqjeanU/6lmV4DJEFuOWzTpBdaJ98loG8mGbB6iTP6y7H5NU6tuGt+OMj8w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<style>
    .montserrat {
        font-family: "Montserrat", sans-serif;
        font-optical-sizing: auto;
        font-weight: <weight>;
        font-style: normal;
    }
</style>
<script src="{{ asset('jquery-3.7.1.js') }}"></script>
<!-- <link href="{{ asset('css/tailwindstyles.css') }}" rel="stylesheet"> -->

<div class="mx-auto max-w-7xl p-4 Montserrat">
    <div class="flex items-center mb-6">
        <button onclick="goBack()"
            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md flex items-center gap-1">
            <i class="fas fa-arrow-left"></i>
            <span>Back</span>
        </button>
    </div>
    <!-- Profile Header -->
    <div class="profile-header flex flex-col items-center">
        <div class="flex items-center justify-center w-full mb-8">
            <div class="w-40 h-40 relative">
                <img class="w-full h-full rounded-full object-cover" src="{{ asset('imgs/3.jpg') }}"
                    alt="Profile Picture">
            </div>
            <div class="ml-8">
                <h1 class="text-3xl font-semibold">@ {{ $user->username }}</h1>

                <p class="text-gray-600">{{ $user->location }}</p>
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
                @if (Auth::user() != $user)
                    <!-- Check if the user is not viewing their own profile -->
                    <div id="followUnfollowButton">
                        @if (auth()->user()->isfollowing($user->id))
                            <x-ProfileComponents.unfollowbutton :user="$user" />
                        @else
                            <x-ProfileComponents.followbutton :user="$user" />
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Tabs -->
    <div class="tabs mt-8 border-t border-gray-300 flex justify-center">
        <button class="tab p-4 text-center border-t-2 border-black active" onclick="showSection('posts')">POSTS</button>
    </div>

    <!-- Posts Section -->

    <div id="posts" class="tab-content grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-1">
        @forelse($posts as $post)
            <div
                class="relative bg-white rounded-md border border-gray-300 shadow-lg overflow-hidden hover:shadow-lg group">
                <!-- Post Image -->
                <div class="relative">
                    <a href="/Recipe/{{ $post->id }}">
                        <img src="{{ asset('imgs/' . $post->id . '.jpg') }}" alt="{{ $post->RecipeName }}"
                            class="w-full h-64 object-cover">
                        <!-- Hover effect -->
                        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <div class="text-white text-center">
                                <p class="text-lg"><i class="fas fa-heart"></i> {{ $post->NbLikes }}</p>
                                <p class="text-lg"><i class="fas fa-comment"></i> {{ $post->comments->count() }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-500 col-span-full">You have not liked any posts yet.</p>
        @endforelse
    </div>

    <x-ProfileComponents.followers :followers='$followers' />
    <x-ProfileComponents.followings :following='$following' />


    <script>
        $(document).ready(function() {
            $(document).on('click', '#followButton', function(e) {
                e.preventDefault();
                var userId = $(this).data('user-id');
                $.ajax({
                    type: 'POST',
                    url: '{{ route('follow', ':id') }}'.replace(':id', userId),
                    data: {
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#followUnfollowButton').html(`
                    <x-ProfileComponents.unfollowbutton :user="$user" />
                `);
                        // Update followers and following counts
                        $('#openFollowersModal span').html(response.followersCount);
                    },
                    error: function(err) {
                        console.error('Follow action failed: ' + err.responseText);
                    }
                });
            });

            $(document).on('click', '#unfollowButton', function(e) {
                e.preventDefault();
                var userId = $(this).data('user-id');
                $.ajax({
                    type: 'POST',
                    url: '{{ route('unfollow', ':id') }}'.replace(':id', userId),
                    data: {
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#followUnfollowButton').html(`
                    <x-ProfileComponents.followbutton :user="$user" />
                `);
                        // Update followers and following counts
                        $('#openFollowersModal span').html(response.followersCount);
                    },
                    error: function(err) {
                        console.error('Unfollow action failed: ' + err.responseText);
                    }
                });
            });
        });
        function goBack() {
            window.history.back();
        }
    </script>

    </body>

    </html>
