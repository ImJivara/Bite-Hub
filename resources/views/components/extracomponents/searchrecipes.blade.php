<!-- Search Form -->
<form action="{{ route('recipes.search') }}" method="GET" class="flex items-center">
        <input type="text" placeholder="Search workouts...">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold px-4 py-2 rounded-r-lg focus:outline-none focus:shadow-outline">Search</button>
    </form>