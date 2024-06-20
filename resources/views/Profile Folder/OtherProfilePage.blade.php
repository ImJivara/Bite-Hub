<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link href="{{ asset('css/tailwindstyles.css') }}" rel="stylesheet">>>
    <script src="{{ asset('jquery-3.7.1.js') }}"></script>
</head>

<body class="bg-gray-100">

    <div class="mx-auto max-w-7xl p-4">

        <!-- Profile Header -->
        {{-- <div class="profile-header flex flex-col items-center bg-white shadow-lg rounded-lg p-6"> --}}
            <div class="flex items-center justify-center w-full mb-8">
                <div class="w-40 h-40 relative">
                    <img class="w-full h-full rounded-full object-cover" src="{{ asset('imgs/3.jpg') }}"
                        alt="Profile Picture">
                </div>
                <div class="ml-8 text-center">
                    <h1 class="text-3xl font-semibold">{{ $user->name}}</h1>
                    <p class="text-gray-600">{{ $user->location }}</p>
                    <div class="flex mt-4 space-x-4 justify-center">
                        <div class="text-center">
                            <span class="font-bold text-xl">330</span>
                            <p class="text-gray-600">Posts</p>
                        </div>
                        <div class="text-center cursor-pointer" id="openFollowersModal">
                            <span class="font-bold text-xl" id="follower_count">66</span>
                            <p class="text-gray-600">Followers</p>
                        </div>
                        <div class="text-center cursor-pointer" id="openFollowingModal">
                            <span class="font-bold text-xl" id="following_count">66</span>
                            <p class="text-gray-600">Following</p>
                        </div>
                        <script>
                            document.getElementById('openFollowingModal').addEventListener('click', function() {
                              openModal('followingModal');
                          })
                          </script>
                    </div>
                    @if (Auth::user() != $user)
                    <!-- Check if the user is not viewing their own profile -->
                        <div id="followUnfollowButton">
                            @if (auth()->user()->isFollowing($user->id))
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

        <div class="main-content">
            @yield('content')
        </div>

        <!-- Post Recipes Section -->
        <div id="posts" class="tab-content grid grid-cols-1 gap-6 ">
            @forelse($posts as $post)
            <div class="bg-white rounded-lg border border-gray shadow-lg overflow-hidden hover:shadow-lg">
                <!-- User Info -->
                <div class="flex items-center p-2">
                    <img src="{{ asset('imgs/3.jpg') }}" alt="User profile" class="w-12 h-12 rounded-full mr-2">
                    <div>
                        <p class="font-semibold text-2xl ">{{ $user->id}}</p>
                        @if ($post->created_at)
                            <p class="text-gray-500 text-sm">{{ $post->created_at->format('M d') }}</p>
                        @endif
                    </div>
                </div>
                <!-- Post Image -->
                <img src="{{ asset('imgs/'.$post->Recipe.'.jpg') }}" alt="{{ $post->RecipeName }}" class="w-full h-72 object-cover">
                <!-- Post Content -->
                <div class="p-4">
                    <h3 class="text-black text-3xl font-semibold mb-2">jjjjj</h3>
                    <p class="text-gray-600 text-xl">lllll</p>
                    <div class="mt-2">
                        <a href="/posts/{{ $post->id }}" class="text-blue-500 hover:underline inline-block">Read More</a>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-center text-gray-500 col-span-full">{{$user->name}} has not post any post yet.</p>
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

    <script>
        // Function to open the modal
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        // Function to close the modal
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        // Event listener to open the Followers modal
        document.getElementById('openFollowersModal').addEventListener('click', function() {
            openModal('followersModal');
        });

        // Event listener to close the Followers modal
        document.getElementById('closeFollowersModal').addEventListener('click', function() {
            closeModal('followersModal');
        });

        // Event listener to open the Following modal
        document.getElementById('openFollowingModal').addEventListener('click', function() {
            openModal('followingModal');
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

    <!-- Modal or overlay container -->
    <x-ProfileComponents.followers />
    <x-ProfileComponents.followings />

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
                $('#follower_count').html(response.followersCount);
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
                $('#follower_count').html(response.followersCount);
            },
            error: function(err) {
                console.error('Unfollow action failed: ' + err.responseText);
            }
        });
    });
});

    </script>
</body>

</html>
