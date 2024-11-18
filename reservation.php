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
            $_SESSION['swal_message'] = [
                'icon' => 'error',
                'title' => 'Tipo de archivo no permitido',
                'text' => 'Por favor sube un archivo de tipo JPEG, PNG o PDF.',
                'redirect' => 'reservation.php?inn_id=' . urlencode($inn_id)
            ];
            header("Location: reservation.php?inn_id=" . urlencode($inn_id));
            exit;
        }

        // Mover el archivo a la carpeta de destino
        if (move_uploaded_file($file_tmp_name, $file_path)) {
            $receipt_path = 'uploads/' . $unique_file_name;
        } else {
            $_SESSION['swal_message'] = [
                'icon' => 'error',
                'title' => 'Error al cargar el archivo',
                'text' => 'Hubo un problema al cargar el archivo. Intenta nuevamente.',
                'redirect' => 'reservation.php?inn_id=' . urlencode($inn_id)
            ];
            header("Location: reservation.php?inn_id=" . urlencode($inn_id));
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
        $_SESSION['swal_message'] = [
            'icon' => 'error',
            'title' => 'Fechas no disponibles',
            'text' => 'Las fechas seleccionadas no están disponibles para la reserva.',
            'redirect' => 'reservation.php?inn_id=' . urlencode($inn_id)
        ];
        header("Location: reservation.php?inn_id=" . urlencode($inn_id));
        exit;
    }

    // Insertar la reserva
    $sql_insert_reservation = "INSERT INTO reservations (inn_id, start_date, end_date, payment_method_id, receipt_path, status, user_id, codigo_referencia)
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_insert_reservation);
    if (!$stmt) {
        die("Error en la preparación de la consulta de inserción: " . $conn->error);
    }
    $stmt->bind_param('isssssss', $inn_id, $start_date, $end_date, $payment_method, $receipt_path, $status, $user_id, $reference_code);

    if ($stmt->execute()) {
        $_SESSION['swal_message'] = [
            'icon' => 'success',
            'title' => 'Reserva confirmada',
            'text' => 'La reserva se ha confirmado exitosamente.',
            'redirect' => 'Inns.php'
        ];
        header("Location: Inns.php");
        exit;
    } else {
        $_SESSION['swal_message'] = [
            'icon' => 'error',
            'title' => 'Error al confirmar la reserva',
            'text' => 'Hubo un error al confirmar la reserva: ' . $stmt->error,
            'redirect' => 'reservation.php?inn_id=' . urlencode($inn_id)
        ];
        header("Location: reservation.php?inn_id=" . urlencode($inn_id));
        exit;
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>

    <div class="content-wrapper">
        <?php include './Includes/Header.php'; ?>

        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-header bg-success text-white">
                            <h2 class="text-center mb-0" style="font-size: 24px;"><i class="fas fa-hotel"></i> Reserva
                                para la Posada</h2>
                        </div>
                        <div class="card-body p-4">
                            <form id="reservationForm" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="inn_id" value="<?php echo htmlspecialchars($inn_id); ?>">

                                <!-- Fecha de Inicio -->
                                <div class="form-group mb-3">
                                    <label for="start_date" class="form-label" style="font-size: 20px;"><i
                                            class="fas fa-calendar-alt"></i> Fecha de Inicio:</label>
                                    <input type="date" id="start_date" name="start_date" style="font-size: 18px;"
                                        class="form-control" required>
                                </div>

                                <!-- Fecha de Fin -->
                                <div class="form-group mb-3">
                                    <label for="end_date" class="form-label" style="font-size: 20px;"
                                        style="font-size: 20px;"><i class="fas fa-calendar-alt"></i> Fecha de
                                        Fin:</label>
                                    <input type="date" id="end_date" name="end_date" style="font-size: 18px;"
                                        class="form-control" required>
                                </div>

                                <!-- Selección de Habitación -->
                                <div class="form-group mb-3">
                                    <label for="room_id" class="form-label" style="font-size: 20px;"><i
                                            class="fas fa-door-open"></i> Habitación:</label>
                                    <select id="room_id" name="room_id" class="form-select"
                                        style="font-size: 18px; padding: 10px; border-radius: 5px;" required>
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
                                    <label for="payment_method" class="form-label" style="font-size: 22px;">
                                        <i class="fas fa-money-check-alt"></i> Método de Pago:
                                    </label>
                                    <select id="payment_method" name="payment_method" class="form-select mb-2"
                                        style="font-size: 18px; padding: 10px; border-radius: 5px;" required>
                                        <option value="" disabled selected>Seleccionar Método</option>
                                        <option value="1">Pago Móvil</option>
                                        <option value="2">Transferencia Bancaria</option>
                                        <option value="3">Binance</option>
                                        <option value="4">PayPal</option>
                                    </select>
                                </div>


                                <!-- Información de Pago (se llena dinámicamente) -->
                                <div id="paymentInfo"></div>

                                <!-- Comprobante de Pago -->
                                <div class="form-group mb-3" id="receiptGroup" style="display: none;">
                                    <label for="receipt" class="form-label" style="font-size: 20px;"><i
                                            class="fas fa-receipt"></i> Comprobante de Pago (JPG, PNG, PDF):</label>
                                    <input type="file" id="receipt" name="receipt" class="form-control"
                                        style="font-size: 18px;" accept=".jpg,.jpeg,.png,.pdf">
                                </div>

                                <!-- Código de Referencia -->
                                <div class="form-group mb-3">
                                    <label for="reference_code" class="form-label" style="font-size: 20px;"><i
                                            class="fas fa-hashtag"></i> Código de Referencia:</label>
                                    <input type="text" id="reference_code" name="reference_code" class="form-control"
                                        style="font-size: 18px;" required>
                                </div>

                                <!-- Monto Total -->
                                <div class="form-group mb-3">
                                    <label  class="form-label" style="font-size: 20px;"><i
                                            class="fas fa-dollar-sign"></i> Monto Total:</label>
                                            <!-- Actualización del input monto_total -->
<input type="text" id="monto_total" class="form-control" style="font-size: 18px;" readonly>

                                </div>

                                <!-- Precio en Bolívares -->
                                <div class="form-group mb-3">
                                    <label for="monto_bolivares" class="form-label" style="font-size: 20px;"><i
                                            class="fas fa-money-bill-wave"></i> Precio en Bolívares:</label>
                                    <input type="text" id="monto_bolivares" class="form-control"
                                        style="font-size: 18px;" readonly>
                                </div>

                                <!-- Precio de Reservación (Dólares) - 30% del monto total en dólares -->
                                <div class="form-group mb-3">
                                    <label for="precio_reservacion_dolares" class="form-label"
                                        style="font-size: 20px;"><i class="fas fa-percentage"></i> Precio de Reservación
                                        (Dólares):</label>
                                    <input type="text" id="precio_reservacion_dolares" class="form-control"
                                        style="font-size: 18px;" readonly>
                                </div>

                                <!-- Precio de Reservación (Bolívares) - 30% del monto total en bolívares -->
                                <div class="form-group mb-3">
                                    <label for="precio_reservacion_bolivares" class="form-label"
                                        style="font-size: 20px;"><i class="fas fa-money-check-alt"></i> Precio de
                                        Reservación (Bolívares):</label>
                                    <input type="text" id="precio_reservacion_bolivares" class="form-control"
                                        style="font-size: 18px;" readonly>
                                </div>

                                <style>
                                    .custom-btn {
                                        font-size: 14px;
                                        font-weight: bold;
                                        padding: 10px 30px;
                                        background-color: #28a745;
                                        color: white;
                                        border: none;
                                        border-radius: 30px;
                                        transition: all 0.3s ease;
                                        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
                                    }

                                    .custom-btn:hover {
                                        background-color: #218838;
                                        transform: scale(1.05);
                                        box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.4);
                                    }

                                    .custom-btn:active {
                                        background-color: #1e7e34;
                                        transform: scale(1);
                                        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
                                    }
                                </style>

                                <!-- Botón de Confirmar -->
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn custom-btn px-5">Confirmar Reserva</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include './Includes/Footer.php'; ?>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="./assets/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        // Verifica si hay mensaje en la sesión y muestra el Swal correspondiente
        <?php if (isset($_SESSION['swal_message'])): ?>
            Swal.fire({
                icon: '<?php echo $_SESSION['swal_message']['icon']; ?>',
                title: '<?php echo $_SESSION['swal_message']['title']; ?>',
                text: '<?php echo $_SESSION['swal_message']['text']; ?>'
            }).then(() => {
                window.location.href = '<?php echo $_SESSION['swal_message']['redirect']; ?>';
            });
            <?php unset($_SESSION['swal_message']); ?>
        <?php endif; ?>

    });
