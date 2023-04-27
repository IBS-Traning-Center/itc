<?php

logFile("Запись была сделана:");

function logFile($text) 
{
$file = '/home/bitrix/ext_www/luxoft-training.ru/debug/logFile.txt';
$text .= "\r\n"."=======================".date('Y-m-d H:i:s') ."======================="."\r\n";
$text .= print_r($textLog);
$fOpen = fopen($file,'a');
fwrite($fOpen, $text);
fclose($fOpen);
}

?>