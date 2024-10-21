<script>
    $(document).ready(function () {
        let today = new Date().toISOString().split('T')[0];
        $('#start_date').attr('min', today);
        $('#end_date').attr('min', today);
        $('#payment_method').change(function () {
            var selectedMethod = $(this).val();
            if (selectedMethod == '1' || selectedMethod == '2') {
                $('#receiptGroup').show();
                $('#receipt').attr('required', true);
            } else {
                $('#receiptGroup').hide();
                $('#receipt').removeAttr('required');
            }
        });
        $('#reservationForm').on('submit', function (event) {
            var paymentMethod = $('#payment_method').val();
            var receipt = $('#receipt').val();
            if ((paymentMethod == '1' || paymentMethod == '2') && receipt == '') {
                event.preventDefault();
                alert('El comprobante de pago es obligatorio para Pago Móvil o Transferencia Bancaria.');
            }
        });
        $('#start_date, #end_date').change(function () {
            calculateTotalAmount();
        });
        function calculateTotalAmount() {
            var startDate = new Date($('#start_date').val());
            var endDate = new Date($('#end_date').val());
            if (startDate && endDate && startDate < endDate) {
                var totalDays = Math.round((endDate - startDate) / (1000 * 60 * 60 * 24)) + 1;
                $.ajax({
                    url: 'get_payment_info.php',
                    type: 'GET',
                    data: {
                        payment_method: $('#payment_method').val(),
                        inn_id: $('input[name="inn_id"]').val()
                    },
                    success: function (data) {
                        var amountPerDay = parseFloat(data.amount);
                        var totalAmount = amountPerDay * totalDays;
                        $('#monto_total').val(totalAmount.toFixed(2));
                    }
                });
            } else {
                $('#monto_total').val('');
            }
        }
    });
</script>