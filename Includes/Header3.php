<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/all.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/lightbox.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/flexslider.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/jquery.rateyo.css" />
    <link rel="stylesheet" type="text/css" href="../assets/css/jquery.mmenu.all.css" />
    <link rel="stylesheet" type="text/css" href="../assets/css/inner-page-style.css">
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link href="css2?family=Nunito:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


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
                                    <a href="./Includes/Inicio.php">
                                        <i class="fas fa-cogs"></i> Volver al Panel de Control
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
        document.getElementById('logout-btn').addEventListener('click', function (e) {
            e.preventDefault(); 

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
                    window.location.href = './Includes/logout.php';
                }
            })
        });
    </script>


</body>

</html>