<?php
include '../config/db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inn_id = $_POST['inn_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $payment_method = $_POST['payment_method'];
    $reference_code = $_POST['reference_code'];
    $status = 'En Espera';
    $sql_get_amount = "SELECT amount FROM payment_methods WHERE id = ?";
    $stmt = $conn->prepare($sql_get_amount);
    if (!$stmt) {
        die("Error en la consulta del monto: " . $conn->error);
    }
    $stmt->bind_param('i', $payment_method);
    $stmt->execute();
    $stmt->bind_result($amount);
    $stmt->fetch();
    $stmt->close();
    $start = new DateTime($start_date);
    $end = new DateTime($end_date);
    $interval = $start->diff($end);
    $total_days = $interval->days + 1;
    $total_amount = $amount * $total_days;
    if (isset($_FILES['receipt']) && $_FILES['receipt']['error'] == UPLOAD_ERR_OK) {
        $file_tmp_name = $_FILES['receipt']['tmp_name'];
        $file_name = $_FILES['receipt']['name'];
        $file_type = $_FILES['receipt']['type'];
        $upload_dir = __DIR__ . '/../uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $file_path = $upload_dir . basename($file_name);
        $allowed_types = array('image/jpeg', 'image/png', 'application/pdf');
        if (!in_array($file_type, $allowed_types)) {
            die("Tipo de archivo no permitido.");
        }
        if (file_exists($file_path)) {
            die("El archivo ya existe.");
        }
        if (move_uploaded_file($file_tmp_name, $file_path)) {
            $receipt_path = 'uploads/' . basename($file_name);
        } else {
            die("Error al cargar el archivo.");
        }
    } else {
        die("No se ha cargado ningún archivo.");
    }
    $sql_check_availability = "SELECT * FROM reservations 
                               WHERE inn_id = ? 
                               AND (start_date <= ? AND end_date >= ?)";
    $stmt = $conn->prepare($sql_check_availability);
    if (!$stmt) {
        die("Error en la consulta de disponibilidad: " . $conn->error);
    }
    $stmt->bind_param('iss', $inn_id, $end_date, $start_date);
    $stmt->execute();
    $result_check = $stmt->get_result();
    if ($result_check->num_rows > 0) {
        die("Las fechas seleccionadas no están disponibles.");
    }
    $sql_insert_reservation = "INSERT INTO reservations (inn_id, start_date, end_date, payment_method_id, receipt_path, status, reference_code, total_amount)
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_insert_reservation);
    if (!$stmt) {
        die("Error en la consulta de inserción: " . $conn->error);
    }
    $stmt->bind_param('issssssi', $inn_id, $start_date, $end_date, $payment_method, $receipt_path, $status, $reference_code, $total_amount);
    if ($stmt->execute()) {
        echo "Reserva confirmada exitosamente.";
    } else {
        echo "Error al confirmar la reserva: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
} else {
    echo "Método de solicitud no permitido.";
}
?>