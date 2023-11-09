<?php
$botToken = "6510985547:AAFzbKjdKy_hj7E9qIWyT5_G06TDdcUuvoo"; 
$webhookUrl = "https://github.com/agomezquint/pruebas/edit/main/hv_telegram_integration.php"; 
$apiUrl = "https://api.telegram.org/bot$botToken/setWebhook?url=$webhookUrl";
           
$ch = curl_init($apiUrl);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_POST, 1);

$response = curl_exec($ch);
curl_close($ch);

if ($response === false) {
    echo "Hubo un error al configurar el Webhook.";
   
} else {
    echo "Webhook configurado correctamente.";
}
?>
