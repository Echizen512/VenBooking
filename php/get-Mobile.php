<?php
include '../config/db.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Lógica para Crear Pago Móvil
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'create') {
    $inn_id = $_POST['inn_id'];
    $cedula = $_POST['cedula'];
    $bank_code = $_POST['bank_code'];
    $phone_number = $_POST['phone_number'];

    $check_sql = "SELECT * FROM mobile_payment_info WHERE inn_id = ?";
    $stmt_check = $conn->prepare($check_sql);
    $stmt_check->bind_param("i", $inn_id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        $message = "Ya existe un pago móvil registrado para esta posada.";
    } else {
        $sql = "INSERT INTO mobile_payment_info (inn_id, cedula, bank_code, phone_number) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isss", $inn_id, $cedula, $bank_code, $phone_number);

        if ($stmt->execute()) {
            $message = "Pago móvil agregado exitosamente.";
        } else {
            $message = "Error al agregar el pago móvil: " . $conn->error;
        }
    }
}

// Lógica para Actualizar Pago Móvil
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'update') {
    $id = $_POST['id'];
    $cedula = $_POST['cedula'];
    $bank_code = $_POST['bank_code'];
    $phone_number = $_POST['phone_number'];

    $sql = "UPDATE mobile_payment_info SET cedula = ?, bank_code = ?, phone_number = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $cedula, $bank_code, $phone_number, $id);

    if ($stmt->execute()) {
        $message = "Pago móvil actualizado exitosamente.";
    } else {
        $message = "Error al actualizar el pago móvil: " . $conn->error;
    }
}

$sql = "SELECT mobile_payment_info.id, mobile_payment_info.cedula, mobile_payment_info.bank_code, mobile_payment_info.phone_number, inns.name AS inn_name 
        FROM mobile_payment_info
        LEFT JOIN inns ON mobile_payment_info.inn_id = inns.id
        WHERE inns.user_id = ?";

$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die('Error al preparar la consulta: ' . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>