<?php
session_start();
include './config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql_user = "SELECT first_name, last_name, profile_type, email, profile_image_url, banner_image_url, membership_type, membership_start_date, membership_end_date FROM Profile WHERE id = ?";
$stmt_user = $conn->prepare($sql_user);

if ($stmt_user === false) {
    die('Error al preparar la consulta: ' . $conn->error);
}

$stmt_user->bind_param("i", $user_id);
$stmt_user->execute();
$result_user = $stmt_user->get_result();
$user = $result_user->fetch_assoc();

$sql_reservations_count = "SELECT COUNT(*) AS reservations_count FROM reservations WHERE user_id = ?";
$stmt_reservations_count = $conn->prepare($sql_reservations_count);

if ($stmt_reservations_count === false) {
    die('Error al preparar la consulta: ' . $conn->error);
}

$stmt_reservations_count->bind_param("i", $user_id);
$stmt_reservations_count->execute();
$result_reservations_count = $stmt_reservations_count->get_result();
$reservations_count = $result_reservations_count->fetch_assoc()['reservations_count'];

$sql_favorite_inns_count = "SELECT COUNT(*) AS favorite_inns_count FROM user_favorite_inns WHERE user_id = ?";
$stmt_favorite_inns_count = $conn->prepare($sql_favorite_inns_count);

if ($stmt_favorite_inns_count === false) {
    die('Error al preparar la consulta: ' . $conn->error);
}

$stmt_favorite_inns_count->bind_param("i", $user_id);
$stmt_favorite_inns_count->execute();
$result_favorite_inns_count = $stmt_favorite_inns_count->get_result();
$favorite_inns_count = $result_favorite_inns_count->fetch_assoc()['favorite_inns_count'];

$sql_favorite_inns = "SELECT uf.id, i.name AS inn_name, i.description, i.image_url, c.name AS category_name 
                    FROM user_favorite_inns uf 
                    JOIN inns i ON uf.inn_id = i.id 
                    LEFT JOIN categories c ON i.category_id = c.id 
                    WHERE uf.user_id = ?";
$stmt_favorite_inns = $conn->prepare($sql_favorite_inns);

if ($stmt_favorite_inns === false) {
    die('Error al preparar la consulta: ' . $conn->error);
}

$stmt_favorite_inns->bind_param("i", $user_id);
$stmt_favorite_inns->execute();
$result_favorite_inns = $stmt_favorite_inns->get_result();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Perfil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./Assets/css/Perfiles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="./Assets/css/Profile.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<style>
.form-label {
    font-size: 14px;
}

.form-text {
    font-size: 14px;
}
</style>

