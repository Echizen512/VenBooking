<?php
session_start();
include './config/db.php';

$alertMessage = '';  
$alertType = '';     
$redirectUrl = 'Inns.php'; 


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}


$user_id = $_SESSION['user_id'];

if (isset($_GET['inn_id']) && !empty($_GET['inn_id'])) {
    $inn_id = intval($_GET['inn_id']); 

    
    $check_query = "SELECT * FROM user_favorite_inns WHERE inn_id = ? AND user_id = ?";
    $stmt_check = $conn->prepare($check_query);
    if ($stmt_check === false) {
        die('Error al preparar la consulta: ' . $conn->error);
    }

    $stmt_check->bind_param("ii", $inn_id, $user_id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows == 0) {
        
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {  
    <?php if ($alertMessage != ''): ?>
        Swal.fire({
            icon: '<?php echo $alertType; ?>',
            title: '<?php echo $alertMessage; ?>',
            showConfirmButton: false,
            timer: 1500
        }).then(function() {
            window.location.href = '<?php echo $redirectUrl; ?>';
        });
    <?php endif; ?>
});
</script>
