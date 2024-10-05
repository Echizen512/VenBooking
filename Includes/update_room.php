<?php
    include '../config/db.php';
    include './Dashboard.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM rooms WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $room_number = $row['room_number'];
        $type = $row['type'];
        $quality = $row['quality'];
        $image_url = $row['image_url'];
        $description = $row['description'];
        $price = $row['price'];
        $capacity = $row['capacity'];
        $inn_id = $row['inn_id'];
    } else {
        echo "No se encontró la habitación.";
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $room_number = $_POST['room_number'];
    $type = $_POST['type'];
    $quality = $_POST['quality'];
    $image_url = $_POST['image_url'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $capacity = $_POST['capacity'];
    $inn_id = $_POST['inn_id'];

    $sql = "UPDATE rooms SET room_number='$room_number', type='$type', quality='$quality', image_url='$image_url', 
            description='$description', price='$price', capacity='$capacity', inn_id='$inn_id' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Habitación actualizada exitosamente.";
    } else {
        echo "Error actualizando registro: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Habitación</title>
    <link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Assets/css/Form.css">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card custom-card">
                <div class="card-header text-white text-center bg-success" style="font-size: 24px;">Actualizar Habitación</div>
                <div class="card-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <div class="form-group">
                            <label for="room_number">Número de Habitación</label>
                            <input type="text" class="form-control" id="room_number" name="room_number" value="<?php echo $room_number; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="type">Tipo</label>
                            <input type="text" class="form-control" id="type" name="type" value="<?php echo $type; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="quality">Calidad</label>
                            <input type="text" class="form-control" id="quality" name="quality" value="<?php echo $quality; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="image_url">URL de Imagen</label>
                            <input type="text" class="form-control" id="image_url" name="image_url" value="<?php echo $image_url; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Descripción</label>
                            <textarea class="form-control" id="description" name="description" required><?php echo $description; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="price">Precio</label>
                            <input type="number" class="form-control" id="price" name="price" value="<?php echo $price; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="capacity">Capacidad</label>
                            <input type="number" class="form-control" id="capacity" name="capacity" value="<?php echo $capacity; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="inn_id">Posada</label>
                            <select class="form-control" id="inn_id" name="inn_id" required>
                                <option value="">Seleccionar Posada</option>
                                <?php
                                include 'db.php';
                                $sql_inns = "SELECT id, name FROM inns";
                                $result_inns = $conn->query($sql_inns);
                                if ($result_inns->num_rows > 0) {
                                    while ($row_inn = $result_inns->fetch_assoc()) {
                                        $selected = ($inn_id == $row_inn['id']) ? "selected" : "";
                                        echo "<option value='" . $row_inn['id'] . "' $selected>" . $row_inn['name'] . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>No se pudieron cargar las posadas</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <br>
                        <div class="text-center">
                        <button type="submit" class="btn btn-success">Actualizar Habitación</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
</body>
</html>
