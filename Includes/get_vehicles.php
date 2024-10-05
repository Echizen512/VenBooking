<?php
include '../config/db.php';
include './Dashboard.php';

session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Obtener el ID del usuario autenticado
$user_id = $_SESSION['user_id'];

// Consulta SQL para obtener los vehículos con el campo block
$sql = "SELECT vehicles.id, vehicles.inn_id, vehicles.type, vehicles.brand, vehicles.description, 
               vehicles.price, vehicles.capacity, vehicles.year, vehicles.model, vehicles.registration_plate, 
               vehicles.status, vehicles.image_url, vehicles.invoice, inns.name AS inn_name, vehicles.block 
        FROM vehicles
        LEFT JOIN inns ON vehicles.inn_id = inns.id
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
    <title>Lista de Vehículos</title>
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
            <h2 class="card-title"><i class="fas fa-car"></i> Lista de Vehículos</h2>
            <div class="text-right mb-3">
                <a href='create_vehicle.php' class='btn btn-success btn-sm d-inline-flex align-items-center' style="color: white; font-size: 14px;" title='Agregar Vehículo'>
                    <i class='fas fa-plus mr-2' style='color: white;'></i> Agregar Vehículo
                </a>
            </div>
            <div class="table-responsive">
                <table id="vehiclesTable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th><i class="fas fa-car-side"></i> Tipo</th>
                        <th><i class="fas fa-industry"></i> Marca</th>
                        <th><i class="fas fa-image"></i> Imagen</th> <!-- Nueva columna para la imagen -->
                        <th><i class="fas fa-info-circle"></i> Descripción</th>
                        <th><i class="fas fa-dollar-sign"></i> Precio</th>
                        <th><i class="fas fa-users"></i> Capacidad</th>
                        <th><i class="fas fa-calendar-alt"></i> Año</th>
                        <th><i class="fas fa-tools"></i> Modelo</th>
                        <th><i class="fas fa-lock"></i> Bloqueo</th>
                        <th><i class="fas fa-cogs"></i> Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Generar el botón de bloqueo/desbloqueo con la misma estética
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
                                    <td>{$row['type']}</td>
                                    <td>{$row['brand']}</td>
                                    <td><img src='{$row['image_url']}' alt='Imagen del Vehículo' style='width: 100px;'></td> <!-- Celda para la imagen -->
                                    <td>{$row['description']}</td>
                                    <td>{$row['price']}</td>
                                    <td>{$row['capacity']}</td>
                                    <td>{$row['year']}</td>
                                    <td>{$row['model']}</td>
                                    <td class='text-center'>{$blockButton}</td>
                                    <td>
                                        <div class='text-center' style='display: flex; justify-content: center; align-items: center; gap: 5px;'>
                                            <a href='update_vehicle.php?id={$row['id']}' class='btn btn-primary' style='width: 40px;'>
                                                <i class='fas fa-edit' style='color: white;'></i>
                                            </a>
                                            <form action='toggle_block_vehicle.php' method='POST' class='toggle-block-form' style='display:inline-block;'>
                                                <input type='hidden' name='id' value='" . $row["id"] . "'>
                                                <input type='hidden' name='block' value='" . ($row["block"] ? 0 : 1) . "'>
                                                <button type='submit' class='btn btn-warning' style='width: 40px;'>
                                                    <i class='fas fa-ban'></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='10'>No se encontraron vehículos</td></tr>";
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
    $('#vehiclesTable').DataTable({
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
            text: "Se editará el Contenido del Vehículo",
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
            text: "¡Esto cambiará el estado de bloqueo del vehículo!",
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

