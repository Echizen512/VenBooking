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
            width: 14%;
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

    </style>
</head>
<body>

    <div class="header bg-success">
        <div>
            <h2 style="font-size: 16px;">VenBooking - Gestión de Posadas</h2>
        </div>
        <a href="../Includes/logout.php">
            <button class="logout-btn">
                <i class="fas fa-sign-out-alt text-danger"></i> Cerrar Sesión
            </button>
        </a>
    </div>

    <div class="sidebar bg-success">
        <a class="dropdown-btn">
            <i class="fas fa-users me-2" style="color: #90ffbc;"></i> Perfil
        </a>
        <div class="dropdown-container">
            <a href="./Perfil.php">
                <i class="fas fa-user me-2" style="color: #90ffbc;"></i> Mi Perfil
            </a>
            <a href="./inns.php">
                <i class="fas fa-hotel me-2" style="color: #9eeaff;"></i> Posadas
            </a>
            <a href="./reservation.php">
                <i class="fas fa-calendar-alt me-2" style="color: #69afff;"></i> Reservas
            </a>
        </div>

        <a class="dropdown-btn" >
            <i class="fas fa-credit-card me-2" style="color: #17a2b8;"></i> Métodos de Pago
        </a>
        <div class="dropdown-container">
            <a href="./mobile_payment.php">
                <i class="fas fa-mobile-alt me-2" style="color: #17a2b8;"></i> Pago Móvil
            </a>
            <a href="./transfers.php">
                <i class="fas fa-university me-2" style="color: #dc3545;"></i> Transferencias
            </a>
            <a href="./paypal.php">
                <i class="fab fa-paypal me-2" style="color: #0c78f4;"></i> PayPal
            </a>
            <a href="./binance.php">
                <i class="fab fa-btc me-2" style="color: #f4c20d;"></i> Binance
            </a>
            <a href="./zelle.php">
                <i class="fas fa-credit-card me-2" style="color:rgb(183, 74, 255);"></i>Zelle
            </a>
            <a href="./zinli.php">
                <i class="fas fa-credit-card me-2" style="color:rgb(183, 74, 255);"></i>Zinli
            </a>
        </div>

        <a href="../Memberships.php">
            <i class="fas fa-gift me-2" style="color: #b3ff90;"></i> Membresías
        </a>
        <a href="./reports.php">
            <i class="fas fa-file-pdf me-2 text-danger"></i> Reportes PDF
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
                        echo "<li><i class='fas fa-dollar-sign text-warning'></i> Dólar: " . $data[0]['nombre'] . " (BCV)</li>";
                        echo "<li><i class='fas fa-chart-line text-danger'></i> Precio: " . $data[0]['promedio'] . " BS</li>";
                        echo "<li><i class='fas fa-calendar text-info'></i> Fecha: Hoy" . "</li>";
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

</body>
</html>
