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

    $sql = "SELECT block FROM inns WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Error al preparar la consulta: ' . $conn->error);
    }
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($currentBlock);
    $stmt->fetch();
    $stmt->close();

    $newBlock = $currentBlock ? 0 : 1;

    $sql = "UPDATE inns SET block = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Error al preparar la consulta: ' . $conn->error);
    }
    $stmt->bind_param("ii", $newBlock, $id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    header("Location: get_inns.php");
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
            title: 'Estado de la posada actualizado.',
            showConfirmButton: false,
            timer: 1500
        }).then(function() {
            window.location.href = 'get_inns.php';
        });
    });
</script>
</body>
</html>
