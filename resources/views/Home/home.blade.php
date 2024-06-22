<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bite-hub</title>
</head>
<body>
<link href="{{ asset('css/tailwindstyles.css') }}" rel="stylesheet">
<section class="hero bg-gradient-to-r from-green-400 to-blue-500 text-white py-16 shadow-xl">
    <div class="container mx-auto ">
        <div class="text-center">
            <h2 class="text-4xl font-bold mb-4">Welcome to Your Culinary Journey</h2>
            <p class="text-xl mb-8">Discover a world of flavors, recipes, and culinary inspiration with Your Food Blog.</p>
        </div>
        <div class="flex flex-col md:flex-row justify-center items-center gap-6">
            <div>
                <x-hovercards/>
            </div>
        </div>
            <div class="mt-14">
                <x-extracomponents.cmdlikecard/>
            </div>      
    </div>  
</section>

<section class="about-us  py-16 shadow-xl">
    <div class="container mx-auto text-center">
        <h2 class="text-3xl font-bold mb-4">About Us</h2>
        <p class="text-lg mb-8">Learn more about the passionate team behind Your Food Blog and our mission to share the joy of cooking.</p>
        <div class="flex flex-col md:flex-row justify-center items-center gap-6 mt-14">
            <x-extracomponents.CreatorsCards2 name="Ahmad Afara"/>
            <x-extracomponents.CreatorsCards2 name="Daniel Deek"/>
        </div>
    </div>
</section>

<x-extracomponents.testimonial/>

<section>
    <div class="bg-black py-12  text-center text-white transition-transform duration-300 hover:transform hover:scale-105 hover:shadow-lg">
        <h2 class="text-3xl font-bold mb-4">Get in Touch</h2>
        <p class="text-lg mb-6">Have questions or feedback? We'd love to hear from you! Reach out to us at <a href="mailto:Bitehub@gmail.org" class="text-blue-500">Bitehub@gmail.org</a></p>
    </div>
<section>



<section class="follow-us py-16 shadow-xl ">
    <div class="container mx-auto text-center">
        <h2 class="text-3xl font-bold mb-4">Connect with Us</h2>
        <p class="text-lg mb-14">Stay updated on the latest recipes, cooking tips, and foodie adventures by following us on social media.</p>
        <x-extracomponents.tooltip/>
    </div>
</section>

</body>
</html>