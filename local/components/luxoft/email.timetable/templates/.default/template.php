<?php
declare(strict_types=1);
/**
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 */

$this->setFrameMode(true);
?>
<table style="max-width: 600px;width: 100%;border-spacing: 0;border-collapse: collapse;">
    <tbody>
    <tr>
        <td>
            <table style="width: 100%;border-spacing: 0;border-collapse: collapse;">
                <tbody>
                <?php foreach ($arResult['items'] as $index => $item) { ?>
                    <tr>
                        <td style="
                                width: 100%;
                                padding: 15px;
                                background-color: <?=($index % 2) ? '#54CCFC' : '#AAE7FF';?>;
                                ">
                            <table style="width: 100%;border-spacing: 0;border-collapse: collapse;">
                                <tbody>
                                <tr>
                                    <td style="width: 24px;vertical-align: top;text-align: left;">
                                        <?php if ($item['icon']) {?>
                                            <img width="14px" src="<?=$item['icon']?>" alt="<?=$item['course']['name']?>" />
                                        <?php }?>
                                    </td>
                                    <td style="width: 310px;vertical-align: top;text-align: left;">
                                        <table style="border-spacing: 0;border-collapse: collapse;">
                                            <tbody>
                                            <tr>
                                                <td style="
                                                        padding-bottom: 4px;
                                                        font-weight: 400;
                                                        font-size: 13px;
                                                        line-height: 14px;
                                                        color: #6A6A6A;"
                                                ><?=$item['code']?></td>
                                            </tr>
                                            <tr>
                                                <td style="padding-bottom: 8px;">
                                                    <a href="<?=$item['course']['link']?>" target="_blank"
                                                       style="font-size: 14px;font-weight: 600;line-height: 14px;text-decoration-line: underline;color: #001A72;"
                                                    ><?=$item['course']['name']?></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding-bottom: 2px;font-size: 12px;"
                                                ><?=$item['category']?><?php
                                                    foreach ($item['tags'] as $tag) {?><span style="margin-left: 10px;background-color: <?=$tag['color']?>;font-size: 10px;color: #000000;padding: 2px 8px;border-radius: 8px;"><?=$tag['name']?></span><?php
                                                    }?></td>
                                            </tr>
                                            <?php if ($item['trainer']['link'] && $item['trainer']['name']) {?>
                                                <tr><td style="font-size: 13px">Тренер  — <a href="<?=$item['trainer']['link']?>" target="_blank"><?=$item['trainer']['name']?></a></td></tr>
                                            <?php } elseif ($item['trainer']['name']) {?>
                                                <tr><td style="font-size: 13px">Тренер  — <?=$item['trainer']['name']?></td></tr>
                                            <?php }?>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td style="width: 156px;vertical-align: middle;text-align: left;">
                                        <table style="border-spacing: 0;border-collapse: collapse;">
                                            <tbody>
                                            <tr><td style="font-size: 12px;font-weight: 600;padding-bottom: 4px;"><?=$item['date']['start']?><?=$item['date']['end'] ? " — {$item['date']['end']}" : ''?></td></tr>
                                            <tr><td style="font-size: 13px;padding-bottom: 8px;"><?=$item['time']['start']?><?=$item['time']['end'] ? " — {$item['time']['end']}" : ''?></td></tr>
                                            <tr><td style="font-size: 12px;font-weight: 600;"><?=$item['duration']?> ак. часов</td></tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td style="width: 110px;vertical-align: middle;text-align: center;">
                                        <table style="width: 100%;border-spacing: 0;border-collapse: collapse;">
                                            <tbody>
                                            <tr>
                                                <td style="
                                                        font-size: 14px;
                                                        padding-bottom: 5px;
                                                        text-align: center;
                                                <?php if ($item['sale']) {?>
                                                        text-decoration: line-through;
                                                <?php } else {?>
                                                        font-weight: 600;
                                                <?php }?>
                                                        "><?=$item['price']?></td>
                                            </tr>
                                            <?php if ($item['sale']) {?>
                                                <tr>
                                                    <td style="
                                                        font-size: 14px;
                                                        color: #f17227;
                                                        font-weight: 600;
                                                        padding-bottom: 5px;
                                                        text-align: center;
                                                    "><?=$item['sale']?></td>
                                                </tr>
                                            <?php }?>
                                            <?php if ($item['course']['link']) {?>
                                                <tr>
                                                    <td style="padding: 10px 0 0;">
                                                        <a href="<?=$item['course']['link']?>"
                                                           target="_blank"
                                                           style="
                                                               text-decoration: none;
                                                               padding: 8px 10px;
                                                               border-radius: 5px;
                                                               background: #001A72;
                                                               font-size: 12px;
                                                               color: #ffffff;
                                                            ">Записаться</a>
                                                    </td>
                                                </tr>
                                            <?php }?>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td style="text-align: center; vertical-align: middle;padding: 40px 0 20px;">
            <a style="
                        color: #ffffff;
                        font-weight: 500;
                        padding: 16px 64px;
                        border-radius: 10px;
                        background: #37B5E7;
                        "
               href="https://ibs-training.ru/timetable/" target="_blank">Посмотреть расписание на квартал</a>
        </td>
    </tr>
    </tbody>
</table>


