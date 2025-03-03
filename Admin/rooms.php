<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

include './php/rooms.php';

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Habitaciones</title>
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
            <h2 class="card-title text-center">Lista de Habitaciones</h2>
            <table id="roomsTable" class="table table-bordered table-striped">
                <thead>
                <tr class="text-center">
                    <th><i class="fas fa-id-badge"></i> ID</th>
                    <th><i class="fas fa-door-closed"></i> Número</th>
                    <th><i class="fas fa-bed"></i> Tipo</th>
                    <th><i class="fas fa-star"></i> Calidad</th>
                    <th><i class="fas fa-image"></i> Imagen</th>
                    <th><i class="fas fa-dollar-sign"></i> Precio</th>
                    <th><i class="fas fa-users"></i> Capacidad</th>
                    <th><i class="fas fa-hotel"></i> ID de Posada</th>
                    <th><i class="fas fa-toggle-on"></i> Bloqueado</th>
                    <th><i class="fas fa-cogs"></i> Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php
                include '../config/db.php';
                $sql = "SELECT * FROM rooms";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td class='text-center'>{$row['id']}</td>
                                <td class='text-center'>{$row['room_number']}</td>
                                <td class='text-center'>{$row['type']}</td>
                                <td class='text-center'>{$row['quality']}</td>
                                <td><img src='{$row['image_url']}' alt='Imagen de la Habitación' style='width: 100px;'></td> 
                                <td class='text-center'>{$row['price']}</td>
                                <td class='text-center'>{$row['capacity']}</td>
                                <td class='text-center'>{$row['inn_id']}</td>
                                <td class='text-center'>".($row['status'] ? 'Sí' : 'No')."</td>
                                <td class='text-center'>
                                    <button onclick='toggleStatus({$row['id']}, ".($row['status'] ? 'false' : 'true').")' class='btn btn-warning btn-sm' title='Bloquear/Desbloquear'>
                                        <i class='fas ".($row['status'] ? 'fa-lock' : 'fa-lock-open')."'></i>
                                    </button>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='12' class='text-center'>No se encontraron habitaciones</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../Assets/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    $('#roomsTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json"
        }
    });

    // Mostrar mensaje basado en el estado de la URL
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('status')) {
        const status = urlParams.get('status');
        if (status === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Estado actualizado correctamente',
                showConfirmButton: false,
                timer: 1500
            });
        } else if (status === 'error') {
            Swal.fire({
                icon: 'error',
                title: 'Error al actualizar el estado',
                showConfirmButton: false,
                timer: 1500
            });
        }
    }
});

function toggleStatus(id, status) {
    Swal.fire({
        title: status ? '¿Bloquear habitación?' : '¿Desbloquear habitación?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: status ? 'Sí, bloquear' : 'Sí, desbloquear'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `?id=${id}&status=${status}`;
        }
    });
}
</script>
</body>
</html>
