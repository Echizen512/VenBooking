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
    @keyframes fadeIn {
        0% { opacity: 0; transform: translateY(20px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    :root {
        --main-bg: #f4f6f9;
        --card-bg: #ffffff;
        --primary-color: #3b82f6;
        --secondary-color: #6b7280;
        --accent-color: #10b981;
        --shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
        --radius: 1.25rem;
    }

    body {
        background-color: var(--main-bg);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .profile-card {
        max-width: 500px;
        margin: 2rem auto;
        background-color: var(--card-bg);
        border-radius: var(--radius);
        padding: 2.5rem 2rem;
        box-shadow: var(--shadow);
        text-align: center;
        animation: fadeIn 1s ease-in-out;
        transition: transform 0.3s ease;
    }

    .profile-card:hover {
        transform: scale(1.01);
    }

    .profile-card img {
        width: 130px;
        height: 130px;
        object-fit: cover;
        border-radius: 50%;
        margin-bottom: 1rem;
        border: 4px solid var(--primary-color);
    }

    .profile-card h5 {
        font-weight: 600;
        color: var(--secondary-color);
    }

    .profile-card p {
        font-size: 0.95rem;
        color: var(--secondary-color);
        margin-bottom: 1.5rem;
    }

    .profile-card .form-control {
        margin-bottom: 1rem;
        border-radius: 0.5rem;
        border: 1px solid #ddd;
        box-shadow: none;
        transition: border-color 0.3s;
    }

    .profile-card .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.15rem rgba(59, 130, 246, 0.25);
    }

    .btn-custom {
        width: 100%;
        border-radius: 2rem;
        background: var(--primary-color);
        border: none;
        color: white;
        transition: background 0.3s;
    }

    .btn-custom:hover {
        background: var(--accent-color);
    }
</style>


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

        <form action="update_profile.php" method="POST">
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
