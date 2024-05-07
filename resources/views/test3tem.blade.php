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

  <title>Food Blog</title>
</head>
<body>
        

        
<x-sidebar/>  
<!-- Error Handler --><!-- Error Handler --><!-- Error Handler -->
<div id="error-message" class="error-message"></div> 
 <!-- Error Handler --><!-- Error Handler --><!-- Error Handler -->
    <header class="header"> 
        <div class="container">
            
            <div class="logo">
                <h1>Food Blog</h1>
                <p>Exploring the Art of Food</p>
            </div>
            <nav class="navigation">
                <ul>
                    <li><a href="/Home">Home</a></li>
                    <li><a href="/Recipes">Recipes</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="/Contact">Contact</a></li>
                </ul>
            </nav>


        <div class="login-signup" style= "display: flex; justify-content: space-between; align-items: center; ">
            @if(session('user'))
            <p class="mr-4">Hello, {{ session('user')->full_name }} <a href="/logout"  style="color:#DD0525; font-weight: bolder;">Logout?</a></p>
            @else
            <p class="mr-7">Guest User <a href="/Login"  style="color:#DD0525; font-weight: bolder;">Login?</a></p>   
            @endif
            <x-sidebarcomp />
            <!-- photo component huta hun -->
        </div>
    </div>
    </header>
    
    <div class="meal-options">
                <a href="#">Breakfast</a>
                <a href="#">Lunch</a>
                <a href="#">Dinner</a>
                <a href="#">Dessert</a>
    </div>
    <div class="contents">
    
    @yield('content_body')

    </div>
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
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Recipes</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact</a></li>
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
