@props(['comment'])

<div class="flex items-center mt-2 bg-gray-100 rounded-lg p-3 mb-3 duration-300 hover:transform hover:scale-105 hover:shadow-md">
    
    <div class="flex flex-col flex-grow">
        <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ $comment->author }}:</h3>
        <p class="text-base text-gray-700">{{ $comment->body }}</p>
    </div>
    <div class="flex items-center">
        <button class="mr-2 text-gray-500 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
            </svg>  
        </button>
        <span class="text-gray-600">12 Likes</span>
        <button class="ml-2 text-gray-500 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>
        <span class="text-gray-600 ml-2">3 Dislikes</span>
    </div>
</div>
