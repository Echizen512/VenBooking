<?php
include '../config/db.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Obtener el tipo de membresía y el número de posadas existentes
$sql_membership = "SELECT profile.membership_type, 
                          COUNT(inns.id) AS inn_count 
                   FROM profile 
                   LEFT JOIN inns ON profile.id = inns.user_id 
                   WHERE profile.id = ?";

$stmt_membership = $conn->prepare($sql_membership);
$stmt_membership->bind_param("i", $user_id);
$stmt_membership->execute();
$result_membership = $stmt_membership->get_result();

if ($result_membership === false) {
    die('Error al ejecutar la consulta: ' . $conn->error);
}

$membership_data = $result_membership->fetch_assoc();
$membership_type = $membership_data['membership_type'];
$inn_count = $membership_data['inn_count'];

$sql = "SELECT inns.id, inns.name, inns.description, inns.email, inns.phone, inns.block, 
       inns.image_url, inns.state_id, inns.municipality_id, inns.parish_id, inns.category_id,
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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    if ($_POST['action'] == "create") {
        // Crear nueva posada
        $name = $_POST['name'];
        $description = $_POST['description'];
        $image_url = $_POST['image_url'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $state_id = $_POST['state'];
        $municipality_id = $_POST['municipality'];
        $parish_id = $_POST['parish'];
        $category_id = $_POST['category'];
        $user_id = $_SESSION['user_id'];

        $sql = "INSERT INTO inns (name, description, image_url, email, phone, state_id, municipality_id, parish_id, category_id, user_id)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssiisii", $name, $description, $image_url, $email, $phone, $state_id, $municipality_id, $parish_id, $category_id, $user_id);

        if ($stmt->execute()) {
            header("Location: get_inns.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    } elseif ($_POST['action'] == "edit") {
        // Editar posada
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $image_url = $_POST['image_url'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $state_id = $_POST['state'];
        $municipality_id = $_POST['municipality'];
        $parish_id = $_POST['parish'];
        $category_id = $_POST['category'];

        $sql = "UPDATE inns SET name=?, description=?, image_url=?, email=?, phone=?, state_id=?, municipality_id=?, parish_id=?, category_id=? WHERE id=?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssiisii", $name, $description, $image_url, $email, $phone, $state_id, $municipality_id, $parish_id, $category_id, $id);

        if ($stmt->execute()) {
            echo "<script>alert('Posada actualizada correctamente.');</script>";
        } else {
            echo "<script>alert('Error al actualizar la posada: " . $stmt->error . "');</script>";
        }
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
</head>

<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f8f9fa;
    }

    .card {
        border-radius: 8px;
        overflow: hidden;
    }

    .card-title {
        font-size: 2.5rem;
        font-weight: bold;
        color: #343a40;
    }

    .table {
        border-radius: 8px;
        overflow: hidden;
    }

    .table thead th {
        background-color: #343a40;
        color: white;
        font-size: 1.5rem;
    }

    .table td {
        vertical-align: middle;
        font-size: 1.2rem;
    }

    .alert {
        border-radius: 5px;
        background-color: #fff3cd;
        color: #856404;
        font-weight: bold;
        font-size: 1.2rem;
    }

    .mb-3 {
        margin-bottom: 1.5rem !important;
    }

    .text-center {
        text-align: center;
    }

    .gap-2 {
        gap: 0.5rem;
    }

    html,
    body {
        height: 100%;
        margin: 0;
    }

    body {
        display: flex;
        flex-direction: column;
    }

    .container {
        flex: 1;
    }

    .page-footer {
    background-color: #28a745;
    color: white;
    text-align: center;
    padding: 10px 0;
    position: fixed;  /* Mantiene el footer fijo en la parte inferior */
    left: 0;          /* Alinea el footer a la izquierda */
    bottom: 0;        /* Fija el footer en la parte inferior de la ventana */
    width: 100%;      /* Asegura que el footer ocupe todo el ancho de la pantalla */
    z-index: 1000;    /* Asegura que el footer esté por encima de otros elementos */
}

</style>

<body>
    <?php include './Header_Admin.php'; ?>
    <div class="container mt-5">
        <div class="card shadow-sm border-0">
            <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="card-title"><i class="fas fa-list"></i> Listado de Posadas</h2>
    <button type="button" class="btn btn-success btn-sm d-flex align-items-center" id="addPosadaButton" title="Crear Posada" style="font-size: 16px;">
        <i class="fas fa-plus mr-2"></i> Añadir Posada
    </button>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('addPosadaButton').addEventListener('click', function() {
        let membershipType = '<?php echo $membership_type; ?>';
        let innCount = <?php echo $inn_count; ?>;

        if (membershipType === 'basic' && innCount > 0) {
            Swal.fire({
                title: 'Límite alcanzado',
                text: 'Ya has alcanzado el límite de posadas.',
                icon: 'warning',
                confirmButtonText: 'Actualizar Membresía',
                onClose: () => {
                    window.location.href = 'Memberships.php'; 
                }
            });
        } else if (membershipType === 'silver' && innCount >= 3) {
            Swal.fire({
                title: 'Límite alcanzado',
                text: 'Ya has alcanzado el límite de 3 posadas.',
                icon: 'warning',
                confirmButtonText: 'Actualizar Membresía',
                onClose: () => {
                    window.location.href = 'Memberships.php'; // Cambia esto a la URL de tu perfil
                }
            });
        } else {
            // Redirigir al modal o a la página de creación de posadas
            $('#posadaModal').modal('show');
        }
    });
</script>


                <div class="table-responsive">
                    <?php if ($result->num_rows > 0) { ?>
                        <table id="innsTable" class="table table-hover table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center"><i class="fas fa-image"></i> Imagen</th>
                                    <th class="text-center"><i class="fas fa-hotel"></i> Nombre</th>
                                    <th class="text-center"><i class="fas fa-map-marker-alt"></i> Estado</th>
                                    <th class="text-center"><i class="fas fa-star"></i> Categoría</th>
                                    <th class="text-center"><i class="fas fa-lock"></i> Bloqueo</th>
                                    <th class="text-center"><i class="fas fa-tools"></i> Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()) {
                                    $blockButton = $row["block"]
                                        ? "<button class='btn btn-danger btn-sm d-flex align-items-center justify-content-center' style='width: 120px;' data-id='" . $row["id"] . "' data-block='0'>
                                        <i class='fas fa-lock mr-2'></i> Bloqueado
                                    </button>"
                                        : "<button class='btn btn-success btn-sm d-flex align-items-center justify-content-center' style='width: 120px;' data-id='" . $row["id"] . "' data-block='1'>
                                        <i class='fas fa-lock-open mr-2'></i> Activo
                                    </button>";
                                    ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <div class="d-flex justify-content-center">
                                                <img src="<?= $row['image_url'] ?>" alt="Imagen de Posada"
                                                    class="rounded img-thumbnail" style="width: 100px; height: auto;">
                                            </div>
                                        </td>
                                        <td class="text-center"><?= $row["name"] ?></td>
                                        <td class="text-center"><?= $row["state_name"] ?></td>
                                        <td class="text-center"><?= $row["category_name"] ?></td>
                                        <td class="text-center align-middle">
                                            <div class="d-flex justify-content-center">
                                                <?= $blockButton ?>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center align-items-center gap-2">
                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                    data-target="#editModal" data-id="<?= $row['id'] ?>"
                                                    data-name="<?= $row['name'] ?>"
                                                    data-description="<?= $row['description'] ?>"
                                                    data-email="<?= $row['email'] ?>" data-phone="<?= $row['phone'] ?>"
                                                    data-image_url="<?= $row['image_url'] ?>"
                                                    data-state_id="<?= $row['state_id'] ?>"
                                                    data-municipality_id="<?= $row['municipality_id'] ?>"
                                                    data-parish_id="<?= $row['parish_id'] ?>"
                                                    data-category_id="<?= $row['category_id'] ?>" title="Editar">
                                                    <i class="fas fa-edit" style="font-size: 18px;"></i>
                                                </button>
                                                <form action="toggle_block.php" method="POST" class="m-0">
                                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                    <input type="hidden" name="block" value="<?= $row['block'] ? 0 : 1 ?>">
                                                    <button type="submit" class="btn btn-warning btn-sm"
                                                        title="Bloquear/Desbloquear">
                                                        <i class="fas fa-ban" style="font-size: 18px; color: white"></i>
                                                    </button>
                                                </form>
                                                <a href="ver_posada.php?id=<?= $row['id'] ?>" class="btn btn-info">
                                                    <i class="fas fa-eye" style="font-size: 18px; color: white"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } else { ?>
                        <div class="alert alert-warning text-center">
                            <i class="fas fa-exclamation-triangle"></i> No hay posadas registradas.
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="posadaModal" tabindex="-1" role="dialog" aria-labelledby="posadaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="posadaModalLabel">Registro de una Posada</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="description" class="form-label">Descripción</label>
                            <textarea class="form-control" id="description" name="description" rows="3"
                                required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image_url" class="form-label">URL de Imagen</label>
                            <input type="text" class="form-control" id="image_url" name="image_url" required>
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="state" class="form-label">Estado</label>
                            <select class="form-control" id="state" name="state" required>
                                <option value="">Seleccione un estado</option>
                                <!-- Options cargadas dinámicamente -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="municipality" class="form-label">Municipio</label>
                            <select class="form-control" id="municipality" name="municipality" required>
                                <option value="">Seleccione un municipio</option>
                                <!-- Options cargadas dinámicamente -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="parish" class="form-label">Parroquia</label>
                            <select class="form-control" id="parish" name="parish" required>
                                <option value="">Seleccione una parroquia</option>
                                <!-- Options cargadas dinámicamente -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="category" class="form-label">Categoría</label>
                            <select class="form-control" id="category" name="category" required>
                                <option value="">Seleccione una categoría</option>
                                <!-- Options cargadas dinámicamente -->
                            </select>
                        </div>
                        <div></div>
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Editar -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="editModalLabel">Editar Posada</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="">
                        <input type="hidden" id="edit-id" name="id">
                        <input type="hidden" name="action" value="edit">

                        <div class="form-group">
                            <label for="edit-name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="edit-name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-description" class="form-label">Descripción</label>
                            <textarea class="form-control" id="edit-description" name="description" rows="3"
                                required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="edit-image_url" class="form-label">URL de Imagen</label>
                            <input type="text" class="form-control" id="edit-image_url" name="image_url" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="edit-email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-phone" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="edit-phone" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-state" class="form-label">Estado</label>
                            <select class="form-control" id="edit-state" name="state" required>
                                <option value="">Seleccione un estado</option>
                                <!-- Opciones dinámicas -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit-municipality" class="form-label">Municipio</label>
                            <select class="form-control" id="edit-municipality" name="municipality" required>
                                <option value="">Seleccione un municipio</option>
                                <!-- Opciones dinámicas -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit-parish" class="form-label">Parroquia</label>
                            <select class="form-control" id="edit-parish" name="parish" required>
                                <option value="">Seleccione una parroquia</option>
                                <!-- Opciones dinámicas -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit-category" class="form-label">Categoría</label>
                            <select class="form-control" id="edit-category" name="category" required>
                                <option value="">Seleccione una categoría</option>
                                <!-- Opciones dinámicas -->
                            </select>
                        </div>


                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="page-footer">
        <div class="footer-last-section bg-success">
            <div class="container">
                <p>Copyright 2024 &copy; VenBooking</p>
            </div>
        </div>
    </footer>


    <script>
        $(document).ready(function () {
            $('#innsTable').DataTable();
            loadStates();
            loadCategories();

            $('.btn-edit').on('click', function () {
                populateEditModal($(this));
            });

            $('#state').on('change', function () {
                loadMunicipalities($(this).val());
                resetParishes();
            });

            $('#municipality').on('change', function () {
                loadParishes($(this).val());
            });

            $('.toggle-block').on('click', function () {
                toggleBlock($(this));
            });
        });

        function loadStates() {
            $.ajax({
                url: 'get_states.php',
                method: 'GET',
                success: function (data) {
                    handleLoadResponse(data, '#state', 'No se encontraron estados');
                },
                error: function () {
                    showAlert('No se pudo cargar los estados');
                }
            });
        }

        function loadCategories() {
            $.ajax({
                url: 'get_categories.php',
                method: 'GET',
                success: function (data) {
                    handleLoadResponse(data, '#category', 'No se encontraron categorías');
                },
                error: function () {
                    showAlert('No se pudo cargar las categorías');
                }
            });
        }

        function loadMunicipalities(state_id) {
            $('#municipality').html('<option value="">Seleccione un municipio</option>');
            resetParishes();

            if (state_id) {
                $.ajax({
                    url: 'get_municipalities.php',
                    method: 'GET',
                    data: { state_id: state_id },
                    success: function (data) {
                        handleLoadResponse(data, '#municipality', 'No se encontraron municipios');
                    },
                    error: function () {
                        showAlert('No se pudo cargar los municipios');
                    }
                });
            }
        }

        function loadParishes(municipality_id) {
            $('#parish').html('<option value="">Seleccione una parroquia</option>');

            if (municipality_id) {
                $.ajax({
                    url: 'get_parishes.php',
                    method: 'GET',
                    data: { municipality_id: municipality_id },
                    success: function (data) {
                        handleLoadResponse(data, '#parish', 'No se encontraron parroquias');
                    },
                    error: function () {
                        showAlert('No se pudo cargar las parroquias');
                    }
                });
            }
        }

        function handleLoadResponse(data, selectId, errorMessage) {
            try {
                const items = JSON.parse(data);
                if (items.length > 0) {
                    $(selectId).append(items.map(item => `<option value="${item.id}">${item.name}</option>`));
                } else {
                    showAlert(errorMessage);
                }
            } catch (error) {
                showAlert('Error al procesar los datos');
            }
        }

        function showAlert(message) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: message,
            });
        }

        function resetParishes() {
            $('#parish').html('<option value="">Seleccione una parroquia</option>');
        }

        function populateEditModal(button) {
            $('#edit-id').val(button.data('id'));
            $('#edit-name').val(button.data('name'));
            $('#edit-description').val(button.data('description'));
            $('#edit-email').val(button.data('email'));
            $('#edit-phone').val(button.data('phone'));
            $('#edit-image_url').val(button.data('image_url'));

            loadStates(function () {
                $('#edit-state').val(button.data('state_id'));
                loadMunicipalities(button.data('state_id'), function () {
                    $('#edit-municipality').val(button.data('municipality_id'));
                    loadParishes(button.data('municipality_id'), function () {
                        $('#edit-parish').val(button.data('parish_id'));
                    });
                });
            });

            loadCategories(function () {
                $('#edit-category').val(button.data('category_id'));
            });
        }

        function loadStates(callback) {
            $.ajax({
                url: 'get_states.php',
                method: 'GET',
                success: function (data) {
                    handleLoadResponse(data, '#state, #edit-state', 'No se encontraron estados');
                    if (callback) callback();
                },
                error: function () {
                    showAlert('No se pudo cargar los estados');
                }
            });
        }

        function loadMunicipalities(state_id, callback) {
            $('#municipality, #edit-municipality').html('<option value="">Seleccione un municipio</option>');
            resetParishes();

            if (state_id) {
                $.ajax({
                    url: 'get_municipalities.php',
                    method: 'GET',
                    data: { state_id: state_id },
                    success: function (data) {
                        handleLoadResponse(data, '#municipality, #edit-municipality', 'No se encontraron municipios');
                        if (callback) callback();
                    },
                    error: function () {
                        showAlert('No se pudo cargar los municipios');
                    }
                });
            }
        }

        function loadParishes(municipality_id, callback) {
            $('#parish, #edit-parish').html('<option value="">Seleccione una parroquia</option>');

            if (municipality_id) {
                $.ajax({
                    url: 'get_parishes.php',
                    method: 'GET',
                    data: { municipality_id: municipality_id },
                    success: function (data) {
                        handleLoadResponse(data, '#parish, #edit-parish', 'No se encontraron parroquias');
                        if (callback) callback();
                    },
                    error: function () {
                        showAlert('No se pudo cargar las parroquias');
                    }
                });
            }
        }

        function loadCategories(callback) {
            $.ajax({
                url: 'get_categories.php',
                method: 'GET',
                success: function (data) {
                    handleLoadResponse(data, '#category, #edit-category', 'No se encontraron categorías');
                    if (callback) callback();
                },
                error: function () {
                    showAlert('No se pudo cargar las categorías');
                }
            });
        }


        function toggleBlock(button) {
            const id = button.data('id');
            const block = button.data('block');
            $.ajax({
                url: 'toggle_block.php',
                method: 'POST',
                data: { id: id, block: block },
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Posada actualizada',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    updateToggleButton(button, block);
                },
                error: function () {
                    showAlert('Hubo un problema al actualizar la posada');
                }
            });
        }

        function updateToggleButton(button, block) {
            if (block === 0) {
                button.removeClass('btn-danger').addClass('btn-success').html('<i class="fas fa-lock-open mr-2"></i> <span>Activo</span>');
                button.data('block', 1);
            } else {
                button.removeClass('btn-success').addClass('btn-danger').html('<i class="fas fa-lock mr-2"></i> <span>Bloqueado</span>');
                button.data('block', 0);
            }
        }
    </script>

</body>

</html>