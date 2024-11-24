<?php
require('./fpdf186/fpdf.php');
include '../config/db.php';

if (isset($_POST['generate_pdf'])) {
    $selected_inns = $_POST['inns'] ?? [];
    $selected_reports = $_POST['reports'] ?? [];

    $pdf = new FPDF();
    $pdf->AddPage();

    $pdf->SetLeftMargin(20);
    $pdf->SetRightMargin(20);

    $pdf->SetFont('Arial', 'B', 16);

    $pdf->SetFillColor(144, 238, 144); // Verde claro para el fondo
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetDrawColor(34, 139, 34);

    $pdf->Cell(0, 20, utf8_decode('Reportes Generados'), 0, 1, 'C', true);

    $pdf->SetLineWidth(0.5);
    $pdf->Line(20, 30, 190, 30);
    $pdf->Ln(10);

    $pdf->SetFont('Arial', 'I', 10);
    $pdf->Cell(0, 10, 'Fecha: ' . date('d/m/Y'), 0, 1, 'C');
    $pdf->Ln(10);

    $fill = false;
    $altColor = [240, 255, 240]; // Verde claro alternativo para filas

    // Reporte 1: Usuarios Registrados por Posada
    if (in_array('1', $selected_reports)) {
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 12, utf8_decode('Reporte 1: Usuarios Registrados por Posada'), 0, 1, 'L', true);
        $pdf->Ln(5);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(60, 10, 'Posada', 1, 0, 'C', true);
        $pdf->Cell(80, 10, utf8_decode('Nombre del Usuario'), 1, 0, 'C', true);
        $pdf->Ln(10);

        $pdf->SetFont('Arial', '', 9);
        foreach ($selected_inns as $inn_id) {
            $query = "SELECT profile.first_name, profile.last_name, inns.name
                      FROM reservations
                      JOIN profile ON reservations.user_id = profile.id
                      JOIN inns ON reservations.inn_id = inns.id
                      WHERE inns.id = $inn_id";
            $result = $conn->query($query);

            while ($row = $result->fetch_assoc()) {
                if ($fill) {
                    $pdf->SetFillColor($altColor[0], $altColor[1], $altColor[2]);
                } else {
                    $pdf->SetFillColor(255, 255, 255);
                }

                $pdf->Cell(60, 8, utf8_decode($row['name']), 1, 0, 'L', true);
                $pdf->Cell(80, 8, utf8_decode($row['first_name'] . ' ' . $row['last_name']), 1, 0, 'L', true);
                $pdf->Ln(8);

                $fill = !$fill;
            }
        }
        $pdf->Ln(10);
    }

    // Reporte 2: Reservaciones por Posada
    if (in_array('2', $selected_reports)) {
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 12, utf8_decode('Reporte 2: Reservaciones por Posada'), 0, 1, 'L', true);
        $pdf->Ln(5);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(50, 10, 'Posada', 1, 0, 'C', true);
        $pdf->Cell(30, 10, utf8_decode('Inicio'), 1, 0, 'C', true);
        $pdf->Cell(30, 10, utf8_decode('Fin'), 1, 0, 'C', true);
        $pdf->Cell(60, 10, utf8_decode('Método de Pago'), 1, 0, 'C', true);
        $pdf->Ln(10);

        $pdf->SetFont('Arial', '', 9);
        $fill = false;
        foreach ($selected_inns as $inn_id) {
            $query = "SELECT inns.name, reservations.start_date, reservations.end_date, 
                             CASE reservations.payment_method_id
                                 WHEN 1 THEN 'Pago Móvil'
                                 WHEN 2 THEN 'Transferencia'
                                 WHEN 3 THEN 'Efectivo'
                                 ELSE 'Desconocido'
                             END AS payment_method
                      FROM reservations
                      JOIN inns ON reservations.inn_id = inns.id
                      WHERE inns.id = $inn_id";
            $result = $conn->query($query);

            while ($row = $result->fetch_assoc()) {
                if ($fill) {
                    $pdf->SetFillColor($altColor[0], $altColor[1], $altColor[2]);
                } else {
                    $pdf->SetFillColor(255, 255, 255);
                }

                $startDate = date('d/m/Y', strtotime($row['start_date']));
                $endDate = date('d/m/Y', strtotime($row['end_date']));

                $pdf->Cell(50, 8, utf8_decode($row['name']), 1, 0, 'L', true);
                $pdf->Cell(30, 8, $startDate, 1, 0, 'C', true);
                $pdf->Cell(30, 8, $endDate, 1, 0, 'C', true);
                $pdf->Cell(60, 8, utf8_decode($row['payment_method']), 1, 0, 'L', true);
                $pdf->Ln(8);

                $fill = !$fill;
            }
        }
    }


        // Reporte 3: Métodos de Pago registrados por Posadas
        if (in_array('3', $selected_reports)) {
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(0, 12, utf8_decode('Reporte 3: Métodos de Pago registrados por Posadas'), 0, 1, 'L', true);
            $pdf->Ln(5);
    
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(45, 10, 'Posada', 1, 0, 'C', true);
            $pdf->Cell(40, 10, utf8_decode('Tipo de Pago'), 1, 0, 'C', true);
            $pdf->Cell(85, 10, utf8_decode('Detalles'), 1, 0, 'C', true);
            $pdf->Ln(10);
            $pdf->SetFont('Arial', '', 9);
            $fill = false;
            foreach ($selected_inns as $inn_id) {
                $queryInnName = "SELECT name FROM inns WHERE id = $inn_id";
                $resultInnName = $conn->query($queryInnName);
                $innNameRow = $resultInnName->fetch_assoc();
                $innName = utf8_decode($innNameRow['name']);
                $queries = [
                    'Pago Móvil' => "SELECT cedula, bank_code, phone_number FROM mobile_payment_info WHERE inn_id = $inn_id",
                    'Transferencia Bancaria' => "SELECT full_name, account_number, bank_code FROM bank_transfer_info WHERE inn_id = $inn_id",
                    'PayPal' => "SELECT email FROM paypal_transfer_info WHERE inn_id = $inn_id",
                    'Binance' => "SELECT email FROM binance_transfer_info WHERE inn_id = $inn_id",
                ];
                foreach ($queries as $paymentType => $query) {
                    $result = $conn->query($query);
                    while ($row = $result->fetch_assoc()) {
                        if ($fill) {
                            $pdf->SetFillColor($altColor[0], $altColor[1], $altColor[2]);
                        } else {
                            $pdf->SetFillColor(255, 255, 255);
                        }
                        $details = '';
                        switch ($paymentType) {
                            case 'Pago Móvil':
                                $details = "Cédula: {$row['cedula']}, Banco: {$row['bank_code']}, Teléfono: {$row['phone_number']}";
                                break;
                            case 'Transferencia Bancaria':
                                $details = "Nombre: {$row['full_name']}, Cuenta: {$row['account_number']}, Banco: {$row['bank_code']}";
                                break;
                            case 'PayPal':
                            case 'Binance':
                                $details = "Correo: {$row['email']}";
                                break;
                        }
                        $pdf->Cell(45, 8, $innName, 1, 0, 'L', true);
                        $pdf->Cell(40, 8, utf8_decode($paymentType), 1, 0, 'L', true);
                        $pdf->Cell(85, 8, utf8_decode($details), 1, 0, 'L', true);
                        $pdf->Ln(8); 
                        $fill = !$fill;
                    }
                }
            }
            $pdf->Ln(10);
        }    

