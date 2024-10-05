<?php
include '../config/db.php';
include './Dashboard.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT rooms.id, rooms.room_number, rooms.type, rooms.quality, rooms.image_url, rooms.description, 
               rooms.price, rooms.capacity, inns.name AS inn_name, rooms.block 
        FROM rooms
        LEFT JOIN inns ON rooms.inn_id = inns.id
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Habitaciones</title>
    <link href="../Assets/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="../Assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Assets/css/CRUD.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<style>

</style>

<body>
<?php include './Header_Admin.php'; ?>
<div class="container mt-5">
    <div class="card custom-card">
        <div class="card-body">
            <h2 class="card-title"><i class="fas fa-bed"></i> Lista de Habitaciones</h2>
            <div class="table-responsive">
            <div class="text-right mb-3">
                <a href='create_room.php' class='btn btn-success btn-sm d-inline-flex align-items-center' style="color: white; font-size: 14px;" title='Agregar Habitación'>
                    <i class='fas fa-plus mr-2' style='color: white;'></i> Agregar Habitación
                </a>
            </div>
                <table id="roomsTable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th class="text-center"><i class="fas fa-door-closed"></i> Número</th>
                        <th class="text-center"><i class="fas fa-bed"></i> Tipo</th>
                        <th class="text-center"><i class="fas fa-star"></i> Calidad</th>
                        <th class="text-center"><i class="fas fa-align-left"></i> Descripción</th>
                        <th class="text-center"><i class="fas fa-dollar-sign"></i> Precio</th>
                        <th class="text-center"><i class="fas fa-users"></i> Capacidad</th>
                        <th class="text-center"><i class="fas fa-hotel"></i> Posada</th>
                        <th class="text-center"><i class="fas fa-image"></i> Imagen</th>
                        <th class="text-center"><i class="fas fa-lock"></i> Bloqueo</th>
                        <th class="text-center"><i class="fas fa-cogs"></i> Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $blockButton = $row["block"] 
                            ? "<button class='btn btn-danger btn-sm toggle-block d-flex align-items-center justify-content-center' style='width: 100px;' data-id='".$row["id"]."' data-block='0'>
                                    <i class='fas fa-lock mr-2'></i> 
                                    <span>Bloqueado</span>
                            </button>" 
                            : "<button class='btn btn-success btn-sm toggle-block d-flex align-items-center justify-content-center' style='width: 100px;' data-id='".$row["id"]."' data-block='1'>
                                    <i class='fas fa-lock-open mr-2'></i> 
                                    <span>Activo</span>
                            </button>";
                            echo "<tr>
                                    <td class='text-center'>{$row['room_number']}</td>
                                    <td class='text-center'>{$row['type']}</td>
                                    <td class='text-center'>{$row['quality']}</td>
                                    <td class='text-center'>{$row['description']}</td>
                                    <td class='text-center'>{$row['price']}</td>
                                    <td class='text-center'>{$row['capacity']}</td>
                                    <td class='text-center'>{$row['inn_name']}</td>
                                    <td class='text-center'><img src='{$row['image_url']}' alt='Imagen de la Habitación' style='width: 100px;'></td>
                                    <td class='text-center'>{$blockButton}</td>
                                    <td class='text-center'>
                                        <div style='display: flex; justify-content: center; align-items: center; gap: 5px;'>
                                            <a href='update_room.php?id={$row['id']}' class='btn btn-primary' style='width: 40px;' title='Editar'>
                                                <i class='fas fa-edit' style='color: white;'></i>
                                            </a>
                                            <form action='toggle_block_room.php' method='POST' class='toggle-block-form' style='display:inline-block;'>
                                                <input type='hidden' name='id' value='" . $row["id"] . "'>
                                                <input type='hidden' name='block' value='" . ($row["block"] ? 0 : 1) . "'>
                                                <button type='submit' class='btn btn-warning' style='width: 40px;' title='Bloquear/Desbloquear'>
                                                    <i class='fas fa-ban'></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>";
                        }
                    } else {
                        echo "<p>No hay habitaciones registradas.</p>";
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
    $('#roomsTable').DataTable({
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
            text: "Se editará el Contenido de la Habitación",
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

    $('.toggle-block-form').submit(function(e) {
        e.preventDefault();
        const form = $(this);
        Swal.fire({
            title: '¿Estás seguro de cambiar el estado de bloqueo?',
            text: "¡Esto cambiará el estado de bloqueo de la habitación!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Sí, cambiar!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.unbind('submit').submit();
            }
        });
    });
});
</script>
</html>