<body>
    <?php include './Includes/Header.php'; ?>
    <div class="container p-0" style="max-width: 100%">
        <div class="card overflow-hidden p-0">
            <div class="card-body p-0">
                <img src="<?php echo isset($user['banner_image_url']) && !empty($user['banner_image_url']) ? htmlspecialchars($user['banner_image_url']) : 'https://c.wallhere.com/photos/64/fc/3840x2160_px_animals_artwork_Clear_Sky_Deer_digital_art_drawing_Firewatch-516653.jpg!d'; ?>"
                    alt="Banner Image" class="w-100" style="height: 300px;">
                <div class="row align-items-center text-center">
                    <!-- Ícono izquierdo -->
                    <div class="col-lg-4 col-6">
                        <div class="d-flex flex-column align-items-center">
                            <i class="fas fa-calendar-check fs-1 d-block mb-3 text-primary"></i>
                            <h4 class="mb-0 fw-semibold lh-1" style="font-size: 1rem;">
                                <?php echo $reservations_count; ?>
                            </h4>
                            <p class="mb-0">Reservaciones</p>
                        </div>
                    </div>

                    <!-- Foto de perfil en el centro -->
                    <div class="col-lg-4 col-12">
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="linear-gradient d-flex align-items-center justify-content-center rounded-circle"
                                style="width: 110px; height: 110px;">
                                <div class="border border-4 border-white rounded-circle overflow-hidden"
                                    style="width: 100px; height: 100px;">
                                    <img src="<?php echo isset($user['profile_image_url']) && !empty($user['profile_image_url']) ? htmlspecialchars($user['profile_image_url']) : 'https://th.bing.com/th/id/R.8dff49985d0d8afa53751d9ba8907aed?rik=7clxEmBk65lU2A&pid=ImgRaw&r=0'; ?>"
                                        alt="Profile Image" class="w-100 h-100">
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-2">
                            <h5 class="mb-0 fw-semibold">
                                <?php echo htmlspecialchars($user['first_name']) . ' ' . htmlspecialchars($user['last_name']); ?>
                            </h5>
                            <p class="mb-4"><?php echo htmlspecialchars($user['profile_type']); ?></p>
                        </div>
                    </div>

                    <!-- Ícono derecho -->
                    <div class="col-lg-4 col-6">
                        <div class="d-flex flex-column align-items-center">
                            <i class="fas fa-heart fs-1 d-block mb-3 text-danger"></i>
                            <h4 class="mb-0 fw-semibold lh-1" style="font-size: 1rem;">
                                <?php echo $favorite_inns_count; ?>
                            </h4>
                            <p class="mb-0">Posadas Guardadas</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-6">
                <div class="btn-group">
                    <button type="button" class="btn btn-custom-outline-secondary p-2" data-bs-toggle="modal"
                        style="font-size: 14px;" data-bs-target="#editProfileModal">
                        <i class="fas fa-edit"></i> Editar Perfil
                    </button>
                </div>
            </div>

            <div class="row justify-content-center mt-5">
                <div class="col-12 text-center">
                    <h2 class="mb-2 text-success" style="font-size: 2.5rem;">
                        <i class="fas fa-home"></i> Posadas Guardadas
                    </h2>
                </div>
            </div>
            <div class="tab-pane fade show active mt-4">
                <div class="container p-4 rounded">
                    <?php if ($result_favorite_inns->num_rows > 0) { ?>
                    <table class="table table-bordered table-hover">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th class="text-center" style="font-size: 14px;">Imagen</th>
                                <th class="text-center" style="font-size: 14px;">Nombre</th>
                                <th class="text-center" style="font-size: 14px;">Categoría</th>
                                <th class="text-center" style="font-size: 14px;">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result_favorite_inns->fetch_assoc()) { ?>
                            <tr>
                                <td style="text-align: center;">
                                    <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="Inn Image"
                                        class="posada-img rounded-circle mb-3" style="width: 50px; height: 50px;">
                                </td>
                                <td class="text-center" style="font-size: 14px;">
                                    <?php echo htmlspecialchars($row['inn_name']); ?></td>
                                <td class="text-center" style="font-size: 14px;">
                                    <?php echo htmlspecialchars($row['category_name']); ?></td>
                                <td class="text-center" style="font-size: 14px;">
                                    <a href="inn.php?inn_id=<?php echo $row['id']; ?>"
                                        class="btn btn-outline-success mt-3"
                                        style="font-size: 14px; border-radius: 20px; width: 50%;">
                                        <i class="fas fa-link me-2"></i> ¡Ver Detalles!
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?php } else { ?>
                    <div class="col-12 text-center"
                        style="font-size: 2rem; color:rgb(136, 176, 211); padding: 1rem; border: 1px solid #e0e0e0; border-radius: 5px; background-color: #f8f9fa; margin-top: 1rem;">
                        No tienes posadas guardadas.
                    </div>
                    <?php } ?>
                </div>
            </div>


            <?php
                $sql_reservations = "SELECT r.id, r.inn_id, r.start_date, r.end_date, r.payment_method_id, r.receipt_path, r.codigo_referencia, r.status, i.name AS inn_name, i.image_url, i.user_id AS inn_owner_id
                FROM reservations r
                JOIN inns i ON r.inn_id = i.id
                WHERE r.user_id = ?";
                $stmt_reservations = $conn->prepare($sql_reservations);
                $stmt_reservations->bind_param("i", $user_id);
                $stmt_reservations->execute();
                $result_reservations = $stmt_reservations->get_result();
                ?>

            <div class="row justify-content-center mt-5">
                <div class="col-12 text-center">
                    <h2 class="mb-4 text-primary" style="font-size: 2.5rem;">
                        <i class="fas fa-calendar-check"></i> Reservaciones
                    </h2>
                </div>
            </div>
            <div class="row justify-content-center" style="margin: 50px;">
                <?php
    if ($result_reservations->num_rows > 0) {
    ?>
                <table class="table table-bordered table-hover">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th class="text-center" style="font-size: 14px;">Imagen</th>
                            <th class="text-center" style="font-size: 14px;">Nombre</th>
                            <th class="text-center" style="font-size: 14px;">Desde</th>
                            <th class="text-center" style="font-size: 14px;">Hasta</th>
                            <th class="text-center" style="font-size: 14px;">Status</th>
                            <th class="text-center" style="font-size: 14px;">Contacto</th>
                            <th class="text-center" style="font-size: 14px;">Factura</th>
                            <th class="text-center" style="font-size: 14px;">Valoración</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
            // Consulta para verificar si existe una valoración para una reservación
            $sql_reviews = "SELECT reservation_id FROM reviews WHERE reservation_id = ?";
            $stmt_reviews = $conn->prepare($sql_reviews);

            while ($row = $result_reservations->fetch_assoc()) {
                // Determinar color del estado
                $status_color = '';
                switch ($row['status']) {
                    case 'En Espera':
                        $status_color = 'bg-primary';
                        break;
                    case 'Confirmado':
                        $status_color = 'bg-success';
                        break;
                    case 'Cancelado':
                        $status_color = 'bg-danger';
                        break;
                }

                // Formatear fechas
                $start_date = date('d/m/Y', strtotime($row["start_date"]));
                $end_date = date('d/m/Y', strtotime($row["end_date"]));

                // Verificar si la reservación ya tiene valoración
                $stmt_reviews->bind_param("i", $row['id']);
                $stmt_reviews->execute();
                $result_reviews = $stmt_reviews->get_result();
                $has_review = $result_reviews->num_rows > 0;
            ?>
                        <tr>
                            <td style="text-align: center;">
                                <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="Inn Image"
                                    class="posada-img rounded-circle mb-3" style="width: 50px; height: 50px;">
                            </td>
                            <td class="text-center" style="font-size: 14px;">
                                <?php echo htmlspecialchars($row['inn_name']); ?></td>
                            <td class="text-center" style="font-size: 14px;"><?php echo $start_date; ?></td>
                            <td class="text-center" style="font-size: 14px;"><?php echo $end_date; ?></td>
                            <td class="text-center" style="font-size: 14px;">
                                <span class="badge <?php echo $status_color; ?> text-white"
                                    style="font-size: 14px; padding: 5px; border-radius: 20px;">
                                    <?php echo htmlspecialchars($row["status"]); ?>
                                </span>
                            </td>
                            <td class="text-center" style="font-size: 14px;">
                                <a href="chat.php?user_id=<?php echo htmlspecialchars($row['inn_owner_id']); ?>"
                                    class="btn btn-outline-primary text-primary"
                                    style="font-size: 14px; border-radius: 20px; width: 50%; margin-left: 70px;">
                                    <i class="fas fa-comments mr-2"></i> Contactar
                                </a>
                            </td>
                            <td class="text-center" style="font-size: 14px;">
                                <a href="generate_pdf_report.php?reservation_id=<?php echo htmlspecialchars($row['id']); ?>"
                                    class="btn btn-outline-success text-success"
                                    style="font-size: 14px; border-radius: 20px; width: 60%;">
                                    <i class="fas fa-file-pdf me-2"></i> Ver Factura
                                </a>
                            </td>
                            <td class="text-center align-middle" style="vertical-align: middle;">
                                <?php if (!$has_review) { ?>
                                <form action="submit_review.php" method="POST"
                                    style="display: inline-block; text-align: center;">
                                    <input type="hidden" name="reservation_id"
                                        value="<?php echo htmlspecialchars($row['id']); ?>">
                                    <div class="form-group mb-2"
                                        style="display: flex; justify-content: center; align-items: center;">
                                        <select id="rating-<?php echo $row['id']; ?>" name="rating"
                                            class="custom-select"
                                            style="width: 100px; font-size: 14px; border-radius: 5px;" required>
                                            <option value="" disabled selected>Elige</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary"
                                        style="font-size: 14px; padding: 10px 20px; border-radius: 30px; background: linear-gradient(90deg, #007bff, #0056b3); box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
                                        Enviar <i class="fas fa-paper-plane ml-2"></i>
                                    </button>
                                </form>
                                <?php } else { ?>
                                <span class="badge badge-success"
                                    style="font-size: 14px; padding: 10px; border-radius: 20px;">
                                    <i class="fas fa-check-circle"></i> Valoración registrada
                                </span>
                                <?php } ?>
                            </td>

                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php
    } else {
        echo '<div class="col-12 text-center">No hay reservaciones registradas.</div>';
    }
    ?>
            </div>


        </div>


        <?php include './Includes/Footer.php'; ?>

        <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-center">
                        <h5 class="modal-title text-white p-2" style="font-size: 16px;" id="editProfileModalLabel">
                            Editar Perfil</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="./Includes/update_profile.php" method="post">
                        <div class="modal-body">
                            <div class="mb-3 text-left">
                                <label for="first_name" class="form-label">Nombre:</label>
                                <input type="text" class="form-control" id="first_name" name="first_name"
                                    value="<?php echo htmlspecialchars($user['first_name']); ?>" required>
                            </div>
                            <div class="mb-3 text-left">
                                <label for="last_name" class="form-label">Apellido:</label>
                                <input type="text" class="form-control" id="last_name" name="last_name"
                                    value="<?php echo htmlspecialchars($user['last_name']); ?>" required>
                            </div>
                            <div class="mb-3 text-left">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="<?php echo htmlspecialchars($user['email']); ?>" required>
                            </div>
                            <div class="mb-3 text-left">
                                <label for="password" class="form-label">Contraseña:</label>
                                <input type="password" class="form-control" id="password" name="password">
                                <div class="form-text">Dejar en blanco si no deseas cambiar la contraseña.</div>
                            </div>
                            <div class="mb-3 text-left">
                                <label for="profile_image_url" class="form-label">URL de la Foto de
                                    Perfil:</label>
                                <input type="text" class="form-control" id="profile_image_url" name="profile_image_url"
                                    value="<?php echo htmlspecialchars($user['profile_image_url']); ?>">
                            </div>
                            <div class="mb-3 text-left">
                                <label for="banner_image_url" class="form-label">URL del Banner:</label>
                                <input type="text" class="form-control" id="banner_image_url" name="banner_image_url"
                                    value="<?php echo htmlspecialchars($user['banner_image_url']); ?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Guardar Cambios</button>
                            <button type="button" class="btn btn-outline-primary"
                                data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editProfileModal = document.getElementById('editProfileModal');
            const openModalButtons = document.querySelectorAll(
                '.open-edit-profile'); // Asegúrate de usar esta clase en el botón

            openModalButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const userData = JSON.parse(this.getAttribute('data-user'));
                    document.getElementById('first_name').value = userData.first_name;
                    document.getElementById('last_name').value = userData.last_name;
                    document.getElementById('email').value = userData.email;
                    document.getElementById('profile_image_url').value = userData
                        .profile_image_url;

                    const modal = new bootstrap.Modal(editProfileModal);
                    modal.show();
                });
            });
        });
        </script>

</body>

</html>