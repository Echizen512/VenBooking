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
    <title>VenBooking</title>
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
    <div class="container py-5">
        <div class="row justify-content-end">
            <div class="col-md-8">
                <div class="card border-0 shadow"
                    style="background: linear-gradient(145deg, #d4f9d1, #f0fff0); border-radius: 1rem;">
                    <div class="card-header text-center text-white"
                        style="background: linear-gradient(135deg, #059669 0%, #10b981 100%);  border-top-left-radius: 1rem; border-top-right-radius: 1rem;">
                        <h3 class="mb-0"><i class="fas fa-file-alt me-2"></i>Generador de Reportes PDF</h3>
                    </div>
                    <div class="card-body p-4">
                        <form action="../Assets/PDF/Reports.php" method="post">
                            <div class="mb-4">
                                <label for="inns" class="form-label"><i
                                        class="fas fa-hotel me-2 text-secondary"></i>Selecciona la Posada</label>
                                <select class="form-select" id="inns" name="inns[]">
                                    <?php
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

                            <div class="mb-4">
                                <label class="form-label"><i class="fas fa-list-alt me-2 text-primary"></i>Selecciona
                                    los Reportes</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="reports[]" value="1"
                                                id="report1">
                                            <label class="form-check-label" for="report1">Usuarios Registrados</label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="reports[]" value="2"
                                                id="report2">
                                            <label class="form-check-label" for="report2">Reservaciones</label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="reports[]" value="3"
                                                id="report3">
                                            <label class="form-check-label" for="report3">Métodos de Pago</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="reports[]" value="4"
                                                id="report4">
                                            <label class="form-check-label" for="report4">Habitaciones</label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="reports[]" value="5"
                                                id="report5">
                                            <label class="form-check-label" for="report5">Vehículos</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4" id="dateFilter" style="display: none;">
                                <label for="start_date" class="form-label"><i
                                        class="fas fa-calendar-day me-2 text-info"></i>Fecha de Inicio</label>
                                <input type="date" class="form-control shadow-sm" id="start_date" name="start_date">
                            </div>

                            <div class="mb-4" id="dateFilterEnd" style="display: none;">
                                <label for="end_date" class="form-label"><i
                                        class="fas fa-calendar-check me-2 text-info"></i>Fecha de Fin</label>
                                <input type="date" class="form-control shadow-sm" id="end_date" name="end_date">
                            </div>

                            <div class="text-center">
                                <button type="submit" name="generate_pdf" class="btn btn-lg text-white"
                                    style="background: linear-gradient(135deg, #059669 0%, #10b981 100%);  border-radius: 2rem;">
                                    <i class="fas fa-download me-1"></i> Generar Reporte
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", () => {
        const reservacionesCheckbox = document.getElementById('report2');
        const dateFilter = document.getElementById('dateFilter');
        const dateFilterEnd = document.getElementById('dateFilterEnd');

        function toggleDateFilters() {
            const show = reservacionesCheckbox.checked;
            dateFilter.style.display = show ? 'block' : 'none';
            dateFilterEnd.style.display = show ? 'block' : 'none';
        }

        reservacionesCheckbox.addEventListener('change', toggleDateFilters);
        toggleDateFilters(); // init state
    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>

<script>
// Mostrar el filtro de fechas solo si el reporte 2 (reservaciones) está seleccionado
document.querySelectorAll('input[name="reports[]"]').forEach((checkbox) => {
    checkbox.addEventListener('change', function() {
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