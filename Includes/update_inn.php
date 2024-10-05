<?php
    include '../config/db.php';
    include './Dashboard.php';
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM inns WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $description = $row['description'];
        $image_url = $row['image_url'];
        $email = $row['email'];
        $phone = $row['phone'];
        $state_id = $row['state_id'];
        $municipality_id = $row['municipality_id'];
        $parish_id = $row['parish_id'];
        $category_id = $row['category_id'];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image_url = $_POST['image_url'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $state_id = $_POST['state'];
    $municipality_id = $_POST['municipality'];
    $parish_id = $_POST['parish'];
    $category_id = $_POST['category'];

    $sql = "UPDATE inns SET name='$name', description='$description', image_url='$image_url', 
            email='$email', phone='$phone', state_id='$state_id', municipality_id='$municipality_id', 
            parish_id='$parish_id', category_id='$category_id' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Posada actualizada correctamente.";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Posada</title>
    <link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Assets/css/Form.css">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card custom-card">
                <div class="card-header text-white text-center bg-success" style="font-size: 24px;">Actualizar Posada</div>
                <div class="card-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Descripción</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required><?php echo $description; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image_url">URL de la Imagen</label>
                            <input type="text" class="form-control" id="image_url" name="image_url" value="<?php echo $image_url; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Teléfono</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone; ?>" required>
                        </div>
                        <hr>
                        <h5>Ubicación</h5>
                        <div class="form-group">
                            <label for="state">Estado</label>
                            <select class="form-control" id="state" name="state" required>
                                <option value="">Seleccionar Estado</option>
                                <?php
                                include '../config/db.php';
                                $sql_states = "SELECT id, name FROM states";
                                $result_states = $conn->query($sql_states);
                                while ($row_state = $result_states->fetch_assoc()) {
                                    $selected = ($row_state['id'] == $state_id) ? 'selected' : '';
                                    echo "<option value='" . $row_state['id'] . "' " . $selected . ">" . $row_state['name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="municipality">Municipio</label>
                            <select class="form-control" id="municipality" name="municipality" required>
                                <option value="">Seleccionar Municipio</option>
                                <?php
                                $sql_municipalities = "SELECT id, name FROM municipalities WHERE state_id = $state_id";
                                $result_municipalities = $conn->query($sql_municipalities);
                                while ($row_municipality = $result_municipalities->fetch_assoc()) {
                                    $selected = ($row_municipality['id'] == $municipality_id) ? 'selected' : '';
                                    echo "<option value='" . $row_municipality['id'] . "' " . $selected . ">" . $row_municipality['name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="parish">Parroquia</label>
                            <select class="form-control" id="parish" name="parish">
                                <option value="">Seleccionar Parroquia</option>
                                <?php
                                $sql_parishes = "SELECT id, name FROM parishes WHERE municipality_id = $municipality_id";
                                $result_parishes = $conn->query($sql_parishes);
                                while ($row_parish = $result_parishes->fetch_assoc()) {
                                    $selected = ($row_parish['id'] == $parish_id) ? 'selected' : '';
                                    echo "<option value='" . $row_parish['id'] . "' " . $selected . ">" . $row_parish['name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="category">Categoría</label>
                            <select class="form-control" id="category" name="category" required>
                                <option value="">Seleccionar Categoría</option>
                                <?php
                                $sql_categories = "SELECT id, name FROM categories";
                                $result_categories = $conn->query($sql_categories);
                                while ($row_category = $result_categories->fetch_assoc()) {
                                    $selected = ($row_category['id'] == $category_id) ? 'selected' : '';
                                    echo "<option value='" . $row_category['id'] . "' " . $selected . ">" . $row_category['name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <br>
                        <div class="text-center">
                        <button type="submit" class="btn btn-success">Actualizar Posada</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br> <br>
</body>
</html>
