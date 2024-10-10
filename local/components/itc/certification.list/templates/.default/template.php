<?php
declare(strict_types=1);
/**
 * @global CMain $APPLICATION;
 * @var array $arResult
 * @var array $arParams
 */
?>

<div class="scheduleCertification">
    <div class="scheduleCertification__list timetable-list">
        <?php foreach ($arResult['items'] as $item) {?>
            <div class="scheduleCertification__item timetable-item">
                <div class="timetable-item-wrap">
                    <div class="timetable-name-wrap">
                        <div class="name-n-code-wrap">
                            <div class="code-icon-wrap">
                                <div class="code-icon-right">
                                    <? if($item['complexity'] !==''){?>
                                        <span class="icon level"><?=$item['complexity']?></span>
                                    <?}?>
                                    <span class="hours"> <?=$item['duration']?> мин</span>
                                </div>
                            </div>
                        </div>
                        <div class="scheduleCertificationItem__info">
                            <a href="<?=$item['url']?>" class="scheduleCertificationItem__name course-name-time"><?=$item['name']?></a>
                        </div>
                    </div>
                    <div class="scheduleCertificationItem__timetable time-price-wrapper">
                        <div class="scheduleCertificationItem__region trener-info">Регион: <span><?=$item['locations']?></span></div>
                        <div class="time-wrapper">
                            Дата и время:
                            <div class="time-wrapper-right">
                                <div class="scheduleCertificationItem__date"><?=$item['date']?></div>
                                <div class="scheduleCertificationItem__time"><?=$item['time']?></div>
                            </div>
                        </div>
                        <div class="scheduleCertificationItem__order price-wrapper">
                            <div class="scheduleCertificationItem__price price"><?=$item['priceFormatted']?></div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }?>
    </div>
</div>