// Reporte 4: Habitaciones Registradas por Posada
if (in_array('4', $selected_reports)) {
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 12, utf8_decode('Reporte 4: Habitaciones Registradas por Posada'), 0, 1, 'L', true);
    $pdf->Ln(5);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(45, 10, 'Posada', 1, 0, 'C', true);
    $pdf->Cell(30, 10, 'Habitación', 1, 0, 'C', true);
    $pdf->Cell(30, 10, utf8_decode('Tipo'), 1, 0, 'C', true);
    $pdf->Cell(30, 10, utf8_decode('Calidad'), 1, 0, 'C', true);
    $pdf->Cell(30, 10, 'Precio', 1, 0, 'C', true);
    $pdf->Ln(10);

    $pdf->SetFont('Arial', '', 9);
    $fill = false;
    foreach ($selected_inns as $inn_id) {
        // Obtener el nombre de la posada
        $queryInnName = "SELECT name FROM inns WHERE id = $inn_id";
        $resultInnName = $conn->query($queryInnName);
        $innNameRow = $resultInnName->fetch_assoc();
        $innName = utf8_decode($innNameRow['name']);

        // Obtener habitaciones de la posada
        $queryRooms = "SELECT room_number, type, quality, price 
                       FROM rooms WHERE inn_id = $inn_id";
        $resultRooms = $conn->query($queryRooms);

        while ($room = $resultRooms->fetch_assoc()) {
            if ($fill) {
                $pdf->SetFillColor($altColor[0], $altColor[1], $altColor[2]);
            } else {
                $pdf->SetFillColor(255, 255, 255);
            }

            $pdf->Cell(45, 8, $innName, 1, 0, 'L', true);
            $pdf->Cell(30, 8, utf8_decode($room['room_number']), 1, 0, 'C', true);
            $pdf->Cell(30, 8, utf8_decode($room['type']), 1, 0, 'C', true);
            $pdf->Cell(30, 8, utf8_decode($room['quality']), 1, 0, 'C', true);
            $pdf->Cell(30, 8, number_format($room['price'], 2) . ' $', 1, 0, 'R', true);
            $pdf->Ln(8);

            $fill = !$fill;
        }
    }
    $pdf->Ln(10);
}

