<?php
session_start();
include './config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Consulta para obtener la información del usuario incluyendo las nuevas columnas
$sql_user = "SELECT first_name, last_name, profile_type, email, profile_image_url, banner_image_url, youtube_url, facebook_url, twitter_url, instagram_url FROM Profile WHERE id = ?";
$stmt_user = $conn->prepare($sql_user);

if ($stmt_user === false) {
    die('Error al preparar la consulta: ' . $conn->error);
}

$stmt_user->bind_param("i", $user_id);
$stmt_user->execute();
$result_user = $stmt_user->get_result();
$user = $result_user->fetch_assoc();



$sql = "SELECT i.id, i.name AS inn_name, i.description, i.image_url, i.email, i.phone,
        s.name AS state_name, m.name AS municipality_name, p.name AS parish_name, 
        c.name AS category_name, i.status, i.block
        FROM inns i
        LEFT JOIN states s ON i.state_id = s.id
        LEFT JOIN municipalities m ON i.municipality_id = m.id
        LEFT JOIN parishes p ON i.parish_id = p.id
        LEFT JOIN categories c ON i.category_id = c.id
        WHERE i.user_id = ? AND i.status = 0 AND i.block = 0";



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

// Obtener el número de clientes (reservaciones confirmadas)
$sql_clients_count = "SELECT COUNT(*) AS clients_count 
                      FROM reservations r 
                      JOIN inns i ON r.inn_id = i.id 
                      WHERE i.user_id = ? AND r.status = 'Confirmado'";
