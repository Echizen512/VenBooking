<?php
session_start();

$errorScript = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $adminEmail = 'Admin'; 
    $adminPassword = 'Admin'; 

    if ($email === $adminEmail && $password === $adminPassword) {
        $_SESSION["user_id"] = 1; 
        header("Location: user.php");
        exit();
    } else {
        $errorScript = "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Correo electrónico o contraseña incorrectos.',
                confirmButtonText: 'Aceptar'
            });
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VenBooking</title>
    <link rel="stylesheet" href="./Login.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<div class="row">
    <div class="col-md-6 mx-auto p-4">
        <div class="login-box" style="border-radius: 50px;">
            <div class="login-snip" style="border-radius: 50px;">
                <input id="tab-1" type="radio" name="tab" class="sign-in" checked>
                <label for="tab-1" class="tab"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</label>
                <div class="login-space">
                    <div class="login"> <br> <br>
                        <form method="POST" action="">
                            <div class="group">
                                <label for="user" class="label"><i class="fas fa-envelope"></i> Correo Electrónico</label>
                                <input id="user" name="email" type="text" class="input" placeholder="Ingresa tu correo electrónico" required>
                            </div>
                            <div class="group">
                                <label for="pass" class="label"><i class="fas fa-lock"></i> Contraseña</label>
                                <input id="pass" name="password" type="password" class="input" placeholder="Ingresa tu contraseña" required>
                            </div>
                            <div class="group">
                                <input id="check" type="checkbox" class="check" checked>
                                <label for="check"><span class="icon"></span> Mantenerme conectado</label>
                            </div>
                            <div class="group">
                                <input type="submit" name="login" class="button" style="background: #28a745;" value="Iniciar Sesión">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>   
    </div>
</div>

<?php if ($errorScript): ?>
    <?php echo $errorScript; ?>
<?php endif; ?>

</body>
</html>
