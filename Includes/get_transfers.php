<?php
include '../config/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $account_number = $_POST['account_number'];
    $bank_code = $_POST['bank_code'];
    $amount = $_POST['amount'];
    $inn_id = $_POST['inn_id'];

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $stmt = $conn->prepare("UPDATE bank_transfer_info SET full_name = ?, account_number = ?, bank_code = ?, amount = ?, inn_id = ? WHERE id = ?");
        $stmt->bind_param("sssiii", $full_name, $account_number, $bank_code, $amount, $inn_id, $id);
        if ($stmt->execute()) {
            $message = "Transferencia bancaria actualizada correctamente.";
        } else {
            $message = "Error al actualizar la transferencia bancaria.";
        }
    } else {
        $stmt = $conn->prepare("INSERT INTO bank_transfer_info (full_name, account_number, bank_code, amount, inn_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssii", $full_name, $account_number, $bank_code, $amount, $inn_id);
        if ($stmt->execute()) {
            $message = "Transferencia agregada correctamente.";
        } else {
            $message = "Error al agregar la transferencia bancaria.";
        }
    }
    $stmt->close();
    $conn->close();
    echo "<script>
            Swal.fire({
                title: 'Información',
                text: '$message',
                icon: 'info',
                confirmButtonText: 'Aceptar'
            }).then(() => {
                window.location.href = 'get_transfers.php';
            });
          </script>";
    exit();
}

$sql = "SELECT bank_transfer_info.id, bank_transfer_info.full_name, bank_transfer_info.account_number, 
               bank_transfer_info.bank_code, bank_transfer_info.amount, inns.name AS inn_name
        FROM bank_transfer_info
        LEFT JOIN inns ON bank_transfer_info.inn_id = inns.id
        WHERE inns.user_id = ?";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error en la consulta SQL: " . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Transferencias Bancarias</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Assets/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<?php include './Header_Admin.php'; ?>


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

html, body {
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

<div class="container mt-5">
    <div class="card custom-card">
        <div class="card-body">
            <h2 class="card-title"><i class="fas fa-money-check-alt"></i> Lista de Transferencias Bancarias</h2>
            <div class="table-responsive">
                <div class="text-right mb-3">
                <button class="btn btn-success btn-sm d-inline-flex align-items-center" style="font-size: 14px;" data-bs-toggle="modal" data-bs-target="#modalTransfer">Agregar Transferencia</button>
                </div>
                <table id="transfersTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Nombre Completo</th>
                            <th class="text-center">Número de Cuenta</th>
                            <th class="text-center">Código Bancario</th>
                            <th class="text-center">Posada</th>
                            <th class="text-center">Monto</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td class="text-center"><?php echo $row['full_name']; ?></td>
                            <td class="text-center"><?php echo $row['account_number']; ?></td>
                            <td class="text-center"><?php echo $row['bank_code']; ?></td>
                            <td class="text-center"><?php echo $row['inn_name']; ?></td>
                            <td class="text-center"><?php echo $row['amount']; ?></td>
                            <td class="text-center">
                                <button class="btn btn-primary" onclick="editTransfer(<?php echo $row['id']; ?>)">Editar</button>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Agregar/Actualizar Transferencia -->
<div class="modal fade" id="modalTransfer" tabindex="-1" aria-labelledby="modalTransferLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTransferLabel">Agregar Transferencia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="transferForm" method="POST">
                    <input type="hidden" name="id" id="transferId">
                    <div class="form-group">
                        <label for="full_name">Nombre Completo</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" required>
                    </div>
                    <div class="form-group">
                        <label for="account_number">Número de Cuenta</label>
                        <input type="text" class="form-control" id="account_number" name="account_number" required>
                    </div>
                    <div class="form-group">
                        <label for="bank_code">Código Bancario</label>
                        <input type="text" class="form-control" id="bank_code" name="bank_code" required>
                    </div>
                    <div class="form-group">
                        <label for="amount">Monto</label>
                        <input type="number" class="form-control" id="amount" name="amount" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="inn_id">Posada</label>
                        <select class="form-control" id="inn_id" name="inn_id" required>
                            <option value="">Seleccionar Posada</option>
                            <?php
                            $sql_inns = "SELECT id, name FROM inns";
                            $result_inns = $conn->query($sql_inns);
                            while ($row_inn = $result_inns->fetch_assoc()) {
                                echo "<option value='{$row_inn['id']}'>{$row_inn['name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<footer class="page-footer bg-success">
    <div class="footer-last-section bg-success">
        <div class="container">
            <p>Copyright 2024 &copy; VenBooking</p>
        </div>
    </div>
</footer>

<script src="../Assets/js/bootstrap.bundle.min.js"></script>
<script src="../Assets/js/jquery-3.6.0.min.js"></script>
<script src="../Assets/js/jquery.dataTables.min.js"></script>
<script src="../Assets/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {
    $('#transfersTable').DataTable();

    // Limpiar formulario cuando se abre el modal
    $('#modalTransfer').on('show.bs.modal', function (e) {
        $('#transferForm')[0].reset();
        $('#transferId').val('');
    });
});

function editTransfer(id) {
    $.get('get_transfer.php', { id: id }, function (data) {
        var transfer = JSON.parse(data);
        $('#transferId').val(transfer.id);
        $('#full_name').val(transfer.full_name);
        $('#account_number').val(transfer.account_number);
        $('#bank_code').val(transfer.bank_code);
        $('#amount').val(transfer.amount);
        $('#inn_id').val(transfer.inn_id);
        $('#modalTransferLabel').text('Actualizar Transferencia');
        $('#modalTransfer').modal('show');
    });
}
</script>

</body>
</html>
