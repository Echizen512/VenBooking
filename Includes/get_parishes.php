<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "VenBooking";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['municipality_id'])) {
    $municipality_id = $_POST['municipality_id'];
    $sql = "SELECT * FROM parishes WHERE municipality_id = '$municipality_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
        }
    } else {
        echo "<option value=''>No parishes found</option>";
    }
}

$conn->close();
?>
