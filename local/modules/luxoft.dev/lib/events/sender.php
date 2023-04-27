<?php
namespace Luxoft\Dev\Events;

class Sender
{
    public static function OnTriggerList($data) {
        require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/php_interface/test_start_trigger.php');
        $data['TRIGGER'] = 'SenderTriggerTestNotFinished';
        return $data;
    }
}