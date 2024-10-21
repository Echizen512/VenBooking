<?php
include '../config/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$inn_id = $_GET['id'];

// Consulta para obtener el nombre de la posada
$sql_inn = "SELECT name FROM inns WHERE id = ?";
$stmt_inn = $conn->prepare($sql_inn);
$stmt_inn->bind_param("i", $inn_id);
$stmt_inn->execute();
$stmt_inn->bind_result($inn_name);
$stmt_inn->fetch();
$stmt_inn->close();

// Consulta para habitaciones
$sql_rooms = "SELECT * FROM rooms WHERE inn_id = ?";
$stmt_rooms = $conn->prepare($sql_rooms);
$stmt_rooms->bind_param("i", $inn_id);
$stmt_rooms->execute();
$result_rooms = $stmt_rooms->get_result();

// Consulta para vehículos
$sql_vehicles = "SELECT * FROM vehicles WHERE inn_id = ?";
$stmt_vehicles = $conn->prepare($sql_vehicles);
$stmt_vehicles->bind_param("i", $inn_id);
$stmt_vehicles->execute();
$result_vehicles = $stmt_vehicles->get_result();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Actualizar habitación
    if (isset($_POST['update_room'])) {
        $room_id = $_POST['room_id'];
        $room_number = $_POST['room_number'];
        $type = $_POST['type'];
        $quality = $_POST['quality'];
        $image_url = $_POST['image_url'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $capacity = $_POST['capacity'];

        $sql = "UPDATE rooms SET room_number = ?, type = ?, quality = ?, image_url = ?, description = ?, price = ?, capacity = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssdii", $room_number, $type, $quality, $image_url, $description, $price, $capacity, $room_id);
        $stmt->execute();
        header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $inn_id);
        exit();
    }

    // Insertar nueva habitación
    if (isset($_POST['add_room'])) {
        $room_number = $_POST['room_number'];
        $type = $_POST['type'];
        $quality = $_POST['quality'];
        $image_url = $_POST['image_url'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $capacity = $_POST['capacity'];

        // Asegúrate de obtener el inn_id desde la URL o algún otro lugar
        if (isset($_GET['id'])) {
            $inn_id = $_GET['id'];

            // Preparar la consulta
            $sql = "INSERT INTO rooms (room_number, type, quality, image_url, description, price, capacity, inn_id) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            // Asegúrate de que la cadena de tipos coincida con las variables
            $stmt->bind_param("ssssdiii", $room_number, $type, $quality, $image_url, $description, $price, $capacity, $inn_id);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $inn_id);
                exit();
            } else {
                echo "Error al agregar la habitación: " . $stmt->error;
            }
        } else {
            echo "Error: No se ha proporcionado un ID de posada.";
        }
    }

    // Actualizar vehículo
    if (isset($_POST['update_vehicle'])) {
        $vehicle_id = $_POST['vehicle_id'];
        $brand = $_POST['brand'];
        $model = $_POST['model'];
        $year = $_POST['year'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $capacity = $_POST['capacity'];
        $image_url = $_POST['image_url'];

        $sql = "UPDATE vehicles SET brand = ?, model = ?, year = ?, description = ?, price = ?, capacity = ?, image_url = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssissisi", $brand, $model, $year, $description, $price, $capacity, $image_url, $vehicle_id);
        $stmt->execute();
        header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $inn_id);
        exit();
    }

    // Insertar nuevo vehículo
    if (isset($_POST['add_vehicle'])) {
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

        $sql = "INSERT INTO vehicles (inn_id, type, brand, description, price, capacity, year, model, registration_plate, status, image_url, invoice) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssdiisssss", $inn_id, $type, $brand, $description, $price, $capacity, $year, $model, $registration_plate, $status, $image_url, $invoice);

        if ($stmt->execute()) {
            header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $inn_id);
            exit();
        } else {
            echo "Error al crear el vehículo: " . $stmt->error;
        }
    }
}

