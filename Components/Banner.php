<style>

/* Fondo animado en degradado */
.banner {
    position: relative;
    background-size: 400% 400%;
    animation: gradient 15s ease infinite, fadeIn 2s ease-in forwards;
}

/* Animación del título */
.banner-title {
    font-size: 3rem;
    color: #fff;
    text-transform: uppercase;
    opacity: 0;
    animation: float 2.5s ease-in-out infinite, fadeIn 2s ease-in forwards 1s;
}

/* Animación del subtítulo */
.banner-subtitle {
    font-size: 1.5rem;
    color: #fff;
    opacity: 0;
    animation: fadeInUp 3s ease-in-out forwards 1.5s;
}

/* Keyframes para el degradado */
@keyframes gradient {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}

/* Keyframes para flotación del título */
@keyframes float {
    0% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-20px);
    }
    100% {
        transform: translateY(0px);
    }
}

/* Keyframes para desvanecer hacia arriba */
@keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Keyframes para fadeIn */
@keyframes fadeIn {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}

/* Keyframes para slideInLeft */
@keyframes slideInLeft {
    0% {
        transform: translateX(-100%);
        opacity: 0;
    }
    100% {
        transform: translateX(0);
        opacity: 1;
    }
}

/* Animación de deslizamiento para las imágenes del carrusel */
.owl-carousel .item img {
    animation: slideInLeft 1.5s ease-in-out;
}


</style>

<link rel="stylesheet" href="./assets/css/index.css">
<div class="banner">
    <div class="owl-carousel owl-theme">
        <div class="item"><img src="images/banner.jpg" alt="Image of Banner"></div>
        <div class="item"><img src="images/banner2.jpg" alt="Image of Banner"></div>
        <div class="item"><img src="images/banner4.jpg" alt="Image of Banner"></div>
    </div>
    <div class="container text-center">
        <h1 class="banner-title">VenBooking</h1>
        <h3 class="banner-subtitle">"Descubre, reserva, disfruta: VenBooking hace realidad tu escapada perfecta".</h3>
    </div>
</div>
<script src="./assets/js/jquery-3.6.0.min.js"></script>
<script src="./assets/js/owl.carousel.min.js"></script>
<script>
    $(document).ready(function () {
        $(".owl-carousel").owlCarousel({
            items: 1,
            loop: true,
            autoplay: true,
            autoplayTimeout: 5000, 
            autoplayHoverPause: true, 
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            dots: true, 
            nav: false, 
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        });
    });
</script>
