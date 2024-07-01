@props(['comment'])

<div class="flex items-center mt-2 bg-gray-100 rounded-lg p-3 mb-3 duration-300 hover:transform hover:scale-105 hover:shadow-md">
    
    <div class="flex flex-col flex-grow">
        <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ $comment->author->name }}:</h3>
        <p class="text-base text-gray-700">{{ $comment->body }}</p>
    </div>
   
</div>
