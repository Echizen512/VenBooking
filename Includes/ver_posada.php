<?php
include '../config/db.php';
session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$inn_id = $_GET['id'];

function executeQuery($stmt, $successMessage, $errorMessage)
{
    if ($stmt->execute()) {
        return true;
    } else {
        echo $errorMessage . ": " . $stmt->error;
        return false;
    }
}


$sql_inn = "SELECT name FROM inns WHERE id = ?";
$stmt_inn = $conn->prepare($sql_inn);
if ($stmt_inn) {
    $stmt_inn->bind_param("i", $inn_id);
    executeQuery($stmt_inn, null, "Error en la consulta SQL para obtener el nombre de la posada");
    $stmt_inn->bind_result($inn_name);
    $stmt_inn->fetch();
    $stmt_inn->close();
}


$sql_rooms = "SELECT * FROM rooms WHERE inn_id = ?";
$stmt_rooms = $conn->prepare($sql_rooms);
if ($stmt_rooms) {
    $stmt_rooms->bind_param("i", $inn_id);
    executeQuery($stmt_rooms, null, "Error en la consulta SQL para obtener habitaciones");
    $result_rooms = $stmt_rooms->get_result();
} else {
    die("Error en la consulta SQL para obtener habitaciones: " . $conn->error);
}


$sql_vehicles = "SELECT * FROM vehicles WHERE inn_id = ?";
$stmt_vehicles = $conn->prepare($sql_vehicles);
if ($stmt_vehicles) {
    $stmt_vehicles->bind_param("i", $inn_id);
    executeQuery($stmt_vehicles, null, "Error en la consulta SQL para obtener vehículos");
    $result_vehicles = $stmt_vehicles->get_result();
} else {
    die("Error en la consulta SQL para obtener vehículos: " . $conn->error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST['add_room']) || isset($_POST['update_room'])) {
        $room_id = $_POST['room_id'] ?? null; 
        $room_number = $_POST['room_number'];
        $type = $_POST['type'];
        $quality = $_POST['quality'];
        $image_url = $_POST['image_url']; 
        $image_url2 = $_POST['image_url2'] ?? null;
        $image_url3 = $_POST['image_url3'] ?? null;
        $image_url4 = $_POST['image_url4'] ?? null;
        $image_url5 = $_POST['image_url5'] ?? null;
        $description = $_POST['description'];
        $price = $_POST['price'];
        $capacity = $_POST['capacity'];

        if (isset($_POST['add_room'])) {
            
            $sql = "INSERT INTO rooms (room_number, type, quality, image_url, image_url2, image_url3, image_url4, image_url5, description, price, capacity, inn_id) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        } else {
            
            $sql = "UPDATE rooms SET room_number = ?, type = ?, quality = ?, image_url = ?, image_url2 = ?, image_url3 = ?, image_url4 = ?, image_url5 = ?, description = ?, price = ?, capacity = ? WHERE id = ?";
        }

        $stmt = $conn->prepare($sql);
        if ($stmt) {
            if (isset($_POST['add_room'])) {
                $stmt->bind_param("sssssssssdii", $room_number, $type, $quality, $image_url, $image_url2, $image_url3, $image_url4, $image_url5, $description, $price, $capacity, $inn_id);
            } else {
                $stmt->bind_param("sssssssssdii", $room_number, $type, $quality, $image_url, $image_url2, $image_url3, $image_url4, $image_url5, $description, $price, $capacity, $room_id);
            }
            executeQuery($stmt, "Habitación procesada correctamente", "Error al procesar la habitación");
            $stmt->close();
            header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $inn_id);
            exit();
        } else {
            die("Error en la consulta SQL para procesar habitación: " . $conn->error);
        }
    }

    
    if (isset($_POST['add_vehicle']) || isset($_POST['update_vehicle'])) {
        $vehicle_id = $_POST['vehicle_id'] ?? null; 
        $inn_id = $_POST['inn_id'] ?? ''; 
        $type = $_POST['type'] ?? '';
        $brand = $_POST['brand'] ?? '';
        $description = $_POST['description'] ?? '';
        $price = $_POST['price'] ?? 0;
        $capacity = $_POST['capacity'] ?? 0;
        $year = $_POST['year'] ?? 0;
        $model = $_POST['model'] ?? '';
        $registration_plate = $_POST['registration_plate'] ?? '';
        $status = $_POST['status'] ?? '';
        $image_url = $_POST['image_url'] ?? '';
        $image_url2 = $_POST['image_url2'] ?? '';
        $image_url3 = $_POST['image_url3'] ?? '';
        $image_url4 = $_POST['image_url4'] ?? '';
        $image_url5 = $_POST['image_url5'] ?? '';
        $invoice = $_POST['invoice'] ?? '';

        if (isset($_POST['add_vehicle'])) {
            
            $sql = "INSERT INTO vehicles (inn_id, type, brand, description, price, capacity, year, model, registration_plate, status, image_url, image_url2, image_url3, image_url4, image_url5, invoice) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);
            if ($stmt) {
                
                $stmt->bind_param("isssdiissssssss", $inn_id, $type, $brand, $description, $price, $capacity, $year, $model, $registration_plate, $status, $image_url, $image_url2, $image_url3, $image_url4, $image_url5, $invoice);
            }
        } else {
            
            $sql = "UPDATE vehicles SET type = ?, brand = ?, description = ?, price = ?, capacity = ?, year = ?, model = ?, registration_plate = ?, status = ?, image_url = ?, image_url2 = ?, image_url3 = ?, image_url4 = ?, image_url5 = ?, invoice = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                
                $stmt->bind_param("isssdiissssssssi", $type, $brand, $description, $price, $capacity, $year, $model, $registration_plate, $status, $image_url, $image_url2, $image_url3, $image_url4, $image_url5, $invoice, $vehicle_id);
            }
        }
    }


    
    if (isset($_POST['toggle_block'])) {
        $id = $_POST['id'];
        $type = $_POST['type'];

        $sql = ($type === 'vehicle') ? "SELECT block FROM vehicles WHERE id = ?" : "SELECT block FROM rooms WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $id);
            executeQuery($stmt, null, "Error en la consulta SQL para obtener estado de bloqueo");
            $stmt->bind_result($currentBlock);
            $stmt->fetch();
            $stmt->close();

            $newBlock = $currentBlock ? 0 : 1;
            $sql = ($type === 'vehicle') ? "UPDATE vehicles SET block = ? WHERE id = ?" : "UPDATE rooms SET block = ? WHERE id = ?";

            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("ii", $newBlock, $id);
                executeQuery($stmt, null, "Error en la consulta SQL para cambiar estado de bloqueo");
                $stmt->close();
                header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $inn_id);
                exit();
            } else {
                die("Error en la consulta SQL para cambiar estado de bloqueo: " . $conn->error);
            }
        } else {
            die("Error en la consulta SQL para obtener estado de bloqueo: " . $conn->error);
        }
    }
}

