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
        if ($profile_type === "Turista" && basename($_SERVER['PHP_SELF']) !== 'Inns.php') {
            header("Location: Inns.php");
            exit;
        }
    } else {
        echo "Error al preparar la consulta.";
    }
}

if (isset($_SESSION['user_id'])) {
    include './Includes/Header.php';
} else {
    include './Includes/Header2.php';
}

$search = isset($_GET['search']) ? '%' . $conn->real_escape_string($_GET['search']) . '%' : '%';

$sql_inns = "
    SELECT 
        i.id AS inn_id,
        i.name AS inn_name,
        i.description,
        i.image_url,
        i.email,
        i.phone,
        s.name AS state_name,
        m.name AS municipality_name,
        p.name AS parish_name,
        i.category_id,
        i.quality,
        COUNT(rw.id) AS total_reviews,
        ROUND(AVG(rw.rating), 2) AS average_rating
    FROM inns i
    LEFT JOIN states s ON i.state_id = s.id
    LEFT JOIN municipalities m ON i.municipality_id = m.id
    LEFT JOIN parishes p ON i.parish_id = p.id
    LEFT JOIN reservations rs ON i.id = rs.inn_id
    LEFT JOIN reviews rw ON rs.id = rw.reservation_id
    WHERE i.name LIKE ?
    GROUP BY i.id
    ORDER BY i.name ASC
";

$stmt = $conn->prepare($sql_inns);
$stmt->bind_param("s", $search);
$stmt->execute();
$result_inns = $stmt->get_result();


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
body {
    animation: fadeIn 1.5s ease-in-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}


    .filter-btn {
        height: 50px;
        border-radius: 5px;
        margin-bottom: 10px;
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
    
    .grid-container {
    display: flex;
    flex-wrap: wrap; /* Los elementos se ajustan automáticamente */
    justify-content: space-between; /* Distribución similar a tu ejemplo */
    gap: 10px; /* Espaciado entre los elementos */
}

.grid-item {
    width: 22%; /* Ajusta al tamaño deseado */
    margin-bottom: 10px; /* Espaciado inferior */
}

.filter-ubicacion button,
.filter-quality button {
    margin-bottom: 10px; /* Espaciado entre botones */
}


</style>

<body>

    <section class="course-listing-page">
        <div class="container">
            <div class="card shadow-sm" style="padding: 20px; border-radius: 20px;">
                <div class="card-body">
                    <div id="filters" class="button-group">
                    <input type="text" id="searchInput" class="form-control" placeholder="Buscar por nombre..." onkeyup="searchInns()" style="margin-bottom: 20px; padding: 10px; border-radius: 20px; font-size: 16px;">

                        <button class="btn btn-success filter-btn" data-filter="*" style="color: white;">
                            <i class="fas fa-th" style="margin-right: 8px;"></i> Todos
                        </button>
                        <button class="btn btn-success filter-btn" data-filter=".montaña" style="color: white;">
                            <i class="fas fa-mountain text-primary" style="margin-right: 8px;"></i> Montaña
                        </button>
                        <button class="btn btn-success filter-btn" data-filter=".playa" style="color: white;">
                            <i class="fas fa-umbrella-beach text-info" style="margin-right: 8px;"></i> Playa
                        </button>
                        <button class="btn btn-success filter-btn" data-filter=".ciudad" style="color: white;">
                            <i class="fas fa-city text-danger" style="margin-right: 8px;"></i> Ciudad
                        </button>
                        <button class="btn btn-info filter-btn" data-filter=".alta" style="color: white;">
                            <i class="fas fa-star text-warning" style="margin-right: 8px;"></i> Alta
                        </button>
                        <button class="btn btn-warning filter-btn" data-filter=".media" style="color: white;">
                            <i class="fas fa-star-half-alt text-warning" style="margin-right: 8px;"></i> Media
                        </button>
                        <button class="btn btn-secondary filter-btn" data-filter=".baja" style="color: white;">
                            <i class="fas fa-star-of-david text-warning" style="margin-right: 8px;"></i> Baja
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
            $quality_class = strtolower($row['quality']);
            $total_reviews = $row['total_reviews'] ?? 0; // Evitar valores nulos
            $average_rating = $row['average_rating'] ?? 0; // Evitar valores nulos

            echo '
            <div class="grid-item ' . $category_class . ' ' . $quality_class . '" data-category=".' . $category_class . ' ' . $quality_class . '">
                <div class="custom-card" style="height: 500px;">
                    <div class="img-wrap">
                        <img src="' . $row['image_url'] . '" alt="Posada ' . $row['inn_name'] . '" class="img-fluid">
                    </div>
                    <div class="card-body">
                        <h2 class="card-title"><i class="fas fa-bed text-success"></i> ' . $row['inn_name'] . '</h2>
                        <p class="card-text"><i class="fas fa-info-circle"></i> ' . $row['description'] . '</p>
                        <div class="card-meta">
                            <p style="font-size: 14px;"><i class="fas fa-tag text-primary"></i> ' . $row['state_name'] . '</p>
                            <p style="font-size: 14px;"><i class="fas fa-map-marker-alt text-danger"></i> ' . $row['municipality_name'] . '</p>
                            <p style="font-size: 14px;"><i class="fas fa-star text-warning"></i> ' . ucfirst($row['quality']) . '</p>
                        </div>
                        <hr>
                        <div class="reviews-summary">
                            <p style="font-size: 14px;"><i class="fas fa-comment-dots text-info"></i> <strong>Cantidad de Valoraciones:</strong> ' . $total_reviews . '</p>
                            <p style="font-size: 14px;"><i class="fas fa-star text-warning"></i> <strong>Promedio:</strong> ' . $average_rating . '</p>
                        </div>
                        <br>';
            if (isset($_SESSION['user_id'])) {
                echo '
                    <a href="Inn.php?inn_id=' . $row['inn_id'] . '" class="btn btn-success text-white">
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
    function searchInns() {
        const searchValue = document.getElementById('searchInput').value;
        fetch(`?search=${encodeURIComponent(searchValue)}`)
            .then(response => response.text())
            .then(html => {
                document.getElementById('cGrid').innerHTML = new DOMParser().parseFromString(html, "text/html").getElementById('cGrid').innerHTML;
            })
            .catch(error => console.error("Error en la búsqueda:", error));
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