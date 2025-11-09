

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

<div class="row">
        <div class="col-md-6 mx-auto p-4">
            <div class="login-box">
                <div class="login-snip">
                    <input id="tab-3" type="radio" name="tab" class="recover-password" checked>
                    <label for="tab-3" class="tab"><i class="fas fa-key"></i> Recuperar Contraseña</label>
                    <div class="login-space">
                        <div class="recover">
                            <form id="recoverForm">
                                <div class="group">
                                    <label for="email" class="label"><i class="fas fa-envelope"></i> Correo Electrónico</label>
                                    <input id="email" name="email" type="email" class="input" placeholder="Ingresa tu correo registrado" required>
                                </div> <br>
                                <div class="group">
                                    <button type="button" class="button" id="recoverButton" style="background:rgb(10, 84, 241);">Verificar Correo</button>
                                </div>
                                <div class="hr"></div>
                                <div class="foot">
                                    <a href="./login.php"><i class="fas fa-sign-in-alt"></i> Regresar al Inicio de Sesión</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
       $('#recoverButton').on('click', function () {
    const email = $('#email').val();

    $.ajax({
        url: './PHP/password.php',
        method: 'POST',
        data: { recover: true, email: email },
        dataType: 'json',
        success: function (response) {
            if (response.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Correo Verificado',
                    text: response.message,
                    input: 'password',
                    inputAttributes: {
                        placeholder: 'Nueva contraseña',
                        minlength: 6,
                        required: true,
                    },
                    confirmButtonText: 'Actualizar Contraseña',
                    showCancelButton: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/PHP/password.php',
                            method: 'POST',
                            data: { new_password: result.value, user_id: response.user_id },
                            dataType: 'json',
                            success: function (updateResponse) {
                                if (updateResponse.status === 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Listo',
                                        text: updateResponse.message
                                    }).then(() => {
                                        window.location.href = updateResponse.redirect;
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: updateResponse.message
                                    });
                                }
                            }
                        });
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message
                });
            }
        }
    });
});

    </script>
</body>