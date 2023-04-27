<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("blue_title", "УЦ Luxoft в СМИ");
$APPLICATION->SetTitle("УЦ Luxoft в СМИ");
?><?$APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"en_single_pressrelease",
	Array(
		"IBLOCK_TYPE" => "edu",
		"IBLOCK_ID" => "83",
		"ELEMENT_ID" => $_REQUEST["ID"],
		"ELEMENT_CODE" => "",
		"CHECK_DATES" => "Y",
		"FIELD_CODE" => array(0=>"",1=>"",),
		"PROPERTY_CODE" => array(0=>"",1=>"publication",2=>"",),
		"IBLOCK_URL" => "news.php?ID=#IBLOCK_ID#",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"DISPLAY_PANEL" => "N",
		"SET_TITLE" => "Y",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"USE_PERMISSIONS" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "Страница",
		"PAGER_TEMPLATE" => "",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"AJAX_OPTION_ADDITIONAL" => ""
	)
);?><br /><br />
<?
//$uri = "http://www.luxoft-training.ru";
//$uri .= $APPLICATION->GetCurPageParam(false, array("ID_TIME", "clear_cache")); 
$uri = $_SERVER["SCRIPT_URI"];
?>
<iframe src="http://www.facebook.com/plugins/like.php?app_id=108688045898915&amp;href=<?=$uri?>&amp;send=false&amp;layout=standard&amp;width=450&amp;show_faces=true&amp;locale=ru_RU&amp;action=like&amp;colorscheme=light&amp;font=arial&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:80px;" allowTransparency="true"></iframe>

	<script>
	$(document).ready(function(){
							$("#ya_share").one("click", function() {
								pageTracker._trackEvent('SocialBlock', 'News', 'All');
							});
							$(".b-share-icon_yaru").click(function() {
								pageTracker._trackEvent('SocialBlock', 'News', 'Ya.ru');
							});
							$(".b-share-icon_vkontakte").click(function() {
								pageTracker._trackEvent('SocialBlock', 'News', 'Vkontakte');
							});
							$(".b-share-icon_facebook").click(function() {
								pageTracker._trackEvent('SocialBlock', 'News', 'Facebook');
							});
							$(".b-share-icon_twitter").click(function() {
								pageTracker._trackEvent('SocialBlock', 'News', 'Twitter');
							});
							$(".b-share-icon_odnoklassniki").click(function() {
								pageTracker._trackEvent('SocialBlock', 'News', 'Odnoklassniki');
							});
							$(".b-share-icon_lj").click(function() {
								pageTracker._trackEvent('SocialBlock', 'News', 'LifeJournal');
							});
							$(".b-share-icon_moikrug").click(function() {
								pageTracker._trackEvent('SocialBlock', 'News', MoiKrug');
							});
							$(".b-share-icon_evernote").click(function() {
								pageTracker._trackEvent('SocialBlock', 'News', 'Evernote');
							});
							$(".b-share-icon_greader").click(function() {
								pageTracker._trackEvent('SocialBlock', 'News', 'Greader');
							});

	})
	</script>


<?/*$APPLICATION->IncludeComponent(
	"bitrix:asd.share.buttons",
	"",
	Array(
		"ASD_TITLE" => $_REQUEST["title"],
		"ASD_URL" => $_REQUEST["url"],
		"ASD_PICTURE" => $_REQUEST["picture"],
		"ASD_TEXT" => $_REQUEST["text"],
		"ASD_INCLUDE_SCRIPTS" => array("FB_LIKE"),
		"LIKE_TYPE" => "LIKE",
		"FB_LIKE_VIEW" => "button_count"
	)
);*/?> <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>