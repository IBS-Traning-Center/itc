<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");?>

<?if (!$USER->IsAuthorized()) {?>
<h2>После авторизации вы получите доступ к содержимому курса</h2>
<?$APPLICATION->IncludeComponent("bitrix:system.auth.form","selflearning",Array(
     "REGISTER_URL" => "/auth/registration.html?register=yes",
     "FORGOT_PASSWORD_URL" => "",
     "PROFILE_URL" => "profile.php",
     "SHOW_ERRORS" => "Y"
     )
);?>
<?} else {?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"course.self-learning",
	array(
		"COMPONENT_TEMPLATE" => "course.self-learning",
		"IBLOCK_TYPE" => "edu",
		"IBLOCK_ID" => "168",
		"ELEMENT_ID" => $_REQUEST["ID"],
		"ELEMENT_CODE" => "",
		"CHECK_DATES" => "Y",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "DESCRIPTION",
			1 => "RELATED",
			2 => "CONTENT",
			3 => "PEOPLE",
			4 => "",
		),
		"IBLOCK_URL" => "",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"SET_TITLE" => "Y",
		"SET_CANONICAL_URL" => "N",
		"SET_BROWSER_TITLE" => "Y",
		"BROWSER_TITLE" => "-",
		"SET_META_KEYWORDS" => "Y",
		"META_KEYWORDS" => "-",
		"SET_META_DESCRIPTION" => "Y",
		"META_DESCRIPTION" => "-",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"ADD_ELEMENT_CHAIN" => "N",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"USE_PERMISSIONS" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"USE_SHARE" => "N",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Страница",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
	false
);?>
<div class="frame overflow-hidden no-top-padding clearfix">
	<div class="one-big-wrap">
		<div class="learn_more">
			<h3>Хотите узнать больше?</h3>
			<p>
				 По всем вопросам отправьте письмо по адресу <a href="mailto:<?=EMAIL_ADDRESS?>"><?=EMAIL_ADDRESS?></a>
			</p>
		</div>
		 <script>
            $(document).ready(function () {
                $("#ya_share").one("click", function () {
                    pageTracker._trackEvent('SocialBlock', 'Events', 'All');
                });
                $(".b-share-icon_yaru").click(function () {
                    pageTracker._trackEvent('SocialBlock', 'Events', 'Ya.ru');
                });
                $(".b-share-icon_vkontakte").click(function () {
                    pageTracker._trackEvent('SocialBlock', 'Events', 'Vkontakte');
                });
                $(".b-share-icon_facebook").click(function () {
                    pageTracker._trackEvent('SocialBlock', 'Events', 'Facebook');
                });
                $(".b-share-icon_twitter").click(function () {
                    pageTracker._trackEvent('SocialBlock', 'Events', 'Twitter');
                });
                $(".b-share-icon_odnoklassniki").click(function () {
                    pageTracker._trackEvent('SocialBlock', 'Events', 'Odnoklassniki');
                });
                $(".b-share-icon_lj").click(function () {
                    pageTracker._trackEvent('SocialBlock', 'Events', 'LifeJournal');
                });
                $(".b-share-icon_moikrug").click(function () {
                    pageTracker._trackEvent('SocialBlock', 'Events', 'MoiKrug');
                });
                $(".b-share-icon_evernote").click(function () {
                    pageTracker._trackEvent('SocialBlock', 'Events', 'Evernote');
                });
                $(".b-share-icon_greader").click(function () {
                    pageTracker._trackEvent('SocialBlock', 'Events', 'Greader');
                });

            })
        </script>
	</div>
</div>
 <br>
<?}?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
