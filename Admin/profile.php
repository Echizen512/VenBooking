<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

include './php/profile.php';

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Perfiles</title>
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
                <h2 class="card-title text-center">
                    <i class="fas fa-users"></i> Lista de Perfiles
                </h2>
                <table id="profilesTable" class="table table-bordered table-striped">
                    <thead>
                        <tr class="text-center">
                            <th><i class="fas fa-id-badge"></i> ID</th>
                            <th><i class="fas fa-user"></i> Nombre</th>
                            <th><i class="fas fa-user"></i> Apellido</th>
                            <th><i class="fas fa-envelope"></i> Email</th>
                            <th><i class="fas fa-clock"></i> Último Acceso</th>
                            <th><i class="fas fa-calendar-alt"></i> Fecha de Registro</th>
                            <th><i class="fas fa-user-tag"></i> Tipo de Perfil</th>
                            <th><i class="fas fa-ban"></i> Bloqueado</th>
                            <th><i class="fas fa-cogs"></i> Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM Profile";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $last_access = date("d-m-Y", strtotime($row['last_access']));
                                $registration_date = date("d-m-Y", strtotime($row['registration_date']));
                                echo "<tr>
                                <td class='text-center'>{$row['id']}</td>
                                <td class='text-center'>{$row['first_name']}</td>
                                <td class='text-center'>{$row['last_name']}</td>
                                <td class='text-center'>{$row['email']}</td>
                                <td class='text-center'>{$last_access}</td>
                                <td class='text-center'>{$registration_date}</td>
                                <td class='text-center'>{$row['profile_type']}</td>
                                <td class='text-center'>" . ($row['block'] ? 'Sí' : 'No') . "</td>
                                <td class='text-center'>
                                    <button onclick='toggleBlock({$row['id']}, " . ($row['block'] ? 'false' : 'true') . ")' class='btn btn-warning btn-sm' title='Bloquear/Desbloquear'>
                                        <i class='fas " . ($row['block'] ? 'fa-lock' : 'fa-lock-open') . "'></i>
                                    </button>
                                </td>
                            </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='9' class='text-center'>No se encontraron perfiles</td></tr>";
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
        $(document).ready(function () {
            $('#profilesTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json"
                }
            });

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

        function toggleBlock(id, block) {
            Swal.fire({
                title: block ? '¿Bloquear perfil?' : '¿Desbloquear perfil?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: block ? 'Sí, bloquear' : 'Sí, desbloquear'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `get_profile.php?id=${id}&block=${block}`;
                }
            });
        }
    </script>

</body>

</html>