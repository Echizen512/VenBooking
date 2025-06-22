<div id="bannerCarousel" class="carousel slide banner" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="0" class="active" aria-current="true"
            aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="5000">
            <img src="images/banner.jpg" class="d-block w-100 banner-img" alt="Banner 1">
            <div class="carousel-caption d-md-block">
                <h5 class="banner-title">VenBooking</h5>
                <p class="banner-subtitle">Descubre, reserva, disfruta: VenBooking hace realidad tu escapada perfecta.
                </p>
            </div>
        </div>
        <div class="carousel-item" data-bs-interval="5000">
            <img src="images/banner2.jpg" class="d-block w-100 banner-img" alt="Banner 2">
            <div class="carousel-caption d-md-block">
                <h5 class="banner-title">Explora nuevos destinos</h5>
                <p class="banner-subtitle">Déjate sorprender por lugares increíbles.</p>
            </div>
        </div>
        <div class="carousel-item" data-bs-interval="5000">
            <img src="images/banner4.jpg" class="d-block w-100 banner-img" alt="Banner 3">
            <div class="carousel-caption d-md-block">
                <h5 class="banner-title">Tu próxima aventura comienza aquí</h5>
                <p class="banner-subtitle">Reserva fácilmente y vive la experiencia.</p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
    </button>
</div>

<style>

.banner-img {
    max-height: 400px;
    object-fit: cover;
}

.banner-title {
    font-size: 2rem;
    font-weight: 700;
    color: #ffffff;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.7);
}

.banner-subtitle {
    font-size: 1.25rem;
    font-weight: 400;
    color: #f8f9fa;
    text-shadow: 1px 1px 3px rgba(0,0,0,0.6);
    margin-top: 0.5rem;
}


.carousel-caption {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const carousel = new bootstrap.Carousel(document.getElementById("bannerCarousel"), {
        interval: 3000,
        ride: "carousel"
    });
});
</script>