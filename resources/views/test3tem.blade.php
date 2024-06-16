<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="{{ asset('/layoutcss.css') }}"> 
    <script src="{{asset('jquery-3.7.1.js')}}"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/kTcsm6FQ4RSAP9z9b8fqjeanU/6lmV4DJEFuOWzTpBdaJ98loG8mGbB6iTP6y7H5NU6tuGt+OMj8w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- <script src="/resources/views/components/sidebar.blade.php" type="module"></script> -->
    <script src="{{asset('js\ErrorHandle.js')}}"></script>
  <title>Bite-Hub</title>
  <style>
     .montserrat{
            font-family: "Montserrat", sans-serif;
            font-optical-sizing: auto;
            font-weight: <weight>;
            font-style: normal;
        }
  </style>
</head>
<body class="montserrat">
    
<!-- Error Handler --><!-- Error Handler --><!-- Error Handler -->
<div id="error-message" class="error-message"></div> 
 <!-- Error Handler --><!-- Error Handler --><!-- Error Handler -->
<!-- Navbar -->
<nav class="p-4 flex justify-around items-center mt-6">
    <div class="logo flex items-center space-x-4">
        <div>
            <a href="#" class="text-3xl font-bold text-black">Bite-Hub.com</a>
            <p class="text-gray-600 text-xl">Exploring the Art of Food</p>
        </div>
        <div>
            <img src="{{ asset('imgs/Website Logo Cropped.png') }}" class="w-20 h-20 p-0">
        </div>
    </div>
    <div class="navbar-container flex space-x-4">
        <a href="/" class="nav-item text-black text-xl">Home</a>
        <a href="/HealthTools" class="nav-item text-black text-xl">For You Page</a>
        <a href="/HealthTools" class="nav-item text-black text-xl">Our Health Tools</a>
        <div class="relative dropdown">
            <a href="#" class="nav-item text-black text-xl">Categories</a>
            <div class="meal-options absolute bg-white shadow-lg rounded-lg hidden">
                <a href="#Breakfast" class="category-link" data-category="breakfast">Breakfast</a>
                <a href="#Breakfast" class="category-link" data-category="lunch">Lunch</a>
                <a href="#Dinner" class="category-link" data-category="dinner">Dinner</a>
                <a href="/" class="category-link" data-category="dessert">Dessert</a>
            </div>
        </div>
    </div>
    <div class="login-signup flex items-center space-x-4">
        @if(Auth::user())
        <p class="mr-4 text-lg">Hello, <span class="capitalize">{{ Auth::user()->name }}</span> <a href="/Logout" style="color:#DD0525; font-weight: bolder;">Logout</a></p>
        @else
        <p class="mr-7 text-lg">Guest User <a href="/Login" class="bg-black text-white py-2 px-4 rounded-full">LOGIN</a></p>
        @endif
        <x-sidebarcomp />
        <!-- profile photo component -->
    </div>
</nav>

<script>
   document.addEventListener("DOMContentLoaded", function() {
        const dropdown = document.querySelector('.dropdown');
        const dropdownMenu = dropdown.querySelector('.meal-options');
        const categoryLinks = dropdownMenu.querySelectorAll('.category-link');

        // Show dropdown on hover
        dropdown.addEventListener('mouseenter', function() {
            dropdownMenu.classList.remove('hidden');
        });

        // Keep dropdown open when hovering over it
        dropdownMenu.addEventListener('mouseenter', function() {
            dropdownMenu.classList.remove('hidden');
        });

        // Hide dropdown on mouse leave (from dropdown itself)
        

        // Hide dropdown on mouse leave (from dropdown menu)
        dropdownMenu.addEventListener('mouseleave', function() {
            dropdownMenu.classList.add('hidden');
        });
        });
</script>
   <!-- Sidebar --><!-- Sidebar --><!-- Sidebar -->
   <x-sidebar/>
<!-- Sidebar --><!-- Sidebar --><!-- Sidebar -->  





    <!--################################Contents################################-->
    <div class="contents">
        @yield('content_body')
    </div>
    <!--################################Contents################################-->

