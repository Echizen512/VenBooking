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
    $(document).ready(function(){
        $(".owl-carousel").owlCarousel({
            items: 1,
            loop: true,
            autoplay: true,
            autoplayTimeout: 5000, // Cambia cada 5 segundos
            autoplayHoverPause: true, // Pausa en hover
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            dots: true, // Muestra puntos de navegación
            nav: false, // Oculta botones de navegación
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
