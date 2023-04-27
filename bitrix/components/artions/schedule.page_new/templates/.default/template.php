<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>
<?
/*
 * Array
(
    [ID] => 37507
    [~ID] => 37507
    [CODE] =>
    [~CODE] =>
    [NAME] => --Temp Name--
    [~NAME] => --Temp Name--
    [SORT] => 500
    [~SORT] => 500
    [CATALOG_PRICE_ID_1] => 1769
    [~CATALOG_PRICE_ID_1] => 1769
    [CATALOG_GROUP_ID_1] => 1
    [~CATALOG_GROUP_ID_1] => 1
    [CATALOG_PRICE_1] => 1.00
    [~CATALOG_PRICE_1] => 1.00
    [CATALOG_CURRENCY_1] => EUR
    [~CATALOG_CURRENCY_1] => EUR
    [CATALOG_QUANTITY_FROM_1] =>
    [~CATALOG_QUANTITY_FROM_1] =>
    [CATALOG_QUANTITY_TO_1] =>
    [~CATALOG_QUANTITY_TO_1] =>
    [CATALOG_GROUP_NAME_1] => BASE
    [~CATALOG_GROUP_NAME_1] => BASE
    [CATALOG_CAN_ACCESS_1] => Y
    [~CATALOG_CAN_ACCESS_1] => Y
    [CATALOG_CAN_BUY_1] => Y
    [~CATALOG_CAN_BUY_1] => Y
    [CATALOG_EXTRA_ID_1] =>
    [~CATALOG_EXTRA_ID_1] =>
    [CATALOG_QUANTITY] => 0
    [~CATALOG_QUANTITY] => 0
    [CATALOG_QUANTITY_TRACE] => N
    [~CATALOG_QUANTITY_TRACE] => N
    [CATALOG_QUANTITY_TRACE_ORIG] => D
    [~CATALOG_QUANTITY_TRACE_ORIG] => D
    [CATALOG_CAN_BUY_ZERO] => N
    [~CATALOG_CAN_BUY_ZERO] => N
    [CATALOG_NEGATIVE_AMOUNT_TRACE] => N
    [~CATALOG_NEGATIVE_AMOUNT_TRACE] => N
    [CATALOG_WEIGHT] => 0
    [~CATALOG_WEIGHT] => 0
    [CATALOG_VAT] =>
    [~CATALOG_VAT] =>
    [CATALOG_VAT_INCLUDED] => N
    [~CATALOG_VAT_INCLUDED] => N
    [CATALOG_PRICE_TYPE] => S
    [~CATALOG_PRICE_TYPE] => S
    [CATALOG_RECUR_SCHEME_TYPE] => D
    [~CATALOG_RECUR_SCHEME_TYPE] => D
    [CATALOG_RECUR_SCHEME_LENGTH] => 0
    [~CATALOG_RECUR_SCHEME_LENGTH] => 0
    [CATALOG_TRIAL_PRICE_ID] =>
    [~CATALOG_TRIAL_PRICE_ID] =>
    [CATALOG_WITHOUT_ORDER] => N
    [~CATALOG_WITHOUT_ORDER] => N
    [CATALOG_SELECT_BEST_PRICE] => Y
    [~CATALOG_SELECT_BEST_PRICE] => Y
    [COURSE_ID_NAME] => C Programming Training
    [COURSE_ID_CODE] => C-002
    [COURSE_ID_ID] => 35046
    [COURSE_ID_DETAIL_PAGE_URL] => /it-course/C-002/
    [DURATION] => 12
    [CITY_ID_ID] => 34729
    [CITY_ID_NAME] => Budapest
    [CITY_ID_CODE] => budapest
    [CITY_ID_IBLOCK_SECTION_ID] => 540
    [TIME] => 09:30-13:30
    [TRAINER_ID] =>
    [TRAINER_ID_ID] =>
    [TRAINER_ID_NAME] =>
    [TRAINER_ID_SHORT_NAME] =>
    [TRAINER_ID_SHORT_DESC] =>
    [TRAINER_ID_DETAIL_PAGE_URL] =>
    [TRAINER_SIMPLE] => Dumitru Ceara
    [STARTDATE] => 04/16/2013 09:30:00
    [ENDDATE] => 04/18/2013 13:30:00
    [EDIT_LINK] => /bitrix/admin/iblock_element_edit.php?IBLOCK_ID=99&type=ennews&ID=37507&lang=en&force_catalog=&bxpublic=Y&from_module=iblock&return_url=%2Fschedule%2Findex.php%3Fclear_cache_session%3DY
    [DELETE_LINK] => /bitrix/admin/iblock_list_admin.php?IBLOCK_ID=99&type=ennews&lang=en&action=delete&ID=E37507&return_url=%2Fschedule%2Findex.php%3Fclear_cache_session%3DY
    [COUNTRY] => Array
        (
            [COUNTRY_NAME] => Romania
            [COUNTRY_CODE] => romania
            [CITIES] => Array
                (
                    [budapest] => Array
                        (
                            [CITY_NAME] => Budapest
                            [CITY_CODE] => budapest
                        )

                )

        )

    [FULL_DATES] => Apr 16, 2013 - Apr 18, 2013
)
 *
 */?>

