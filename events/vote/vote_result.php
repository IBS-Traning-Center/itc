<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->SetTitle("Результаты опроса");
$APPLICATION->AddChainItem("Архив опросов", "vote_list.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_after.php");
?>
<?$APPLICATION->IncludeComponent("bitrix:voting.result", "event_voting_result", Array(
	"VOTE_ID"	=> $_REQUEST["VOTE_ID"],
	)
);?>

<p><span class="links"><a href="/timetable/index.html?type=events">Календарь ближайших семинаров, вебинаров и других мероприятий Учебного Центра Luxoft</a></span><br />
  <span class="links"><a href="/timetable/index.html?by_date=Y&type=courses">Календарь тренингов</a></span><br />
  </p>
<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog.php");?>