<?php
session_start();
include './config/db.php';

// Habilitar el informe de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verificar conexión a la base de datos
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $userId = $_SESSION['user_id'];

    if (!$userId) {
        echo "Usuario no autenticado.";
        exit;
    }

    // Verificar si los datos están presentes
    if (empty($_GET['membership_type']) || empty($_GET['amount'])) {
        echo "Datos de la membresía no válidos.";
        exit;
    }

    $membershipType = $_GET['membership_type'];
    $amount = $_GET['amount'];

    $purchaseDate = date('Y-m-d');
    $expirationDate = date('Y-m-d', strtotime('+1 month', strtotime($purchaseDate)));

    $sql = "INSERT INTO membership_purchases (user_id, membership_type, purchase_date, expiration_date, amount, payment_status)
            VALUES (?, ?, ?, ?, ?, 'completed')";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssd", $userId, $membershipType, $purchaseDate, $expirationDate, $amount);
    
    if ($stmt->execute()) {
        $updateSql = "UPDATE profile SET membership_type = ?, membership_start_date = ?, membership_end_date = ? WHERE id = ?";
        $stmt = $conn->prepare($updateSql);
        $stmt->bind_param("sssi", $membershipType, $purchaseDate, $expirationDate, $userId);
        $stmt->execute();

        // Almacenar mensaje de éxito en la sesión
        $_SESSION['message'] = "Membresía adquirida con éxito!";
        $_SESSION['message_type'] = "success"; // Puedes usarlo para clasificar el tipo de mensaje
    } else {
        // Almacenar mensaje de error en la sesión
        $_SESSION['message'] = "Error al procesar la compra: " . $stmt->error;
        $_SESSION['message_type'] = "error"; // Clasificación del mensaje de error
    }

    $stmt->close();
    $conn->close();

    // Redirigir a la página de membresías
    header('Location: memberships.php');
    exit();
}
?>
