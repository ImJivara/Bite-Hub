<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Tools</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/kTcsm6FQ4RSAP9z9b8fqjeanU/6lmV4DJEFuOWzTpBdaJ98loG8mGbB6iTP6y7H5NU6tuGt+OMj8w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="{{asset('js\ErrorHandle.js')}}"></script>
    <script src="{{asset('jquery-3.7.1.js')}}"></script>
    <style>
        
        .montserrat{
            font-family: "Montserrat", sans-serif;
            font-optical-sizing: auto;
            font: weight 1px;;
            font-style: normal;
        }
        .nav-item {
            position: relative;
            overflow: hidden;
            padding: 0.5rem 1rem;
            border-radius: 9999px; 
            transition: background-color 0.5s ease-in-out;
        }

        .nav-item:hover {
            background-color: black;
            color: white;
        }

        .navbar-container {
            border: 2px solid black;
            border-radius: 9999px; 
            padding: 0.5rem 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }
    </style>
</head>

<body class="montserrat">
        <!-- Error Handler --><!-- Error Handler --><!-- Error Handler -->
        <!-- <div id="error-message" class="error-message"></div>  -->
        <!-- Error Handler --><!-- Error Handler --><!-- Error Handler -->
    <!-- Navigation Bar -->
    <nav class="p-4 flex justify-between items-center mt-4">
        <div class="flex items-center space-x-2">
            <a href="/" class="text-2xl font-bold text-black">Bite-Hub.com</a>
            <p class="bg-green-300 text-black py-1 px-2 rounded-full">Healthy</p>
        </div>
        <div class="navbar-container">
            <a href="#bmi-calculator" class="nav-item text-black hover:text-white ">BMI Calculator</a>
            <a href="#calorie-counter" class="nav-item text-black hover:text-white">Calorie Counter</a>
            <a href="#nutrition-tracker" class="nav-item text-black hover:text-white">Nutrition Tracker</a>
            <a href="#workout-planner" class="nav-item text-black hover:text-white">Workout Planner</a>
        </div>
        @auth
            <h2  class="text-xl font-bold text-black">Hello, {{Auth::user()->name}}</h2>
        @else 
            <a href="/Login" class="bg-black text-white py-2 px-4 rounded-full">LOGIN</a>
        @endauth
    </nav>

    <!-- Main Content -->
<section >
    <div  id="tool-sections" >
                <!-- BMI Calculator Section -->
                <section id="bmi-calculator" class="hidden">        
                        <x-HealthComponents.BMICalculator/>
                </section>
                <!-- Calorie Counter Section -->
                <section id="calorie-counter" class="hidden">
                    <x-HealthComponents.CalorieCounter/>     
                </section>
                <!-- Nutrition Tracker Section -->
                <section id="nutrition-tracker" class="hidden">      
                <div class="grid  items-start grid-cols-3 md:grid-cols-3 lg:grid-cols-3 gap-6"> 
                    <x-HealthComponents.LogDisplay/>
                    <x-HealthComponents.nutritionfetch/>
                    <x-piecharts.testpiechart/>       
                </div>
                </section>
                <!-- Workout Planner Section -->
                <section id="workout-planner" class="hidden">
                    <x-HealthComponents.WorkoutPlanner/>
                </section>
    </div>
</section>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toolLinks = document.querySelectorAll('nav a[href^="#"]');
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
                    if (targetSection) {
                        targetSection.classList.remove('hidden');
                    }
                });
            });
        });
    </script>
    <!-- Toast div for notifications -->
    <div id="toast" class="fixed bottom-0 right-0 m-8 p-4 bg-gray-900 text-white rounded shadow-lg hidden"></div>
</body>

</html>