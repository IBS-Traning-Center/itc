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
<div class="course-offer">
    <div class="course-offer__name"><?=$arResult['name']?></div>
    <?php if($arResult['sale']['discountPercent']) {?>
        <div class="course-offer__discount"><?=$arResult['sale']['discountPercent']?></div>
    <?php }?>
    <div class="course-offer__button">
        <div onclick="window.vueEventBus.$emit('courseDetailModal', '<?=$arResult['scheduleId']?>')"
             class="course-detail__button course-detail__button_h-l course-detail__button_color-orange">
            <span><?=Loc::getMessage('BUTTON_SIGN_UP')?></span>
        </div>
    </div>
    <div class="course-offer__properties">
        <?php if($arResult['duration']) {?>
            <div class="course-offer__property">
                <div class="course-offer__property-name"><?=Loc::getMessage('OFFER_DURATION')?></div>
                <div class="course-offer__property-value"><?=$arResult['duration']?> <?=Loc::getMessage('HOURS')?></div>
            </div>
        <?php }?>
        <?php if($arResult['city']) {?>
            <div class="course-offer__property">
                <div class="course-offer__property-name"><?=Loc::getMessage('OFFER_LOCATION')?></div>
                <div class="course-offer__property-value"><?=$arResult['city']?></div>
            </div>
        <?php }?>
        <?php if($arResult['language']) {?>
            <div class="course-offer__property">
                <div class="course-offer__property-name"><?=Loc::getMessage('OFFER_LANGUAGE')?></div>
                <div class="course-offer__property-value"><?=$arResult['language']?></div>
            </div>
        <?php }?>
        <?php if($arResult['code']) {?>
            <div class="course-offer__property">
                <div class="course-offer__property-name"><?=Loc::getMessage('OFFER_CODE')?></div>
                <div class="course-offer__property-value"><?=$arResult['code']?></div>
            </div>
        <?php }?>
    </div>
    <a href="#schedule" class="course-offer__schedule-and-price"><?=Loc::getMessage('SCHEDULE_AND_PRICES')?></a>
    <div class="course-offer__schedule-and-price-box">
        <div class="course-offer__schedule course-offer__properties course-offer__properties_schedule" style="margin-top: 0">
            <?php foreach ($arResult['schedule'] as $keyScheduleItem => $scheduleItem) {
                if($keyScheduleItem > 2) continue;?>
                <div class="course-offer__property">
                    <div class="course-offer__property-name"><?=($scheduleItem['date']['end']) ? $scheduleItem['date']['start'].' - '.$scheduleItem['date']['end'] : $scheduleItem['date']['start']?></div>
                </div>
            <?php }?>
            <?php if(count($arResult['schedule']) > 2) {?>
                <div class="course-offer__property">
                    <div class="course-offer__property-name">
                        <a href="#schedule">Смотреть все</a>
                    </div>
                </div>
            <?php }?>
        </div>
        <div class="course-offer__prices-box">
            <div class="course-offer__prices">
                <?php if($arResult['sale']['price']) {?>
                    <div class="course-offer__price"><?=$arResult['sale']['priceFormatted']?></div>
                <?php }?>
                <?php if($arResult['sale']['lastPrice']) {?>
                    <div class="course-offer__price-last"><?=$arResult['sale']['lastPriceFormatted']?></div>
                <?php }?>
            </div>
        </div>
    </div>
    <div class="course-offer__remark"><?=Loc::getMessage('TRAINING_MORE_PEOPLE')?></div>
</div>
