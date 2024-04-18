<?php
// Function to handle messages containing the word "help"
function handleHelpMessage($botToken, $groupChatId, $messageText) {
    // Check if the message contains the word "help"
    if (strpos(strtolower($messageText), 'help') !== false) {
        // Send a message back to the group using cURL
        $sendMessageUrl = "https://api.telegram.org/bot{$botToken}/sendMessage";
        $sendMessageParams = [
            'chat_id' => $groupChatId,
            'text' => "Hey there, how can I help you?",
        ];

        // Initialize cURL session
        $curl = curl_init();

        // Set cURL options
        curl_setopt_array($curl, [
            CURLOPT_URL => $sendMessageUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($sendMessageParams),
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => 2,
        ]);

        // Execute cURL request
        $response = curl_exec($curl);

        // Check for cURL errors
        if(curl_errno($curl)) {
            echo 'Error: ' . curl_error($curl);
        }

        // Close cURL session
        curl_close($curl);

        // Output the response (you can handle it as needed)
        echo $response;
    }
}
?>
