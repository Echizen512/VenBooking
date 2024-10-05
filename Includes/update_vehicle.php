<?php
    include '../config/db.php';
    include './Dashboard.php';

// Inicializar variables vacías para evitar errores al cargar el formulario
$inn_id = $type = $brand = $description = $price = $capacity = $year = $model = $registration_plate = $status = $image_url = $invoice = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir y validar los datos del formulario
    $inn_id = $_POST['inn_id'];
    $type = $_POST['type'];
    $brand = $_POST['brand'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $capacity = $_POST['capacity'];
    $year = $_POST['year'];
    $model = $_POST['model'];
    $registration_plate = $_POST['registration_plate'];
    $status = $_POST['status'];
    $image_url = $_POST['image_url'];
    $invoice = $_POST['invoice'];

    // Preparar la consulta SQL para insertar un nuevo vehículo
    $sql = "INSERT INTO vehicles (inn_id, type, brand, description, price, capacity, year, model, registration_plate, status, image_url, invoice) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssdiisssss", $inn_id, $type, $brand, $description, $price, $capacity, $year, $model, $registration_plate, $status, $image_url, $invoice);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        header("Location: vehicles.php"); // Redireccionar a la página de listado de vehículos
        exit();
    } else {
        echo "Error al crear el vehículo: " . $stmt->error;
    }

    $stmt->close();
}

// Obtener lista de posadas
$sql_inns = "SELECT id, name FROM inns";
$result_inns = $conn->query($sql_inns);

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Vehículo</title>
    <link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Assets/css/Form.css">
</head>
<body>
    
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card custom-card">
                <div class="card-header text-white text-center bg-success" style="font-size: 24px;">Formulario de Registro de Vehículo</div>
                <div class="card-body">
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="form-group">
                            <label for="inn_id" class="form-label">Posada</label>
                            <select class="form-control" id="inn_id" name="inn_id" required>
                                <option value="">Seleccionar Posada</option>
                                <?php
                                if ($result_inns->num_rows > 0) {
                                    while ($row_inn = $result_inns->fetch_assoc()) {
                                        echo "<option value='" . $row_inn['id'] . "'>" . $row_inn['name'] . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>No hay posadas disponibles</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="type" class="form-label">Tipo</label>
                            <input type="text" class="form-control" id="type" name="type" required>
                        </div>
                        <div class="form-group">
                            <label for="brand" class="form-label">Marca</label>
                            <input type="text" class="form-control" id="brand" name="brand" required>
                        </div>
                        <div class="form-group">
                            <label for="description" class="form-label">Descripción</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="price" class="form-label">Precio</label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="form-group">
                            <label for="capacity" class="form-label">Capacidad</label>
                            <input type="number" class="form-control" id="capacity" name="capacity" required>
                        </div>
                        <div class="form-group">
                            <label for="year" class="form-label">Año</label>
                            <input type="number" class="form-control" id="year" name="year" required>
                        </div>
                        <div class="form-group">
                            <label for="model" class="form-label">Modelo</label>
                            <input type="text" class="form-control" id="model" name="model" required>
                        </div>
                        <div class="form-group">
                            <label for="registration_plate" class="form-label">Matrícula</label>
                            <input type="text" class="form-control" id="registration_plate" name="registration_plate" required>
                        </div>
                        <div class="form-group">
                            <label for="status" class="form-label">Estado</label>
                            <input type="text" class="form-control" id="status" name="status" required>
                        </div>
                        <div class="form-group">
                            <label for="image_url" class="form-label">URL de Imagen</label>
                            <input type="text" class="form-control" id="image_url" name="image_url" required>
                        </div>
                        <div class="form-group">
                            <label for="invoice" class="form-label">Factura</label>
                            <input type="text" class="form-control" id="invoice" name="invoice" required>
                        </div>
                        <br>
                        <div class="text-center">
                        <button type="submit" class="btn btn-success">Crear Vehículo</button>
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
