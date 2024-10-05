<?php
include '../config/db.php';
include './Dashboard.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT inns.id, inns.name, inns.description, inns.email, inns.phone, inns.block, 
        inns.image_url, -- Asegúrate de seleccionar image_url
        states.name AS state_name, municipalities.name AS municipality_name, 
        parishes.name AS parish_name, categories.name AS category_name
    FROM inns
    LEFT JOIN states ON inns.state_id = states.id
    LEFT JOIN municipalities ON inns.municipality_id = municipalities.id
    LEFT JOIN parishes ON inns.parish_id = parishes.id
    LEFT JOIN categories ON inns.category_id = categories.id
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
    <link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../Assets/css/CRUD.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php include './Header_Admin.php'; ?>
    <div class="container mt-5">
        <div class="card custom-card">
            <div class="card-body">
                <h2 class="card-title"><i class="fas fa-list"></i> Listado de Posadas</h2>
                <div class="text-right mb-3">
                    <a href='Posadas_Form.php' class='btn btn-success btn-sm d-inline-flex align-items-center' style="color: white; font-size: 14px;" title='Crear Posada'>
                        <i class='fas fa-plus mr-2' style='color: white;'></i> Añadir Posada
                    </a>
                </div>
                <div class="table-responsive">
                    <?php if ($result->num_rows > 0) {
                        echo "<table id='innsTable' class='table table-bordered table-striped'>
                                <thead>
                                    <tr>
                                        <th class='text-center'><i class='fas fa-hotel'></i> Nombre</th>
                                        <th class='text-center'><i class='fas fa-info-circle'></i> Descripción</th>
                                        <th class='text-center'><i class='fas fa-envelope'></i> Email</th>
                                        <th class='text-center'><i class='fas fa-phone'></i> Telf.</th>
                                        <th class='text-center'><i class='fas fa-image'></i> Imagen</th> <!-- Nueva columna para imagen -->
                                        <th class='text-center'><i class='fas fa-map-marker-alt'></i> Estado</th>
                                        <th class='text-center'><i class='fas fa-star'></i> Categoría</th>
                                        <th class='text-center'><i class='fas fa-lock'></i> Bloqueo</th>
                                        <th class='text-center'><i class='fas fa-tools'></i> Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>";
                        while($row = $result->fetch_assoc()) {
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
                                    <td class='text-center'>".$row["name"]."</td>
                                    <td class='text-center'>".$row["description"]."</td>
                                    <td class='text-center'>".$row["email"]."</td>
                                    <td class='text-center'>".$row["phone"]."</td>
                                    <td class='text-center'><img src='".$row['image_url']."' alt='Imagen' style='width: 100px;'></td> <!-- Celda para imagen -->
                                    <td class='text-center'>".$row["state_name"]."</td>
                                    <td class='text-center'>".$row["category_name"]."</td>
                                    <td class='text-center'>".$blockButton."</td>
                                    <td class='text-center'>
                                        <div style='display: flex; justify-content: center; align-items: center; gap: 5px;'>
                                            
                                            <a href='update_inn.php?id=" . $row["id"] . "' class='btn btn-primary' style='width: 40px;' title='Editar'>
                                                <i class='fas fa-edit' style='color: white;'></i>
                                            </a>
                                            <form action='toggle_block.php' method='POST' class='toggle-block-form' style='display:inline-block;'>
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
                        echo "</tbody></table>";
                    } else {
                        echo "<p>No hay posadas registradas.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script src="../Assets/js/jquery-3.6.0.min.js"></script>
<script src="../Assets/js/jquery.dataTables.min.js"></script>
<script src="../Assets/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function () {
    $('#innsTable').DataTable({
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
            text: "Se editará el Contenido de la Posada",
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
            text: "¡Esto cambiará el estado de bloqueo de la posada!",
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
