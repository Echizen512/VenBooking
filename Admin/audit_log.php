<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}
?>


<?php include './Includes/Dashboard.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auditoría</title>
    <link rel="stylesheet" href="./Assets/CSS/CRUD.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .card {
            width: 80%;
            margin-left: 200px; /* Mueve la tarjeta más a la derecha */
        }
        
        /* Agregar estilos CSS para hacer la tabla más pequeña y visible */
        .table {
            font-size: 0.9rem; /* Tamaño de fuente más pequeño */
        }

        .table th, .table td {
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
        <h2 class="card-title text-center"><i class="fas fa-file-alt"></i> Auditoría</h2>
            <div class="table-container">
                <table id="auditTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th><i class="fas fa-user"></i> ID del Usuario</th>
                            <th><i class="fas fa-table"></i> Nombre de la Tabla</th>
                            <th><i class="fas fa-cogs"></i> Acción</th>
                            <th><i class="fas fa-tag"></i> ID Afectado</th>
                            <th><i class="fas fa-calendar-alt"></i> Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include '../config/db.php';
                        $sql = "SELECT * FROM audit_log";
                        $result = $conn->query($sql);
                        while($row = $result->fetch_assoc()) {
                            // Formatear la fecha a día/mes/año
                            $formattedDate = date("d/m/Y", strtotime($row['action_timestamp']));
                            echo "<tr>
                                    <td>{$row['user_id']}</td>
                                    <td>{$row['table_name']}</td>
                                    <td>{$row['action']}</td>
                                    <td>{$row['affected_id']}</td>
                                    <td>{$formattedDate}</td>
                                </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    $('#auditTable').DataTable();
});
</script>
</body>
</html>
