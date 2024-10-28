<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <title>Membresías</title>
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

  <?php
  session_start();
  if (isset($_SESSION['message'])) {
    $title = $_SESSION['message_type'] === 'success' ? 'Éxito' : 'Error';
    $icon = $_SESSION['message_type'];

    echo "<script>
        Swal.fire({
            title: '$title',
            text: '{$_SESSION['message']}',
            icon: '$icon',
            confirmButtonText: 'Aceptar'
        });
    </script>";

    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
  }
  ?>


  <?php include './Includes/Header.php'; ?>

  <div class="container py-3">
    <div class="card shadow-lg border-success">
      <div class="card-header bg-success text-white text-center">
        <h1 class="display-4 fw-normal">Membresías</h1>
      </div>
      <div class="card-body">
        <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
          <!-- Plan Básico -->
          <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm plan-card">
              <div class="card-header py-3 bg-light">
                <h4 class="my-0 fw-normal" style="font-size: 40px;">
                  <i class="fas fa-star text-warning"></i> Básico
                </h4>
              </div>
              <div class="card-body">
                <h1 class="card-title pricing-card-title" style="font-size: 24px;">$150<small class="text-muted fw-light">/mes</small></h1>
                <ul class="list-unstyled mt-3 mb-4">
                  <li><i class="fas fa-home"></i> 1 Posada</li>
                </ul>
                <!-- Botón PayPal Básico -->
                <div id="paypal-button-container-basic"></div>
              </div>
            </div>
          </div>

          <!-- Plan Plata -->
          <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm plan-card">
              <div class="card-header py-3 bg-light">
                <h4 class="my-0 fw-normal" style="font-size: 40px;">
                  <i class="fas fa-medal text-secondary"></i> Plata
                </h4>
              </div>
              <div class="card-body">
                <h1 class="card-title pricing-card-title"  style="font-size: 24px;">$350<small class="text-muted fw-light">/mes</small></h1>
                <ul class="list-unstyled mt-3 mb-4">
                  <li><i class="fas fa-home"></i> 3 Posadas</li>
                </ul>
                <!-- Botón PayPal Plata -->
                <div id="paypal-button-container-silver"></div>
              </div>
            </div>
          </div>

          <!-- Plan Oro -->
          <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm plan-card">
              <div class="card-header py-3 bg-success text-white">
                <h4 class="my-0 fw-normal" style="font-size: 40px;">
                  <i class="fas fa-crown text-warning"></i> Oro
                </h4>
              </div>
              <div class="card-body">
                <h1 class="card-title pricing-card-title"  style="font-size: 24px;">$400<small class="text-muted fw-light">/mes</small></h1>
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
          // PayPal Buttons para el plan Básico
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
                    value: '150.00' // Precio del plan básico
                  }
                }]
              });
            },
            onApprove: function (data, actions) {
              return actions.order.capture().then(function (details) {
                const membershipType = 'basic'; // Cambia según el plan
                const amount = '150.00'; // Cambia según el monto real
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
                    value: '350.00' // Precio del plan Plata
                  }
                }]
              });
            },
            onApprove: function (data, actions) {
              return actions.order.capture().then(function (details) {
                window.location.href = 'process_paypal.php?membership=silver&payment_status=completed&order_id=' + data.orderID;
              });
            },
            onError: function (err) {
              window.location.href = 'process_paypal.php?membership=silver&payment_status=failed';
            }
          }).render('#paypal-button-container-silver');

          // PayPal Buttons para el plan Oro
          paypal.Buttons({
            style: {
              layout: 'vertical', // Puedes cambiar a 'horizontal' si prefieres
              color: 'blue', // Cambia el color a azul
              shape: 'rect', // Puede ser 'rect' o 'pill'
              label: 'paypal' // Cambia la etiqueta (puede ser 'checkout', 'pay', etc.)
            },
            createOrder: function (data, actions) {
              return actions.order.create({
                purchase_units: [{
                  amount: {
                    value: '400.00' // Precio del plan Oro
                  }
                }]
              });
            },
            onApprove: function (data, actions) {
              return actions.order.capture().then(function (details) {
                window.location.href = 'process_paypal.php?membership=gold&payment_status=completed&order_id=' + data.orderID;
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