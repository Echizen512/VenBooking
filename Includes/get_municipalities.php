<?php
    include '../config/db.php';
    include './Dashboard.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['state_id'])) {
    $state_id = $_POST['state_id'];
    $sql = "SELECT * FROM municipalities WHERE state_id = '$state_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
        }
    } else {
        echo "<option value=''>No municipalities found</option>";
    }
}

$conn->close();
?>
