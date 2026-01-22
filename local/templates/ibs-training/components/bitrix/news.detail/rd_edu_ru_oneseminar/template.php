<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$APPLICATION->SetTitle($arResult['EVENT']['TYPE'].": ".$arResult["NAME"]);
$APPLICATION->SetPageProperty("title", $arResult['EVENT']['TYPE'].": ".$arResult["NAME"]);
$APPLICATION->SetPageProperty("blue_title", $arResult["NAME"]);?>
        <div class="seminar">
            <?if(!empty($arResult['EVENT']['BANNER'])) {?>
                <div class="seminar__banner">
                    <img class="seminar__banner-image" src="<?=$arResult['EVENT']['BANNER']?>" alt="<?=$arResult['EVENT']['NAME']?>">
                </div>
            <?}?>
<?
if ($USER->IsAdmin()){
echo '<pre>';
//print_r($arResult)['PROPERTIES'];
echo '</pre>';
}
?>

<div class="seminar__header">
	<?if($arResult['PROPERTIES']['type_event']['VALUE_ENUM_ID'] == 324) {?>
            <div class="seminar__time-date-place">
		<?if(!empty($arResult['PROPERTIES']['startdate'])) {?>
			<div class="seminar__date"><b>Доступ открыт:</b> <?=date("d.m.Y", strtotime($arResult['PROPERTIES']['startdate']['VALUE']))?>-<?= date("d.m.Y",strtotime($arResult['PROPERTIES']['enddate']['VALUE']))?>
			</div>
		<?}?>
		<div class="seminar__date"><b>Формат:</b> <?=$arResult['EVENT']['PLACE']?></div>
		<div class="seminar__place"><b>Язык:</b> <?=$arResult['PROPERTIES']['LAGUAGE']['VALUE']?></div>
	   </div>
	<?} else {?>
                <?if($arResult['EVENT']['TIME-DATE-PLACE'] === 'Y') {?>
                    <div class="seminar__time-date-place">
                        <?if(!empty($arResult['EVENT']['TIME'])) {?>
				<div class="seminar__time"><b>Время:</b> <?=$arResult['EVENT']['TIME']?>
					<?if($arResult['EVENT']['TYPE'] == 'Вебинар') {?> 
						(мск.)
					<?}?>
				</div>
		<?}?>
                <?if(!empty($arResult['EVENT']['DATE'])) {?>
			<div class="seminar__date"><b>Дата проведения:</b> <a class="add-to-calendar" href="/events/seminar/ics.html?ID=<?=$arResult['ID']?>" data-type="Timetable"></a> 
				<?=$arResult['EVENT']['DATE']?></div><?}?>
                        	<?if(!empty($arResult['EVENT']['PLACE'])) {?>
					<div class="seminar__place"><b>Место проведения:</b> 
					<?=$arResult['EVENT']['PLACE']?>
					</div>
				<?}?>
                    	</div>
                <?}?>
	<?}?>


                <div class="seminar__order-box">
                    <a href="#register" class="seminar__order">Зарегистрироваться</a>
                </div>
            </div>

            <div class="seminar__main">
                <?if(!empty($arResult['PREVIEW_TEXT'])) {?>
                    <div class="seminar__section">
                        <div class="seminar__section-title">Организаторы:</div>
                        <div class="seminar__section-description"><?=$arResult['PREVIEW_TEXT']?></div>
                    </div>
                <?}?>

                <?if(!empty($arResult["DETAIL_TEXT"])) {?>
                    <div class="seminar__section">
                        <div class="seminar__section-description"><?=$arResult["DETAIL_TEXT"]?></div>
                    </div>
                <?}?>

                <?if(!empty($arResult['EVENT']["DESCRIPTION"]) || !empty($arResult['EVENT']['SHORT_DESCRIPTION'])) {?>
                    <div class="seminar__section">
                        <div class="seminar__section-title">Краткое описание:</div>
                        <?if(!empty($arResult['EVENT']["DESCRIPTION"])) {?><div class="seminar__section-description"><?=$arResult['EVENT']["DESCRIPTION"]?></div><?}?>
                        <?if(!empty($arResult['EVENT']['SHORT_DESCRIPTION'])) {?><div class="seminar__section-description"><?=$arResult['EVENT']["SHORT_DESCRIPTION"]?></div><?}?>
                    </div>
                <?}?>

                <?if(!empty($arResult['EVENT']["CONTENT"])) {?>
                    <div class="seminar__section">
                        <div class="seminar__section-title">Содержание:</div>
                        <div class="seminar__section-description"><?=$arResult['EVENT']["CONTENT"]?></div>
                    </div>
                <?}?>

                <?if(!empty($arResult['EVENT']["PEOPLE"])) {?>
                    <div class="seminar__section">
                        <div class="seminar__section-title">Целевая аудитория:</div>
                        <div class="seminar__section-description"><?=$arResult['EVENT']["PEOPLE"]?></div>
                    </div>
                <?}?>

                <?if(empty($arResult['EVENT']['TRAINER']) && (strlen(trim($arResult['EVENT']["LECTURE"])) > 0)) {?>
                    <div class="seminar__section">
                        <div class="seminar__section-title">Докладчик:</div>
                        <div class="seminar__section-description"><?=$arResult['EVENT']["LECTURE"]?></div>
                    </div>
                <?}?>
            </div>
        </div>
    </div>
