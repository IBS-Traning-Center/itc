<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/**
 * @var $arResult;
 */
function plural_form($number, $after) {
    $cases = array (2, 0, 1, 1, 1, 2);
    echo $number.' '.$after[ ($number%100>4 && $number%100<20)? 2: $cases[min($number%10, 5)] ];
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
}?>
<?if(count($arResult['complexity']) > 1) {?>
<div class="main-filter-container">
    <h2>Выберите уровень</h2>
    <div class="main-filter">
        <a class="title dropdown-link" href="#">Все<i class="fa fa-caret-down" aria-hidden="true"></i></a>
        <ul class="dropdown">
            <li class="filter-item"><a href="javascript:void()">Все</a></li>
            <? if(in_array('Junior', $arResult['complexity'])) {?>
                <li class="filter-item"><a href="javascript:void()">Junior</a></li>
            <?}?>
            <? if(in_array('Middle', $arResult['complexity'])) {?>
                <li class="filter-item"><a href="javascript:void()">Middle</a></li>
            <?}?>
            <? if(in_array('Senior', $arResult['complexity'])) {?>
                <li class="filter-item"><a href="javascript:void()">Senior</a></li>
            <?}?>
        </ul>
    </div>
</div>
<?}?>
<div class="main-catalog main-catalog_inner">
    <?if($arResult['SECTIONS']) {?>
    <ul class="section-items-list">
        <?foreach ($arResult['SECTIONS'] as $section) {
            if(!$section['QUANTITY_ELEMENTS']) continue;?>
            <li class="section-item section-item--inverted open">
                <a class="section-click section-click--inverted uncover" href="javascript:void(0)" rel="nofollow"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                <a class="section-name section-name--inverted" href="<?=$section["DETAIL_PAGE_URL"]?>"><?=$section['NAME']?></a>
                <span class="section-course-count section-course-count--inverted"><?plural_form($section['QUANTITY_ELEMENTS'], array("курс", "курса", "курсов"))?></span>
                <?if($section['SECTIONS']) {?>
                    <ul class="section-items-list">
                        <?foreach ($section['SECTIONS'] as $section2) {
                            if(!$section2['QUANTITY_ELEMENTS']) continue;?>
                            <li class="section-item section-item-- inverted <?if($section2['DEPTH_LEVEL'] > 2) {?>open<?}?>">
                                <a class="section-click section-click--inverted <?if($section2['DEPTH_LEVEL'] > 2) {?>uncover<?}?>" href="#"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                <a class="section-name section-name--inverted" href="<?=$section2["DETAIL_PAGE_URL"]?>"><?=$section2['NAME']?></a>
                                <span class="section-course-count section-course-count--inverted"><?plural_form($section2['QUANTITY_ELEMENTS'], array("курс", "курса", "курсов"))?></span>
                                <?if($section2['SECTIONS']) {?>
                                    <ul class="section-items-list  <?if(!($section2['DEPTH_LEVEL'] > 2)) {?>hidden<?}?>">
                                        <?foreach ($section2['SECTIONS'] as $section3) {
                                            if(!$section3['QUANTITY_ELEMENTS']) continue;?>
                                            <li class="section-item section-item-- inverted <?if($section3['DEPTH_LEVEL'] > 2) {?>open<?}?>">
                                                <a class="section-click section-click--inverted <?if($section3['DEPTH_LEVEL'] > 2) {?>uncover<?}?>" href="#"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                <a class="section-name section-name--inverted" href="<?=$section3["DETAIL_PAGE_URL"]?>"><?=$section3['NAME']?></a>
                                                <span class="section-course-count section-course-count--inverted"><?plural_form($section3['QUANTITY_ELEMENTS'], array("курс", "курса", "курсов"))?></span>
                                                <?if($section3['ELEMENTS']) {?>
                                                    <div class="courses-list <?if(!($section3['DEPTH_LEVEL'] > 2)) {?>hidden<?}?>">
                                                        <?foreach ($section3['ELEMENTS'] as $element) {?>
                                                            <div class="course-item" data-level="<?=getLevels($element)?>" data-id="<?=$element['ID']?>">
                                                                <div class="course-code" data-active="<?=$element['ACTIVE']?>">
                                                                    <i class="code"><?=$element["PROPERTY_PP_COURSE_CODE"]?></i>
                                                                    <? if($element["PROPERTY_NEW_ICON_VALUE"] == "Да"){ ?>
                                                                        <i class="icon newone">new</i>
                                                                    <?}?>
                                                                    <?if( isset($element['PROPERTY_COMPLEXITY_VALUE']) ){
                                                                        if(is_array($element['PROPERTY_COMPLEXITY_VALUE'])) {
                                                                            foreach (array_values($element['PROPERTY_COMPLEXITY_VALUE']) as $key=> $value) {?>
                                                                                <i class="icon level <?=getLevel($value)?>"><?=$value?></i>
                                                                                <?unset($key,$value);}
                                                                        } else {?>
                                                                            <i class="icon level <?=getLevel($element['PROPERTY_COMPLEXITY_VALUE'])?>"><?=$element['PROPERTY_COMPLEXITY_VALUE']?></i>
                                                                        <?}
                                                                    }?>
                                                                </div>
                                                                <div class="course-content">
                                                                    <div class="course-heading" data-id="<?=$element['ID']?>">
                                                                        <div class="course-name"><a href="<?if (strlen($element['PROPERTY_CHANGE_LINK_VALUE'])>0) {?><?=$element['PROPERTY_CHANGE_LINK_VALUE']?><?} else{?>/kurs/<?=$element['PROPERTY_PP_COURSE_XML_ID']?>.html<?}?>"><?=$element["PROPERTY_PP_COURSE_NAME"]?></a></div>
                                                                        <div class="course-duration"><span><?plural_form($element["PROPERTY_COURSE_DURATION_VALUE"], array("час", "часа", "часов"))?></span></div>
                                                                    </div>
                                                                    <div class="course-description">
                                                                        <?=$element["PROPERTY_SHORT_DESCR_VALUE"]?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?}?>
                                                    </div>
                                                <?}?>
                                            </li>
                                            <?unset($section3);}?>
                                    </ul>
                                <?}?>

                                <?if($section2['ELEMENTS']) {?>
                                    <div class="courses-list <?if(!($section2['DEPTH_LEVEL'] > 2)) {?>hidden<?}?>">
                                        <?foreach ($section2['ELEMENTS'] as $element) {?>
                                            <div class="course-item" data-level="<?=getLevels($element)?>" data-id="<?=$element['ID']?>">
                                                <div class="course-code" data-active="<?=$element['ACTIVE']?>">
                                                    <i class="code"><?=$element["PROPERTY_PP_COURSE_CODE"]?></i>
                                                    <? if($element["PROPERTY_NEW_ICON_VALUE"] == "Да"){ ?>
                                                        <i class="icon newone">new</i>
                                                    <?}?>
                                                    <?if( isset($element['PROPERTY_COMPLEXITY_VALUE']) ){
                                                        if(is_array($element['PROPERTY_COMPLEXITY_VALUE'])) {
                                                            foreach (array_values($element['PROPERTY_COMPLEXITY_VALUE']) as $key=> $value) {?>
                                                                <i class="icon level <?=getLevel($value)?>"><?=$value?></i>
                                                                <?unset($key,$value);}
                                                        } else {?>
                                                            <i class="icon level <?=getLevel($element['PROPERTY_COMPLEXITY_VALUE'])?>"><?=$element['PROPERTY_COMPLEXITY_VALUE']?></i>
                                                        <?}
                                                    }?>
                                                </div>
                                                <div class="course-content">
                                                    <div class="course-heading" data-id="<?=$element['ID']?>">
                                                        <div class="course-name"><a href="<?if (strlen($element['PROPERTY_CHANGE_LINK_VALUE'])>0) {?><?=$element['PROPERTY_CHANGE_LINK_VALUE']?><?} else{?>/kurs/<?=$element['PROPERTY_PP_COURSE_XML_ID']?>.html<?}?>"><?=$element["PROPERTY_PP_COURSE_NAME"]?></a></div>
                                                        <div class="course-duration"><span><?plural_form($element["PROPERTY_COURSE_DURATION_VALUE"], array("час", "часа", "часов"))?></span></div>
                                                    </div>
                                                    <div class="course-description">
                                                        <?=$element["PROPERTY_SHORT_DESCR_VALUE"]?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?unset($element);}?>
                                    </div>
                                <?}?>
                            </li>
                            <?unset($section2);}?>
                    </ul>
                <?}?>
                <?if($section['ELEMENTS']) {?>
                    <div class="courses-list <?if(!($section2['DEPTH_LEVEL'] > 2)) {?>hidden<?}?>">
                        <?foreach ($section['ELEMENTS'] as $element) {?>
                            <div class="course-item course-item--without-bottom-border" data-level="<?=getLevels($element)?>">
                                <div class="course-code">
                                    <i class="code"><?=$element["PROPERTY_PP_COURSE_CODE"]?></i>
                                    <? if($element["PROPERTY_NEW_ICON_VALUE"] == "Да"){ ?>
                                        <i class="icon newone">new</i>
                                    <?}?>
                                    <?if( isset($element['PROPERTY_COMPLEXITY_VALUE']) ){
                                        if(is_array($element['PROPERTY_COMPLEXITY_VALUE'])) {
                                            foreach (array_values($element['PROPERTY_COMPLEXITY_VALUE']) as $key=> $value) {?>
                                                <i class="icon level <?=getLevel($value)?>"><?=$value?></i>
                                                <?unset($key,$value);}
                                        } else {?>
                                            <i class="icon level <?=getLevel($element['PROPERTY_COMPLEXITY_VALUE'])?>"><?=$element['PROPERTY_COMPLEXITY_VALUE']?></i>
                                        <?}
                                    }?>
                                </div>
                                <div class="course-content">
                                    <div class="course-heading">
                                        <div class="course-name"><a href="<?if (strlen($element['PROPERTY_CHANGE_LINK_VALUE'])>0) {?><?=$element['PROPERTY_CHANGE_LINK_VALUE']?><?} else{?>/kurs/<?=$element['PROPERTY_PP_COURSE_XML_ID']?>.html<?}?>"><?=$element["PROPERTY_PP_COURSE_NAME"]?></a></div>
                                        <div class="course-duration"><span><?plural_form($element["PROPERTY_COURSE_DURATION_VALUE"], array("час", "часа", "часов"))?></span></div>
                                    </div>
                                    <div class="course-description">
                                        <?=$element["PROPERTY_SHORT_DESCR_VALUE"]?>
                                    </div>
                                </div>
                            </div>
                        <?}?>
                    </div>
                <?}?>
            </li>
        <?}?>
    </ul>
    <?}?>
    <?if($arResult['ELEMENTS']) {?>
        <div class="courses-list">
            <?foreach ($arResult['ELEMENTS'] as $element) {?>
                <div class="course-item course-item--without-bottom-border" data-level="<?=getLevels($element)?>">
                    <div class="course-code">
                        <i class="code"><?=$element["PROPERTY_PP_COURSE_CODE"]?></i>
                        <? if($element["PROPERTY_NEW_ICON_VALUE"] == "Да"){ ?>
                            <i class="icon newone">new</i>
                        <?}?>
                        <?if( isset($element['PROPERTY_COMPLEXITY_VALUE']) ){
                            if(is_array($element['PROPERTY_COMPLEXITY_VALUE'])) {
                                foreach (array_values($element['PROPERTY_COMPLEXITY_VALUE']) as $key=> $value) {?>
                                    <i class="icon level <?=getLevel($value)?>"><?=$value?></i>
                                    <?unset($key,$value);}
                            } else {?>
                                <i class="icon level <?=getLevel($element['PROPERTY_COMPLEXITY_VALUE'])?>"><?=$element['PROPERTY_COMPLEXITY_VALUE']?></i>
                            <?}
                        }?>
                    </div>
                    <div class="course-content">
                        <div class="course-heading">
                            <div class="course-name"><a href="<?if (strlen($element['PROPERTY_CHANGE_LINK_VALUE'])>0) {?><?=$element['PROPERTY_CHANGE_LINK_VALUE']?><?} else{?>/kurs/<?=$element['PROPERTY_PP_COURSE_XML_ID']?>.html<?}?>"><?=$element["PROPERTY_PP_COURSE_NAME"]?></a></div>
                            <div class="course-duration"><span><?plural_form($element["PROPERTY_COURSE_DURATION_VALUE"], array("час", "часа", "часов"))?></span></div>
                        </div>
                        <div class="course-description">
                            <?=$element["PROPERTY_SHORT_DESCR_VALUE"]?>
                        </div>
                    </div>
                </div>
            <?}?>
        </div>
    <?}?>
</div>
