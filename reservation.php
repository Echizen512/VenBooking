<?php

session_start();
include './config/db.php';

// Redirigir a la página de inicio de sesión si el usuario no está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$inn_id = isset($_GET['inn_id']) ? intval($_GET['inn_id']) : 0;

// Procesar el formulario si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inn_id = $_POST['inn_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $payment_method = $_POST['payment_method'];
    $reference_code = $_POST['reference_code']; // Código de referencia
    $total_amount = $_POST['total_amount']; // Monto total
    $status = 'En Espera';
    $receipt_path = '';

    if (isset($_FILES['receipt']) && $_FILES['receipt']['error'] == UPLOAD_ERR_OK) {
        $file_tmp_name = $_FILES['receipt']['tmp_name'];
        $file_name = $_FILES['receipt']['name'];
        $file_type = $_FILES['receipt']['type'];

        // Generar un nombre único para el archivo
        $unique_file_name = uniqid() . '-' . basename($file_name);
        $upload_dir = __DIR__ . '/../uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $file_path = $upload_dir . $unique_file_name;

        // Verificar tipo de archivo permitido
        $allowed_types = array('image/jpeg', 'image/png', 'application/pdf');
        if (!in_array($file_type, $allowed_types)) {
            echo "<script>
                alert('Tipo de archivo no permitido.');
                window.location.href = 'reservation.php?inn_id=" . urlencode($inn_id) . "';
            </script>";
            exit;
        }

        // Mover el archivo a la carpeta de destino
        if (move_uploaded_file($file_tmp_name, $file_path)) {
            $receipt_path = 'uploads/' . $unique_file_name;
        } else {
            echo "<script>
                alert('Error al cargar el archivo.');
                window.location.href = 'reservation.php?inn_id=" . urlencode($inn_id) . "';
            </script>";
            exit;
        }
    }

    // Verificar disponibilidad
    $sql_check_availability = "SELECT * FROM reservations 
                               WHERE inn_id = ? 
                               AND (start_date <= ? AND end_date >= ?)";
    $stmt = $conn->prepare($sql_check_availability);
    if (!$stmt) {
        die("Error en la preparación de la consulta de disponibilidad: " . $conn->error);
    }
    $stmt->bind_param('iss', $inn_id, $end_date, $start_date);
    $stmt->execute();
    $result_check = $stmt->get_result();

    if ($result_check->num_rows > 0) {
        echo "<script>
            alert('Las fechas seleccionadas no están disponibles.');
            window.location.href = 'reservation.php?inn_id=" . urlencode($inn_id) . "';
        </script>";
        exit;
    }

    // Insertar la reserva
    $sql_insert_reservation = "INSERT INTO reservations (inn_id, start_date, end_date, payment_method_id, receipt_path, status, user_id, codigo_referencia, monto_total)
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_insert_reservation);
    if (!$stmt) {
        die("Error en la preparación de la consulta de inserción: " . $conn->error);
    }
    $stmt->bind_param('issssssss', $inn_id, $start_date, $end_date, $payment_method, $receipt_path, $status, $user_id, $reference_code, $total_amount);

    if ($stmt->execute()) {
        echo "<script>
            alert('Reserva confirmada exitosamente.');
            window.location.href = 'Inns.php';
        </script>";
    } else {
        echo "<script>
            alert('Error al confirmar la reserva: " . $stmt->error . "');
            window.location.href = 'reservation.php?inn_id=" . urlencode($inn_id) . "';
        </script>";
    }

    $stmt->close();
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservar Posada</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<style>
    .content-wrapper {

        display: flex;
        flex-direction: column;
    }

    .label {
        font-size: 14px;
    }

    .card {
        border-radius: 15px;
        overflow: hidden;
    }

    .card-header {
        font-size: 1.5rem;
        font-weight: bold;
        background-color: #007bff;
    }

    .card-body {
        background-color: #f8f9fa;
    }

    .form-label {
        font-weight: 600;
    }

    .form-control,
    .form-select {
        border-radius: 8px;
        box-shadow: none;
    }

    #paymentInfo {
        margin-top: 15px;
    }

    .footer {
        margin-top: auto;
    }
</style>

