<div class="buble_body"> 
  <h2>Мероприятия </h2>
 <?$APPLICATION->IncludeComponent(
	"edu:events.calendar",
	"edu_calendar_events",
	Array(
		"IBLOCK_TYPE" => "edu",
		"PROPERTY_CITYCHECK" => "0",
		"IBLOCK_ID" => "65",
		"MONTH_VAR_NAME" => "month",
		"YEAR_VAR_NAME" => "year",
		"WEEK_START" => "1",
		"SHOW_YEAR" => "N",
		"SHOW_TIME" => "N",
		"TITLE_LEN" => "200",
		"SHOW_CURRENT_DATE" => "Y",
		"SHOW_MONTH_LIST" => "N",
		"NEWS_COUNT" => "0",
		"DETAIL_URL" => "news_detail.php?ID=#ELEMENT_ID#",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"DATE_FIELD" => "DATE_ACTIVE_FROM",
		"TYPE" => "EVENTS",
		"SET_TITLE" => "N"
	)
);?> </div>



<style>
.socialnet{
    display: block;
    margin: 0px;
    padding: 5px 0 5px 5px;
}
.socialnet img{
    max-width:24px;
    max-height:24px;
    float:none!important;
    margin:0px!important;
}
.socialnet a{
	padding:0px 6px 0px 0px;
}
</style>
 
  <div class="socialnet"> <a id="s_facebook" rel="nofollow" target="_blank" href="http://www.facebook.com/TrainingCenterLuxoft" ><img src="/downloads/images/social/t_facebook.png" width="32" height="32"  /></a> <a id="s_twitter" rel="nofollow" target="_blank" href="http://twitter.com/TrainingLuxoft" ><img src="/downloads/images/social/t_twitter.png" width="32" height="32"  /></a> <a id="s_youtube" rel="nofollow" target="_blank" href="http://www.youtube.com/user/LuxoftTrainingCenter" ><img src="/downloads/images/social/t_youtube.png" width="32" height="32"  /></a> <a id="s_rss" rel="nofollow" target="_blank" href="/rss/" ><img src="/downloads/images/social/t_rss.png" width="32" height="32"  /></a> <a id="s_linkedin" rel="nofollow" target="_blank" href="http://www.linkedin.com/groups/Luxoft-Training-Center-3880622?trk=myg_ugrp_ovr" ><img src="/downloads/images/social/t_linkedin.png" width="32" height="32"  /></a> <a id="s_vkontakte" rel="nofollow" target="_blank" href="http://vkontakte.ru/luxoft_training" ><img src="/downloads/images/social/t_vkontakte.gif" width="32" height="32"  /></a> </div>


 	<?/*$APPLICATION->IncludeComponent("bitrix:news.list", "news_in_presspage", array(
	"IBLOCK_TYPE" => "edu",
	"IBLOCK_ID" => "83",
	"NEWS_COUNT" => "6",
	"SORT_BY1" => "ACTIVE_FROM",
	"SORT_ORDER1" => "DESC",
	"SORT_BY2" => "SORT",
	"SORT_ORDER2" => "ASC",
	"FILTER_NAME" => "",
	"FIELD_CODE" => array(
		0 => "XML_ID",
		1 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "",
		1 => "abstract",
		2 => "",
	),
	"CHECK_DATES" => "Y",
	"DETAIL_URL" => "",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_SHADOW" => "Y",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600",
	"CACHE_FILTER" => "N",
	"CACHE_GROUPS" => "Y",
	"PREVIEW_TRUNCATE_LEN" => "",
	"ACTIVE_DATE_FORMAT" => "j F Y",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "N",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"ADD_SECTIONS_CHAIN" => "Y",
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",
	"PARENT_SECTION" => "",
	"PARENT_SECTION_CODE" => "",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "N",
	"PAGER_TITLE" => "News",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "Y",
	"DISPLAY_DATE" => "Y",
	"DISPLAY_NAME" => "Y",
	"DISPLAY_PICTURE" => "N",
	"DISPLAY_PREVIEW_TEXT" => "N",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);*/?>


