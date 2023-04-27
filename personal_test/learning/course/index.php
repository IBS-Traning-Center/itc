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
<div id='content'>
<?if (intval($_REQUEST["COURSE_ID"])==0) {?>

<?$APPLICATION->IncludeComponent("bitrix:learning.course.list", "course-list", Array(
	"SORBY" => "SORT",	// Поле для cортировки
	"SORORDER" => "ASC",	// Направление для cортировки
	"COURSE_DETAIL_TEMPLATE" => "/personal_test/learning/course/?COURSE_ID=#COURSE_ID#&INDEX=Y",	// URL, ведущий на страницу с детальным просмотром курса
	"CHECK_PERMISSIONS" => "Y",	// Проверять право доступа
	"COURSES_PER_PAGE" => "20",	// Количество курсов на странице
	"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
	),
	false
);?>
<?} else {?>
	<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "template", Array(
	"START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
	"PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
	"SITE_ID" => "s1",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
	),
	false
);?>
	<?$APPLICATION->IncludeComponent("bitrix:learning.course.detail", "template", Array(
	"COURSE_ID" => $_REQUEST["COURSE_ID"],	// Идентификатор курса
	"CHECK_PERMISSIONS" => "Y",	// Проверять право доступа
	"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
	"CACHE_TYPE" => "A",	// Тип кеширования
	"CACHE_TIME" => "3600",	// Время кеширования (сек.)
	),
	false
);?>
<?}?>
</div>

<?}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>