<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("blue_title", "Акции Luxoft Training");
$APPLICATION->SetTitle("Акции Luxoft Training");

if(CModule::IncludeModule("iblock"))
{
	$ID = &$_GET['ID'];
	if (isset($ID) and (is_numeric($ID)))  { } else { $ID = 5114;}
}

$APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"en_single_pressrelease",
	Array(
		"IBLOCK_TYPE" => "edu",
		"IBLOCK_ID" => "23",
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
$uri = $_SERVER["SCRIPT_URI"];
?>
<!--

<iframe src="http://www.facebook.com/plugins/like.php?app_id=108688045898915&amp;href=<?=$uri?>&amp;send=false&amp;layout=standard&amp;width=450&amp;show_faces=true&amp;locale=ru_RU&amp;action=like&amp;colorscheme=light&amp;font=arial&amp;height=50" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:50px;" allowTransparency="true"></iframe>

-->


<div id="fb-root"></div>
 <script>
     window.fbAsyncInit = function() 
    {
         // init the FB JS SDK
         FB.init(
         {
            appId : '225734987442328', 
            channelUrl : '//WWW.LUXOTFT-TRAINING.RU',
            status : true, 
            cookie : true, 
            xfbml : true 
        }); 
     }; 
     (function(d)
     {
         var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement('script'); js.id = id; js.async = true;
         js.src = "//connect.facebook.net/ru_RU/all.js";
         ref.parentNode.insertBefore(js, ref);
     }(document));
 </script>

<div class="fb-like" data-href="<?=$uri?>" data-send="false" data-width="450" data-show-faces="false"></div>
<br />
<g:plusone></g:plusone>

<!-- Поместите этот вызов функции отображения в соответствующее место. -->
<script type="text/javascript">
  window.___gcfg = {lang: 'ru'};

  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>



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
								pageTracker._trackEvent('SocialBlock', 'News', 'MoiKrug');
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