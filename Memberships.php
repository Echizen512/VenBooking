
<!DOCTYPE html>
  <html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Membresias</title>
    <link rel="stylesheet" href="./Assets/css/Prueba.css">
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
  
<?php include './Includes/Header.php'; ?>

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
              <h1 class="card-title pricing-card-title">$150<small class="text-muted fw-light">/mes</small></h1>
              <ul class="list-unstyled mt-3 mb-4">
                <li><i class="fas fa-home"></i> 1 Posada</li>
                <li><i class="fas fa-car"></i> 1 Vehículo</li>
                <li><i class="fas fa-suitcase-rolling"></i> 1 Paquete Turístico</li>
              </ul>
              <button type="button" class="btn btn-success w-100 border-0" style="height: 50px; font-size: 20px;">Adquirir</button>
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
              <h1 class="card-title pricing-card-title">$350<small class="text-muted fw-light">/mes</small></h1>
              <ul class="list-unstyled mt-3 mb-4">
                <li><i class="fas fa-home"></i> 2 Posadas</li>
                <li><i class="fas fa-car"></i> 2 Vehículos</li>
                <li><i class="fas fa-suitcase-rolling"></i> 2 Paquetes Turísticos</li>
              </ul>
              <button type="button" class="btn btn-success w-100 border-0" style="height: 50px; font-size: 20px;">Adquirir</button>
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
              <h1 class="card-title pricing-card-title">$400<small class="text-muted fw-light">/mes</small></h1>
              <ul class="list-unstyled mt-3 mb-4">
                <li><i class="fas fa-home"></i> Sin límite de Posadas</li>
                <li><i class="fas fa-car"></i> Sin límite de Vehículos</li>
                <li><i class="fas fa-suitcase-rolling"></i> Sin límite de Paquetes Turísticos</li>
              </ul>
              <button type="button" class="btn btn-success w-100 border-0" style="height: 50px; font-size: 20px;">Adquirir</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card my-4 border-success">
  <div class="card-header bg-success text-white">
    <h2 class="text-center" style="font-size: 40px;">Comparación</h2>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table id="comparisonTable" class="table table-striped table-bordered" style="width: 100%;">
        <thead>
          <tr>
            <th></th>
            <th>Básico</th>
            <th>Plata</th>
            <th>Oro</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row" class="text-start">Público</th>
            <td><i class="fas fa-check text-success"></i></td>
            <td><i class="fas fa-check text-success"></i></td>
            <td><i class="fas fa-check text-success"></i></td>
          </tr>
          <tr>
            <th scope="row" class="text-start">Privado</th>
            <td></td>
            <td><i class="fas fa-check text-success"></i></td>
            <td><i class="fas fa-check text-success"></i></td>
          </tr>
          <tr>
            <th scope="row" class="text-start">Permisos</th>
            <td><i class="fas fa-check text-success"></i></td>
            <td><i class="fas fa-check text-success"></i></td>
            <td><i class="fas fa-check text-success"></i></td>
          </tr>
          <tr>
            <th scope="row" class="text-start">Compartición</th>
            <td></td>
            <td><i class="fas fa-check text-success"></i></td>
            <td><i class="fas fa-check text-success"></i></td>
          </tr>
          <tr>
            <th scope="row" class="text-start">Seguridad</th>
            <td></td>
            <td></td>
            <td><i class="fas fa-check text-success"></i></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php include './Includes/footer.php'; ?>
</body>





