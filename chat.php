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
  <link rel="stylesheet" href="./Assets/css/Chat.css">
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="./assets/css/owl.theme.default.css">
  <link rel="stylesheet" type="text/css" href="./assets/css/jquery.rateyo.css" />
  <link rel="stylesheet" type="text/css" href="./assets/css/jquery.mmenu.all.css" />
  <link rel="stylesheet" type="text/css" href="./assets/css/inner-page-style.css">
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" type="text/css" media="screen" href="./assets/css/style.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    .site-header {
      width: 100%;
      position: fixed;
      top: 0;
      z-index: 1000;
      background: white;
    }
    .wrapper {
      margin-top: 700px;
      margin-bottom: 30px;
      
    }

    html, body {
  height: 100%;
  margin: 0;
  display: flex;
  flex-direction: column;
}

footer {
  width: 100%;
  margin: 0;
}


  </style>
</head>

<body>
  
    <header class="site-header">
        <div class="top-header bg-success">
            <div class="container">
                <div class="top-header-left">
                    <div class="top-header-block">
                        <a href="mailto:venbooking@gmail.com" style="color:white;" class="text-white" itemprop="email">
                            <i class="fas fa-envelope text-warning"></i> Soporte Técnico: venbooking@gmail.com
                        </a>
                    </div>
                </div>
                <div class="top-header-right">
                    <a href="#" id="logout-btn">
                        <button class="logout-btn">
                            <i class="fas fa-sign-out-alt text-danger"></i> Cerrar Sesión
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <div class="main-header">
            <div class="container">
                <div class="logo-wrap" itemprop="logo">
                </div>
                <div class="nav-wrap">
                    <nav class="nav-desktop">
                        <ul class="menu-list">
                            <li>
                                <a href="./Destinations.php">
                                    <i class="fas fa-map-marker-alt text-danger"></i> Destinos
                                </a>
                            </li>
                            <li>
                                <a href="./Inns.php">
                                    <i class="fas fa-bed text-success"></i> Posadas
                                </a>
                            </li>
                            <li>
                                <a href="./Profile.php">
                                    <i class="fas fa-user text-primary"></i> Perfil
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <div id="bar">
                        <i class="fas fa-bars"></i>
                    </div>
                    <div id="close">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
            </div>
        </div>
    </header>


    <div class="wrapper">
      <section class="chat-area">
        <header>
          <?php
          $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
          $sql = mysqli_query($conn, "SELECT * FROM profile WHERE id = {$user_id}");
          if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
          } else {
            header("location: Inns.php");
          }
          ?>
          <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
          <img src="<?php echo $row['profile_image_url']; ?>" alt="Profile Image">
          <div class="details"> 
            <span style="font-size: 20px"><?php echo $row['first_name'] . " " . $row['last_name'] ?></span>
            <p><?php echo $row['profile_type']; ?></p>
          </div>
        </header>
        <div class="chat-box">

        </div>
        <form action="#" class="typing-area">
          <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
          <input type="text" name="message" class="input-field" placeholder="Escribe tu mensaje aquí..."
            autocomplete="off">
          <button><i class="fab fa-telegram-plane"></i></button>
        </form>
      </section>
    </div>

    <script src="./Assets/js/chat.js"></script>

    <footer class="bg-success text-white text-center text-lg-start">
    <div class="container p-5">
        <div class="row">
            <div class="col-lg-6 col-md-12 mb-6 mb-md-0">
                <h5 class="text-uppercase text-center" style="font-size: 26px; font-weight: bold; letter-spacing: 1px;">
                    <i class="fa-solid fa-info me-4 text-warning"></i>Acerca de VenBooking
                </h5>
                <p class="text-justify mt-3" style="font-size: 18px; line-height: 1.6; padding: 10px; margin: 10px;">
                    VenBooking es tu plataforma de confianza para reservar las mejores posadas en toda Venezuela.
                    Ofrecemos opciones seguras y personalizadas para que disfrutes de una experiencia única en cada
                    destino turístico.
                </p>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase"
                    style="font-size: 20px; font-weight: bold; letter-spacing: 1px; margin: 10px;">
                    <i class="fa-solid fa-link me-2 text-info"></i> Enlaces Rápidos
                </h5>
                <ul class="list-unstyled mt-3">
                    <li><a href="#!" class="text-white"
                            style="font-size: 18px; text-decoration: none; margin: 10px;"><i class="fas fa-map-marker-alt text-danger me-3"></i>Destinos</a></li>
                    <li><a href="#!" class="text-white"
                            style="font-size: 18px; text-decoration: none; margin: 10px;"><i class="fas fa-user text-primary me-3"></i>Perfil</a></li>
                    <li><a href="#!" class="text-white"
                            style="font-size: 18px; text-decoration: none; margin: 10px;"><i class="fas fa-comments text-info me-3"></i>Chat</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-5 mb-4 mb-md-0">
                <h5 class="text-uppercase" style="font-size: 20px; font-weight: bold; letter-spacing: 1px;">
                <i class="fa-solid fa-chart-simple"></i> Datos del Dólar
                </h5>
                <ul class="list-unstyled mt-3" style="font-size: 18px;">
                    <?php
                    $url = "https://ve.dolarapi.com/v1/dolares";

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, [
                        "Content-Type: application/json"
                    ]);

                    $response = curl_exec($ch);
                    curl_close($ch);

                    if ($response !== false) {
                        $data = json_decode($response, true);

                        if ($data !== null) {
                            echo "<li><i class='fas fa-dollar-sign text-warning'></i> Dólar: " . $data[0]['nombre'] . " (BCV)</li>";
                            echo "<li><i class='fas fa-chart-line text-danger'></i> Precio en BS: " . $data[0]['promedio'] . "</li>";
                            echo "<li><i class='fas fa-calendar text-info'></i> Fecha de Actualización: Hoy" . "</li>";
                        } else {
                            echo "<li>Error al convertir la respuesta JSON.</li>";
                        }
                    } else {
                        echo "<li>Error al obtener los datos de la API.</li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.3); font-size: 20px; letter-spacing: 0.5px;">
        © 2024 VenBooking. Todos los derechos reservados.
    </div>
</footer>


    <script>
      document.getElementById('logout-btn').addEventListener('click', function (e) {
          e.preventDefault(); // Evita que el enlace se ejecute inmediatamente

          Swal.fire({
              title: '¿Estás seguro?',
              text: "Estás a punto de cerrar sesión",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Sí',
              cancelButtonText: 'Cancelar'
          }).then((result) => {
              if (result.isConfirmed) {
                  // Redirigir al usuario a logout.php si confirma
                  window.location.href = './Includes/logout.php';
              }
          })
      });
    </script>

</body>
</html>
