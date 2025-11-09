<?php include '../PHP/Inns_State.php' ?>

<!DOCTYPE html>
<html>

<head>
    <title>Posadas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Assets/css/Style-InnState.css">
</head>

<body>
    <section class="course-listing-page">
        <div class="container">
            <div class="card shadow-sm" style="padding: 20px">
                <div class="card-body">
                    <div id="filters" class="button-group">
                        <button class="btn btn-success filter-btn" data-filter="*">
                            <i class="fas fa-t me-2"></i> Todos
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
                        <button class="btn btn-warning filter-btn" data-filter=".media">
                            <i class="fas fa-star-half-alt me-2"></i> Media
                        </button>
                        <button class="btn btn-secondary filter-btn" data-filter=".baja">
                            <i class="fas fa-star-of-david me-2"></i> Baja
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
