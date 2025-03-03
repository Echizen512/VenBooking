<?php
include '../config/db.php';
include './Includes/Dashboard.php';

if (isset($_GET['id']) && isset($_GET['block'])) {
    $id = $_GET['id'];
    $block = $_GET['block'] == 'true' ? 1 : 0;
    $sql = "UPDATE Profile SET block = $block WHERE id = $id";

    if ($conn->query($sql) === TRUE) {

        header("Location: get_profile.php?status=success");
        exit();
    } else {

        header("Location: get_profile.php?status=error");
        exit();
    }
}
?>