@props(['featuredrec','MostRecentRecipe'])
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
            <h2 class="text-4xl font-semibold">Our Featured Recipes for Today</h2>
        </div>
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @foreach([$featuredrec, $MostRecentRecipe, $featuredrec] as $index) <!-- Dummy loop for 3 slides -->
                <div class="swiper-slide">
                    <div class="recipe-card-wrapper max-h-80 rounded-lg overflow-hidden shadow-xl flex items-center">
                        <div class="w-1/3">
                            <img class="h-auto object-cover transition-transform duration-300 hover:transform hover:scale-105 hover:shadow-lg" src="{{asset('storage/' . $index->thumbnail)}}" alt="Featured Recipe Image">
                        </div>
                        <div class="h-100 p-6 w-2/3">
                            <h1 class="text-4xl font-semibold text-gray-800 mb-4">{{ $index->RecipeName }} 
                        @if ($index==$featuredrec)
                        <h3 class="text-red-800 text-2xl">This Week's Most Liked Recipe</h3>
                        @elseif($index==$MostRecentRecipe)
                        <h3 class="text-red-800 text-2xl">Our Most Recent Recipe</span>
                        @else 
                        <h3 class="text-red-800 text-2xl">And Don't Forget, Today's Featured Recipe</span>
                        @endif
                        </h1>
                            @if (strlen($index->Description) > 400)
                                <p class="text-gray-700 font-medium">{{ \Illuminate\Support\Str::limit($index->Description, 400, $end='...') }}</p>
                                <!-- <button id="toggleBtn_{{ $index->id }}" onclick="toggleDescription('{{ $index->id }}')" class="text-blue-500 font-medium mt-2 focus:outline-none">Show More</button> -->
                            @else
                                <p class="text-gray-700 font-medium">{{ $index->Description }}</p>
                            @endif
                            
                            <a href="/Recipe/{{ $index->id }}" class="text-blue-500 font-semibold block ">View Recipe</a>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- End of Recipe Slide -->
            </div>
            <div class="swiper-pagination "  style="position: static; bottom: auto; top: 0; margin-top:12px"></div>
            <!-- <div class="swiper-button-next"></div> 
            <div class="swiper-button-prev"></div> -->
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