<?if (($arResult['TOTAL_COUNT'])>0){?>
    <ul class="nav nav-tabs">
    <? $index = 0;  ?>
    <?foreach($arResult['LOCATIONS'] as $CountryName => $arValue){?>
        <?$index =  $index + 1;?>
        <li<?if ($index == 1){?> class="active"<? } ?>><a href="#<?=$arValue['COUNTRY_CODE']?>" data-toggle="tab"><?=$arValue['COUNTRY_NAME']?></a></li>
    <? } ?>
    </ul>
    <div class="tab-content">
        <? $index = 0;  ?>
        <?foreach($arResult['LOCATIONS'] as $CountryName => $arValue){?>

        <? $index =  $index + 1; ?>
        <div class="tab-pane <?if ($index == 1){?>active<? } ?>" id="<?=$arValue['COUNTRY_CODE']?>">

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Code</th>
                    <th class="yellow">Course Name</th>
                    <th class="green">Date</th>
                    <th class="green">Duration</th>
                    <th class="green">Price</th>
                    <th class="green"></th>
                </tr>
                </thead>
                <tbody>


                <?foreach($arValue['CITIES'] as $cityCode => $arCity){?>
                    <?foreach($arResult['ITEMS'][$arCity['CITY_CODE']] as $arCourse){?>
                    <? $arCourse["CATALOG_PRICE_1"] = str_replace(".00", "", $arCourse["CATALOG_PRICE_1"]); ?>
                    <tr>
                        <td><span class="nowrap"><?=$arCourse["COURSE_ID_CODE"]?></span></td>
                        <td><a class="non-break" href="<?=$arCourse["COURSE_ID_DETAIL_PAGE_URL"]?>"><?=$arCourse["COURSE_ID_NAME"]?>&nbsp;<i class="blue icon-chevron-right"></i></a><br />
                            <?if ($arCourse["TRAINER_SIMPLE"] || $arCourse["TRAINER_ID_NAME"]){?>
                                with
                                <?if ($arCourse["TRAINER_SIMPLE"]){?>
                                    <?=$arCourse["TRAINER_SIMPLE"]?>
                                <?} else {?>
                                    <a href="<?=$arCourse["TRAINER_ID_DETAIL_PAGE_URL"]?>"><?=$arCourse["TRAINER_ID_NAME"]?> <?=$arCourse["TRAINER_ID_SHORT_NAME"]?></a>
                                <? } ?>
                            <? } ?>
                        </td>
                        <td><?=$arCourse["FULL_DATES"]?>, <?=$arCourse["CITY_ID_NAME"]?>
                            </td>
                        <td><?=$arCourse["DURATION"]?> h.</td>


                        <td><?if($arCourse["CATALOG_PRICE_1"]  !== "1"){?> <?=$arCourse["CATALOG_PRICE_1"]?> <?=$arCourse["CATALOG_CURRENCY_1"]?>  <? } ?></td>
                        <td><a class="btn btn-success nowrap"  href="<?=$arCourse["COURSE_ID_DETAIL_PAGE_URL"]?>#enroll">Sign up</a></td>
                    </tr>
                    <? } ?>
                <? } ?>
                </tbody>
            </table>
        </div>
        <? } ?>
    </div>
<? } ?>
<?if (($arResult['TOTAL_COUNT']) == 0){?>
<h4>In the near future courses are not planned</h4>
<? } ?>
