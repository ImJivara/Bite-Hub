<!DOCTYPE html>
<html>
<head>
    <title>{{ $exercise['name'] }} - Exercise Details</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="flex items-center justify-center h-screen">
    <div class="max-w-lg w-full bg-white shadow-xl rounded-lg overflow-hidden p-8">
        <h2 class="text-2xl font-bold mb-4 text-center text-black">{{ $exercise['name'] }}</h2>

        <div class="text-gray-600 mb-4">{{ $exercise['description'] }}</div>
        
        <ul class="list-disc pl-4">
            <li><strong>Category:</strong> {{ $exercise['category']['name'] }}</li>
            <li><strong>Muscles Targeted:</strong> {{ implode(', ', $exercise['muscles']) }}</li>
            <li><strong>Equipment:</strong> {{ implode(', ', $exercise['equipment']) }}</li>
        </ul>
        
        @if (!empty($exercise['images']))
            <div class="mt-4">
                <strong>Images:</strong><br>
                @foreach ($exercise['images'] as $image)
                    <img src="{{ $image['image'] }}" alt="{{ $image['status'] }}" class="mt-2 rounded-lg shadow-md">
                @endforeach
            </div>
        @endif
    </div>
</div>

</body>
</html>
