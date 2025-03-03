<?php
include '../config/db.php'; 
include './Includes/Dashboard.php';

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = $_GET['id'];
    $status = $_GET['status'] == 'true' ? 1 : 0;

    $sql = "UPDATE rooms SET status = $status WHERE id = $id";

    if ($conn->query($sql) === TRUE) {

        header("Location: ?status=success");
        exit();
    } else {

        header("Location: ?status=error");
        exit();
    }
}

$conn->close(); 
?>