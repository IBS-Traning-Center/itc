<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
?>
<?$APPLICATION->IncludeComponent(
"luxoft:blog.rss.all",
"",
Array(
"BLOG_VAR" => "",
"POST_VAR" => "",
"USER_VAR" => "",
"PAGE_VAR" => "",
"PATH_TO_POST" => "/blog/#blog#/#post_id#.html?r1=ya&r2=vidget&r3=schedule",
"PATH_TO_USER" => "/blog/user/#user_id#.html?r1=ya&r2=vidget&r3=schedule",
"GROUP_ID" => "index.php",
"TYPE" => "rss2",
"CACHE_TYPE" => "N",
"CACHE_TIME" => 3600,
"PARAM_GROUP_ID" => array(),
),
$component
);
?>
