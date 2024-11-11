<?php
include '../config/db.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Lógica para Crear Transferencia Binance
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'create') {
    $inn_id = $_POST['inn_id'];
    $email = $_POST['email'];

    // Verificar si ya existe una transferencia registrada para esta posada
    $check_sql = "SELECT * FROM binance_transfer_info WHERE inn_id = ? AND email = ?";
    $stmt_check = $conn->prepare($check_sql);
    $stmt_check->bind_param("is", $inn_id, $email);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        $message = "Ya existe una transferencia Binance registrada para esta posada y correo electrónico.";
    } else {
        $sql = "INSERT INTO binance_transfer_info (inn_id, email) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $inn_id, $email);

        if ($stmt->execute()) {
            $message = "Transferencia Binance agregada exitosamente.";
        } else {
            $message = "Error al agregar la transferencia Binance: " . $conn->error;
        }
    }
}

// Lógica para Actualizar Transferencia Binance
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'update') {
    $id = $_POST['id'];
    $email = $_POST['email'];

    $sql = "UPDATE binance_transfer_info SET email = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $email, $id);

    if ($stmt->execute()) {
        $message = "Transferencia Binance actualizada exitosamente.";
    } else {
        $message = "Error al actualizar la transferencia Binance: " . $conn->error;
    }
}

// Consultar Transferencias Binance
$sql = "SELECT binance_transfer_info.id, binance_transfer_info.email, inns.name AS inn_name 
        FROM binance_transfer_info
        LEFT JOIN inns ON binance_transfer_info.inn_id = inns.id
        WHERE inns.user_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transferencias Binance</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="../Assets/css/bootstrap.min.css" rel="stylesheet">
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
            color: rgb(25 135 84);
        }

        .table {
            border-radius: 8px;
            overflow: hidden;
        }

        .table thead th {
            background-color: rgb(25 135 84);
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

    <div class="container mt-5">
        <div class="card custom-card">
            <div class="card-body">
                <h2 class="card-title"><i class="fas fa-wallet"></i> Lista de Transferencias Binance</h2>
                <div class="table-responsive">
                    <div class="text-right mb-3">
                        <button class='btn btn-success btn-sm d-inline-flex align-items-center' data-bs-toggle="modal"
                            data-bs-target="#createModal" style="color: white; font-size: 14px;"
                            title='Agregar Transferencia Binance'>
                            <i class='fas fa-plus mr-2' style='color: white;'></i> Agregar Binance
                        </button>
                    </div>
                    <table id="transfersTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Correo Electrónico</th>
                                <th class="text-center">Posada</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                    <td class='text-center'>{$row['email']}</td>
                                    <td class='text-center'>{$row['inn_name']}</td>
                                    <td class='text-center'>
                                        <button class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#editModal' data-id='{$row['id']}' data-email='{$row['email']}' style='width: 30px; height: 30px; padding: 0; text-align: center; display: inline-flex; align-items: center; justify-content: center; font-size: 16px; color: white;'>
                                            <i class='fas fa-edit'></i>
                                        </button>
                                    </td>
                                </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='3'>No hay transferencias Binance registradas.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Agregar Transferencia Binance -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title" id="createModalLabel" style="color: white;">Agregar Transferencia Binance</h5>
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
                            <label for="email">Correo Electrónico</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success mt-3" style="width: 100%;">Crear Transferencia</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Editar Transferencia Binance -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="editModalLabel" style="color: white;">Editar Transferencia Binance</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST">
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="id" id="edit_id">
                        <div class="form-group">
                            <label for="edit_email">Correo Electrónico</label>
                            <input type="email" name="email" id="edit_email" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3" style="width: 100%;">Actualizar Transferencia</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<br> <br>
<?php include './Footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#transfersTable').DataTable();

            // Cargar datos en el modal de edición
            $('#editModal').on('show.bs.modal', function(e) {
                const button = $(e.relatedTarget);
                const id = button.data('id');
                const email = button.data('email');
                $('#edit_id').val(id);
                $('#edit_email').val(email);
            });
        });
    </script>

</body>

</html>
