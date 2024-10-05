<?php
session_start();
include '../config/db.php';
include './Dashboard.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image_url = $_POST['image_url'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $state_id = $_POST['state'];
    $municipality_id = $_POST['municipality'];
    $parish_id = $_POST['parish'];
    $category_id = $_POST['category'];
    $user_id = $_SESSION['user_id'];
    

    $sql = "INSERT INTO inns (name, description, image_url, email, phone, state_id, municipality_id, parish_id, category_id, user_id)
            VALUES ('$name', '$description', '$image_url', '$email', '$phone', '$state_id', '$municipality_id', '$parish_id', '$category_id', '$user_id')";

    if ($conn->query($sql) === TRUE) {
        header("Location: get_inns.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
