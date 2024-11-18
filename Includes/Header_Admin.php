<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            margin-top: 60px;
        }
        .sidebar {
            position: fixed;
            top: 50px;
            left: 0;
            height: calc(100% - 60px);
            width: 14%;
            transition: width 0.3s;
            overflow-x: hidden;
            padding-top: 20px;
        }
        .sidebar a {
            padding: 10px 10px 10px 20px;
            text-decoration: none;
            font-size: 18px;
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

        /* Estilos para los datos del Dólar */
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

    </style>
</head>
<body>

    <div class="header bg-success">
        <div>
            <h2 style="font-size: 16px;">VenBooking - Gestión de Posadas</h2>
        </div>
        <a href="logout.php">
            <button class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
            </button>
        </a>
    </div>

    <div class="sidebar bg-success">
        <a href="./Inicio.php" style="color: white;">
            <i class="fas fa-home icon"></i> Inicio
        </a>
        <a href="./get_inns.php" style="color: white;">
            <i class="fas fa-hotel icon"></i> Posadas
        </a>
        <a href="./get_mobile_payment.php" style="color: white;">
            <i class="fas fa-mobile-alt icon"></i> Pago Móvil
        </a>
        <a href="./get_transfers.php" style="color: white;">
            <i class="fas fa-university icon"></i> Transferencia
        </a>
        <a href="./get_reservation.php" style="color: white;">
            <i class="fas fa-calendar-alt icon"></i> Reservas
        </a>
        <a href="./get_paypal.php" style="color: white;">
            <i class="fab fa-paypal icon"></i> PayPal
        </a>
        <a href="./get_binance.php" style="color: white;">
            <i class="fab fa-btc icon"></i> Binance
        </a>
        <a href="../Memberships.php" style="color: white;">
            <i class="fas fa-gift icon"></i> Membresías
        </a>
        <a href="./get_reports.php" style="color: white;">
            <i class="fas fa-file-pdf icon"></i> Reportes PDF
        </a>

        <!-- Datos del Dólar -->
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

</body>
</html>
