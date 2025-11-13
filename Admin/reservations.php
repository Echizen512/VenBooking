<?php
session_start();
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
    <title>VenBooking</title>
    <link rel="stylesheet" href="./Assets/CSS/audit_log.css">
    <link rel="stylesheet" href="./Assets/CSS/CRUD.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-center"><i class="fas fa-calendar-check"></i> Reservaciones</h2>
                <div class="table-container">
                    <table id="reservationsTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th><i class="fas fa-id-badge text-primary"></i> ID</th>
                                <th><i class="fas fa-home text-info"></i> ID Posada</th>
                                <th><i class="fas fa-calendar-alt text-success"></i> Fecha de Inicio</th>
                                <th><i class="fas fa-calendar-day text-warning"></i> Fecha de Fin</th>
                                <th><i class="fas fa-credit-card text-primary"></i> Método de Pago</th>
                                <th><i class="fas fa-code text-secondary"></i> Código de Referencia</th>
                                <th><i class="fas fa-user text-success"></i> ID Usuario</th>
                                <th><i class="fas fa-door-open text-primary"></i> ID Habitación</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        include '../config/db.php';
                        $sql = "SELECT id, inn_id, start_date, end_date, payment_method_id, receipt_path, codigo_referencia, status, user_id, room_id, monto_total FROM reservations";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            $formattedStartDate = date("d/m/Y", strtotime($row['start_date']));
                            $formattedEndDate = date("d/m/Y", strtotime($row['end_date']));
                            $statusText = $row['status'] == 1 ? 'Activo' : 'Inactivo';

                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['inn_id']}</td>
                                    <td>{$formattedStartDate}</td>
                                    <td>{$formattedEndDate}</td>
                                    <td>{$row['payment_method_id']}</td>
                                    
                                    <td>{$row['codigo_referencia']}</td>

                                    <td>{$row['user_id']}</td>
                                    <td>{$row['room_id']}</td>
   
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
        $('#reservationsTable').DataTable();
    });
    </script>
</body>

</html>