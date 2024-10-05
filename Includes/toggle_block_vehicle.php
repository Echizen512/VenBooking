<?php
include '../config/db.php';
include './Dashboard.php';

session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Verificar si se ha recibido una solicitud POST con el ID del vehículo
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Obtener el estado actual de 'block' para el vehículo específico
    $sql = "SELECT block FROM vehicles WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Error al preparar la consulta: ' . $conn->error);
    }
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($currentBlock);
    $stmt->fetch();
    $stmt->close();

    // Invertir el estado de 'block'
    $newBlock = $currentBlock ? 0 : 1;

    // Actualizar el estado de 'block' en la base de datos
    $sql = "UPDATE vehicles SET block = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Error al preparar la consulta: ' . $conn->error);
    }
    $stmt->bind_param("ii", $newBlock, $id);
    $stmt->execute();
    $stmt->close();

    $conn->close();

    // Redireccionar de nuevo a la lista de vehículos
    header("Location: get_vehicles.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toggle Block</title>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            icon: 'success',
            title: 'Estado del vehículo actualizado.',
            showConfirmButton: false,
            timer: 1500
        }).then(function() {
            window.location.href = 'get_vehicles.php';
        });
    });
</script>
</body>
</html>
