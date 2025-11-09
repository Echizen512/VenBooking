<?php include './PHP/get-index.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>VenBooking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
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