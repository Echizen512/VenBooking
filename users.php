<?php
session_start();
include_once "./config/db.php";
if (!isset($_SESSION['user_id'])) {
  header("location: login.php");
  exit();
}
?>

<?php include "./head.php"; ?>

<link href="./Assets/css/responsive.css" rel="stylesheet">
<link rel="stylesheet" href="./Assets/css/users.css">

<body>
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php
          $sql = mysqli_query($conn, "SELECT * FROM profile WHERE id = {$_SESSION['user_id']}");
          if ($sql && mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
          } else {
            echo "<p>Error: Usuario no encontrado.</p>";
          }
          ?>
          <?php if (isset($row)): ?>
            <img src="<?php echo htmlspecialchars($row['profile_image_url']); ?>" alt="Profile Image">
            <div class="details">
              <span><?php echo htmlspecialchars($row['first_name']) . " " . htmlspecialchars($row['last_name']); ?></span>
              <p><?php echo htmlspecialchars($row['profile_type']); ?></p>
            </div>
          <?php endif; ?>
        </div>
        <a href="index.php" class="logout">Inicio</a>
      </header>
      <div class="search">
        <span class="text">Selecciona un usuario para iniciar el chat</span>
        <input type="text" placeholder="Nombre de usuario...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">

      </div>
    </section>
  </div>

  <script src="./Assets/js/users.js"></script>
</body>

</html>