$stmt_clients_count = $conn->prepare($sql_clients_count);
$stmt_clients_count->bind_param("i", $user_id);
$stmt_clients_count->execute();
$result_clients_count = $stmt_clients_count->get_result();
$clients_count = $result_clients_count->fetch_assoc()['clients_count'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Perfil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./Assets/css/Perfiles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php include './Includes/Header.php'; ?>
    <div class="container">
        <div class="card overflow-hidden">
            <div class="card-body p-0">
                <!-- Imagen del banner -->
                <img src="<?php echo htmlspecialchars($user['banner_image_url']); ?>" style="height: 350px; width: 100%;" alt="Banner" class="img-fluid">

                <div class="row align-items-center">
                    <div class="col-lg-4 order-lg-1 order-2">
                        <div class="d-flex align-items-center justify-content-around m-4">
                            <div class="text-center d-flex flex-column align-items-center">
                                <i class="fas fa-hotel fs-1 d-block mb-3"></i>
                                <h4 class="mb-0 fw-semibold lh-1">
                                    <?php
                                    // Obtener el número de posadas
                                    $sql_inn_count = "SELECT COUNT(*) AS inn_count FROM inns WHERE user_id = ?";
                                    $stmt_inn_count = $conn->prepare($sql_inn_count);
                                    $stmt_inn_count->bind_param("i", $user_id);
                                    $stmt_inn_count->execute();
                                    $result_inn_count = $stmt_inn_count->get_result();
                                    $inn_count = $result_inn_count->fetch_assoc()['inn_count'];
                                    echo $inn_count;
                                    ?>
                                </h4>
                                <p class="mb-0 fs-4">Posadas</p>
                            </div>
                            <div class="text-center d-flex flex-column align-items-center">
                                <i class="fas fa-users fs-1 d-block mb-3"></i>
                                <h4 class="mb-0 fw-semibold lh-1"><?php echo $clients_count; ?></h4>
                                <p class="mb-0 fs-4">Clientes</p>
                            </div>
                            <div class="text-center d-flex flex-column align-items-center">
                                <i class="fas fa-star fs-1 d-block mb-3"></i>
                                <h4 class="mb-0 fw-semibold lh-1">4.9/5</h4>
                                <p class="mb-0 fs-4">Valoración</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 mt-n3 order-lg-2 order-1">
                        <div class="mt-n5">
                            <div class="d-flex align-items-center justify-content-center mb-2">
                                <div class="linear-gradient d-flex align-items-center justify-content-center rounded-circle" style="width: 110px; height: 110px;">
                                    <div class="border border-4 border-white d-flex align-items-center justify-content-center rounded-circle overflow-hidden" style="width: 100px; height: 100px;">
                                        <img src="<?php echo htmlspecialchars($user['profile_image_url']); ?>" alt="Profile Image" class="w-100 h-100">
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <h5 class="fs-5 mb-0 fw-semibold"><?php echo htmlspecialchars($user['first_name']) . ' ' . htmlspecialchars($user['last_name']); ?></h5>
                                <p class="mb-0 fs-4"><?php echo htmlspecialchars($user['profile_type']); ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 order-last">
                        <ul class="list-unstyled d-flex align-items-center justify-content-center justify-content-lg-start my-3 gap-4">
                            <li class="position-relative">
                                <a class="text-white d-flex align-items-center justify-content-center bg-primary p-3 fs-3 rounded-circle shadow-lg" href="<?php echo htmlspecialchars($user['facebook_url']); ?>" target="_blank" style="width: 50px; height: 50px;">
                                    <i class="fab fa-facebook"></i>
                                </a>
                            </li>
                            <li class="position-relative">
                                <a class="text-white d-flex align-items-center justify-content-center bg-info p-3 fs-3 rounded-circle shadow-lg" href="<?php echo htmlspecialchars($user['twitter_url']); ?>" target="_blank" style="width: 50px; height: 50px;">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                            <li class="position-relative">
                                <a class="text-white d-flex align-items-center justify-content-center bg-danger p-3 fs-3 rounded-circle shadow-lg" href="<?php echo htmlspecialchars($user['youtube_url']); ?>" target="_blank" style="width: 50px; height: 50px;">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            </li>
                            <li class="position-relative">
                                <a class="text-white d-flex align-items-center justify-content-center bg-gradient p-3 fs-3 rounded-circle shadow-lg" href="<?php echo htmlspecialchars($user['instagram_url']); ?>" target="_blank" style="width: 50px; height: 50px; background-color: #E1306C;">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-friends" role="tabpanel" aria-labelledby="pills-friends-tab" tabindex="0">

        <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-friends" role="tabpanel" aria-labelledby="pills-friends-tab" tabindex="0">
        <div class="row justify-content-center mt-5"> 
            <div class="col-12 text-center">
                <h2 class="mb-4 text-success" style="font-size: 2.5rem;"> 
                    <i class="fas fa-hotel"></i> Posadas Activas
                </h2>
            </div>
        </div>

        <div class="row justify-content-center">
    <?php

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id); 
    $stmt->execute();
    $result = $stmt->get_result();


    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="col-sm-6 col-lg-4 d-flex justify-content-center">';
            echo '<div class="card hover-img text-center" style="width: 30rem; margin: 30px;">';  
            echo '<div class="card-body p-4 border-bottom">';
            echo '<img src="'.htmlspecialchars($row["image_url"]).'" alt="Inn Image" class="rounded-circle mb-3">';
            echo '<h5 class="fw-semibold mb-2">'.htmlspecialchars($row["inn_name"]).'</h5>';
            echo '<span class="text-muted">'.htmlspecialchars($row["category_name"]).'</span>';
            echo '</div>';
            echo '<div class="p-3 d-flex justify-content-center">';
            echo '<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#viewInnModal" onclick="viewInnDetails('.htmlspecialchars(json_encode($row)).')" style="font-size: 1.2rem; padding: 0.75rem 1.5rem;">';
            echo '<i class="fas fa-eye" style="margin-right: 0.5rem;"></i> Visualizar';
            echo '</button>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<div class="col-12 text-center">No hay posadas registradas.</div>';
    }
    ?>
</div>

