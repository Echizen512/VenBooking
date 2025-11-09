<?php

session_start();

include './config/db.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT profile_type FROM Profile WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($profile_type);
        $stmt->fetch();
        $stmt->close();

        if ($profile_type === "Empresa" && basename($_SERVER['PHP_SELF']) !== 'Inicio.php') {
            header("Location: Includes/Inicio.php");
            exit;
        }
        if ($profile_type === "Turista" && basename($_SERVER['PHP_SELF']) !== 'Inns.php') {
            header("Location: Inns.php");
            exit;
        }
    } else {
        echo "Error al preparar la consulta.";
    }
}

if (isset($_SESSION['user_id'])) {
    include './Includes/Header.php';
} else {
    include './Includes/Header2.php';
}

$search = isset($_GET['search']) && !empty($_GET['search']) ? '%' . $conn->real_escape_string($_GET['search']) . '%' : '%';

$sql_inns = "
    SELECT 
        i.id AS inn_id,
        i.name AS inn_name,
        i.description,
        i.image_url,
        i.email,
        i.phone,
        s.name AS state_name,
        m.name AS municipality_name,
        p.name AS parish_name,
        i.category_id,
        i.quality,
        COUNT(rw.id) AS total_reviews,
        ROUND(AVG(rw.rating), 2) AS average_rating
    FROM inns i
    LEFT JOIN states s ON i.state_id = s.id
    LEFT JOIN municipalities m ON i.municipality_id = m.id
    LEFT JOIN parishes p ON i.parish_id = p.id
    LEFT JOIN reservations rs ON i.id = rs.inn_id
    LEFT JOIN reviews rw ON rs.id = rw.reservation_id
    WHERE i.name LIKE ?
    GROUP BY i.id
    ORDER BY i.name ASC
";

$stmt = $conn->prepare($sql_inns);
$stmt->bind_param("s", $search);
$stmt->execute();
$result_inns = $stmt->get_result();

if (!$result_inns) {
    die("Error en la consulta de posadas: " . $conn->error);
}

?>