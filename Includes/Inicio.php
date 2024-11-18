<?php
include '../config/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Consultas para obtener los datos
$query_posadas = "SELECT COUNT(*) AS total FROM inns WHERE user_id = $user_id";
$result_posadas = $conn->query($query_posadas);
$total_posadas = $result_posadas->fetch_assoc()['total'];

$query_habitaciones = "SELECT COUNT(*) AS total FROM rooms WHERE inn_id IN (SELECT id FROM inns WHERE user_id = $user_id)";
$result_habitaciones = $conn->query($query_habitaciones);
$total_habitaciones = $result_habitaciones->fetch_assoc()['total'];

$query_vehiculos = "SELECT COUNT(*) AS total FROM vehicles WHERE inn_id IN (SELECT id FROM inns WHERE user_id = $user_id)";
$result_vehiculos = $conn->query($query_vehiculos);
$total_vehiculos = $result_vehiculos->fetch_assoc()['total'];

$query_reservaciones = "SELECT COUNT(*) AS total FROM reservations WHERE inn_id IN (SELECT id FROM inns WHERE user_id = $user_id)";
$result_reservaciones = $conn->query($query_reservaciones);
$total_reservaciones = $result_reservaciones->fetch_assoc()['total'];

$query_favoritos = "SELECT COUNT(*) AS total FROM user_favorite_inns WHERE inn_id IN (SELECT id FROM inns WHERE user_id = $user_id)";
$result_favoritos = $conn->query($query_favoritos);
$total_favoritos = $result_favoritos->fetch_assoc()['total'];


// Obtener datos para gráficas
$query_habitaciones_por_posada = "
    SELECT inns.name AS posada, COUNT(rooms.id) AS habitaciones
    FROM inns
    LEFT JOIN rooms ON inns.id = rooms.inn_id
    WHERE inns.user_id = $user_id
    GROUP BY inns.id";
$result_habitaciones = $conn->query($query_habitaciones_por_posada);
$data_habitaciones = [];
while ($row = $result_habitaciones->fetch_assoc()) {
    $data_habitaciones[$row['posada']] = $row['habitaciones'];
}

$query_vehiculos_por_posada = "
    SELECT inns.name AS posada, COUNT(vehicles.id) AS vehiculos
    FROM inns
    LEFT JOIN vehicles ON inns.id = vehicles.inn_id
    WHERE inns.user_id = $user_id
    GROUP BY inns.id";
$result_vehiculos = $conn->query($query_vehiculos_por_posada);
$data_vehiculos = [];
while ($row = $result_vehiculos->fetch_assoc()) {
    $data_vehiculos[$row['posada']] = $row['vehiculos'];
}

$query_clientes_por_posada = "
    SELECT inns.name AS posada, COUNT(reservations.id) AS clientes
    FROM inns
    LEFT JOIN reservations ON inns.id = reservations.inn_id
    WHERE inns.user_id = $user_id
    GROUP BY inns.id";
