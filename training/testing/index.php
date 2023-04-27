<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Курсы по программированию");
$APPLICATION->SetPageProperty("keywords", "курсы программирования, корпоративное обучение, обучение тестированию, дистанционное обучение, software study, software education");
$APPLICATION->SetPageProperty("description", "Обучение в сфере программирования.  Открытые курсы, онлайн обучение, корпоративное обучение в сфере разработки программного обучения.");
$APPLICATION->SetPageProperty("blue_title", "Тестирование");
$APPLICATION->SetTitle("Тестирование");
?> 
<div class="shadow-wrap">
<?if (!$USER->IsAuthorized()) {?>
<h2>После авторизации вы приступите к выполнению теста. Время выполнения теста ограничено</h2>
<?$APPLICATION->IncludeComponent("bitrix:system.auth.form","",Array(
     "REGISTER_URL" => "register.php",
     "FORGOT_PASSWORD_URL" => "",
     "PROFILE_URL" => "profile.php",
     "SHOW_ERRORS" => "Y" 
     )
);?>
<?} else {?>
<?$APPLICATION->IncludeComponent("luxoft:learning.test", "template", Array(
	"COURSE_ID" => $_REQUEST["COURSE_ID"],	// Идентификатор курса
		"TEST_ID" => $_REQUEST["TEST_ID"],	// Идентификатор теста
		"GRADEBOOK_TEMPLATE" => "../gradebook.php?TEST_ID=#TEST_ID#",	// URL, ведущий на страницу с результатами тестирования
		"PAGE_NUMBER_VARIABLE" => "PAGE",	// Идентификатор вопроса
		"PAGE_WINDOW" => "10",	// Количество вопросов в навигационной цепочке
		"SHOW_TIME_LIMIT" => "N",	// Показывать счетчик ограничения времени
		"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
	),
	false
);?>
<?}?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>