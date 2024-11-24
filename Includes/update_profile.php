<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Cambié el campo de user_id a id, asumiendo que Profile tiene un campo id
$query_profile_type = "SELECT profile_type FROM Profile WHERE id = ?";
$stmt_profile_type = $conn->prepare($query_profile_type);
$stmt_profile_type->bind_param("i", $user_id);
$stmt_profile_type->execute();
$result_profile_type = $stmt_profile_type->get_result();
$profile_type = $result_profile_type->fetch_assoc()['profile_type'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $profile_image_url = $_POST['profile_image_url'];
    $banner_image_url = $_POST['banner_image_url'];

    // Si el password no está vacío, actualizamos el hash del password
    if (!empty($password)) {
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $sql_update = "UPDATE Profile SET first_name = ?, last_name = ?, email = ?, password = ?, profile_image_url = ?, banner_image_url = ? WHERE id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ssssssi", $first_name, $last_name, $email, $password_hash, $profile_image_url, $banner_image_url, $user_id);
    } else {
        // Si el password está vacío, no se actualiza
        $sql_update = "UPDATE Profile SET first_name = ?, last_name = ?, email = ?, profile_image_url = ?, banner_image_url = ? WHERE id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("sssssi", $first_name, $last_name, $email, $profile_image_url, $banner_image_url, $user_id);
    }

    // Ejecutar la actualización del perfil
    if ($stmt_update->execute()) {
        // Redirigir dependiendo del tipo de perfil
        if ($profile_type == "Empresa") {
            header("Location: ./Inicio.php");  // Redirección si el tipo de perfil es "Empresa"
        } else {
            header("Location: ../profile.php");  // Redirección por defecto
        }
        exit();
    } else {
        echo "Error al actualizar el perfil: " . $conn->error;
    }
}
?>
