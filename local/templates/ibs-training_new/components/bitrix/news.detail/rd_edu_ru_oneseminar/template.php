<?php

if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)
{
    die();
}

use Local\Util\Functions;
$APPLICATION->SetTitle($arResult['EVENT']['TYPE'].": ".$arResult['NAME']);
$APPLICATION->SetPageProperty('title', $arResult['NAME']);
$APPLICATION->SetPageProperty('blue_title', $arResult['NAME']);

$curDate = date("d.m.Y");
$startdateGlobal = $arResult['START_DATE'];
$result = $DB->CompareDates($curDate, $startdateGlobal);

if (($result == 0) || ($result == -1)) {
    $glFlagShowForm = true;
}else{
    $glFlagShowForm = false;
}?>

<div class='seminar'>
    <div class='top-page-banner' style='background-color: <?= $APPLICATION->GetPageProperty('BACKGROUND_COLOR_BANNER') ?>'>
        <div class='container'>
            <div class='banner-content'>
                <?php $APPLICATION->IncludeComponent(
                        'bitrix:breadcrumb',
                        'bread',
                        [
                            'START_FROM' => '0',
                            'PATH' => '',
                            'SITE_ID' => 's1',
                        ],
                        false
                ); ?>
                <h1><?= $APPLICATION->GetPageProperty('title') ?></h1>
                <?php if ($arResult['PROPERTIES']['AUDIENCE']['VALUE']){?>
                    <div class='seminar__audience-wrap'>
                        <?php foreach($arResult['PROPERTIES']['AUDIENCE']['VALUE'] as $value){?>
                            <div class='seminar__audience-item'><?= $value?></div>
                        <?php }?>
                    </div>
                <?php }?>
                <div class='seminar__header'>
                	<?php if($arResult['PROPERTIES']['type_event']['VALUE_ENUM_ID'] == 324) {?>
                        <div class='seminar__time-date-place'>
                		    <?php if(!empty($arResult['PROPERTIES']['startdate'])) {?>
                		    	<div class='seminar__date'><b>
                                    Доступ открыт:</b> 
                                    <?=date('d.m.Y', strtotime($arResult['PROPERTIES']['startdate']['VALUE']))?>-<?= date('d.m.Y',strtotime($arResult['PROPERTIES']['enddate']['VALUE']))?>
                		    	</div>
                		    <?php }?>
                		    <div class='seminar__date'><b>Формат:</b> <?=$arResult['EVENT']['PLACE']?></div>
                		    <div class='seminar__place'><b>Язык:</b> <?=$arResult['PROPERTIES']['LAGUAGE']['VALUE']?></div>
                	    </div>
                	<?php } else {?>
                        <?php if($arResult['EVENT']['TIME-DATE-PLACE'] === 'Y') {?>
                            <div class='seminar__time-date-place'>
                                <?php if(!empty($arResult['EVENT']['TIME'])) {?>
                	        	    <div class='seminar__time'>
                                        <?=Functions::buildSVG('time', SITE_TEMPLATE_PATH. '/assets/images/icons')?>
                                        <b>Время:</b> 
                                        <?=$arResult['EVENT']['TIME']?>
                	        	    	<?php if($arResult['EVENT']['TYPE'] == 'Вебинар') {?> 
                	        	    		(мск.)
                	        	    	<?php }?>
                	        	    </div>
                                <?php }?>
                                <?php if(!empty($arResult['EVENT']['DATE'])) {?>
                            	    <div class='seminar__date'>
                                        <?=Functions::buildSVG('calender', SITE_TEMPLATE_PATH. '/assets/images/icons')?>
                                        <b>Дата проведения:</b>
                            		    <?=$arResult['EVENT']['DATE']?>
                                    </div>
                                <?php }?>
                                <?php if(!empty($arResult['EVENT']['PLACE'])) {?>
                            	    <div class='seminar__place'>
                                        <b>Место проведения:</b> 
                            	        <?=$arResult['EVENT']['PLACE']?>
                            	    </div>
                            	<?php }?>
                            </div>
                        <?php }?>
                    <?php }?>
                </div>
            </div>
            <div class='buttons-block-banner'>
                <div class='seminar__order-box'>
                    <div class="seminar__order-title"><?= $arResult['PROPERTIES']['type']['VALUE']?></div>
                    <? if($glFlagShowForm){?>
                        <a href='#register' class='seminar__order btn-main size-l'>Зарегистрироваться</a>
                    <?}else{?>
                        <span class='seminar__order-no btn-main size-l'>Регистрация окончена</span>
                    <?}?>
                </div>
            </div>
        </div>
    </div>
    <div class='container'>
        <?/*php if(!empty($arResult['EVENT']['BANNER'])) {?>
            <div class='seminar__banner'>
                <img class='seminar__banner-image' src='<?=$arResult['EVENT']['BANNER']?>' alt='<?=$arResult['EVENT']['NAME']?>'>
            </div>
        <?php }*/?>
        <div class='seminar__main'>
            <?php if(!empty($arResult['PREVIEW_TEXT'])) {?>
                <div class='seminar__section'>
                    <div class='seminar__section-title'>Организаторы:</div>
                    <div class='seminar__section-description'><?=$arResult['PREVIEW_TEXT']?></div>
                </div>
            <?php }?>
            <?php if(!empty($arResult['DETAIL_TEXT'])) {?>
                <div class='seminar__section'>
                    <div class='seminar__section-description'><?=$arResult['DETAIL_TEXT']?></div>
                </div>
            <?php }?>
            <?php if(!empty($arResult['EVENT']['DESCRIPTION']) || !empty($arResult['EVENT']['SHORT_DESCRIPTION'])) {?>
                <div class='seminar__section'>
                    <div class='seminar__section-title'>О чём курс:</div>
                    <?php if(!empty($arResult['EVENT']['DESCRIPTION'])) {?><div class='seminar__section-description'><?=$arResult['EVENT']['DESCRIPTION']?></div><?php }?>
                    <?php if(!empty($arResult['EVENT']['SHORT_DESCRIPTION'])) {?><div class='seminar__section-description'><?=$arResult['EVENT']['SHORT_DESCRIPTION']?></div><?php }?>
                </div>
            <?php }?>
            <?php if(!empty($arResult['EVENT']['CONTENT'])) {?>
                <div class='seminar__section'>
                    <div class='seminar__section-title'>Содержание:</div>
                    <div class='seminar__section-description'><?=$arResult['EVENT']['CONTENT']?></div>
                </div>
            <?php }?>
            <?php if ($arResult['PROPERTIES']['AUDIENCE']['VALUE']){?>
                <div class='seminar__section'>
                    <div class='seminar__section-title'>Для кого:</div>
                    <div class='seminar__audience-wrap'>
                        <?php foreach($arResult['PROPERTIES']['AUDIENCE']['VALUE'] as $value){?>
                            <div class='seminar__audience-item'><?= $value?></div>
                        <?php }?>
                    </div>
                </div>
            <?php }?>
            <?php if(empty($arResult['EVENT']['TRAINER']) && (strlen(trim($arResult['EVENT']['LECTURE'])) > 0)) {?>
                <div class='seminar__section'>
                    <div class='seminar__section-title'>Докладчик:</div>
                    <div class='seminar__section-description'><?=$arResult['EVENT']['LECTURE']?></div>
                </div>
            <?php }?>
            <?php if(!empty($arResult['EVENT']['TRAINER'])) {?>
                <div id='trainer' class='not-main-page'>
                    <div class='trainer-heading'>Тренер</div>
                    <div class='trainer-item'>
                        <div class='trainer-header'>
                            <div class='trainer-picture'>
                                <img src='<?=$arResult['EVENT']['TRAINER']['PHOTO']?>' alt='<?=$arResult['EVENT']['TRAINER']['NAME']?>'>
                            </div>
                            <div class='trainer-short-description'>
                                <a class='trainer-link' href='/about/experts/<?= $arResult['EVENT']['TRAINER']['CODE'] ?>.html' tabindex='0'><?=$arResult['EVENT']['TRAINER']['NAME']?></a>
                                <span><?=$arResult['EVENT']['TRAINER']['SHORT']?></span>
                            </div>
                        </div>
                        <div class='trainer-content'>
                            <div class='trainer-description-wrap'><?=$arResult['EVENT']['TRAINER']['DESCRIPTION']?></div>
                        </div>
                    </div>
                </div>
            <?php }?>
            <?php if(!empty($arResult['COURSE']['ADD_SOURCES']) || !empty($arResult['ADDITONAL']['LINKED'])){?>
                <div id='reccomend' class='bg not-main-page gray'>
                    <div class='frame'>
                        <?php if (count($arResult['ADDITONAL']['LINKED']) > 0) { ?>
                            <div class='reccomend-heading'>Связанные курсы:</div>
                            <div class='reccomend-list'>
                                <?php foreach ($arResult['ADDITONAL']['LINKED'] as $arLinkedCourses) { ?>
                                    <div class='reccomend-item'>
                                        <div class='row'>
                                            <div class='rec-code'><?= $arLinkedCourses['COURSE_CODE'] ?></div>
                                            <div class='reg-content'>
                                                <a href='/training/catalog/course.html?ID=<?= $arLinkedCourses['COURSE_ID'] ?>'><?= $arLinkedCourses['COURSE_NAME'] ?></a>
                                            </div>
                                            <?php if (strlen($arLinkedCourses['COURSE_DURATION']) > 0) {?>
                                                <div class='req-hours'>
                                                    <span class='hours'><?=$arLinkedCourses['COURSE_DURATION'] . ' ч.';?></span>
                                                </div>
                                            <?php }?>
                                        </div>
                                        <div class='row'>
                                            <div class='rec-code'></div>
                                            <div class='reg-content'>
                                                <div class='row'>
                                                    <?php $t = 0; ?>
                                                    <?php foreach ($arLinkedCourses['TIMETABLE'] as $arTimetable) {
                                                        if ($t < 4) { 
                                                            $vCourseDates = ''; 
                                                            $vCourseDates .= $arTimetable['TIMETABLE_STARTDATE'];
                                                            if (strlen($arTimetable['TIMETABLE_ENDDATE']) > 0) {
                                                                $vCourseDates .= '-' . $arTimetable['TIMETABLE_ENDDATE'];
                                                            } ?>
                                                            <div class='dates-reccomend'>
                                                                <?= $arTimetable['TIMETABLE_CITY_NAME'] ?>:<br>
                                                                <b><?= $vCourseDates ?></b>
                                                            </div>
                                                        <?php } 
                                                        $t++;
                                                    } ?>
                                                </div>
                                            </div>
                                            <div class='req-hours sw100p'>
                                                <a class='reg-link' href='/training/catalog/course.html?ID=<?= $arLinkedCourses['COURSE_ID'] ?>'>Записаться</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                        <div class='row course-main-info clearfix'>
                            <?php if ($arResult['COURSE']['ADD_SOURCES']) { ?>
                                <div class='small-2 padding-right'>
                                    <div class='descr-wrap margin-b-35'>
                                        <h3 id='reco'>Рекомендуемые дополнительные материалы, источники:</h3>
                                        <?= $arResult['COURSE']['ADD_SOURCES'];?>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if ($arResult['COURSE']['OTHER']) { ?>
                                <div class='small-2 <?php if ($arResult['COURSE']['ADD_SOURCES']) { ?>padding-left<?php } ?>'>
                                    <div class='desr-wrap margin-b-35'>
                                        <h3 id='primech'>Примечание:</h3>
                                        <?= $arResult['COURSE']['OTHER'];?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php }?>
        </div>
        <div class="seminar__left">
            <div class='seminar__order-box'>
                <?php if($arResult['EVENT']['TIME-DATE-PLACE'] === 'Y') {?>
                    <div class='seminar__time-date-place bottom'>
                        <?php if(!empty($arResult['EVENT']['TIME'])) {?>
                    	    <div class='seminar__time'>
                                <b>Время:</b><br>
                                <span><?=$arResult['EVENT']['TIME']?>
                    	    	<?php if($arResult['EVENT']['TYPE'] == 'Вебинар') {?> 
                    	    		(мск.)
                    	    	<?php }?></span>
                    	    </div>
                        <?php }?>
                        <?php if(!empty($arResult['EVENT']['DATE'])) {?>
                    	    <div class='seminar__date'>
                                <b>Дата проведения:</b><br>
                    		    <span><?=$arResult['EVENT']['DATE']?></span>
                            </div>
                        <?php }?>
                    </div>
                <?php }?>
                <div class="seminar__order-title"><?= $arResult['PROPERTIES']['type']['VALUE']?></div>
                <? if($glFlagShowForm){?>
                    <a href='#register' class='seminar__order btn-main size-l'>Зарегистрироваться</a>
                <?}else{?>
                    <span class='seminar__order-no btn-main size-l'>Регистрация окончена</span>
                <?}?>
            </div>
        </div>
    </div>
</div>