<!DOCTYPE html>
<html>

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
                        <a href="#" id="logout-btn">
                            <button class="logout-btn">
                                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
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
                                    <a href="./Destinations.php" id="destinations-tooltip">
                                        <i class="fas fa-map-marker-alt"></i> Destinos
                                    </a>
                                </li>
                                <li>
                                    <a href="./Inns.php" id="inns-tooltip">
                                        <i class="fas fa-bed"></i> Posadas
                                    </a>
                                </li>
                                <li>
                                    <a href="./Profile.php" id="profile-tooltip">
                                        <i class="fas fa-user"></i> Perfil
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <div id="bar"><i class="fas fa-bars"></i></div>
                        <div id="close"><i class="fas fa-times"></i></div>
                    </div>
                </div>
            </div>
        </header>
    </div>

    <script>
        tippy('#email-tooltip', {
            content: '¡Contáctanos por correo!',
            animation: 'scale',
            theme: 'custom',
            placement: 'bottom',
        });

        tippy('#destinations-tooltip', {
            content: 'Explora los destinos más populares de Venezuela', 
            animation: 'shift-away',
            theme: 'custom',
            placement: 'right',
        });

        tippy('#inns-tooltip', {
            content: 'Encuentra las mejores posadas y reserva de forma segura.',
            animation: 'shift-toward',
            theme: 'custom',
            placement: 'right',
        });

        tippy('#profile-tooltip', {
            content: 'Consulta y actualiza tu perfil personal',
            animation: 'perspective',
            theme: 'custom',
            placement: 'right',
        });
    </script>
    
    <script>
        document.getElementById('logout-btn').addEventListener('click', function (e) {
            e.preventDefault(); // Evita que el enlace se ejecute inmediatamente

            Swal.fire({
                title: '¿Estás seguro?',
                text: "Estás a punto de cerrar sesión",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirigir al usuario a logout.php si confirma
                    window.location.href = './Includes/logout.php';
                }
            })
        });
    </script>



</body>

</html>