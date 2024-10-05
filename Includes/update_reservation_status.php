<?php
include '../config/db.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Depuración: Verificar si los datos POST están presentes
    error_log('Datos POST recibidos: ' . print_r($_POST, true));
    
    if (!isset($_POST['id']) || !isset($_POST['action'])) {
        error_log('Datos faltantes en POST');
        die('Datos faltantes');
    }

    $id = $_POST['id'];
    $action = $_POST['action'];

    // Determinar el nuevo estado basado en la acción
    if ($action === 'confirm') {
        $newStatus = 'Confirmado';
    } elseif ($action === 'cancel') {
        $newStatus = 'Cancelado';
    } else {
        error_log('Acción no válida: ' . $action);
        die('Acción no válida');
    }

    // Actualizar el estado en la base de datos
    $sql = "UPDATE reservations SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        error_log('Error al preparar la consulta: ' . $conn->error);
        die('Error al preparar la consulta: ' . $conn->error);
    }
    $stmt->bind_param('si', $newStatus, $id);

    if ($stmt->execute()) {
        header("Location: get_reservation.php?status=success");
    } else {
        error_log('Error al ejecutar la consulta: ' . $stmt->error);
        header("Location: get_reservation.php?status=error");
    }
    $stmt->close();
    $conn->close();
} else {
    die('Método de solicitud no permitido');
}
?>
