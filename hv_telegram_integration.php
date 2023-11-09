<?php

require ("hv_webhook.php");

//error_reporting(0);// no responder mi código con reporte de  errores
error_reporting(E_ALL);
ini_set('display_errors', 'On');
header("Cache-Control:no-cache,must-revalidate");// no generar caché al actualizar la página
header("Pragma: no-cache");

echo ('Hola mundo');
$token = "6510985547:AAFzbKjdKy_hj7E9qIWyT5_G06TDdcUuvoo";


$update = json_decode(file_get_contents("php://input"), true);

if (isset($update["message"])) {
    $chatId = $update["message"]["chat"]["id"];
    $messageText = $update["message"]["text"];

    // Procesar el mensaje y generar una respuesta
    if ($messageText == "/start") {
        $responseText = "¡Hola! Soy tu bot de prueba.\n";
        $responseText .= "Tu ID de usuario es: " . $chatId . "\n";
        $responseText .= "Mi token es: " . $token;
    } else {
        // Si no es el comando /start, puedes proporcionar otra respuesta
        $responseText = "Has dicho: " . $messageText;
    }

    // Enviar la respuesta al chat
    $url = "https://api.telegram.org/bot{$token}/sendMessage";
    $data = http_build_query([
        "chat_id" => $chatId,
        "text" => $responseText
    ]);

    $options = [
        "http" => [
            "method" => "POST",
            "header" => "Content-Type: application/x-www-form-urlencoded\r\n",
            "content" => $data
        ]
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if ($result === false) {
        // Manejar cualquier error al enviar la respuesta
        // Puedes registrar o manejar errores aquí
    }
}
?>

