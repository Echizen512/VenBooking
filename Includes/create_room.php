<?php
    include '../config/db.php';
    include './Dashboard.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_number = $_POST['room_number'];
    $type = $_POST['type'];
    $quality = $_POST['quality'];
    $image_url = $_POST['image_url'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $capacity = $_POST['capacity'];
    $inn_id = $_POST['inn_id'];

    $sql = "INSERT INTO rooms (room_number, type, quality, image_url, description, price, capacity, inn_id) 
            VALUES ('$room_number', '$type', '$quality', '$image_url', '$description', '$price', '$capacity', '$inn_id')";

    if ($conn->query($sql) === TRUE) {
        echo "Habitación agregada exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Habitación</title>
    <link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Assets/css/Form.css">
</head>



<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card custom-card">
                <div class="card-header bg-success text-white text-center" style="font-size: 24px">Agregar Habitación</div>
                <div class="card-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="form-group">
                            <label for="room_number">Número de Habitación</label>
                            <input type="number" class="form-control" id="room_number" name="room_number" required>
                        </div>
                        <div class="form-group">
                            <label for="type">Tipo</label>
                            <select class="form-control" id="type" name="type" required>
                                <option value="">Seleccionar Tipo</option>
                                <option value="Familiar">Familar</option>
                                <option value="Individual">Individual</option>
                                <option value="Pareja">Pareja</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quality">Calidad</label>
                            <select class="form-control" id="quality" name="quality" required>
                                <option value="">Seleccionar Tipo</option>
                                <option value="Baja">Baja</option>
                                <option value="Media">Media</option>
                                <option value="Alta">Alta</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image_url">URL de Imagen</label>
                            <input type="text" class="form-control" id="image_url" name="image_url" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Descripción</label>
                            <textarea class="form-control" id="description" name="description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="price">Precio</label>
                            <input type="number" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="form-group">
                            <label for="capacity">Capacidad</label>
                            <input type="number" class="form-control" id="capacity" name="capacity" required>
                        </div>
                        <div class="form-group">
                            <label for="inn_id">Posada</label>
                            <select class="form-control" id="inn_id" name="inn_id" required>
                                <option value="">Seleccionar Posada</option>
                                <?php
                                $sql_inns = "SELECT id, name FROM inns";
                                $result_inns = $conn->query($sql_inns);
                                while ($row_inn = $result_inns->fetch_assoc()) {
                                    echo "<option value='" . $row_inn['id'] . "'>" . $row_inn['name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <br>
                        <div class="text-center">
                        <button type="submit" class="btn btn-success">Agregar Habitación</button>
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
