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

// Consulta SQL para obtener los paquetes turísticos con el campo block
$sql = "SELECT tour_packages.id, tour_packages.name, tour_packages.description, 
               tour_packages.image_url, tour_packages.duration, tour_packages.block, 
               tour_packages.price, inns.name AS inn_name 
        FROM tour_packages
        LEFT JOIN inns ON tour_packages.inn_id = inns.id
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
    <title>Lista de Paquetes Turísticos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="../Assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../Assets/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Assets/css/CRUD.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .content {
            flex: 1;
        }
        footer {
            padding: 20px;
            width: 100%;
            position: relative;
            margin-top: auto;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <?php include './Header_Admin.php'; ?>
    <div class="content">
        <div class="container mt-5">
            <div class="card custom-card">
                <div class="card-body">
                    <h2 class="card-title text-center"><i class="fas fa-suitcase"></i> Lista de Paquetes Turísticos</h2>
                    <div class="table-responsive">
                    <div class="text-right mb-3">
                        <a href='create_package.php' class='btn btn-success btn-sm d-inline-flex align-items-center' style="color: white; font-size: 14px;" title='Agregar Paquete'>
                            <i class='fas fa-plus mr-2' style='color: white;'></i> Agregar Paquete
                        </a>
                    </div>
                        <table id="tourPackagesTable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th class="text-center"><i class="fas fa-signature"></i> Nombre</th>
                                <th class="text-center"><i class="fas fa-align-left"></i> Descripción</th>
                                <th class="text-center"><i class="fas fa-calendar-day"></i> Duración (días)</th>
                                <th class="text-center"><i class="fas fa-dollar-sign"></i> Precio</th>
                                <th class="text-center"><i class="fas fa-hotel"></i> Posada</th>
                                <th class="text-center"><i class="fas fa-image"></i> Imagen</th>
                                <th class="text-center"><i class="fas fa-lock"></i> Bloqueado</th>
                                <th class="text-center"><i class="fas fa-cogs"></i> Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $blockButton = $row["block"] 
                                    ? "<button class='btn btn-danger btn-sm toggle-block' data-id='".$row["id"]."' data-block='0'>
                                            <i class='fas fa-lock mr-2'></i> 
                                            <span>Bloqueado</span>
                                    </button>" 
                                    : "<button class='btn btn-success btn-sm toggle-block' data-id='".$row["id"]."' data-block='1'>
                                            <i class='fas fa-lock-open mr-2'></i> 
                                            <span>Desbloqueado</span>
                                    </button>";
                                    echo "<tr>
                                            <td class='text-center'>{$row['name']}</td>
                                            <td class='text-center'>{$row['description']}</td>
                                            <td class='text-center'>{$row['duration']}</td>
                                            <td class='text-center'>{$row['price']}</td>
                                            <td class='text-center'>{$row['inn_name']}</td>
                                            <td class='text-center'><img src='{$row['image_url']}' alt='Imagen del Paquete' style='width: 100px;'></td>
                                            <td class='text-center'>{$blockButton}</td>
                                            <td class='text-center'>
                                                <div style='display: flex; justify-content: center; align-items: center; gap: 5px;'>
                                                    <a href='edit_package.php?id={$row['id']}' class='btn btn-primary btn-sm' style='width: 40px;' title='Editar'>
                                                        <i class='fas fa-pencil-alt' style='color: white;'></i>
                                                    </a>
                                                    <form action='toggle_block_package.php' method='POST' class='toggle-block-form' style='display:inline-block;'>
                                                        <input type='hidden' name='id' value='" . $row["id"] . "'>
                                                        <input type='hidden' name='block' value='" . ($row["block"] ? 0 : 1) . "'>
                                                        <button type='submit' class='btn btn-warning btn-sm' style='width: 40px;' title='Cambiar Estado'>
                                                            <i class='fas fa-ban'></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='8' class='text-center'>No se encontraron paquetes turísticos</td></tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../Assets/js/bootstrap.bundle.min.js"></script>
<script src="../Assets/js/jquery-3.6.0.min.js"></script>
<script src="../Assets/js/jquery.dataTables.min.js"></script>
<script src="../Assets/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {
    $('#tourPackagesTable').DataTable({
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

    $('.btn-primary').click(function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Editar Paquete',
            text: '¿Estás seguro de que deseas editar este paquete?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, editar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = $(this).attr('href');
            }
        });
    });

    $('.toggle-block-form').submit(function(e) {
        e.preventDefault();
        const form = $(this);
        Swal.fire({
            title: '¿Estás seguro de cambiar el estado de bloqueo?',
            text: "¡Esto cambiará el estado de bloqueo del paquete turístico!",
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

    $('.toggle-block').click(function () {
        const button = $(this);
        const id = button.data('id');
        const block = button.data('block');

        // Crear un formulario oculto para el cambio de estado
        const form = $('<form>', {
            action: 'toggle_block_package.php',
            method: 'POST',
            class: 'toggle-block-form',
            html: `<input type="hidden" name="id" value="${id}">
                   <input type="hidden" name="block" value="${block}">`
        });

        Swal.fire({
            title: '¿Estás seguro de cambiar el estado de bloqueo?',
            text: "¡Esto cambiará el estado de bloqueo del paquete turístico!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Sí, cambiar!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.appendTo('body').submit();
            }
        });
    });
});
</script>
</body>
</html>

