<?php
session_start();
include './config/db.php';

// Determinar qué encabezado incluir según el estado de la sesión
$headerFile = isset($_SESSION['user_id']) ? './Includes/Header.php' : './Includes/Header2.php';

// Obtener todos los estados
$states_query = "SELECT * FROM States";
$states_result = $conn->query($states_query);

// Obtener todos los destinos
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
    <link rel="stylesheet" href="./Assets/css/Prueba.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Ajusta la estructura del filtro */
        .filter-card {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
        }

        .filter-card h2 {
            font-size: 1.5em;
            margin-bottom: 20px;
            font-weight: bold;
            text-align: center;
        }

        .destinations-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 30px;
            justify-content: flex-start;
        }

        .event-wrap {
            flex: 0 0 calc(33.333% - 20px);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .img-wrap img {
            width: 100%;
            height: auto;
        }

        .details {
            padding: 15px;
        }

        .filter-wrapper {
            margin-bottom: 15px;
        }

        #stateFilter {
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            cursor: pointer;
            width: 100%;
            margin-bottom: 15px;
        }

        .filter-btn {
            padding: 12px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 10px;
        }

        .filter-btn:hover {
            background-color: #0056b3;
        }

        .filter-btn i {
            margin-right: 8px;
        }
    </style>
</head>

<body>

    <?php include $headerFile; ?>

    <section class="page-heading">
        <div class="container">
            <h2><i class="fas fa-map-signs"></i> Destinos Turísticos en Venezuela</h2>
        </div>
    </section>

    <section class="upcoming events-section">
        <div class="container">
            <!-- Card de filtro por estado -->
            <div class="filter-card">
                <h2><i class="fas fa-filter"></i> Filtrar Posadas por Estado</h2>
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

            <!-- Destinos filtrados -->
            <div id="destinationsContainer" class="destinations-grid">
                <?php while ($destination = $destinations_result->fetch_assoc()): ?>
                    <div class="event-wrap" data-state-id="<?php echo $destination['state_id']; ?>">
                        <div class="img-wrap">
                            <img src="<?php echo $destination['image_url']; ?>" alt="<?php echo $destination['name']; ?>">
                        </div>
                        <div class="details">
                            <a href="#">
                                <h3><i class="fas fa-map-marker-alt"></i> <?php echo $destination['name']; ?></h3>
                            </a>
                            <p><?php echo $destination['description']; ?></p>
                            <h5><i class="fas fa-map-marker-alt"></i> <?php echo $destination['state_name']; ?></h5>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>

    <?php include './Includes/footer.php'; ?>
</body>

</html>
