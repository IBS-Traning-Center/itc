<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->SetTitle("Опрос");

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_after.php");
?>
<?
if (CModule::IncludeModule("vote"))
{
//$VOTE_ID = $_REQUEST["VOTE_ID"]; // берет ID опроса из параметров страницы
$VOTE_ID = GetCurrentVote("BLOGS");
//echo "VOTE_ID=$VOTE_ID";
}
// Примеры использования основных функций модуля опросов
/*
if (CModule::IncludeModule("vote"))
{
	$bIsUserVoted = IsUserVoted($VOTE_ID)	// проверяет голосовал ли уже данный посетитель (возвращает true либо false)
	$VOTE_ID = GetCurrentVote("ANKETA");	// возвращает ID текущего опроса группы ANKETA
	$VOTE_ID = GetPrevVote("ANKETA");		// возвращает ID предыдущего опроса группы ANKETA
	$VOTE_ID = GetAnyAccessibleVote();		// возвращает ID любого доступного для голосования опроса
}
*/
//"VOTE_RESULT_TEMPLATE" => "vote_result.php?VOTE_ID=#VOTE_ID#",	// Страница для вывода диаграмм результатов опроса
?>

<?$APPLICATION->IncludeComponent("bitrix:voting.form", "event_vote", Array(
	"VOTE_ID" => $VOTE_ID,	// Идентификатор опроса
	"VOTE_RESULT_TEMPLATE" => "index.html?VOTE_ID=#VOTE_ID#",	// Страница для вывода диаграмм результатов опроса
	),
	false
);?>

<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog.php");?>