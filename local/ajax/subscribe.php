<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
require_once $_SERVER['DOCUMENT_ROOT'] . '/local/lib/noti/ApiClient.php';
global $formAnswer;
$formAnswer = ['type' => 'error', 'message' => 'empty'];
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $formAnswer['message'] = $_POST;
    if($_POST['addField'] === '' && check_bitrix_sessid()) {
        $formAnswer['message'] = 'error 2';
        if (CModule::IncludeModule('subscribe') && !empty($_POST['email'])) {
            $formAnswer['message'] = 'error 3';
            global $APPLICATION, $USER;

            $email = htmlspecialchars($_POST['email']);

            $subscribeFields = array(
                "USER_ID" => ($USER->IsAuthorized()? $USER->GetID():false),
                "FORMAT" => "html",
                "EMAIL" => $email,
                "ACTIVE" => "Y",
                "CONFIRMED" => "Y",
                "SEND_CONFIRM" => "N",
                "RUB_ID" => array(3)
            );

            $subscr = new CSubscription;
            $ID = $subscr->Add($subscribeFields);
            $ApiClient = new \ApiClient('2a20e381fd848245984f4f7abb6d5a80');
            $bookID = 422148;
            $emai = [
                'email' => $email,
                'unconfirmed' => true
            ];
            $ApiClient->addEmail($bookID,$emai);

            if($ID > 0) {
                $formAnswer['type'] = 'ok';
                $formAnswer['message'] = 'ok';
                CSubscription::Authorize($ID);

            } else {
                $formAnswer['message'] = 'Вы уже подписаны на ежемесячный дайджест.';
            }
        }
    }
}

echo \Bitrix\Main\Web\Json::encode($formAnswer);