<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$allNum = count($arResult["arMap"]);
//print_r($arResult);
$colNum = ceil($allNum / $arParams["COL_NUM"]);

if (is_array($arResult["arMap"]))
{
?>
<div id="sitemap">

<table class="map-columns" width="100%">
<tr>
	<td width="250">
<?
	$level = -1;
	$counter = 0;
	foreach ($arResult["arMap"] as $arItem)
	{
		if ($arItem["LEVEL"] < $level)
		{
			for ($i = $arItem["LEVEL"]; $i<$level; $i++)
			{
			?></ul>
<?
			}
		}

		if ($counter >= $colNum)
		{
			if ($arItem["LEVEL"] == 0)
			{
				$counter = 0;
			?>
</ul></td><td width="250"><ul class="map-level-0">
<?
			}
		}

		if ($arItem["LEVEL"] > $level)
		{
		?><ul class="map-level-<?=$arItem["LEVEL"]?>">
<?
		}


		$level = $arItem["LEVEL"];
		?><li><a href="<?=$arItem["FULL_PATH"]?>"><?=$arItem["NAME"]?></a>
		<?if ($arItem["NAME"] == "Case Studies") {?>  <br /><br /><h4>By Industry: </h4>
                 <ul class="map-level-2">
                <?$APPLICATION->IncludeComponent("bitrix:news.list", "industry_case_nav", Array(
					"IBLOCK_TYPE"	=>	"ennews",
					"IBLOCK_ID"	=>	"28",
					"NEWS_COUNT"	=>	"20",
					"SORT_BY1"	=>	"SORT",
					"SORT_ORDER1"	=>	"DESC",
					"SORT_BY2"	=>	"SORT",
					"SORT_ORDER2"	=>	"ASC",
					"FILTER_NAME"	=>	"",
					"FIELD_CODE"	=>	array(
						0	=>	"ID",
						1	=>	"NAME",
						2	=>	"SORT",
						3	=>	"",
						4	=>	"",
					),
					"PROPERTY_CODE"	=>	array(
						0	=>	"link",
						1	=>	"",
					),
					"DETAIL_URL"	=>	"news_detail.php?ID=#ELEMENT_ID#",
					"AJAX_MODE"	=>	"N",
					"AJAX_OPTION_SHADOW"	=>	"Y",
					"AJAX_OPTION_JUMP"	=>	"N",
					"AJAX_OPTION_STYLE"	=>	"Y",
					"AJAX_OPTION_HISTORY"	=>	"N",
					"CACHE_TYPE"	=>	"A",
					"CACHE_TIME"	=>	"3600",
					"CACHE_FILTER"	=>	"N",
					"PREVIEW_TRUNCATE_LEN"	=>	"",
					"ACTIVE_DATE_FORMAT"	=>	"d.m.Y",
					"DISPLAY_PANEL"	=>	"N",
					"SET_TITLE"	=>	"Y",
					"INCLUDE_IBLOCK_INTO_CHAIN"	=>	"N",
					"ADD_SECTIONS_CHAIN"	=>	"Y",
					"HIDE_LINK_WHEN_NO_DETAIL"	=>	"N",
					"PARENT_SECTION"	=>	"",
					"DISPLAY_TOP_PAGER"	=>	"N",
					"DISPLAY_BOTTOM_PAGER"	=>	"N",
					"PAGER_TITLE"	=>	"",
					"PAGER_SHOW_ALWAYS"	=>	"N",
					"PAGER_TEMPLATE"	=>	"",
					"PAGER_DESC_NUMBERING"	=>	"N",
					"PAGER_DESC_NUMBERING_CACHE_TIME"	=>	"36000",
					"DISPLAY_DATE"	=>	"Y",
					"DISPLAY_NAME"	=>	"Y",
					"DISPLAY_PICTURE"	=>	"Y",
					"DISPLAY_PREVIEW_TEXT"	=>	"Y"
					)
				);?>
				</ul>

				  <h4>By Services: </h4>
				  <ul class="map-level-2">
				<?$APPLICATION->IncludeComponent("bitrix:news.list", "services_case_nav", Array(
					"IBLOCK_TYPE"	=>	"ennews",
					"IBLOCK_ID"	=>	"27",
					"NEWS_COUNT"	=>	"20",
					"SORT_BY1"	=>	"SORT",
					"SORT_ORDER1"	=>	"DESC",
					"SORT_BY2"	=>	"SORT",
					"SORT_ORDER2"	=>	"ASC",
					"FILTER_NAME"	=>	"",
					"FIELD_CODE"	=>	array(
						0	=>	"ID",
						1	=>	"NAME",
						2	=>	"SORT",
						3	=>	"",
						4	=>	"",
					),
					"PROPERTY_CODE"	=>	array(
						0	=>	"link",
						1	=>	"",
					),
					"DETAIL_URL"	=>	"news_detail.php?ID=#ELEMENT_ID#",
					"AJAX_MODE"	=>	"N",
					"AJAX_OPTION_SHADOW"	=>	"Y",
					"AJAX_OPTION_JUMP"	=>	"N",
					"AJAX_OPTION_STYLE"	=>	"Y",
					"AJAX_OPTION_HISTORY"	=>	"N",
					"CACHE_TYPE"	=>	"A",
					"CACHE_TIME"	=>	"3600",
					"CACHE_FILTER"	=>	"N",
					"PREVIEW_TRUNCATE_LEN"	=>	"",
					"ACTIVE_DATE_FORMAT"	=>	"d.m.Y",
					"DISPLAY_PANEL"	=>	"N",
					"SET_TITLE"	=>	"Y",
					"INCLUDE_IBLOCK_INTO_CHAIN"	=>	"N",
					"ADD_SECTIONS_CHAIN"	=>	"Y",
					"HIDE_LINK_WHEN_NO_DETAIL"	=>	"N",
					"PARENT_SECTION"	=>	"",
					"DISPLAY_TOP_PAGER"	=>	"N",
					"DISPLAY_BOTTOM_PAGER"	=>	"N",
					"PAGER_TITLE"	=>	"",
					"PAGER_SHOW_ALWAYS"	=>	"N",
					"PAGER_TEMPLATE"	=>	"",
					"PAGER_DESC_NUMBERING"	=>	"N",
					"PAGER_DESC_NUMBERING_CACHE_TIME"	=>	"36000",
					"DISPLAY_DATE"	=>	"Y",
					"DISPLAY_NAME"	=>	"Y",
					"DISPLAY_PICTURE"	=>	"Y",
					"DISPLAY_PREVIEW_TEXT"	=>	"Y"
					)
				);?>

                 </ul><?}?>

		<?if ($arParams["SHOW_DESCRIPTION"] == "Y" && strlen($arItem["DESCRIPTION"]) > 0) {?><div><?=$arItem["DESCRIPTION"]?></div><?}?>

		</li>
<?
		$counter++;
	}

	for ($i = $level; $i>=0; $i--)
	{
	?></ul>
<?
	}

?>
	</td>
</tr>
</table>
</div> <!-- end id = sitemap -->
<?

}
?>
