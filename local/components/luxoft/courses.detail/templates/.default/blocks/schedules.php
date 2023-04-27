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
<div class="course-schedules course-detail__container">
    <div class="course-schedules__header">
        <div class="course-schedules__title"><?=Loc::getMessage('TITLE_SCHEDULES')?></div>
        <div class="course-schedules__controls">
            <div class="course-schedules__view">
                <div class="course-schedules__view-label"><?=Loc::getMessage('SCHEDULES_VIEW')?>:</div>
                <div class="course-schedules__view-controls">
                    <label class="course-schedules__view-control radio">
                        <input type="radio" name="course-detail-view" value="schedule" checked>
                        <span><?=Loc::getMessage('SCHEDULES_VIEW_SCHEDULE')?></span>
                    </label>
                    <label class="course-schedules__view-control radio">
                        <input type="radio" name="course-detail-view" value="prices">
                        <span><?=Loc::getMessage('SCHEDULES_VIEW_PRICES')?></span>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="course-schedules__body" data-schedules-type="schedule">
        <?php if(count($arResult['schedule'])) {?>
            <div class="course-schedules__items">
                <?php foreach ($arResult['schedule'] as $schedule) {?>
                    <div class="course-schedules__item">
                        <div class="course-schedule-item">
                            <?php if($schedule['date'] || $schedule['time']) {?>
                                <div class="course-schedule-item__date-and-time">
                                    <div class="course-schedule-item__date">
                                        <span class="course-schedule-item__date-start"><?=($schedule['date']['end']) ? $schedule['date']['start'].' - ' : $schedule['date']['start']?></span>
                                        <?php if($schedule['date']['end']) {?>
                                            <span class="course-schedule-item__date-end"><?=$schedule['date']['end']?></span>
                                        <?php }?>
                                    </div>
                                    <?php if($schedule['time']) {?>
                                        <div class="course-schedule-item__time"><?=$schedule['time']?></div>
                                    <?php }?>
                                </div>
                            <?php }?>

                            <div class="course-schedule-item__info">
                                <?php if($schedule['city']){?>
                                    <div class="course-schedule-item__property course-schedule-item__property_location">
                                        <span><?=Loc::getMessage('OFFER_LOCATION')?>:</span><span><?=$schedule['city']?></span>
                                    </div>
                                <?php }?>
                                <?php if($schedule['duration']){?>
                                    <div class="course-schedule-item__property course-schedule-item__property_duration">
                                        <span><?=Loc::getMessage('OFFER_DURATION')?>:</span><span><?=$schedule['duration']?> <?=Loc::getMessage('HOURS')?></span>
                                    </div>
                                <?php }?>
                                <?php if($schedule['lang']){?>
                                    <div class="course-schedule-item__property course-schedule-item__property_lang">
                                        <span><?=Loc::getMessage('OFFER_LANGUAGE')?>:</span><span><?=$schedule['lang']?></span>
                                    </div>
                                <?php }?>
                                <?php if($schedule['time']){?>
                                    <div class="course-schedule-item__property course-schedule-item__property_time">
                                        <span><?=Loc::getMessage('OFFER_TIME')?>:</span><span><?=$schedule['time']?></span>
                                    </div>
                                <?php }?>
                                <?php if($schedule['timezone']){?>
                                    <div class="course-schedule-item__property course-schedule-item__property_timezone">
                                        <span><?=Loc::getMessage('OFFER_TIMEZONE')?>:</span><span><?=$schedule['timezone']?></span>
                                    </div>
                                <?php }?>
                                <?php if($schedule['trainer'] || $schedule['trainerString']) {?>
                                    <div class="course-schedule-item__property course-schedule-item__property_trainer">
                                        <span><?=Loc::getMessage('OFFER_TRAINER')?>:</span>
                                        <?php if($schedule['trainer']) {?>
                                            <a href="<?=$schedule['trainer']['link']?>"><?=$schedule['trainer']['fullName']?></a>
                                        <?php } else {?>
                                            <span><?=$schedule['trainerString']?></span>
                                        <?php }?>
                                    </div>
                                <?php }?>
                            </div>
                            <?php if($schedule['trainer'] || $schedule['trainerString']) {?>
                                <div class="course-schedule-item__trainer">
                                    <span><?=Loc::getMessage('TRAINER')?></span>
                                    <?php if($schedule['trainer']) {?>
                                        <a href="<?=$schedule['trainer']['link']?>"><?=$schedule['trainer']['fullName']?></a>
                                    <?php } else {?>
                                        <span><?=$schedule['trainerString']?></span>
                                    <?php }?>
                                </div>
                            <?php }?>
                            <div class="course-schedule-item__order">
                                <?php if($schedule['sale']['discountPrice']) {?>
                                    <div class="course-schedule-item__price"><?=$schedule['sale']['discountPriceFormatted']?></div>
                                <?php }?>
                                <?php if($schedule['sale']['price'] !== $schedule['sale']['discountPrice']) {?>
                                    <div class="course-schedule-item__price-last"><?=$schedule['sale']['priceFormatted']?></div>
                                <?php }?>
                                <?php
                                // заменили на вывод под кнопкой
                                if(false && $schedule['sale']['percent']) {?>
                                    <div class="course-schedule-item__discount"><?=$schedule['sale']['percent']?>% <?=Loc::getMessage('DISCOUNT')?></div>
                                <?php }?>
                            </div>
                            <div class="course-schedule-item__controls">
                                <div onclick="window.vueEventBus.$emit('courseDetailModal', '<?=$schedule['id']?>')"
                                     class="course-detail__button course-detail__button_size-s course-detail__button_color-orange">
                                    <span><?=Loc::getMessage('BUTTON_SIGN_UP_SHORT')?></span>
                                </div>
                                <?php if($schedule['sale']['percent']) {?>
                                    <div class="course-schedule-item__discount-icon">
                                        <span>- <?=$schedule['sale']['percent']?>%</span>
                                    </div>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                <?php }?>
            </div>
            <a href="<?=$arResult['links']['schedule']?>"
               class="course-detail__button course-detail__button_h-s course-detail__button_color-white">
                <span><?=Loc::getMessage('SCHEDULES_VIEW_ENTIRE')?></span>
            </a>
        <?php } else {?>
            <div class="course-detail-new">
                <div class="course-detail-new__title"><?=Loc::getMessage('SCHEDULES_EMPTY_TITLE')?></div>
                <div class="course-detail-new__description"><?=Loc::getMessage('SCHEDULES_EMPTY_DESCRIPTION')?></div>
                <div class="course-detail-new__action">
                    <div class="button-plus button_color-orange"
                         onclick="window.vueEventBus.$emit('courseDetailModal', '<?=$arResult['scheduleId']?>')">
                        <span>+</span>
                    </div>
                </div>
            </div>
        <?php }?>
    </div>
    <div class="course-schedules__body" data-schedules-type="prices" style="display: none;">
        <div class="course-schedules__price-rows">
            <div class="course-schedules__price-row">
                <div class="course-schedules__price-col">
                    <div class="course-schedules__price-name"><?=Loc::getMessage('SCHEDULES_PRICE_ONLINE')?></div>
                </div>
                <div class="course-schedules__price-col">
                    <div class="course-schedules__price-value"><?=$arResult['sale']['priceFormatted']?></div>
                </div>
            </div>
        </div>
        <div class="course-detail__button course-detail__button_h-s course-detail__button_color-orange"
             onclick="window.vueEventBus.$emit('courseDetailModal', '<?=$arResult['scheduleId']?>')">
            <span><?=Loc::getMessage('BUTTON_SIGN_UP_SHORT')?></span>
        </div>
    </div>
    <div class="course-schedules__footer"></div>
</div>