<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}
?>

<?php
include '../config/db.php';
include './Includes/Dashboard.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Consultas
$sql_inns = "SELECT inns.name, COUNT(reservations.id) AS reservation_count
             FROM reservations
             JOIN inns ON reservations.inn_id = inns.id
             GROUP BY inns.name
             ORDER BY reservation_count DESC";

$sql_payment_methods = "SELECT 
                            CASE reservations.payment_method_id
                                WHEN 1 THEN 'Pago Móvil'
                                WHEN 2 THEN 'Transferencia'
                                WHEN 3 THEN 'Efectivo'
                                ELSE 'Desconocido'
                            END AS payment_method,
                            COUNT(reservations.id) AS payment_count
                        FROM reservations
                        GROUP BY payment_method_id
                        ORDER BY payment_count DESC";

$inns_result = $conn->query($sql_inns);
$payment_methods_result = $conn->query($sql_payment_methods);

$inns_data = [];
$payment_methods_data = [];

if ($inns_result) {
    while ($row = $inns_result->fetch_assoc()) {
        $inns_data[] = ['name' => $row['name'], 'count' => $row['reservation_count']];
    }
} else {
    die('Error al ejecutar la consulta de posadas: ' . $conn->error);
}

if ($payment_methods_result) {
    while ($row = $payment_methods_result->fetch_assoc()) {
        $payment_methods_data[] = ['name' => $row['payment_method'], 'count' => $row['payment_count']];
    }
} else {
    die('Error al ejecutar la consulta de métodos de pago: ' . $conn->error);
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas de Reservaciones</title>
    <link href="../Assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .container {
            margin-top: 20px;
            /* Ajusta el margen superior si es necesario */
        }

        .chart-container {
            position: relative;
            width: 100%;
            max-width: 200px;
            height: 300px;
            margin: 50px auto;

        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="chart-container">
                    <h3 class="text-center" style="font-size: 14px;">Posadas con Más Reservaciones</h3>
                    <canvas id="innsChart"></canvas>
                </div>
            </div>
            <div class="col-md-6">
                <div class="chart-container">
                    <h3 class="text-center" style="font-size: 14px;">Métodos de Pago Más Utilizados</h3>
                    <canvas id="paymentMethodsChart"></canvas>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctxInns = document.getElementById('innsChart').getContext('2d');
            var ctxPaymentMethods = document.getElementById('paymentMethodsChart').getContext('2d');

            // Data from PHP
            var innsData = <?php echo json_encode($inns_data); ?>;
            var paymentMethodsData = <?php echo json_encode($payment_methods_data); ?>;

            var innsLabels = innsData.map(function (item) { return item.name; });
            var innsCounts = innsData.map(function (item) { return item.count; });

            var paymentMethodsLabels = paymentMethodsData.map(function (item) { return item.name; });
            var paymentMethodsCounts = paymentMethodsData.map(function (item) { return item.count; });

            // Create the Inns Chart
            new Chart(ctxInns, {
                type: 'pie',
                data: {
                    labels: innsLabels,
                    datasets: [{
                        label: 'Número de Reservaciones',
                        data: innsCounts,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.5)',  // Colores pastel
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(75, 192, 192, 0.5)',
                            'rgba(153, 102, 255, 0.5)',
                            'rgba(255, 159, 64, 0.5)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true
                }
            });

            // Create the Payment Methods Chart
            new Chart(ctxPaymentMethods, {
                type: 'pie',
                data: {
                    labels: paymentMethodsLabels,
                    datasets: [{
                        label: 'Número de Usos',
                        data: paymentMethodsCounts,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.5)',  // Colores pastel
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(75, 192, 192, 0.5)',
                            'rgba(153, 102, 255, 0.5)',
                            'rgba(255, 159, 64, 0.5)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true
                }
            });
        });
    </script>
</body>

</html>