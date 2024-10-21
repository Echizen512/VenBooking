<?php
include '../config/db.php';

if (isset($_GET['municipality_id'])) {
    $municipality_id = $_GET['municipality_id'];
    $sql = "SELECT id, name FROM parishes WHERE municipality_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $municipality_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $parishes = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $parishes[] = $row;
        }
    }

    echo json_encode($parishes);
    $stmt->close();
}

$conn->close();
?>