<div class="buble_body">

  <h2>Последние новости</h2>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"news_in_presspage",
	Array(
		"IBLOCK_TYPE" => "edu", 
		"IBLOCK_ID" => "23", 
		"NEWS_COUNT" => "3", 
		"SORT_BY1" => "ACTIVE_FROM", 
		"SORT_ORDER1" => "DESC", 
		"SORT_BY2" => "SORT", 
		"SORT_ORDER2" => "ASC", 
		"FILTER_NAME" => "", 
		"FIELD_CODE" => array(0=>"XML_ID",1=>"",2=>"",), 
		"PROPERTY_CODE" => array(0=>"abstract",1=>"",), 
		"DETAIL_URL" => "", 
		"AJAX_MODE" => "N", 
		"AJAX_OPTION_SHADOW" => "Y", 
		"AJAX_OPTION_JUMP" => "N", 
		"AJAX_OPTION_STYLE" => "Y", 
		"AJAX_OPTION_HISTORY" => "N", 
		"CACHE_TYPE" => "A", 
		"CACHE_TIME" => "3600", 
		"CACHE_FILTER" => "N", 
		"PREVIEW_TRUNCATE_LEN" => "", 
		"ACTIVE_DATE_FORMAT" => "F j, Y", 
		"DISPLAY_PANEL" => "N", 
		"SET_TITLE" => "N", 
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N", 
		"ADD_SECTIONS_CHAIN" => "Y", 
		"HIDE_LINK_WHEN_NO_DETAIL" => "N", 
		"PARENT_SECTION" => "", 
		"DISPLAY_TOP_PAGER" => "N", 
		"DISPLAY_BOTTOM_PAGER" => "N", 
		"PAGER_TITLE" => "News", 
		"PAGER_SHOW_ALWAYS" => "N", 
		"PAGER_TEMPLATE" => "", 
		"PAGER_DESC_NUMBERING" => "N", 
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000", 
		"DISPLAY_DATE" => "Y", 
		"DISPLAY_NAME" => "Y", 
		"DISPLAY_PICTURE" => "N", 
		"DISPLAY_PREVIEW_TEXT" => "N" 
	)
);?> 
  <p><a href="/rss/" >RSS</a> / <a href="/news/" >Все новости...</a></p>
</div>
