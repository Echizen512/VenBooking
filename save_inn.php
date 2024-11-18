<?php
session_start();
include './config/db.php';

$alertMessage = '';  // Variable para almacenar el mensaje de alerta
$alertType = '';     // Variable para almacenar el tipo de alerta (success, error, info)
$redirectUrl = 'index.php'; // URL a la que se redirigirá después de la alerta

// Redirigir a la página de inicio de sesión si el usuario no está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Obtener el ID del usuario desde la sesión
$user_id = $_SESSION['user_id'];

if (isset($_GET['inn_id']) && !empty($_GET['inn_id'])) {
    $inn_id = intval($_GET['inn_id']); // Convertir a entero para mayor seguridad

    // Verificar si la posada ya está guardada
    $check_query = "SELECT * FROM user_favorite_inns WHERE inn_id = ? AND user_id = ?";
    $stmt_check = $conn->prepare($check_query);
    if ($stmt_check === false) {
        die('Error al preparar la consulta: ' . $conn->error);
    }

    $stmt_check->bind_param("ii", $inn_id, $user_id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows == 0) {
        // Si no está guardada, agregarla a la tabla
        $insert_query = "INSERT INTO user_favorite_inns (user_id, inn_id) VALUES (?, ?)";
        $stmt_insert = $conn->prepare($insert_query);
        if ($stmt_insert === false) {
            die('Error al preparar la consulta: ' . $conn->error);
        }

        $stmt_insert->bind_param("ii", $user_id, $inn_id);
        if ($stmt_insert->execute()) {
            $alertMessage = 'Posada guardada exitosamente.';
            $alertType = 'success';
        } else {
            $alertMessage = 'Error al guardar la posada.';
            $alertType = 'error';
        }
    } else {
        $alertMessage = 'Esta posada ya está en tus favoritas.';
        $alertType = 'info';
    }
}
?>

<!-- Asegúrate de cargar SweetAlert2 al final del body o justo antes del cierre de la etiqueta </body> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {  // Espera a que el DOM esté completamente cargado
    <?php if ($alertMessage != ''): ?>
        Swal.fire({
            icon: '<?php echo $alertType; ?>',
            title: '<?php echo $alertMessage; ?>',
            showConfirmButton: false,
            timer: 1500
        }).then(function() {
            window.location.href = '<?php echo $redirectUrl; ?>'; // Redirige a index.php
        });
    <?php endif; ?>
});
</script>
