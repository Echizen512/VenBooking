<?php
include '../config/db.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Lógica para Crear Transferencia Bancaria
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'create') {
    $inn_id = $_POST['inn_id'];
    $full_name = $_POST['full_name'];
    $account_number = $_POST['account_number'];
    $bank_code = $_POST['bank_code'];

    $check_sql = "SELECT * FROM bank_transfer_info WHERE inn_id = ?";
    $stmt_check = $conn->prepare($check_sql);
    $stmt_check->bind_param("i", $inn_id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        $message = "Ya existe una transferencia bancaria registrada para esta posada.";
    } else {
        $sql = "INSERT INTO bank_transfer_info (inn_id, full_name, account_number, bank_code) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isss", $inn_id, $full_name, $account_number, $bank_code);

        if ($stmt->execute()) {
            $message = "Transferencia bancaria agregada exitosamente.";
        } else {
            $message = "Error al agregar la transferencia bancaria: " . $conn->error;
        }
    }
}

// Lógica para Actualizar Transferencia Bancaria
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'update') {
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $account_number = $_POST['account_number'];
    $bank_code = $_POST['bank_code'];

    $sql = "UPDATE bank_transfer_info SET full_name = ?, account_number = ?, bank_code = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $full_name, $account_number, $bank_code, $id);

    if ($stmt->execute()) {
        $message = "Transferencia bancaria actualizada exitosamente.";
    } else {
        $message = "Error al actualizar la transferencia bancaria: " . $conn->error;
    }
}

// Consultar Transferencias Bancarias
$sql = "SELECT bank_transfer_info.id, bank_transfer_info.full_name, bank_transfer_info.account_number, bank_transfer_info.bank_code, inns.name AS inn_name 
        FROM bank_transfer_info
        LEFT JOIN inns ON bank_transfer_info.inn_id = inns.id
        WHERE inns.user_id = ?";

$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die('Error al preparar la consulta: ' . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>