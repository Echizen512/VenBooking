<?php include '../PHP/get-Zelle.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zelle</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="../Assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./CRUD.css">
    <link rel="stylesheet" href="https://unpkg.com/tippy.js@6/dist/tippy.css">
    <script src="https://unpkg.com/tippy.js@6"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
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

    <?php include '../Includes/Modal-Zelle.php'; ?>

    <br><br>

    <script>

tippy('.btn-success[data-bs-target="#createModal"]', {
    content: 'Haz clic para añadir un nuevo registro',
    animation: 'scale',
    theme: 'custom',
    placement: 'right', 
});


tippy('.btn-primary[data-bs-target="#editModal"]', {
    content: 'Haz clic para editar este registro',
    animation: 'scale',
    theme: 'custom',
    placement: 'right',
});

</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

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
