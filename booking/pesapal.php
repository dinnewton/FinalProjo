<?php

Kenyan Merchant;
consumer_key: qkio1BGGYAXTu2JOfm7XSXNruoZsrqEW
consumer_secret: osGQ364R49cXKeOYSpaOnT++rHs=


// Set your consumer key and secret, obtained from Pesapal Dashboard
$consumer_key = 'your-consumer-key';
$consumer_secret = 'your-consumer-secret';

// Set the callback URL that Pesapal will redirect to after payment is complete
$callback_url = 'https://example.com/pesapal-callback';

// Set the order details
$order = array(
    'amount' => '1000.00',
    'description' => 'Example order',
    'type' => 'MERCHANT',
    'reference' => '123456789'
);

// Encode the order details as a string
$order_xml = '<?xml version="1.0" encoding="utf-8"?><PesapalDirectOrderInfo xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" Currency="KES">';
foreach ($order as $key => $value) {
    $order_xml .= "<$key>$value</$key>";
}
$order_xml .= '</PesapalDirectOrderInfo>';

// Generate the OAuth signature for the request
$oauth_signature = base64_encode(hash_hmac('sha1', $order_xml, $consumer_secret, true));

// Set the request headers
$headers = array(
    'Content-type: application/xml',
    'Authorization: OAuth '.$oauth_signature,
);

// Send the request to Pesapal
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.pesapal.com/api/PostPesapalDirectOrderV4');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $order_xml);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$response = curl_exec($ch);
curl_close($ch);

// Parse the response from Pesapal
$pesapal_response = simplexml_load_string($response);
if ($pesapal_response->ResponseCode == '0') {
    // Redirect the user to the Pesapal payment page
    $payment_url = $pesapal_response->RedirectURL;
    header("Location: $payment_url");
} else {
    // Handle the error
    $error_message = $pesapal_response->ResultDesc;
    // Display the error message to the user or handle it in some other way
}