<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Отписаться");
?>
<?$APPLICATION->IncludeComponent(
	"luxoft:subscribe.unsubscribe",
	".default",
	Array(
		"ASD_MAIL_ID" => $_REQUEST["mid"],
		"ASD_MAIL_MD5" => $_REQUEST["mhash"]
	),
false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>