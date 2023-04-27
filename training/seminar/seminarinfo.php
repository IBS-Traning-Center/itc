<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Title");
global $USER, $startdateGlobal, $glFlagShowForm;?>
    <?$template = $APPLICATION->IncludeComponent(
        "bitrix:news.detail",
        "rd_edu_ru_oneseminar",
        array(
        "IBLOCK_TYPE" => "edu",
        "IBLOCK_ID" => "7",
        "ELEMENT_ID" => $_REQUEST["ID"],
        "ELEMENT_CODE" => "",
        "CHECK_DATES" => "Y",
        "FIELD_CODE" => array(
            0 => "",
            1 => "PREVIEW_TEXT",
            2 => "PREVIEW_PICTURE",
            3 => "",
        ),
        "PROPERTY_CODE" => array(
            0 => "location",
            1 => "lecturer",
            2 => "startdate",
            3 => "enddate",
            4 => "time",
            5 => "description",
            6 => "content",
            7 => "titlefile",
            8 => "file_old",
            9 => "",
        ),
        "IBLOCK_URL" => "news.php?ID=#IBLOCK_ID#",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_SHADOW" => "Y",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "CACHE_TYPE" => "N",
        "CACHE_TIME" => "3600",
        "META_KEYWORDS" => "-",
        "META_DESCRIPTION" => "-",
        "DISPLAY_PANEL" => "N",
        "SET_TITLE" => "Y",
        "SET_STATUS_404" => "N",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "ADD_SECTIONS_CHAIN" => "N",
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "USE_PERMISSIONS" => "N",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "PAGER_TITLE" => "Страница",
        "PAGER_TEMPLATE" => "",
        "DISPLAY_DATE" => "N",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "N",
        "DISPLAY_PREVIEW_TEXT" => "N",
        "AJAX_OPTION_ADDITIONAL" => ""
    ),
        false
    );?>
<?
$res = CIBlockElement::GetProperty(7, 100245, "sort", Array("CODE"=>"TYPE_EVENT"));
    if ($ob = $res->GetNext())
    {
        $typeEvent = intval($ob['VALUE']);
    }
?>

<? $curDate = date("d.m.Y");
$result = $DB->CompareDates($curDate, $startdateGlobal);
if (($result == 0) or ($result == -1) or ($typeEvent == 324)) {
    if ($glFlagShowForm) {?>
        <? $APPLICATION->IncludeComponent(
            "edu:iblock.element.add.form",
            "records.seminar",
            array(
                "IBLOCK_TYPE" => "edu",
                "IBLOCK_ID" => "64",
                "STATUS_NEW" => "1",
                "LIST_URL" => "",
                "USE_CAPTCHA" => "N",
                "USER_MESSAGE_EDIT" => "",
                "USER_MESSAGE_ADD" => "Спасибо. Ваша заявка была успешно добавлена",
                "DEFAULT_INPUT_SIZE" => "60",
                "PROPERTY_CODES" => array(
                    0 => "243",
                    1 => "244",
                    2 => "245",
                    3 => "246",
                    4 => "247",
                    5 => "248",
                    6 => "249",
                    7 => "271",
                    8 => "345",
                    9 => "NAME",
                ),
                "PROPERTY_CODES_REQUIRED" => array(
                    0 => "244",
                    1 => "245",
                    2 => "246",
                    3 => "247",
                    4 => "249",
                ),
                "PROPERTY_CODES_HIDDEN" => array(
                    0 => "243",
                    1 => "248",
                    2 => "271",
                ),
                "PROPERTY_TYPE_EVENT" => "80",
                "PROPERTY_TEXT_TO_DO" => "Регистрация на данный семинар",
                "GROUPS" => array(
                    0 => "2",
                ),
                "STATUS" => "ANY",
                "ELEMENT_ASSOC" => "CREATED_BY",
                "MAX_USER_ENTRIES" => "100000",
                "MAX_LEVELS" => "100000",
                "LEVEL_LAST" => "Y",
                "MAX_FILE_SIZE" => "0",
                "SEF_MODE" => "N",
                "SEF_FOLDER" => "/events/seminar/",
                "CUSTOM_TITLE_NAME" => "Название семинара",
                "CUSTOM_TITLE_TAGS" => "",
                "CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
                "CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
                "CUSTOM_TITLE_IBLOCK_SECTION" => "",
                "CUSTOM_TITLE_PREVIEW_TEXT" => "",
                "CUSTOM_TITLE_PREVIEW_PICTURE" => "",
                "CUSTOM_TITLE_DETAIL_TEXT" => "",
                "CUSTOM_TITLE_DETAIL_PICTURE" => "",
                "COMPONENT_TEMPLATE" => "records.seminar",
                "PROPERTY_EVENT_NAME" => "",
                "PROPERTY_EVENT_CITY_IN" => "",
                "PROPERTY_EVENT_DATE_IN" => date("d.m.Y",strtotime($startdateGlobal))
            ),
            false
        );?>
        <a name="fill_form"></a>
    <? } else { ?>
        <h2>Регистрация на мероприятие закрыта</h2>
    <? }
} else { ?>
    <h2>Регистрация на мероприятие закрыта</h2>
<? } ?>
<br/>

<div class="frame overflow-hidden no-top-padding clearfix">
    <div class="one-big-wrap">
        <div class="learn_more">
            <h3>Хотите узнать больше?</h3>
            <p>По всем вопросам отправьте письмо по адресу <a href="mailto:<?=EMAIL_ADDRESS?>"><?=EMAIL_ADDRESS?></a></p>
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
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
