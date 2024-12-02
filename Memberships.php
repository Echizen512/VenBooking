<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id'])) {
    if (isset($_SESSION['profile_type'])) {
        $profile_type = $_SESSION['profile_type'];
    } else {
        include './config/db.php';
        $user_id = $_SESSION['user_id'];
        $query = "SELECT profile_type FROM profile WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        if ($user) {
            $_SESSION['profile_type'] = $user['profile_type'];
            $profile_type = $_SESSION['profile_type'];
        } else {
            $_SESSION['message'] = 'Usuario no encontrado';
            $_SESSION['message_type'] = 'error';
            header('Location: login.php');
            exit;
        }
    }

    if ($profile_type == 'Empresa') {
        include './Includes/Header3.php';
    } else {
        include './Includes/Header.php';
    }
} else {
    include './Includes/Header2.php';
}

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['user_id'])) {

    echo '<script>
      Swal.fire({
          title: "Debes iniciar sesión",
          text: "Para comprar una membresía, por favor, inicia sesión.",
          icon: "warning",
          confirmButtonText: "Ir al Login"
      }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = "Login.php"; 
          }
      });
  </script>';
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<title>Membresías</title>
<link rel="stylesheet" type="text/css" href="./assets/css/all.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/lightbox.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/flexslider.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/jquery.rateyo.css" />
    <link rel="stylesheet" type="text/css" href="./assets/css/jquery.mmenu.all.css" />
    <link rel="stylesheet" type="text/css" href="inner-page-style.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="css2?family=Nunito:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen" href="./assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="./Assets/css/Prueba.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script
  src="https://www.paypal.com/sdk/js?client-id=AYDT0nwwfZO2cRUOjsktfxfczeMJftcEicBkI0LQk5DquHgx-Ydk7HbtbWUufT9iQVI65RaGvXmlg2PS"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>

<style>
  footer {
    width: 100vw;
    position: relative;
    left: 0;
    margin-left: calc(-50vw + 50%);
    text-align: center;
  }
</style>

<div class="container py-3">
  <div class="card shadow-lg border-success">
    <div class="card-header bg-success text-white text-center">
      <h1 class="display-4 fw-normal">Membresías</h1>
    </div>
    <div class="card-body">
      <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
        <div class="col">
          <div class="card mb-4 rounded-3 shadow-sm plan-card">
            <div class="card-header py-3 bg-light">
              <h4 class="my-0 fw-normal" style="font-size: 40px;">
                <i class="fas fa-star text-warning"></i> Básico
              </h4>
            </div>
            <div class="card-body">
              <h1 class="card-title pricing-card-title" style="font-size: 24px;">$50<small class="text-muted fw-light">/mes</small></h1>
              <ul class="list-unstyled mt-3 mb-4">
                <li><i class="fas fa-home"></i> 1 Posada</li>
              </ul>
              <div id="paypal-button-container-basic"></div>
            </div>
          </div>
        </div>

        <div class="col">
          <div class="card mb-4 rounded-3 shadow-sm plan-card">
            <div class="card-header py-3 bg-light">
              <h4 class="my-0 fw-normal" style="font-size: 40px;">
                <i class="fas fa-medal text-secondary"></i> Plata
              </h4>
            </div>
            <div class="card-body">
              <h1 class="card-title pricing-card-title" style="font-size: 24px;">$75<small class="text-muted fw-light">/mes</small></h1>
              <ul class="list-unstyled mt-3 mb-4">
                <li><i class="fas fa-home"></i> 3 Posadas</li>
              </ul>
              <div id="paypal-button-container-silver"></div>
            </div>
          </div>
        </div>

        <div class="col">
          <div class="card mb-4 rounded-3 shadow-sm plan-card">
            <div class="card-header py-3 bg-success text-white">
              <h4 class="my-0 fw-normal" style="font-size: 40px;">
                <i class="fas fa-crown text-warning"></i> Oro
              </h4>
            </div>
            <div class="card-body">
              <h1 class="card-title pricing-card-title" style="font-size: 24px;">$100<small class="text-muted fw-light">/mes</small></h1>
              <ul class="list-unstyled mt-3 mb-4">
                <li><i class="fas fa-home"></i> Sin límite de Posadas</li>
              </ul>
              <div id="paypal-button-container-gold"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
</div>
<br>

<?php include './Includes/footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function () {
  
  paypal.Buttons({
    style: {
      layout: 'vertical',
      color: 'blue',
      shape: 'rect',
      label: 'paypal'
    },
    createOrder: function (data, actions) {
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: '50.00' 
          }
        }]
      });
    },
    onApprove: function (data, actions) {
      return actions.order.capture().then(function (details) {
        const membershipType = 'basic'; 
        const amount = '50.00'; 
        window.location.href = `process_paypal.php?membership_type=${membershipType}&amount=${amount}&payment_status=completed&order_id=` + data.orderID;
      });
    },
    onError: function (err) {
      window.location.href = 'process_paypal.php?membership_type=basic&payment_status=failed';
    }
  }).render('#paypal-button-container-basic');

  paypal.Buttons({
    style: {
      layout: 'vertical',
      color: 'blue',
      shape: 'rect',
      label: 'paypal'
    },
    createOrder: function (data, actions) {
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: '75.00' 
          }
        }]
      });
    },
    onApprove: function (data, actions) {
      return actions.order.capture().then(function (details) {
        const membershipType = 'silver'; 
        const amount = '75.00'; 
        window.location.href = `process_paypal.php?membership_type=${membershipType}&amount=${amount}&payment_status=completed&order_id=` + data.orderID;
      });
    },
    onError: function (err) {
      window.location.href = 'process_paypal.php?membership=silver&payment_status=failed';
    }
  }).render('#paypal-button-container-silver');

  
  paypal.Buttons({
    style: {
      layout: 'vertical', 
      color: 'blue', 
      shape: 'rect', 
      label: 'paypal' 
    },
    createOrder: function (data, actions) {
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: '100.00' 
          }
        }]
      });
    },
    onApprove: function (data, actions) {
      return actions.order.capture().then(function (details) {
        const membershipType = 'gold'; 
        const amount = '100.00'; 
        window.location.href = `process_paypal.php?membership_type=${membershipType}&amount=${amount}&payment_status=completed&order_id=` + data.orderID;
      });
    },
    onError: function (err) {
      window.location.href = 'process_paypal.php?membership=gold&payment_status=failed';
    }
  }).render('#paypal-button-container-gold');
});
</script>

</body>
</html>