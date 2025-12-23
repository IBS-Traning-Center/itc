<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Профиль");
?>
<?$APPLICATION->IncludeComponent("bitrix:main.profile", "personal-pro", array(
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"SET_TITLE" => "Y",
	"USER_PROPERTY" => array(
		0 => "UF_VKNICK",
		1 => "UF_TWITTERNICK",
		2 => "UF_LINKEDIN_ID",
	),
	"SEND_INFO" => "N",
	"CHECK_RIGHTS" => "N",
	"USER_PROPERTY_NAME" => "",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>