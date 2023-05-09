<?
/*require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");*/
include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
?>
<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$APPLICATION->ShowPanel = true;?>
<?$APPLICATION->ShowHeadStrings()?>
<?$APPLICATION->ShowHeadScripts()?>
<?$APPLICATION->ShowMeta("description")?>
<link href="/master-class/css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="/master-class/js/jquery.tools.min.js"></script>
<script src="/bitrix/templates/.default/en/js/cycle.all.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="/bitrix/templates/.default/en/js/jquery.maximage.min.js"></script>
<script type="text/javascript" src="https://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
<script type="text/javascript" src="/bitrix/templates/.default/en/js/jquery.scrollTo.min.js"></script>
<!--[if lt IE 9]>
<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->
<script type="text/javascript">
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-9384348-1', 'auto');
	  ga('require', 'displayfeatures');
	  ga('send', 'pageview');
</script>
<?php
$elementID = $APPLICATION->IncludeComponent(
    "bitrix:news.detail",
    "landing",
    array(
        "IBLOCK_TYPE" => "land",
        "IBLOCK_ID" => "116",
        "ELEMENT_ID" => "",
        "ELEMENT_CODE" => $_REQUEST["CODE"],
        "CHECK_DATES" => "Y",
        "FIELD_CODE" => array(
            0 => "",
            1 => "DETAIL_TEXT",
            2 => "DETAIL_PICTURE",
            3 => "",
        ),
        "PROPERTY_CODE" => array(
            0 => "",
            1 => "DESCRIPTION",
            2 => "",
        ),
        "IBLOCK_URL" => "news.php?ID=#IBLOCK_ID#\"",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "CACHE_TYPE" => "N",
        "CACHE_TIME" => "3600",
        "CACHE_GROUPS" => "Y",
        "META_KEYWORDS" => "-",
        "META_DESCRIPTION" => "-",
        "BROWSER_TITLE" => "-",
        "SET_TITLE" => "N",
        "SET_STATUS_404" => "Y",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
        "ADD_SECTIONS_CHAIN" => "Y",
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "USE_PERMISSIONS" => "Y",
        "GROUP_PERMISSIONS" => array(
            0 => "1",
            1 => "2",
        ),
        "DISPLAY_TOP_PAGER" => "Y",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "PAGER_TITLE" => "Страница",
        "PAGER_TEMPLATE" => "",
        "PAGER_SHOW_ALL" => "Y",
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "USE_SHARE" => "Y",
        "SHARE_HIDE" => "N",
        "SHARE_TEMPLATE" => "",
        "SHARE_HANDLERS" => array(),
        "SHARE_SHORTEN_URL_LOGIN" => "",
        "SHARE_SHORTEN_URL_KEY" => "",
        "AJAX_OPTION_ADDITIONAL" => ""
    ),
    false
); ?>
<?if (intval($elementID)==0) {?>
	<?LocalRedirect('/timetable/', "301 Moved permanently");?>
<?}?>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/56c443c6427448592519f5af/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter23056159 = new Ya.Metrika({id:23056159,
                    webvisor:true,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<script>
$(document).ready(function() {
		$('#maximage').maximage({onImagesLoaded: function(){
			
		}});
		$('#maximage2').maximage();
	});
</script>
<?$APPLICATION->IncludeFile(
    $APPLICATION->GetTemplatePath("/bitrix/templates/.default/en/include_areas/analytics.html"),
    Array(),
    Array("MODE"=>"php")
);?>