<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->SetTitle("Результаты опроса");
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_after.php");
?>
<?$APPLICATION->IncludeComponent("bitrix:voting.result", "no.digits", array(
	"VOTE_ID" => "9",
	"VOTE_ALL_RESULTS" => "Y",
	"CACHE_TYPE" => "N",
	"CACHE_TIME" => "1200",
	"QUESTION_DIAGRAM_26" => "-",
	"QUESTION_DIAGRAM_27" => "-",
	"QUESTION_DIAGRAM_28" => "-",
	"QUESTION_DIAGRAM_29" => "-",
	"QUESTION_DIAGRAM_30" => "-",
	"QUESTION_DIAGRAM_31" => "-",
	"QUESTION_DIAGRAM_32" => "-",
	"QUESTION_DIAGRAM_33" => "-",
	"QUESTION_DIAGRAM_34" => "-"
	),
	false
);?>

<p><span class="links"><a href="/timetable/index.html?type=events">Календарь ближайших семинаров, вебинаров и других мероприятий Учебного Центра Luxoft</a></span><br />
  <span class="links"><a href="/timetable/index.html?by_date=Y&type=courses">Календарь тренингов</a></span><br />
  </p>
<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog.php");?>