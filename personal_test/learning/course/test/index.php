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
<?if ($_REQUEST["TEST_ID"]>0) {?>
<?$APPLICATION->IncludeComponent("luxoft:learning.test", "", Array(
	"COURSE_ID" => $_REQUEST["COURSE_ID"],	
	"TEST_ID" => $_REQUEST["TEST_ID"],	
	"GRADEBOOK_TEMPLATE" => "../gradebook.php?TEST_ID=#TEST_ID#",	// URL, ведущий на страницу с результатами тестирования
	"PAGE_NUMBER_VARIABLE" => "PAGE",	// Идентификатор вопроса
	"PAGE_WINDOW" => "10",	// Количество вопросов в навигационной цепочке
	"SHOW_TIME_LIMIT" => "N",	// Показывать счетчик ограничения времени
	"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
	),
	false
);?>
<?} else {?>
<div id='content'>
<div class="learn-box">
<h2>Тесты по курсу</h2>
</div>
<?$APPLICATION->IncludeComponent("bitrix:learning.test.list", ".default", array(
	"COURSE_ID" => $_REQUEST["COURSE_ID"],
	"TEST_DETAIL_TEMPLATE" => "/personal_test/learning/course/test/?COURSE_ID=#COURSE_ID#&TEST_ID=#TEST_ID#",
	"CHECK_PERMISSIONS" => "Y",
	"TESTS_PER_PAGE" => "20",
	"SET_TITLE" => "Y"
	),
	false
);?>
</div>
<?}?>
<?}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>