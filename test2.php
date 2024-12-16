<?php
$data = json_decode(file_get_contents("php://input"));

// Retrieve the token and amount from the client-side
$token = $data->token;
$amount = $data->amount;  // Amount should be the same as in the Khalti widget

// Set your secret key from Khalti
$secret_key = "your_secret_key";

// Create the request to Khalti's verification API
$url = "https://khalti.com/api/v2/payment/verify/";
$args = http_build_query(array(
    'token' => $token,
    'amount' => $amount
));

// Set up the HTTP request headers
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: Key $secret_key"
));

// Execute the request and get the response
$response = curl_exec($ch);
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($status_code == 200) {
    echo "Payment verified successfully";
    // You can update your database or take other actions
} else {
    echo "Payment verification failed";
}
?>
