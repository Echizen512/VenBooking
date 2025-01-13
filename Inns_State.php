<?php
session_start();
include './config/db.php';
if (isset($_SESSION['user_id'])) {
    include './Includes/Header.php';
} else {
    include './Includes/Header2.php';
}
// Verificar si se ha enviado un estado en la URL
$state_id = isset($_GET['state']) ? $_GET['state'] : '';

// Consulta para obtener las posadas, filtrando por estado si se proporciona uno
$sql_inns = "SELECT i.id, i.name AS inn_name, i.description, i.image_url, i.email, i.phone, 
                   s.name AS state_name, m.name AS municipality_name, p.name AS parish_name, i.category_id, 
                   i.quality
            FROM inns i
            LEFT JOIN states s ON i.state_id = s.id
            LEFT JOIN municipalities m ON i.municipality_id = m.id
            LEFT JOIN parishes p ON i.parish_id = p.id";
if ($state_id && $state_id != 'all') {
    $sql_inns .= " WHERE i.state_id = '$state_id'";
}

// Verificar si la consulta de las posadas se ejecutó correctamente
$result_inns = $conn->query($sql_inns);
if (!$result_inns) {
    die("Error en la consulta de posadas: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Posadas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Assets/css/Prueba.css">
</head>

<style>
    /* Estilos previos */

    .filter-btn {
        height: 50px;
        border-radius: 5px;
        margin-bottom: 10px;
        /* Espacio entre botones */
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        font-weight: bold;
    }

    #filters {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .filter-btn {
        width: 22%;
        margin-bottom: 10px;
    }

    .filter-ubicacion button,
    .filter-quality button {
        margin-bottom: 10px;
    }
</style>

<body>
    <section class="course-listing-page">
        <div class="container">
            <div class="card shadow-sm" style="padding: 20px">
                <div class="card-body">
                    <div id="filters" class="button-group">
                        <button class="btn btn-success filter-btn" data-filter="*" style="color: white;">
                            <i class="fas fa-th" style="margin-right: 8px;"></i> Todos
                        </button>
                        <button class="btn btn-success filter-btn" data-filter=".montaña" style="color: white;">
                            <i class="fas fa-mountain" style="margin-right: 8px;"></i> Montaña
                        </button>
                        <button class="btn btn-success filter-btn" data-filter=".playa" style="color: white;">
                            <i class="fas fa-umbrella-beach" style="margin-right: 8px;"></i> Playa
                        </button>
                        <button class="btn btn-success filter-btn" data-filter=".ciudad" style="color: white;">
                            <i class="fas fa-city" style="margin-right: 8px;"></i> Ciudad
                        </button>
                        <!-- Filtro de calidad -->
                        <button class="btn btn-info filter-btn" data-filter=".alta" style="color: white;">
                            <i class="fas fa-star" style="margin-right: 8px;"></i> Alta
                        </button>
                        <button class="btn btn-warning filter-btn" data-filter=".media" style="color: white;">
                            <i class="fas fa-star-half-alt" style="margin-right: 8px;"></i> Media
                        </button>
                        <button class="btn btn-secondary filter-btn" data-filter=".baja" style="color: white;">
                            <i class="fas fa-star-of-david" style="margin-right: 8px;"></i> Baja
                        </button>
                    </div>
                </div>
            </div>

            <div class="grid" id="cGrid">
                <?php
                if ($result_inns->num_rows > 0) {
                    while ($row = $result_inns->fetch_assoc()) {
                        $category_class = '';
                        switch ($row['category_id']) {
                            case 1:
                                $category_class = 'montaña';
                                break;
                            case 2:
                                $category_class = 'ciudad';
                                break;
                            case 3:
                                $category_class = 'playa';
                                break;
                        }

                        // Añadir clase de calidad
                        $quality_class = strtolower($row['quality']);

                        echo '
                        <div class="grid-item ' . $category_class . ' ' . $quality_class . '" data-category=".' . $category_class . ' ' . $quality_class . '">
                            <div class="custom-card" style="height: 450px;">
                                <div class="img-wrap">
                                    <img src="' . $row['image_url'] . '" alt="Posada ' . $row['inn_name'] . '" class="img-fluid">
                                </div>
                                <div class="card-body">
                                    <h2 class="card-title"><i class="fas fa-bed"></i> ' . $row['inn_name'] . '</h2>
                                    <p class="card-text"><i class="fas fa-info-circle"></i> ' . $row['description'] . '</p>
                                    <div class="card-meta">
                                        <p style="font-size: 14px;"><i class="fas fa-tag"></i> ' . $row['state_name'] . '</p>
                                        <p style="font-size: 14px;"><i class="fas fa-map-marker-alt"></i> ' . $row['municipality_name'] . '</p>
                                        <p style="font-size: 14px;"><i class="fas fa-star"></i> ' . ucfirst($row['quality']) . '</p>
                                    </div>
                                    <br>';
                        
                        // Mostrar botón basado en la sesión
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
    <?php include './Includes/footer.php'; ?>
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
    <script>
        document.querySelectorAll('.btn[data-filter]').forEach(button => {
            button.addEventListener('click', function () {
                let filterValue = this.getAttribute('data-filter');
                let items = document.querySelectorAll('.grid-item');
                items.forEach(item => {
                    if (filterValue === '*' || item.classList.contains(filterValue.replace('.', ''))) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
        document.querySelectorAll('.filter-btn').forEach(button => {
            button.addEventListener('click', function () {
                let qualityFilter = this.getAttribute('data-filter');
                let items = document.querySelectorAll('.grid-item');
                items.forEach(item => {
                    if (qualityFilter === '*' || item.classList.contains(qualityFilter.replace('.', ''))) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    </script>


</body>

</html>
