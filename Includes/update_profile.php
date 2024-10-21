<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    $profile_image_url = $_POST['profile_image_url'];
    $banner_image_url = $_POST['banner_image_url'];
    $youtube_url = $_POST['youtube_url'];
    $facebook_url = $_POST['facebook_url'];
    $twitter_url = $_POST['twitter_url'];
    $instagram_url = $_POST['instagram_url'];


    if (!empty($password)) {
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $sql_update = "UPDATE Profile SET first_name = ?, last_name = ?, email = ?, password = ?, profile_image_url = ?, banner_image_url = ?, youtube_url = ?, facebook_url = ?, twitter_url = ?, instagram_url = ? WHERE id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ssssssssssi", $first_name, $last_name, $email, $password_hash, $profile_image_url, $banner_image_url, $youtube_url, $facebook_url, $twitter_url, $instagram_url, $user_id);
    } else {
        $sql_update = "UPDATE Profile SET first_name = ?, last_name = ?, email = ?, profile_image_url = ?, banner_image_url = ?, youtube_url = ?, facebook_url = ?, twitter_url = ?, instagram_url = ? WHERE id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("sssssssssi", $first_name, $last_name, $email, $profile_image_url, $banner_image_url, $youtube_url, $facebook_url, $twitter_url, $instagram_url, $user_id);
    }

    if ($stmt_update->execute()) {
        header("Location: ../profile.php");
        exit();
    } else {
        echo "Error al actualizar el perfil: " . $conn->error;
    }
}
?>