<!-- Ending section -->
    <!-- Nice Ending Section -->
    <div class="bg-gray-100 py-12 mt-8 text-center">
    <h2 class="text-3xl font-bold mb-4">Stay Updated with Our Latest Recipes!</h2>
    <p class="text-lg mb-6">Subscribe to our newsletter to receive delicious recipes and cooking tips straight to your inbox.</p>
    <form class="max-w-md mx-auto">
        <div class="flex items-center border-b border-b-2 border-gray-300 py-2">
            <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="email" placeholder="Enter your email" aria-label="Email">
            <button class="flex-shrink-0 bg-blue-500 hover:bg-blue-700 border-blue-500 hover:border-blue-700 text-sm border-4 text-white py-1 px-2 rounded" type="button">
                Subscribe
            </button>
        </div>
    </form>
</div>
<div class="relative h-64 overflow-hidden mb-8">
    <div class="absolute inset-0 bg-fixed bg-center bg-cover" style="background-image: url({{ asset('imgs/3.jpg') }});"></div>
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="relative z-10 flex items-center justify-center h-full">
        <h2 class="text-3xl font-bold text-white">Join Our Cooking Community</h2>
    </div>
</div>


<div class="bg-gray-100 py-12 mt-8 text-center">
    <h2 class="text-3xl font-bold mb-4">Our Community Creations</h2>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @php
            $array = [
                asset('imgs/3.jpg'),
                asset('imgs/2.jpg'),
                asset('imgs/3.jpg'),
                asset('imgs/4.jpg')
            ];
        @endphp
        @foreach($array as $photo)
            <div class="overflow-hidden rounded-lg">
                <img src="{{ $photo }}" alt="User Photo" class="w-full h-full object-cover">
                <p class="mt-2 text-sm text-gray-600">{{ $photo }}</p>
            </div>
        @endforeach
    </div>
</div>











<div class="bg-gray-100 py-12 mt-8 text-center">
    <h2 class="text-3xl font-bold mb-4">Watch Our Video Tutorials</h2>
    <div class="flex flex-col md:flex-row justify-center items-center gap-24 mt-14">
            <div class="max-w-sm bg-white rounded-lg shadow-lg overflow-hidden">
=                <div class="p-6">
                    <h3 class="font-bold text-xl">test2 </h3>
                </div>
            </div>
            <div class="max-w-sm bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <h3 class="font-bold text-xl">test2</h3>
                </div>
            </div>
            <div class="max-w-sm bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <h3 class="font-bold text-xl">test3</h3>
                </div>
            </div>
    </div>
</div>
<!-- Ending section -->

<footer class="text-white py-12 mt-8" style="background-color: rgb(12, 9, 10);">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Footer Column 1 -->
            <div class="footer-col">
                <h3 class="text-xl font-semibold mb-4">About Us</h3>
                <p class="text-base">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique.</p>
            </div>
            <!-- Footer Column 2 -->
            <div class="footer-col">
                <h3 class="text-xl font-semibold mb-4">Quick Links</h3>
                <ul class="text-base">
                    <li><a href="/">Home</a></li>
                    <li><a href="{{ route('Services') }}">Services</a></li>
                    <li><a href="{{ route('Contact') }}">Contact</a></li>
                </ul>
            </div>
            <!-- Footer Column 3 -->
            <div class="footer-col">
                <h3 class="text-xl font-semibold mb-4">Connect With Us</h3>
                <ul class="text-base">
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Twitter</a></li>
                    <li><a href="#">Instagram</a></li>
                    <li><a href="#">Pinterest</a></li>
                </ul>
            </div>
            <!-- Footer Column 4 -->
            <div class="footer-col">
                <h3 class="text-xl font-semibold mb-4">Newsletter</h3>
                <p class="text-base mb-4">Sign up for our newsletter to receive updates and exclusive offers.</p>
                <form action="#" method="POST" class="flex">
                    <input type="email" name="email" placeholder="Your Email" class="border border-gray-600 px-3 py-1 rounded-l-md focus:outline-none">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded-r-md">Subscribe</button>
                </form>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
