    @extends('test3tem')

    @section('content_body')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
            integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

        <div class="max-w-7xl mx-auto mt-6 px-4 h-screen overflow-y-auto space-y-6 flex">
            <!-- Posts Section -->
            <div class="flex-1">
                @forelse($posts as $post)
                    <div class="relative bg-white rounded-md border border-gray-300 shadow-lg overflow-hidden mb-6">
                        <!-- Top Section: User Info -->
                        <div class="flex items-center p-4 border-b border-gray-200">
                            <img src="{{ asset('storage/' . $post->author->profile_picture) }}" alt="Profile Picture"
                                class="w-10 h-10 rounded-full mr-3">
                            <div>
                                <p class="font-semibold text-gray-900">{{ $post->author->username }}</p>
                                <p class="text-gray-500 text-sm">{{ $post->created_at->diffForHumans() }}</p>
                            </div>
                        </div>

                        <!-- Middle Section: Post Image -->
                        <div class="p-4">
                            <a href="/Recipe/{{ $post->id }}">
                                <img src="{{asset('storage/' . $post->thumbnail)}}" alt="{{ $post->RecipeName }}"
                                    class="w-full h-80 object-cover rounded-md">
                            </a>
                        </div>

                        <!-- Bottom Section: Interaction and Comments Info -->
                        <div class="p-4">
                            <div class="flex justify-between items-center text-gray-600 mb-4">
                                <div class="flex space-x-4">
                                    <!-- Like Button with AJAX -->
                                    <button
                                        class="flex items-center space-x-1 transition-colors like-button {{ $post->likedByUsers()->where('user_id', Auth::id())->exists() ? 'text-red-500' : 'hover:text-red-500' }}"
                                        data-post-id="{{ $post->id }}">
                                        <i class="fas fa-heart"></i>
                                        <span class="like-count">{{ $post->NbLikes }}</span>
                                    </button>
                                    <!-- Comment Button -->
                                    <a href="/Recipe/{{ $post->id }}"
                                        class="flex items-center space-x-1 hover:text-blue-500 transition-colors">
                                        <i class="fas fa-comment"></i>
                                        <span>{{ $post->comments->count() }}</span>
                                    </a>
                                    @if ($post->comments->count() > 3)
                                        <a href="/Recipe/{{ $post->id }}" class="text-blue-500 hover:underline">View all
                                            comments</a>
                                    @endif
                                </div>
                            </div>

                            <!-- Display Comments (up to 3) using x-comment Component -->
                            <div class="space-y-2">
                                @forelse($post->comments->take(3) as $comment)
                                    <x-comment :comment='$comment' />
                                @empty
                                    <p class="text-gray-500 text-sm">No comments yet.</p>
                                @endforelse
                            </div>

                            <!-- Comment Form -->
                            <form action="{{ route('comments.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="recipe_id" value="{{ $post->id }}">
                                <div class="form-group">
                                    <input type="text" name="body" placeholder="Your comment" id="commentInput"
                                        maxlength="100"
                                        class="border border-gray-300 rounded-lg px-4 py-2 w-full focus:outline-none focus:border-red-500"
                                        value="{{ $body->value ?? '' }}">
                                    <p id="charCount" class="text-xs text-gray-500 mt-1">0 / 100 characters</p>
                                </div>
                                <button type="submit"
                                    class="bg-red-500 text-white px-4 py-2 mt-4 rounded-lg hover:bg-red-600 focus:outline-none">Submit</button>
                            </form>
                            <script>
                                const commentInput = document.getElementById('commentInput');
                                const charCount = document.getElementById('charCount');
                                commentInput.addEventListener('input', function() {
                                    const length = commentInput.value.length;
                                    charCount.textContent = length + ' / 300 characters';
                                });
                            </script>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500">No posts available.</p>
                @endforelse
            </div>

            <!-- Suggested Users Section -->
            <div
                class="absolute top-28 right-0 w-80 lg:w-84   overflow-y-auto bg-white rounded-md border border-gray-300 shadow-lg p-2 mt-6 mr-0">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-md font-semibold text-gray-900">Suggested for you</h2>
                </div>
                <div class="space-y-3">
                    @forelse ($suggestedUsers as $user)
                        <div class="flex items-center space-x-3">
                            <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture"
                                class="w-10 h-10 rounded-full">
                            <div class="flex-1">
                                <p class="font-semibold text-gray-800 text-sm">{{ $user->username }}</p>
                                <p class="text-gray-500 text-xs">Suggested for you</p>
                            </div>
                            <button class="text-blue-500 text-sm font-semibold hover:underline focus:outline-none follow-button"
                                data-user-id="{{ $user->id }}">Follow</button>
                        </div>
                    @empty
                        <p class="text-gray-500">No suggested users available.</p>
                    @endforelse
                </div>
                
            </div>
        </div>
        <!-- JavaScript for like button and comment functionality -->
        <script>
            $(document).ready(function() {
                // Click handler for follow buttons
                $(document).on('click', '.follow-button', function(event) {
                    event.preventDefault(); // Prevent default button behavior

                    var button = $(this);
                    var userId = button.data('user-id');

                    // Send AJAX request to follow/unfollow the user
                    $.ajax({
                        url: '/follow/' + userId,
                        type: 'get',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            console.log('AJAX Success:', response);

                            // Update button text and style
                        
                            location.reload();
                            

                        },
                        error: function(xhr) {
                            console.error('AJAX Error:', xhr.responseText);
                            alert('Something went wrong. Please try again.');
                        }
                    });
                });
            });


        </script>
<script>// Click handler for like buttons
    $(document).on('click', '.like-button', function(event) {
        event.preventDefault(); // Prevent default button behavior

        var button = $(this);
        var postId = button.data('post-id');

        // Send AJAX request to like/unlike the post
        $.ajax({
            url: '/Like/' + postId,
            type: 'get',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (!response.RecipeAlreadyLiked) {
                     // Update like count
                var likeCount = button.find('.like-count');
                likeCount.text(response.NbLikes);

                // Add animation class for visual feedback
                button.find('i').addClass('animate-like');
                }
                else
                likeCount.text(response.NbLikes);
            button.removeClass('text-red-500');

            },
            error: function(xhr) {
                console.error('AJAX Error:', xhr.responseText);
                alert('Something went wrong. Please try again.');
            }
        });
    });


// Remove animation class after animation ends
$(document).on('animationend', '.animate-like', function() {
    $(this).addClass('animate-like');
});
</script>

<!-- CSS for like button animation -->
<style>
@keyframes like-animation {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.3);
    }
    100% {
        transform: scale(1);
    }
}

.animate-like {
    animation: like-animation 0.3s ease-in-out;
    color: red;
}
</style></script>
    @endsection
