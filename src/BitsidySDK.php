<?php

namespace Bitsidy\BitsidySDK;

class BitsidySDK
{
    private $apiKey;
    private $storeId;

    public function __construct($apiKey, $storeId)
    {
        $this->apiKey = $apiKey;
        $this->storeId = $storeId;
    }

    private function encryptData($data)
    {
        $iv = '';
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        for ($i = 0; $i < 16; $i++) {
            $iv .= $characters[rand(0, strlen($characters) - 1)];
        }

        $data = $iv . utf8_encode(json_encode($data));
        return urlencode(openssl_encrypt($data, 'aes-256-cbc', $this->apiKey, 0, $iv));
    }

    private function decryptData($data)
    {
        $data = base64_decode(urldecode($data));
        $iv = substr($data, 0, 16);
        $data = substr($data, 16);
        return json_decode(openssl_decrypt($data, 'aes-256-cbc', $this->apiKey, OPENSSL_RAW_DATA, $iv), true);
    }

    public function createInvoice($invoiceData)
    {
        $requestData = [
            'storeId' => $this->storeId,
            'data' => $this->encryptData($invoiceData)
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.bitsidy.com/v1/app/invoice/create');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

        $response = curl_exec($ch);
        curl_close($ch);

        if (!$response) {
            return false;
        }

        $jsonResponse = json_decode($response, true);
        if ($jsonResponse["result"] !== "success") {
            echo $jsonResponse["data"]["message"];
            return false;
        }

        return $this->decryptData($jsonResponse['data']);
    }

    public function getCallbackContent($encryptedData)
    {
        return $this->decryptData($encryptedData);
    }
}
