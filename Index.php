<?php
session_start();
include './config/db.php';

$headerFile = isset($_SESSION['user_id']) ? './Includes/Header.php' : './Includes/Header2.php';

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
        if ($profile_type === "Turista" && basename($_SERVER['PHP_SELF']) !== 'index.php') {
            header("Location: index.php");
            exit;
        }
    } else {
        echo "Error al preparar la consulta.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>VenBooking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php
    include $headerFile;
    include './Components/banner.php';
    include './Components/Destinations.php';
    include './Components/Info.php';
    include './Components/VenBoocking.php';
    include './Includes/Footer.php';
    ?>

    <script>
    function checkSession() {
        Swal.fire({
            icon: 'warning',
            title: 'Iniciar Sesión Requerido',
            text: 'Debes iniciar sesión o crear una cuenta para realizar una reservación.',
            confirmButtonText: 'Ir a Login',
            showCancelButton: true,
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'login.php';
            }
        });
    }
    </script>

</body>
</html>