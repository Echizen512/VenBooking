<?php
require('./fpdf186/fpdf.php');
include '../config/db.php';

class PDF extends FPDF {
    function Header() {
        $this->Image('logo.png', 15, 5, 40);
        $this->Ln(5);
        $this->SetFont('Times', '', 12);
        $this->Cell(0, 8, utf8_decode('República Bolivariana de Venezuela'), 0, 1, 'C');
        $this->SetFont('Times', '', 12);
        $this->Cell(0, 8, utf8_decode('Ubicado en la ciudad de La Victoria, Estado Aragua'), 0, 1, 'C');
        $this->SetFont('Times', 'B', 12);
        $this->Cell(0, 8, utf8_decode('VenBooking - Reportes en PDF'), 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Times', 'I', 10);
        $this->Cell(0, 10, utf8_decode('Generado automáticamente por VenBooking | Página ') . $this->PageNo(), 0, 0, 'C');
    }
}

if (isset($_POST['generate_pdf'])) {
    $selected_inns = $_POST['inns'] ?? [];
    $selected_reports = $_POST['reports'] ?? [];

    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->SetFont('Times', 'I', 12);
    $pdf->Cell(0, 10, 'Fecha: ' . date('d/m/Y'), 0, 1, 'C');
    $pdf->Ln(5);

    $fill = false;

    if (in_array('1', $selected_reports)) {
        $pdf->SetFont('Times', 'B', 14);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(0, 12, utf8_decode('Reporte 1: Usuarios Registrados por Posada'), 0, 1, 'C');
        $pdf->Ln(5);

        // **Encabezado de tabla con fondo verde**
        $pdf->SetFont('Times', 'B', 10);
        $pdf->SetFillColor(120, 220, 120);
        $pdf->Cell(110, 10, 'Posada', 1, 0, 'C', true);
        $pdf->Cell(80, 10, utf8_decode('Nombre del Usuario'), 1, 0, 'C', true);
        $pdf->Ln(10);

        $pdf->SetFont('Times', '', 9);
        $pdf->SetTextColor(0, 0, 0); // Texto negro

        foreach ($selected_inns as $inn_id) {
            $query = "SELECT profile.first_name, profile.last_name, inns.name
                      FROM reservations
                      JOIN profile ON reservations.user_id = profile.id
                      JOIN inns ON reservations.inn_id = inns.id
                      WHERE inns.id = $inn_id";
            $result = $conn->query($query);

            while ($row = $result->fetch_assoc()) {
if ($fill) {
    $pdf->SetFillColor(193, 255, 193); // Verde claro
} else {
    $pdf->SetFillColor(255, 255, 255); // Blanco
}


                $pdf->Cell(110, 8, utf8_decode($row['name']), 1, 0, 'C', true);
                $pdf->Cell(80, 8, utf8_decode($row['first_name'] . ' ' . $row['last_name']), 1, 0, 'C', true);
                $pdf->Ln(8);
                $fill = !$fill;
            }
        }
        $pdf->Ln(10);
    }

    if (in_array('2', $selected_reports)) {
    $pdf->SetFont('Times', 'B', 14);
    $pdf->Cell(0, 12, utf8_decode('Reporte 2: Reservaciones por Posada'), 0, 1, 'C');
    $pdf->Ln(5);

    $start_date = $_POST['start_date'] ?? null;
    $end_date = $_POST['end_date'] ?? null;

    // **Encabezado de la tabla con verde claro medio**
    $pdf->SetFont('Times', 'B', 10);
    $pdf->SetFillColor(120, 220, 120); // Verde fresco con mejor contraste
    $pdf->Cell(50, 10, 'Posada', 1, 0, 'C', true);
    $pdf->Cell(30, 10, 'Inicio', 1, 0, 'C', true);
    $pdf->Cell(30, 10, 'Fin', 1, 0, 'C', true);
    $pdf->Cell(80, 10, 'Metodo de Pago', 1, 0, 'C', true);
    $pdf->Ln(10);

    $pdf->SetFont('Times', '', 9);
    $fill = false;

    foreach ($selected_inns as $inn_id) {
        $date_filter = "";
        if ($start_date && $end_date) {
            $date_filter = " AND reservations.start_date >= '$start_date' AND reservations.end_date <= '$end_date' ";
        }

        $query = "SELECT inns.name, reservations.start_date, reservations.end_date, 
                     CASE reservations.payment_method_id
                         WHEN 1 THEN 'Pago Móvil'
                         WHEN 2 THEN 'Transferencia'
                         WHEN 3 THEN 'Efectivo'
                         ELSE 'Desconocido'
                     END AS payment_method
              FROM reservations
              JOIN inns ON reservations.inn_id = inns.id
              WHERE inns.id = $inn_id $date_filter";
        $result = $conn->query($query);

        while ($row = $result->fetch_assoc()) {
           if ($fill) {
    $pdf->SetFillColor(193, 255, 193); // Verde claro
} else {
    $pdf->SetFillColor(255, 255, 255); // Blanco
}

            $startDate = date('d/m/Y', strtotime($row['start_date']));
            $endDate = date('d/m/Y', strtotime($row['end_date']));

            $pdf->Cell(50, 8, utf8_decode($row['name']), 1, 0, 'C', true);
            $pdf->Cell(30, 8, $startDate, 1, 0, 'C', true);
            $pdf->Cell(30, 8, $endDate, 1, 0, 'C', true);
            $pdf->Cell(80, 8, utf8_decode($row['payment_method']), 1, 0, 'C', true);
            $pdf->Ln(10);

            $fill = !$fill;
        }
    }
            $pdf->Ln(10);
}

if (in_array('3', $selected_reports)) {
    $pdf->SetFont('Times', 'B', 14);
    $pdf->Cell(0, 12, utf8_decode('Reporte 3: Métodos de Pago registrados por Posadas'), 0, 1, 'C');
    $pdf->Ln(5);

    // **Encabezado de la tabla con verde claro medio**
    $pdf->SetFont('Times', 'B', 10);
    $pdf->SetFillColor(120, 220, 120); // Verde fresco con mejor contraste
    $pdf->Cell(45, 10, 'Posada', 1, 0, 'C', true);
    $pdf->Cell(40, 10, utf8_decode('Tipo de Pago'), 1, 0, 'C', true);
    $pdf->Cell(105, 10, utf8_decode('Detalles'), 1, 0, 'C', true);
    $pdf->Ln(10);

    $pdf->SetFont('Times', '', 9);
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
    $pdf->SetFillColor(193, 255, 193); // Verde claro
} else {
    $pdf->SetFillColor(255, 255, 255); // Blanco
}

                $details = match ($paymentType) {
                    'Pago Móvil' => "Cédula: {$row['cedula']}, Banco: {$row['bank_code']}, Teléfono: {$row['phone_number']}",
                    'Transferencia Bancaria' => "Nombre: {$row['full_name']}, Cuenta: {$row['account_number']}, Banco: {$row['bank_code']}",
                    default => "Correo: {$row['email']}",
                };

                $pdf->Cell(45, 8, $innName, 1, 0, 'C', true);
                $pdf->Cell(40, 8, utf8_decode($paymentType), 1, 0, 'C', true);
                $pdf->Cell(105, 8, utf8_decode($details), 1, 0, 'C', true);
                $pdf->Ln(8);
                $fill = !$fill;
            }
        }
    }
    $pdf->Ln(10);
}

