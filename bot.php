<?php
include "config.php";

$update = json_decode(file_get_contents("php://input"), true);
$chat_id = $update["message"]["chat"]["id"];
$message = trim($update["message"]["text"]);

function sendMessage($chat_id, $text) {
    global $apiUrl;
    file_get_contents($apiUrl . "sendMessage?chat_id=" . $chat_id . "&text=" . urlencode($text));
}

function getTikTokLink($url) {
    $api = "https://api.tikwm.com/video/info?url=" . urlencode($url);
    $response = json_decode(file_get_contents($api), true);
    if ($response && isset($response['data']['play'])) {
        return $response['data']['play'];
    } else {
        return false;
    }
}

if (preg_match("/tiktok.com/i", $message)) {
    $videoLink = getTikTokLink($message);
    if ($videoLink) {
        sendMessage($chat_id, "🎬 ئەمە فیدیۆکەتە 👇\n" . $videoLink);
    } else {
        sendMessage($chat_id, "❌ نەتوانیم فیدیۆکە بدۆزینەوە، لینکەکە دڵنیابکە.");
    }
} else {
    sendMessage($chat_id, "👋 سڵاو! لینکێکی TikTok بنێرە بۆ دابەزاندنی فیدیۆ بەبێ واتەرمار 🎥");
}
?>
