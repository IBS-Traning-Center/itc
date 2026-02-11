<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Регистрация");
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:main.register",
	"lux-training",
	[
		"USER_PROPERTY_NAME" => "",
		"SEF_MODE" => "N",
		"SHOW_FIELDS" => [
			0 => "EMAIL",
			1 => "PASSWORD",
			2 => "CONFIRM_PASSWORD",
			3 => "NAME",
			4 => "LAST_NAME",
			5 => "SECOND_NAME",
			6 => "PERSONAL_PHONE",
			7 => "PERSONAL_CITY",
            8 => "LOGIN",
		],
		"REQUIRED_FIELDS" => [
			0 => "EMAIL",
			1 => "PASSWORD",
			2 => "CONFIRM_PASSWORD",

		],
		"AUTH" => "Y",
		"USE_BACKURL" => "Y",
		"SUCCESS_PAGE" => "/",
		"SET_TITLE" => "Y",
		"USER_PROPERTY" => []
	],
	false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>