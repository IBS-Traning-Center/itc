<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Восстановление пароля");
?>

<?$APPLICATION->IncludeComponent(
	"bitrix:system.auth.forgotpasswd",
	"forgot",
	[]
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>