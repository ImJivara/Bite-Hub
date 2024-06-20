@props(['user'])

<button id="unfollowButton" data-user-id="{{ $user->id }}"
    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full mt-2 transition duration-300">
    Unfollow
</button>
