<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/all.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/lightbox.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/flexslider.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/jquery.rateyo.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/jquery.mmenu.all.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/inner-page-style.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="css2?family=Nunito:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen" href="./assets/css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/tippy.js@6/dist/tippy.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    <style>
        .tippy-box[data-theme='custom'] {
            background-color:rgb(25, 135, 84);
            color: white;
            border-radius: 10px;
            font-size: 18px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            padding: 10px;
        }

        .tippy-box[data-theme='custom'][data-placement^='bottom'] {
            transform-origin: top;
        }
    </style>
</head>

<body>
    <div>
        <header class="site-header">
            <div class="top-header bg-success">
                <div class="container">
                    <div class="top-header-left">
                        <div class="top-header-block">
                            <a href="mailto:venbooking@gmail.com" style="color:white;" class="text-white" itemprop="email">
                                <i class="fas fa-envelope text-warning"></i> Soporte Técnico: venbooking@gmail.com
                            </a>
                        </div>
                    </div>
                    <div class="top-header-right">
                        <a href="./login.php" id="login-btn">
                            <button class="login-btn">
                                <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="main-header">
                <div class="container">
                    <div class="icon-left">
            <img src="./logo.png" alt="Icono izquierdo" style="width: 140px; height: 80px;">
        </div>
                    <div class="nav-wrap">
                        <nav class="nav-desktop">
                            <ul class="menu-list">
                                <li>
                                    <a href="./index.php">
                                        <i class="fas fa-home"></i> Inicio
                                    </a>
                                </li>
                                <li>
                                    <a href="./Destinations.php">
                                        <i class="fas fa-map-marker-alt"></i> Destinos
                                    </a>
                                </li>
                                <li>
                                    <a href="./Inns.php">
                                        <i class="fas fa-bed"></i> Posadas
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <div id="bar">
                            <i class="fas fa-bars"></i>
                        </div>
                        <div id="close">
                            <i class="fas fa-times"></i>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </div>

    <script>
        // Configuración de tooltips llamativos
        tippy('[itemprop="email"]', {
            content: 'Contáctanos por Correo Electronico.',
            animation: 'scale',
            theme: 'custom',
            placement: 'bottom',
        });

        tippy('#login-btn', {
            content: 'Inicia Sesion o Registrate en VenBooking.',
            animation: 'fade',
            theme: 'custom',
            placement: 'bottom',
        });

        tippy('.menu-list a[href="./index.php"]', {
            content: 'Conoce VenBooking y todo lo que te ofrece.',
            animation: 'shift-away',
            theme: 'custom',
            placement: 'right',
        });

        tippy('.menu-list a[href="./Destinations.php"]', {
            content: 'Explora los destinos populares.',
            animation: 'shift-toward',
            theme: 'custom',
            placement: 'right',
        });

        tippy('.menu-list a[href="./Inns.php"]', {
            content: 'Este apartado te permitirá reservar en las mejores posadas.',
            animation: 'perspective',
            theme: 'custom',
            placement: 'right',
        });
    </script>
</body>

</html>
