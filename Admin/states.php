<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

include './php/states.php';

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Estados</title>
    <link href="../Assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="./Assets/CSS/CRUD.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title text-center">Lista de Estados</h2>
            <div class="text-end mb-3">
            <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#createModal"><i class="fas fa-plus"></i> Crear Estado</button>
            </div>
            <table id="statesTable" class="table table-bordered table-striped">
                <thead>
                <tr class="text-center">
                    <th><i class="fas fa-id-badge"></i> ID</th>
                    <th><i class="fas fa-flag"></i> Bandera</th>
                    <th><i class="fas fa-globe"></i> Nombre</th>
                    <th><i class="fas fa-toggle-on"></i> Estado</th>
                    <th><i class="fas fa-cogs"></i> Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php
                include '../config/db.php';
                $sql = "SELECT * FROM states";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td class='text-center'>{$row['id']}</td>
                                <td class='text-center'><img src='{$row['flag_url']}' alt='Bandera del Estado' style='width: 50px;'></td>
                                <td class='text-center'>{$row['name']}</td>
                                <td class='text-center'>".($row['status'] ? 'Activo' : 'Inactivo')."</td>
                                <td class='text-center'>
                                    <button onclick='editState({$row['id']}, \"{$row['name']}\", \"{$row['flag_url']}\", {$row['status']})' class='btn btn-primary btn-sm' title='Editar'><i class='fas fa-edit'></i></button>
                                    <button onclick='toggleStatus({$row['id']}, ".($row['status'] ? 'false' : 'true').")' class='btn btn-warning btn-sm' title='Cambiar Estado'><i class='fas ".($row['status'] ? 'fa-lock-open' : 'fa-lock')."'></i></button>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>No se encontraron estados</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Crear Estado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="createName" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="createName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="createFlag" class="form-label">URL de la Bandera</label>
                        <input type="text" class="form-control" id="createFlag" name="flag_url" required>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="createStatus" name="status">
                        <label class="form-check-label" for="createStatus">
                            Activo
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" name="create" class="btn btn-primary">Crear</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Editar Estado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editId" name="id">
                    <div class="mb-3">
                        <label for="editName" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="editName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="editFlag" class="form-label">URL de la Bandera</label>
                        <input type="text" class="form-control" id="editFlag" name="flag_url" required>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="editStatus" name="status">
                        <label class="form-check-label" for="editStatus">
                            Activo
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" name="edit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="../Assets/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function() {
    $('#statesTable').DataTable();

    window.editState = function(id, name, flag_url, status) {
        $('#editId').val(id);
        $('#editName').val(name);
        $('#editFlag').val(flag_url);
        $('#editStatus').prop('checked', status == 1);
        $('#editModal').modal('show');
    }

    window.toggleStatus = function(id, status) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡Vas a cambiar el estado!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, cambiar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `?id=${id}&status=${status}`;
            }
        })
    }


});
</script>
</body>
</html>
