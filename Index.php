<?php
session_start();
include './config/db.php';

$headerFile = isset($_SESSION['user_id']) ? './Includes/Header.php' : './Includes/Header2.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; 
    $sql = "SELECT profile_type FROM Profile WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($profile_type);
        $stmt->fetch();
        $stmt->close();

        if ($profile_type === "Empresa" && basename($_SERVER['PHP_SELF']) !== 'Inicio.php') {
            header("Location: Includes/Inicio.php");
            exit;
        } 
        if ($profile_type === "Turista" && basename($_SERVER['PHP_SELF']) !== 'index.php') {
            header("Location: index.php");
            exit;
        }
    } else {
        echo "Error al preparar la consulta.";
    }
}


$sql_inns = "SELECT i.id, i.name AS inn_name, i.description, i.image_url, i.email, i.phone, 
            s.name AS state_name, m.name AS municipality_name, p.name AS parish_name, c.name AS category_name, 
            i.quality
        FROM inns i
        LEFT JOIN states s ON i.state_id = s.id
        LEFT JOIN municipalities m ON i.municipality_id = m.id
        LEFT JOIN parishes p ON i.parish_id = p.id
        LEFT JOIN categories c ON i.category_id = c.id
        WHERE i.id IN (1, 2, 3)";

$result_inns = $conn->query($sql_inns);

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


<style>
   
.card-body .btn {
    font-size: 20px;
    font-weight: bold;
    width: 100%;
    text-align: center;
    padding: 15px;
    margin-top: 10px;
}


.card-body .btn i {
    margin-right: 8px;
}


.filter-btn {
    font-size: 18px;
    font-weight: bold;
    width: 100%;
}

</style>

<body>

    <?php
    include $headerFile;
    include './Components/banner.php';
    ?>

    <div class="page-heading">
        <div class="container">
            <h2><i class="fas fa-hotel text-success"></i> Posadas Populares</h2>
        </div>
    </div>

    <section class="course-listing-page">
        <div class="container">
            <div class="row">
                <?php
                if ($result_inns->num_rows > 0) {
                    while ($row = $result_inns->fetch_assoc()) {
                        $category_class = strtolower(str_replace(' ', '-', $row['category_name']));
                        $quality_class = strtolower($row['quality']);

                        echo '
                        <div class="col-md-4 grid-item ' . $category_class . ' ' . $quality_class . '" data-category="' . $category_class . ' ' . $quality_class . '">
                            <div class="custom-card" style="height: 550px;">
                                <div class="img-wrap">
                                    <img src="' . $row['image_url'] . '" alt="Posada ' . $row['inn_name'] . '" class="img-fluid" style="height: 250px; object-fit: cover;">
                                </div>
                                <div class="card-body">
                                    <h2 class="card-title" style="font-size: 16px;"><i class="fas fa-bed text-primary"></i> ' . $row['inn_name'] . '</h2>
                                    <p class="card-text"><i class="fas fa-info-circle"></i> ' . $row['description'] . '</p>
                                    
                                    <div class="card-meta">
                                        <p style="font-size: 14px;"><i class="fas fa-tag text-primary"></i> ' . $row['state_name'] . '</p>
                                        <p style="font-size: 14px;"><i class="fas fa-map-marker-alt text-danger"></i> ' . $row['municipality_name'] . '</p>
                                        <p style="font-size: 14px;"><i class="fas fa-location-arrow text-success"></i> ' . $row['parish_name'] . '</p>
                                        <p style="font-size: 14px;"><i class="fas fa-star text-warning"></i> ' . ucfirst($row['quality']) . '</p>
                                    </div>

                                    <br>';

                        if (isset($_SESSION['user_id'])) {
                            echo '
                                            <a href="Inn.php?inn_id=' . $row['id'] . '" class="btn btn-success text-white">
                                                <i class="fas fa-calendar-check" style="margin-right: 8px;"></i> ¡Ver Detalles!
                                            </a>';
                        } else {
                            echo '
                                            <button onclick="checkSession()" class="btn btn-success text-white">
                                                <i class="fas fa-calendar-check" style="margin-right: 8px;"></i> ¡Ver Detalles!
                                            </button>';
                        }

                        echo '
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

    <script>
        function checkSession() {
            Swal.fire({
                icon: 'warning',
                title: 'Iniciar Sesión Requerido',
                text: 'Debes iniciar sesión o crear una cuenta para realizar una reservación.',
                confirmButtonText: 'Ir a Login',
                showCancelButton: true,
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'login.php';
                }
            });
        }
    </script>

    <?php
    include './Components/Info.php';
    include './Components/Gallery.php';
    include './Components/Destinations.php';
    include './Components/VenBoocking.php';
    include './Includes/Footer.php';
    ?>

</body>

</html>