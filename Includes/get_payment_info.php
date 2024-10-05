<?php
include '../config/db.php';

if (isset($_GET['payment_method']) && isset($_GET['inn_id'])) {
    $payment_method = $_GET['payment_method'];
    $inn_id = intval($_GET['inn_id']);  // Asegurarse de que el inn_id sea un entero

    // Seleccionar la consulta dependiendo del método de pago
    if ($payment_method == 1) { 
        // Pago Móvil
        $query = "SELECT cedula, bank_code, phone_number FROM mobile_payment_info WHERE inn_id = ?";
    } elseif ($payment_method == 2) { 
        // Transferencia Bancaria
        $query = "SELECT full_name, account_number, bank_code FROM bank_transfer_info WHERE inn_id = ?";
    }

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param('i', $inn_id);
        $stmt->execute();
        $stmt->store_result();
        
        // Verificar si hay resultados
        if ($stmt->num_rows > 0) {
            // Asignar las columnas a variables según el método de pago
            if ($payment_method == 1) {
                // Pago Móvil
                $stmt->bind_result($cedula, $bank_code, $phone_number);
                $stmt->fetch();
                
                // Imprimir los datos de Pago Móvil
                echo "
                    <div class='form-group'>
                        <label>Cédula: $cedula</label>
                    </div>
                    <div class='form-group'>
                        <label>Código Bancario: $bank_code</label>
                    </div>
                    <div class='form-group'>
                        <label>Teléfono: $phone_number</label>
                    </div>
                ";
            } elseif ($payment_method == 2) {
                $stmt->bind_result($full_name, $account_number, $bank_code);
                $stmt->fetch();
                
                echo "
                    <div class='form-group'>
                        <label>Nombre Completo: $full_name</label>
                    </div>
                    <div class='form-group'>
                        <label>Número de Cuenta: $account_number</label>
                    </div>
                    <div class='form-group'>
                        <label>Código Bancario: $bank_code</label>
                    </div>
                ";
            }
        } else {
            
            echo "<p class='text-danger'>No hay información disponible para el método de pago seleccionado.</p>";
        }

        $stmt->close();
    }
}
?>
