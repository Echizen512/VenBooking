<?php
include '../config/db.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Lógica para Crear Transferencia Binance
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'create') {
    $inn_id = $_POST['inn_id'];
    $email = $_POST['email'];

    // Verificar si ya existe una transferencia registrada para esta posada
    $check_sql = "SELECT * FROM binance_transfer_info WHERE inn_id = ? AND email = ?";
    $stmt_check = $conn->prepare($check_sql);
    $stmt_check->bind_param("is", $inn_id, $email);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        $message = "Ya existe una transferencia Binance registrada para esta posada y correo electrónico.";
    } else {
        $sql = "INSERT INTO binance_transfer_info (inn_id, email) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $inn_id, $email);

        if ($stmt->execute()) {
            $message = "Transferencia Binance agregada exitosamente.";
        } else {
            $message = "Error al agregar la transferencia Binance: " . $conn->error;
        }
    }
}

// Lógica para Actualizar Transferencia Binance
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'update') {
    $id = $_POST['id'];
    $email = $_POST['email'];

    $sql = "UPDATE binance_transfer_info SET email = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $email, $id);

    if ($stmt->execute()) {
        $message = "Transferencia Binance actualizada exitosamente.";
    } else {
        $message = "Error al actualizar la transferencia Binance: " . $conn->error;
    }
}

// Consultar Transferencias Binance
$sql = "SELECT binance_transfer_info.id, binance_transfer_info.email, inns.name AS inn_name 
        FROM binance_transfer_info
        LEFT JOIN inns ON binance_transfer_info.inn_id = inns.id
        WHERE inns.user_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>