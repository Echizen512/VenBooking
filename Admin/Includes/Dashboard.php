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
        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
    </button>
        </a>
    </div>


<div class="sidebar bg-success">
    <a href="#" class="menu-toggle"><i class="fas fa-bars icon"></i> Menú</a>
    <div class="menu">
        <div class="category">
            <a href="#" class="category-toggle"><i class="fas fa-user icon"></i> Usuarios</a>
            <div class="submenu">
                <a href="./user.php">Usuarios</a>
            </div>
        </div>

        <div class="category">
            <a href="#" class="category-toggle"><i class="fas fa-hotel icon"></i> Alojamiento</a>
            <div class="submenu">
                <a href="./inn.php">Posadas</a>
                <a href="./rooms.php">Habitaciones</a>
                <a href="./reservations.php">Reservaciones</a>
            </div>
        </div>

        <div class="category">
            <a href="#" class="category-toggle"><i class="fas fa-car icon"></i> Transporte</a>
            <div class="submenu">
                <a href="./vehicles.php">Vehículos</a>
            </div>
        </div>

        <div class="category">
            <a href="#" class="category-toggle"><i class="fas fa-map-marker-alt icon"></i> Ubicación</a>
            <div class="submenu">
                <a href="./states.php">Estados</a>
                <a href="./municipalities.php">Municipios</a>
                <a href="./parishes.php">Parroquias</a>
            </div>
        </div>

        <div class="category">
            <a href="#" class="category-toggle"><i class="fas fa-file-alt icon"></i> Administración</a>
            <div class="submenu">
                <a href="./report.php">Reportes</a>
                <a href="./audit_log.php">Bitacora</a>
                <a href="./admin-backup.php">Respaldo</a>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelector(".menu-toggle").addEventListener("click", function() {
        document.querySelector(".menu").classList.toggle("active");
    });

    document.querySelectorAll(".category-toggle").forEach(toggle => {
        toggle.addEventListener("click", function() {
            this.nextElementSibling.classList.toggle("active");
        });
    });
</script>

<style>
    .menu { display: none; }
    .menu.active { display: block; }
    .submenu { display: none; }
    .submenu.active { display: block; }
</style>


    <script src="../Assets/js/jquery-3.6.0.min.js"></script>
    <script src="../Assets/js/bootstrap.bundle.min.js"></script>
    <script src="../Assets/js/jquery.dataTables.min.js"></script>
    <script src="../Assets/js/dataTables.bootstrap5.min.js"></script>

</body>
</html>
