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
		],
		"REQUIRED_FIELDS" => [
			0 => "EMAIL",
			1 => "PASSWORD",
			2 => "CONFIRM_PASSWORD",
			3 => "NAME",
			4 => "LAST_NAME",
			5 => "SECOND_NAME", // Добавьте если нужно
		],
		"AUTH" => "Y",
		"USE_BACKURL" => "Y",
		"SUCCESS_PAGE" => "/auth/registration_success.html",
		"SET_TITLE" => "Y",
		"USER_PROPERTY" => []
	],
	false
);?>
	<script>
		$(document).ready(function(){
			pageTracker._trackEvent('Users', 'Registration', 'View');
			$('#stylized form').submit(function() {
				yaCounter23056159.reachGoal("Registration");
				pageTracker._trackEvent('Users', 'Registration', 'Submit');
			});
		});
	</script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>