</script>

<script>
            $(document).ready(function () {
                let today = new Date().toISOString().split('T')[0];
                $('#start_date').attr('min', today);
                $('#end_date').attr('min', today);

                // Mostrar u ocultar el campo de recibo según el método de pago
                $('#payment_method').change(function () {
                    var selectedMethod = $(this).val();
                    if (selectedMethod == '1' || selectedMethod == '2') {
                        // Mostrar el campo de recibo y hacerlo obligatorio
                        $('#receiptGroup').show();
                        $('#receipt').attr('required', true);
                        loadPaymentInfo(selectedMethod);
                    } else if (selectedMethod == '3' || selectedMethod == '4') { // Agregado para PayPal
                        // Mostrar el campo de recibo y hacerlo obligatorio
                        $('#receiptGroup').show();
                        $('#receipt').attr('required', true);
                        loadPaymentInfo(selectedMethod); // Si necesitas cargar información específica para Binance o PayPal, puedes hacerlo aquí
                    } else {
                        // Ocultar el campo de recibo y quitar la obligatoriedad
                        $('#receiptGroup').hide();
                        $('#receipt').removeAttr('required');
                        $('#paymentInfo').empty(); // Limpiar información anterior
                    }
                });



                // Validación de Fechas
                document.getElementById('start_date').addEventListener('change', function () {
                    const startDate = new Date(this.value);
                    const minEndDate = new Date(startDate);
                    minEndDate.setDate(startDate.getDate() + 1);
                    document.getElementById('end_date').min = minEndDate.toISOString().split("T")[0];
                });


                // Cargar el precio de la habitación en dólares y calcular en bolívares
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
                                // Mostrar el monto total en dólares
                                $('#monto_total').val(data);

                                // Llamada a la API de Dólar.com para obtener el promedio
                                $.ajax({
                                    url: 'https://ve.dolarapi.com/v1/dolares',
                                    type: 'GET',
                                    success: function (response) {
                                        const dollarRate = parseFloat(response[0].promedio);
                                        const amountInDollars = parseFloat(data);
                                        const amountInBolivares = amountInDollars * dollarRate;

                                        // Mostrar el monto en bolívares
                                        $('#monto_bolivares').val(amountInBolivares.toFixed(2));

                                        // Calcular y mostrar el 30% en dólares y en bolívares
                                        const reservationPriceDollars = amountInDollars * 0.30;
                                        const reservationPriceBolivares = amountInBolivares * 0.30;

                                        $('#precio_reservacion_dolares').val(reservationPriceDollars.toFixed(2));
                                        $('#precio_reservacion_bolivares').val(reservationPriceBolivares.toFixed(2));
                                    },
                                    error: function () {
                                        alert('Error al obtener el tipo de cambio');
                                    }
                                });
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