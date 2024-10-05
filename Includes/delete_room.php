<?php
    include '../config/db.php';
    include './Dashboard.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM rooms WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Room deleted successfully.";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
header("Location: list_rooms.php");
?>
