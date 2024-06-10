<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">






<section id="health-tools" class="py-16 bg-gradient-to-r from-purple-400 to-blue-500">
    <div class="container mx-auto text-center">
        <h2 class="text-4xl font-bold mb-8 text-white">Health Tools</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- BMI Calculator -->
            <div class="tool-card bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-semibold mb-4 text-gray-800">BMI Calculator</h3>
                <p class="text-gray-700 mb-4">Calculate your Body Mass Index (BMI) to assess your weight status and overall health.</p>
                <a href="#bmi-calculator" class="btn bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300 ease-in-out">Calculate BMI</a>
            </div>
            <!-- Calorie Counter -->
            <div class="tool-card bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-semibold mb-4 text-gray-800">Calorie Counter</h3>
                <p class="text-gray-700 mb-4">Track your daily calorie intake and set goals for weight management or fitness.</p>
                <a href="#calorie-counter" class="btn bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300 ease-in-out">Track Calories</a>
            </div>
            <!-- Nutrition Tracker -->
            <div class="tool-card bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-semibold mb-4 text-gray-800">Nutrition Tracker</h3>
                <p class="text-gray-700 mb-4">Log your daily food intake and track macronutrients and micronutrients.</p>
                <a href="#nutrition-tracker" class="btn bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300 ease-in-out">Track Nutrition</a>
            </div>
            <!-- Workout Planner -->
            <div class="tool-card bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-semibold mb-4 text-gray-800">Workout Planner</h3>
                <p class="text-gray-700 mb-4">Create personalized workout plans based on your fitness goals and equipment.</p>
                <a href="#workout-planner" class="btn bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300 ease-in-out">Plan Workouts</a>
            </div>
        </div>
        
    </div>
</section>
<!-- Tool Sections -->
<div id="tool-sections">
            <!-- BMI Calculator Section -->
            <section id="bmi-calculator" class="hidden">
                aa
            </section>
            <!-- Calorie Counter Section -->
            <section id="calorie-counter" class="hidden">
                <!-- Calorie Counter Content -->
            </section>
            <!-- Nutrition Tracker Section -->
            <section id="nutrition-tracker" class="hidden">
                <!-- Nutrition Tracker Content -->
            </section>
            <!-- Workout Planner Section -->
            <section id="workout-planner" class="hidden">
                <!-- Workout Planner Content -->
            </section>
        </div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const toolLinks = document.querySelectorAll('.tool-card a');
        const toolSections = document.querySelectorAll('#tool-sections section');

        // Hide all tool sections initially
        toolSections.forEach(section => {
            section.classList.add('hidden');
        });

        // Add click event listener to each tool link
        toolLinks.forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href').substring(1);
                const targetSection = document.getElementById(targetId);

                // Hide all tool sections
                toolSections.forEach(section => {
                    section.classList.add('hidden');
                });

                // Show the target tool section
                targetSection.classList.remove('hidden');
            });
        });
    });
</script>
