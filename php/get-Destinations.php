<?php
session_start();
include './config/db.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT profile_type FROM Profile WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($profile_type);
        $stmt->fetch();
        $stmt->close();

        if ($profile_type === "Empresa" && basename($_SERVER['PHP_SELF']) !== 'Inicio.php') {
            header("Location: Includes/Inicio.php");
            exit;
        }
        if ($profile_type === "Turista" && basename($_SERVER['PHP_SELF']) !== 'Destinations.php') {
            header("Location: Destinations.php");
            exit;
        }
    } else {
        echo "Error al preparar la consulta.";
    }
}

$headerFile = isset($_SESSION['user_id']) ? './Includes/Header.php' : './Includes/Header2.php';

$states_query = "SELECT * FROM States";
$states_result = $conn->query($states_query);

$destinations_query = "SELECT d.*, s.name AS state_name 
                       FROM Destinations d 
                       JOIN States s ON d.state_id = s.id 
                       WHERE d.status = 1";
$destinations_result = $conn->query($destinations_query);

?>