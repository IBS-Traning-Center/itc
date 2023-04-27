<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
global $SUBSCRIBE_TEMPLATE_RESULT;
$SUBSCRIBE_TEMPLATE_RESULT = false;
global $SUBSCRIBE_TEMPLATE_RUBRIC;
$SUBSCRIBE_TEMPLATE_RUBRIC = $arRubric;
global $APPLICATION;

CModule::IncludeModule("iblock");
$arSelect = array("ID", "NAME", "DATE_ACTIVE_FROM", "PREVIEW_TEXT", "CATALOG_GROUP_1", "PROPERTY_DURATION", "PROPERTY_TRAINER_ID.NAME", "PROPERTY_TRAINER_SIMPLE", "PROPERTY_TIME", "PROPERTY_TRAINER_ID.PROPERTY_SHORT_NAME", "PROPERTY_TRAINER_ID.DETAIL_PAGE_URL", "PROPERTY_TRAINER_ID.PREVIEW_PICTURE", "DETAIL_PAGE_URL", "PROPERTY_STARTDATE", "PROPERTY_ENDDATE", "PROPERTY_CITY_ID.NAME", "PROPERTY_CITY_ID.IBLOCK_SECTION_ID", "PROPERTY_COURSE_ID.NAME", "PROPERTY_COURSE_ID.DETAIL_PAGE_URL", "PROPERTY_COURSE_ID.PROPERTY_HTML_DESC");
$arFilter = array("IBLOCK_ID" => 99, "ACTIVE" => "Y", "PROPERTY_CITY_ID" => array(34729,37594), '>PROPERTY_STARTDATE' => date('Y-m-d'));
$res = CIBlockElement::GetList(array("PROPERTY_CITY_ID" => "ASC", "PROPERTY_STARTDATE" => "ASC"), $arFilter, false, false, $arSelect);
while ($ob = $res->GetNextElement()) {
    $arResult["COURSES"][] = $ob->GetFields();
}
/*
  [ID] => 38069
            [~ID] => 38069
            [NAME] => --Temp Name--
            [~NAME] => --Temp Name--
            [DATE_ACTIVE_FROM] => 27.05.2013 15:16:45
            [~DATE_ACTIVE_FROM] => 27.05.2013 15:16:45
            [PREVIEW_TEXT] =>
            [~PREVIEW_TEXT] =>
            [PROPERTY_TRAINER_ID_NAME] => Carp
            [~PROPERTY_TRAINER_ID_NAME] => Carp
            [PROPERTY_TIME_VALUE] => 14:00 - 18:00
            [~PROPERTY_TIME_VALUE] => 14:00 - 18:00
            [PROPERTY_TIME_DESCRIPTION] =>
            [~PROPERTY_TIME_DESCRIPTION] =>
            [PROPERTY_TIME_VALUE_ID] => 38069:525
            [~PROPERTY_TIME_VALUE_ID] => 38069:525
            [PROPERTY_TRAINER_ID_PROPERTY_SHORT_NAME_VALUE] => Alexandru-Mihai
            [~PROPERTY_TRAINER_ID_PROPERTY_SHORT_NAME_VALUE] => Alexandru-Mihai
            [PROPERTY_TRAINER_ID_PROPERTY_SHORT_NAME_DESCRIPTION] =>
            [~PROPERTY_TRAINER_ID_PROPERTY_SHORT_NAME_DESCRIPTION] =>
            [PROPERTY_SHORT_NAME_TRAINER_ID_VALUE_ID] => 38147:512
            [~PROPERTY_SHORT_NAME_TRAINER_ID_VALUE_ID] => 38147:512
            [PROPERTY_TRAINER_ID_DETAIL_PAGE_URL] => /trainers/carp/
            [~PROPERTY_TRAINER_ID_DETAIL_PAGE_URL] => /trainers/carp/
            [PROPERTY_TRAINER_ID_PREVIEW_PICTURE] => 5681
            [~PROPERTY_TRAINER_ID_PREVIEW_PICTURE] => 5681
            [DETAIL_PAGE_URL] => /ennews/detail.php?ID=38069
            [~DETAIL_PAGE_URL] => /ennews/detail.php?ID=38069
            [PROPERTY_STARTDATE_VALUE] => 23.06.2015 14:00:00
            [~PROPERTY_STARTDATE_VALUE] => 23.06.2015 14:00:00
            [PROPERTY_STARTDATE_DESCRIPTION] =>
            [~PROPERTY_STARTDATE_DESCRIPTION] =>
            [PROPERTY_STARTDATE_VALUE_ID] => 38069:527
            [~PROPERTY_STARTDATE_VALUE_ID] => 38069:527
            [PROPERTY_CITY_ID_NAME] => Bucharest
            [~PROPERTY_CITY_ID_NAME] => Bucharest
            [PROPERTY_CITY_ID_IBLOCK_SECTION_ID] => 540
            [~PROPERTY_CITY_ID_IBLOCK_SECTION_ID] => 540
            [PROPERTY_COURSE_ID_NAME] => Linux Essentials
            [~PROPERTY_COURSE_ID_NAME] => Linux Essentials
            [PROPERTY_COURSE_ID_DETAIL_PAGE_URL] => /it-course/ADM-007/
            [~PROPERTY_COURSE_ID_DETAIL_PAGE_URL] => /it-course/ADM-007/
*/
?>
<span id="body_style" style="display:block; color: #2d2d2d; background: #fff;">
    <table class="course" style="background: #f5f5f5" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td style="">
                    <?$t = 0; $last_city = "Bucharest";?>
                    <table border="0" cellpadding="0" cellspacing="0" width="920" summary="" align="center">
                    <? foreach ($arResult["COURSES"] as $key => $arCourse) {?>
                        <? $res = CIBlockSection::GetByID($arCourse["PROPERTY_CITY_ID_IBLOCK_SECTION_ID"]);
                        if ($ar_res = $res->GetNext()) $country = $ar_res["NAME"]; ?>
                        <? if ($key == 0) { ?>
                        <tr>
                            <td style="padding: 0 15px;" class="emailContainer" valign="top">
                                <table border="0" cellpadding="0" cellspacing="0" style="width: 100%">
                                    <tr>
                                        <td style="width: 249px; height: 80px; background: #426192; text-align: center; vertical-align: middle; font-size: 20px;">
                                            <a style="display: block; color: #fff; text-decoration: none; font-family: tahoma, geneva, sans-serif;" href="https://www.luxoft-training.com/schedule/">Course <b>Schedule</b></a>
                                        </td>
                                        <td style="background: #fff; text-align: right; font-size: 16px; color: #426192; font-weight: bold; padding-right: 28px; font-family: tahoma, geneva, sans-serif;">
                                            <img src="https://www.luxoft-training.com/images/digest2018/icon-location.jpg"/>&nbsp;&nbsp;&nbsp;&nbsp;ROMANIA, BUCHAREST
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr><td class="whitespace" height="45">&nbsp;</td></tr>
                        <? } ?>
                        <? if ($last_city != $arCourse["PROPERTY_CITY_ID_NAME"]) { ?>
                            <tr><td class="whitespace" height="40">&nbsp;</td></tr>
                            <tr>
                              <td style="padding: 0 15px;" class="emailContainer" valign="top">
                                <table border="0" cellpadding="0" cellspacing="0" style="width: 100%">
                                    <tr>
                                        <td style="width: 249px; height: 80px; background: #426192; text-align: center; vertical-align: middle; font-size: 20px;"><a
                                                    style="display: block; color: #fff; text-decoration: none; font-family: tahoma, geneva, sans-serif;"
                                                    href="https://www.luxoft-training.com/schedule/">Course <b>Schedule</b></a></td>
                                        <td style="background: #fff; text-align: right; font-size: 16px; color: #426192; font-weight: bold; padding-right: 28px; text-transform: uppercase;"><img
                                                    src="https://www.luxoft-training.com/images/digest2018/icon-location.jpg"/>&nbsp;&nbsp;&nbsp;&nbsp;<?= $country ?>, <?= $arCourse["PROPERTY_CITY_ID_NAME"] ?></td>
                                    </tr>
                                </table>
                              </td>
                            </tr>
                            <tr><td class="whitespace" height="45">&nbsp;</td></tr>
                            <? $last_city = $arCourse["PROPERTY_CITY_ID_NAME"]; ?>
                        <? } ?>
                        <tr>
                            <td style="padding: 0 15px;">
                                <table border="0" cellpadding="0" cellspacing="0" style="width: 100%">
                                    <tr>
                                        <td style="background: #fff; border-bottom: 1px solid #f4f4f4; height: 84px; padding-left: 36px; border-left: 3px solid #426192; vertical-align: middle; width: 400px; padding-right: 15px;"><a style="font-size: 16px; color: #426192; text-decoration: none; font-family: tahoma, geneva, sans-serif;" href="http://www.luxoft-training.com<?= $arCourse["PROPERTY_COURSE_ID_DETAIL_PAGE_URL"] ?>"><?= $arCourse["PROPERTY_COURSE_ID_NAME"] ?></a></td>
                                        <td style="background: #fff; background: #fff; border-bottom: 1px solid #f4f4f4; padding-right: 15px;  width: 100px;">
                                            <table border="0" cellpadding="0" cellspacing="0" style="width: 100%">
                                                <tr>
                                                    <td style="padding-right: 12px; width: 16px; font-family: tahoma, geneva, sans-serif;"><img src="https://www.luxoft-training.com/images/digest2018/date.jpg"/></td>
                                                    <td style="font-size: 14px; color: #426192; font-family: tahoma, geneva, sans-serif;"><? if (strlen($arCourse["PROPERTY_ENDDATE_VALUE"]) > 0) { ?>
                                                        <?= date("j", strtotime($arCourse["PROPERTY_STARTDATE_VALUE"])) ?>-<?= date("j M", strtotime($arCourse["PROPERTY_ENDDATE_VALUE"])) ?></td>
                                                    <? } else { ?>
                                                    <?= date("j M", strtotime($arCourse["PROPERTY_STARTDATE_VALUE"])) ?>
                                                    <? } ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="background: #fff; background: #fff; border-bottom: 1px solid #f4f4f4; text-align: right; padding: 10px;">
                                            <table border="0" cellpadding="0" cellspacing="0" style="width: 100%">
                                                <td style="padding-right: 12px; width: 15px;"><img src="https://www.luxoft-training.com/images/digest2018/time.jpg"/></td>
                                                <td style="font-size: 14px; color: #426192; font-family: tahoma, geneva, sans-serif; text-align: left;"><?= $arCourse["PROPERTY_TIME_VALUE"] ?></td>
                                            </table>
                                        </td>
                                        <td style="background: #fff;font-size: 14px; color: #426192; font-family: tahoma, geneva, sans-serif; padding: 10px;">
                                            <?= $arCourse["PROPERTY_DURATION_VALUE"] ?> h.
                                        </td>
                                        <td style="background: #fff; font-size: 14px; color: #426192; font-family: tahoma, geneva, sans-serif; padding-right: 36px;">
                                            <?= intval($arCourse["CATALOG_PRICE_1"]) ?> Euro
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr><td class="whitespace" height="10">&nbsp;</td></tr>
                    <? } ?>
                    </table>
                <td>
            </tr>
    </table>
</span>
<?
$SUBSCRIBE_TEMPLATE_RESULT = true;
if ($SUBSCRIBE_TEMPLATE_RESULT) {
    return array(
        "SUBJECT" => $SUBSCRIBE_TEMPLATE_RUBRIC["NAME"],
        "BODY_TYPE" => "html",
        "CHARSET" => "Windows-1251",
        "DIRECT_SEND" => "Y",
        "FROM_FIELD" => $SUBSCRIBE_TEMPLATE_RUBRIC["FROM_FIELD"]
    );
} else {
    return false;
}
?>