<section class="page-heading" style="margin: 30px;">
    <div class="container">
        <h2><i class="fas fa-map-marker-alt text-danger"></i> Destinos Populares</h2>
    </div>
</section>

<section class="events-section" style="margin: 20px;">
    <div class="container">
        <div class="event-wrap">
            <div class="img-wrap">
                <img src="images/los-roques.jpg" alt="event images" style="height: 300px;">
            </div>
            <div class="details">
                <a href="#"><h3 itemprop="name"><i class="fas fa-sun"></i> Los Roques</h3></a>
                <p itemprop="description" class="text-justify">Un paraíso en el Caribe, Los Roques es un archipiélago de aguas cristalinas y arenas blancas, perfecto para los amantes del sol y el mar. Ideal para el buceo, el snorkel y la pesca deportiva, este destino ofrece una escapada tropical donde puedes relajarte en sus playas idílicas y explorar la rica vida marina.</p>
                <h5 itemprop="location"><i class="fas fa-map-marker-alt"></i> Archipiélago de Los Roques</h5>
            </div>
        </div>

        <div class="event-wrap">
            <div class="img-wrap">
                <img src="images/merida.jpg" alt="event images" style="height: 300px;">
            </div>
            <div class="details">
                <a href="#"><h3 itemprop="name"><i class="fas fa-mountain"></i> Mérida</h3></a>
                <p itemprop="description" class="text-justify">Ubicada en los Andes venezolanos, es conocida por sus paisajes montañosos, clima fresco y la majestuosidad del teleférico más alto y largo del mundo. Aquí, puedes disfrutar de actividades al aire libre como senderismo, parapente y visitas a pintorescos pueblos andinos.</p>
                <h5 itemprop="location"><i class="fas fa-map-marker-alt"></i> Mérida, Estado Mérida</h5>
            </div>
        </div>
    </div>
</section>

<style>
.events-section .event-wrap {
    transition: transform 0.3s ease, background-color 0.3s ease;
}

.events-section .event-wrap:hover {
    transform: scale(1.05); 
    background-color: #daeaf6; 
}

.events-section .img-wrap img {
    transition: opacity 0.3s ease;
}

.events-section .event-wrap:hover .img-wrap img {
    opacity: 0.8; 
}

.events-section .details {
    transition: color 0.3s ease;
}

.events-section .event-wrap:hover .details {
    color: #333;
}
</style>