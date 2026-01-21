<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

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
}

?>

<div class="not-main-page gray" id="middle-content">
    <div class="frame no-top-padding">
        <div class="main-catalog main-catalog-single">
            <div class="course-items-list">
                <?foreach($arResult["ITEMS"] as $arSection):?>
                <div class="course-item">
                    <div class="course-code">
                        <?=$arSection['PROPERTY_PP_COURSE_CODE']?>
                        <? if($arResult['PROPERTIES']['NEW_ICON']['VALUE'] == "Да"){ ?>
                            <i class="icon newone">new</i>
                        <?}?><?if( isset($arSection["PARAM"]['PROPERTY_COMPLEXITY_VALUE']) ){
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
                            <div class="course-name"><a href="<?if (strlen($arSection["PARAM"]['PROPERTY_CHANGE_LINK_VALUE'])>0) {?><?=$arSection["PARAM"]['PROPERTY_CHANGE_LINK_VALUE']?><?} else{?>/training/catalog/course.html?ID=<?=$arSection['PROPERTY_PP_COURSE_VALUE']?><?}?>"><?=$arSection['PROPERTY_PP_COURSE_NAME']?></a><? if($arSection["PARAM"]["PROPERTY_ICON_SALE_VALUE"] == "yes"){ ?>&nbsp;<i class="icon new-year"><a href="<?=$arSection["PARAM"]["PROPERTY_ICON_SALE_LINK_VALUE"]?>" target="_blank"><b>%</b>Акция</a></i><?}?></div>
                            <div class="course-duration"><span><?=$arSection['PARAM']['PROPERTY_COURSE_DURATION_VALUE']?> ч.</span></div>
                        </div>
                        <div class="course-description">
                        <?=$arSection['PARAM']["PROPERTY_SHORT_DESCR_VALUE"]?>
                        </div>
                    </div>
                </div>
                <?endforeach;?>
            </div>
        </div>
    </div>
</div>