// Toggle para vehículos y habitaciones
if (isset($_POST['toggle_block'])) {
    $id = $_POST['id'];
    $type = $_POST['type'];

    if ($type === 'vehicle') {
        $sql = "SELECT block FROM vehicles WHERE id = ?";
    } else {
        $sql = "SELECT block FROM rooms WHERE id = ?";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($currentBlock);
    $stmt->fetch();
    $stmt->close();

    $newBlock = $currentBlock ? 0 : 1;

    if ($type === 'vehicle') {
        $sql = "UPDATE vehicles SET block = ? WHERE id = ?";
    } else {
        $sql = "UPDATE rooms SET block = ? WHERE id = ?";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $newBlock, $id);
    $stmt->execute();
    $stmt->close();

    // Redireccionar según el tipo, ahora incluyendo el inn_id
    header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $inn_id);
    exit();
}


?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Posada</title>
    <link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<style>
    .footer {
        width: 100%;
    }
</style>

<body>

    <?php include './Header_Admin.php'; ?>

    <div class="container mt-5">
        <h2 class="mb-4 text-center" style="font-size: 28px;">
            <i class="fas fa-home" style="font-size: 28px;"></i> <?php echo htmlspecialchars($inn_name); ?>
        </h2>

        <!-- Sección de Habitaciones -->
        <div class="row mb-5">
            <div class="col-12 d-flex justify-content-between align-items-center mb-3">
                <h3 class="mb-0" style="font-size: 28px;"><i class="fas fa-bed" style="font-size: 28px;"></i>
                    Habitaciones</h3>
                <button class="btn btn-success" style="font-size: 14px;" data-bs-toggle="modal"
                    data-bs-target="#addRoomModal">
                    Agregar Habitación
                </button>
            </div>

            <?php if ($result_rooms->num_rows > 0): ?>
                <?php while ($room = $result_rooms->fetch_assoc()): ?>
                    <div class="col-md-4">
                        <div class="card shadow-sm mb-4">
                            <img src="<?= $room['image_url']; ?>" class="card-img-top" alt="Imagen de la Habitación"
                                style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 style="font-size: 18px;" class="card-title"><?= $room['type']; ?> - Habitación
                                    <?= $room['room_number']; ?></h5>
                                <p class="card-text text-truncate" style="font-size: 16px;"><?= $room['description']; ?></p>
                                <p style="font-size: 14px;"><i class="fas fa-dollar-sign"></i> <strong>Precio:</strong>
                                    <?= $room['price']; ?></p>
                                <p style="font-size: 14px;"><i class="fas fa-users"></i> <strong>Capacidad:</strong>
                                    <?= $room['capacity']; ?></p>
                                <p style="font-size: 14px;"><i class="fas fa-star"></i> <strong>Calidad:</strong>
                                    <?= $room['quality']; ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <button class="btn btn-primary " style="font-size: 16px;" data-bs-toggle="modal"
                                        data-bs-target="#editRoomModal<?= $room['id']; ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form method="POST" action="<?= $_SERVER['PHP_SELF'] . '?id=' . $inn_id; ?>"
                                        style="display: inline;">
                                        <input type="hidden" name="id" value="<?= $room['id']; ?>">
                                        <input type="hidden" name="type" value="room">
                                        <input type="hidden" name="toggle_block" value="1">
                                        <button type="submit" style="font-size: 16px;"
                                            class="btn btn-sm <?= $room['block'] ? 'btn-danger' : 'btn-outline-success'; ?> ">
                                            <?= $room['block'] ? 'Bloqueado' : 'Activo'; ?>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal para editar habitación -->
                    <div class="modal fade" id="editRoomModal<?= $room['id']; ?>" tabindex="-1"
                        aria-labelledby="editRoomModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editRoomModalLabel">Editar Habitación</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST">
                                        <input type="hidden" name="room_id" value="<?= $room['id']; ?>">
                                        <div class="form-group mb-3">
                                            <label for="room_number">Número de Habitación</label>
                                            <input type="text" class="form-control" name="room_number"
                                                value="<?= $room['room_number']; ?>" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="type">Tipo</label>
                                            <input type="text" class="form-control" name="type" value="<?= $room['type']; ?>"
                                                required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="quality">Calidad</label>
                                            <input type="text" class="form-control" name="quality"
                                                value="<?= $room['quality']; ?>" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="image_url">URL de Imagen</label>
                                            <input type="text" class="form-control" name="image_url"
                                                value="<?= $room['image_url']; ?>" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="description">Descripción</label>
                                            <textarea class="form-control" name="description"
                                                required><?= $room['description']; ?></textarea>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="price">Precio</label>
                                            <input type="number" class="form-control" name="price"
                                                value="<?= $room['price']; ?>" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="capacity">Capacidad</label>
                                            <input type="number" class="form-control" name="capacity"
                                                value="<?= $room['capacity']; ?>" required>
                                        </div>
                                        <br>
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" name="update_room" class="btn btn-primary">Actualizar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12">
                    <p class="text-center">No hay habitaciones registradas.</p>
                </div>
            <?php endif; ?>
        </div>


        <!-- Sección de Vehículos -->
        <div class="row mb-5">
            <div class="col-12 d-flex justify-content-between align-items-center mb-3">
                <h3 class="mb-0" style="font-size: 28px;"><i class="fas fa-car" style="font-size: 28px;"></i> Vehículos
                </h3>
                <button class="btn btn-success" style="font-size: 14px;" data-bs-toggle="modal"
                    data-bs-target="#addVehicleModal">
                    Agregar Vehículo
                </button>
            </div>

            <?php if ($result_vehicles->num_rows > 0): ?>
                <?php while ($vehicle = $result_vehicles->fetch_assoc()): ?>
                    <div class="col-md-4">
                        <div class="card shadow-sm mb-4">
                            <img src="<?= $vehicle['image_url']; ?>" class="card-img-top" alt="Imagen del Vehículo"
                                style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title" style="font-size: 18px;"><?= $vehicle['brand']; ?> -
                                    <?= $vehicle['model']; ?></h5>
                                <p style="font-size: 16px;" class="card-text text-truncate"><?= $vehicle['description']; ?></p>
                                <p style="font-size: 14px;"><i class="fas fa-dollar-sign"></i> <strong>Precio:</strong>
                                    <?= $vehicle['price']; ?></p>
                                <p style="font-size: 14px;"><i class="fas fa-users"></i> <strong>Capacidad:</strong>
                                    <?= $vehicle['capacity']; ?></p>
                                <p style="font-size: 14px;"><i class="fas fa-calendar-alt"></i> <strong>Año:</strong>
                                    <?= $vehicle['year']; ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <button class="btn btn-primary" style="font-size: 16px;" data-bs-toggle="modal"
                                        data-bs-target="#editVehicleModal<?= $vehicle['id']; ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form method="POST" action="<?= $_SERVER['PHP_SELF'] . '?id=' . $inn_id; ?>"
                                        style="display: inline;">
                                        <input type="hidden" name="id" value="<?= $vehicle['id']; ?>">
                                        <input type="hidden" name="toggle_block" value="1">
                                        <input type="hidden" name="type" value="vehicle">
                                        <button type="submit" style="font-size: 16px;"
                                            class="btn btn-sm <?= $vehicle['block'] ? 'btn-danger' : 'btn-outline-success'; ?>">
                                            <?= $vehicle['block'] ? 'Bloqueado' : 'Activo'; ?>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal para editar vehículo -->
                    <div class="modal fade" id="editVehicleModal<?= $vehicle['id']; ?>" tabindex="-1"
                        aria-labelledby="editVehicleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editVehicleModalLabel">Editar Vehículo</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST">
                                        <input type="hidden" name="vehicle_id" value="<?= $vehicle['id']; ?>">
                                        <div class="form-group mb-3">
                                            <label for="brand">Marca</label>
                                            <input type="text" class="form-control" name="brand"
                                                value="<?= $vehicle['brand']; ?>" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="model">Modelo</label>
                                            <input type="text" class="form-control" name="model"
                                                value="<?= $vehicle['model']; ?>" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="year">Año</label>
                                            <input type="number" class="form-control" name="year"
                                                value="<?= $vehicle['year']; ?>" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="description">Descripción</label>
                                            <textarea class="form-control" name="description"
                                                required><?= $vehicle['description']; ?></textarea>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="price">Precio</label>
                                            <input type="number" class="form-control" name="price"
                                                value="<?= $vehicle['price']; ?>" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="capacity">Capacidad</label>
                                            <input type="number" class="form-control" name="capacity"
                                                value="<?= $vehicle['capacity']; ?>" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="image_url">URL de Imagen</label>
                                            <input type="text" class="form-control" name="image_url"
                                                value="<?= $vehicle['image_url']; ?>" required>
                                        </div>
                                        <br>
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" name="update_vehicle"
                                                class="btn btn-primary">Actualizar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12">
                    <p class="text-center">No hay vehículos registrados.</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Modal para agregar nuevo vehículo -->
        <div class="modal fade" id="addVehicleModal" tabindex="-1" aria-labelledby="addVehicleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addVehicleModalLabel">Agregar Nuevo Vehículo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            <input type="hidden" name="inn_id" value="<?= $inn_id; ?>">
                            <div class="form-group">
                                <label for="type">Tipo</label>
                                <input type="text" class="form-control" name="type" required>
                            </div>
                            <div class="form-group">
                                <label for="brand">Marca</label>
                                <input type="text" class="form-control" name="brand" required>
                            </div>
                            <div class="form-group">
                                <label for="model">Modelo</label>
                                <input type="text" class="form-control" name="model" required>
                            </div>
                            <div class="form-group">
                                <label for="year">Año</label>
                                <input type="number" class="form-control" name="year" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Descripción</label>
                                <textarea class="form-control" name="description" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="price">Precio</label>
                                <input type="number" class="form-control" name="price" required>
                            </div>
                            <div class="form-group">
                                <label for="capacity">Capacidad</label>
                                <input type="number" class="form-control" name="capacity" required>
                            </div>
                            <div class="form-group">
                                <label for="registration_plate">Placa de Registro</label>
                                <input type="text" class="form-control" name="registration_plate" required>
                            </div>
                            <div class="form-group">
                                <label for="status">Estado</label>
                                <select class="form-control" name="status" required>
                                    <option value="1">Activo</option>
                                    <option value="0">Bloqueado</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="image_url">URL de Imagen</label>
                                <input type="text" class="form-control" name="image_url" required>
                            </div>
                            <div class="form-group">
                                <label for="invoice">Factura</label>
                                <input type="text" class="form-control" name="invoice" required>
                            </div>
                            <br>
                            <div class="d-flex justify-content-center">
                                <button type="submit" name="add_vehicle" class="btn btn-primary">Agregar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para agregar nueva habitación -->
        <div class="modal fade" id="addRoomModal" tabindex="-1" aria-labelledby="addRoomModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addRoomModalLabel">Agregar Nueva Habitación</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            <div class="form-group">
                                <label for="room_number">Número de Habitación</label>
                                <input type="text" class="form-control" name="room_number" required>
                            </div>
                            <div class="form-group">
                                <label for="type">Tipo</label>
                                <input type="text" class="form-control" name="type" required>
                            </div>
                            <div class="form-group">
                                <label for="quality">Calidad</label>
                                <input type="text" class="form-control" name="quality" required>
                            </div>
                            <div class="form-group">
                                <label for="image_url">URL de Imagen</label>
                                <input type="text" class="form-control" name="image_url" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Descripción</label>
                                <textarea class="form-control" name="description" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="price">Precio</label>
                                <input type="number" class="form-control" name="price" required>
                            </div>
                            <div class="form-group">
                                <label for="capacity">Capacidad</label>
                                <input type="number" class="form-control" name="capacity" required>
                            </div>
                            <br>
                            <div class="d-flex justify-content-center">
                                <button type="submit" name="add_room" class="btn btn-primary">Agregar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php include './Footer.php'; ?>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>