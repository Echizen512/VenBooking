<?php
include '../config/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Obtener tipo de membresía y cantidad de posadas
$sql_membership = "SELECT profile.membership_type, COUNT(inns.id) AS inn_count 
                   FROM profile 
                   LEFT JOIN inns ON profile.id = inns.user_id 
                   WHERE profile.id = ?";
$stmt_membership = $conn->prepare($sql_membership);
$stmt_membership->bind_param("i", $user_id);
$stmt_membership->execute();
$result_membership = $stmt_membership->get_result();

if ($result_membership === false) {
    die('Error al ejecutar la consulta: ' . $conn->error);
}

$membership_data = $result_membership->fetch_assoc();
$membership_type = $membership_data['membership_type'];
$inn_count = $membership_data['inn_count'];

// SELECT con rif incluido
$sql = "SELECT inns.id, inns.name, inns.description, inns.email, inns.phone, inns.rif, inns.block, 
        inns.image_url, inns.state_id, inns.municipality_id, inns.parish_id, inns.category_id,
        states.name AS state_name, municipalities.name AS municipality_name, 
        parishes.name AS parish_name, categories.name AS category_name
FROM inns
LEFT JOIN states ON inns.state_id = states.id
LEFT JOIN municipalities ON inns.municipality_id = municipalities.id
LEFT JOIN parishes ON inns.parish_id = parishes.id
LEFT JOIN categories ON inns.category_id = categories.id
WHERE inns.user_id = ?";

$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die('Error al preparar la consulta: ' . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result === false) {
    die('Error al ejecutar la consulta: ' . $conn->error);
}

$message = null;
$messageType = null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    if ($_POST['action'] == "create") {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $image_url = $_POST['image_url'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $rif = $_POST['rif'];
        $state_id = $_POST['state'];
        $municipality_id = $_POST['municipality'];
        $parish_id = $_POST['parish'];
        $category_id = $_POST['category'];
        $user_id = $_SESSION['user_id'];
        $quality = $_POST['quality'];

        $sql = "INSERT INTO inns (name, description, image_url, email, phone, rif, state_id, municipality_id, parish_id, category_id, user_id, quality)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssiiiis", $name, $description, $image_url, $email, $phone, $rif, $state_id, $municipality_id, $parish_id, $category_id, $user_id, $quality);

        if ($stmt->execute()) {
            $message = "Posada creada correctamente.";
            $messageType = "success";
            echo "<script>
                setTimeout(function() {
                    window.location.href = '../Enterprise/Inns.php';
                }, 2000);
            </script>";
        } else {
            $message = "Hubo un problema al crear la posada: " . $stmt->error;
            $messageType = "error";
        }
    } elseif ($_POST['action'] == "edit") {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $image_url = $_POST['image_url'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $rif = $_POST['rif'];
        $state_id = $_POST['state'];
        $municipality_id = $_POST['municipality'];
        $parish_id = $_POST['parish'];
        $category_id = $_POST['category'];
        $quality = $_POST['quality'];

        $sql = "UPDATE inns SET name=?, description=?, image_url=?, email=?, phone=?, rif=?, state_id=?, municipality_id=?, parish_id=?, category_id=?, quality=? WHERE id=?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssiiisii", $name, $description, $image_url, $email, $phone, $rif, $state_id, $municipality_id, $parish_id, $category_id, $quality, $id);

        if ($stmt->execute()) {
            $message = "Posada actualizada correctamente.";
            $messageType = "success";
            echo "<script>
                setTimeout(function() {
                    window.location.href = '../Enterprise/Inns.php';
                }, 2000);
            </script>";
        } else {
            $message = "Hubo un problema al actualizar la posada: " . $stmt->error;
            $messageType = "error";
        }
    }
}

$conn->close();
?>
