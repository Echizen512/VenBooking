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

$search = isset($_GET['search']) && !empty($_GET['search']) ? '%' . $conn->real_escape_string($_GET['search']) . '%' : '%';

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
    border-radius: 5px;
    margin-bottom: 5px;
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



.filter-ubicacion button,
.filter-quality button {
    margin-bottom: 10px;
}



.filter-ubicacion button,
.filter-quality button {
    margin-bottom: 10px;
    /* Espaciado entre botones */
}
</style>

<style>


        .card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 32px;
            padding: 40px;
            box-shadow: 
                0 25px 50px -12px rgba(0, 0, 0, 0.25),
                0 0 0 1px rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 
                0 35px 60px -12px rgba(0, 0, 0, 0.3),
                0 0 0 1px rgba(255, 255, 255, 0.2);
        }

        .card-body {
            position: relative;
        }

        /* Search Form Styles */
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 24px;
            margin-top: 20px;
            margin-bottom: 40px;
        }

        .form-control {
            padding: 16px 24px;
            border: 2px solid rgba(102, 126, 234, 0.1);
            border-radius: 50px;
            font-size: 16px;
            font-weight: 400;
            width: 100%;
            max-width: 450px;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            box-shadow: 
                0 8px 25px rgba(102, 126, 234, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 0.6);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-family: inherit;
            outline: none;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 
                0 8px 25px rgba(102, 126, 234, 0.25),
                0 0 0 4px rgba(102, 126, 234, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.6);
            transform: translateY(-2px);
        }

        .form-control::placeholder {
            color: rgba(102, 126, 234, 0.6);
            font-weight: 400;
        }

        .btn-primary {
            padding: 16px 32px;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            color: white;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 
                0 8px 25px rgba(102, 126, 234, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
            font-family: inherit;
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-primary:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 
                0 15px 35px rgba(102, 126, 234, 0.5),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:active {
            transform: translateY(-1px) scale(1.01);
        }

        /* Filter Buttons Container */
        .button-group {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            justify-content: center;
            align-items: center;
            padding: 16px;
            background: rgba(102, 126, 234, 0.05);
            border-radius: 20px;
            border: 1px solid rgba(102, 126, 234, 0.1);
        }

        /* Compact Filter Button Styles */
        .filter-btn {
            padding: 8px 16px;
            border: none;
            border-radius: 16px;
            font-size: 13px;
            font-weight: 500;
            color: white;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            gap: 6px;
            font-family: inherit;
            letter-spacing: 0.2px;
            position: relative;
            overflow: hidden;
            white-space: nowrap;
        }

        .filter-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.4s;
        }

        .filter-btn:hover::before {
            left: 100%;
        }

        .filter-btn:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        }

        .filter-btn:active {
            transform: translateY(0) scale(1.02);
        }

        /* Specific Button Colors */
        .btn-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            box-shadow: 0 3px 12px rgba(16, 185, 129, 0.3);
        }

        .btn-success:hover {
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        }

        .btn-info {
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
            box-shadow: 0 3px 12px rgba(6, 182, 212, 0.3);
        }

        .btn-info:hover {
            box-shadow: 0 6px 20px rgba(6, 182, 212, 0.4);
        }

        .btn-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            box-shadow: 0 3px 12px rgba(245, 158, 11, 0.3);
        }

        .btn-warning:hover {
            box-shadow: 0 6px 20px rgba(245, 158, 11, 0.4);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
            box-shadow: 0 3px 12px rgba(107, 114, 128, 0.3);
        }

        .btn-secondary:hover {
            box-shadow: 0 6px 20px rgba(107, 114, 128, 0.4);
        }

        /* Icon Styles */
        .filter-btn i {
            font-size: 12px;
            transition: transform 0.3s ease;
        }

        .filter-btn:hover i {
            transform: scale(1.1) rotate(5deg);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .card {
                padding: 24px;
                border-radius: 24px;
            }

            .button-group {
                gap: 6px;
                padding: 12px;
            }

            .filter-btn {
                padding: 6px 12px;
                font-size: 12px;
                gap: 4px;
            }

            .filter-btn i {
                font-size: 11px;
            }

            .form-control {
                max-width: 100%;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 20px 10px;
            }

            .card {
                padding: 20px;
            }

            .button-group {
                padding: 10px;
                gap: 4px;
            }

            .filter-btn {
                padding: 5px 10px;
                font-size: 11px;
            }
        }

        /* Active State */
        .filter-btn.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4) !important;
            transform: translateY(-2px) scale(1.05);
        }

        /* Loading Animation */
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }

        .loading {
            animation: pulse 2s infinite;
        }
    </style>

