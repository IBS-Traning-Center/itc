<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Подписка");
?>
<div class="content-title">
	<h1>Подписка</h1>
	<?$APPLICATION->IncludeComponent(
	"bitrix:subscribe.edit",
	"clear",
	Array(
		"AJAX_MODE" => "N",
		"SHOW_HIDDEN" => "N",
		"ALLOW_ANONYMOUS" => "Y",
		"SHOW_AUTH_LINKS" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"SET_TITLE" => "N",
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N"
	),
false
);?>
<div class="popup">
	<?$APPLICATION->IncludeComponent(
    "luxoft:pick.recommend",
    "",
    Array(
 
    )
);?>
		
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>