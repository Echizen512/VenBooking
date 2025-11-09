<body>
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
    <link href="blog.css" rel="stylesheet">

    <?php include './Includes/Header.php'; ?>


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>



    <main class="container">

        <?php
        include './config/db.php';

        if (isset($_GET['inn_id']) && !empty($_GET['inn_id'])) {
            $inn_id = $_GET['inn_id'];

            $sql_inn_detail = "SELECT inns.id, inns.name AS inn_name, inns.description, inns.email, inns.phone, 
                               states.name AS state_name, municipalities.name AS municipality_name, 
                               parishes.name AS parish_name, categories.name AS category_name,
                               inns.image_url AS inn_image_url
                        FROM inns
                        LEFT JOIN states ON inns.state_id = states.id
                        LEFT JOIN municipalities ON inns.municipality_id = municipalities.id
                        LEFT JOIN parishes ON inns.parish_id = parishes.id
                        LEFT JOIN categories ON inns.category_id = categories.id
                        WHERE inns.id = $inn_id";

            $result_inn_detail = $conn->query($sql_inn_detail);

            if ($result_inn_detail->num_rows > 0) {
                $row = $result_inn_detail->fetch_assoc();
        ?>

                <div class="p-4 p-md-5 mt-4 mb-4 text-white rounded bg-dark"
                    style="background-image: url('<?php echo $row['inn_image_url']; ?>'); background-size: cover; background-position: center;">
                    <div class="col-md-6 px-0"
                        style="background-color: rgba(0, 0, 0, 0.6); padding: 20px; border-radius: 10px;">
                        <h1 class="display-4 fst-italic text-center"><?php echo htmlspecialchars($row['inn_name']); ?></h1>
                        <p class="lead my-3 text-center"><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
                        <p class="lead mb-0">
                            <a href="mailto:<?php echo $row['email']; ?>" class="text-white fw-bold p-4">Contáctanos</a>
                        </p>
                        <small class="d-block mt-3 mx-4">
                            📍
                            <?php echo $row['parish_name'] . ', ' . $row['municipality_name'] . ', ' . $row['state_name']; ?><br>
                            📞 <?php echo $row['phone']; ?> | 🏷️ <?php echo $row['category_name']; ?>
                        </small>
                    </div>
                </div>

        <?php
            } else {
                echo '<div class="alert alert-warning">No se encontró información de la posada.</div>';
            }
        }
        ?>



        <div class="row g-5">
            <div class="col-md-8">

                <?php
                // Consulta SQL para obtener las habitaciones de la posada específica
                $sql_rooms = "SELECT rooms.id, rooms.room_number, rooms.type, rooms.quality, rooms.image_url, rooms.image_url2, rooms.image_url3, rooms.image_url4, rooms.image_url5, rooms.description, 
                     rooms.price, rooms.capacity
              FROM rooms
              WHERE rooms.inn_id = $inn_id";

                $result_rooms = $conn->query($sql_rooms);

                if ($result_rooms->num_rows > 0) {
                    echo '<h3 class="pb-4 mb-4 fst-italic border-bottom"><i class="fas fa-bed text-primary"></i> Habitaciones disponibles</h3>';
                    echo '<div class="row mb-2">';

                    $count = 0;
                    while ($room = $result_rooms->fetch_assoc()) {
                        // Abrir nueva fila cada 2 habitaciones
                        if ($count % 2 === 0 && $count !== 0) {
                            echo '</div><div class="row mb-2">';
                        }

                        echo '<div class="col-md-6">';
                        echo '<div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm" style="min-height: 270px;">';


                        // Columna de texto
                        echo '<div class="col p-3 d-flex flex-column position-static">';
                        echo '<strong class="d-inline-block mb-2 text-success small">Capacidad: ' . $room['capacity'] . '</strong>';
                        echo '<h5 class="mb-1 fs-6">Hab. ' . $room['room_number'] . ' - ' . ucfirst($room['type']) . '</h5>';
                        echo '<div class="mb-1 text-muted small">$. ' . number_format($room['price'], 2, ',', '.') . '</div>';
                        $short_description = mb_strimwidth($room['description'], 0, 90, '...');
                        echo '<p class="card-text mb-auto small">' . htmlspecialchars($short_description) . '</p>';
                        echo '</div>';

                        // Columna de imagen
                        echo '<div class="col-auto d-none d-lg-block">';
                        $thumbnail = !empty($room['image_url']) ? $room['image_url'] : 'https://via.placeholder.com/200x250?text=Sin+imagen';
                        echo '<img src="' . $thumbnail . '" width="200" height="270" style="object-fit: cover;" alt="Imagen de habitación">';
                        echo '</div>';

                        echo '</div>'; // cierre de .row
                        echo '</div>'; // cierre de .col-md-6

                        // Modal con carrusel de imágenes
                        echo '<div class="modal fade" id="roomCarousel' . $room['id'] . '" tabindex="-1" aria-hidden="true">';
                        echo '<div class="modal-dialog modal-lg modal-dialog-centered">';
                        echo '<div class="modal-content">';
                        echo '<div class="modal-header">';
                        echo '<h5 class="modal-title">Imágenes de Habitación ' . $room['room_number'] . '</h5>';
                        echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>';
                        echo '</div>';
                        echo '<div class="modal-body p-0">';
                        echo '<div id="carouselInner' . $room['id'] . '" class="carousel slide" data-bs-ride="carousel">';
                        echo '<div class="carousel-inner">';
                        $images = ['image_url', 'image_url2', 'image_url3', 'image_url4', 'image_url5'];
                        $active = true;
                        foreach ($images as $img_field) {
                            if (!empty($room[$img_field])) {
                                echo '<div class="carousel-item ' . ($active ? 'active' : '') . '">';
                                echo '<img src="' . $room[$img_field] . '" class="d-block w-100" style="height: 500px; object-fit: cover;" alt="Imagen de habitación">';
                                echo '</div>';
                                $active = false;
                            }
                        }
                        echo '</div>';
                        echo '<button class="carousel-control-prev" type="button" data-bs-target="#carouselInner' . $room['id'] . '" data-bs-slide="prev">';
                        echo '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
                        echo '<span class="visually-hidden">Anterior</span>';
                        echo '</button>';
                        echo '<button class="carousel-control-next" type="button" data-bs-target="#carouselInner' . $room['id'] . '" data-bs-slide="next">';
                        echo '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
                        echo '<span class="visually-hidden">Siguiente</span>';
                        echo '</button>';
                        echo '</div>'; // cierre de carousel
                        echo '</div>'; // cierre de modal-body
                        echo '</div>'; // cierre de modal-content
                        echo '</div>'; // cierre de modal-dialog
                        echo '</div>'; // cierre de modal

                        $count++;
                    }

                    echo '</div>'; // cierre de última fila
                }
                ?>

                <?php
                // Consulta SQL para obtener los vehículos de la posada específica
                $sql_vehicles = "SELECT vehicles.id, vehicles.type, vehicles.brand, vehicles.description, 
                         vehicles.price, vehicles.capacity, vehicles.year, vehicles.model, vehicles.registration_plate, 
                         vehicles.status, vehicles.image_url, vehicles.image_url2, vehicles.image_url3, vehicles.image_url4, vehicles.image_url5
                  FROM vehicles
                  WHERE vehicles.inn_id = $inn_id";

                $result_vehicles = $conn->query($sql_vehicles);

                if ($result_vehicles->num_rows > 0) {
                    echo '<h3 class="pb-4 mb-4 fst-italic border-bottom"><i class="fas fa-car text-danger"></i> Vehículos disponibles</h3>';
                    echo '<div class="row mb-2">';

                    $count = 0;
                    while ($vehicle = $result_vehicles->fetch_assoc()) {
                        if ($count % 2 === 0 && $count !== 0) {
                            echo '</div><div class="row mb-2">';
                        }

                        echo '<div class="col-md-6">';
                        echo '<div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm" style="min-height: 320px;">';

                        // Columna de texto
                        echo '<div class="col p-3 d-flex flex-column position-static">';
                        echo '<strong class="d-inline-block mb-2 text-danger small">Capacidad: ' . $vehicle['capacity'] . '</strong>';
                        echo '<h5 class="mb-1 fs-6">' . $vehicle['brand'] . ' ' . $vehicle['model'] . ' (' . $vehicle['year'] . ')</h5>';
                        echo '<div class="mb-1 text-muted small">Bs. ' . number_format($vehicle['price'], 2, ',', '.') . '</div>';
                        $short_desc = mb_strimwidth($vehicle['description'], 0, 90, '...');
                        echo '<p class="card-text mb-auto small">' . htmlspecialchars($short_desc) . '</p>';
                        echo '</div>';

                        // Columna de imagen
                        echo '<div class="col-auto d-none d-lg-block">';
                        $thumb = !empty($vehicle['image_url']) ? $vehicle['image_url'] : 'https://via.placeholder.com/200x320?text=Sin+imagen';
                        echo '<img src="' . $thumb . '" width="200" height="320" style="object-fit: cover;" alt="Imagen de vehículo">';
                        echo '</div>';

                        echo '</div>'; // .row
                        echo '</div>'; // .col-md-6

                        // Modal con carrusel
                        echo '<div class="modal fade" id="vehicleCarousel' . $vehicle['id'] . '" tabindex="-1" aria-hidden="true">';
                        echo '<div class="modal-dialog modal-lg modal-dialog-centered">';
                        echo '<div class="modal-content">';
                        echo '<div class="modal-header">';
                        echo '<h5 class="modal-title">Imágenes de ' . $vehicle['brand'] . ' ' . $vehicle['model'] . '</h5>';
                        echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>';
                        echo '</div>';
                        echo '<div class="modal-body p-0">';
                        echo '<div id="carouselVehicle' . $vehicle['id'] . '" class="carousel slide" data-bs-ride="carousel">';
                        echo '<div class="carousel-inner">';
                        $images = ['image_url', 'image_url2', 'image_url3', 'image_url4', 'image_url5'];
                        $active = true;
                        foreach ($images as $img_field) {
                            if (!empty($vehicle[$img_field])) {
                                echo '<div class="carousel-item ' . ($active ? 'active' : '') . '">';
                                echo '<img src="' . $vehicle[$img_field] . '" class="d-block w-100" style="height: 500px; object-fit: cover;" alt="Imagen de vehículo">';
                                echo '</div>';
                                $active = false;
                            }
                        }
                        echo '</div>';
                        echo '<button class="carousel-control-prev" type="button" data-bs-target="#carouselVehicle' . $vehicle['id'] . '" data-bs-slide="prev">';
                        echo '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
                        echo '<span class="visually-hidden">Anterior</span>';
                        echo '</button>';
                        echo '<button class="carousel-control-next" type="button" data-bs-target="#carouselVehicle' . $vehicle['id'] . '" data-bs-slide="next">';
                        echo '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
                        echo '<span class="visually-hidden">Siguiente</span>';
                        echo '</button>';
                        echo '</div>'; // carousel
                        echo '</div>'; // modal-body
                        echo '</div>'; // modal-content
                        echo '</div>'; // modal-dialog
                        echo '</div>'; // modal

                        $count++;
                    }

                    echo '</div>'; // última fila
                }
                ?>



                <nav class="blog-pagination" aria-label="Pagination">
                    <a href="reservation.php?inn_id=<?php echo $inn_id; ?>" class="btn btn-success"
                        style="color: white; font-size: 14px; padding: 5px 15px; margin-right: 10px; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; font-weight: bold;">
                        <i class="fas fa-calendar-check" style="margin-right: 5px; font-size: 16px;"></i> ¡Reservar
                        Habitación!
                    </a>

                    <!-- Botón de Guardar Posada -->
                    <a href="./PHP/save-inn.php?inn_id=<?php echo $inn_id; ?>" class="btn btn-danger"
                        style="color: white; font-size: 14px; padding: 5px 15px; margin-left: 10px; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; font-weight: bold;">
                        <i class="fas fa-heart" style="margin-right: 5px; font-size: 16px;"></i> ¡Guardar Posada!
                    </a>
                </nav>

            </div>


            <div class="col-md-4">
                <div class="position-sticky" style="top: 2rem;">

                    <div class="card-body text-white p-3 text-center rounded mb-3" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%);">
                        <h4 class="fst-italic mb-0">
                            <i class="fas fa-star text-warning"></i> Posadas Recomendadas
                        </h4>
                    </div>

                    <?php
                    include './config/db.php';
                    $sql_random_inns = "SELECT id, name, image_url, description FROM inns ORDER BY RAND() LIMIT 3";
                    $result_random_inns = $conn->query($sql_random_inns);

                    if ($result_random_inns->num_rows > 0) {
                        while ($row = $result_random_inns->fetch_assoc()) {
                            echo '<div class="row g-0 border rounded overflow-hidden flex-md-row mb-3 shadow-sm position-relative" style="min-height: 140px;">';

                            // Columna de texto
                            echo '<div class="col p-3 d-flex flex-column position-static">';
                            echo '<h6 class="mb-1 fs-6"><i class="fas fa-hotel text-success"></i> ' . htmlspecialchars($row['name']) . '</h6>';
                            $short_desc = mb_strimwidth($row['description'], 0, 90, '...');
                            echo '<p class="mb-2 small">' . htmlspecialchars($short_desc) . '</p>';
                            echo '<a href="Inn.php?inn_id=' . $row['id'] . '" class="stretched-link text-success fw-bold small">Ver detalles</a>';
                            echo '</div>';

                            // Columna de imagen
                            echo '<div class="col-auto d-none d-lg-block">';
                            $thumb = !empty($row['image_url']) ? $row['image_url'] : 'https://via.placeholder.com/120x140?text=Sin+imagen';
                            echo '<img src="' . $thumb . '" width="120" height="140" style="object-fit: cover;" alt="Imagen de posada">';
                            echo '</div>';

                            echo '</div>'; // .row
                        }
                    }
                    $conn->close();
                    ?>




                </div>
            </div>


            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>




            <?php
            include './config/db.php';

            if (isset($_GET['inn_id']) && !empty($_GET['inn_id'])) {
                $inn_id = $_GET['inn_id'];
            } else {
                $inn_id = null;
            }
            ?>


            <?php include './Includes/Footer.php'; ?>
</body>

</html>