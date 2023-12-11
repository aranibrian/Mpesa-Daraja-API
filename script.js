//Handle form submission
$('#mpesaPaymentForm').submit(function(e) {
    e.preventDefault();

    $.ajax({
        url: 'processPayment.php',
        type: 'POST',
        data: $(this).serialize(),
        success: function(data) {
            var response = JSON.parse(data);
            if(response.status === 'success') {
                window.location.href = response.redirect;
            } else {
                $('#paymentStatus').html(response.message);
            }
        },
        error: function(xhr, status, error) {
            $('#paymentStatus').html('Failed to process the payment.');
        }
    });
});

