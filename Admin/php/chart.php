<?php
include '../config/db.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$sql_inns = "SELECT inns.name, COUNT(reservations.id) AS reservation_count
             FROM reservations
             JOIN inns ON reservations.inn_id = inns.id
             GROUP BY inns.name
             ORDER BY reservation_count DESC";

$sql_payment_methods = "SELECT 
                            CASE reservations.payment_method_id
                                WHEN 1 THEN 'Pago Móvil'
                                WHEN 2 THEN 'Transferencia'
                                WHEN 3 THEN 'Efectivo'
                                ELSE 'Desconocido'
                            END AS payment_method,
                            COUNT(reservations.id) AS payment_count
                        FROM reservations
                        GROUP BY payment_method_id
                        ORDER BY payment_count DESC";

$inns_result = $conn->query($sql_inns);
$payment_methods_result = $conn->query($sql_payment_methods);

$inns_data = [];
$payment_methods_data = [];

if ($inns_result) {
    while ($row = $inns_result->fetch_assoc()) {
        $inns_data[] = ['name' => $row['name'], 'count' => $row['reservation_count']];
    }
} else {
    die('Error al ejecutar la consulta de posadas: ' . $conn->error);
}

if ($payment_methods_result) {
    while ($row = $payment_methods_result->fetch_assoc()) {
        $payment_methods_data[] = ['name' => $row['payment_method'], 'count' => $row['payment_count']];
    }
} else {
    die('Error al ejecutar la consulta de métodos de pago: ' . $conn->error);
}

$conn->close();
?>
