<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="{{ asset('/layoutcss.css') }}"> 
    <script src="{{asset('jquery-3.7.1.js')}}"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="/resources/views/components/sidebar.blade.php" type="module"></script>
    <script src="{{asset('js\ErrorHandle.js')}}"></script>
  <title>The Foodies Blog</title>
</head>
<body>
<!-- Sidebar --><!-- Sidebar --><!-- Sidebar -->
        <x-sidebar/>
<!-- Sidebar --><!-- Sidebar --><!-- Sidebar -->  

<!-- Error Handler --><!-- Error Handler --><!-- Error Handler -->
        <div id="error-message" class="error-message"></div> 
 <!-- Error Handler --><!-- Error Handler --><!-- Error Handler -->

<header class="header"> 
    <div class="container">
        <div class="logo">
            <h1><a href="/Recipes" >The Foodies Blog</a></h1>
            <p>Exploring the Art of Food</p>
        </div>
        <nav class="navigation">
            <ul>
                <!-- <li><a href="/Home">Home</a></li>
                <li><a href="/Recipes">Recipes</a></li>
                <li><a href="#">About</a></li>
                <li><a href="/Contact">Contact</a></li> -->
            </ul>
        </nav>

    <div class="login-signup" style= "display: flex; justify-content: space-between; align-items: center; ">
        @if(Auth::user())
        <p class="mr-4">Hello, {{Auth::user()->name}} <a href="/Logout"  style="color:#DD0525; font-weight: bolder;">Logout</a></p>
        @else
        <p class="mr-7">Guest User, <a href="/Login"  style="color:#DD0525; font-weight: bolder;">Login</a></p>   
        @endif
        <x-sidebarcomp />
        <!-- profile photo component huta hun -->
    </div>
</div>
</header> 
    <div class="meal-options">
                <a href="#">Breakfast</a>
                <a href="#">Lunch</a>
                <a href="#">Dinner</a>
                <a href="#">Dessert</a>
    </div>
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
<div class="bg-gray-100 py-12 mt-8 text-center">
    <h2 class="text-3xl font-bold mb-4">What Our Users Say</h2>
    <div class="max-w-3xl mx-auto space-y-6">
        <div class="p-6 bg-white rounded-lg shadow-lg">
            <p class="text-lg italic">"These recipes are amazing! I've tried several and they all turned out delicious."</p>
            <p class="mt-4 font-bold">- Jane Doe</p>
        </div>
        <div class="p-6 bg-white rounded-lg shadow-lg">
            <p class="text-lg italic">"I love the variety and the step-by-step instructions. Cooking has never been this fun!"</p>
            <p class="mt-4 font-bold">- John Smith</p>
        </div>
    </div>
</div>

<div class="bg-gray-100 py-12 mt-8 text-center">
    <h2 class="text-3xl font-bold mb-4">About Us</h2>
    <div class="max-w-2xl mx-auto">
        <p class="text-lg mb-6">We are passionate about bringing you the best recipes from around the world. Our team of experienced chefs and food enthusiasts work hard to curate and create recipes that are easy to follow and delicious to taste. Whether you're a beginner or a seasoned cook, you'll find something to love here.</p>
    </div>
</div>

<div class="bg-gray-100 py-12 mt-8 text-center">
    <h2 class="text-3xl font-bold mb-4">Gallery</h2>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <div class="overflow-hidden rounded-lg">
                <img src="{{ asset('imgs/1.jpg') }}" alt="Gallery Image" class="w-full h-full object-cover">
            </div>
            <div class="overflow-hidden rounded-lg">
                <img src="{{ asset('imgs/2.jpg') }}" alt="Gallery Image" class="w-full h-full object-cover">
            </div>
            <div class="overflow-hidden rounded-lg">
                <img src="{{ asset('imgs/3.jpg') }}" alt="Gallery Image" class="w-full h-full object-cover">
            </div>
            <div class="overflow-hidden rounded-lg">
                <img src="{{ asset('imgs/4.jpg') }}" alt="Gallery Image" class="w-full h-full object-cover">
            </div>
    </div>
</div>

<div class="bg-gray-100 py-12 mt-8 text-center">
    <h2 class="text-3xl font-bold mb-4">Get in Touch</h2>
    <p class="text-lg mb-6">Have questions or feedback? We'd love to hear from you! Reach out to us at <a href="mailto:info@yourwebsite.com" class="text-blue-500">info@yourwebsite.com</a>.</p>
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
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="max-w-sm bg-white rounded-lg shadow-lg overflow-hidden">
                <iframe width="100%" height="215" src="https://www.youtube.com/embed/aopS3q6f1GY?controls=0"> frameborder="1" allowfullscreen></iframe>
                <div class="p-6">
                    <h3 class="font-bold text-xl">test2 </h3>
                </div>
            </div>
            <div class="max-w-sm bg-white rounded-lg shadow-lg overflow-hidden">
                <iframe width="100%" height="215" src="https://www.youtube.com/embed/bsYzWK3cxOM" frameborder="0" allowfullscreen></iframe>
                <div class="p-6">
                    <h3 class="font-bold text-xl">test2</h3>
                </div>
            </div>
            <div class="max-w-sm bg-white rounded-lg shadow-lg overflow-hidden">
                <iframe width="100%" height="215" src="https://www.youtube.com/embed/YrHpeEwk_-U" frameborder="0" allowfullscreen></iframe>
                <div class="p-6">
                    <h3 class="font-bold text-xl">test3</h3>
                </div>
            </div>
    </div>
</div>
<!-- Ending section -->












































<footer class="text-white py-12 mt-8" style="background-color: rgb(12, 4, 4);">
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
