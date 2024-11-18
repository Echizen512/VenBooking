<?php
include '../config/db.php';
if (isset($_GET['payment_method']) && isset($_GET['inn_id'])) {
    $payment_method = $_GET['payment_method'];
    $inn_id = intval($_GET['inn_id']);
    if ($payment_method == 1) {
        $query = "SELECT cedula, bank_code, phone_number FROM mobile_payment_info WHERE inn_id = ?";
    } elseif ($payment_method == 2) {
        $query = "SELECT full_name, account_number, bank_code FROM bank_transfer_info WHERE inn_id = ?";
    } elseif ($payment_method == 3) {
        $query = "SELECT email FROM binance_transfer_info WHERE inn_id = ?";
    } elseif ($payment_method == 4) { 
        $query = "SELECT email FROM paypal_transfer_info WHERE inn_id = ?";
    }
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param('i', $inn_id);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            if ($payment_method == 1) {
                $stmt->bind_result($cedula, $bank_code, $phone_number);
                $stmt->fetch();
                echo "
                    <div class='form-group'>
                        <label style='font-size: 20px;'>Cédula: $cedula</label>
                    </div>
                    <div class='form-group'>
                        <label style='font-size: 20px;'>Código Bancario: $bank_code</label>
                    </div>
                    <div class='form-group'>
                        <label style='font-size: 20px;'>Teléfono: $phone_number</label>
                    </div>
                ";
            } elseif ($payment_method == 2) {
                $stmt->bind_result($full_name, $account_number, $bank_code);
                $stmt->fetch();
                echo "
                    <div class='form-group'>
                        <label style='font-size: 20px;'>Nombre Completo: $full_name</label>
                    </div>
                    <div class='form-group'>
                        <label style='font-size: 20px;'>Número de Cuenta: $account_number</label>
                    </div>
                    <div class='form-group'>
                        <label style='font-size: 20px;'>Código Bancario: $bank_code</label>
                    </div>
                ";
            } elseif ($payment_method == 3) { 
                $stmt->bind_result($email);
                $stmt->fetch();
                echo "
                    <div class='form-group'>
                        <label style='font-size: 20px;'>Correo Electrónico: $email</label>
                    </div>
                ";
            } elseif ($payment_method == 4) { 
                $stmt->bind_result($email);
                $stmt->fetch();
                echo "
                    <div class='form-group'>
                        <label style='font-size: 20px;'>Correo Electrónico: $email</label>
                    </div>
                ";
            }
        } else {
            echo "<p class='text-danger' style='font-size: 20px;'>No hay información disponible para el método de pago seleccionado.</p>";
        }
        $stmt->close();
    }
}
?>
