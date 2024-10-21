<?php
include '../config/db.php';

if (isset($_GET['state_id'])) {
    $state_id = $_GET['state_id'];
    $sql = "SELECT id, name FROM municipalities WHERE state_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $state_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $municipalities = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $municipalities[] = $row;
        }
    }

    echo json_encode($municipalities);
    $stmt->close();
}

$conn->close();
?>