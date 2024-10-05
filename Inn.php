<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posada</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <style>


    

.main-content {
    flex: 1;
    margin-right: 20px;
}

.sidebar {
    width: 350px;

    padding: 20px;
    
    position: sticky;
    top: 20px;
    height: 100%;
    overflow-y: auto;
    color: black;
}

.sidebar h3 {
    font-size: 1.5rem;
    margin-bottom: 1rem;
    color: #f8f9fa;
}

.sidebar ul {
    list-style: none;
    padding: 0;
}

.sidebar ul li {
    margin-bottom: 10px;
}

.sidebar ul li a {
    text-decoration: none;
    color: #adb5bd;
    font-size: 1rem;
    transition: color 0.3s ease;
}

.sidebar ul li a:hover {
    color: #ffc107;
}

.recommendation-card {
    background-color: #fff;
    color: white;
    border: 1px solid black; /* Borde delgado de color negro */
    margin-bottom: 1rem;
    border-radius: 8px;
    overflow: hidden;
    transition: transform 0.3s ease;
}



.recommendation-card:hover {
    transform: scale(1.02);
}

.recommendation-card img {
    width: 100%;
    height: 150px;
    object-fit: cover;
}

.recommendation-card .card-body {
    padding: 10px;
}

.recommendation-card .card-title {
    font-size: 1rem;
    margin-bottom: 0.5rem;
}

.recommendation-card .card-text {
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
}

.card {
    border: none;
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
    transition: box-shadow 0.3s ease;
}

.card:hover {
    box-shadow: 0 0 30px rgba(0,0,0,0.4);
}

.card-title {
    font-size: 1.25rem;
    margin-bottom: 0.75rem;
    color: #333;
}

.card-text {
    font-size: 1rem;
    color: #666;
}

.list-unstyled li {
    font-size: 0.95rem;
    color: #888;
    margin-bottom: 0.5rem;
}

h3 {
    font-size: 1.5rem;
    margin-top: 2rem;
    margin-bottom: 1rem;
    color: #333;
}

.text-white-centered {
    color: white;
    text-align: center;
}



    </style>
</head>

