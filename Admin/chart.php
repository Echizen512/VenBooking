<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}
include './php/chart.php';
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
            var innsData = <?php echo json_encode($inns_data); ?>;
            var paymentMethodsData = <?php echo json_encode($payment_methods_data); ?>;
            var innsLabels = innsData.map(function (item) { return item.name; });
            var innsCounts = innsData.map(function (item) { return item.count; });
            var paymentMethodsLabels = paymentMethodsData.map(function (item) { return item.name; });
            var paymentMethodsCounts = paymentMethodsData.map(function (item) { return item.count; });
            new Chart(ctxInns, {
                type: 'pie',
                data: {
                    labels: innsLabels,
                    datasets: [{
                        label: 'Número de Reservaciones',
                        data: innsCounts,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.5)',  
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

            new Chart(ctxPaymentMethods, {
                type: 'pie',
                data: {
                    labels: paymentMethodsLabels,
                    datasets: [{
                        label: 'Número de Usos',
                        data: paymentMethodsCounts,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.5)',  
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