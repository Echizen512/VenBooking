<?php
require './config/db.php'; // Conexión a la base de datos

if (isset($_POST['recover'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 'error', 'message' => 'Correo inválido.']);
        exit();
    }

    $query = "SELECT `id`, `first_name` FROM `profile` WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        echo json_encode(['status' => 'success', 'message' => 'Hola, ' . $user['first_name'] . '. Ingresa tu nueva contraseña.', 'user_id' => $user['id']]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'El correo no está registrado.']);
    }
    exit();
}

if (isset($_POST['new_password']) && isset($_POST['user_id'])) {
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
    $user_id = $_POST['user_id'];

    $query = "UPDATE `profile` SET `password` = ? WHERE `id` = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('si', $new_password, $user_id);

    if ($stmt->execute()) {
        // Redirigir a login.php si se hace el UPDATE correctamente
        echo json_encode(['status' => 'success', 'message' => 'Contraseña actualizada exitosamente.', 'redirect' => 'login.php']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al actualizar la contraseña.']);
    }
    exit();
}
?>
