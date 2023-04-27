<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->SetTitle("Результаты опроса");
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_after.php");
?>
<?$APPLICATION->IncludeComponent("bitrix:voting.result", ".default", array(
	"VOTE_ID" => "10",
	"VOTE_ALL_RESULTS" => "Y",
	"CACHE_TYPE" => "N",
	"CACHE_TIME" => "1200",
	"QUESTION_DIAGRAM_35" => "-"
	),
	false
);?>

<p><span class="links"><a href="/timetable/index.html?type=events">Календарь ближайших семинаров, вебинаров и других мероприятий Учебного Центра Luxoft</a></span><br />
  <span class="links"><a href="/timetable/index.html?by_date=Y&type=courses">Календарь тренингов</a></span><br />
  </p>
<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog.php");?>