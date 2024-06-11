<style>

/* Add this CSS to your stylesheet */
.testimonial {
    opacity: 0;
    transform: scale(0.9);
    transition: opacity 0.8s ease-in-out, transform 0.8s ease-in-out;
}

.testimonial.animated {
    opacity: 1;
    transform: scale(1);
    transition-delay: 0.2s;
}




</style>

<section id="testimonials" class="hero bg-gradient-to-r from-green-400 to-blue-500 py-16 shadow-xl">
    <div class="container mx-auto text-center">
        <h2 class="text-4xl font-bold mb-12">What Our Readers Say</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Testimonial 1 -->
            <div class="testimonial bg-white rounded-lg shadow-md p-6">
                <p class="text-gray-700 mb-4">"This blog has transformed the way I cook. The recipes are easy to follow and delicious!"</p>
                <h3 class="text-xl font-semibold">- Mia Doe</h3>
            </div>
            <!-- Testimonial 2 -->
            <div class="testimonial bg-white rounded-lg shadow-md p-6">
                <p class="text-gray-700 mb-4">"I love the health tools provided here. They help me maintain a balanced diet effortlessly."</p>
                <h3 class="text-xl font-semibold">- Jake Smith</h3>
            </div>
            <!-- Testimonial 3 -->
            <div class="testimonial bg-white rounded-lg shadow-md p-6">
                <p class="text-gray-700 mb-4">"The blog is a treasure trove of culinary inspiration. I look forward to every new post!"</p>
                <h3 class="text-xl font-semibold">- Emily Johnson</h3>
            </div>
        </div>
    </div>
</section>

<script>

// Add this JavaScript code to your script
document.addEventListener("DOMContentLoaded", function() {
    var testimonials = document.querySelectorAll('.testimonial');

    function isInViewport(element) {
        var rect = element.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }

    function animateTestimonials() {
        testimonials.forEach(function(testimonial) {
            if (isInViewport(testimonial)) {
                testimonial.classList.add('animated');
            }
        });
    }

    animateTestimonials();

    window.addEventListener('scroll', function() {
        animateTestimonials();
    });
});

</script>