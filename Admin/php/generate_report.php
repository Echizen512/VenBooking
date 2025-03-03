<?php
require('../fpdf186/fpdf.php');
include '../../config/db.php';

class PDF extends FPDF
{
    function Header()
    {
        $this->Image('../Assets/images/LogoV.png', 10, 8, 33);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(80);
        $this->Cell(30, 10, 'Republica Bolivariana de Venezuela', 0, 1, 'C');
        $this->Cell(190, 10, 'La Victoria - Estado Aragua', 0, 1, 'C');
        $this->Cell(190, 10, 'VenBooking', 0, 1, 'C');   
        $this->Ln(10);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Pag ' . $this->PageNo(), 0, 0, 'C');
    }
}

if (isset($_POST['generate_pdf'])) {
    $selected_inns = $_POST['inns'] ?? [];
    $selected_reports = $_POST['reports'] ?? [];

    $pdf = new PDF();
    $pdf->AddPage();

    $pdf->SetLeftMargin(20);
    $pdf->SetRightMargin(20);
    $pdf->SetFont('Arial', 'B', 16);

    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetDrawColor(34, 139, 34);

    $pdf->Cell(0, 20, utf8_decode('Reportes Generados'), 0, 1, 'C');

    $pdf->SetLineWidth(0.5);
    $pdf->Line(20, 50, 190, 50);

    $pdf->SetFont('Arial', 'I', 10);
    $pdf->Cell(0, 10, 'Fecha: ' . date('d/m/Y'), 0, 1, 'C');
    $pdf->Ln(5);

    $fill = false;
    $altColor = [240, 255, 240];

    if (in_array('1', $selected_reports)) {
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 12, utf8_decode('Reporte 1: Usuarios Registrados por Posada'), 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFillColor(144, 238, 144);
        $pdf->Cell(80, 10, 'Posada', 1, 0, 'C', true);
        $pdf->Cell(90, 10, utf8_decode('Nombre del Usuario'), 1, 0, 'C', true);
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

                $pdf->Cell(80, 8, utf8_decode($row['name']), 1, 0, 'L', true);
                $pdf->Cell(90, 8, utf8_decode($row['first_name'] . ' ' . $row['last_name']), 1, 0, 'L', true);
                $pdf->Ln(8);

                $fill = !$fill;
            }
        }
        $pdf->Ln(10);
    }

    if (in_array('2', $selected_reports)) {
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 12, utf8_decode('Reporte 2: Reservaciones por Posada'), 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFillColor(144, 238, 144);
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

    $pdf->Ln(20);
    $pdf->SetFont('Arial', 'I', 10);
    $pdf->Cell(0, 10, utf8_decode('Generado automáticamente por el sistema de reservaciones'), 0, 1, 'C');

    $pdf->Output();
} else {
    echo "Acceso denegado. No se ha solicitado la generación del PDF.";
}
?>
