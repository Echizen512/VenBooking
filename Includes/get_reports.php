<?php
session_start();
if (!isset($_SESSION['user_id'])) {
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
    .container {
        margin-top: 90px;
    }

    .btn {
        width: auto;
        margin: 0 auto;
        display: block;
    }
</style>

<body>
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-success">
                        <h3 class="text-center text-white"><i class="fas fa-file-pdf me-2 text-danger"></i>Generar
                            Reporte en PDF</h3>
                    </div>
                    <div class="card-body">
                        <form action="generate_pdf.php" method="post">
                            <div class="mb-3">
                                <label for="inns" class="form-label"><i class="fas fa-hotel me-2 text-info"></i>Seleccione las Posadas</label>
                                <select class="form-select" id="inns" name="inns[]" multiple>
                                    <?php
                                    include '../config/db.php';
                                    $user_id = $_SESSION['user_id'];
                                    $query = "SELECT id, name FROM inns WHERE user_id = ?";
                                    $stmt = $conn->prepare($query);
                                    $stmt->bind_param("i", $user_id);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='{$row['id']}'>{$row['name']}</option>";
                                        }
                                    } else {
                                        echo "<option disabled>No se encontraron posadas para este usuario.</option>";
                                    }
                                    $stmt->close();
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="reports" class="form-label"><i class="fas fa-file-pdf me-2 text-danger"></i>Seleccione los Reportes</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="reports[]" value="1"
                                        id="report1">
                                    <label class="form-check-label" for="report1">
                                        <i class="fas fa-file-pdf me-2 text-danger"></i> Reporte 1: Usuarios Registrados
                                        por Posada
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="reports[]" value="2"
                                        id="report2">
                                    <label class="form-check-label" for="report2">
                                        <i class="fas fa-file-pdf me-2 text-danger"></i> Reporte 2: Reservaciones por
                                        Posada
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="reports[]" value="3"
                                        id="report3">
                                    <label class="form-check-label" for="report3">
                                        <i class="fas fa-file-pdf me-2 text-danger"></i> Reporte 3: Métodos de Pago
                                        Registrados por Posada
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="reports[]" value="4"
                                        id="report4">
                                    <label class="form-check-label" for="report4">
                                        <i class="fas fa-file-pdf me-2 text-danger"></i> Reporte 4: Habitaciones
                                        Registradas por Posada
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="reports[]" value="5"
                                        id="report5">
                                    <label class="form-check-label" for="report5">
                                        <i class="fas fa-file-pdf me-2 text-danger"></i> Reporte 5: Vehículos
                                        Registrados por Posada
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