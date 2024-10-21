<?php
session_start();
include './config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$sql_inns = "SELECT i.id, i.name AS inn_name, i.description, i.image_url, i.email, i.phone, 
            s.name AS state_name, m.name AS municipality_name, p.name AS parish_name, c.name AS category_name
        FROM inns i
        LEFT JOIN states s ON i.state_id = s.id
        LEFT JOIN municipalities m ON i.municipality_id = m.id
        LEFT JOIN parishes p ON i.parish_id = p.id
        LEFT JOIN categories c ON i.category_id = c.id
        WHERE i.id IN (1, 2, 3)";

$result_inns = $conn->query($sql_inns);

$sql_rooms = "SELECT rooms.id, rooms.room_number, rooms.type, rooms.quality, rooms.image_url, rooms.description, 
            rooms.price, rooms.capacity, inns.name AS inn_name, inns.image_url AS inn_image_url, 
            inns.description AS inn_description
        FROM rooms
        LEFT JOIN inns ON rooms.inn_id = inns.id";

$result_rooms = $conn->query($sql_rooms);

?>

<!DOCTYPE html>
<html>

<head>
    <title>VenBooking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

    <?php
    include './Includes/Header.php';
    include './Includes/banner.php';
    ?>

    <div class="page-heading">
        <div class="container">
            <h2><i class="fas fa-hotel"></i> Posadas Populares</h2>
        </div>
    </div>

    <section class="course-listing-page">
        <div class="container">
            <div class="row">
                <?php
                if ($result_inns->num_rows > 0) {
                    while ($row = $result_inns->fetch_assoc()) {
                        echo '
                    <div class="col-md-5 grid-item" data-category="' . strtolower($row['category_name']) . '">
                        <div class="card custom-card" style="margin-bottom: 30px; margin-right: 55px; height: 450px;">
                            <div class="img-wrap">
                                <img src="' . $row['image_url'] . '" alt="Posada ' . $row['inn_name'] . '" class="img-fluid" style="height: 250px; object-fit: cover;">
                            </div>
                            <div class="card-body">
                                <h2 class="card-title" style="font-size: 16px;"><i class="fas fa-bed"></i> ' . $row['inn_name'] . '</h2>
                                <p class="card-text"><i class="fas fa-info-circle"></i> ' . $row['description'] . '</p>
                                <a href="Inn.php?inn_id=' . $row['id'] . '" class="btn btn-success text-white my-2" style="height: 50px; padding: 10px 20px; font-size: 14px;">
                                    <i class="fas fa-calendar-check" style="margin-right: 8px;"></i> ¡Consultar Reservación!
                                </a>
                            </div>
                        </div>
                    </div>';
                    }
                } else {
                    echo "<p><i class='fas fa-exclamation-circle'></i> No se encontraron resultados.</p>";
                }
                $conn->close();
                ?>
            </div>
        </div>
    </section>

    <?php
    include './Includes/Info.php';
    include './Includes/Gallery.php';
    include './Includes/Destinations.php';
    include './Includes/VenBoocking.php';
    include './Includes/Footer.php';
    ?>

</body>

</html>