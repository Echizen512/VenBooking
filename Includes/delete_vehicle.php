<?php
    include '../config/db.php';
    include './Dashboard.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Consulta SQL para eliminar un vehículo por su ID
    $sql = "DELETE FROM vehicles WHERE id=?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Vehículo eliminado exitosamente.";
    } else {
        echo "Error al eliminar el vehículo: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