<div class="row justify-content-center mt-5">
    <div class="col-12 text-center">
        <h2 class="mb-4 text-primary" style="font-size: 2.5rem;">
            <i class="fas fa-calendar-check"></i> Reservaciones
        </h2>
    </div>
</div>

<div class="row justify-content-center">
    <?php
    $sql_reservations = "SELECT r.id, r.inn_id, r.start_date, r.end_date, r.payment_method_id, r.receipt_path, r.codigo_referencia, r.status, r.user_id, i.name AS inn_name, i.image_url
                         FROM reservations r
                         JOIN inns i ON r.inn_id = i.id
                         WHERE r.user_id = ?";
    $stmt_reservations = $conn->prepare($sql_reservations);
    $stmt_reservations->bind_param("i", $user_id);
    $stmt_reservations->execute();
    $result_reservations = $stmt_reservations->get_result();

    if ($result_reservations->num_rows > 0) {
        while ($row = $result_reservations->fetch_assoc()) {
            $status_color = '';
            switch ($row['status']) {
                case 'En Espera':
                    $status_color = 'bg-primary'; // Azul
                    break;
                case 'Confirmado':
                    $status_color = 'bg-success'; // Verde
                    break;
                case 'Cancelado':
                    $status_color = 'bg-danger'; // Rojo
                    break;
            }

            // Formatear las fechas
            $start_date = date('d/m/Y', strtotime($row["start_date"]));
            $end_date = date('d/m/Y', strtotime($row["end_date"]));

            echo '<div class="col-sm-6 col-lg-4 d-flex justify-content-center mb-4">';
            echo '<div class="card" style="width: 30rem;">';
            echo '<img src="'.htmlspecialchars($row["image_url"]).'" class="card-img-top" alt="Inn Image">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title text-center font-weight-bold">'.htmlspecialchars($row["inn_name"]).'</h5>';
            echo '<p class="card-text">Desde: '.htmlspecialchars($start_date).' Hasta: '.htmlspecialchars($end_date).'</p>';
            echo '<p class="badge '.$status_color.' text-white">'.$row["status"].'</p>';
            echo '<div class="d-flex justify-content-between mt-3">';
            echo '<a href="chat.php?user_id='.htmlspecialchars($row["user_id"]).'" class="btn btn-primary" style="color: white;">Contactar</a>';
            echo '<a href="generate_pdf_report.php?reservation_id='.htmlspecialchars($row["id"]).'" class="btn btn-primary" style="color: white;">Ver Factura</a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<div class="col-12 text-center">No hay reservaciones registradas.</div>';
    }
    ?>
</div>



        <div class="text-center mt-6">
            <div class="btn-group">
                <a href="./Includes/get_inns.php" class="btn btn-success" style="color: #ffffff;">Gestionar Posadas</a>
                <button type="button" class="btn btn-custom-outline-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal"><i class="fas fa-edit me-2"></i> Editar Perfil</button>
            </div>
        </div>

    <br><br>
    
    <?php include './Includes/Footer.php'; ?>


<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProfileModalLabel">Editar Perfil</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="./Includes/update_profile.php" method="post">
                        <div class="modal-body">
                            <div class="mb-3 text-left">
                                <label for="first_name" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required>
                            </div>
                            <div class="mb-3 text-left">
                                <label for="last_name" class="form-label">Apellido</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required>
                            </div>
                            <div class="mb-3 text-left">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                            </div>
                            <div class="mb-3 text-left">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password">
                                <div class="form-text">Dejar en blanco si no deseas cambiar la contraseña.</div>
                            </div>
                            <div class="mb-3 text-left">
                                <label for="profile_image_url" class="form-label">URL de la imagen de perfil</label>
                                <input type="text" class="form-control" id="profile_image_url" name="profile_image_url" value="<?php echo htmlspecialchars($user['profile_image_url']); ?>">
                            </div>
                            <div class="mb-3 text-left">
                                <label for="banner_image_url" class="form-label">URL de la imagen de banner</label>
                                <input type="text" class="form-control" id="banner_image_url" name="banner_image_url" value="<?php echo htmlspecialchars($user['banner_image_url']); ?>">
                            </div>
                            <div class="mb-3 text-left">
                                <label for="youtube_url" class="form-label">YouTube URL</label>
                                <input type="text" class="form-control" id="youtube_url" name="youtube_url" value="<?php echo htmlspecialchars($user['youtube_url']); ?>">
                            </div>
                            <div class="mb-3 text-left">
                                <label for="facebook_url" class="form-label">Facebook URL</label>
                                <input type="text" class="form-control" id="facebook_url" name="facebook_url" value="<?php echo htmlspecialchars($user['facebook_url']); ?>">
                            </div>
                            <div class="mb-3 text-left">
                                <label for="twitter_url" class="form-label">Twitter URL</label>
                                <input type="text" class="form-control" id="twitter_url" name="twitter_url" value="<?php echo htmlspecialchars($user['twitter_url']); ?>">
                            </div>
                            <div class="mb-3 text-left">
                                <label for="instagram_url" class="form-label">Instagram URL</label>
                                <input type="text" class="form-control" id="instagram_url" name="instagram_url" value="<?php echo htmlspecialchars($user['instagram_url']); ?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Guardar Cambios</button>
                            <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        
    <div class="modal fade" id="viewInnModal" tabindex="-1" aria-labelledby="viewInnModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-3" id="viewInnModalLabel">
                    <i class="fas fa-hotel me-3 fs-2"></i>Detalles de la Posada
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: black;"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <img id="modal-inn-image" src="" class="img-fluid rounded-3" alt="">
                </div>
                <ul class="list-group list-group-flush fs-5">
                    <li class="list-group-item">
                        <strong><i class="fas fa-hotel me-2 fs-4"></i> Nombre:</strong> 
                        <span id="modal-inn-name"></span>
                    </li>
                    <li class="list-group-item">
                        <strong><i class="fas fa-align-left me-2 fs-4"></i> Descripción:</strong> 
                        <span id="modal-inn-description"></span>
                    </li>
                    <li class="list-group-item">
                        <strong><i class="fas fa-envelope me-2 fs-4"></i> Email:</strong> 
                        <span id="modal-inn-email"></span>
                    </li>
                    <li class="list-group-item">
                        <strong><i class="fas fa-phone me-2 fs-4"></i> Teléfono:</strong> 
                        <span id="modal-inn-phone"></span>
                    </li>
                    <li class="list-group-item">
                        <strong><i class="fas fa-map-marker-alt me-2 fs-4"></i> Estado:</strong> 
                        <span id="modal-state-name"></span>
                    </li>
                    <li class="list-group-item">
                        <strong><i class="fas fa-map-marked-alt me-2 fs-4"></i> Municipio:</strong> 
                        <span id="modal-municipality-name"></span>
                    </li>
                    <li class="list-group-item">
                        <strong><i class="fas fa-map-pin me-2 fs-4"></i> Parroquia:</strong> 
                        <span id="modal-parish-name"></span>
                    </li>
                    <li class="list-group-item">
                        <strong><i class="fas fa-tags me-2 fs-4"></i> Categoría:</strong> 
                        <span id="modal-category-name"></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function viewInnDetails(inn) {
            document.getElementById('modal-inn-image').src = inn.image_url;
            document.getElementById('modal-inn-name').innerText = inn.inn_name;
            document.getElementById('modal-inn-description').innerText = inn.description;
            document.getElementById('modal-inn-email').innerText = inn.email;
            document.getElementById('modal-inn-phone').innerText = inn.phone;
            document.getElementById('modal-state-name').innerText = inn.state_name;
            document.getElementById('modal-municipality-name').innerText = inn.municipality_name;
            document.getElementById('modal-parish-name').innerText = inn.parish_name;
            document.getElementById('modal-category-name').innerText = inn.category_name;
        }
    </script>



</body>
</html>
