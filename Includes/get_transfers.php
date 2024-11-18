<?php
include '../config/db.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Lógica para Crear Transferencia Bancaria
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'create') {
    $inn_id = $_POST['inn_id'];
    $full_name = $_POST['full_name'];
    $account_number = $_POST['account_number'];
    $bank_code = $_POST['bank_code'];

    $check_sql = "SELECT * FROM bank_transfer_info WHERE inn_id = ?";
    $stmt_check = $conn->prepare($check_sql);
    $stmt_check->bind_param("i", $inn_id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        $message = "Ya existe una transferencia bancaria registrada para esta posada.";
    } else {
        $sql = "INSERT INTO bank_transfer_info (inn_id, full_name, account_number, bank_code) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isss", $inn_id, $full_name, $account_number, $bank_code);

        if ($stmt->execute()) {
            $message = "Transferencia bancaria agregada exitosamente.";
        } else {
            $message = "Error al agregar la transferencia bancaria: " . $conn->error;
        }
    }
}

// Lógica para Actualizar Transferencia Bancaria
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'update') {
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $account_number = $_POST['account_number'];
    $bank_code = $_POST['bank_code'];

    $sql = "UPDATE bank_transfer_info SET full_name = ?, account_number = ?, bank_code = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $full_name, $account_number, $bank_code, $id);

    if ($stmt->execute()) {
        $message = "Transferencia bancaria actualizada exitosamente.";
    } else {
        $message = "Error al actualizar la transferencia bancaria: " . $conn->error;
    }
}

// Consultar Transferencias Bancarias
$sql = "SELECT bank_transfer_info.id, bank_transfer_info.full_name, bank_transfer_info.account_number, bank_transfer_info.bank_code, inns.name AS inn_name 
        FROM bank_transfer_info
        LEFT JOIN inns ON bank_transfer_info.inn_id = inns.id
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
    <title>Transferencias Bancarias</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./../Assets/css/bootstrap.min.css">
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

footer {
    padding: 10px 0;
    width: 100%;
    position: relative;
    bottom: 0;
    margin-top: auto; 
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
                <h2 class="card-title"><i class="fas fa-money-check-alt"></i> Lista de Transferencias Bancarias</h2>
                <div class="table-responsive">
                <div class="mb-3" style="text-align: right;">
                        <button class='btn btn-success btn-sm d-inline-flex align-items-center' data-bs-toggle="modal"
                            data-bs-target="#createModal" style="color: white; font-size: 14px;"
                            title='Agregar Transferencia Bancaria'>
                            <i class='fas fa-plus mr-3' style='color: white;'></i> Agregar
                        </button>
                    </div>
                    <table id="transfersTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Nombre Completo</th>
                                <th class="text-center">Número de Cuenta</th>
                                <th class="text-center">Código Bancario</th>
                                <th class="text-center">Posada</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                    <td class='text-center'>{$row['full_name']}</td>
                                    <td class='text-center'>{$row['account_number']}</td>
                                    <td class='text-center'>{$row['bank_code']}</td>
                                    <td class='text-center'>{$row['inn_name']}</td>
                                    <td class='text-center'>
                                        <button class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#editModal' data-id='{$row['id']}' data-full-name='{$row['full_name']}' data-account-number='{$row['account_number']}' data-bank-code='{$row['bank_code']}' style='width: 20px; height: 20px; padding: 0; text-align: center; display: inline-flex; align-items: center; justify-content: center; font-size: 10px; color: white;'>
                                            <i class='fas fa-edit'></i>
                                        </button>
                                    </td>
                                </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>No hay transferencias bancarias registradas.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Agregar Transferencia Bancaria -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title" id="createModalLabel" style="color: white;">Agregar Transferencia Bancaria
                    </h5>
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
                            <label for="full_name">Nombre Completo</label>
                            <input type="text" name="full_name" id="full_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="account_number">Número de Cuenta</label>
                            <input type="number" name="account_number" id="account_number" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="bank_code">Código Bancario</label>
                            <input type="number" name="bank_code" id="bank_code" class="form-control" required>
                        </div>
                        <br>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success"
                                style="display: block; margin: 0 auto;">Agregar Transferencia Bancaria</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Editar Transferencia Bancaria -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title" id="editModalLabel" style="color: white;">Editar Transferencia Bancaria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST">
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="id" id="edit_id" value="">
                        <div class="form-group">
                            <label for="edit_full_name">Nombre Completo</label>
                            <input type="text" name="full_name" id="edit_full_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_account_number">Número de Cuenta</label>
                            <input type="number" name="account_number" id="edit_account_number" class="form-control"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="edit_bank_code">Código Bancario</label>
                            <input type="number" name="bank_code" id="edit_bank_code" class="form-control" required>
                        </div>
                        <br>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success"
                                style="display: block; margin: 0 auto;">Actualizar Transferencia Bancaria</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br> <br>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#transfersTable').DataTable();

            // Rellenar el modal de edición con datos
            $('#editModal').on('show.bs.modal', function (event) {
                const button = $(event.relatedTarget);
                const id = button.data('id');
                const fullName = button.data('full-name');
                const accountNumber = button.data('account-number');
                const bankCode = button.data('bank-code');

                const modal = $(this);
                modal.find('#edit_id').val(id);
                modal.find('#edit_full_name').val(fullName);
                modal.find('#edit_account_number').val(accountNumber);
                modal.find('#edit_bank_code').val(bankCode);
            });
        });
    </script>


<script>
    // Función para validar el nombre completo
    function validateFullName(fullName) {
        const regex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/; // Solo letras, espacios y caracteres latinos
        return regex.test(fullName);
    }

    // Validar el formulario al intentar enviarlo
    document.getElementById('createForm').addEventListener('submit', function (e) {
        const fullNameInput = document.getElementById('full_name');
        const fullName = fullNameInput.value.trim();

        if (!validateFullName(fullName)) {
            e.preventDefault(); // Detener el envío del formulario
            Swal.fire({
                icon: 'error',
                title: 'Nombre inválido',
                text: 'El Nombre Completo solo puede contener letras y espacios.',
                confirmButtonText: 'Entendido'
            });

            // Resaltar el campo inválido
            fullNameInput.focus();
        }
    });
</script>


</body>

</html>