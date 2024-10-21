<?php
include '../config/db.php';

$sql = "SELECT id, name FROM states";
$result = $conn->query($sql);

$states = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $states[] = $row;
    }
}

echo json_encode($states);
$conn->close();
?>