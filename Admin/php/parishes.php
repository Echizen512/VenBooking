<?php
include '../config/db.php'; 
include './Includes/Dashboard.php';
if (isset($_POST['create'])) {
    $municipality_id = $_POST['municipality_id'];
    $name = $_POST['name'];

    $sql = "INSERT INTO parishes (municipality_id, name) VALUES ($municipality_id, '$name')";
    if ($conn->query($sql) === TRUE) {
        header("Location: ?status=created");
        exit();
    } else {
        header("Location: ?status=error");
        exit();
    }
}

if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $municipality_id = $_POST['municipality_id'];
    $name = $_POST['name'];

    $sql = "UPDATE parishes SET municipality_id = $municipality_id, name = '$name' WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        header("Location: ?status=updated");
        exit();
    } else {
        header("Location: ?status=error");
        exit();
    }
}

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = $_GET['id'];
    $status = $_GET['status'] == 'true' ? 1 : 0;

    $sql = "UPDATE parishes SET status = $status WHERE id = $id";
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