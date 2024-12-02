<?php
include '../config/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
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


$query_profile = "SELECT first_name, last_name, email, membership_type, profile_image_url, banner_image_url FROM Profile WHERE id = ?";
$stmt = $conn->prepare($query_profile);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $first_name = $user['first_name'];
    $last_name = $user['last_name'];
    $email = $user['email'];
    $membership_type = $user['membership_type'];
    $profile_image_url = $user['profile_image_url'];
    $banner_image_url = $user['banner_image_url'];
} else {
    $first_name = "Usuario";
    $last_name = "Desconocido";
    $email = "Desconocido";
    $membership_type = "Sin membresía";
    $profile_image_url = "../Assets/img/default-profile.png";
    $banner_image_url = "Desconocido";
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

<div class="container mt-5">
    <div class="profile-container">
        <div class="profile-left">
            <div class="profile-image-container text-center">
                <img src="<?php echo $profile_image_url ?? '../Assets/img/default-profile.png'; ?>" alt="Foto de Perfil"
                    class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
            </div>
            <div class="profile-info text-center mt-3">
                <h5>
                    <i class="fas fa-id-badge text-secondary me-2"></i>
                    <?php echo $first_name . ' ' . $last_name; ?>
                </h5>
                <p class="text-muted mt-2">
                    <i class="fas fa-star text-warning me-2"></i>
                    <?php
                    if ($membership_type == 'basic') {
                        echo '<span style="color: #cd7f32;">Básico</span>';
                    } elseif ($membership_type == 'silver') {
                        echo '<span style="color: silver;">Plata</span>';
                    } elseif ($membership_type == 'gold') {
                        echo '<span style="color: gold;">Oro</span>';
                    } else {
                        echo 'Membresía no definida';
                    }
                    ?>
                </p>
            </div>
        </div>

        <div class="profile-form">
            <form action="update_profile.php" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <label for="first_name" class="form-label">
                            <i class="fas fa-user text-primary me-2"></i>Nombre
                        </label>
                        <input type="text" name="first_name" id="first_name" class="form-control"
                            value="<?php echo $first_name; ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="last_name" class="form-label">
                            <i class="fas fa-user text-primary me-2"></i>Apellido
                        </label>
                        <input type="text" name="last_name" id="last_name" class="form-control"
                            value="<?php echo $last_name; ?>" required>
                    </div>
                </div>
                <div class="mt-3">
                    <label for="email" class="form-label">
                        <i class="fas fa-envelope text-warning me-2"></i>Correo Electrónico
                    </label>
                    <input type="email" name="email" id="email" class="form-control" value="<?php echo $email ?? ''; ?>"
                        required>
                </div>
                <div class="mt-3">
                    <label for="password" class="form-label">
                        <i class="fas fa-lock text-secondary me-2"></i>Contraseña (Opcional)
                    </label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="mt-3">
                    <label for="profile_image_url" class="form-label">
                        <i class="fas fa-image text-primary me-2"></i>URL de Imagen de Perfil
                    </label>
                    <input type="text" name="profile_image_url" id="profile_image_url" class="form-control"
                        value="<?php echo $profile_image_url; ?>">
                </div>
                <div class="mt-3">
                    <label for="banner_image_url" class="form-label">
                        <i class="fas fa-image text-danger me-2"></i>URL de Banner
                    </label>
                    <input type="text" name="banner_image_url" id="banner_image_url" class="form-control"
                        value="<?php echo $banner_image_url ?? ''; ?>">
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Guardar Cambios
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>


<footer>
    <p style="text-align: center; color: #666;">© 2024 VenBooking. Todos los derechos reservados.</p>
</footer>

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