<body>

    <section class="course-listing-page">
        <div class="container">
            <div class="card shadow-sm mt-4" style="padding: 20px; border-radius: 20px;">
                <div class="card-body">
                    <form method="GET" action="">
                        <input type="text" name="search" class="form-control" placeholder="Buscar por nombre..."
                            value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                        <button type="submit" class="btn btn-primary">
                            Buscar
                        </button>
                    </form>
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
                        <button class="btn btn-info filter-btn" data-filter=".alta" style="color: white;">
                            <i class="fas fa-star" style="margin-right: 8px;"></i> Alta
                        </button>
                        <button class="btn btn-info filter-btn" data-filter=".media" style="color: white;">
                            <i class="fas fa-star-half-alt" style="margin-right: 8px;"></i> Media
                        </button>
                        <button class="btn btn-info filter-btn" data-filter=".baja" style="color: white;">
                            <i class="fas fa-star-of-david text-warning" style="margin-right: 8px;"></i> Baja
                        </button>
                    </div>
                </div>
            </div>
            <div class="container py-4">
                <div class="row justify-content-center g-4" id="cGrid">
                    <?php
    if ($result_inns->num_rows > 0) {
        while ($row = $result_inns->fetch_assoc()) {
            $category_class = '';
            switch ($row['category_id']) {
                case 1: $category_class = 'montaña'; break;
                case 2: $category_class = 'ciudad'; break;
                case 3: $category_class = 'playa'; break;
            }

            $quality_class = strtolower($row['quality']);
            $total_reviews = $row['total_reviews'] ?? 0;
            $average_rating = $row['average_rating'] ?? 0;

            echo '
            <div class="col-sm-12 col-md-6 col-lg-3 grid-item ' . $category_class . ' ' . $quality_class . '" data-category=".' . $category_class . ' ' . $quality_class . '">
                <div class="shadow-sm border-0 rounded-4 custom-card" style="height: 460px;">
                    <div class="img-wrap">
                        <img src="' . $row['image_url'] . '" alt="Posada ' . $row['inn_name'] . '" class="img-fluid rounded-top">
                    </div>
                    <div class="card-body py-3 px-4 bg-light">
                        <h5 class="card-title fw-semibold text-success mb-1" style="font-size: 0.9rem;">
                            <i class="fas fa-bed me-2"></i>' . $row['inn_name'] . '
                        </h5>
                        
                        <div class="d-flex justify-content-between text-muted small mt-3">
                            <span><i class="fas fa-tag text-primary me-1"></i>' . $row['state_name'] . '</span>
                           
                            <span><i class="fas fa-star text-warning me-1"></i>' . ucfirst($row['quality']) . '</span>
                        </div>
                        <hr>
                        <div class="text-muted small">
                            <p><i class="fas fa-comment-dots text-info me-1"></i><strong>Valoraciones:</strong> ' . $total_reviews . '</p>
                            <p><i class="fas fa-star text-warning me-1"></i><strong>Promedio:</strong> ' . $average_rating . '</p>
                        </div>';
            
            if (isset($_SESSION['user_id'])) {
                echo '
                        <a href="Inn.php?inn_id=' . $row['inn_id'] . '" class="btn btn-success btn-sm mt-3 w-100">
                            <i class="fas fa-calendar-check me-2"></i>¡Ver Detalles!
                        </a>';
            } else {
                echo '
                        <button onclick="checkSession()" class="btn btn-success btn-sm mt-3 w-100">
                            <i class="fas fa-calendar-check me-2"></i>¡Ver Detalles!
                        </button>';
            }

            echo '
                    </div>
                </div>
            </div>';
        }
    } else {
        echo "<p class='text-danger'><i class='fas fa-exclamation-circle'></i> No se encontraron resultados.</p>";
    }
    ?>
                </div>
            </div>



        </div>
    </section>

    <style>
    .custom-card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }

    .custom-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
    }

    .img-wrap {
        max-height: 220px;
        overflow: hidden;
        object-fit: cover;
    }

    .img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    </style>

    <?php include './Includes/footer.php'; ?>
    <script src="./Assets/js/Inns.js"></script>

    <style>
    /* Evita que el footer suba */
    footer {
        clear: both;
        position: relative;
        bottom: 0;
        width: 100%;
    }
    </style>



</body>

</html>