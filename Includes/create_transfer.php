<?php
include '../config/db.php';
include './Dashboard.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $account_number = $_POST['account_number'];
    $bank_code = $_POST['bank_code'];
    $inn_id = $_POST['inn_id'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO bank_transfer_info (full_name, account_number, bank_code, inn_id) VALUES (?, ?, ?, ?)");
    if ($stmt === false) {
        die('Error al preparar la consulta: ' . $conn->error);
    }
    $stmt->bind_param("ssss", $full_name, $account_number, $bank_code, $inn_id);

    if ($stmt->execute()) {
        $message = "Transferencia agregado exitosamente.";
    } else {
        $message = "Error al agregar el Transferencia: " . $conn->error;
    }
    $conn->close();
    header("Location: get_transfers.php?message=" . urlencode($message));
    exit();

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Transferencia Bancaria</title>
    <link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Assets/css/Form.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="container mt-5">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card custom-card">
                <div class="card-header bg-success text-white text-center" style="font-size: 24px">Agregar Transferencia Bancaria</div>
                <div class="card-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="form-group">
                            <label for="full_name">Nombre Completo</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" required>
                        </div>
                        <div class="form-group">
                            <label for="account_number">Número de Cuenta</label>
                            <input type="text" class="form-control" id="account_number" name="account_number" required>
                        </div>
                        <div class="form-group">
                            <label for="bank_code">Código Bancario</label>
                            <input type="text" class="form-control" id="bank_code" name="bank_code" required>
                        </div>
                        <div class="form-group">
                            <label for="inn_id">Posada</label>
                            <select class="form-control" id="inn_id" name="inn_id" required>
                                <option value="">Seleccionar Posada</option>
                                <?php
                                $sql_inns = "SELECT id, name FROM inns";
                                $result_inns = $conn->query($sql_inns);
                                while ($row_inn = $result_inns->fetch_assoc()) {
                                    echo "<option value='{$row_inn['id']}'>{$row_inn['name']}</option>";
                                }
                                ?>
                            </select>
                        <br>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-success">Agregar Transferencia</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../Assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
