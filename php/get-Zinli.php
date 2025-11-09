<?php
include '../config/db.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'create') {
    $inn_id = $_POST['inn_id'];
    $email = $_POST['email'];

    // Verificar si ya existe una transferencia Zinli registrada para la misma posada y correo
    $check_sql = "SELECT * FROM zinli_transfer_info WHERE inn_id = ? AND email = ?";
    $stmt_check = $conn->prepare($check_sql);
    $stmt_check->bind_param("is", $inn_id, $email);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        $message = "Ya existe una transferencia Zinli registrada para esta posada y correo electrónico.";
    } else {
        // Insertar nueva transferencia Zinli
        $sql = "INSERT INTO zinli_transfer_info (inn_id, email) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $inn_id, $email);

        if ($stmt->execute()) {
            $message = "Transferencia Zinli agregada exitosamente.";
        } else {
            $message = "Error al agregar la transferencia Zinli: " . $conn->error;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'update') {
    $id = $_POST['id'];
    $email = $_POST['email'];

    // Actualizar transferencia Zinli
    $sql = "UPDATE zinli_transfer_info SET email = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $email, $id);

    if ($stmt->execute()) {
        $message = "Transferencia Zinli actualizada exitosamente.";
    } else {
        $message = "Error al actualizar la transferencia Zinli: " . $conn->error;
    }
}

// Obtener las transferencias de Zinli para el usuario actual
$sql = "SELECT zinli_transfer_info.id, zinli_transfer_info.email, inns.name AS inn_name 
        FROM zinli_transfer_info
        LEFT JOIN inns ON zinli_transfer_info.inn_id = inns.id
        WHERE inns.user_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>