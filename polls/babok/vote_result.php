<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->SetTitle("Результаты опроса");
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_after.php");
?>
<?$APPLICATION->IncludeComponent("bitrix:voting.result", "vote.no-show", Array(
	"VOTE_ID" => "11",	// Идентификатор опроса
	"VOTE_ALL_RESULTS" => "Y",	// Показывать все результаты
	"CACHE_TYPE" => "N",	// Тип кеширования
	"CACHE_TIME" => "1200",	// Время кеширования (сек.)
	"QUESTION_DIAGRAM_36" => "-",	// Тип диаграммы для вопроса "Готовы ли Вы пройти обязательн..."
	),
	false
);?>

<p><span class="links"><a href="/timetable/index.html?type=events">Календарь ближайших семинаров, вебинаров и других мероприятий Учебного Центра Luxoft</a></span><br />
  <span class="links"><a href="/timetable/index.html?by_date=Y&type=courses">Календарь тренингов</a></span><br />
  </p>
<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog.php");?>