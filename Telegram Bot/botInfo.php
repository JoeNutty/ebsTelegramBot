<?php
include 'TelegramConfig.php';

$apiUrl = "https://api.telegram.org/bot{$BOT_TOKEN}/getMe";

$response = file_get_contents($apiUrl, false, stream_context_create([
    "ssl" => [
        "verify_peer" => false,
        "verify_peer_name" => false,
    ],
]));

echo $response;
?>
