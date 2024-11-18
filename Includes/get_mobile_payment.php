<?php
include '../config/db.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Lógica para Crear Pago Móvil
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'create') {
    $inn_id = $_POST['inn_id'];
    $cedula = $_POST['cedula'];
    $bank_code = $_POST['bank_code'];
    $phone_number = $_POST['phone_number'];

    $check_sql = "SELECT * FROM mobile_payment_info WHERE inn_id = ?";
    $stmt_check = $conn->prepare($check_sql);
    $stmt_check->bind_param("i", $inn_id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        $message = "Ya existe un pago móvil registrado para esta posada.";
    } else {
        $sql = "INSERT INTO mobile_payment_info (inn_id, cedula, bank_code, phone_number) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isss", $inn_id, $cedula, $bank_code, $phone_number);

        if ($stmt->execute()) {
            $message = "Pago móvil agregado exitosamente.";
        } else {
            $message = "Error al agregar el pago móvil: " . $conn->error;
        }
    }
}

// Lógica para Actualizar Pago Móvil
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'update') {
    $id = $_POST['id'];
    $cedula = $_POST['cedula'];
    $bank_code = $_POST['bank_code'];
    $phone_number = $_POST['phone_number'];

    $sql = "UPDATE mobile_payment_info SET cedula = ?, bank_code = ?, phone_number = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $cedula, $bank_code, $phone_number, $id);

    if ($stmt->execute()) {
        $message = "Pago móvil actualizado exitosamente.";
    } else {
        $message = "Error al actualizar el pago móvil: " . $conn->error;
    }
}

$sql = "SELECT mobile_payment_info.id, mobile_payment_info.cedula, mobile_payment_info.bank_code, mobile_payment_info.phone_number, inns.name AS inn_name 
        FROM mobile_payment_info
        LEFT JOIN inns ON mobile_payment_info.inn_id = inns.id
        WHERE inns.user_id = ?";

