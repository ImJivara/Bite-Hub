@props(['user'])

<form id="followForm{{ $user->id }}" action="{{ route('follow', $user->id) }}" method="GET">
    @csrf
    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full mt-2 transition duration-300">
        Follow
    </button>
</form>
