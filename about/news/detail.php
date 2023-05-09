<?php
declare(strict_types=1);
use \Bitrix\Main\Page;
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

(Page\Asset::getInstance())->addString('');
$APPLICATION->SetPageProperty("blue_title", "Новости IBS Training Center");
$APPLICATION->SetTitle("Новости IBS Training Center");
?>
<div class="bg-main-wrap" style="background: url('/static/images/news-jpg.jpg') center 0; background-size: cover;">
	<div class="frame">
		 <?php
         $APPLICATION->IncludeComponent(
            "bitrix:breadcrumb",
            "bread",
            Array(
                "START_FROM" => "0",
                "PATH" => "",
                "SITE_ID" => "s1"
            )
        );?>
        <?php
        CModule::IncludeModule("iblock");
        $arSelect = array("ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_trainert_name", "PROPERTY_trainert_name.PREVIEW_PICTURE", "PROPERTY_trainert_name.PROPERTY_expert_name", "PROPERTY_trainert_name.NAME");
        $arFilter = array("IBLOCK_ID" => 23, "CODE" => $_REQUEST["ID"], "ACTIVE" => "Y");
        $res = CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize" => 50), $arSelect);
        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            if (intval($arFields["PROPERTY_TRAINERT_NAME_VALUE"])) {
                $arTrainer["NAME"] = $arFields["PROPERTY_TRAINERT_NAME_PROPERTY_EXPERT_NAME_VALUE"] . " " . $arFields["PROPERTY_TRAINERT_NAME_NAME"];
                $arTrainer["PHOTO"] = CFile::GetFileArray($arFields["PROPERTY_TRAINERT_NAME_PREVIEW_PICTURE"]);
            }
        }
        ?>
        <?php
        if (is_array($arTrainer)) { ?>
            <div class="clearfix heading-white">
                <div class="picture-wrap-trainer">
                    <img src="<?= $arTrainer["PHOTO"]["SRC"] ?>">;
                </div>
                <div class="left-wrap-trainer">
                    <div class="trainer-name-item">
                        <?= $arTrainer["NAME"] ?>
                    </div>
                    <h1><?= $APPLICATION->ShowTitle(false) ?></h1>
                </div>
            </div>
        <?php } else { ?>
            <div class="clearfix heading-white">
                <h1><?= $APPLICATION->ShowTitle(false) ?></h1>
            </div>
        <?php } ?>
	</div>
</div>
<div class="not-main-page" id="middle-content">
	<div class="frame overflow-hidden no-top-padding clearfix">
		<div class="one-big-wrap course-main-info no-margin news-item-wrap">
			 <?php
             $ElementID = $APPLICATION->IncludeComponent(
                 "bitrix:news.detail",
                 "en_single_pressrelease",
                 array(
                     "IBLOCK_TYPE" => "edu",
                     "IBLOCK_ID" => "23",
                     "ELEMENT_ID" => "",
                     "ELEMENT_CODE" => $_REQUEST["ID"],
                     "CHECK_DATES" => "Y",
                     "FIELD_CODE" => array(
                         0 => "PREVIEW_TEXT",
                         1 => "SHOW_COUNTER",
                     ),
                     "PROPERTY_CODE" => array(
                         0 => "",
                         1 => "publication",
                         2 => "",
                     ),
                     "IBLOCK_URL" => "news.php?ID=#IBLOCK_ID#",
                     "AJAX_MODE" => "N",
                     "AJAX_OPTION_SHADOW" => "Y",
                     "AJAX_OPTION_JUMP" => "N",
                     "AJAX_OPTION_STYLE" => "Y",
                     "AJAX_OPTION_HISTORY" => "N",
                     "CACHE_TYPE" => "A",
                     "CACHE_TIME" => "360000",
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
                     "AJAX_OPTION_ADDITIONAL" => "",
                     "COMPONENT_TEMPLATE" => "en_single_pressrelease",
                     "DETAIL_URL" => "",
                     "CACHE_GROUPS" => "Y",
                     "SET_CANONICAL_URL" => "N",
                     "SET_BROWSER_TITLE" => "Y",
                     "BROWSER_TITLE" => "-",
                     "SET_META_KEYWORDS" => "Y",
                     "SET_META_DESCRIPTION" => "Y",
                     "SET_LAST_MODIFIED" => "N",
                     "ADD_ELEMENT_CHAIN" => "Y",
                     "PAGER_SHOW_ALL" => "N",
                     "PAGER_BASE_LINK_ENABLE" => "N",
                     "SET_STATUS_404" => "N",
                     "SHOW_404" => "N",
                     "MESSAGE_404" => ""
                 ),
                 false
             ); ?>
            <?php
            if (!$ElementID) {
                $arSelect = Array("ID", "CODE", "DATE_ACTIVE_FROM");
                $arFilter = Array("IBLOCK_ID"=> 23, "ID"=> $_REQUEST["ID"], "ACTIVE"=>"Y");
                $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
                if ($ob = $res->GetNextElement())
                {
                 $arFields = $ob->GetFields();
                    LocalRedirect("/about/news/".$arFields["CODE"]."/", false, "301 Moved permanently");
                } else {
                    LocalRedirect("/about/news/", false, "301 Moved permanently");
                }
            }?>
            <br>
            <?php
            $APPLICATION->IncludeComponent(
                "bitrix:forum.topic.reviews",
                ".default",
                [
                    "SHOW_LINK_TO_FORUM" => "N",
                    "FILES_COUNT" => "2",
                    "FORUM_ID" => "9",
                    "IBLOCK_TYPE" => "edu",
                    "IBLOCK_ID" => "23",
                    "ELEMENT_ID" => $ElementID,
                    "AJAX_POST" => "N",
                    "POST_FIRST_MESSAGE" => "Y",
                    "POST_FIRST_MESSAGE_TEMPLATE" => "#IMAGE#[url=#LINK#]#TITLE#[/url]#BODY#",
                    "URL_TEMPLATES_READ" => "read.php?FID=#FID#&TID=#TID#",
                    "URL_TEMPLATES_DETAIL" => "photo_detail.php?ID=#ELEMENT_ID#",
                    "URL_TEMPLATES_PROFILE_VIEW" => "profile_view.php?UID=#UID#",
                    "MESSAGES_PER_PAGE" => "10",
                    "PAGE_NAVIGATION_TEMPLATE" => "",
                    "DATE_TIME_FORMAT" => "d.m.Y H:i:s",
                    "PATH_TO_SMILE" => "/bitrix/images/forum/smile/",
                    "EDITOR_CODE_DEFAULT" => "Y",
                    "SHOW_AVATAR" => "Y",
                    "SHOW_RATING" => "Y",
                    "RATING_TYPE" => "like",
                    "SHOW_MINIMIZED" => "Y",
                    "USE_CAPTCHA" => "Y",
                    "PREORDER" => "Y",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "0",
                    "COMPONENT_TEMPLATE" => ".default",
                    "NAME_TEMPLATE" => ""
                ]
            );?>
		</div>
	</div>
