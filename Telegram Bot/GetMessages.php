<?php
include 'TelegramConfig.php';
include 'MessageInterpreter.php';
// Telegram Bot API token
$botToken = $BOT_TOKEN;

// Group chat ID
$groupChatId = $groupID;

// URL for Telegram API endpoint
$apiUrl = "https://api.telegram.org/bot{$botToken}/getUpdates";

// Get updates from Telegram
$response = file_get_contents($apiUrl, false, stream_context_create([
    "ssl" => [
        "verify_peer" => false,
        "verify_peer_name" => false,
    ],
]));
$data = json_decode($response, true);
// Check for new messages
foreach ($data['result'] as $update) {
    // Check if the update is a message and is from the desired group
    if (isset($update['message']['chat']['id']) && $update['message']['chat']['id'] == $groupChatId) {
        // Extract information from the message
        $senderName = $update['message']['from']['first_name'];
        $messageText = $update['message']['text'];


        // Handle help messages using the function from HelpHandler.php
        handleHelpMessage($botToken, $groupChatId, $messageText);

        echo "Message from $senderName in group $groupChatId: $messageText<br>";
    }
}

?>
