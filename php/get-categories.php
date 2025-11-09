<?php
include '../config/db.php';
$sql = "SELECT id, name FROM categories";
$result = $conn->query($sql);
$categories = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
}
echo json_encode($categories);
$conn->close();
?>