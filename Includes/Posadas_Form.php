<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

    include '../config/db.php';
    include './Dashboard.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Posada</title>
    <link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Assets/css/Form.css">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <div class="card custom-card">
            <div class="card-header bg-success text-white text-center" style="font-size: 24px">Registro de una Posada</div>
                <div class="card-body">
                    <form method="post" action="create_inn.php">
                    <div class="form-group">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="description" class="form-label">Descripción</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="image_url" class="form-label">URL de Imagen</label>
                <input type="text" class="form-control" id="image_url" name="image_url" required>
            </div>
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone" class="form-label">Teléfono</label>
                <input type="tel" class="form-control" id="phone" name="phone" required>
            </div>
            <hr>
                            <h5>Ubicación</h5>
                            <div class="form-group">
                                <label for="state">Estado</label>
                                <select class="form-control" id="state" name="state" required>
                                    <option value="">Seleccionar Estado</option>
                                    <?php
                                    $sql = "SELECT id, name FROM states";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            echo '<option value="'.$row["id"].'">'.$row["name"].'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="municipality">Municipio</label>
                                <select class="form-control" id="municipality" name="municipality" required>
                                    <option value="">Seleccionar Municipio</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="parish">Parroquia</label>
                                <select class="form-control" id="parish" name="parish">
                                    <option value="">Seleccionar Parroquia</option>
                                </select>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="category">Categorias</label>
                                <select class="form-control" id="category" name="category" required>
                                    <option value="">Seleccionar Categorias</option>
                                    <?php    
                                    $sql = "SELECT id, name FROM categories";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            echo '<option value="'.$row["id"].'">'.$row["name"].'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <br>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Registrar Posada</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br>
</body>

    <script>
        $(document).ready(function() {
            // Load municipalities based on selected state
            $('#state').change(function() {
                var state_id = $(this).val();
                $.ajax({
                    url: 'get_municipalities.php',
                    type: 'POST',
                    data: { state_id: state_id },
                    success: function(data) {
                        $('#municipality').html(data);
                        // Trigger change to load parishes for the first municipality
                        $('#municipality').trigger('change');
                    }
                });
            });

            // Load parishes based on selected municipality
            $('#municipality').change(function() {
                var municipality_id = $(this).val();
                $.ajax({
                    url: 'get_parishes.php',
                    type: 'POST',
                    data: { municipality_id: municipality_id },
                    success: function(data) {
                        $('#parish').html(data);
                    }
                });
            });
        });
    </script>

</html>
