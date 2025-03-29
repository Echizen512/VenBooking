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
    </style>
</head>
<body>


    <div class="header bg-success">
        <div>
        <h2 style="font-size: 16px;">Sección Administrativa</h2>
        </div>
        <a href="./Includes/logout.php">
    <button class="logout-btn">
        <i class="fas fa-sign-out-alt text-danger"></i> Cerrar Sesión
    </button>
        </a>
    </div>


    <div class="sidebar bg-success">
    <a href="./user.php" style="color: white;"><i class="fas fa-user icon text-danger"></i>Usuarios</a>
        <a href="./inn.php" style="color: white;"><i class="fas fa-hotel icon text-info"></i>Posadas</a>
        <a href="./vehicles.php" style="color: white;"><i class="fas fa-car icon text-danger"></i>Vehículos</a>
        <a href="./rooms.php" style="color: white;"><i class="fas fa-bed icon" style="color: #90ffbc;"></i>Habitaciones</a>
        <a href="./states.php" style="color: white;"><i class="fas fa-map-marker-alt icon text-danger"></i> Estados</a>
        <a href="./municipalities.php" style="color: white;"><i class="fas fa-city icon text-info"></i>Municipios</a>
        <a href="./parishes.php" style="color: white;"><i class="fas fa-compass icon text-warning"></i> Parroquias</a>
        <a href="./reservations.php" style="color: white;"><i class="fas fa-calendar-alt icon text-info"></i> Reservaciones</a>
        <a href="./report.php" style="color: white;"><i class="fas fa-file-alt icon text-danger"></i> Reportes</a>
        <a href="./audit_log.php"  style="color: white;"><i class="fas fa-file-alt icon text-info"></i>  Auditoría</a>
        <a href="./admin-bakup.php" style="color: white;"><i class="fas fa-database icon text-warning"></i> Respaldo</a>
    </div>

    <script src="../Assets/js/jquery-3.6.0.min.js"></script>
    <script src="../Assets/js/bootstrap.bundle.min.js"></script>
    <script src="../Assets/js/jquery.dataTables.min.js"></script>
    <script src="../Assets/js/dataTables.bootstrap5.min.js"></script>

</body>
</html>
