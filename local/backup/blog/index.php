<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_after.php");
$APPLICATION->SetTitle("Блоги экспертов");
?>
<style>
.blog-sidebar{
display:none;
}
.search-tags-cloud a{
font-size:13px!important;
}
</style>
<?$APPLICATION->IncludeComponent("bitrix:blog", ".default", array(
	"MESSAGE_COUNT" => "10",
	"PERIOD_DAYS" => "30",
	"MESSAGE_COUNT_MAIN" => "11",
	"BLOG_COUNT_MAIN" => "6",
	"MESSAGE_LENGTH" => "300",
	"BLOG_COUNT" => "20",
	"DATE_TIME_FORMAT" => "d.m.Y H:i:s",
	"NAV_TEMPLATE" => "",
	"SMILES_COUNT" => "4",
	"IMAGE_MAX_WIDTH" => "800",
	"IMAGE_MAX_HEIGHT" => "800",
	"EDITOR_RESIZABLE" => "Y",
	"EDITOR_DEFAULT_HEIGHT" => "400",
	"EDITOR_CODE_DEFAULT" => "N",
	"SEF_MODE" => "Y",
	"SEF_FOLDER" => "/blog/",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600",
	"CACHE_TIME_LONG" => "604800",
	"PATH_TO_SMILE" => "/bitrix/images/blog/smile/",
	"SET_TITLE" => "Y",
	"SET_NAV_CHAIN" => "Y",
	"USER_PROPERTY" => array(
		0 => "UF_EXPERT",
	),
	"BLOG_PROPERTY" => array(
	),
	"BLOG_PROPERTY_LIST" => array(
	),
	"POST_PROPERTY" => array(
	),
	"POST_PROPERTY_LIST" => array(
	),
	"COMMENT_PROPERTY" => array(
	),
	"USE_ASC_PAGING" => "N",
	"SHOW_RATING" => "N",
	"RATING_TYPE" => "",
	"ALLOW_POST_CODE" => "N",
	"COMMENTS_COUNT" => "25",
	"NOT_USE_COMMENT_TITLE" => "Y",
	"AJAX_POST" => "Y",
	"COMMENT_EDITOR_RESIZABLE" => "Y",
	"COMMENT_EDITOR_DEFAULT_HEIGHT" => "200",
	"COMMENT_EDITOR_CODE_DEFAULT" => "Y",
	"COMMENT_ALLOW_VIDEO" => "N",
	"COMMENT_ALLOW_IMAGE_UPLOAD" => "A",
	"SHOW_SPAM" => "N",
	"NO_URL_IN_COMMENTS" => "",
	"NO_URL_IN_COMMENTS_AUTHORITY" => "",
	"THEME" => "blue",
	"GROUP_ID" => array(
		0 => "",
		1 => "",
	),
	"SHOW_NAVIGATION" => "N",
	"USER_PROPERTY_NAME" => "",
	"PERIOD_NEW_TAGS" => "",
	"PERIOD" => "",
	"COLOR_TYPE" => "Y",
	"WIDTH" => "100%",
	"SEO_USER" => "Y",
	"NAME_TEMPLATE" => "#NOBR##LAST_NAME# #NAME##/NOBR#",
	"SHOW_LOGIN" => "Y",
	"SEF_URL_TEMPLATES" => array(
		"index" => "index.html",
		"group" => "group/#group_id#.html",
		"blog" => "#blog#/",
		"user" => "user/#user_id#.html",
		"user_friends" => "friends/#user_id#.html",
		"search" => "search.html",
		"user_settings" => "#blog#/user_settings.html",
		"user_settings_edit" => "#blog#/user_settings_edit.html?id=#user_id#",
		"group_edit" => "#blog#/group_edit.html",
		"blog_edit" => "#blog#/blog_edit.html",
		"category_edit" => "#blog#/category_edit.html",
		"post_edit" => "#blog#/post_edit.html?id=#post_id#",
		"draft" => "#blog#/draft.html",
		"moderation" => "#blog#/moderation.html",
		"trackback" => POST_FORM_ACTION_URI."&blog=#blog#&id=#post_id#&page=trackback",
		"post" => "#blog#/#post_id#.html",
	),
	"VARIABLE_ALIASES" => array(
		"user_settings_edit" => array(
			"user_id" => "id",
		),
		"post_edit" => array(
			"post_id" => "id",
		),
		"trackback" => array(
			"blog" => "blog",
			"post_id" => "id",
		),
	)
	),
	false
);?>

	<script>
	$(document).ready(function(){
							$("#ya_share").one("click", function() {
								pageTracker._trackEvent('SocialBlock', 'Blogs', 'All');
							});
							$(".b-share-icon_yaru").click(function() {
								pageTracker._trackEvent('SocialBlock', 'Blogs', 'Ya.ru');
							});
							$(".b-share-icon_vkontakte").click(function() {
								pageTracker._trackEvent('SocialBlock', 'Blogs', 'Vkontakte');
							});
							$(".b-share-icon_facebook").click(function() {
								pageTracker._trackEvent('SocialBlock', 'Blogs', 'Facebook');
							});
							$(".b-share-icon_twitter").click(function() {
								pageTracker._trackEvent('SocialBlock', 'Blogs', 'Twitter');
							});
							$(".b-share-icon_odnoklassniki").click(function() {
								pageTracker._trackEvent('SocialBlock', 'Blogs', 'Odnoklassniki');
							});
							$(".b-share-icon_lj").click(function() {
								pageTracker._trackEvent('SocialBlock', 'Blogs', 'LifeJournal');
							});
							$(".b-share-icon_moikrug").click(function() {
								pageTracker._trackEvent('SocialBlock', 'Blogs', 'MoiKrug');
							});
							$(".b-share-icon_evernote").click(function() {
								pageTracker._trackEvent('SocialBlock', 'Blogs', 'Evernote');
							});
							$(".b-share-icon_greader").click(function() {
								pageTracker._trackEvent('SocialBlock', 'Blogs', 'Greader');
							});
							
							$('.blog-comment-buttons input[name="post"]').one("click", function() {
								pageTracker._trackEvent('Blogs', 'CommentAdd', 'Click');
							});
	})
	</script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>