<?php
use Bitrix\Main\Localization\Loc;
/**
 * @var CBitrixComponent $this
 * @var array $arParams
 * @var array $arResult
 * @var string $componentPath
 * @var string $componentName
 * @var string $componentTemplate
 * @global CDatabase $DB
 * @global CUser $USER
 * @global CMain $APPLICATION
 **/
?>
<div class="course-others course-detail__container">
    <div class="course-others__header">
        <div class="course-others__title"><?=Loc::getMessage('TITLE_COURSES')?></div>
    </div>
    <div class="course-others__main">
        <?foreach ($arResult['courses'] as $item) {?>
            <div class="course-others__item">
                <div class="course-others-item">
                    <div class="course-others-item__col">
                        <a href="<?=$item['link']?>" class="course-others-item__name"><?=$item['name']?></a>
                        <div class="course-others-item__description"><?=$item['description']?></div>
                        <?php if($item['schedule']) {?>
                            <div class="course-others-item__schedule">
                                <?php foreach($item['schedule'] as $scheduleItem) {?>
                                <div class="course-others-item__schedule-item">
                                    <div class="course-others-item__schedule-item-city"><?=$scheduleItem['city']?>:</div>
                                    <div class="course-others-item__schedule-item-date"><?=($scheduleItem['date']['end']) ? $scheduleItem['date']['start'].' - '.$scheduleItem['date']['end'] : $scheduleItem['date']['start']?></div>
                                </div>
                                <?php }?>
                            </div>
                        <?php }?>
                    </div>
                    <div class="course-others-item__col">
                        <a href="<?=$item['link']?>" class="course-others-item__code"><?=$item['code']?></a>
                        <div class="course-others-item__duration"><?=$item['duration']?> <?=Loc::getMessage('HOURS')?></div>
                        <a href="<?=$item['link']?>" class="course-detail__button course-detail__button_h-s course-detail__button_color-orange">
                            <span><?=Loc::getMessage('BUTTON_SIGN_UP_SHORT')?></span>
                        </a>
                    </div>
                </div>
            </div>
        <?}?>
        <a href="<?=$arResult['links']['catalog']?>" class="course-detail__button course-detail__button_h-s course-detail__button_color-grey">
            <span><?=Loc::getMessage('BUTTON_VIEW_CATALOG')?></span>
        </a>
    </div>
    <div class="course-others__footer"></div>
</div>
