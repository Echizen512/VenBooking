<?php
include '../config/db.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'create') {
    $inn_id = $_POST['inn_id'];
    $email = $_POST['email'];

    
    $check_sql = "SELECT * FROM zelle_transfer_info WHERE inn_id = ? AND email = ?";
    $stmt_check = $conn->prepare($check_sql);
    $stmt_check->bind_param("is", $inn_id, $email);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        $message = "Ya existe una transferencia Zelle registrada para esta posada y correo electrónico.";
    } else {
        $sql = "INSERT INTO zelle_transfer_info (inn_id, email) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $inn_id, $email);

        if ($stmt->execute()) {
            $message = "Transferencia Zelle agregada exitosamente.";
        } else {
            $message = "Error al agregar la transferencia Zelle: " . $conn->error;
        }
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'update') {
    $id = $_POST['id'];
    $email = $_POST['email'];

    $sql = "UPDATE zelle_transfer_info SET email = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $email, $id);

    if ($stmt->execute()) {
        $message = "Transferencia Zelle actualizada exitosamente.";
    } else {
        $message = "Error al actualizar la transferencia Zelle: " . $conn->error;
    }
}


$sql = "SELECT zelle_transfer_info.id, zelle_transfer_info.email, inns.name AS inn_name 
        FROM zelle_transfer_info
        LEFT JOIN inns ON zelle_transfer_info.inn_id = inns.id
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
    <title>Transferencias Zelle</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="../Assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Assets/css/CRUD.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<style>
        /* Animaciones */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideInUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .fadeIn {
            animation: fadeIn 1s ease-in-out;
        }

        .slideInUp {
            animation: slideInUp 1s ease-in-out;
        }
    </style>

<body>

    <?php include './Header_Admin.php'; ?>

    <div class="container mt-5 fadeIn">
        <div class="card custom-card slideInUp">
            <div class="card-body">
                <h2 class="card-title"><i class="fas fa-credit-card" style="color:rgb(183, 74, 255);"></i> Lista de Transferencias Zelle</h2>
                <div class="table-responsive fadeIn">
                    <div class="mb-3" style="text-align: right;">
                        <button class='btn btn-success btn-sm d-inline-flex align-items-center' data-bs-toggle="modal"
                            data-bs-target="#createModal" style="color: white; font-size: 14px;"
                            title='Agregar Transferencia Zelle'>
                            <i class='fas fa-plus me-2' style='color: white;'></i> Añadir Datos
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
                                echo "<tr><td colspan='3'>No hay transferencias Zelle registradas.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Agregar Transferencia Zelle -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title" id="createModalLabel" style="color: white;">Agregar Zelle</h5>
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

    <!-- Modal para Editar Transferencia Zelle -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="editModalLabel" style="color: white;">Editar Transferencia Zelle</h5>
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

    <br><br>

    <script src="https:
    <script src="https:
    <script src="https:
    <script>
        $(document).ready(function() {
            $('#transfersTable').DataTable();

            
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
