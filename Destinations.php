<?php
include './config/db.php';

// Obtener todos los estados
$states_query = "SELECT * FROM States";
$states_result = $conn->query($states_query);

// Obtener todos los destinos
$destinations_query = "SELECT d.*, s.name AS state_name FROM Destinations d JOIN States s ON d.state_id = s.id WHERE d.status = 1";
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
        .filter-wrapper {
            margin-bottom: 20px;
        }

        #stateFilter {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            cursor: pointer;
        }

        .destinations-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px; /* Espacio entre los destinos */
        }

        .event-wrap {
            flex: 0 0 calc(50% - 10px); /* 50% menos 10px de espacio */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .img-wrap img {
            width: 100%; /* Ajusta la imagen al ancho del contenedor */
            height: auto;
        }

        .details {
            padding: 15px;
        }
    </style>
</head>

<body>

    <?php include './Includes/Header.php'; ?>

    <section class="page-heading">
        <div class="container">
            <h2><i class="fas fa-map-signs"></i> Destinos Turísticos en Venezuela</h2>
        </div>
    </section>

    <section class="upcoming events-section">
        <div class="container">
            <h2>Filtrar por Estado</h2>
            <div class="filter-wrapper">
                <select id="stateFilter">
                    <option value="all">Todos</option>
                    <?php while ($state = $states_result->fetch_assoc()): ?>
                        <option value="<?php echo $state['id']; ?>"><?php echo $state['name']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            
            <div id="destinationsContainer" class="destinations-grid"> <!-- Asegúrate de que esta clase esté aplicada -->
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

    <script>
        document.getElementById('stateFilter').addEventListener('change', function() {
            const selectedStateId = this.value;
            const destinations = document.querySelectorAll('.event-wrap');

            destinations.forEach(destination => {
                const stateId = destination.getAttribute('data-state-id');
                if (selectedStateId === 'all' || stateId === selectedStateId) {
                    destination.style.display = 'block';
                } else {
                    destination.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>
