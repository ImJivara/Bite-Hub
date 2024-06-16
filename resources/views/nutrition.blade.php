<!DOCTYPE html>
<html>
<head>
    <title>Nutrition Info</title>
</head>
<body>
    <h1>Nutrition Information</h1>
    @if(session('error'))
        <p>{{ session('error') }}</p>
    @else
        <p>Calories: {{ $calories }}</p>
        <p>Carbs: {{ $carbs }} g</p>
        <p>Protein: {{ $protein }} g</p>
        <p>Fat: {{ $fat }} g</p>
    @endif
</body>
</html>
