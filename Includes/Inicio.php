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
        body,
        html {
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
            padding: 10px;
            margin: auto;
            max-width: 95%;
            margin-left: 250px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            gap: 10px;
        }

        .card {
            flex: 1;
            min-width: 150px;
            max-width: 200px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            padding: 10px;
            text-align: center;
        }

        .card i {
            font-size: 1.5rem;
            margin-bottom: 5px;
            color: #3fa141;
        }

        .card h3 {
            font-size: 1rem;
            margin: 5px 0;
            color: #333;
        }

        .card p {
            font-size: 0.8rem;
            color: #666;
        }

        .chart-row {
            display: flex;
            justify-content: flex-start;
            margin-top: 20px;
            gap: 0;
        }

        .chart-container {
            flex: 1;
            max-width: 250px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            padding: 0px;
            text-align: center;
        }

        .chart-title {
            text-align: center;
            margin-bottom: 5px;
            font-size: 1.2rem;
            font-weight: bold;
            color: #3fa141;
        }


        footer {
            text-align: center;
            color: #666;
            padding: 5px 0;
            width: 100%;
            margin-top: auto;
        }

        .profile-container {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    padding: 20px;
    max-width: 80%;
}

.profile-image-container img {
    border: 3px solid #ddd;
    width: 120px;
    height: 120px;
    object-fit: cover;
    border-radius: 50%;
}

.profile-info {
    margin-top: 10px; /* Añade un espacio consistente */
}


.profile-info h5 {
    margin: 0;
    font-size: 1.25rem;
    font-weight: bold;
}

.profile-info p {
    margin: 5px 0 0;
    color: #666;
}

.profile-form {
    flex: 1;
    margin-left: 30px;
}

.profile-form .form-control {
    width: 100%;
}

.profile-form label {
    font-weight: 600;
    font-size: 0.9rem;
    margin-bottom: 5px;
}

.profile-form .btn {
    width: 100%;
    padding: 10px;
    font-size: 1rem;
}

.profile-left {
    display: flex;
    flex-direction: column;
    align-items: center; /* Centra imagen, nombre y membresía */
    max-width: 200px; /* Ajusta el ancho si es necesario */
}



    </style>
</head>

<>
    <?php include './Header_Admin.php'; ?>

    <div class="content-wrapper">
        <div class="container">
            <div class="row">
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

    <div class="container mt-5">
    <div class="profile-container">
        <!-- Sección izquierda: Información del usuario -->
        <div class="profile-left">
            <div class="profile-image-container">
                <img src="<?php echo $profile_image_url ?? '../Assets/img/default-profile.png'; ?>" alt="Foto de Perfil">
            </div>
            <div class="profile-info text-center">
                <h5><?php echo $first_name . ' ' . $last_name; ?></h5>
                <p class="text-muted">
                    <?php
                        // Verificar el tipo de membresía y aplicar el texto y color correspondiente
                        if ($membership_type == 'basic') {
                            echo '<span style="color: #cd7f32;">Básico</span>';  // Color bronce
                        } elseif ($membership_type == 'silver') {
                            echo '<span style="color: silver;">Plata</span>';  // Color plata
                        } elseif ($membership_type == 'gold') {
                            echo '<span style="color: gold;">Oro</span>';  // Color dorado
                        } else {
                            echo 'Membresía no definida';  // En caso de que el tipo no sea ninguno de los anteriores
                        }
                    ?>
                </p>
            </div>
        </div>




        <!-- Sección derecha: Formulario de edición -->
        <div class="profile-form">
            <form action="update_profile.php" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <label for="first_name" class="form-label">Nombre</label>
                        <input type="text" name="first_name" id="first_name" class="form-control"
                            value="<?php echo $first_name; ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="last_name" class="form-label">Apellido</label>
                        <input type="text" name="last_name" id="last_name" class="form-control"
                            value="<?php echo $last_name; ?>" required>
                    </div>
                </div>
                <div class="mt-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" name="email" id="email" class="form-control"
                        value="<?php echo $email ?? ''; ?>" required>
                </div>
                <div class="mt-3">
                    <label for="password" class="form-label">Contraseña (Opcional)</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="mt-3">
                    <label for="profile_image_url" class="form-label">URL de Imagen de Perfil</label>
                    <input type="text" name="profile_image_url" id="profile_image_url" class="form-control"
                        value="<?php echo $profile_image_url; ?>">
                </div>
                <div class="mt-3">
                    <label for="banner_image_url" class="form-label">URL de Banner</label>
                    <input type="text" name="banner_image_url" id="banner_image_url" class="form-control"
                        value="<?php echo $banner_image_url ?? ''; ?>">
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>


    <footer>
        <p style="text-align: center; color: #666;">© 2024 Dashboard. Todos los derechos reservados.</p>
    </footer>

    <script>
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
    </script>
    </body>

</html>