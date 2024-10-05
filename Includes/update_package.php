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
    $id = $_POST['id'];
    $inn_id = $_POST['inn_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image_url = $_POST['image_url'];
    $duration = $_POST['duration'];
    $price = $_POST['price'];

    $sql = "UPDATE tour_packages
            SET inn_id = '$inn_id', name = '$name', description = '$description', 
                image_url = '$image_url', duration = '$duration', price = '$price'
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Paquete turístico actualizado exitosamente";
    } else {
        echo "Error al actualizar el paquete turístico: " . $conn->error;
    }

    $conn->close();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM tour_packages WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $inn_id = $row['inn_id'];
        $name = $row['name'];
        $description = $row['description'];
        $image_url = $row['image_url'];
        $duration = $row['duration'];
        $price = $row['price'];
    } else {
        echo "Paquete turístico no encontrado";
        exit;
    }
} else {
    echo "ID del paquete turístico no proporcionado";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Paquete Turístico</title>
    <link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Assets/css/Form.css">
</head>
<body>


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card custom-card">
                <div class="card-header bg-success text-white text-center" style="font-size: 24px;">Editar Paquete Turístico</div>
                <div class="card-body">
                    <form method="post">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <div class="form-group">
                            <label for="inn_id" class="form-label">Nombre de la Posada</label>
                            <select class="form-control" id="inn_id" name="inn_id" required>
                                <?php foreach ($inns as $inn): ?>
                                    <option value="<?php echo $inn['id']; ?>" <?php if ($inn['id'] == $inn_id) echo 'selected'; ?>>
                                        <?php echo $inn['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name" class="form-label">Nombre del Paquete</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="description" class="form-label">Descripción</label>
                            <textarea class="form-control" id="description" name="description" rows="3"><?php echo $description; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image_url" class="form-label">URL de la Imagen</label>
                            <input type="text" class="form-control" id="image_url" name="image_url" value="<?php echo $image_url; ?>">
                        </div>
                        <div class="form-group">
                            <label for="duration" class="form-label">Duración (días)</label>
                            <input type="number" class="form-control" id="duration" name="duration" value="<?php echo $duration; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="price" class="form-label">Precio</label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?php echo $price; ?>" required>
                        </div>
                        <br>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success">Actualizar Paquete</button>
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
