<?php include './PHP?get-Destinations.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="./Assets/css/Destinations.css">
</head>

<body>
    <?php include $headerFile; ?>
    <section class="upcoming events-section">
        <div class="container mt-3">
            <div class="filter-card" style="border-radius: 20px; padding: 2rem;">
                <div class="filter-header mb-4 text-center">
                    <div class="filter-icon mb-2">
                        <i class="fas fa-filter fa-lg text-white"></i>
                    </div>
                    <h2 class="filter-title mb-1">Filtrar Posadas por Estado</h2>
                </div>

                <form action="Inns_State.php" method="GET" class="filter-form">
                    <div class="input-group mb-4">
                        <label for="stateFilter" class="input-label mb-2 d-block">
                            <i class="fas fa-map-marker-alt text-danger"></i> Selecciona un Estado
                        </label>
                        <div class="select-wrapper position-relative w-100">
                            <select id="stateFilter" name="state" class="form-select w-100"
                                style="border-radius: 12px; padding-right: 2rem;">
                                <option value="">Elige tu destino...</option>
                                <option value="all">🌍 Todos los Estados</option>
                                <?php while ($state = $states_result->fetch_assoc()): ?>
                                    <option value="<?php echo $state['id']; ?>">📍 <?php echo $state['name']; ?></option>
                                <?php endwhile; ?>
                            </select>
                            <div class="select-arrow position-absolute top-50 end-0 translate-middle-y pe-3">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-light w-100" style="font-size: 1.1rem; border-radius: 30px;">
                        <i class="fas fa-search me-2 text-primary"></i> Buscar Posadas
                    </button>
                </form>
            </div>
        </div>


        <div id="destinationsContainer" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 m-3">
            <?php while ($destination = $destinations_result->fetch_assoc()): ?>
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="<?php echo $destination['image_url']; ?>" class="card-img-top object-fit-cover"
                            alt="<?php echo $destination['name']; ?>"
                            style="height: 250px; border-top-left-radius: .75rem; border-top-right-radius: .75rem;">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title fw-bold">
                                <i class="fas fa-map-marker-alt text-success me-2"></i><?php echo $destination['name']; ?>
                            </h5>
                            <p class="card-text small text-muted"><?php echo $destination['description']; ?></p>
                        </div>
                        <div class="card-footer bg-transparent border-0 text-end">
                            <small class="text-body-secondary">
                                <i
                                    class="fas fa-location-dot text-primary me-1"></i><?php echo $destination['state_name']; ?>
                            </small>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        </div>
    </section>

    <?php include './Includes/footer.php'; ?>

</body>
</html>