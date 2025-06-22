<?php
include '../config/db.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
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

$message = null; // Variable para el mensaje
$messageType = null; // Variable para el tipo de alerta

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    if ($_POST['action'] == "create") {
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
        $quality = $_POST['quality'];

        $sql = "INSERT INTO inns (name, description, image_url, email, phone, state_id, municipality_id, parish_id, category_id, user_id, quality)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssiisiis", $name, $description, $image_url, $email, $phone, $state_id, $municipality_id, $parish_id, $category_id, $user_id, $quality);

        if ($stmt->execute()) {
            $message = "Posada creada correctamente.";
            $messageType = "success"; // Define el tipo de alerta
        } else {
            $message = "Hubo un problema al crear la posada: " . $stmt->error;
            $messageType = "error";
        }
    } elseif ($_POST['action'] == "edit") {
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
        $quality = $_POST['quality'];

        $sql = "UPDATE inns SET name=?, description=?, image_url=?, email=?, phone=?, state_id=?, municipality_id=?, parish_id=?, category_id=?, quality=? WHERE id=?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssiisisi", $name, $description, $image_url, $email, $phone, $state_id, $municipality_id, $parish_id, $category_id, $quality, $id);

        if ($stmt->execute()) {
            $message = "Posada actualizada correctamente.";
            $messageType = "success";
        } else {
            $message = "Hubo un problema al actualizar la posada: " . $stmt->error;
            $messageType = "error";
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="./CRUD.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/tippy.js@6/dist/tippy.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<style>
        .tippy-box[data-theme='custom'] {
            background-color:rgb(25, 135, 84);
            color: white;
            border-radius: 10px;
            font-size: 18px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            padding: 10px;
        }

        .tippy-box[data-theme='custom'][data-placement^='bottom'] {
            transform-origin: top;
        }
    </style>


<style>
        /* Animaciones */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideInUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .fadeIn {
            animation: fadeIn 1s ease-in-out;
        }

        .slideInUp {
            animation: slideInUp 1s ease-in-out;
        }
    </style>


<body>
    <?php include './Header_Admin.php'; ?>
    <div class="container mt-5 fadeIn">
    <div class="card custom-card slideInUp">
        <div class="card-body">
            <h2 class="card-title">
                <i class="fas fa-hotel me-2 text-info"></i> Listado de Posadas
            </h2>
                <div class="d-flex justify-content-end mb-3">
                    <button type="button" 
                            class="btn btn-success btn-sm d-inline-flex align-items-center" 
                            id="addPosadaButton" 
                            title="Crear Posada" 
                            style="font-size: 16px;">
                        <i class="fas fa-plus me-2"></i> Añadir Posada
                    </button>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    document.getElementById('addPosadaButton').addEventListener('click', function () {
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
                                    window.location.href = '../Memberships.php';
                                }
                            });
                        } else {
                            $('#posadaModal').modal('show');
                        }
                    });
                </script>


                <div class="table-responsive fadeIn">
                    <?php if ($result->num_rows > 0) { ?>
                        <table id="innsTable" class="table table-hover table-striped">
                            <thead>
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
                                        ? "<button class='btn btn-danger btn-sm d-flex align-items-center justify-content-center me-2' style='width: 120px;' data-id='" . $row["id"] . "' data-block='0'>
                                            <i class='fas fa-lock me-2'></i> Bloqueado
                                        </button>"
                                        : "<button class='btn btn-success btn-sm d-flex align-items-center justify-content-center me-2' style='width: 120px;' data-id='" . $row["id"] . "' data-block='1'>
                                            <i class='fas fa-lock-open me-2'></i> Activo
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
                                                    <button type="submit" class="btn btn-warning btn-sm" id="blockPosadaTooltip"
                                                        title="Bloquear/Desbloquear">
                                                        <i class="fas fa-ban" style="font-size: 18px; color: white"></i>
                                                    </button>
                                                </form>
                                                <a href="ver_posada.php?id=<?= $row['id'] ?>" class="btn btn-info" id="verPosadaTooltip">
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

    <script>

    tippy('#addPosadaButton', {
        content: 'Haz clic para añadir un nuevo registro',
        animation: 'scale',
        theme: 'custom',
        placement: 'right', 
    });


    tippy('.btn-primary[data-target="#editModal"]', {
        content: 'Haz clic para editar este registro',
        animation: 'scale',
        theme: 'custom',
        placement: 'right',
    });

    tippy('.btn-primary[data-target="#editModal"]', {
        content: 'Haz clic para editar este registro',
        animation: 'scale',
        theme: 'custom',
        placement: 'right',
    });

    tippy('#verPosadaTooltip', {
        content: 'Ver Detalles de la Posada',
        animation: 'scale',
        theme: 'custom',
        placement: 'right',
    });

    tippy('#blockPosadaTooltip', {
        content: 'Bloquear/Desbloquear la Posada',
        animation: 'scale',
        theme: 'custom',
        placement: 'right',
    });

</script>

    <!-- Modal -->
    <div class="modal fade" id="posadaModal" tabindex="-1" role="dialog" aria-labelledby="posadaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white" id="posadaModalLabel">Registro de una Posada</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="">
                        <input type="hidden" name="action" value="create">
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
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="municipality" class="form-label">Municipio</label>
                            <select class="form-control" id="municipality" name="municipality" required>
                                <option value="">Seleccione un municipio</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="parish" class="form-label">Parroquia</label>
                            <select class="form-control" id="parish" name="parish" required>
                                <option value="">Seleccione una parroquia</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="category" class="form-label">Categoría</label>
                            <select class="form-control" id="category" name="category" required>
                                <option value="">Seleccione una categoría</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quality" class="form-label">Calidad</label>
                            <select class="form-control" name="quality" id="quality" required>
                                <option value="">Seleccione una calidad</option>
                                <option value="Alta">Alta</option>
                                <option value="Media">Media</option>
                                <option value="Baja">Baja</option>
                            </select>
                        </div>

                        <br>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Registrar</button>
                        </div>

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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit-municipality" class="form-label">Municipio</label>
                            <select class="form-control" id="edit-municipality" name="municipality" required>
                                <option value="">Seleccione un municipio</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit-parish" class="form-label">Parroquia</label>
                            <select class="form-control" id="edit-parish" name="parish" required>
                                <option value="">Seleccione una parroquia</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit-category" class="form-label">Categoría</label>
                            <select class="form-control" id="edit-category" name="category" required>
                                <option value="">Seleccione una categoría</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quality" class="form-label">Calidad</label>
                            <select class="form-control" name="quality" id="edit-quality" required>
                                <option value="">Seleccione una calidad</option>
                                <option value="Alta">Alta</option>
                                <option value="Media">Media</option>
                                <option value="Baja">Baja</option>
                            </select>
                        </div>
                        <br>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br> <br>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            <?php if ($message): ?>
                Swal.fire({
                    title: '<?php echo $messageType === "success" ? "Éxito" : "Error"; ?>',
                    text: '<?php echo $message; ?>',
                    icon: '<?php echo $messageType; ?>',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        <?php if ($messageType === "success"): ?>
                            window.location.href = 'get_inns.php';
                        <?php endif; ?>
                    }
                });
            <?php endif; ?>
        });
    </script>

    <script>

        $(document).ready(function () {
            $('#editModal').on('show.bs.modal', function (event) {
                const button = $(event.relatedTarget);
                const stateId = button.data('state_id');
                const municipalityId = button.data('municipality_id');
                const parishId = button.data('parish_id');

                loadStates(function () {
                    $('#edit-state').val(stateId);
                    loadMunicipalities(stateId, function () {
                        $('#edit-municipality').val(municipalityId);
                        loadParishes(municipalityId, function () {
                            $('#edit-parish').val(parishId);
                        });
                    });
                });
            });

            $('#edit-state').on('change', function () {
                const stateId = $(this).val();
                loadMunicipalities(stateId, function () {
                    $('#edit-municipality').val('');
                    $('#edit-parish').html('<option value="">Seleccione una parroquia</option>');
                });
            });

            $('#edit-municipality').on('change', function () {
                const municipalityId = $(this).val();
                loadParishes(municipalityId);
            });
        });


        $(document).ready(function () {
            $('#innsTable').on('click', '.btn-primary[data-target="#editModal"]', function () {
                const id = $(this).data('id');
                const name = $(this).data('name');
                const description = $(this).data('description');
                const email = $(this).data('email');
                const phone = $(this).data('phone');
                const imageUrl = $(this).data('image_url');
                const stateId = $(this).data('state_id');
                const municipalityId = $(this).data('municipality_id');
                const parishId = $(this).data('parish_id');
                const categoryId = $(this).data('category_id');
                const quality = $(this).data('quality');
                $('#edit-id').val(id);
                $('#edit-name').val(name);
                $('#edit-description').val(description);
                $('#edit-email').val(email);
                $('#edit-phone').val(phone);
                $('#edit-image_url').val(imageUrl);
                $('#edit-state').val(stateId);
                $('#edit-municipality').val(municipalityId);
                $('#edit-parish').val(parishId);
                $('#edit-category').val(categoryId);
                $('#edit-quality').val(quality);
                $('#editModal').modal('show');
            });
        });
    </script>

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