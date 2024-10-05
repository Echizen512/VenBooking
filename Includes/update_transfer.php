<?php
include '../config/db.php';
include './Dashboard.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener la información actual de la transferencia
    $stmt = $conn->prepare("SELECT * FROM bank_transfer_info WHERE id = ?");
    if ($stmt === false) {
        die('Error al preparar la consulta: ' . $conn->error);
    }
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $transfer = $result->fetch_assoc();
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $account_number = $_POST['account_number'];
    $bank_code = $_POST['bank_code'];
    $amount = $_POST['amount'];
    $inn_id = $_POST['inn_id'];
    $id = $_POST['id'];

    // Preparar y ejecutar la actualización
    $stmt = $conn->prepare("UPDATE bank_transfer_info SET full_name = ?, account_number = ?, bank_code = ?, amount = ?, inn_id = ? WHERE id = ?");
    if ($stmt === false) {
        die('Error al preparar la consulta: ' . $conn->error);
    }

    $stmt->bind_param("sssiii", $full_name, $account_number, $bank_code, $amount, $inn_id, $id);

    if ($stmt->execute()) {
        echo "<script>
                Swal.fire({
                    title: 'Éxito',
                    text: 'Transferencia bancaria actualizada correctamente.',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'get_transfers.php';
                    }
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'No se pudo actualizar la transferencia bancaria.',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
              </script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Transferencia Bancaria</title>
    <link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Assets/css/Form.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card custom-card">
                <div class="card-header bg-warning text-white text-center" style="font-size: 24px">Actualizar Transferencia Bancaria</div>
                <div class="card-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                        <div class="form-group">
                            <label for="full_name">Nombre Completo</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo htmlspecialchars($transfer['full_name']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="account_number">Número de Cuenta</label>
                            <input type="text" class="form-control" id="account_number" name="account_number" value="<?php echo htmlspecialchars($transfer['account_number']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="bank_code">Código Bancario</label>
                            <input type="text" class="form-control" id="bank_code" name="bank_code" value="<?php echo htmlspecialchars($transfer['bank_code']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="amount">Monto</label>
                            <input type="number" class="form-control" id="amount" name="amount" step="0.01" value="<?php echo htmlspecialchars($transfer['amount']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="inn_id">Posada</label>
                            <select class="form-control" id="inn_id" name="inn_id" required>
                                <option value="">Seleccionar Posada</option>
                                <?php
                                $sql_inns = "SELECT id, name FROM inns";
                                $result_inns = $conn->query($sql_inns);
                                while ($row_inn = $result_inns->fetch_assoc()) {
                                    $selected = ($row_inn['id'] == $transfer['inn_id']) ? 'selected' : '';
                                    echo "<option value='{$row_inn['id']}' {$selected}>{$row_inn['name']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-warning">Actualizar Transferencia</button>
                            <a href="get_transfers.php" class="btn btn-secondary">Cancelar</a>
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
