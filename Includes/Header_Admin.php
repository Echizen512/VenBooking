<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/tippy.js@6/dist/tippy.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    
    <style>
        body {
            background-color: #f8f9fa;
            margin-top: 60px;
        }

        a {
            color: white;
        }

        .sidebar {
            position: fixed;
            top: 50px;
            left: 0;
            height: calc(100% - 50px);
            width: 16%;
            transition: width 0.3s;
            overflow-x: hidden;
            padding-top: 20px;
        }
        .sidebar a {
            padding: 10px 10px 10px 20px;
            text-decoration: none;
            font-size: 16px;
            color: white;
            display: flex;
            align-items: center;
            transition: 0.3s;
        }
        .sidebar a:hover {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.2);
        }
        .main-content {
            margin-left: 14%;
            padding: 20px;
        }
        .icon {
            padding-right: 10px;
        }
        .header {
            color: white;
            padding: 17px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }
        .logout-btn {
            background-color: transparent;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        .logout-btn:hover {
            text-decoration: underline;
        }

        .dolar-section {
            margin-top: 60px;
            padding: 15px;
            color: white;
            border-radius: 5px;
        }

        .dolar-section h5 {
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .dolar-section ul {
            list-style: none;
            padding-left: 0;
        }

        .dolar-section ul li {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .dolar-section ul li i {
            margin-right: 10px;
        }

        .dropdown-container {
            display: none;
            padding-left: 20px;
        }
        .dropdown-btn {
            cursor: pointer;
        }
        .dropdown-btn:hover {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.2);
        }

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

    <div class="header" style=" background: linear-gradient(135deg, #059669 0%, #10b981 100%);">
        <div>
            <h2 style="font-size: 16px;">VenBooking - Gestión de Posadas</h2>
        </div>
        <a href="logout.php">
            <button class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
            </button>
        </a>
    </div>

    <div class="sidebar" style=" background: linear-gradient(135deg, #059669 0%, #10b981 100%);">
        <a class="dropdown-btn" id="perfiles-tooltip">
            <i class="fas fa-users me-2"></i> Perfiles
        </a>
        <div class="dropdown-container" >
            <a href="../Enterprise/Perfil.php" id="perfil-tooltip">
                <i class="fas fa-user me-2"></i> Mi Perfil
            </a>
            <a href="../Enterprise/inns.php" id="posadas-tooltip">
                <i class="fas fa-hotel me-2"></i> Posadas
            </a>
            <a href="../Enterprise/reservation.php" id="reserva-tooltip">
                <i class="fas fa-calendar-alt me-2"></i> Reservas
            </a>
        </div>

        <a class="dropdown-btn" id="pagos-tooltip">
            <i class="fas fa-credit-card me-2"></i> Métodos de Pago
        </a>
        <div class="dropdown-container">
            <a href="../Enterprise/mobile_payment.php" id="pagomovil-tooltip">
                <i class="fas fa-mobile-alt me-2"></i> Pago Móvil
            </a>
            <a href="../Enterprise/transfers.php" id="transferencias-tooltip">
                <i class="fas fa-university me-2"></i> Transferencias
            </a>
            <a href="../Enterprise/paypal.php" id="paypal-tooltip">
                <i class="fab fa-paypal me-2"></i> PayPal
            </a>
            <a href="../Enterprise/binance.php" id="binance-tooltip">
                <i class="fab fa-btc me-2"></i> Binance
            </a>
            <a href="../Enterprise/zelle.php" id="zelle-tooltip">
                <i class="fas fa-credit-card me-2"></i>Zelle
            </a>
            <a href="../Enterprise/zinli.php" id="zinli-tooltip">
                <i class="fas fa-credit-card me-2"></i>Zinli
            </a>
        </div>

        <a href="../Memberships.php" id="membresias-tooltip">
            <i class="fas fa-gift me-2"></i> Membresías
        </a>
        <a href="../Enterprise/reports.php" id="reportes-tooltip">
            <i class="fas fa-file-pdf me-2"></i> Reportes PDF
        </a>

        <div class="dolar-section">
            <h5>Datos del Dólar</h5>
            <ul class="list-unstyled mt-3">
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
                        echo "<li><i class='fas fa-chart-line'></i> Precio: " . $data[0]['promedio'] . " BS</li>";
                        echo "<li><i class='fas fa-calendar'></i> Fecha: Hoy" . "</li>";
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

    <script src="../Assets/js/jquery-3.6.0.min.js"></script>
    <script src="../Assets/js/bootstrap.bundle.min.js"></script>
    <script src="../Assets/js/jquery.dataTables.min.js"></script>
    <script src="../Assets/js/dataTables.bootstrap5.min.js"></script>

    <script>
        var dropdown = document.getElementsByClassName("dropdown-btn");
        for (var i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var dropdownContent = this.nextElementSibling;
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                } else {
                    dropdownContent.style.display = "block";
                }
            });
        }
    </script>

        <script>
            // Tooltip para "Perfiles"
            tippy('#perfiles-tooltip', {
                content: 'Accede a diferentes perfiles',
                animation: 'scale',
                theme: 'custom',
                placement: 'right',
            });

            // Tooltip para "Mi Perfil"
            tippy('#perfil-tooltip', {
                content: 'Consulta tu información personal',
                animation: 'scale',
                theme: 'custom',
                placement: 'right',
            });

            // Tooltip para "Posadas"
            tippy('#posadas-tooltip', {
                content: 'Explora nuestras posadas disponibles',
                animation: 'scale',
                theme: 'custom',
                placement: 'right',
            });

            // Tooltip para "Reservas"
            tippy('#reserva-tooltip', {
                content: 'Administra tus reservas fácilmente',
                animation: 'scale',
                theme: 'custom',
                placement: 'right',
            });

            // Tooltip para "Métodos de Pago"
            tippy('#pagos-tooltip', {
                content: 'Elige cómo deseas realizar tus pagos',
                animation: 'scale',
                theme: 'custom',
                placement: 'right',
            });

            // Tooltip para "Pago Móvil"
            tippy('#pagomovil-tooltip', {
                content: 'Realiza pagos desde tu dispositivo móvil',
                animation: 'scale',
                theme: 'custom',
                placement: 'right',
            });

            // Tooltip para "Transferencias"
            tippy('#transferencias-tooltip', {
                content: 'Haz transferencias bancarias de forma sencilla',
                animation: 'scale',
                theme: 'custom',
                placement: 'right',
            });

            // Tooltip para "PayPal"
            tippy('#paypal-tooltip', {
                content: 'Utiliza PayPal para tus pagos online',
                animation: 'scale',
                theme: 'custom',
                placement: 'right',
            });

            // Tooltip para "Binance"
            tippy('#binance-tooltip', {
                content: 'Realiza pagos usando criptomonedas',
                animation: 'scale',
                theme: 'custom',
                placement: 'right',
            });

            // Tooltip para "Zelle"
            tippy('#zelle-tooltip', {
                content: 'Paga fácilmente con Zelle',
                animation: 'scale',
                theme: 'custom',
                placement: 'right',
            });

            // Tooltip para "Zinli"
            tippy('#zinli-tooltip', {
                content: 'Realiza tus pagos con Zinli de manera segura',
                animation: 'scale',
                theme: 'custom',
                placement: 'right',
            });

            // Tooltip para "Membresías"
            tippy('#membresias-tooltip', {
                content: 'Descubre nuestras membresías exclusivas',
                animation: 'scale',
                theme: 'custom',
                placement: 'right',
            });

            // Tooltip para "Reportes PDF"
            tippy('#reportes-tooltip', {
                content: 'Descarga reportes en formato PDF',
                animation: 'scale',
                theme: 'custom',
                placement: 'right',
            });

        </script>

</body>
</html>
