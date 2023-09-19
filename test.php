<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
require_once $_SERVER['DOCUMENT_ROOT'] . '/local/lib/noti/ApiClient.php';
$APPLICATION->SetTitle("Новая страница");

?>

    <?
$ApiClient = new \ApiClient('2a20e381fd848245984f4f7abb6d5a80');
$bookID = 422148;
$emai = [
    'email' => 'onlinely@yandex.ru',
    'unconfirmed' => true
];
$ApiClient->addEmail($bookID,$emai);

?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>