if (in_array('4', $selected_reports)) {
    $pdf->SetFont('Times', 'B', 14);
    $pdf->Cell(0, 12, utf8_decode('Reporte 4: Habitaciones Registradas por Posada'), 0, 1, 'C');
    $pdf->Ln(5);

    // **Encabezado de tabla con verde claro medio**
    $pdf->SetFont('Times', 'B', 10);
    $pdf->SetFillColor(120, 220, 120); // Verde suave con mejor contraste
    $pdf->Cell(45, 10, 'Posada', 1, 0, 'C', true);
    $pdf->Cell(55, 10, 'Habitacion', 1, 0, 'C', true);
    $pdf->Cell(30, 10, utf8_decode('Tipo'), 1, 0, 'C', true);
    $pdf->Cell(30, 10, utf8_decode('Calidad'), 1, 0, 'C', true);
    $pdf->Cell(30, 10, 'Precio', 1, 0, 'C', true);
    $pdf->Ln(10);

    $pdf->SetFont('Times', '', 9);
    $fill = false;

    foreach ($selected_inns as $inn_id) {
        $queryInnName = "SELECT name FROM inns WHERE id = $inn_id";
        $resultInnName = $conn->query($queryInnName);
        $innNameRow = $resultInnName->fetch_assoc();
        $innName = utf8_decode($innNameRow['name']);

        $queryRooms = "SELECT room_number, type, quality, price FROM rooms WHERE inn_id = $inn_id";
        $resultRooms = $conn->query($queryRooms);

        while ($room = $resultRooms->fetch_assoc()) {
            if ($fill) {
                $pdf->SetFillColor(193, 255, 193); // Verde muy suave
            } else {
                $pdf->SetFillColor(255, 255, 255);
            }

            $pdf->Cell(45, 8, $innName, 1, 0, 'C', true);
            $pdf->Cell(55, 8, utf8_decode($room['room_number']), 1, 0, 'C', true);
            $pdf->Cell(30, 8, utf8_decode($room['type']), 1, 0, 'C', true);
            $pdf->Cell(30, 8, utf8_decode($room['quality']), 1, 0, 'C', true);
            $pdf->Cell(30, 8, number_format($room['price'], 2) . ' $', 1, 0, 'C', true);
            $pdf->Ln(8);

            $fill = !$fill;
        }
    }
    $pdf->Ln(10);
}

