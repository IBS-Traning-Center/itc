<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->SetTitle("Результаты опроса");
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_after.php");
?>
<?$APPLICATION->IncludeComponent("bitrix:voting.result", ".default", array(
	"VOTE_ID" => "8",
	"VOTE_ALL_RESULTS" => "Y",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "1200",
	"QUESTION_DIAGRAM_25" => "-"
	),
	false
);?>


<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog.php");?>