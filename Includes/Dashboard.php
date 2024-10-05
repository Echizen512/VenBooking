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
            margin-top: 80px; 
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
            font-size: 18px;
            color: white;
            display: flex;
            align-items: center; /* Alinear contenido verticalmente */
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
    </style>
</head>
<body>


    <div class="header bg-success">
        <div>
        <h2 style="font-size: 16px;">Gestionar Posadas</h2>
        </div>
        <a href="logout.php">
    <button class="logout-btn">
        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
    </button>
        </a>
    </div>


    <div class="sidebar bg-success">
    <a href="./get_inns.php" style="color: white;"><i class="fas fa-hotel icon" style="color: white;"></i>Posadas</a>
    <a href="./get_rooms.php" style="color: white;"><i class="fas fa-bed icon" style="color: white;"></i>Habitaciones</a>
    <a href="./get_vehicles.php" style="color: white;"><i class="fas fa-car icon" style="color: white;"></i>Vehículos</a>
    <a href="./get_tour_packages.php" style="color: white;"><i class="fas fa-suitcase icon" style="color: white;"></i>Paquetes</a>
    <a href="./get_mobile_payment.php" style="color: white;"><i class="fas fa-credit-card icon" style="color: white;"></i>Pago Móvil</a>
    <a href="./get_transfers.php" style="color: white;"><i class="fas fa-exchange-alt icon" style="color: white;"></i>Transferencia</a>
    <a href="./get_reservation.php" style="color: white;"><i class="fas fa-calendar-check icon" style="color: white;"></i>Reservas</a>
</div>


    <script src="../Assets/js/jquery-3.6.0.min.js"></script>
    <script src="../Assets/js/bootstrap.bundle.min.js"></script>
    <script src="../Assets/js/jquery.dataTables.min.js"></script>
    <script src="../Assets/js/dataTables.bootstrap5.min.js"></script>

</body>
</html>
