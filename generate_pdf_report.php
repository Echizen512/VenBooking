<?php
require('./Includes/fpdf186/fpdf.php');
include './config/db.php';

if (isset($_GET['reservation_id'])) {
    $reservation_id = $_GET['reservation_id'];

    // Consulta SQL corregida
    $query = "SELECT reservations.id, reservations.start_date, reservations.end_date, 
                     CASE reservations.payment_method_id
                         WHEN 1 THEN 'Pago Móvil'
                         WHEN 2 THEN 'Transferencia'
                         WHEN 3 THEN 'Efectivo'
                         ELSE 'Desconocido'
                     END AS payment_method,
                     reservations.codigo_referencia, reservations.status, reservations.monto_total, 
                     profile.first_name, profile.last_name, profile.email,
                     inns.name AS inn_name,
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
        $pdf = new FPDF();
        $pdf->AddPage();

        // Encabezado de la factura
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, utf8_decode('FACTURA DE RESERVACIÓN'), 0, 1, 'C');
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'I', 10);
        $pdf->Cell(0, 10, 'Fecha: ' . date('d/m/Y'), 0, 1, 'R');
        $pdf->Ln(10);

        // Información del cliente
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, utf8_decode('Información del Cliente'), 0, 1, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 8, utf8_decode('Nombre: ') . utf8_decode($reservation['first_name'] . ' ' . $reservation['last_name']), 0, 1, 'L');
        $pdf->Cell(0, 8, 'Email: ' . utf8_decode($reservation['email']), 0, 1, 'L');
        $pdf->Ln(10);

        // Información de la posada y reservación
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, utf8_decode('Detalles de la Reservación'), 0, 1, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 8, utf8_decode('Posada: ') . utf8_decode($reservation['inn_name']), 0, 1, 'L');
        $pdf->Cell(0, 8, utf8_decode('Habitación (ID): ') . $reservation['room_id'], 0, 1, 'L');
        $pdf->Cell(0, 8, utf8_decode('Precio por noche: $') . number_format($reservation['room_price'], 2), 0, 1, 'L');
        $pdf->Cell(0, 8, 'Fecha de inicio: ' . date('d/m/Y', strtotime($reservation['start_date'])), 0, 1, 'L');
        $pdf->Cell(0, 8, 'Fecha de fin: ' . date('d/m/Y', strtotime($reservation['end_date'])), 0, 1, 'L');
        $pdf->Ln(10);

        // Información del pago
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, utf8_decode('Método de Pago'), 0, 1, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 8, utf8_decode('Método: ') . utf8_decode($reservation['payment_method']), 0, 1, 'L');
        $pdf->Cell(0, 8, 'Codigo de Referencia: ' . utf8_decode($reservation['codigo_referencia']), 0, 1, 'L');
        $pdf->Cell(0, 8, 'Estado: ' . utf8_decode(ucfirst($reservation['status'])), 0, 1, 'L');
        $pdf->Ln(10);

        // Total
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, 'Monto Total', 0, 1, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 8, 'Total a Pagar: $' . number_format($reservation['monto_total'], 2), 0, 1, 'L');
        $pdf->Ln(20);

        // Footer
        $pdf->SetFont('Arial', 'I', 10);
        $pdf->Cell(0, 10, utf8_decode('Gracias por su reserva. Esperamos que disfrute su estancia.'), 0, 1, 'C');

        // Generar PDF
        $pdf->Output();
    } else {
        echo "No se encontró la reservación.";
    }
} else {
    echo "Acceso denegado. No se ha solicitado la generación de la factura.";
}
?>