</div>
    <style>
        .section-box._subscribe {
            padding: 0;
        }
        .section-box._subscribe .section-box__container {
            transform: scale(0.7);
        }
    </style>
<section class="section-box _subscribe">
    <div class="section-box__container container">
        <div class="section-box__header">
            <div class="section-box__title _white">Как не пропустить <b>самое интересное?</b></div>
            <div class="section-box__subtitle _white">Подписывайтесь на наш ежемесячный дайджест!</div>
        </div>
        <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH.'/include/subscribe.php', [], ['MODE' => 'html']);?>
    </div>
</section>
<script>
    $(document).ready(function () {
        $("#ya_share").one("click", function () {
            pageTracker._trackEvent('SocialBlock', 'News', 'All');
        });
        $(".b-share-icon_yaru").click(function () {
            pageTracker._trackEvent('SocialBlock', 'News', 'Ya.ru');
        });
        $(".b-share-icon_vkontakte").click(function () {
            pageTracker._trackEvent('SocialBlock', 'News', 'Vkontakte');
        });
        $(".b-share-icon_facebook").click(function () {
            pageTracker._trackEvent('SocialBlock', 'News', 'Facebook');
        });
        $(".b-share-icon_twitter").click(function () {
            pageTracker._trackEvent('SocialBlock', 'News', 'Twitter');
        });
        $(".b-share-icon_odnoklassniki").click(function () {
            pageTracker._trackEvent('SocialBlock', 'News', 'Odnoklassniki');
        });
        $(".b-share-icon_lj").click(function () {
            pageTracker._trackEvent('SocialBlock', 'News', 'LifeJournal');
        });
        $(".b-share-icon_moikrug").click(function () {
            pageTracker._trackEvent('SocialBlock', 'News', 'MoiKrug');
        });
        $(".b-share-icon_evernote").click(function () {
            pageTracker._trackEvent('SocialBlock', 'News', 'Evernote');
        });
        $(".b-share-icon_greader").click(function () {
            pageTracker._trackEvent('SocialBlock', 'News', 'Greader');
        });

    });

    $('body').on('click', '.registration-link', function () {
        if (localStorage.getItem('webform_done') === null) {
            $('.form-wrapper').fadeIn();
            localStorage.setItem('webform_done', 'true');
        }
        return false;
    });

    $('body').on('click', '.fa', function () {
        $('.form-wrapper').fadeOut();
        $('.mask').fadeOut();

        return false;
    });
</script>
<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");