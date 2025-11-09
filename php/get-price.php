<?php
include './config/db.php';

if (isset($_GET['room_id']) && isset($_GET['start_date']) && isset($_GET['end_date'])) {
    $room_id = intval($_GET['room_id']);
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];

    
    $sql = "SELECT price FROM rooms WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $room_id);
    $stmt->execute();
    $stmt->bind_result($price_per_night);
    $stmt->fetch();

    $start = new DateTime($start_date);
    $end = new DateTime($end_date);
    $days = $start->diff($end)->days + 1;

    echo $price_per_night * $days;
}
?>