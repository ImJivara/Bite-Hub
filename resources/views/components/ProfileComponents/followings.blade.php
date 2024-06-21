@props(['following'])

<div id="followingModal" class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg shadow-lg w-full sm:w-3/4 md:w-1/2 lg:w-1/3">
        <!-- Modal header -->
        <div class="bg-white text-black px-4 py-2 flex justify-between items-center border-b">
            <h2 class="text-xl font-semibold">Following</h2>
            <button id="closeFollowingModal" class="text-black hover:text-gray-600 text-2xl" onclick="closeModal('followingModal')">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="p-4 max-h-96 overflow-y-auto">
            <div class="grid grid-cols-1 gap-4">
                @forelse ($following as $follow)
                    <div class="flex items-center space-x-4">
                        <img src="{{ asset('imgs/user.jpg') }}" alt="Profile Picture" class="w-12 h-12 rounded-full border">
                        <div class="flex-grow">
                            <h3 class="text-sm font-semibold">{{ $follow->name }}</h3>
                            <p class="text-gray-500 text-xs">{{ $follow->location }}</p>
                        </div>
                        @if ($follow->id !== auth()->id())
                        <div id="followUnfollowButton{{ $follow->id }}">
                            @if (auth()->user()->isFollowing($follow->id))
                                <x-ProfileComponents.unfollowbutton :user='$follow' />
                            @else
                                <x-ProfileComponents.followbutton :user='$follow' />
                            @endif
                        </div>
                        @endif
                    </div>
                @empty
                    <p class="text-gray-500 col-span-full text-center">No followings yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script>
    // Function to open the modal
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }

    // Function to close the modal
    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

    // Event listener to open the Following modal
    document.getElementById('openFollowingModal').addEventListener('click', function () {
        openModal('followingModal');
    });

    // Event listener to close the Following modal
    document.getElementById('closeFollowingModal').addEventListener('click', function () {
        closeModal('followingModal');
    });
</script>




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
document.addEventListener('click', function(event) {
    if (event.target.matches('.follow-button')) {
        event.preventDefault();
        let userId = event.target.dataset.userId;
        let followForm = document.getElementById(`followForm${userId}`);
        
        fetch(followForm.action, {
            method: 'GET',
            body: new FormData(followForm),
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}'
            }
        })
        .then(response => {
            if (response.ok) {
                // Update UI for follow action
                let followUnfollowDiv = document.getElementById(`followUnfollowButton${userId}`);
                followUnfollowDiv.innerHTML = 'Unfollow'; // Update button text or HTML
                event.target.classList.remove('follow-button'); // Remove follow button class
                event.target.classList.add('unfollow-button'); // Add unfollow button class
                event.target.textContent = 'Unfollow'; // Update button text
            } else {
                console.error('Error:', response);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
    
    if (event.target.matches('.unfollow-button')) {
        event.preventDefault();
        let userId = event.target.dataset.userId;
        let unfollowForm = document.getElementById(`unfollowForm${userId}`);
        
        fetch(unfollowForm.action, {
            method: 'GET',
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}'
            }
        })
        .then(response => {
            if (response.ok) {
                // Update UI for unfollow action
                let followUnfollowDiv = document.getElementById(`followUnfollowButton${userId}`);
                followUnfollowDiv.innerHTML = 'Follow'; // Update button text or HTML
                event.target.classList.remove('unfollow-button'); // Remove unfollow button class
                event.target.classList.add('follow-button'); // Add follow button class
                event.target.textContent = 'Follow'; // Update button text
            } else {
                console.error('Error:', response);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
});

    </script>