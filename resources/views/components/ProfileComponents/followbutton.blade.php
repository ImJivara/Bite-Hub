@props(['user'])

<button id="followButton" data-user-id="{{ $user->id }}"
    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full mt-2 transition duration-300">
    Follow
</button>
