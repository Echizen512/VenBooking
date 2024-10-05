<?php
include './config/db.php';

$sql_inns = "SELECT i.id, i.name AS inn_name, i.description, i.image_url, i.email, i.phone, 
               s.name AS state_name, m.name AS municipality_name, p.name AS parish_name, i.category_id
        FROM inns i
        LEFT JOIN states s ON i.state_id = s.id
        LEFT JOIN municipalities m ON i.municipality_id = m.id
        LEFT JOIN parishes p ON i.parish_id = p.id";

$result_inns = $conn->query($sql_inns);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Posadas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="./Assets/css/Prueba.css">

</head>

<body>
    <?php include './Includes/header.php';?>
    <section class="course-listing-page">
        <div class="container">
            <div class="card shadow-sm" style="padding: 20px">
                <div class="card-body">
                    <div id="filters" class="button-group">
                        <button class="btn btn-success" data-filter="*" style="color: white;"><i class="fas fa-th" style="margin-right: 8px;"></i> Todos</button>
                        <button class="btn btn-success" data-filter=".montaña" style="color: white;"><i class="fas fa-mountain" style="margin-right: 8px;"></i> Montaña</button>
                        <button class="btn btn-success" data-filter=".playa" style="color: white;"><i class="fas fa-umbrella-beach" style="margin-right: 8px;"></i> Playa</button>
                        <button class="btn btn-success" data-filter=".ciudad" style="color: white;"><i class="fas fa-city" style="margin-right: 8px;"></i> Ciudad</button>
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
                        echo '
                        <div class="grid-item ' . $category_class . '" data-category=".' . $category_class . '">
                            <div class="custom-card">
                                <div class="img-wrap">
                                    <img src="' . $row['image_url'] . '" alt="Posada ' . $row['inn_name'] . '" class="img-fluid">
                                </div>
                                <div class="card-body">
                                    <h2 class="card-title"><i class="fas fa-bed"></i> ' . $row['inn_name'] . '</h2>
                                    <p class="card-text"><i class="fas fa-info-circle"></i> ' . $row['description'] .'</p>
                                    <a href="Inn.php?inn_id=' . $row['id'] . '" class="btn btn-success text-white">
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
    <?php include './Includes/footer.php';?>
</body>
</html>
