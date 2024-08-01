    <?
    if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
        die();
    }

    function getLevel($value){
        switch ($value) {
            case 'Junior':
                return "level--junior";
            case 'Middle':
                return "level--middle";
            case 'Senior':
                return "level--senior";
        }
    }
    function getLevels($arCourse){
        $result = "";
        foreach (array_values($arCourse['PROPERTY_COMPLEXITY_VALUE']) as $key=> $value) {
            $result .= getLevel($value)." ";
        }

        return $result;
    }

    function plural_form($number, $after) {
        $cases = array(2, 0, 1, 1, 1, 2);
        echo $number . ' ' . $after[($number % 100 > 4 && $number % 100 < 20) ? 2 : $cases[min($number % 10, 5)]];
    } ?>

<div class="main-catalog">
    <ul>
        <?
        $bFlagIsCourse = false;
        $bPreviousIsCourse = false;
        $previousLevel = 0;
        $vTotalPrice = 0;
        $vTotalPriceUA = 0;
        $vTotalDuration = 0;
        $bClassPrevious = "";
        foreach ($arResult["ITEMS"] as $key => $arSection):
        if ($arSection["IS_PARENT"] == "Y") {
        if(empty($arSection["ELEMENT_CNT"])) continue;
        if ($key != 0) { ?>
<!--</div>-->
<!--    </li>-->
        <?}?>
<li>
    <a class="icon-click" href="#"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
    <a class="catalog-section" href="<?= $arSection["DETAIL_PAGE_URL"] ?>"><?= $arSection["NAME"] ?></a>
    <span><?=plural_form($arSection["ELEMENT_CNT"], array("курс", "курса", "курсов"))?></span>
    <div class="course-items-list">
    <? } ?>
        <? if ($arSection["IS_COURSE"] == "Y") { ?>
            <div class="course-item">
                <div class="course-code">
                    <i class="code"><?= $arSection["PROPERTY_PP_COURSE_CODE"] ?></i>
                    <? if ($arSection["PARAM"]["PROPERTY_NEW_ICON_VALUE"] == "Да") { ?>
                        <i class="icon newone">new</i>
                    <? } ?>
                    <?if( isset($arSection["PARAM"]['PROPERTY_COMPLEXITY_VALUE']) ){
                        if(is_array($arSection["PARAM"]['PROPERTY_COMPLEXITY_VALUE'])) {
                            foreach (array_values($arSection["PARAM"]['PROPERTY_COMPLEXITY_VALUE']) as $key=> $value) {?>
                                <i class="icon level <?=getLevel($value)?>"><?=$value?></i>
                                <?unset($key,$value);}
                        } else {?>
                            <i class="icon level <?=getLevel($arSection["PARAM"]['PROPERTY_COMPLEXITY_VALUE'])?>"><?=$arSection["PARAM"]['PROPERTY_COMPLEXITY_VALUE']?></i>
                        <?}
                    }?>
                </div>
                <div class="course-content">
                    <div class="course-heading">
                        <div class="course-name"><a href="<?
                            if (strlen($arSection["PARAM"]['PROPERTY_CHANGE_LINK_VALUE']) > 0) { ?>
                                <?= $arSection["PARAM"]['PROPERTY_CHANGE_LINK_VALUE'] ?>
                            <? } else { ?>/kurs/<?= $arSection['PROPERTY_PP_COURSE_XML_ID'] ?>.html<?} ?>"><?= $arSection["PROPERTY_PP_COURSE_NAME"] ?></a><?
                            if ($arSection["PARAM"]["PROPERTY_ICON_SALE_VALUE"] == "yes") { ?>&nbsp;<i
                                    class="icon new-year"><a href="<?=$arSection["PARAM"]["PROPERTY_ICON_SALE_LINK_VALUE"]?>" target="_blank"><b>%</b>Акция</a></i><?
                            } ?></div>
                        <div class="course-duration"><span><?
                                plural_form(
                                    $arSection["PARAM"]["PROPERTY_COURSE_DURATION_VALUE"],
                                    array("час", "часа", "часов")
                                ) ?></span></div>
                    </div>
                    <div class="course-description">
                        <?= $arSection['PARAM']["PROPERTY_SHORT_DESCR_VALUE"] ?>
                    </div>
                </div>
            </div>
        <?
        } ?>
        <?
        endforeach ?>
        <?
        if ($previousLevel > 1)://close last item tags?>
            <?= str_repeat("</ul></li>", ($previousLevel - 1)); ?>
        <?
        endif ?>
        </ul>
</li>
</ul>
</div>
