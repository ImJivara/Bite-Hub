
    <link href="{{ asset('css/tailwindstyles.css') }}" rel="stylesheet">
    <style>
        @keyframes counter {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .counter-animate {
            animation: counter 1s ease-out;
        }
    </style>



    <section class="counter-section text-center text-white font-mono">
        <h2 class="text-3xl ">Site Statistics</h2>
        <div class="flex justify-around ">
            <div class="counter-animate">
                <p class="text-2xl" id="users-online">0</p>
                <p class="text-red-500">$Users-Online</p>
            </div>
            <div class="counter-animate">
                <p class="text-2xl" id="posts-posted">0</p>
                <p class="text-red-500">$Posts-Posted</p>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const usersOnlineElement = document.getElementById('users-online');
            const postsPostedElement = document.getElementById('posts-posted');

            const usersOnline = 1687; 
            const postsPosted = 9876; 

            function animateCounter(element, start, end, duration) {
                let startTimestamp = null;
                const step = (timestamp) => {
                    if (!startTimestamp) startTimestamp = timestamp;
                    const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                    element.innerHTML = Math.floor(progress * (end - start) + start);
                    if (progress < 1) {
                        window.requestAnimationFrame(step);
                    }
                };
                window.requestAnimationFrame(step);
            }

            animateCounter(usersOnlineElement, 0, usersOnline, 3500);
            animateCounter(postsPostedElement, 0, postsPosted, 3500);
        });
    </script>



