<?php
    include '../config/db.php';
    include './Dashboard.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM tour_packages WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Tour package deleted successfully";
    } else {
        echo "Error deleting tour package: " . $conn->error;
    }
} else {
    echo "Tour package ID not provided";
}
?>
