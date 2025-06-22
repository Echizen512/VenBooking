<?php
include '../config/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
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
    <title>Panel de Control</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Assets/css/Enterprise.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<style>
    /* Animación de desvanecimiento */
body {
    animation: fadeIn 2s ease-in-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

/* Animación para tarjetas */
.card {
    opacity: 0;
    transform: translateY(50px);
    animation: slideUp 1s ease-in-out forwards;
}

.card:nth-child(1) {
    animation-delay: 0.2s;
}

.card:nth-child(2) {
    animation-delay: 0.4s;
}

.card:nth-child(3) {
    animation-delay: 0.6s;
}

.card:nth-child(4) {
    animation-delay: 0.8s;
}

.card:nth-child(5) {
    animation-delay: 1s;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(50px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Animación para gráficos */
.chart-container {
    opacity: 0;
    transform: scale(0.95);
    animation: growIn 1s ease-in-out forwards;
}

.chart-container:nth-child(1) {
    animation-delay: 1.2s;
}

.chart-container:nth-child(2) {
    animation-delay: 1.4s;
}

.chart-container:nth-child(3) {
    animation-delay: 1.6s;
}

@keyframes growIn {
    from {
        opacity: 0;
        transform: scale(0.95);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

</style>

<?php include './Header_Admin.php'; ?>

<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="card text-center"
                style="padding: 15px; border: 1px solid #ddd; border-radius: 10px; width: 18%; display: inline-block; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                <i class="fas fa-hotel text-info" style="font-size: 40px; margin-bottom: 15px;"></i>
                <h3 style="margin: 0; font-weight: bold;"><?php echo $total_posadas; ?></h3>
                <p style="margin: 5px 0; color: #666;">Posadas registradas</p>
            </div>
            <div class="card text-center"
                style="padding: 15px; border: 1px solid #ddd; border-radius: 10px; width: 18%; display: inline-block; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                <i class="fas fa-door-open text-primary" style="font-size: 40px; margin-bottom: 15px;"></i>
                <h3 style="margin: 0; font-weight: bold;"><?php echo $total_habitaciones; ?></h3>
                <p style="margin: 5px 0; color: #666;">Habitaciones registradas</p>
            </div>
            <div class="card text-center"
                style="padding: 15px; border: 1px solid #ddd; border-radius: 10px; width: 18%; display: inline-block; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                <i class="fas fa-car text-danger" style="font-size: 40px; margin-bottom: 15px;"></i>
                <h3 style="margin: 0; font-weight: bold;"><?php echo $total_vehiculos; ?></h3>
                <p style="margin: 5px 0; color: #666;">Vehículos registrados</p>
            </div>
            <div class="card text-center"
                style="padding: 15px; border: 1px solid #ddd; border-radius: 10px; width: 18%; display: inline-block; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                <i class="fas fa-calendar-check text-info" style="font-size: 40px; margin-bottom: 15px;"></i>
                <h3 style="margin: 0; font-weight: bold;"><?php echo $total_reservaciones; ?></h3>
                <p style="margin: 5px 0; color: #666;">Reservaciones realizadas</p>
            </div>
            <div class="card text-center"
                style="padding: 15px; border: 1px solid #ddd; border-radius: 10px; width: 18%; display: inline-block; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                <i class="fas fa-heart text-danger" style="font-size: 40px; margin-bottom: 15px;"></i>
                <h3 style="margin: 0; font-weight: bold;"><?php echo $total_favoritos; ?></h3>
                <p style="margin: 5px 0; color: #666;">Favoritos acumulados</p>
            </div>
        </div>


        <div class="chart-row">
            <div class="chart-container" style="margin: 15px;">
                <div class="chart-title"><i class="fas fa-door-open text-primary me-2"></i>Habitaciones</div>
                <canvas id="habitacionesChart"></canvas>
            </div>
            <div class="chart-container" style="margin: 15px;">
                <div class="chart-title"><i class="fas fa-user text-primary me-2"></i>Clientes por Posada</div>
                <canvas id="clientesChart"></canvas>
            </div>
            <div class="chart-container" style="margin: 15px;">
                <div class="chart-title"><i class="fas fa-car text-danger me-2"></i>Vehículos por Posada</div>
                <canvas id="vehiculosChart"></canvas>
            </div>

        </div>
    </div>
</div>
</div>

<script>
    function generateRandomColors(count) {
        const colors = [];
        for (let i = 0; i < count; i++) {
            const color = `hsl(${Math.random() * 360}, 70%, 60%)`;
            colors.push(color);
        }
        return colors;
    }

    const habitacionesData = {
        labels: <?php echo json_encode(array_keys($data_habitaciones)); ?>,
        datasets: [{
            data: <?php echo json_encode(array_values($data_habitaciones)); ?>,
            backgroundColor: generateRandomColors(<?php echo count($data_habitaciones); ?>),
            borderWidth: 1
        }]
    };

    const clientesData = {
        labels: <?php echo json_encode(array_keys($data_clientes)); ?>,
        datasets: [{
            data: <?php echo json_encode(array_values($data_clientes)); ?>,
            backgroundColor: generateRandomColors(<?php echo count($data_clientes); ?>),
            borderWidth: 1
        }]
    };

    const vehiculosData = {
    labels: <?php echo json_encode(array_keys($data_vehiculos)); ?>,
    datasets: [{
        data: <?php echo json_encode(array_values($data_vehiculos)); ?>,
        backgroundColor: generateRandomColors(<?php echo count($data_vehiculos); ?>),
        borderWidth: 1
    }]
};




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

    new Chart(document.getElementById('habitacionesChart').getContext('2d'), config(habitacionesData));
    new Chart(document.getElementById('clientesChart').getContext('2d'), config(clientesData));
    new Chart(document.getElementById('vehiculosChart').getContext('2d'), config(vehiculosData));
</script>
</body>

</html>