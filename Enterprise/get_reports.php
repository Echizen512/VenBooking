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
        margin-right: 200px;
    }

    .card {
        border-radius: 50px;
    }

    .btn {
        width: auto;
        margin: 0 auto;
        display: block;
    }

    .card-header {
        border-top-left-radius: 50px;
        border-top-right-radius: 50px;
    }

    /* Animación para la carga de la página */
    @keyframes fadeIn {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    body {
        animation: fadeIn 2s ease-in-out;
    }


    .hidden {
        display: none;
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
                                <label for="inns" class="form-label"><i
                                        class="fas fa-hotel me-2 text-info"></i>Seleccione las Posadas</label>
                                <select class="form-select" id="inns" name="inns[]">
                                    <?php
                                    // Consulta para obtener las posadas
                                    include '../config/db.php';
                                    $user_id = $_SESSION['user_id'];
                                    $query = "SELECT id, name FROM inns WHERE user_id = ?";
                                    $stmt = $conn->prepare($query);
                                    $stmt->bind_param("i", $user_id);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='{$row['id']}'>{$row['name']}</option>";
                                    }
                                    $stmt->close();
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="reports" class="form-label"><i
                                        class="fas fa-file-pdf me-2 text-danger"></i>Seleccione los Reportes</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="reports[]" value="1"
                                        id="report1">
                                    <label class="form-check-label" for="report1">Reporte 1: Usuarios Registrados por
                                        Posada</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="reports[]" value="2"
                                        id="report2">
                                    <label class="form-check-label" for="report2">Reporte 2: Reservaciones por
                                        Posada</label>
                                </div>
                                <!-- Los demás reportes -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="reports[]" value="3"
                                        id="report3">
                                    <label class="form-check-label" for="report3">Reporte 3: Métodos de Pago Registrados
                                        por Posada</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="reports[]" value="4"
                                        id="report4">
                                    <label class="form-check-label" for="report4">Reporte 4: Habitaciones Registradas
                                        por Posada</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="reports[]" value="5"
                                        id="report5">
                                    <label class="form-check-label" for="report5">Reporte 5: Vehículos Registrados por
                                        Posada</label>
                                </div>
                            </div>

                            <!-- Filtro de Fechas solo para el reporte de Reservaciones -->
                            <div class="mb-3" id="dateFilter" style="display: none;">
                                <label for="start_date" class="form-label"><i
                                        class="fas fa-calendar-alt me-2 text-info"></i>Fecha de Inicio</label>
                                <input type="date" class="form-control" id="start_date" name="start_date">
                            </div>
                            <div class="mb-3" id="dateFilterEnd" style="display: none;">
                                <label for="end_date" class="form-label"><i
                                        class="fas fa-calendar-alt me-2 text-info"></i>Fecha de Fin</label>
                                <input type="date" class="form-control" id="end_date" name="end_date">
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

<script>
    // Mostrar el filtro de fechas solo si el reporte 2 (reservaciones) está seleccionado
    document.querySelectorAll('input[name="reports[]"]').forEach((checkbox) => {
        checkbox.addEventListener('change', function () {
            const dateFilter = document.getElementById('dateFilter');
            const dateFilterEnd = document.getElementById('dateFilterEnd');
            if (document.getElementById('report2').checked) {
                dateFilter.style.display = 'block';
                dateFilterEnd.style.display = 'block';
            } else {
                dateFilter.style.display = 'none';
                dateFilterEnd.style.display = 'none';
            }
        });
    });
</script>

</html>