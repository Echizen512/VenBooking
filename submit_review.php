<?php

require_once './config/db.php';


$message = '';
$alertType = '';
$redirect = 'Profile.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reservation_id = isset($_POST['reservation_id']) ? intval($_POST['reservation_id']) : null;
    $rating = isset($_POST['rating']) ? intval($_POST['rating']) : null;

    if ($reservation_id && $rating && $rating >= 1 && $rating <= 5) {
        $sql_insert_review = "INSERT INTO reviews (reservation_id, rating) VALUES (?, ?)";
        $stmt_insert_review = $conn->prepare($sql_insert_review);

        if ($stmt_insert_review) {
            $stmt_insert_review->bind_param("ii", $reservation_id, $rating);

            if ($stmt_insert_review->execute()) {
                
                $alertType = 'success';
                $message = '¡Valoración registrada exitosamente!';
            } else {
                
                $alertType = 'error';
                $message = 'Hubo un error al registrar la valoración. Por favor, inténtalo de nuevo.';
            }
            $stmt_insert_review->close();
        } else {
            
            $alertType = 'error';
            $message = 'Error al preparar la consulta. Por favor, inténtalo de nuevo.';
        }
    } else {
        
        $alertType = 'warning';
        $message = 'Por favor, verifica la información ingresada.';
    }
} else {
    
    $alertType = 'error';
    $message = 'El método de solicitud no es válido.';
}


echo "<script>
    window.onload = function() {
        showAlert('$alertType', '$message', '$redirect');
    };
</script>";
?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    function showAlert(type, message, redirect) {
        Swal.fire({
            icon: type,
            title: type === 'success' ? '¡Éxito!' : (type === 'error' ? 'Error' : 'Atención'),
            text: message,
            confirmButtonColor: type === 'success' ? '#3085d6' : '#d33',
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = redirect;
            }
        });
    }
</script>
