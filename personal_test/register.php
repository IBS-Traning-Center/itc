<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Регистрация");
?>
<?if (!$USER->IsAuthorized()) {?>

<?$APPLICATION->IncludeComponent(
	"bitrix:main.register",
	"lux-training",
	Array(
		"USER_PROPERTY_NAME" => "",
		"SEF_MODE" => "Y",
		"SHOW_FIELDS" => Array("NAME", "LAST_NAME", "PERSONAL_PHONE", "PERSONAL_CITY", "WORK_COMPANY", "WORK_POSITION"),
		"REQUIRED_FIELDS" => Array("NAME", "LAST_NAME", "PERSONAL_PHONE", "PERSONAL_CITY"),
		"AUTH" => "Y",
		"USE_BACKURL" => "Y",
		"SUCCESS_PAGE" => "/auth/registration_success.html",
		"SET_TITLE" => "Y",
		"USER_PROPERTY" => Array(),
		"SEF_FOLDER" => "/auth/",
		"VARIABLE_ALIASES" => Array(

		)
	),
false
);?>
<?} else {?>
	Вы успешно зарегистрировались и авторизовались.
<?}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>