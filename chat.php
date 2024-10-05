<?php
session_start();
include "./config/db.php";
if (!isset($_SESSION['user_id'])) {
  header("location: ./login.php");
}
?>

<?php include "./head.php"; ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./Assets/css/responsive.css" rel="stylesheet">
  <link rel="stylesheet" href="./Chat.css">
</head>


<body>
  <div class="wrapper">
    <section class="chat-area">
      <header>
        <?php
        $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
        $sql = mysqli_query($conn, "SELECT * FROM profile WHERE id = {$user_id}");
        if (mysqli_num_rows($sql) > 0) {
          $row = mysqli_fetch_assoc($sql);
        } else {
          header("location: users.php");
        }
        ?>
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="<?php echo $row['profile_image_url']; ?>" alt="Profile Image">
        <div class="details">
          <span><?php echo $row['first_name'] . " " . $row['last_name'] ?></span>
          <p><?php echo $row['profile_type']; ?></p>
        </div>
      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Escribe tu mensaje aquí..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>

  <script src="./Assets/js/chat.js"></script>
</body>
</html>