<body>

    <div class="content-wrapper">
        <?php include './Includes/Header.php'; ?>

        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-header bg-success text-white">
                            <h2 class="text-center mb-0"><i class="fas fa-hotel"></i> Reserva para la Posada</h2>
                        </div>
                        <div class="card-body p-4">
                            <form id="reservationForm" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="inn_id" value="<?php echo htmlspecialchars($inn_id); ?>">

                                <!-- Fecha de Inicio -->
                                <div class="form-group mb-3">
                                    <label for="start_date" class="form-label" style="font-size: 14px;"><i
                                            class="fas fa-calendar-alt"></i> Fecha de Inicio:</label>
                                    <input type="date" id="start_date" name="start_date" class="form-control" required>
                                </div>

                                <!-- Fecha de Fin -->
                                <div class="form-group mb-3">
                                    <label for="end_date" class="form-label" style="font-size: 14px;"
                                        style="font-size: 14px;"><i class="fas fa-calendar-alt"></i> Fecha de
                                        Fin:</label>
                                    <input type="date" id="end_date" name="end_date" class="form-control" required>
                                </div>

                                <!-- Selección de Habitación -->
                                <div class="form-group mb-3">
                                    <label for="room_id" class="form-label" style="font-size: 14px;"><i
                                            class="fas fa-door-open"></i> Habitación:</label>
                                    <select id="room_id" name="room_id" class="form-select" required>
                                        <option value="" disabled selected>Seleccionar Habitación</option>
                                        <?php
                                        // Obtener habitaciones disponibles para la posada seleccionada
                                        $sql_rooms = "SELECT id, room_number FROM rooms WHERE inn_id = ? AND status = 'Disponible'";
                                        $stmt_rooms = $conn->prepare($sql_rooms);
                                        $stmt_rooms->bind_param('i', $inn_id);
                                        $stmt_rooms->execute();
                                        $result_rooms = $stmt_rooms->get_result();

                                        while ($row = $result_rooms->fetch_assoc()): ?>
                                            <option value="<?php echo $row['id']; ?>">
                                                <?php echo "Habitación " . $row['room_number']; ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>

                                <!-- Método de Pago -->
                                <div class="form-group mb-3">
                                    <label for="payment_method" class="form-label" style="font-size: 14px;"><i
                                            class="fas fa-money-check-alt"></i> Método de Pago:</label>
                                    <select id="payment_method" name="payment_method" class="form-select" required>
                                        <option value="" disabled selected>Seleccionar Método</option>
                                        <option value="1">Pago Móvil</option>
                                        <option value="2">Transferencia Bancaria</option>
                                        <option value="3">Efectivo</option>
                                    </select>
                                </div>

                                <!-- Información de Pago (se llena dinámicamente) -->
                                <div id="paymentInfo"></div>

                                <!-- Comprobante de Pago -->
                                <div class="form-group mb-3" id="receiptGroup" style="display: none;">
                                    <label for="receipt" class="form-label" style="font-size: 14px;"><i
                                            class="fas fa-receipt"></i> Comprobante de Pago (JPG, PNG, PDF):</label>
                                    <input type="file" id="receipt" name="receipt" class="form-control"
                                        accept=".jpg,.jpeg,.png,.pdf">
                                </div>

                                <!-- Código de Referencia -->
                                <div class="form-group mb-3">
                                    <label for="reference_code" class="form-label" style="font-size: 14px;"><i
                                            class="fas fa-hashtag"></i> Código de Referencia:</label>
                                    <input type="text" id="reference_code" name="reference_code" class="form-control"
                                        required>
                                </div>

                                <!-- Monto Total -->
                                <div class="form-group mb-3">
                                    <label for="monto_total" class="form-label" style="font-size: 14px;"><i
                                            class="fas fa-dollar-sign"></i> Monto Total:</label>
                                    <input type="text" id="monto_total" class="form-control" readonly>
                                </div>

                                <!-- Botón de Confirmar -->
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success px-5" style="font-size: 12px;">
                                        Confirmar Reserva</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <?php include './Includes/Footer.php'; ?>
        </div>




        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="./assets/js/bootstrap.bundle.min.js"></script>

        <script>
            $(document).ready(function () {
                let today = new Date().toISOString().split('T')[0];
                $('#start_date').attr('min', today);
                $('#end_date').attr('min', today);

                // Mostrar u ocultar el campo de recibo según el método de pago
                $('#payment_method').change(function () {
                    var selectedMethod = $(this).val();
                    if (selectedMethod == '1' || selectedMethod == '2') {
                        $('#receiptGroup').show();
                        $('#receipt').attr('required', true);
                        loadPaymentInfo(selectedMethod);
                    } else {
                        $('#receiptGroup').hide();
                        $('#receipt').removeAttr('required');
                        $('#paymentInfo').empty(); // Limpiar información anterior
                    }
                });

                // Cargar el precio de la habitación según fechas seleccionadas
                $('#room_id, #start_date, #end_date').change(function () {
                    var room_id = $('#room_id').val();
                    var startDate = $('#start_date').val();
                    var endDate = $('#end_date').val();

                    if (room_id && startDate && endDate) {
                        $.ajax({
                            url: 'get_room_price.php',
                            type: 'GET',
                            data: {
                                room_id: room_id,
                                start_date: startDate,
                                end_date: endDate
                            },
                            success: function (data) {
                                $('#monto_total').val(data);
                            }
                        });
                    }
                });

                // Función para cargar la información de Pago Móvil o Transferencia Bancaria
                function loadPaymentInfo(paymentMethod) {
                    var innId = "<?php echo htmlspecialchars($inn_id); ?>"; // ID de la posada

                    $.ajax({
                        url: './Includes/get_payment_info.php',
                        type: 'GET',
                        data: {
                            payment_method: paymentMethod,
                            inn_id: innId
                        },
                        success: function (response) {
                            $('#paymentInfo').html(response); // Mostrar la información en el div
                        },
                        error: function () {
                            $('#paymentInfo').html('<p class="text-danger">Error al obtener la información del método de pago.</p>');
                        }
                    });
                }
            });
        </script>


</body>

</html>