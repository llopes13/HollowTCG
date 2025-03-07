<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/resources/css/carrosel.css">
    <title>Document</title>
</head>
<body>
    <!--HTML CODE-->
    <div class="w-full relative">
        <div class="swiper progress-slide-carousel swiper-container relative">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="bg-indigo-50 h-52 flex justify-center items-center overflow-hidden">
                        <img src="{{asset('image/anuncio1.png')}}" alt="anuncio1" class="w-full h-full object-cover">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="bg-indigo-50 h-52 flex justify-center items-center overflow-hidden">
                        <img src="{{asset('image/anuncio2.png')}}" alt="anuncio2" class="w-full h-full object-cover">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="bg-indigo-50 h-52 flex justify-center items-center overflow-hidden">
                        <img src="{{asset('image/anuncio3.png')}}" alt="anuncio3" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
            <div class="swiper-pagination !bottom-2 !top-auto !w-80 right-0 mx-auto bg-gray-100"></div>
        </div>
    </div>

    <script>
        var swiper = new Swiper(".progress-slide-carousel", {
        loop: true,
        fraction: true,
        autoplay: {
          delay: 1800,
          disableOnInteraction: false,
        },
        pagination: {
          el: ".progress-slide-carousel .swiper-pagination",
          type: "progressbar",
        },
        });
        </script>
</body>
</html>