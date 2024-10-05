<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
include './config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $profile_type = $_POST['profile_type'];
    $password = $_POST['password'];

// Validación de la contraseña
if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)[A-Za-z\d]{6,}$/', $password)) {
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Contraseña Inválida',
                text: 'La contraseña debe tener al menos 6 caracteres, incluyendo una mayúscula, una minúscula y un número.'
            }).then(function() {
                window.location.href = 'Login.php'; 
            });
        });
    </script>";
    exit();
}

    // Verificar si el correo ya existe
    $check_email = $conn->prepare("SELECT id FROM Profile WHERE email = ?");
    $check_email->bind_param("s", $email);
    $check_email->execute();
    $check_email->store_result();
    
    if ($check_email->num_rows > 0) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Correo ya registrado',
                    text: 'Este correo electrónico ya está registrado.'
                    }).then(function() {
                window.location.href = 'Login.php'; 
                });
            });
        </script>";
        exit();
    }
    $check_email->close();

    // Insertar los datos
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO Profile (first_name, last_name, email, profile_type, password) VALUES (?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssss", $first_name, $last_name, $email, $profile_type, $hashed_password);
        if ($stmt->execute()) {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Registro Exitoso',
                        text: 'Tu cuenta ha sido creada exitosamente.'
                    }).then(function() {
                        window.location = 'index.php';
                    });
                });
            </script>";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT id, password FROM Profile WHERE email = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $hashed_password);
            $stmt->fetch();
            if (password_verify($password, $hashed_password)) {
                session_start();
                $_SESSION["user_id"] = $id;
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Inicio de Sesión Exitoso'
                        }).then(function() {
                            window.location = 'index.php';
                        });
                    });
                </script>";
            } else {
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Contraseña Incorrecta',
                            text: 'La contraseña que ingresaste es incorrecta.'
                        });
                    });
                </script>";
            }
        } else {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Usuario no encontrado',
                        text: 'No se encontró ninguna cuenta con ese correo electrónico.'
                    });
                });
            </script>";
        }
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login y Registro</title>
    <link rel="stylesheet" href="./Assets/css/Login.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<div class="row">
    <div class="col-md-6 mx-auto p-4">
        <div class="login-box">
            <div class="login-snip">
                <input id="tab-1" type="radio" name="tab" class="sign-in" checked>
                <label for="tab-1" class="tab"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</label>
                <input id="tab-2" type="radio" name="tab" class="sign-up">
                <label for="tab-2" class="tab"><i class="fas fa-user-plus"></i> Registrarse</label>
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
                                <label for="check"><span class="icon"></span>  Mantenerme conectado</label>
                            </div>
                            <div class="group">
                                <input type="submit" name="login" class="button" style="background: #28a745;" value="Iniciar Sesión">
                            </div>
                            <div class="hr"></div>
                            <div class="foot">
                                <a href="#"><i class="fas fa-unlock-alt"></i> ¿Olvidaste tu contraseña?</a>
                            </div>
                        </form>
                    </div>
                    <div class="sign-up-form">
    <form method="POST" action="">
        <div class="group">
            <label for="first_name" class="label"><i class="fas fa-user"></i> Nombre *</label>
            <input id="first_name" name="first_name" type="text" class="input" placeholder="Ingresa tu nombre" required>
        </div>
        <div class="group">
            <label for="last_name" class="label"><i class="fas fa-user"></i> Apellido *</label>
            <input id="last_name" name="last_name" type="text" class="input" placeholder="Ingresa tu apellido" required>
        </div>
        <div class="group">
            <label for="email" class="label"><i class="fas fa-envelope"></i> Correo Electrónico *</label>
            <input id="email" name="email" type="text" class="input" placeholder="Ingresa tu correo electrónico" required>
        </div>
        <div class="group">
            <label for="profile_type" class="label"><i class="fas fa-user-tag"></i> Tipo de Perfil *</label>
            <select name="profile_type" id="profile_type" class="input" style="padding-left: 2.7rem;" required>
                <option value="" disabled selected>Tipo de Perfil *</option>
                <option value="Turista">Turista</option>
                <option value="Empresa">Empresa</option>
            </select>
        </div>
        <div class="group">
            <label for="pass" class="label"><i class="fas fa-lock"></i> Contraseña *</label>
            <input id="pass" name="password" type="password" class="input" placeholder="Crea tu contraseña" required>
        </div>
        <div class="group">
            <input type="submit" name="register" class="button" style="background: #28a745;" value="Registrarse">
        </div>
    </form>
