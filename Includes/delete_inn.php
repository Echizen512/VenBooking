<?php
    include '../config/db.php';
    include './Dashboard.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Eliminar la posada
    $sql = "DELETE FROM inns WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Posada eliminada correctamente.";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>
