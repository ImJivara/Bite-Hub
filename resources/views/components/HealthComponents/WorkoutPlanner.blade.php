
<head>
    <title>Workout Planner</title>
</head>


<div class="flex justify-center h-screen">
    <div class="max-w-2xl w-full bg-white shadow-xl rounded-lg overflow-hidden p-8">
        <h2 class="text-2xl font-bold mb-4 text-center text-black">Workout Planner</h2>
        
        <div class="flex space-x-4 mb-4">
            <select id="workout-type" class="flex-1 appearance-none bg-gray-200 border border-gray-200 text-black py-2 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                <option value="10">Legs</option>
                <option value="8">Shoulders</option>
                <option value="12">Back</option>
                <option value="5">Biceps/Triceps</option>
                <option value="14">Chest</option>
                <option value="6">Abs/Core</option>
                <option value="7">Cardio</option>
                <option value="9">Calves</option>
                <option value="13">Glutes</option>
            </select>
            <input type="text" id="search" placeholder="Search workouts..." class="flex-1 py-2 px-4 border rounded focus:outline-none focus:border-blue-500">
            <button id="fetch-workouts" class="bg-green-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Get Workouts</button>
        </div>
        
        <div id="workouts" class="mt-4"></div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#fetch-workouts').click(function() {
            fetchWorkouts();
        });

        $('#search').on('input', function() {
            filterWorkouts($(this).val());
        });

        function fetchWorkouts() {
            var type = $('#workout-type').val();

            $.ajax({
                url: '/get-workouts',
                type: 'GET',
                data: { type: type },
                success: function(data) {
                    displayWorkouts(data.results);
                }
            });
        }

        function filterWorkouts(keyword) {
            var filteredWorkouts = [];
            var type = $('#workout-type').val();

            $.ajax({
                url: '/get-workouts',
                type: 'GET',
                data: { type: type },
                success: function(data) {
                    data.results.forEach(function(workout) {
                        if (workout.name.toLowerCase().includes(keyword.toLowerCase())) {
                            filteredWorkouts.push(workout);
                        }
                    });

                    displayWorkouts(filteredWorkouts);
                }
            });
        }

        function displayWorkouts(workouts) {
            var workoutsHtml = '<ul class="mt-4">';
            workouts.forEach(function(workout) {
                workoutsHtml += '<li class="py-2 px-4 border-b">' + workout.name + '</li>';
            });
            workoutsHtml += '</ul>';

            $('#workouts').html(workoutsHtml);
        }
    });
</script>


