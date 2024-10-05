<?php
include '../config/db.php';
include './Dashboard.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Consulta para obtener el estado actual de bloqueo
    $sql = "SELECT block FROM tour_packages WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Error al preparar la consulta: ' . $conn->error);
    }
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($currentBlock);
    $stmt->fetch();
    $stmt->close();

    // Cambiar el estado de bloqueo
    $newBlock = $currentBlock ? 0 : 1;

    $sql = "UPDATE tour_packages SET block = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Error al preparar la consulta: ' . $conn->error);
    }
    $stmt->bind_param("ii", $newBlock, $id);
    $stmt->execute();
    $stmt->close();

    $conn->close();

    header("Location: get_tour_packages.php");
    exit();
}
?>
