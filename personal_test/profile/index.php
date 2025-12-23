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

<?
$client_id = 'VLEAK7BKIEFJ9FAEU9M3QQ5BTN2JUH4PT3CQM86VU2NOIHDHH5LAQ6UNJKI375IM';
$address = 'https://hh.ru/oauth/authorize?response_type=code&role=applicant&client_id=&client_id=' . $client_id;
?>

<a href="<?=$address?>">Привязать профиль в hh.ru</a>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>