$conn->close();
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

    html,
    body {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
    }

    * {
        box-sizing: border-box;
    }

    .footer {
        width: 100%;
        position: relative;
        left: 0;
        right: 0;
        margin: 0;
        padding: 10px 0;
    }
    .btn-success {
        transition: background-color 0.3s, border-color 0.3s;
    }

    .btn-success:hover {
        background-color: #27ae60;
        border-color: #219150;
    }

    h3 {
        font-weight: bold;
    }
    
</style>
<body>

    <?php include './Header3.php'; ?>

    <div class="container mt-5">
        <h2 class="mb-4 text-center" style="font-size: 28px;">
            <i class="fas fa-home" style="font-size: 28px;"></i> <?php echo htmlspecialchars($inn_name); ?>
        </h2>
        <div class="row mb-5">
            <div class="col-12 d-flex justify-content-between align-items-center mb-3">
                <h3 class="mb-0" style="font-size: 28px; color: #2c3e50;">
                    <i class="fas fa-bed" style="font-size: 28px; margin-right: 8px;"></i>
                    Habitaciones
                </h3>
                <button class="btn btn-success" style="font-size: 14px; padding: 10px 15px; border-radius: 5px;"
                    data-bs-toggle="modal" data-bs-target="#addRoomModal">
                    <i class="fas fa-plus" style="margin-right: 5px;"></i> Agregar Habitación
                </button>
            </div>

            <?php if ($result_rooms->num_rows > 0): ?>
                <?php while ($room = $result_rooms->fetch_assoc()): ?>
                    <div class="col-md-4">
                        <div class="card shadow-sm mb-4">
                            <!-- Carousel para imágenes de habitación -->
                            <div id="roomCarousel<?= $room['id']; ?>" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <?php
                                    $images = ['image_url', 'image_url2', 'image_url3', 'image_url4', 'image_url5'];
                                    $active = true;
                                    foreach ($images as $img_field):
                                        if (!empty($room[$img_field])): ?>
                                            <div class="carousel-item <?= $active ? 'active' : ''; ?>">
                                                <img src="<?= $room[$img_field]; ?>" class="d-block w-100" alt="Imagen de la Habitación"
                                                    style="height: 200px; object-fit: cover;">
                                            </div>
                                            <?php $active = false; ?>
                                        <?php endif;
                                    endforeach; ?>
                                </div>
                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#roomCarousel<?= $room['id']; ?>" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Anterior</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#roomCarousel<?= $room['id']; ?>" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Siguiente</span>
                                </button>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title" style="font-size: 18px;"><?= $room['type']; ?> - Habitación
                                    <?= $room['room_number']; ?></h5>
                                <p class="card-text text-truncate" style="font-size: 16px;"><?= $room['description']; ?></p>
                                <p style="font-size: 14px;"><i class="fas fa-dollar-sign"></i> <strong>Precio:</strong>
                                    <?= $room['price']; ?></p>
                                <p style="font-size: 14px;"><i class="fas fa-users"></i> <strong>Capacidad:</strong>
                                    <?= $room['capacity']; ?></p>
                                <p style="font-size: 14px;"><i class="fas fa-star"></i> <strong>Calidad:</strong>
                                    <?= $room['quality']; ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <button class="btn btn-primary" style="font-size: 16px;" data-bs-toggle="modal"
                                        data-bs-target="#editRoomModal<?= $room['id']; ?>"><i class="fas fa-edit"></i></button>
                                    <form method="POST" action="<?= $_SERVER['PHP_SELF'] . '?id=' . $inn_id; ?>"
                                        style="display: inline;">
                                        <input type="hidden" name="id" value="<?= $room['id']; ?>">
                                        <input type="hidden" name="type" value="room">
                                        <input type="hidden" name="toggle_block" value="1">
                                        <button type="submit" style="font-size: 16px;"
                                            class="btn btn-sm <?= $room['block'] ? 'btn-danger' : 'btn-outline-success'; ?>"><?= $room['block'] ? 'Bloqueado' : 'Activo'; ?></button>
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
                                            <input type="number" class="form-control" name="room_number"
                                                value="<?= $room['room_number']; ?>" required>
                                        </div>
                                        <div class="form-group mb-3">
                                                <label for="type">Tipo</label>
                                                <select class="form-control" name="type" id="type" required>
                                                    <option value="Solo" <?= $room['type'] === 'Solo' ? 'selected' : ''; ?>>Solo</option>
                                                    <option value="Pareja" <?= $room['type'] === 'Pareja' ? 'selected' : ''; ?>>Pareja</option>
                                                    <option value="Familia" <?= $room['type'] === 'Familia' ? 'selected' : ''; ?>>Familia</option>
                                                    <option value="Grupal" <?= $room['type'] === 'Grupal' ? 'selected' : ''; ?>>Grupal</option>
                                                </select>
                                            </div>
                                        <div class="form-group mb-3">
                                            <label for="quality">Calidad</label>
                                            <select class="form-control" name="quality" id="quality" required>
                                                <option value="Alta" <?= $room['quality'] === 'Alta' ? 'selected' : ''; ?>>Alta</option>
                                                <option value="Media" <?= $room['quality'] === 'Media' ? 'selected' : ''; ?>>Media</option>
                                                <option value="Baja" <?= $room['quality'] === 'Baja' ? 'selected' : ''; ?>>Baja</option>
                                            </select>
                                        </div>
                                        <?php foreach ($images as $img_field): ?>
                                            <div class="form-group mb-3">
                                                <label for="<?= $img_field; ?>">URL de
                                                    <?= ucfirst(str_replace('_', ' ', $img_field)); ?></label>
                                                <input type="url" class="form-control" name="<?= $img_field; ?>"
                                                    value="<?= $room[$img_field]; ?>">
                                            </div>
                                        <?php endforeach; ?>
                                        <div class="form-group mb-3">
                                            <label for="description">Descripción</label>
                                            <textarea class="form-control" name="description" id="description" required
                                                pattern="[A-Za-zÀ-ÿ\s]+" title="Solo se permiten letras, acentos y espacios.">
                                                <?= htmlspecialchars($room['description']); ?>
                                            </textarea>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="price">Precio</label>
                                            <input type="number" class="form-control" name="price" id="price" value="<?= $room['price']; ?>" 
                                                required step="1" max="1000.00" title="El precio no puede superar los 1000.00">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="capacity">Capacidad</label>
                                            <input type="number" class="form-control" name="capacity" id="capacity" value="<?= $room['capacity']; ?>" 
                                                required max="10" title="La capacidad máxima es de 10">
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
            <div class="col-12 d-flex justify-content-between align-items-center mb-4">
                <h3 class="mb-0 d-flex align-items-center" style="font-size: 28px; color: #2c3e50;">
                    <i class="fas fa-car" style="font-size: 28px; margin-right: 10px; color: #27ae60;"></i>
                    Vehículos
                </h3>
                <button class="btn btn-success"
                    style="font-size: 14px; padding: 10px 20px; border-radius: 5px; transition: background-color 0.3s, transform 0.3s;"
                    data-bs-toggle="modal" data-bs-target="#addVehicleModal">
                    <i class="fas fa-plus" style="margin-right: 5px;"></i> Agregar Vehículo
                </button>
            </div>

            <style>
                .btn-success {
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                }

                .btn-success:hover {
                    background-color: #27ae60;
                    transform: translateY(-2px);
                }

                h3 {
                    font-weight: 700;
                    letter-spacing: 0.5px;
                }
            </style>

            <?php if ($result_vehicles->num_rows > 0): ?>
                <?php while ($vehicle = $result_vehicles->fetch_assoc()): ?>
                    <div class="col-md-4">
                        <div class="card shadow-sm mb-4">
                            <!-- Carousel para imágenes de vehículos -->
                            <div id="vehicleCarousel<?= $vehicle['id']; ?>" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <?php
                                    $images = ['image_url', 'image_url2', 'image_url3', 'image_url4', 'image_url5'];
                                    $active = true;
                                    foreach ($images as $img_field):
                                        if (!empty($vehicle[$img_field])): ?>
                                            <div class="carousel-item <?= $active ? 'active' : ''; ?>">
                                                <img src="<?= $vehicle[$img_field]; ?>" class="d-block w-100" alt="Imagen del Vehículo"
                                                    style="height: 200px; object-fit: cover;">
                                            </div>
                                            <?php $active = false; ?>
                                        <?php endif;
                                    endforeach; ?>
                                </div>
                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#vehicleCarousel<?= $vehicle['id']; ?>" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Anterior</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#vehicleCarousel<?= $vehicle['id']; ?>" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Siguiente</span>
                                </button>
                            </div>

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
                                        data-bs-target="#editVehicleModal<?= $vehicle['id']; ?>"><i
                                            class="fas fa-edit"></i></button>
                                    <form method="POST" action="<?= $_SERVER['PHP_SELF'] . '?id=' . $inn_id; ?>"
                                        style="display: inline;">
                                        <input type="hidden" name="id" value="<?= $vehicle['id']; ?>">
                                        <input type="hidden" name="toggle_block" value="1">
                                        <input type="hidden" name="type" value="vehicle">
                                        <button type="submit" style="font-size: 16px;"
                                            class="btn btn-sm <?= $vehicle['block'] ? 'btn-danger' : 'btn-outline-success'; ?>"><?= $vehicle['block'] ? 'Bloqueado' : 'Activo'; ?></button>
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
                                            <input type="number" class="form-control" name="year" id="year"
                                                value="<?= $vehicle['year']; ?>" min="2000" max="<?= date('Y'); ?>" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="description">Descripción</label>
                                            <textarea class="form-control" name="description" pattern="^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$" 
                                                title="Solo letras y espacios" required><?= $vehicle['description']; ?></textarea>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="price">Precio</label>
                                            <input type="number" class="form-control" name="price" value="<?= $vehicle['price']; ?>" 
                                                max="1000.00" step="1" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="capacity">Capacidad</label>
                                            <input type="number" class="form-control" name="capacity" value="<?= $vehicle['capacity']; ?>" 
                                                max="6" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="registration_plate">Matrícula</label>
                                            <input type="text" class="form-control" name="registration_plate"
                                                value="<?= $vehicle['registration_plate']; ?>" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="status">Estado</label>
                                            <input type="text" class="form-control" name="status"
                                                value="<?= $vehicle['status']; ?>" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="invoice">Factura</label>
                                            <input type="text" class="form-control" name="invoice"
                                                value="<?= $vehicle['invoice']; ?>">
                                        </div>

                                        <!-- Campos para las imágenes -->
                                        <?php
                                        $images = ['image_url', 'image_url2', 'image_url3', 'image_url4', 'image_url5']; // Define tus campos de imagen
                                        foreach ($images as $img_field): ?>
                                            <div class="form-group mb-3">
                                                <label for="<?= $img_field; ?>">URL de Imagen <?= substr($img_field, -1); ?></label>
                                                <input type="text" class="form-control" name="<?= $img_field; ?>"
                                                    value="<?= $vehicle[$img_field]; ?>" <?= $img_field === 'image_url' ? 'required' : ''; ?>>
                                            </div>
                                        <?php endforeach; ?>

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
                    <div class="alert alert-warning" role="alert">
                        No hay vehículos disponibles.
                    </div>
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
                                <input type="number" class="form-control" name="room_number" required>
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
                                <label for="image_url">URL de Imagen (Obligatoria)</label>
                                <input type="text" class="form-control" name="image_url" required>
                            </div>
                            <div class="form-group">
                                <label for="image_url2">URL de Imagen 2</label>
                                <input type="text" class="form-control" name="image_url2">
                            </div>
                            <div class="form-group">
                                <label for="image_url3">URL de Imagen 3</label>
                                <input type="text" class="form-control" name="image_url3">
                            </div>
                            <div class="form-group">
                                <label for="image_url4">URL de Imagen 4</label>
                                <input type="text" class="form-control" name="image_url4">
                            </div>
                            <div class="form-group">
                                <label for="image_url5">URL de Imagen 5</label>
                                <input type="text" class="form-control" name="image_url5">
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




        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>