<?php

include '../config/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

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

<?php include './Header_Admin.php'; ?>


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
    .btn {
        max-width: 40%;
        border-radius: 40px;
    }

    /* Animación para la carga de la página */
    @keyframes fadeIn {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    body {
        animation: fadeIn 2s ease-in-out;
    }


    .hidden {
        display: none;
    }
</style>

<div class="container" style="margin-top: 70px;">
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
                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Guardar Cambios
                    </button>
                </div>
            </form>
        </div>

    </div>