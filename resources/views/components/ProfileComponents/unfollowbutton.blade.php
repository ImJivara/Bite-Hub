@props(['user'])

<form id="unfollowForm{{ $user->id }}" action="{{ route('unfollow', $user->id) }}" method="GET">
    @csrf
    @method('DELETE')
    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full mt-2 transition duration-300">
        Unfollow
    </button>
</form>
