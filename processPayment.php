<?php
// processPayment.php

// Database connection (use PDO or mysqli)
// ... (omitted for brevity)

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $amount = $_POST['amount'];
    $phone = $_POST['phone'];

    // Save the initial payment details to the database
    $stmt = $pdo->prepare("INSERT INTO payments (name, amount, status) VALUES (?, ?, 'pending')");
    $stmt->execute([$name, $amount]);

    // Initiate M-Pesa payment using Daraja API
    // ... (omitted for brevity)
    // Assume we have a function that initiates payment and returns a response
    $response = initiateMpesaPayment($phone, $amount);
    
    // Process the response
    if ($response->isSuccessful()) {
        // Redirect to success page with AJAX
        echo json_encode(['status' => 'success', 'redirect' => 'success.php']);
    } else {
        // Handle different types of failure reasons
        $reason = 'Unknown error';
        if ($response->isBalanceInsufficient()) {
            $reason = 'Insufficient M-Pesa balance.';
        } elseif ($response->isWrongPin()) {
            $reason = 'You have entered the wrong pin.';
        } elseif ($response->isTransactionCancelled()) {
            $reason = 'Transaction has been canceled.';
        } elseif ($response->isApiNotHit()) {
            $reason = 'M-Pesa API was not hit.';
        }

        // Update the database with the failure status
        $stmt = $pdo->prepare("UPDATE payments SET status = 'failed' WHERE ...");
        // ... Execute the update statement with proper parameters

        // Redirect to failure page with AJAX
        echo json_encode(['status' => 'failure', 'message' => $reason]);
    }
    exit;
}

// Functions to communicate with Daraja API
// ...

?>