// Reporte 5: Vehículos Registrados por Posadas
if (in_array('5', $selected_reports)) {
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 12, utf8_decode('Reporte 5: Vehículos Registrados por Posadas'), 0, 1, 'L', true);
    $pdf->Ln(5);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(50, 10, 'Posada', 1, 0, 'C', true);
    $pdf->Cell(30, 10, utf8_decode('Marca'), 1, 0, 'C', true);
    $pdf->Cell(30, 10, utf8_decode('Modelo'), 1, 0, 'C', true);
    $pdf->Cell(30, 10, utf8_decode('Año'), 1, 0, 'C', true);
    $pdf->Cell(30, 10, 'Capacidad', 1, 0, 'C', true);
    $pdf->Ln(10);

    $pdf->SetFont('Arial', '', 9);
    $fill = false;
    foreach ($selected_inns as $inn_id) {
    // Obtener las posadas del usuario activo
    $queryInns = "SELECT id, name FROM inns WHERE id = $inn_id";
    $resultInns = $conn->query($queryInns);

    while ($inn = $resultInns->fetch_assoc()) {
        $inn_id = $inn['id'];
        $inn_name = utf8_decode($inn['name']);

        // Obtener los vehículos de la posada
        $queryVehicles = "SELECT type, brand, model, year, capacity 
                          FROM vehicles WHERE inn_id = $inn_id";
        $resultVehicles = $conn->query($queryVehicles);

        while ($vehicle = $resultVehicles->fetch_assoc()) {
            if ($fill) {
                $pdf->SetFillColor($altColor[0], $altColor[1], $altColor[2]);
            } else {
                $pdf->SetFillColor(255, 255, 255);
            }

            $pdf->Cell(50, 8, $inn_name, 1, 0, 'L', true);
            $pdf->Cell(30, 8, utf8_decode($vehicle['brand']), 1, 0, 'C', true);
            $pdf->Cell(30, 8, utf8_decode($vehicle['model']), 1, 0, 'C', true);
            $pdf->Cell(30, 8, $vehicle['year'], 1, 0, 'C', true);
            $pdf->Cell(30, 8, $vehicle['capacity'], 1, 0, 'C', true);
            $pdf->Ln(8);

            $fill = !$fill;
        }
    }
    $pdf->Ln(10);
}
}


    $pdf->Ln(20);
    $pdf->SetFont('Arial', 'I', 10);
    $pdf->Cell(0, 10, utf8_decode('Generado automáticamente por el sistema de reservaciones'), 0, 1, 'C');

    $pdf->Output();
} else {
    echo "Acceso denegado. No se ha solicitado la generación del PDF.";
}
?>
