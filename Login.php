<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
include './config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Iniciar sesión
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT id, password, profile_type, block FROM Profile WHERE email = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id, $hashed_password, $profile_type, $block);
                $stmt->fetch();
                if ($block == 1) {
                    echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Usuario Bloqueado',
                                text: 'Tu cuenta ha sido bloqueada. No puedes iniciar sesión.'
                            });
                        });
                    </script>";
                } else {
                    if (password_verify($password, $hashed_password)) {
                        session_start();
                        $_SESSION["user_id"] = $id;

                        $redirect_url = ($profile_type === "Empresa") ? 'Includes/Inicio.php' : 'Inns.php';

                        echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Inicio de Sesión Exitoso'
                                }).then(function() {
                                    window.location = '$redirect_url';
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


    if (isset($_POST['register'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $profile_type = $_POST['profile_type'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $check_email_sql = "SELECT id FROM Profile WHERE email = ?";
        if ($stmt = $conn->prepare($check_email_sql)) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Correo Duplicado',
                            text: 'El correo electrónico ya está registrado. Intenta con otro correo.'
                        });
                    });
                </script>";
            } else {

                $insert_sql = "INSERT INTO Profile (first_name, last_name, email, profile_type, password, registration_date) 
                               VALUES (?, ?, ?, ?, ?, NOW())";

                if ($insert_stmt = $conn->prepare($insert_sql)) {
                    $insert_stmt->bind_param("sssss", $first_name, $last_name, $email, $profile_type, $password);
                    if ($insert_stmt->execute()) {
                        echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Registro Exitoso',
                                    text: 'Tu cuenta ha sido creada con éxito. Ahora puedes iniciar sesión.'
                                });
                            });
                        </script>";
                    } else {
                        echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error en el Registro',
                                    text: 'Ocurrió un problema al registrar tu cuenta. Intenta de nuevo más tarde.'
                                });
                            });
                        </script>";
                    }
                    $insert_stmt->close();
                } else {
                    echo "Error: " . $conn->error;
                }
            }
            $stmt->close();
        } else {
            echo "Error: " . $conn->error;
        }
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="./Assets/css/Register.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/tippy.js@6/dist/tippy.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>


    <style>
        .tippy-box[data-theme='custom'] {
            background-color:rgb(25, 135, 84);
            color: white;
            border-radius: 10px;
            font-size: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            padding: 8px;
        }

        .tippy-box[data-theme='custom'][data-placement^='bottom'] {
            transform-origin: top;
        }
    </style>

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
                                    <label for="user" class="label"><i class="fas fa-envelope"></i> Correo
                                        Electrónico</label>
                                    <input id="user" name="email" type="text" class="input"
                                        placeholder="Ingresa tu correo electrónico" required>
                                </div>
                                <div class="group">
                                    <label for="pass" class="label"><i class="fas fa-lock"></i> Contraseña</label>
                                    <input id="pass" name="password" type="password" class="input"
                                        placeholder="Ingresa tu contraseña" required>
                                </div>
                                <div class="group">
                                    <input id="check" type="checkbox" class="check" checked>
                                </div> <br>
                                <div class="group">
                                    <input type="submit" name="login" class="button" style="background: #28a745;"
                                        value="Iniciar Sesión">
                                </div>
                                <div class="hr"></div>
                                <div class="foot">
                                    <a href="./password.php"><i class="fas fa-unlock-alt"></i> ¿Olvidaste tu contraseña?</a>
                                </div>
                            </form>
                        </div>
                        <div class="sign-up-form">
                            <form method="POST" action="">
                                <div class="group">
                                    <label for="first_name" class="label"><i class="fas fa-user"></i> Nombre</label>
                                    <input id="first_name" name="first_name" type="text" class="input"
                                        placeholder="Ingresa tu nombre" required pattern="^[A-Za-záéíóúÁÉÍÓÚüÜñÑ\s]+$"
                                        title="El nombre solo puede contener letras (mayúsculas, minúsculas), espacios y acentos.">
                                </div>
                                <div class="group">
                                    <label for="last_name" class="label"><i class="fas fa-user"></i> Apellido</label>
                                    <input id="last_name" name="last_name" type="text" class="input"
                                        placeholder="Ingresa tu apellido" required pattern="^[A-Za-záéíóúÁÉÍÓÚüÜñÑ\s]+$"
                                        title="El apellido solo puede contener letras (mayúsculas, minúsculas), espacios y acentos.">
                                </div>
                                <div class="group">
                                    <label for="email" class="label"><i class="fas fa-envelope"></i> Correo
                                        Electrónico</label>
                                    <input id="email" name="email" type="email" class="input"
                                        placeholder="Ingresa tu correo electrónico" required
                                        pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
                                        title="Por favor, ingresa un correo electrónico válido (ejemplo@dominio.com)">
                                </div>
                                <div class="group">
                                    <label for="profile_type" class="label"><i class="fas fa-user-tag"></i> Tipo de
                                        Perfil</label>
                                    <select name="profile_type" id="profile_type" class="input"
                                        style="padding-left: 2.7rem;" required>
                                        <option value="" disabled selected>Seleccionar Tipo</option>
                                        <option value="Turista">Turista</option>
                                        <option value="Empresa">Empresa</option>
                                    </select>
                                </div>
                                <div class="group" id="password-group">
                                    <label for="pass" class="label"><i class="fas fa-lock"></i> Contraseña.</label>
                                    <input id="pass" name="password" type="password" class="input"
                                        placeholder="Crea tu contraseña"
                                        title="Debe contener mínimo seis caracteres. Entre ellos mayúsculas, minúsculas y números"
                                        required>
                                </div> <br>
                                <div class="group">
                                    <input type="submit" name="register" class="button" style="background: #28a745;"
                                        value="Registrarse">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        // Tooltip para "Nombre"
tippy('#first_name', {
    content: 'El nombre solo puede contener letras (mayúsculas, minúsculas), espacios y acentos.',
    animation: 'scale',
    theme: 'custom',
    placement: 'right',
});

// Tooltip para "Apellido"
tippy('#last_name', {
    content: 'El apellido solo puede contener letras (mayúsculas, minúsculas), espacios y acentos.',
    animation: 'scale',
    theme: 'custom',
    placement: 'right',
});

// Tooltip para "Correo Electrónico"
tippy('#email', {
    content: 'Por favor, ingresa un correo electrónico válido (ejemplo@dominio.com).',
    animation: 'scale',
    theme: 'custom',
    placement: 'right',
});

// Tooltip para "Tipo de Perfil"
tippy('#profile_type', {
    content: 'Selecciona el tipo de perfil que más te identifique.',
    animation: 'scale',
    theme: 'custom',
    placement: 'right',
});

// Tooltip para "Contraseña"
tippy('#password-group', {
    content: 'Debe contener mínimo seis caracteres, incluyendo mayúsculas, minúsculas y números.',
    animation: 'scale',
    theme: 'custom',
    placement: 'right',
});

    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const inputs = document.querySelectorAll('input');

            inputs.forEach(input => {
                input.addEventListener('input', () => {
                    if (input.checkValidity()) {
                        input.classList.remove('invalid');
                        input.classList.add('valid');
                    } else {
                        input.classList.remove('valid');
                        input.classList.add('invalid');
                    }
                });
                input.addEventListener('blur', () => {
                    if (input.checkValidity()) {
                        input.classList.add('valid');
                    } else {
                        input.classList.add('invalid');
                    }
                });
            });
        });
    </script>
</body>

</html>