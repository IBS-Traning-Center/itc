<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<div class="body-blog">
<?
$APPLICATION->IncludeComponent(
		"luxoft:blog.rss.all2", 
		"", 
		Array(
				"BLOG_VAR" => $arResult["ALIASES"]["blog"],
				"POST_VAR" => $arResult["ALIASES"]["post_id"],
				"USER_VAR" => $arResult["ALIASES"]["user_id"],
				"PAGE_VAR" => $arResult["ALIASES"]["page"],
				"PATH_TO_POST" => $arResult["PATH_TO_POST"],
				"PATH_TO_USER" => $arResult["PATH_TO_USER"],
				"GROUP_ID" => $arResult["VARIABLES"]["group_id"],
				"TYPE" => $arResult["VARIABLES"]["type"],
				"CACHE_TYPE" => "N",
				"CACHE_TIME" => $arResult["CACHE_TIME"],
				"PARAM_GROUP_ID" => $arParams["GROUP_ID"],
			),
		$component 
	);
?>
</div>