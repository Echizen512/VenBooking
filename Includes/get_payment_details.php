<?php
include '../config/db.php';

$method_id = intval($_GET['method_id']);
$response = array();

if ($method_id) {
    $sql = "SELECT details FROM payment_details WHERE payment_method_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $method_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $response['details'] = $row['details'];
    } else {
        $response['details'] = '';
    }

    $stmt->close();
}

echo json_encode($response);
?>
