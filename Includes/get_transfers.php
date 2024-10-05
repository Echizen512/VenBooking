<?php
include '../config/db.php';
include './Dashboard.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT bank_transfer_info.id, bank_transfer_info.full_name, bank_transfer_info.account_number, 
               bank_transfer_info.bank_code, inns.name AS inn_name
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
    <title>Lista de Transferencias Bancarias</title>
    <link href="../Assets/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="../Assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Assets/css/CRUD.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
<?php include './Header_Admin.php'; ?>
<div class="container mt-5">
    <div class="card custom-card">
        <div class="card-body">
            <h2 class="card-title"><i class="fas fa-money-check-alt"></i> Lista de Transferencias Bancarias</h2>
            <div class="table-responsive">
            <div class="text-right mb-3">
                <a href='create_transfer.php' class='btn btn-success btn-sm d-inline-flex align-items-center' style="color: white; font-size: 14px;" title='Agregar Transferencia'>
                    <i class='fas fa-plus mr-2' style='color: white;'></i> Agregar Transferencia
                </a>
            </div>
                <table id="transfersTable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th class="text-center"><i class="fas fa-user"></i> Nombre Completo</th>
                        <th class="text-center"><i class="fas fa-credit-card"></i> Número de Cuenta</th>
                        <th class="text-center"><i class="fas fa-university"></i> Código Bancario</th>
                        <th class="text-center"><i class="fas fa-hotel"></i> Posada</th>
                        <th class="text-center"><i class="fas fa-cogs"></i> Acciones</th>
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
                                        <div style='display: flex; justify-content: center; align-items: center; gap: 5px;'>
                                            <a href='update_transfer.php?id={$row['id']}' class='btn btn-primary' style='width: 40px;' title='Editar'>
                                                <i class='fas fa-edit' style='color: white;'></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>";
                        }
                    } else {
                        echo "<p>No hay transferencias bancarias registradas.</p>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<br> 
</body>
</html>

<script src="../Assets/js/jquery-3.6.0.min.js"></script>
<script src="../Assets/js/jquery.dataTables.min.js"></script>
<script src="../Assets/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function () {
    $('#transfersTable').DataTable({
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

    $('.btn-primary').click(function(e) {
        e.preventDefault();
        const url = $(this).attr('href');
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Se editará la Transferencia Bancaria",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Sí, editar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });
});
</script>
