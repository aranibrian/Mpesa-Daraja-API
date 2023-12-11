<!DOCTYPE html>
<html>
<head>
	<title>Mpesa Daraja API</title>
</head>
<body>

	<!-- Start Form to handle Payments -->
	<form id="mpesaPaymentForm" method="post">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    
    <label for="amount">Amount:</label>
    <input type="number" id="amount" name="amount" required>
    
    <label for="phone">Phone Number:</label>
    <input type="tel" id="phone" name="phone" required placeholder="2547XXXXXXXX">
    
    <input type="submit" value="Pay with M-Pesa">
	</form>
	<!-- End Form to handle Payments -->

	<!-- Start Display the Payment Status -->
	<div id="paymentStatus"></div>
	<!-- Start Display the Payment Status -->

</body>
<script type="text/javascript" src="script.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</html>