<body>
    <?php include './Includes/Header.php'; ?>
    <div class="page-content" itemscope itemtype="http://schema.org/Blog">
        <div class="container">
            <article class="page-article" itemprop="blogPost">
            <?php
                include './config/db.php';

                if (isset($_GET['inn_id']) && !empty($_GET['inn_id'])) {
                    $inn_id = $_GET['inn_id'];

                    // Consulta para obtener la información de la posada específica
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
                        $row = $result_inn_detail->fetch_assoc(); // Obtener la fila de resultados
                        // Mostrar la información de la posada
                        echo '<div class="card mb-3">';
                        echo '<div class="card-body bg-success text-white">';
                        echo '<h2 class="text-center" style="font-size: 24px;"><i class="fas fa-hotel"></i> ' . $row['inn_name'] . '</h2>';
                        echo '</div>';
                        echo '</div>';
                        
                        ?>
                        <div class="card mb-3">
                            <img src="<?php echo $row['inn_image_url']; ?>" class="card-img-top" alt="Posada Image" style="margin-top: 0px; margin-bottom: 0px;">
                            <div class="card-body">
                                <p class="card-text" style="font-size: 18px"><i class="fas fa-info-circle"></i> <?php echo $row['description']; ?></p>
                                <ul class="list-unstyled">
                                    <li style="font-size: 14px"><i class="fas fa-envelope"></i> <span>Email:</span> <?php echo $row['email']; ?></li>
                                    <li style="font-size: 14px"><i class="fas fa-phone"></i> <span>Teléfono:</span> <?php echo $row['phone']; ?></li>
                                    <li style="font-size: 14px"><i class="fas fa-map-marker-alt"></i> <span>Ubicación:</span> <?php echo $row['state_name'] . ', ' . $row['municipality_name'] . ', ' . $row['parish_name']; ?></li>
                                    <li style="font-size: 14px"><i class="fas fa-list"></i> <span>Categoría:</span> <?php echo $row['category_name']; ?></li>
                                </ul>
                            </div>
                        </div>
                        <?php
                        // Consulta SQL para obtener los vehículos de la posada específica
                        $sql_vehicles = "SELECT vehicles.id, vehicles.type, vehicles.brand, vehicles.description, 
                                                 vehicles.price, vehicles.capacity, vehicles.year, vehicles.model, vehicles.registration_plate, 
                                                 vehicles.status, vehicles.image_url, vehicles.invoice
                                          FROM vehicles
                                          WHERE vehicles.inn_id = $inn_id";

                        $result_vehicles = $conn->query($sql_vehicles);

                        if ($result_vehicles->num_rows > 0) {
                            echo '<div class="card mb-3">';
                            echo '<div class="card-body bg-success">';
                            echo '<h3 class="text-center text-white" style="font-size: 24px;" class="card-title"><i class="fas fa-car"></i> Vehículos disponibles</h3>';
                            echo '</div>';
                            echo '</div>';
                            
                            echo '<div class="row">';
                            while ($row = $result_vehicles->fetch_assoc()) {
                                echo '<div class="col-md-6 mb-4">';
                                echo '<div class="card">';
                                echo '<img src="' . $row['image_url'] . '" class="card-img-top" alt="Vehicle Image" style="margin-top: 0px; margin-bottom: 0px;">';
                                echo '<div class="card-body">';
                                echo '<h5 class="card-title" style="font-size: 18px"><i class="fas fa-car"></i> ' . $row['brand'] . ' ' . $row['model'] . '</h5>';
                                echo '<p class="card-text" style="font-size: 16px"><i class="fas fa-info-circle"></i> ' . $row['description'] . '</p>';
                                echo '<ul class="list-unstyled">';
                                echo '<li style="font-size: 14px"><i class="fas fa-calendar-alt"></i> <span>Año:</span> ' . $row['year'] . '</li>';
                                echo '<li style="font-size: 14px"><i class="fas fa-users"></i> <span>Capacidad:</span> ' . $row['capacity'] . '</li>';
                                echo '<li style="font-size: 14px"><i class="fas fa-dollar-sign"></i> <span>Precio:</span> ' . $row['price'] . '</li>';
                                echo '<li style="font-size: 14px"><i class="fas fa-id-card"></i> <span>Placa:</span> ' . $row['registration_plate'] . '</li>';
                                echo '</ul>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                            }
                            echo '</div>';
                        }
                    } else {
                        echo '<p class="text-danger">No se encontró la información de la posada.</p>';
                    }
                } else {
                    echo '<p class="text-danger">ID de la posada no proporcionado.</p>';
                }
                ?>
                <?php
                // Consulta SQL para obtener las habitaciones de la posada específica
                $sql_rooms = "SELECT rooms.id, rooms.room_number, rooms.type, rooms.quality, rooms.image_url, rooms.description, 
                                     rooms.price, rooms.capacity
                              FROM rooms
                              WHERE rooms.inn_id = $inn_id";
                
                $result_rooms = $conn->query($sql_rooms);
                
                if ($result_rooms->num_rows > 0) {
                    echo '<div class="card mb-3">';
                    echo '<div class="card-body bg-success">';
                    echo '<h3 class="text-center text-white" style="font-size: 24px" class="card-title"><i class="fas fa-bed"></i> Habitaciones disponibles</h3>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="row">';
                    while ($row = $result_rooms->fetch_assoc()) {
                        echo '<div class="col-md-6 mb-4">';
                        echo '<div class="card">';
                        echo '<img src="' . $row['image_url'] . '" class="card-img-top" alt="Room Image" style="margin-top: 0px; margin-bottom: 0px;">';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title" style="font-size: 18px"><i class="fas fa-bed"></i>  Habitación ' . $row['room_number'] . '</h5>';
                        echo '<p class="card-text" style="font-size: 16px">' . $row['description'] . '</p>';
                        echo '<ul class="list-unstyled">';
                        echo '<li style="font-size: 14px"><i class="fas fa-star"></i> Calidad: ' . $row['quality'] . '</li>';
                        echo '<li style="font-size: 14px"><i class="fas fa-users"></i> Capacidad: ' . $row['capacity'] . '</li>';
                        echo '<li style="font-size: 14px"><i class="fas fa-dollar-sign"></i> Precio: ' . $row['price'] . '</li>';
                        echo '</ul>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                    echo '</div>';
                } else {
                    echo '<p>No hay habitaciones disponibles para esta posada.</p>';
                }
                ?>
            </article>

            <aside class="sidebar" itemprop="sidebar">
            <div class="card-body bg-success text-white p-3 text-center" style="font-size: 24px;"> 
    <h3 style="color: white;">
        <i class="fas fa-star"></i> Recomendaciones
    </h3>
</div><br>
                <?php
                include './config/db.php';
                $sql_random_inns = "SELECT id, name, image_url, description FROM inns ORDER BY RAND() LIMIT 3";
                $result_random_inns = $conn->query($sql_random_inns);
                if ($result_random_inns->num_rows > 0) {
                    while ($row = $result_random_inns->fetch_assoc()) {
                        echo '<div class="recommendation-card">';
                        echo '<img src="' . $row['image_url'] . '" alt="Posada Image">';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title"><i class="fas fa-hotel"></i> ' . $row['name'] . '</h5>';
                        echo '<p class="card-text"><i class="fas fa-info-circle"></i> ' . substr($row['description'], 0, 70) . '...</p>';
                        echo '<a href="InnDetail.php?inn_id=' . $row['id'] . '" class="btn btn-success" style="font-size: 12px;">¡Consultar Reservación!</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
                $conn->close();
                ?>
            </aside>
        </div>
    </div>

    <?php
include './config/db.php';

if (isset($_GET['inn_id']) && !empty($_GET['inn_id'])) {
    $inn_id = $_GET['inn_id'];

} else {
    $inn_id = null;
}
?>

<div class="card mb-3">
    <div class="card-body">
        <?php if ($inn_id): ?>
            <a href="reservation.php?inn_id=<?php echo $inn_id; ?>" class="btn btn-success" style="color: white; font-size: 14px;">
                <i class="fas fa-calendar-check" style="margin: 5px; font-size: 12px;"></i> Reservar
            </a>
        <?php else: ?>
            <p class="text-danger">ID de la posada no está disponible.</p>
        <?php endif; ?>
    </div>
</div>



    <?php include './Includes/Footer.php'; ?>
</body>

</html>
