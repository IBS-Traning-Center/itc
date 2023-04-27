<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");
?>
<?if (!$USER->IsAuthorized()) {?>
<?$APPLICATION->IncludeComponent("bitrix:system.auth.form","",Array(
     "REGISTER_URL" => "register.php",
     "FORGOT_PASSWORD_URL" => "",
     "PROFILE_URL" => "profile.php",
     "SHOW_ERRORS" => "Y" 
     )
);?>
<?} else {?>
	<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "template", Array(
	"START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
	"PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
	"SITE_ID" => "s1",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
	),
	false
);?>
<div id='content'>
<?$APPLICATION->IncludeComponent("bitrix:learning.lesson.detail", "template", Array(
	"COURSE_ID" => $_REQUEST["COURSE_ID"],	// Идентификатор курса
	"LESSON_ID" => $_REQUEST["LESSON_ID"],	// Идентификатор урока
	"SELF_TEST_TEMPLATE" => "self.php?COURSE_ID=#COURSE_ID#&LESSON_ID=#LESSON_ID#",	// URL, ведущий на страницу с самотестированием
	"PATH_TO_USER_PROFILE" => "",	// URL, ведущий на страницу с профилем пользователя
	"CHECK_PERMISSIONS" => "Y",	// Проверять право доступа
	"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
	"CACHE_TYPE" => "A",	// Тип кеширования
	"CACHE_TIME" => "3600",	// Время кеширования (сек.)
	),
	false
);?>
</div>
<?}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>