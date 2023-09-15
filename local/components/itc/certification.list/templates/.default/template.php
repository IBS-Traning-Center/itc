<?php
declare(strict_types=1);
/**
 * @global CMain $APPLICATION;
 * @var array $arResult
 * @var array $arParams
 */
?>

<div class="scheduleCertification">
    <div class="scheduleCertification__list">
        <?php foreach ($arResult['items'] as $item) {?>
            <div class="scheduleCertification__item">
                <div class="scheduleCertificationItem">
                    <div class="scheduleCertificationItem__logo">
                        <img src="<?=$item['logo']?>" alt="" class="scheduleCertificationItem__image">
                    </div>

                    <div class="scheduleCertificationItem__info">
                        <a href="<?=$item['url']?>" class="scheduleCertificationItem__name"><?=$item['name']?></a>
                        <div class="scheduleCertificationItem__region">Регион: <?=$item['locations']?></div>
                    </div>

                    <div class="scheduleCertificationItem__timetable">
                        <div class="scheduleCertificationItem__date"><?=$item['date']?></div>
                        <div class="scheduleCertificationItem__time"><?=$item['time']?></div>
                        <div class="scheduleCertificationItem__duration"><?=$item['duration']?> мин</div>
                    </div>

                    <div class="scheduleCertificationItem__order">
                        <div class="scheduleCertificationItem__price"><?=$item['priceFormatted']?></div>
                        <div class="scheduleCertificationItem__button">
                            <a href="<?=$item['url']?>#form" class="Button">Записаться</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php }?>
    </div>
</div>

<style>
    .scheduleCertification {
        padding: 54px 0;
        background: #f4f4f5;
    }
    .scheduleCertification__list {
        max-width: 1170px;
        margin-left: auto;
        margin-right: auto;
    }
    .scheduleCertification__item {

    }
    .scheduleCertification__item + .scheduleCertification__item
    {
        border-top: 20px solid #f4f4f5;
    }
    .scheduleCertificationItem {
        width: 100%;
        display: flex;
        flex-direction: row;
        justify-content: flex-start;
        align-items: center;

        border-radius: 4px;

        padding: 25px 35px;
        background: #e9e9e9;
    }
    .scheduleCertificationItem__logo {
        width: 94px;
    }
    .scheduleCertificationItem__image {
        display: block;
        max-width: 100%;
        max-height: 100%;
    }
    .scheduleCertificationItem__info {
        display: flex;
        flex-direction: column;
        gap: 16px;

        margin-left: 32px;
        margin-right: auto;
    }
    .scheduleCertificationItem__name {
        max-width: 540px;
        display: block;
        font-size: 22px;
        font-weight: 600;
        line-height: 1.4;
    }
    .scheduleCertificationItem__region {
        font-size: 18px;
        line-height: 1.2;
    }
    .scheduleCertificationItem__timetable {
        display: flex;
        flex-direction: column;
        gap: 12px;

        margin-left: auto;
        margin-right: 0;
    }
    .scheduleCertificationItem__date {
        white-space: nowrap;
        font-size: 20px;
    }
    .scheduleCertificationItem__time {
        white-space: nowrap;
        font-size: 18px;
    }
    .scheduleCertificationItem__duration {
        white-space: nowrap;
        font-size: 18px;
        font-weight: 600;
    }
    .scheduleCertificationItem__order {
        margin-left: 32px;
        margin-right: 0;
    }
    .scheduleCertificationItem__price {
        white-space: nowrap;
        font-size: 22px;
        font-weight: 600;
        margin-bottom: 14px;
        color: #f26f21;
    }
    .scheduleCertificationItem__button .Button {
        display: inline-block;
        width: 100%;
        padding: 0 20px;
        background: #f17227;
        border-radius: 4px;
        transition: all 0.3s ease-in;
        white-space: nowrap;
        text-align: center;
        color: #ffffff;
        font-weight: 600;
        font-size: 12px;
        line-height: 37px;
    }

    @media (max-width: 767px) {
        .scheduleCertificationItem {
            gap: 20px;
            flex-direction: column;
            align-items: flex-start;
        }
        .scheduleCertificationItem__info {
            width: 100%;
            margin-left: 0;
            margin-right: 0;
        }
        .scheduleCertificationItem__timetable {
            width: 100%;
            flex-direction: row;
            justify-content: flex-start;
            align-items: center;
            margin-left: 0;
            margin-right: 0;
        }
        .scheduleCertificationItem__order {
            width: 100%;
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
            align-items: center;
            gap: 20px;
            margin-left: 0;
            margin-right: 0;
        }
        .scheduleCertificationItem__price {
            margin-bottom: 0;
        }
    }
</style>