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
        $image_url2 = $_POST['image_url2'] ?? null;
        $image_url3 = $_POST['image_url3'] ?? null;
        $image_url4 = $_POST['image_url4'] ?? null;
        $image_url5 = $_POST['image_url5'] ?? null;

        if (isset($_POST['add_vehicle'])) {
            $sql = "INSERT INTO vehicles 
                (inn_id, type, brand, description, price, capacity, year, model, registration_plate, status, image_url, image_url2, image_url3, image_url4, image_url5) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param(
                    "isssdiissssssss",
                    $inn_id, $type, $brand, $description, $price, $capacity, $year, $model, $registration_plate, $status,
                    $image_url, $image_url2, $image_url3, $image_url4, $image_url5
                );
                executeQuery($stmt, "Vehículo agregado correctamente", "Error al agregar el vehículo");
                $stmt->close();
            } else {
                die("Error en la preparación de la consulta para agregar vehículo: " . $conn->error);
            }
        } elseif (isset($_POST['update_vehicle'])) {
            $vehicle_id = $_POST['vehicle_id'];
            $sql = "UPDATE vehicles 
                SET type = ?, brand = ?, description = ?, price = ?, capacity = ?, year = ?, model = ?, registration_plate = ?, status = ?, 
                image_url = ?, image_url2 = ?, image_url3 = ?, image_url4 = ?, image_url5 = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param(
                    "sssdiissssssssi",
                    $type, $brand, $description, $price, $capacity, $year, $model, $registration_plate, $status,
                    $image_url, $image_url2, $image_url3, $image_url4, $image_url5, $vehicle_id
                );
                executeQuery($stmt, "Vehículo actualizado correctamente", "Error al actualizar el vehículo");
                $stmt->close();
            } else {
                die("Error en la preparación de la consulta para actualizar vehículo: " . $conn->error);
            }
        }

        header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $inn_id);
        exit();
    }

    if (isset($_POST['toggle_block'])) {
        $id = $_POST['id'];
        $type = $_POST['type'];

        $table = ($type === 'vehicle') ? "vehicles" : "rooms";

        $sql = "SELECT block FROM $table WHERE id = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $id);
            executeQuery($stmt, null, "Error al obtener el estado de bloqueo");
            $stmt->bind_result($currentBlock);
            $stmt->fetch();
            $stmt->close();

            $newBlock = $currentBlock ? 0 : 1;
            $sql = "UPDATE $table SET block = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("ii", $newBlock, $id);
                executeQuery($stmt, "Estado de bloqueo actualizado correctamente", "Error al actualizar el estado de bloqueo");
                $stmt->close();
            } else {
                die("Error en la consulta para cambiar estado de bloqueo: " . $conn->error);
            }
        } else {
            die("Error en la consulta para obtener estado de bloqueo: " . $conn->error);
        }

        header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $inn_id);
        exit();
    }
}

$conn->close();

?>