</div>
                </div>
            </div>
        </div>   
    </div>
</div>
</body>
</html>


<style>
body {
    margin: 0;
    color: #000;
    background: url('./background.jpg') no-repeat center center fixed;
    background-size: cover; 
    font: 600 16px/18px 'Open Sans', sans-serif;
}


.login-box {
	width: 100%;
	margin: auto;
	max-width: 600px;
	min-height: 670px;
	position: relative;
	box-shadow: 0 12px 15px 0 rgba(0,0,0,.24), 0 17px 50px 0 rgba(0,0,0,.19);
}

.login-snip {
	width: 100%;
	height: 100%;
	position: absolute;
	padding: 90px 70px 50px 70px;
	background: #f5f6f4;
}

.login-snip .login,
.login-snip .sign-up-form {
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	position: absolute;
	transform: rotateY(180deg);
	backface-visibility: hidden;
	transition: all .4s linear;
}

.login-snip .sign-in,
.login-snip .sign-up,
.login-space .group .check {
	display: none;
}

.login-snip .tab,
.login-space .group .label,
.login-space .group .button {
	text-transform: uppercase;
}

.login-snip .tab {
	font-size: 22px;
	margin-right: 15px;
	padding-bottom: 5px;
	margin: 0 15px 10px 0;
	display: inline-block;
	border-bottom: 2px solid transparent;
}

.login-snip .sign-in:checked + .tab,
.login-snip .sign-up:checked + .tab {
	border-color: #1161ee;
}

.login-space {
	min-height: 345px;
	position: relative;
	perspective: 1000px;
	transform-style: preserve-3d;
}

.login-space .group {
	margin-bottom: 15px;
}

.login-space .group .label,
.login-space .group .input,
.login-space .group .button {
	width: 100%;
	display: block;
}

.login-space .group .input,
.login-space .group .button {
	border: none;
	padding: 15px 20px;
	border-radius: 25px;

}

.login-space .group .button {
	 /* Verde similar al color Success de Bootstrap */
	color: white; /* Texto en blanco para contraste */
}

.login-space .group input[data-type="password"] {
	-text-security: circle;
	-webkit-text-security: circle;
}

.login-space .group .label {
	color: #000;
	font-size: 12px;
}

.login-space .group .button {
	background: #1161ee;
}

.login-space .group label .icon {
	width: 15px;
	height: 15px;
	border-radius: 2px;
	position: relative;
	display: inline-block;
	background: rgba(255, 255, 255, .1);
}

.login-space .group label .icon:before,
.login-space .group label .icon:after {
	content: '';
	width: 10px;
	height: 2px;
	background: #fff;
	position: absolute;
	transition: all .2s ease-in-out 0s;
}

.login-space .group label .icon:before {
	left: 3px;
	width: 5px;
	bottom: 6px;
	transform: scale(0) rotate(0);
}

.login-space .group label .icon:after {
	top: 6px;
	right: 0;
	transform: scale(0) rotate(0);
}

.login-space .group .check:checked + label .icon {
	background: #1161ee;
}

.login-space .group .check:checked + label .icon:before {
	transform: scale(1) rotate(45deg);
}

.login-space .group .check:checked + label .icon:after {
	transform: scale(1) rotate(-45deg);
}

.login-snip .sign-in:checked + .tab + .sign-up + .tab + .login-space .login {
	transform: rotate(0);
}

.login-snip .sign-up:checked + .tab + .login-space .sign-up-form {
	transform: rotate(0);
}

*,
:after,
:before {
	box-sizing: border-box;
}

.clearfix:after,
.clearfix:before {
	content: '';
	display: table;
}

.clearfix:after {
	clear: both;
	display: block;
}

a {
	color: inherit;
	text-decoration: none;
}

.hr {
	height: 2px;
	margin: 60px 0 50px 0;
	background: rgba(255, 255, 255, .2);
}

.foot {
	text-align: center;
}

::placeholder {
	color: #b3b3b3;
}

</style>