if (in_array('5', $selected_reports)) {
    $pdf->SetFont('Times', 'B', 14);
    $pdf->Cell(0, 12, utf8_decode('Reporte 5: Vehículos Registrados por Posadas'), 0, 1, 'C');
    $pdf->Ln(5);

    // **Encabezado de tabla con verde claro medio**
    $pdf->SetFont('Times', 'B', 10);
    $pdf->SetFillColor(120, 220, 120); // Verde suave con mejor contraste
    $pdf->Cell(60, 10, 'Posada', 1, 0, 'C', true);
    $pdf->Cell(35, 10, utf8_decode('Marca'), 1, 0, 'C', true);
    $pdf->Cell(35, 10, utf8_decode('Modelo'), 1, 0, 'C', true);
    $pdf->Cell(30, 10, utf8_decode('Año'), 1, 0, 'C', true);
    $pdf->Cell(30, 10, 'Capacidad', 1, 0, 'C', true);
    $pdf->Ln(10);

    $pdf->SetFont('Times', '', 9);
    $fill = false;

    foreach ($selected_inns as $inn_id) {
        $queryInns = "SELECT id, name FROM inns WHERE id = $inn_id";
        $resultInns = $conn->query($queryInns);

        while ($inn = $resultInns->fetch_assoc()) {
            $inn_id = $inn['id'];
            $inn_name = utf8_decode($inn['name']);

            $queryVehicles = "SELECT type, brand, model, year, capacity FROM vehicles WHERE inn_id = $inn_id";
            $resultVehicles = $conn->query($queryVehicles);

            while ($vehicle = $resultVehicles->fetch_assoc()) {
                if ($fill) {
                    $pdf->SetFillColor(193, 255, 193); // Verde muy suave
                } else {
                    $pdf->SetFillColor(255, 255, 255);
                }

                $pdf->Cell(60, 8, $inn_name, 1, 0, 'L', true);
                $pdf->Cell(35, 8, utf8_decode($vehicle['brand']), 1, 0, 'C', true);
                $pdf->Cell(35, 8, utf8_decode($vehicle['model']), 1, 0, 'C', true);
                $pdf->Cell(30, 8, $vehicle['year'], 1, 0, 'C', true);
                $pdf->Cell(30, 8, $vehicle['capacity'], 1, 0, 'C', true);
                $pdf->Ln(8);

                $fill = !$fill;
            }
        }
        $pdf->Ln(10);
    }
}


    $pdf->Output();
} else {
    echo "Acceso denegado. No se ha solicitado la generación del PDF.";
}
?>
