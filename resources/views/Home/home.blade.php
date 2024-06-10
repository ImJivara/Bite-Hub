<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">


<!-- Hero Section -->
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


<!-- Featured Recipes Section -->
<!-- <section class="featured-recipes py-16">
    <div class="container mx-auto">
        <h2 class="text-3xl font-bold mb-8 text-center">Featured Recipes</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition duration-300 ease-in-out">
                <img class="w-full h-48 object-cover object-center" src="https://via.placeholder.com/600x400" alt="Recipe Image">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">Recipe Title</h3>
                    <p class="text-gray-700">Short description of the recipe...</p>
                    <a href="#" class="block text-blue-500 font-semibold mt-2 hover:text-blue-600">Read More</a>
                </div>
            </div>
           
        </div>
    </div>
</section> -->


<!-- About Us Section -->
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
    <div class="bg-gray-100 py-12 mt-8 text-center transition-transform duration-300 hover:transform hover:scale-105 hover:shadow-lg">
        <h2 class="text-3xl font-bold mb-4">Get in Touch</h2>
        <p class="text-lg mb-6">Have questions or feedback? We'd love to hear from you! Reach out to us at <a href="mailto:Bitehub@gmail.org" class="text-blue-500">Bitehub@gmail.org</a>.</p>
    </div>
<section>


<!-- Follow Us Section -->
<section class="follow-us py-16 shadow-xl ">
    <div class="container mx-auto text-center">
        <h2 class="text-3xl font-bold mb-4">Connect with Us</h2>
        <p class="text-lg mb-14">Stay updated on the latest recipes, cooking tips, and foodie adventures by following us on social media.</p>
        <x-extracomponents.tooltip/>
    </div>
</section>


