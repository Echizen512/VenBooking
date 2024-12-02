<?php
session_start();
include './config/db.php';

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
        if ($profile_type === "Turista" && basename($_SERVER['PHP_SELF']) !== 'Destinations.php') {
            header("Location: Destinations.php");
            exit;
        }
    } else {
        echo "Error al preparar la consulta.";
    }
}

$headerFile = isset($_SESSION['user_id']) ? './Includes/Header.php' : './Includes/Header2.php';

$states_query = "SELECT * FROM States";
$states_result = $conn->query($states_query);

$destinations_query = "SELECT d.*, s.name AS state_name 
                       FROM Destinations d 
                       JOIN States s ON d.state_id = s.id 
                       WHERE d.status = 1";
$destinations_result = $conn->query($destinations_query);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="./Assets/css/Destinations.css">
</head>

<body>

    <?php include $headerFile; ?>

    <section class="page-heading">
        <div class="container">
            <h2><i class="fas fa-map-signs text-primary"></i> Destinos Turísticos en Venezuela</h2>
        </div>
    </section>

    <section class="upcoming events-section">
        <div class="container">
            <div class="filter-card">
                <h2><i class="fas fa-filter text-danger"></i> Filtrar Posadas por Estado</h2>
                <form action="Inns_State.php" method="GET">
                    <div class="filter-wrapper">
                        <select id="stateFilter" name="state">
                            <option value="">Selecciona un Estado</option>
                            <option value="all">Todos</option>
                            <?php while ($state = $states_result->fetch_assoc()): ?>
                                <option value="<?php echo $state['id']; ?>"><?php echo $state['name']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success" style="font-size: 18px; padding: 10px 20px; display: flex; align-items: center; justify-content: center; width: 100%; text-align: center;">
                        <i class="fas fa-search" style="margin-right: 10px;"></i> Filtrar
                    </button>
                </form>
            </div>

            <div id="destinationsContainer" class="destinations-grid">
                <?php while ($destination = $destinations_result->fetch_assoc()): ?>
                    <div class="event-wrap text-primary" data-state-id="<?php echo $destination['state_id']; ?>">
                        <div class="img-wrap">
                            <img src="<?php echo $destination['image_url']; ?>" alt="<?php echo $destination['name']; ?>">
                        </div>
                        <div class="details">
                            <a href="#">
                                <h3><i class="fas fa-map-marker-alt text-danger"></i> <?php echo $destination['name']; ?></h3>
                            </a>
                            <p><?php echo $destination['description']; ?></p>
                            <h5><i class="fas fa-map-marker-alt text-primary"></i> <?php echo $destination['state_name']; ?></h5>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>

    <?php include './Includes/footer.php'; ?>
</body>

</html>
