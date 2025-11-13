<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/jquery.rateyo.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/newstyles.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
</head>

<body>
       <header class="site-header">
        <div class="top-header">
            <div class="container">
                <div class="top-header-content">
                    <div class="support-info">
                        <i class="fas fa-envelope support-icon"></i>
                        <a href="mailto:venbooking@gmail.com" class="support-email">
                            Soporte Técnico: venbooking@gmail.com
                        </a>
                    </div>
                    <a href="./login.php" class="login-btn p-2">
                        <i class="fas fa-sign-in-alt"></i>
                        <span style="font-size: 14px">Iniciar Sesión</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="main-header">
            <div class="container">
                <div class="header-content">
                    <div class="logo-section">
                            <img src="../Assets/Images/logo.png" alt="logo" style="width: 50px; height: 70px; object-fit: cover;">
                        <div class="logo-text">
                            <h1 class="brand-name">VenBooking</h1>
                            <p class="brand-tagline">Tu destino perfecto</p>
                        </div>
                    </div>
                                        <nav class="desktop-nav">
                        <ul class="nav-menu">
                            <li class="nav-item">
                                <a href="./Inns.php" class="nav-link">
                                    <i class="fas fa-cogs"></i> Volver al Panel de Control
                                </a>
                            </li>
                        </ul>
                    </nav>
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