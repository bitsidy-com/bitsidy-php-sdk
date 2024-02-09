<?php

require_once __DIR__ . '/../include.php';

use Bitsidy\BitsidySDK\BitsidySDK;

$encryptedData = json_decode(file_get_contents('php://input'), true);

$bitsidySDK = new BitsidySDK('your_api_key', 'your_store_id');
$decryptedData = $bitsidySDK->getCallbackContent($encryptedData['data']);

$transactionId = $decryptedData['transactionId'];
$orderId = $decryptedData['orderId'];
$invoiceAmount = $decryptedData['invoiceAmount'];
$invoiceAmountUsd = $decryptedData['invoiceAmountUsd'];
$status = $decryptedData['status'];
$payload = $decryptedData['payload'];
$customString = $decryptedData['customString'];
$receivedAmount = $decryptedData['receivedAmount'];

var_dump($transactionId); // A unique identifier for the transaction.
var_dump($orderId); // Your local order ID that you passed to the invoice creation method. Null if was not passed.
var_dump($invoiceAmount); // The amount of the created invoice in the specified cryptocurrency.
var_dump($invoiceAmountUsd); // The amount of the created invoice in USD.
var_dump($status); // Current status of the invoice. List of all statuses available here.
var_dump($payload); // A field for additional information, if any. Usually the same as status.
var_dump($customString); // The custom string you passed to the invoice creation method. Null if was not passed.
var_dump($receivedAmount); // The amount received for the invoice in the specified cryptocurrency so far.
