<?php
include '../config/db.php';
include './Includes/Dashboard.php';

if (isset($_POST['create'])) {
    $state_id = $_POST['state_id'];
    $name = $_POST['name'];
    $status = isset($_POST['status']) ? 1 : 0;
    $flag_url = $_POST['flag_url'];

    $sql = "INSERT INTO municipalities (state_id, name, status, flag_url) VALUES ($state_id, '$name', $status, '$flag_url')";
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
    $state_id = $_POST['state_id'];
    $name = $_POST['name'];
    $status = isset($_POST['status']) ? 1 : 0;
    $flag_url = $_POST['flag_url'];

    $sql = "UPDATE municipalities SET state_id = $state_id, name = '$name', status = $status, flag_url = '$flag_url' WHERE id = $id";
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

    $sql = "UPDATE municipalities SET status = $status WHERE id = $id";
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