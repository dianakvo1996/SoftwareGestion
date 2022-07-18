<?php

$token = "1609840936:AAEvnQFPbHjxYim7HQ8jczdRCYD4W3d7zP4";
$id = "-1001479767291";
$urlMsg = "https://api.telegram.org/bot{$token}/sendMessage";
$msg = "<strong>SOLICITUD MTTO CORRECTIVO_NOMBRE CLIENTE</strong>";
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $urlMsg);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "chat_id={$id}&parse_mode=HTML&text=$msg");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec($ch);
curl_close($ch);
echo $msg;