$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die('Error al preparar la consulta: ' . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagos Móviles</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="../Assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>


    <?php include './Header_Admin.php'; ?>


<style>
    body, html {
    height: 100%;
    margin: 0;
    display: flex;
    flex-direction: column;
}

.content-wrapper {
    flex: 1;
    display: flex;
    flex-direction: column;
    padding-bottom: 50px; 
}

footer {
    padding: 10px 0;
    width: 100%;
    background-color: #f8f9fa;
    text-align: center;
    margin-top: auto;
    position: relative; 
    bottom: 0;
}

.table-responsive {
    max-height: 400px; 
    overflow-y: auto;
}

.custom-card {
    border: 1px solid rgba(0, 0, 0, 0.125);
    border-radius: 8px;
    box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
}

.custom-btn {
    color: #fff;
    background-color: rgb(63, 161, 65 / 94%);
    border-color: rgb(63, 161, 65 / 94%);
}

.custom-btn:hover {
    background-color: #4caf50;
    border-color: #4caf50;
}

.container {
    padding-top: 20px;
    padding-left: 15%;
    padding-right: 15px;
}

@media (min-width: 768px) {
    .container {
        max-width: 100%;
        margin-left: auto;
        margin-right: auto;
    }
}

h2.card-title {
    font-size: 2.2rem;
    font-weight: bold;
    color: #3fa141;
    text-align: center;
    margin-bottom: 20px;
}

.table th, .table td {
    vertical-align: middle;
    text-align: center;
}

.table th {
    background-color: #f8f9fa;
    font-weight: bold;
}

@media (max-width: 768px) {
    .table-responsive {
        overflow-x: auto;
    }
    .table th, .table td {
        font-size: 0.875rem;
    }
}

.table th i {
    margin-right: 5px;
}

.btn-warning {
    color: #fff;
    background-color: #ffc107;
    border-color: #ffc107;
}

.btn-warning:hover {
    color: #212529;
    background-color: #e0a800;
    border-color: #d39e00;
}

    </style>

    <div class="container mt-5">
        <div class="card custom-card">
            <div class="card-body">
                <h2 class="card-title"><i class="fas fa-mobile-alt"></i> Lista de Pagos Móviles</h2>
                <div class="table-responsive">
                    <div class="mb-3" style="text-align: right;">
                        <button class='btn btn-success btn-sm d-inline-flex align-items-center' data-bs-toggle="modal"
                            data-bs-target="#createModal" style="color: white; font-size: 14px;"
                            title='Agregar Pago Móvil'>
                            <i class='fas fa-plus mr-2' style='color: white;'></i> Agregar
                        </button>
                    </div>
                    <table id="paymentsTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Cédula</th>
                                <th class="text-center">Código Bancario</th>
                                <th class="text-center">Número de Teléfono</th>
                                <th class="text-center">Posada</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                    <td class='text-center'>{$row['cedula']}</td>
                                    <td class='text-center'>{$row['bank_code']}</td>
                                    <td class='text-center'>{$row['phone_number']}</td>
                                    <td class='text-center'>{$row['inn_name']}</td>
                                    <td class='text-center'>
                                        <button class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#editModal' data-id='{$row['id']}' data-cedula='{$row['cedula']}' data-bank-code='{$row['bank_code']}' data-phone-number='{$row['phone_number']}' style='width: 20px; height: 20px; padding: 0; text-align: center; display: inline-flex; align-items: center; justify-content: center; font-size: 10px; color: white;'>
                                            <i class='fas fa-edit'></i>
                                        </button>
                                    </td>
                                </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>No hay pagos móviles registrados.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <br> <br>
    <!-- Modal para Agregar Pago Móvil -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title" id="createModalLabel" style="color: white;">Agregar Pago Móvil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createForm" method="POST">
                        <input type="hidden" name="action" value="create">
                        <div class="form-group">
                            <label for="inn_id">Posada</label>
                            <select name="inn_id" id="inn_id" class="form-control" required>
                                <?php
                                $sql_inns = "SELECT id, name FROM inns WHERE user_id = ?";
                                $stmt_inns = $conn->prepare($sql_inns);
                                $stmt_inns->bind_param("i", $user_id);
                                $stmt_inns->execute();
                                $result_inns = $stmt_inns->get_result();

                                while ($row_inn = $result_inns->fetch_assoc()) {
                                    echo "<option value='{$row_inn['id']}'>{$row_inn['name']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cedula">Cédula</label>
                            <input type="number" name="cedula" id="cedula" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="bank_code">Código Bancario</label>
                            <input type="number" name="bank_code" id="bank_code" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Número de Teléfono</label>
                            <input type="number" name="phone_number" id="phone_number" class="form-control" required>
                        </div>
                        <br>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success"
                                style="display: block; margin: 0 auto;">Agregar Pago Móvil</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Editar Pago Móvil -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title" id="editModalLabel" style="color: white;">Editar Pago Móvil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST">
                        <input type="hidden" name="id" id="edit_id">
                        <input type="hidden" name="action" value="update">
                        <div class="form-group">
                            <label for="cedula">Cédula</label>
                            <input type="number" name="cedula" id="edit_cedula" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="bank_code">Código Bancario</label>
                            <input type="number" name="bank_code" id="edit_bank_code" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Número de Teléfono</label>
                            <input type="number" name="phone_number" id="edit_phone_number" class="form-control" required>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-success" style="display: block; margin: 0 auto;">Actualizar
                            Pago Móvil</button>

                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#paymentsTable').DataTable({
                "paging": true,
                "searching": true,
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado de _MAX_ registros en total)",
                    "search": "Buscar:",
                    "paginate": {
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });

            // Llenar formulario de edición
            $('#editModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var cedula = button.data('cedula');
                var bankCode = button.data('bank-code');
                var phoneNumber = button.data('phone-number');

                $('#edit_id').val(id);
                $('#edit_cedula').val(cedula);
                $('#edit_bank_code').val(bankCode);
                $('#edit_phone_number').val(phoneNumber);
            });
        });
    </script>
</body>

</html>