 
<div class="buble_body"> 
  <h2>Бесплатные семинары</h2>
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

