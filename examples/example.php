<?php

require_once __DIR__ . '/../include.php';

use Bitsidy\BitsidySDK\BitsidySDK;

$bitsidySDK = new BitsidySDK('your_api_key', 'your_store_id');
$invoiceData = [
    'currency' => 'BTC', // Required: Cryptocurrency code, e.g., 'BTC' for Bitcoin. Find all available currencies "here."
    'amount' => 10, // Required: Amount in USD.
    'email' => 'payer@example.com', // Required: Email of the payer.
    'callbackNotify' => 'https://yourdomain.com/callback.php', // Required: Your callback URL.
    'customString' => 'Payment for Product XYZ', // Optional: Custom string for the invoice, displayed on the payment page.
    'orderId' => 'order123' // Optional: Your local order ID for future invoice retrieval. If an existing invoice with this orderId is found, a new invoice will not be created; instead, the existing one will be returned.
];

$response = $bitsidySDK->createInvoice($invoiceData);

if ($response === false) {
    return;
}

$transactionId = isset($response['transactionId']) ? $response['transactionId'] : null;
$paymentLink = isset($response['paymentLink']) ? $response['paymentLink'] : null;
$status = isset($response['status']) ? $response['status'] : null;
$amount = isset($response['amount']) ? $response['amount'] : null;
$customString = isset($response['customString']) ? $response['customString'] : null;
$email = isset($response['email']) ? $response['email'] : null;
$orderId = isset($response['orderId']) ? $response['orderId'] : null;

var_dump($transactionId); // A unique identifier for the transaction.
var_dump($paymentLink); // Payment link to redirect your clients to.
var_dump($status); // Invoice status, will be 'wait' if the invoice has just been created. List of all statuses available here.
var_dump($amount); // The amount of the created invoice in the specified cryptocurrency.
var_dump($customString); // The custom string you passed to the invoice creation method.
var_dump($email); // The customer's email you passed to the invoice creation method.
var_dump($orderId); // Your local order ID that you passed to the invoice creation method.
