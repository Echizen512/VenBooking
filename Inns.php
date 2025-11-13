<?php include './PHP/get-Inns.php'; ?> 

<!DOCTYPE html>
<html>
<head>
    <title>VenBooking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Assets/css/Prueba.css">
    <link rel="stylesheet" href="./Assets/css/Style-Inns.css">
</head>
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
                        <button class="btn btn-success filter-btn" data-filter="*">
                            <i class="fas fa-th me-2"></i> Todos
                        </button>
                        <button class="btn btn-success filter-btn" data-filter=".montaña">
                            <i class="fas fa-mountain me-2"></i> Montaña
                        </button>
                        <button class="btn btn-success filter-btn" data-filter=".playa">
                            <i class="fas fa-umbrella-beach me-2"></i> Playa
                        </button>
                        <button class="btn btn-success filter-btn" data-filter=".ciudad">
                            <i class="fas fa-city me-2"></i> Ciudad
                        </button>
                        <button class="btn btn-info filter-btn" data-filter=".alta">
                            <i class="fas fa-star me-2"></i> Alta
                        </button>
                        <button class="btn btn-info filter-btn" data-filter=".media">
                            <i class="fas fa-star-half-alt me-2"></i> Media
                        </button>
                        <button class="btn btn-info filter-btn" data-filter=".baja">
                            <i class="fas fa-star-of-david me-2"></i> Baja
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
                            $total_reviews = $row['total_reviews'] ?? 0;
                            $average_rating = $row['average_rating'] ?? 0;
                            echo '
            <div class="col-sm-12 col-md-6 col-lg-3 grid-item ' . $category_class . ' ' . $quality_class . '" data-category=".' . $category_class . ' ' . $quality_class . '">
                <div class="shadow-sm border-0 rounded-4 custom-card" style="height: 460px;">
                    <div class="img-wrap">
                        <div style="height:220px; overflow:hidden; border-top-left-radius: .75rem; border-top-right-radius: .75rem;">
                            <img src="' . $row['image_url'] . '" alt="Posada ' . $row['inn_name'] . '" style="width:100%; height:100%; object-fit:cover; display:block;">
                        </div>
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


    <?php include './Includes/footer.php'; ?>
    <script src="./Assets/js/Inns.js"></script>

</body>

</html>