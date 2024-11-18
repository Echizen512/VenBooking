<?php 
// Incluye el archivo de cabecera


// Inicia la sesión si no se ha iniciado
session_start();

// Verifica si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    // Si el usuario no está logueado, redirigir o mostrar un mensaje de error
    die("Acceso denegado. Inicia sesión.");

    
}

include('Header_Admin.php'); 

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Reporte</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<style>
    /* Aumenta el margen superior para mover el formulario más hacia abajo */
    .container {
        margin-top: 80px; /* Aumenta el margen superior */
    }

    /* Ajustes adicionales para el botón */
    .btn {
        width: auto; /* Hace que el botón no ocupe todo el ancho */
        margin: 0 auto; /* Centra el botón */
        display: block; /* Hace que el botón se comporte como un bloque */
    }
</style>

<body>
    <div class="container">
        <!-- Espacio considerable para el dashboard -->
        <div class="row justify-content-end">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header">
                        <h3 class="text-center">Generar Reporte de Reservas y Posadas</h3>
                    </div>
                    <div class="card-body">
                        <form action="generate_pdf.php" method="post">
                            <div class="mb-3">
                                <label for="inns" class="form-label">Seleccione las Posadas</label>
                                <select class="form-select" id="inns" name="inns[]" multiple>
                                    <?php
                                    // Conexión a la base de datos
                                    include '../config/db.php';

                                    // Obtiene el user_id de la sesión
                                    $user_id = $_SESSION['user_id'];

                                    // Consulta SQL para obtener las posadas del usuario logueado
                                    $query = "SELECT id, name FROM inns WHERE user_id = ?";
                                    $stmt = $conn->prepare($query);
                                    $stmt->bind_param("i", $user_id);  // Vincula el user_id al parámetro de la consulta
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    // Verifica si hay posadas disponibles para este usuario
                                    if ($result->num_rows > 0) {
                                        // Muestra las posadas en el select
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='{$row['id']}'>{$row['name']}</option>";
                                        }
                                    } else {
                                        echo "<option disabled>No se encontraron posadas para este usuario.</option>";
                                    }

                                    // Cierra la conexión
                                    $stmt->close();
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="reports" class="form-label">Seleccione los Reportes</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="reports[]" value="1" id="report1">
                                    <label class="form-check-label" for="report1">
                                        Reporte 1: Usuarios Registrados por Posada
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="reports[]" value="2" id="report2">
                                    <label class="form-check-label" for="report2">
                                        Reporte 2: Reservaciones por Posada
                                    </label>
                                </div>
                            </div>
                            <button type="submit" name="generate_pdf" class="btn btn-success">
                                <i class="fas fa-download"></i> Generar Reporte
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
