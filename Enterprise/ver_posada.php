<?php include "../PHP/get-view-inns.php"; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VenBooking</title>
    <link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Assets/css/view-inns.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector("form[name='add_vehicle_form']");
            form.addEventListener("submit", function(e) {
                e.preventDefault();
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Estás a punto de agregar un nuevo vehículo",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, agregar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>


    <?php include '../Includes/Header4.php'; ?>

    <div class="container mt-5">
        <h2 class="mb-4 text-center" style="font-size: 28px;">
            <i class="fas fa-home text-success" style="font-size: 28px;"></i> <?php echo htmlspecialchars($inn_name); ?>
        </h2>
        <div class="row mb-5">
            <div class="col-12 d-flex justify-content-between align-items-center mb-3">
                <h3 class="mb-0" style="font-size: 28px; color: #2c3e50;">
                    <i class="fas fa-bed text-primary" style="font-size: 28px; margin-right: 8px;"></i>
                    Habitaciones
                </h3>
                <button class="btn btn-success" style="font-size: 14px; padding: 10px 15px; border-radius: 5px;"
                    data-bs-toggle="modal" data-bs-target="#addRoomModal">
                    <i class="fas fa-plus" style="margin-right: 5px;"></i> Agregar Habitación
                </button>
            </div>

            <?php if ($result_rooms->num_rows > 0): ?>
                <?php while ($room = $result_rooms->fetch_assoc()): ?>
                    <div class="col-md-4">
                        <div class="card shadow-sm mb-4">
                            <div id="roomCarousel<?= $room['id']; ?>" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <?php
                                    $images = ['image_url', 'image_url2', 'image_url3', 'image_url4', 'image_url5'];
                                    $active = true;
                                    foreach ($images as $img_field):
                                        if (!empty($room[$img_field])): ?>
                                            <div class="carousel-item <?= $active ? 'active' : ''; ?>">
                                                <img src="<?= $room[$img_field]; ?>" class="d-block w-100" alt="Imagen de la Habitación"
                                                    style="height: 200px; object-fit: cover;">
                                            </div>
                                            <?php $active = false; ?>
                                    <?php endif;
                                    endforeach; ?>
                                </div>
                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#roomCarousel<?= $room['id']; ?>" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Anterior</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#roomCarousel<?= $room['id']; ?>" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Siguiente</span>
                                </button>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title" style="font-size: 18px;"><?= $room['type']; ?> - Habitación
                                    <?= $room['room_number']; ?></h5>
                                <p class="card-text text-truncate" style="font-size: 16px;"><?= $room['description']; ?></p>
                                <p style="font-size: 14px;"><i class="fas fa-dollar-sign text-success"></i> <strong>Precio:</strong>
                                    <?= $room['price']; ?></p>
                                <p style="font-size: 14px;"><i class="fas fa-users text-primary"></i> <strong>Capacidad:</strong>
                                    <?= $room['capacity']; ?></p>
                                <p style="font-size: 14px;"><i class="fas fa-star text-warning"></i> <strong>Calidad:</strong>
                                    <?= $room['quality']; ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <button class="btn btn-primary" style="font-size: 16px;" data-bs-toggle="modal"
                                        data-bs-target="#editRoomModal<?= $room['id']; ?>"><i class="fas fa-edit"></i></button>
                                    <form method="POST" action="<?= $_SERVER['PHP_SELF'] . '?id=' . $inn_id; ?>"
                                        style="display: inline;">
                                        <input type="hidden" name="id" value="<?= $room['id']; ?>">
                                        <input type="hidden" name="type" value="room">
                                        <input type="hidden" name="toggle_block" value="1">
                                        <button type="submit" style="font-size: 16px;"
                                            class="btn btn-sm <?= $room['block'] ? 'btn-danger' : 'btn-outline-success'; ?>"><?= $room['block'] ? 'Bloqueado' : 'Activo'; ?></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php include '../Includes/Modal-Edit-Inn.php'; ?>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12">
                    <p class="text-center">No hay habitaciones registradas.</p>
                </div>
            <?php endif; ?>
        </div>

        <div class="row mb-5">
            <div class="col-12 d-flex justify-content-between align-items-center mb-4">
                <h3 class="mb-0 d-flex align-items-center" style="font-size: 28px; color: #2c3e50;">
                    <i class="fas fa-car text-danger" style="font-size: 28px; margin-right: 10px; color: #27ae60;"></i>
                    Vehículos
                </h3>
                <button class="btn btn-success"
                    style="font-size: 14px; padding: 10px 20px; border-radius: 5px; transition: background-color 0.3s, transform 0.3s;"
                    data-bs-toggle="modal" data-bs-target="#addVehicleModal">
                    <i class="fas fa-plus" style="margin-right: 5px;"></i> Agregar Vehículo
                </button>
            </div>

            <style>
                .btn-success {
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                }

                .btn-success:hover {
                    background-color: #27ae60;
                    transform: translateY(-2px);
                }

                h3 {
                    font-weight: 700;
                    letter-spacing: 0.5px;
                }
            </style>

            <?php if ($result_vehicles->num_rows > 0): ?>
                <?php while ($vehicle = $result_vehicles->fetch_assoc()): ?>
                    <div class="col-md-4">
                        <div class="card shadow-sm mb-4">
                            <div id="vehicleCarousel<?= $vehicle['id']; ?>" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <?php
                                    $images = ['image_url', 'image_url2', 'image_url3', 'image_url4', 'image_url5'];
                                    $active = true;
                                    foreach ($images as $img_field):
                                        if (!empty($vehicle[$img_field])): ?>
                                            <div class="carousel-item <?= $active ? 'active' : ''; ?>">
                                                <img src="<?= $vehicle[$img_field]; ?>" class="d-block w-100" alt="Imagen del Vehículo"
                                                    style="height: 200px; object-fit: cover;">
                                            </div>
                                            <?php $active = false; ?>
                                    <?php endif;
                                    endforeach; ?>
                                </div>
                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#vehicleCarousel<?= $vehicle['id']; ?>" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Anterior</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#vehicleCarousel<?= $vehicle['id']; ?>" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Siguiente</span>
                                </button>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title" style="font-size: 18px;"><?= $vehicle['brand']; ?> -
                                    <?= $vehicle['model']; ?></h5>
                                <p style="font-size: 16px;" class="card-text text-truncate"><?= $vehicle['description']; ?></p>
                                <p style="font-size: 14px;"><i class="fas fa-dollar-sign text-success"></i> <strong>Precio:</strong>
                                    <?= $vehicle['price']; ?></p>
                                <p style="font-size: 14px;"><i class="fas fa-users text-primary"></i> <strong>Capacidad:</strong>
                                    <?= $vehicle['capacity']; ?></p>
                                <p style="font-size: 14px;"><i class="fas fa-calendar-alt text-info"></i> <strong>Año:</strong>
                                    <?= $vehicle['year']; ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <button class="btn btn-primary" style="font-size: 16px;" data-bs-toggle="modal"
                                        data-bs-target="#editVehicleModal<?= $vehicle['id']; ?>"><i
                                            class="fas fa-edit"></i></button>
                                    <form method="POST" action="<?= $_SERVER['PHP_SELF'] . '?id=' . $inn_id; ?>"
                                        style="display: inline;">
                                        <input type="hidden" name="id" value="<?= $vehicle['id']; ?>">
                                        <input type="hidden" name="toggle_block" value="1">
                                        <input type="hidden" name="type" value="vehicle">
                                        <button type="submit" style="font-size: 16px;"
                                            class="btn btn-sm <?= $vehicle['block'] ? 'btn-danger' : 'btn-outline-success'; ?>"><?= $vehicle['block'] ? 'Bloqueado' : 'Activo'; ?></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php include '../Includes/Modal-Edit-Vehicle.php'; ?>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-warning" role="alert">
                        No hay vehículos disponibles.
                    </div>
                </div>
            <?php endif; ?>
        </div>

<?php include '../Includes/Modal-Add-View-Inns.php'; ?>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>