</div>
<?if(!empty($arResult['EVENT']['TRAINER'])) {?>
    <div id="trainer" class="not-main-page">
        <div class="frame">
            <div class="trainer-slider-outer">
                <div class="trainer-heading">Тренер:</div>
                <div class="training-slider-inner active">
                    <div class="trainer-item">
                        <div class="trainer-header clearfix">
                            <div class="trainer-picture">
                                <img src="<?=$arResult['EVENT']['TRAINER']["PHOTO"]?>" alt="<?=$arResult['EVENT']['TRAINER']["NAME"]?>">
                            </div>
                            <div class="trainer-short-description">
                                <a class="trainer-link" href="/about/experts/<?= $arResult['EVENT']['TRAINER']['CODE'] ?>.html" tabindex="0"><?=$arResult['EVENT']['TRAINER']["NAME"]?></a>
                                <?=$arResult['EVENT']['TRAINER']["SHORT"]?></div>
                        </div>
                        <div class="trainer-content <?if(strlen($arResult['EVENT']['TRAINER']["DESCRIPTION"]) < 800) { ?>open<?}?>">
                            <div class="trainer-description"><?=$arResult['EVENT']['TRAINER']["DESCRIPTION"]?></div>
                            <div <? if (strlen($arResult['EVENT']['TRAINER']["DESCRIPTION"]) < 800) {?>style="display: none"<?}?> class="open-link">
                                <a href="#" tabindex="0">Развернуть</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?}?>
<?if(!empty($arResult['COURSE']['ADD_SOURCES']) || !empty($arResult['ADDITONAL']['LINKED'])){?>
    <div id="reccomend" class="bg not-main-page gray">
        <div class="frame">
            <? if (count($arResult['ADDITONAL']['LINKED']) > 0) { ?>
                <div class="reccomend-heading">Связанные курсы:</div>
                <div class="reccomend-list">
                    <? foreach ($arResult['ADDITONAL']['LINKED'] as $arLinkedCourses) { ?>
                        <div class="reccomend-item">
                            <div class="row">
                                <div class="rec-code"><?= $arLinkedCourses['COURSE_CODE'] ?></div>
                                <div class="reg-content">
                                    <a href="/training/catalog/course.html?ID=<?= $arLinkedCourses['COURSE_ID'] ?>"><?= $arLinkedCourses['COURSE_NAME'] ?></a>
                                </div>
                                <? if (strlen($arLinkedCourses['COURSE_DURATION']) > 0) {?>
                                    <div class="req-hours">
                                        <span class="hours"><?=$arLinkedCourses['COURSE_DURATION'] . " ч.";?></span>
                                    </div>
                                <?}?>
                            </div>
                            <div class="row">
                                <div class="rec-code"></div>
                                <div class="reg-content">
                                    <div class="row">
                                        <? $t = 0; ?>
                                        <? foreach ($arLinkedCourses['TIMETABLE'] as $arTimetable) { ?>
                                            <? if ($t < 4) { ?>
                                                <? $vCourseDates = ""; ?>
                                                <? $vCourseDates .= $arTimetable['TIMETABLE_STARTDATE'];
                                                if (strlen($arTimetable['TIMETABLE_ENDDATE']) > 0) {
                                                    $vCourseDates .= "-" . $arTimetable['TIMETABLE_ENDDATE'];
                                                } ?>
                                                <div class="dates-reccomend">
                                                    <?= $arTimetable['TIMETABLE_CITY_NAME'] ?>:<br>
                                                    <b><?= $vCourseDates ?></b>
                                                </div>
                                            <? } ?>
                                            <? $t++ ?>
                                        <? } ?>
                                    </div>
                                </div>
                                <div class="req-hours sw100p">
                                    <a class="reg-link" href="/training/catalog/course.html?ID=<?= $arLinkedCourses['COURSE_ID'] ?>">Записаться</a>
                                </div>
                            </div>
                        </div>
                    <? } ?>
                </div>
            <? } ?>
            <div class="row course-main-info clearfix">
                <? if ($arResult['COURSE']['ADD_SOURCES']) { ?>
                    <div class="small-2 padding-right">
                        <div class="descr-wrap margin-b-35">
                            <h3 id="reco">Рекомендуемые дополнительные материалы, источники:</h3>
                            <?= $arResult['COURSE']['ADD_SOURCES'];?>
                        </div>
                    </div>
                <? } ?>
                <? if ($arResult['COURSE']['OTHER']) { ?>
                    <div class="small-2 <? if ($arResult['COURSE']['ADD_SOURCES']) { ?>padding-left<? } ?>">
                        <div class="desr-wrap margin-b-35">
                            <h3 id="primech">Примечание:</h3>
                            <?= $arResult['COURSE']['OTHER'];?>
                        </div>
                    </div>
                <? } ?>
            </div>
        </div>
    </div>
<?}?>
