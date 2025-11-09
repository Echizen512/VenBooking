<?php
session_start();
include './config/db.php';
if (isset($_SESSION['user_id'])) {
    include './Includes/Header.php';
} else {
    include './Includes/Header2.php';
}
$state_id = isset($_GET['state']) ? $_GET['state'] : '';

$sql_inns = "SELECT i.id, i.name AS inn_name, i.description, i.image_url, i.email, i.phone, 
                   s.name AS state_name, m.name AS municipality_name, p.name AS parish_name, i.category_id, 
                   i.quality
            FROM inns i
            LEFT JOIN states s ON i.state_id = s.id
            LEFT JOIN municipalities m ON i.municipality_id = m.id
            LEFT JOIN parishes p ON i.parish_id = p.id";
if ($state_id && $state_id != 'all') {
    $sql_inns .= " WHERE i.state_id = '$state_id'";
}

$result_inns = $conn->query($sql_inns);
if (!$result_inns) {
    die("Error en la consulta de posadas: " . $conn->error);
}
?>