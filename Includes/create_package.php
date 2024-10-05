<?php
    include '../config/db.php';
    include './Dashboard.php';


$inns = [];
$sql = "SELECT id, name FROM inns";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $inns[] = $row;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inn_id = $_POST['inn_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image_url = $_POST['image_url'];
    $duration = $_POST['duration'];
    $price = $_POST['price'];

    $sql = "INSERT INTO tour_packages (inn_id, name, description, image_url, duration, price)
            VALUES ('$inn_id', '$name', '$description', '$image_url', '$duration', '$price')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuevo paquete turístico creado exitosamente";
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
    <title>Agregar Paquete</title>
    <link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Assets/css/Form.css">
</head>
<body>



<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card custom-card">
                <div class="card-header bg-success text-white text-center" style="font-size: 24px">Agregar Paquete Turístico</div>
                <div class="card-body">
                    <form method="post">
                        <div class="form-group">
                            <label for="inn_id" class="form-label">Nombre de la Posada</label>
                            <select class="form-control" id="inn_id" name="inn_id" required>
                                <?php foreach ($inns as $inn): ?>
                                    <option value="<?php echo $inn['id']; ?>"><?php echo $inn['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name" class="form-label">Nombre del Paquete</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="description" class="form-label">Descripción</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image_url" class="form-label">URL de la Imagen</label>
                            <input type="text" class="form-control" id="image_url" name="image_url">
                        </div>
                        <div class="form-group">
                            <label for="duration" class="form-label">Duración (días)</label>
                            <input type="number" class="form-control" id="duration" name="duration" required>
                        </div>
                        <div class="form-group">
                            <label for="price" class="form-label">Precio</label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                        </div>
                        <br>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success">Crear Paquete</button>
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
