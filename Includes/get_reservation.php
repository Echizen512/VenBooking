<?php
include '../config/db.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT reservations.id, reservations.inn_id, reservations.start_date, reservations.end_date,
               reservations.payment_method_id, reservations.receipt_path, reservations.codigo_referencia, 
               reservations.status, reservations.user_id, reservations.monto_total,
               profile.first_name AS user_name, profile.email AS user_email, inns.name AS inn_name 
        FROM reservations
        LEFT JOIN profile ON reservations.user_id = profile.id
        LEFT JOIN inns ON reservations.inn_id = inns.id
        WHERE inns.user_id = ?";

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die('Error al preparar la consulta: ' . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();

$result = $stmt->get_result();

if ($result === false) {
    die('Error al ejecutar la consulta: ' . $conn->error);
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Reservaciones</title>
    <link href="../Assets/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="../Assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>

<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f8f9fa;
    }

    .card {
        border-radius: 8px;
        overflow: hidden;
    }

    .card-title {
        font-size: 2.5rem;
        font-weight: bold;
        color: #343a40;
    }

    .table {
        border-radius: 8px;
        overflow: hidden;
    }

    .table thead th {
        background-color: #343a40;
        color: white;
        font-size: 1.5rem;
    }

    .table td {
        vertical-align: middle;
        font-size: 1.2rem;
    }

    .alert {
        border-radius: 5px;
        background-color: #fff3cd;
        color: #856404;
        font-weight: bold;
        font-size: 1.2rem;
    }

    .mb-3 {
        margin-bottom: 1.5rem !important;
    }

    .text-center {
        text-align: center;
    }

    .gap-2 {
        gap: 0.5rem;
    }

    html,
    body {
        height: 100%;
        margin: 0;
    }

    body {
        display: flex;
        flex-direction: column;
    }

    .container {
        flex: 1;
    }

    .page-footer {
        background-color: #28a745;
        color: white;
        text-align: center;
        padding: 10px 0;
    }
</style>

<body>
    <?php include './Header_Admin.php'; ?>
    <div class="container mt-5">
        <div class="card custom-card">
            <div class="card-body">
                <h2 class="card-title"><i class="fas fa-calendar-check"></i> Lista de Reservaciones</h2>
                <div class="table-responsive">
                    <table id="reservationsTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center"><i class="fas fa-user"></i> Cliente</th>
                                <th class="text-center"><i class="fas fa-envelope"></i> Correo</th>
                                <th class="text-center"><i class="fas fa-building"></i> Posada</th>
                                <th class="text-center"><i class="fas fa-calendar-alt"></i> Fecha de Reservación</th>
                                <th class="text-center"><i class="fas fa-money-bill"></i> Monto Total</th>
                                <th class="text-center"><i class="fas fa-info-circle"></i> Estado</th>
                                <th class="text-center"><i class="fas fa-file-alt"></i> Referencia</th>
                                <th class="text-center"><i class="fas fa-file-alt"></i> Contacto</th>
                                <th class="text-center"><i class="fas fa-cogs"></i> Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {

                                    $startDateFormatted = date("d, m, Y", strtotime($row['start_date']));
                                    $endDateFormatted = date("d, m, Y", strtotime($row['end_date']));

                                    $statusColor = 'blue';
                                    if ($row['status'] === 'Confirmado') {
                                        $statusColor = 'green';
                                    } elseif ($row['status'] === 'Cancelado') {
                                        $statusColor = 'red';
                                    }

                                    echo "<tr>
                                        <td class='text-center'>{$row['user_name']}</td>
                                        <td class='text-center'>{$row['user_email']}</td>
                                        <td class='text-center'>{$row['inn_name']}</td>
                                        <td class='text-center'>{$startDateFormatted} - {$endDateFormatted}</td>
                                        <td class='text-center'>{$row['monto_total']}</td>
                                        <td style='color: {$statusColor};'>{$row['status']}</td>
                                        <td class='text-center'>{$row['codigo_referencia']}</td>
                                        <td class='text-center'>
                                        <a href='../chat.php?user_id={$row['user_id']}' class='btn btn-primary' style='color: white;'>Contactar</a></td>
                                        <td class='text-center'>
                                            <div class='text-center'>
                                            <form action='update_reservation_status.php' method='POST' class='d-inline'>
                                                <input type='hidden' name='id' value='{$row['id']}' />
                                                <button type='submit' name='action' value='confirm' style='border: none; background-color: #28a745; color: white; width: 30px; height: 30px; display: inline-flex; align-items: center; justify-content: center; border-radius: 4px; margin-right: 5px;'>
                                                    <i class='fas fa-check'></i>
                                                </button>
                                            </form>
                                            <form action='update_reservation_status.php' method='POST' class='d-inline'>
                                                <input type='hidden' name='id' value='{$row['id']}' />
                                                <button type='submit' name='action' value='cancel' style='border: none; background-color: #dc3545; color: white; width: 30px; height: 30px; display: inline-flex; align-items: center; justify-content: center; border-radius: 4px;'>
                                                    <i class='fas fa-times'></i>
                                                </button>
                                            </form>
                                            </div>
                                        </td>
                                    </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='8'>No se encontraron reservaciones</td></tr>";
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php include './Footer.php'; ?>

    <script src="../Assets/js/jquery-3.6.0.min.js"></script>
    <script src="../Assets/js/jquery.dataTables.min.js"></script>
    <script src="../Assets/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#reservationsTable').DataTable({
                "paging": true,
                "lengthMenu": [5, 10, 20],
                "searching": true,
                "ordering": true,
                "info": true,
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    "search": "Buscar:",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });
        });
    </script>
</body>

</html>