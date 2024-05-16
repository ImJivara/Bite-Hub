@props(['featuredrec'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    
    <style>
        .swiper-container {
            width: 100%;
            height: 100%;
            overflow: hidden;
            position: relative;
            z-index: 1;
        }

        .swiper-slide {
            display: flex;
            justify-content: center;
            align-items: center;
            transition: transform 0.5s ease;
           
        }

        .swiper-button-next, .swiper-button-prev {
            color: #000;
            width: 30px;
            height: 30px;
            margin-top: -25px;
            position: absolute;
            top: 50%;
            z-index: 10;
        }

        .swiper-button-next {
            right: 10px;
        }

        .swiper-button-prev {
            left: 10px;
        }

        .swiper-slide-active {
            transform: scale(1.05);
        }

        .swiper-slide-next,
        .swiper-slide-prev {
            opacity: 0.5;
        }
    </style>
</head>
<body>
    <div class="max-w-screen-xl mx-auto px-4 py-8" id="featured">
        <div class="mb-6">
            <h2 class="text-3xl font-semibold">Our Featured Recipes for Today</h2>
        </div>
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <!-- Repeat this block for each recipe -->
                @foreach([1, 2, 3] as $index) <!-- Dummy loop for 3 slides -->
                <div class="swiper-slide">
                    <div class="recipe-card-wrapper max-h-80 rounded-lg overflow-hidden shadow-xl flex items-center">
                        <div class="w-1/3">
                            <img class="h-auto object-cover transition-transform duration-300 hover:transform hover:scale-105 hover:shadow-lg" src="{{ asset('imgs/'.$featuredrec->id.'.jpg') }}" alt="Featured Recipe Image">
                        </div>
                        <div class="h-100 p-6 w-2/3">
                            <h1 class="text-6xl font-semibold text-gray-800 mb-4">{{ $featuredrec->RecipeName }} 
                        @if ($index==1)
                        <span class="text-red-800 text-4xl">This Week's Most Liked Recipe</span>
                        @elseif($index==2)
                        <span class="text-red-800 text-4xl">Our Most Recent Recipe</span>
                        @else 
                        <span class="text-red-800 text-4xl">And Don't Forget, Today's Featured Recipe</span>
                        @endif
                        </h1>
                            @if (strlen($featuredrec->Description) > 600)
                                <p class="text-gray-700 font-medium">{{ \Illuminate\Support\Str::limit($featuredrec->Description, 800, $end='...') }}</p>
                                <button id="toggleBtn_{{ $featuredrec->id }}" onclick="toggleDescription('{{ $featuredrec->id }}')" class="text-blue-500 font-medium mt-2 focus:outline-none">Show More</button>
                            @else
                                <p class="text-gray-700 font-medium">{{ $featuredrec->Description }}</p>
                            @endif
                            <div class="flex items-center mb-2">
                                <span class="text-gray-600 mr-2">Rate this recipe:</span>
                                <div class="flex">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <button class="text-yellow-400 focus:outline-none" onclick="rateRecipe({{ $i }})">
                                            @if ($i <= $featuredrec->rating)
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 filled-star" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l4 4m0 0l4-4m-4 4V4"></path>
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 empty-star" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l4 4m0 0l4-4m-4 4V4"></path>
                                                </svg>
                                            @endif
                                        </button>
                                    @endfor
                                </div>
                            </div>
                            <a href="/Recipe/{{ $featuredrec->id }}" class="text-blue-500 font-semibold block">View Recipe</a>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- End of Recipe Slide -->
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <!-- Add Navigation -->
            <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        </div>
    </div>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var swiper = new Swiper('.swiper-container', {
                loop: false,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                centeredSlides: true,
                slidesPerView: 'auto',
                spaceBetween: 30,
                effect: 'slide',
                grabCursor: true,
            });
        });
    </script>
</body>
</html>
