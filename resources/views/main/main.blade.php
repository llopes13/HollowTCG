<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hollow TCG - Quiénes somos</title>
    @vite(['resources/css/pepe.css', 'resources/js/themeToggle.js'])
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;700&display=swap" rel="stylesheet">

    <!-- Carrossel (Swiper) -->
    <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet">

    <!-- SweetAlert (se necessário) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Meta tags adicionais -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<!-- Navbar -->
<nav class="navbar">
    <div class="navbar-container">
        <a href="/" class="navbar-logo">
            <img src="{{asset('image/logoHollowTCG.png')}}" alt="logo HollowTCG">
        </a>
        <div class="navbar-links hidden" id="navbar-default">
            <ul class="navbar-list">
                <li><a href="/" class="navbar-link">Inicio</a></li>
                <li><a href="cards" class="navbar-link">Cards</a></li>
                @guest
                    <li><a href="shoppingCart" class="navbar-link">Carrito</a></li>
                    <li><a href="login" class="navbar-link">Login</a></li>
                @else
                    @if(auth()->user()->role === 'user')
                        <li><a href="shoppingCart" class="navbar-link">Carrito</a></li>
                        <li><a href="perfil" class="navbar-link">Perfil</a></li>
                    @elseif(auth()->user()->role === 'admin')
                        <li><a href="{{ route('admin.dashboard') }}" class="navbar-link">Panel admin</a></li>
                    @endif
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="navbar-link">Logout</button>
                        </form>
                    </li>
                @endguest
                <li><button id="theme-toggle" class="navbar-link">🌙 Tema</button></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Carrossel -->
<div class="carousel-container">
    <div class="swiper progress-slide-carousel swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="carousel-slide">
                    <img src="{{asset('image/anuncio1.png')}}" alt="anuncio1" class="carousel-img">
                </div>
            </div>
            <div class="swiper-slide">
                <div class="carousel-slide">
                    <img src="{{asset('image/anuncio2.png')}}" alt="anuncio2" class="carousel-img">
                </div>
            </div>
            <div class="swiper-slide">
                <div class="carousel-slide">
                    <img src="{{asset('image/anuncio3.png')}}" alt="anuncio3" class="carousel-img">
                </div>
            </div>
        </div>
        <div class="swiper-pagination custom-pagination"></div>
    </div>
</div>


<main class="main-container">
    <div class="about-section">
        <h1 class="title">¿Quiénes somos?</h1>
        <p class="description">
            En Hollow TCG, somos apasionados del mundo de Pokémon TCG. Nos dedicamos a la venta de cartas individuales, sobres y accesorios para que disfrutes al máximo tus partidas. Nuestro objetivo es ofrecerte productos de calidad, ya seas coleccionista o jugador competitivo. Con una selección cuidadosamente elegida y un servicio confiable, queremos ser tu tienda de confianza en el universo Pokémon. ¡Atrapa las mejores cartas con nosotros!
        </p>
    </div>

    <div class="gif-section">
        <img src="{{ asset('image/gengar.gif') }}" alt="Gif de Gengar" class="gif">
    </div>
</main>

<footer class="footer">
    <div class="footer-container">
        <div class="footer-contacto">
            <h3>Contáctanos</h3>
            <a href="https://instagram.com/tu_usuario" target="_blank" class="footer-icon">
                <img src="{{asset('image/instagram.png')}}" alt="Instagram"> Instagram
            </a>
            <a href="mailto:ejemplo@email.com" class="footer-icon">
                <img src="{{asset('image/email.png')}}" alt="Email"> Email
            </a>
        </div>
        <div class="footer-pagos">
            <h3>Métodos de pago</h3>
            <div class="metodos-imgs">
                <img src="{{asset('image/visa.png')}}" alt="Visa">
                <img src="{{asset('image/mastercard.png')}}" alt="Mastercard">
            </div>
        </div>
    </div>
</footer>


<!-- JavaScripts -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/themeToggle.js') }}"></script>
<script src="{{ asset('js/carousel.js')}}"></script>


</body>
</html>
