<?php
include '../config/db.php';
include './Includes/Dashboard.php';

$sql_inns = "SELECT id, name FROM inns";
$inns_result = $conn->query($sql_inns);

$inns_options = '<option disabled selected>Seleccionar Posada</option>'; 
if ($inns_result) {
    while ($row = $inns_result->fetch_assoc()) {
        $inns_options .= '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
    }
} else {
    die('Error al ejecutar la consulta de posadas: ' . $conn->error);
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VenBooking</title>
    <link href="../Assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Assets/css/CRUD.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> <!-- Font Awesome -->
    <style>
        body {
            background-color: #f7f9fc;
        }
        .card {
            margin: 50px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            background-color: #fff;
        }
        .card h2 {
            font-size: 16px;
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: 600;
            color: #495057;
        }
        .form-control {
            height: auto;
        }
        .form-group i {
            margin-right: 10px;
        }
        .btn {
            display: inline-flex;
            align-items: center;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="card">
        <h2><i class="fas fa-file-alt text-danger"></i> Generar Reportes</h2>
        <form action="./php/generate_report.php" method="POST">
            <div class="form-group">
                <label for="inns" style="font-size: 14px;"><i class="fas fa-hotel text-info"></i> Seleccionar Posada:</label>
                <select name="inns[]" id="inns" class="form-control" multiple>
                    <?php echo $inns_options; ?>
                </select>
            </div>
            <br>
            <div class="form-group">
                <label for="reports" style="font-size: 14px;"><i class="fas fa-chart-bar text-success"></i> Seleccionar Reporte:</label>
                <select name="reports[]" id="reports" class="form-control" multiple>
                    <option value="1">Usuarios Registrados por Posada</option>
                    <option value="2">Reservaciones por Posada</option>
                </select>
            </div>
            <br>
            <div class="text-center">
                <button type="submit" name="generate_pdf" class="btn btn-success">
                    Generar PDF
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
