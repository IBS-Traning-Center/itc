<?php
$to      = 'asbush2006@yandex.ru';
$subject = 'Check new Post Server';
$message = 'hello from new server!';
$headers = 'From: education@edu.luxoft.ru' . "\r\n" .
    'Reply-To: education@edu.luxoft.ru' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

if(mail($to, $subject, $message, $headers)) echo"Letter sent succcess!"; 
else echo "error";
?>
