<?php include '../PHP/get-Admin-Inns.php'; ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="./CRUD.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="../Assets/js/Tooltip-Inns.js"></script>
</head>

<body>
    <?php include './Header_Admin.php'; ?>
    <div class="container mt-5 fadeIn">
    <div class="card custom-card slideInUp">
        <div class="card-body">
            <h2 class="card-title">
                <i class="fas fa-hotel me-2 text-info"></i> Listado de Posadas
            </h2>
                <div class="d-flex justify-content-end mb-3">
                    <button type="button" 
                            class="btn btn-success btn-sm d-inline-flex align-items-center" 
                            id="addPosadaButton" 
                            title="Crear Posada" 
                            style="font-size: 16px;">
                        <i class="fas fa-plus me-2"></i> Añadir Posada
                    </button>
                </div>

            <?php include '../Components/Validation-Inns.php'; ?>

                <div class="table-responsive fadeIn">
                    <?php if ($result->num_rows > 0) { ?>
                        <table id="innsTable" class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center"><i class="fas fa-image"></i> Imagen</th>
                                    <th class="text-center"><i class="fas fa-hotel"></i> Nombre</th>
                                    <th class="text-center"><i class="fas fa-map-marker-alt"></i> Estado</th>
                                    <th class="text-center"><i class="fas fa-star"></i> Categoría</th>
                                    <th class="text-center"><i class="fas fa-lock"></i> Bloqueo</th>
                                    <th class="text-center"><i class="fas fa-tools"></i> Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()) {
                                    $blockButton = $row["block"]
                                        ? "<button class='btn btn-danger btn-sm d-flex align-items-center justify-content-center me-2' style='width: 120px;' data-id='" . $row["id"] . "' data-block='0'>
                                            <i class='fas fa-lock me-2'></i> Bloqueado
                                        </button>"
                                        : "<button class='btn btn-success btn-sm d-flex align-items-center justify-content-center me-2' style='width: 120px;' data-id='" . $row["id"] . "' data-block='1'>
                                            <i class='fas fa-lock-open me-2'></i> Activo
                                        </button>";
                                    ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <div class="d-flex justify-content-center">
                                                <img src="<?= $row['image_url'] ?>" alt="Imagen de Posada"
                                                    class="rounded img-thumbnail" style="width: 100px; height: auto;">
                                            </div>
                                        </td>
                                        <td class="text-center"><?= $row["name"] ?></td>
                                        <td class="text-center"><?= $row["state_name"] ?></td>
                                        <td class="text-center"><?= $row["category_name"] ?></td>
                                        <td class="text-center align-middle">
                                            <div class="d-flex justify-content-center">
                                                <?= $blockButton ?>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center align-items-center gap-2">
                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                    data-target="#editModal" data-id="<?= $row['id'] ?>"
                                                    data-name="<?= $row['name'] ?>"
                                                    data-description="<?= $row['description'] ?>"
                                                    data-email="<?= $row['email'] ?>" 
                                                    data-phone="<?= $row['phone'] ?>"
                                                    data-rif="<?= $row['rif'] ?>"
                                                    data-image_url="<?= $row['image_url'] ?>"
                                                    data-state_id="<?= $row['state_id'] ?>"
                                                    data-municipality_id="<?= $row['municipality_id'] ?>"
                                                    data-parish_id="<?= $row['parish_id'] ?>"
                                                    data-category_id="<?= $row['category_id'] ?>" title="Editar">
                                                    <i class="fas fa-edit" style="font-size: 18px;"></i>
                                                </button>
                                                <form action="toggle_block.php" method="POST" class="m-0">
                                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                    <input type="hidden" name="block" value="<?= $row['block'] ? 0 : 1 ?>">
                                                    <button type="submit" class="btn btn-warning btn-sm" id="blockPosadaTooltip"
                                                        title="Bloquear/Desbloquear">
                                                        <i class="fas fa-ban" style="font-size: 18px; color: white"></i>
                                                    </button>
                                                </form>
                                                <a href="ver_posada.php?id=<?= $row['id'] ?>" class="btn btn-info" id="verPosadaTooltip">
                                                    <i class="fas fa-eye" style="font-size: 18px; color: white"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } else { ?>
                        <div class="alert alert-warning text-center">
                            <i class="fas fa-exclamation-triangle"></i> No hay posadas registradas.
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>


    <?php include '../Includes/Modal-Inns.php'; ?>
    <?php include '../Components/Ajax-Inns.php'; ?>

    <br> <br>

</body>

</html>