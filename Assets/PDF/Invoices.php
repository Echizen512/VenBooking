<?php
require('./fpdf186/fpdf.php');
include '../../config/db.php';

if (isset($_GET['reservation_id'])) {
    $reservation_id = $_GET['reservation_id'];

    // Consulta SQL con RIF de la posada
    $query = "SELECT reservations.id, reservations.start_date, reservations.end_date, 
                     CASE reservations.payment_method_id
                         WHEN 1 THEN 'Pago Móvil'
                         WHEN 2 THEN 'Transferencia'
                         WHEN 3 THEN 'PayPal'
                         WHEN 4 THEN 'Binance'
                         ELSE 'Desconocido'
                     END AS payment_method,
                     reservations.codigo_referencia, reservations.status, 
                     profile.first_name, profile.last_name, profile.email,
                     inns.name AS inn_name, inns.rif AS inn_rif,
                     rooms.id AS room_id, rooms.price AS room_price
              FROM reservations
              JOIN profile ON reservations.user_id = profile.id
              JOIN inns ON reservations.inn_id = inns.id
              JOIN rooms ON reservations.inn_id = rooms.inn_id
              WHERE reservations.id = $reservation_id";

    $result = $conn->query($query);

    if (!$result) {
        die("Error en la consulta SQL: " . $conn->error);
    }

    $reservation = $result->fetch_assoc();

    if ($reservation) {
        $start_date = strtotime($reservation['start_date']);
        $end_date = strtotime($reservation['end_date']);
        $days_reserved = ceil(($end_date - $start_date) / 86400);
        $total_amount = $days_reserved * $reservation['room_price'];

        $pdf = new FPDF();
        $pdf->AddPage();

        // Encabezado
        $pdf->Image('../Images/logo.png', 10, 0, 45);
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, utf8_decode('República Bolivariana de Venezuela'), 0, 1, 'C'); 
        $pdf->Cell(0, 10, utf8_decode('La Victoria - Estado Aragua'), 0, 1, 'C');
        $pdf->Cell(0, 10, utf8_decode('VenBooking'), 0, 1, 'C');
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'I', 10);
        $pdf->Cell(0, 10, 'Fecha: ' . date('d/m/Y'), 0, 1, 'C');
        $pdf->Ln(5); 
        
        // Título
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->SetFillColor(144, 238, 144); 
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetDrawColor(34, 139, 34);
        $pdf->Cell(0, 10, utf8_decode('FACTURA DE RESERVACIÓN'), 1, 1, 'C', true);
        $pdf->Ln(10);

        // Número de factura y RIF
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(100, 8, utf8_decode('Número de Factura: ') . $reservation['id'], 0, 0, 'L');
        $pdf->Cell(0, 8, utf8_decode('RIF de la Posada: ') . utf8_decode($reservation['inn_rif']), 0, 1, 'L');
        $pdf->Ln(5);

        // Cliente
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, utf8_decode('Información del Cliente'), 0, 1, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(100, 8, utf8_decode('Nombre: ') . utf8_decode($reservation['first_name'] . ' ' . $reservation['last_name']), 0, 0, 'L');
        $pdf->Cell(0, 8, 'Email: ' . utf8_decode($reservation['email']), 0, 1, 'L');
        $pdf->Ln(10);

        // Reservación
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, utf8_decode('Detalles de la Reservación'), 0, 1, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(100, 8, utf8_decode('Posada: ') . utf8_decode($reservation['inn_name']), 0, 0, 'L');
        $pdf->Cell(0, 8, utf8_decode('Habitación (ID): ') . $reservation['room_id'], 0, 1, 'L');
        $pdf->Cell(100, 8, utf8_decode('Fecha de inicio: ') . date('d/m/Y', $start_date), 0, 0, 'L');
        $pdf->Cell(0, 8, utf8_decode('Fecha de fin: ') . date('d/m/Y', $end_date), 0, 1, 'L');
        $pdf->Cell(100, 8, utf8_decode('Días reservados: ') . $days_reserved, 0, 0, 'L');
        $pdf->Cell(0, 8, utf8_decode('Precio por noche: $') . number_format($reservation['room_price'], 2), 0, 1, 'L');
        $pdf->Ln(10);

        // Pago
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, utf8_decode('Método de Pago'), 0, 1, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(100, 8, utf8_decode('Método: ') . utf8_decode($reservation['payment_method']), 0, 0, 'L');
        $pdf->Cell(0, 8, utf8_decode('Código de Referencia: ') . utf8_decode($reservation['codigo_referencia']), 0, 1, 'L');
        $pdf->Cell(100, 8, 'Estado: ' . utf8_decode(ucfirst($reservation['status'])), 0, 1, 'L');
        $pdf->Ln(10);

        // Total
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetFillColor(255, 228, 225); 
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetDrawColor(255, 0, 0);
        $pdf->Cell(0, 10, utf8_decode('Monto Total'), 1, 1, 'L', true);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 8, utf8_decode('Total a Pagar: $') . number_format($total_amount, 2), 0, 1, 'L');
        $pdf->Ln(20);

        // Footer
        $pdf->SetFont('Arial', 'I', 10);
        $pdf->Cell(0, 10, utf8_decode('Gracias por su reserva. Esperamos que disfrute su estancia.'), 0, 1, 'C');

        $pdf->Output();
    } else {
        echo "No se encontró la reservación.";
    }
} else {
    echo "Acceso denegado. No se ha solicitado la generación de la factura.";
}
?>
