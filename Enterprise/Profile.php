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
    <link rel="stylesheet" href="../Assets/css/Style-Profile.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<div class="container mt-5">
    <div class="profile-card">
        <img src="<?php echo $profile_image_url ?? '../Assets/img/default-profile.png'; ?>" alt="Foto de Perfil">
        <h5>
            <i class="fas fa-id-badge text-secondary me-2"></i>
            <?php echo $first_name . ' ' . $last_name; ?>
        </h5>
        <p class="text-muted">
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

        <form action="../PHP/Update-profile.php" method="POST">
            <input type="text" name="first_name" class="form-control" placeholder="Nombre" value="<?php echo $first_name; ?>" required>
            <input type="text" name="last_name" class="form-control" placeholder="Apellido" value="<?php echo $last_name; ?>" required>
            <input type="email" name="email" class="form-control" placeholder="Correo Electrónico" value="<?php echo $email ?? ''; ?>" required>
            <input type="password" name="password" class="form-control" placeholder="Contraseña (opcional)">
            <input type="text" name="profile_image_url" class="form-control" placeholder="URL de Imagen de Perfil" value="<?php echo $profile_image_url; ?>">
            <input type="text" name="banner_image_url" class="form-control" placeholder="URL de Banner" value="<?php echo $banner_image_url ?? ''; ?>">
            <button type="submit" class="btn btn-primary btn-custom mt-3">
                <i class="fas fa-save me-2"></i>Guardar Cambios
            </button>
        </form>
    </div>
</div>
