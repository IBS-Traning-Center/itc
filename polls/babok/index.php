<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->SetTitle("Опрос");
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_after.php");
?> <?
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
?> <?$APPLICATION->IncludeComponent(
	"bitrix:voting.form",
	"blog.vote",
	Array(
		"VOTE_ID" => "11",
		"VOTE_RESULT_TEMPLATE" => "vote_result.php?VOTE_ID=#VOTE_ID#",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "3600"
	)
);?>
<br />
 * Скидка предоставляется только физ. лицам на курсы из открытого расписания по Бизнес- и Системному анализу при условии регистрации и оплаты до 31 июля 2013.
<br />

<br />
 Получить дополнительную информацию Вы можете у нашего менеджера:
<br />

<br />
 email: <a href="mailto:KGavrilchenko<?=EMAIL_DOMAIN?>" >KGavrilchenko<?=EMAIL_DOMAIN?></a>
<br />
 тел: +7 495 967 80 30, доб. 5095
<br />
 Кристина Гаврильченко
<br />

<br />
  <?$APPLICATION->IncludeComponent(
	"bitrix:voting.result",
	".default",
	Array(
		"VOTE_ID" => "10",
		"VOTE_ALL_RESULTS" => "Y",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "1200",
		"QUESTION_DIAGRAM_35" => "-"
	),
false,
Array(
	'ACTIVE_COMPONENT' => 'N'
)
);?> <?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog.php");?>
