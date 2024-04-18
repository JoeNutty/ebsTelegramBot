<?php
include 'TelegramConfig.php';
include 'MessageInterpreter.php';

// Telegram Bot API token
$botToken = $BOT_TOKEN;

// Set up the webhook URL
$webhookUrl = "https://app.ebs2u.com:52228/ebscrm/TelegramBot/webhook.php";

// URL for Telegram API endpoint to set webhook
$apiUrl = "https://api.telegram.org/bot{$botToken}/setWebhook?url={$webhookUrl}";

// Initialize cURL session
$curl = curl_init($apiUrl);

// Set cURL options
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

// Execute cURL request
$response = curl_exec($curl);

// Check for errors
if($response === false) {
    echo "Error setting up webhook: " . curl_error($curl);
} else {
    // Decode the response
    $responseData = json_decode($response, true);
    
    // Check if the response indicates success
    if(isset($responseData['ok']) && $responseData['ok']) {
        echo "Webhook set up successfully";
    } else {
        echo "Error setting up webhook: " . $responseData['description'];
    }
}

// Close cURL session
curl_close($curl);
?>
