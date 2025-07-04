<footer class="text-white text-center text-lg-start" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%);">
    <div class="container p-5">
        <div class="row">
            <div class="col-lg-6 col-md-12 mb-6 mb-md-0">
                <h5 class="text-uppercase text-center" style="font-size: 26px; font-weight: bold; letter-spacing: 1px;">
                    Acerca de VenBooking
                </h5>
                <p class="text-justify mt-3" style="font-size: 18px; line-height: 1.6; padding: 10px; margin: 10px;">
                    VenBooking es tu plataforma de confianza para reservar las mejores posadas en toda Venezuela.
                    Ofrecemos opciones seguras y personalizadas para que disfrutes de una experiencia única en cada
                    destino turístico.
                </p>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase"
                    style="font-size: 20px; font-weight: bold; letter-spacing: 1px; margin: 10px;">
                    Enlaces Rápidos
                </h5>
                <ul class="list-unstyled mt-3">
                    <li><a href="#!" class="text-white"
                            style="font-size: 18px; text-decoration: none; margin: 10px;"><i class="fas fa-user me-3"></i>Términos y Condiciones</a></li>
                    <li><a href="#!" class="text-white"
                            style="font-size: 18px; text-decoration: none; margin: 10px;"><i class="fas fa-comments me-3"></i>FAQ</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-5 mb-4 mb-md-0">
                <h5 class="text-uppercase" style="font-size: 20px; font-weight: bold; letter-spacing: 1px;">
                <i class="fa-solid fa-chart-simple"></i> Datos del Dólar
                </h5>
                <ul class="list-unstyled mt-3" style="font-size: 18px;">
                    <?php
                    $url = "https://ve.dolarapi.com/v1/dolares";

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, [
                        "Content-Type: application/json"
                    ]);

                    $response = curl_exec($ch);
                    curl_close($ch);

                    if ($response !== false) {
                        $data = json_decode($response, true);

                        if ($data !== null) {
                            echo "<li><i class='fas fa-dollar-sign'></i> Dólar: " . $data[0]['nombre'] . " (BCV)</li>";
                            echo "<li><i class='fas fa-chart-line'></i> Precio en BS: " . $data[0]['promedio'] . "</li>";
                            echo "<li><i class='fas fa-calendar'></i> Fecha de Actualización: Hoy" . "</li>";
                        } else {
                            echo "<li>Error al convertir la respuesta JSON.</li>";
                        }
                    } else {
                        echo "<li>Error al obtener los datos de la API.</li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.3); font-size: 20px; letter-spacing: 0.5px;">
        © 2025 VenBooking. Todos los derechos reservados.
    </div>
</footer>

<script type="text/javascript" src="./assets/js/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="./assets/js/lightbox.js"></script>
<script type="text/javascript" src="./assets/js/all.js"></script>
<script type="text/javascript" src="./assets/js/isotope.pkgd.min.js"></script>
<script type="text/javascript" src="./assets/js/owl.carousel.js"></script>
<script type="text/javascript" src="./assets/js/jquery.flexslider.js"></script>
<script type="text/javascript" src="./assets/js/jquery.rateyo.js"></script>
<script type="text/javascript" src="./assets/js/custom.js"></script>