$result_clientes = $conn->query($query_clientes_por_posada);
$data_clientes = [];
while ($row = $result_clientes->fetch_assoc()) {
    $data_clientes[$row['posada']] = $row['clientes'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="../Assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        .content-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .container {
            padding: 10px; /* Reduce el padding general */
            margin: auto;
            max-width: 95%; /* Asegura que el contenido no sea demasiado ancho */
            margin-left: 250px; /* Desplaza más hacia la derecha */
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start; /* Alinea las cards hacia la izquierda */
            gap: 10px; /* Espaciado menor entre las cards */
        }

        .card {
            flex: 1;
            min-width: 150px; /* Reduce el tamaño mínimo */
            max-width: 200px; /* Limita el tamaño máximo */
            background: #fff;
            border-radius: 8px; /* Bordes más pequeños */
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1); /* Reduce la sombra */
            padding: 10px; /* Reduce el padding interno */
            text-align: center;
        }

        .card i {
            font-size: 1.5rem; /* Reduce el tamaño del ícono */
            margin-bottom: 5px;
            color: #3fa141;
        }

        .card h3 {
            font-size: 1rem; /* Reduce el tamaño del texto */
            margin: 5px 0;
            color: #333;
        }

        .card p {
            font-size: 0.8rem; /* Reduce el tamaño del texto */
            color: #666;
        }

        .chart-row {
            display: flex;
            justify-content: flex-start; /* Alinea las gráficas al principio */
            margin-top: 20px;
            gap: 0; /* Elimina el espacio entre las gráficas */
        }

        .chart-container {
            flex: 1;
            max-width: 250px; /* Ajusta el tamaño de las gráficas */
            background: #fff;
            border-radius: 8px; /* Bordes más pequeños */
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1); /* Reduce la sombra */
            padding: 0px;
            text-align: center;
        }

        .chart-title {
            text-align: center;
            margin-bottom: 5px; /* Reduce el margen inferior */
            font-size: 1.2rem; /* Reduce el tamaño del título */
            font-weight: bold;
            color: #3fa141;
        }


        footer {
            text-align: center;
            color: #666;
            padding: 5px 0; /* Reduce el padding en el footer */
            width: 100%;
            margin-top: auto;
        }
    </style>
</head>

<body>
    <?php include './Header_Admin.php'; ?>

    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <!-- Cards -->
                <div class="card">
                    <i class="fas fa-hotel"></i>
                    <h3><?php echo $total_posadas; ?></h3>
                    <p>Posadas registradas</p>
                </div>
                <div class="card">
                    <i class="fas fa-door-open"></i>
                    <h3><?php echo $total_habitaciones; ?></h3>
                    <p>Habitaciones registradas</p>
                </div>
                <div class="card">
                    <i class="fas fa-car"></i>
                    <h3><?php echo $total_vehiculos; ?></h3>
                    <p>Vehículos registrados</p>
                </div>
                <div class="card">
                    <i class="fas fa-calendar-check"></i>
                    <h3><?php echo $total_reservaciones; ?></h3>
                    <p>Reservaciones realizadas</p>
                </div>
                <div class="card">
                    <i class="fas fa-heart"></i>
                    <h3><?php echo $total_favoritos; ?></h3>
                    <p>Favoritos acumulados</p>
                </div>
            </div>

            <div class="chart-row">
                <!-- Gráficas -->
                <div class="chart-container" style="margin: 15px;">
                    <div class="chart-title">Habitaciones por Posada</div>
                    <canvas id="habitacionesChart"></canvas>
                </div>
                <div class="chart-container" style="margin: 15px;">
                    <div class="chart-title">Clientes por Posada</div>
                    <canvas id="clientesChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p style="text-align: center; color: #666;">© 2024 Dashboard. Todos los derechos reservados.</p>
    </footer>

    <script>
        // Datos para las gráficas
        const habitacionesData = {
            labels: <?php echo json_encode(array_keys($data_habitaciones)); ?>,
            datasets: [{
                data: <?php echo json_encode(array_values($data_habitaciones)); ?>,
                backgroundColor: ['#4caf50', '#3fa141', '#ffc107', '#007bff', '#ff5722'],
                borderWidth: 1
            }]
        };

        const clientesData = {
            labels: <?php echo json_encode(array_keys($data_clientes)); ?>,
            datasets: [{
                data: <?php echo json_encode(array_values($data_clientes)); ?>,
                backgroundColor: ['#3fa141', '#4caf50', '#ffc107', '#007bff', '#ff5722'],
                borderWidth: 1
            }]
        };

        // Configuración de las gráficas
        const config = (data) => ({
            type: 'pie',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                },
            }
        });

        // Renderizar las gráficas
        new Chart(document.getElementById('habitacionesChart').getContext('2d'), config(habitacionesData));
        
        new Chart(document.getElementById('clientesChart').getContext('2d'), config(clientesData));
    </script>
</body>
</html>
