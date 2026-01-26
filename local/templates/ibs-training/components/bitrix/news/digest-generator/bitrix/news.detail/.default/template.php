<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);?>
<div class="digest">
    <!--Начало почтового шаблона-->
    <div class="digest__message-body">
        <style>
            .sectionContent {
                font-size: 14px;
                line-height: 18px;
                font-family: tahoma, geneva, sans-serif;
            }

            .sectionContent a {
                color: #426192;
                font-family: tahoma, geneva, sans-serif;
            }

            .sectionContentTitle {
                font-size: 16px;
                padding: 0px 0px 20px;
                font-family: tahoma, geneva, sans-serif;
                font-weight: bold;
            }

            .sectionContentTitle a {
                color: #426192;
                text-decoration: none;
                font-family: tahoma, geneva, sans-serif;
            }

            .button {
                padding: 17px 5px;
                text-align: center;
                background: #f2630e;
                border-radius: 4px;
            }

            .buttonContainer {
                padding: 30px 0px 30px 0px;
            }

            .logo {
                padding: 20px 40px 20px 15px;
                width: 150px;
            }

            .logo-2 {
                width: 148px;
                padding: 20px 0;
            }

            .preheader {
                font-family: tahoma, geneva, sans-serif;
                vertical-align: middle;
                background: #fff;
                height: 90px;
                border-bottom: 1px solid #f5f5f5;
            }

            .not-logo {
                width: 214px;
                padding: 20px 0;
                padding-right: 15px;
            }

            .heading {
                padding: 0 0 16px 0;
                font-size: 20px;
                border-bottom: 1px solid #f3f2f2;
            }

            .heading a {
                color: #426192;
                text-decoration: none;
                font-family: tahoma, geneva, sans-serif;
            }

            #body_style {
                display: block;
                color: #2d2d2d;
            }

            .icon {
                padding-right: 12px;
            }

            .button a {
                color: #fff;
                text-decoration: none;
                display: block;
                font-size: 14px;
                font-weight: bold;
                font-family: tahoma, geneva, sans-serif;
            }

            .questions {
                text-align: center;
                font-size: 21px;
                font-family: tahoma, geneva, sans-serif;
                padding: 34px 0;
                border-bottom: 1px solid #f3f2f2;
            }

            .remarka {
                font-size: 12px;
            }
        </style>
        <span id="body_style">
            <table class="preheader" cellpadding="0" cellspacing="0" width="100%">
                <tbody>
                    <tr>
                        <td style="color: rgb(255, 255, 255); font-size: 2px;"> Актуальные IT-семинары, конференции иновости </td>
                    </tr>
                    <tr>
                        <td>
                            <table border="0" cellpadding="0" cellspacing="0" summary="" width="750" style="" align="center">
                                <tbody>
                                    <tr>
                                        <td class="logo" style="vertical-align: middle">
                                            <a href="https://www.luxoft-training.ru/">
                                                <img width="150" src="/local/templates/ibs-training/assets/images/logo_gradient.svg" alt="">
                                            </a>
                                        </td>
                                        <td class="logo-2 webversion" style="vertical-align: middle">
                                            <a href="https://www.luxoft-training.ru/about/news/Luxoft_Training_prodlil_svoe_partnerstvo_s_IIBA_na_2020/">
                                                <img width="148" src="/images/digest2018/logo-2.jpg" alt="">
                                            </a>
                                        </td>
                                        <td>&nbsp;</td>
                                        <td class="not-logo" style="vertical-align: middle">
                                            <table border="0" cellspacing="0" summary="" width="100%" align="center">
                                                <tbody>
                                                    <tr>
                                                        <td class="icon"><a href="http://vk.com/luxoft_training"><img src="/images/digest2018/vk.jpg"></a></td>
                                                        <td class="icon"><a href="https://twitter.com/TrainingLuxoft"><img src="/images/digest2018/twitter.jpg"></a></td>
                                                        <td class="icon"><a href="https://www.linkedin.com/groups/3880622/"><img src="/images/digest2018/linkedin.jpg"></a></td>
                                                        <td><a href="http://www.youtube.com/user/LuxoftTrainingCenter"><img src="/images/digest2018/youtube.jpg"></a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <?if(!empty($arResult['DETAIL_PICTURE'])){?>
                        <tr>
                        <td>
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" summary="" align="center" style="font-family: tahoma, geneva, sans-serif;">
                                <tbody>
                                    <tr>
                                        <td align="center">
                                            <img src="https://www.luxoft-training.ru<?=$arResult['DETAIL_PICTURE']['SRC']?>" width="100%">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <?}?>
                </tbody>
            </table>
            <?if(!empty($arResult['PREVIEW_TEXT'])) {?>
            <div class="table-responsive">
                <table cellspacing="0" summary="" width="750" align="center">
                    <tbody>
                        <tr><td class="whitespace" height="20">&nbsp;</td></tr>
                        <tr>
                            <td style="background: #fff; padding: 0 15px; font-family: tahoma, geneva, sans-serif;">
                                <?=$arResult['PREVIEW_TEXT']?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?}?>
            <?if(!empty ($arResult['PROPERTIES']['BLOCKS']['VALUE'])) {?>
                <table border="0" cellpadding="0" cellspacing="0" width="750" summary="" align="center" style="font-family: tahoma, geneva, sans-serif;">
                <tbody>
                    <tr>
                        <td class="whitespace" height="10">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="padding: 15px;" class="emailContainer" valign="top">
                            <table border="0" cellspacing="0" summary="" width="100%">
                                <tbody>
                                    <tr><td class="whitespace" height="20">&nbsp;</td></tr>
                                </tbody>
                            </table>
                            <?foreach ($arResult['PROPERTIES']['BLOCKS']['VALUE'] as $keyBlock => $arBlock) {
                                $block = $arBlock['SUB_VALUES'];
                                $title = $block['TITLES']['~VALUE'];
                                $linkTitle = $block['LINK']['~VALUE'];
                                $description = $block['DESCRIPTION']['~VALUE']['TEXT'];
                                if(!empty($linkTitle)) {
                                    $title = '<a href="' . $linkTitle . '">' . $title . '</a>';
                                }
                                ?>
                                <table border="0" cellspacing="0" summary="" width="100%" align="center">
                                <tbody>
                                    <tr>
                                        <td class="column" valign="top">
                                            <table border="0" cellpadding="0" cellspacing="0" summary="">
                                                <tbody>
                                                    <tr><td class="sectionContentTitle" valign="top"><?=$title?></td></tr>
                                                    <tr><td class="sectionContent" valign="top"><?=$description?></td></tr>
                                                    <?if(!empty($linkTitle)) {?>
                                                        <tr>
                                                        <td class="buttonContainer">
                                                            <table border="0" cellpadding="0" cellspacing="0" summary="" width="20%">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="button"><a href="<?=$linkTitle?>" title="Подробнее">Подробнее</a></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <?}?>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr><td class="whitespace" height="20">&nbsp;</td></tr>
                                </tbody>
                            </table>
                            <?}?>
                        </td>
                    </tr>
                    <tr><td class="whitespace" height="20">&nbsp;</td></tr>
                </tbody>
            </table>
            <?} else {?>
            <div class="table-responsive">
                <table cellspacing="0" summary="" width="750" align="center">
                    <tbody>
                        <tr><td class="whitespace" height="20">&nbsp;</td></tr>
                    </tbody>
                </table>
            </div>
            <?}?>
            <?if(!empty($arResult['DETAIL_TEXT'])) {?>
            <div class="table-responsive">
                <table cellspacing="0" summary="" width="750" align="center">
                    <tbody>
                        <tr>
                            <td style="background: #fff; padding: 0 15px; font-family: tahoma, geneva, sans-serif;">
                                <?=$arResult['DETAIL_TEXT']?>
                            </td>
                        </tr>
                        <tr><td class="whitespace" height="20">&nbsp;</td></tr>
                    </tbody>
                </table>
            </div>
            <?}?>
            <?if(!empty($arResult['regions']) || !empty($arResult['directions'] )){?>
            <table class="course" style="background: #f5f5f5" cellpadding="0" cellspacing="0" width="100%">
                <tbody>
                    <tr>
                        <td style="">
                            <table border="0" cellpadding="0" cellspacing="0" width="750" summary="" align="center">
                                <tbody>
                                <tr>
                                    <td valign="top" style="padding:0cm 11.25pt 0cm 11.25pt">
                                        <div class="table-responsive">
                                            <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100.0%">
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 84px;height: 80px;text-align: center;vertical-align: middle;font-size: 20px;">
                                                            <img width="83" src="/static/images/digest/train_at_home_new.png" height="82" data-bx-orig-src="/static/images/digest/train_at_home_new.png" title="Рисунок: /static/images/digest/train_at_home_new.png" data-bx-clean-attribute="title" style="display: block;">
                                                        </td>
                                                        <td style="width: 296px;height: 12px;background: #426192;text-align: center;vertical-align: middle;font-size: 20px;">
                                                            <a style="display: block; color: #fff; text-decoration: none; font-family: tahoma, geneva, sans-serif;" href="https://www.luxoft-training.ru/timetable/" title="Ссылка: https://www.luxoft-training.ru/timetable/" data-bx-clean-attribute="title">Расписание курсов</a>
                                                        </td>
                                                        <td style="background: #fff; text-align: right; font-size: 16px; color: #426192; font-weight: bold; padding-right: 28px; vertical-align: middle; font-family: tahoma, geneva, sans-serif;">
                                                            <img src="/images/digest2018/icon-location.jpg" data-bx-orig-src="/images/digest2018/icon-location.jpg">&nbsp;Онлайн
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                                 <?if($arResult['PROPERTIES']['IS_DIRECTION']['VALUE_XML_ID'] === 'Y') { ?>
                                    <?$firstDirection = true;
                                    foreach ($arResult['directions'] as $indexDirection => $arDirection){?>
                                        <?if(!$firstDirection) {?>
                                            <tr>
                                                <td class="whitespace" height="45">&nbsp;</td>
                                            </tr>
                                        <?}?>
                                            <tr>
                                                <td valign="top" style="padding:0cm 11.25pt 0cm 11.25pt">
                                                    <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100.0%">
                                                        <tbody>
                                                            <tr>
                                                                <td style="background:#426192;padding:15.0pt 21.0pt 15.0pt 15.0pt">
                                                                    <p class="MsoNormal" style="margin-bottom: 0"><b><span style="font-family:'Tahoma',sans-serif;color:white"><?=$arDirection['name']?></span></b></p>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>

                                            <?foreach ($arDirection['items'] as $item){?>
                                            <tr><td class="whitespace" height="10">&nbsp;</td></tr>
                                            <tr>
                                                    <td style="padding: 0 15px;">
                                                        <div class="table-responsive">
                                                            <table border="0" cellpadding="0" cellspacing="0" style="width: 100%">
                                                                <tbody>
                                                                    <tr>
                                                                        <td style="background: #fff; border-bottom: 1px solid #f4f4f4; height: 84px; padding-left: 36px; border-left: 3px solid #426192; vertical-align: middle; width: 400px; padding-right: 15px;">
                                                                            <a style="font-size: 16px; color: #426192; text-decoration: none; font-family: tahoma, geneva, sans-serif;" href="https://www.luxoft-training.ru/training/catalog/course.html?ID=<?=$item['course']['id']?>&ID_TIME=<?=$item['id']?>&<?=$item['utm']?>"><?=$item['course']["nameFromCatalog"] ?></a><? if($item['icon_sale'] === 'yes') {?><br /><i class="icon new-year" style="color: #fff;font-size: 12px;display: inline-block;line-height: 15px;border-radius: 2px;background: #bf2326;letter-spacing: 0.5px;padding-top: 1px;vertical-align: middle;"><a href="<?=$item['icon_sale_link']?>" style="text-decoration:none;font: inherit;color: #ffffff;">&nbsp;<b style="font-weight: 700;">%</b>Акция&nbsp;</a></i><?}?>
                                                                        </td>
                                                                        <td style="background: #fff; background: #fff; padding-right: 15px;vertical-align: middle;">
                                                                            <table border="0" cellpadding="0" cellspacing="0" style="width: 100%">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td valign="middle" style="border:none; padding-right: 12px; width: 16px; vertical-align: middle"><img src="/images/digest2018/date.jpg" style="display: inline-block"></td>
                                                                                        <td valign="middle" style="border:none; font-size: 14px; color: #426192; text-align: left; font-family: tahoma, geneva, sans-serif; vertical-align: middle"><?=$item['date']?></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td valign="middle" style="border:none; padding-right: 12px; width: 15px; vertical-align: middle"><img src="/images/digest2018/time.jpg" style="display: inline-block"></td>
                                                                                        <td valign="middle" style="border:none; font-size: 14px; color: #426192; text-align: left; font-family: tahoma, geneva, sans-serif; vertical-align: middle"><?=$item['time']?><? if (($item['course']['onlineEnumId'] == "103") or ($item["city"]['id'] == CITY_ID_ONLINE)) {?>(мск.)<?}?></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                        <td style="background: #fff; background: #fff; text-align: right; padding-right: 36px;vertical-align: middle;">
                                                                            <table border="0" cellpadding="0" cellspacing="0" style="width: 100%">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td valign="middle" style="border:none;font-size: 14px;color: #426192;text-align: right;font-family: tahoma, geneva, sans-serif;vertical-align: middle;text-decoration: line-through;">10 100 руб.</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td valign="middle" style="border:none;font-size: 14px;color: #d65a50;text-align: right;font-family: tahoma, geneva, sans-serif;vertical-align: middle">Скидка: 15%</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td valign="middle" style="border:none;font-size: 17px;color: #f17227;font-weight: 700;text-align: right;font-family: tahoma, geneva, sans-serif;vertical-align: middle">8 585 руб.</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </td>
                                                </tr>
                                        <?}?>
                                        <?$firstDirection = false;}?>
                                        <tr><td class="whitespace" height="20">&nbsp;</td></tr>
                                    <?} else {?>
                                        <?$firstRegion = true;
                                        foreach ($arResult['regions'] as $indexRegion => $arRegion){?>
                                            <?if(!$firstRegion) {?>
                                            <tr>
                                                <td class="whitespace" height="45">&nbsp;</td>
                                            </tr>
                                            <?}?>
                                            <tr>
                                                <td style="padding: 0 15px;" class="emailContainer" valign="top">
                                                    <div class="table-responsive">
                                                        <table border="0" cellpadding="0" cellspacing="0" style="width: 100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="width: 249px; height: 80px; <?if($firstRegion){?>background: #426192;<?} else {?>background: #fff;<?}?> text-align: center; vertical-align: middle; font-size: 20px;">
                                                                        <?if($firstRegion){?><a style="display: block; color: #fff; text-decoration: none; font-family: tahoma, geneva, sans-serif;" href="https://www.luxoft-training.ru/timetable/">Расписание курсов</a><?}?>
                                                                    </td>
                                                                    <td style="background: #fff; text-align: right; font-size: 16px; color: #426192; font-weight: bold; padding-right: 28px; vertical-align: middle; font-family: tahoma, geneva, sans-serif;"><img src="/images/digest2018/icon-location.jpg">&nbsp;<?=$arRegion['name']?></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?foreach ($arRegion['items'] as $item){?>
                                                <tr><td class="whitespace" height="10">&nbsp;</td></tr>
                                                <tr>
                                                    <td style="padding: 0 15px;">
                                                        <div class="table-responsive">
                                                            <table border="0" cellpadding="0" cellspacing="0" style="width: 100%">
                                                                <tbody>
                                                                    <tr>
                                                                        <td style="background: #fff; border-bottom: 1px solid #f4f4f4; height: 84px; padding-left: 36px; border-left: 3px solid #426192; vertical-align: middle; width: 400px; padding-right: 15px;">
                                                                            <a style="font-size: 16px; color: #426192; text-decoration: none; font-family: tahoma, geneva, sans-serif;" href="https://www.luxoft-training.ru/training/catalog/course.html?ID=<?=$item['course']['id']?>&ID_TIME=<?=$item['id']?>&<?=$item['utm']?>"
                                                                            ><?=$item['course']["nameFromCatalog"] ?></a><? if($item['icon_sale'] === 'yes') {?><br /><i class="icon new-year" style="color: #fff;font-size: 12px;display: inline-block;line-height: 15px;border-radius: 2px;background: #bf2326;letter-spacing: 0.5px;padding-top: 1px;vertical-align: middle;"><a href="<?=$item['icon_sale_link']?>" style="text-decoration:none;font: inherit;color: #ffffff;">&nbsp;<b style="font-weight: 700;">%</b>Акция&nbsp;</a></i><?}?>
                                                                        </td>
                                                                        <td style="background: #fff; background: #fff; padding-right: 15px;vertical-align: middle;">
                                                                            <table border="0" cellpadding="0" cellspacing="0" style="width: 100%">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td style="border:none; padding-right: 12px; width: 16px;"><img src="/images/digest2018/date.jpg"></td>
                                                                                        <td style="border:none; font-size: 14px; color: #426192; text-align: left; font-family: tahoma, geneva, sans-serif;"><?=$item['date']?></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                        <td style="background: #fff; background: #fff; text-align: right; padding-right: 36px;vertical-align: middle;">
                                                                            <table border="0" cellpadding="0" cellspacing="0" style="width: 100%">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td style="border:none; padding-right: 12px; width: 15px;"><img src="/images/digest2018/time.jpg"></td>
                                                                                        <td style="border:none; font-size: 14px; color: #426192; text-align: left; font-family: tahoma, geneva, sans-serif;"><?=$item['time']?><? if (($item['course']['onlineEnumId'] == "103") or ($item["city"]['id'] == CITY_ID_ONLINE)) {?>(мск.)<?}?></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?}?>
                                        <?$firstRegion = false;}?>
                                        <tr><td class="whitespace" height="20">&nbsp;</td></tr>
                                    <?}?>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?}?>
            <table class="footer" style="background: #fff" cellpadding="0" cellspacing="0" width="750" summary="" align="center">
                <tbody>
                    <tr>
                        <td style="padding: 0 15px;">
                            <table cellpadding="0" cellspacing="0" width="100%">
                                <tbody>
                                    <tr>
                                        <td style="text-align: center; font-size: 21px; font-family: tahoma, geneva, sans-serif; padding: 34px 0; border-bottom: 1px solid #f3f2f2">
								Если у Вас возникли какие-либо вопросы, Вы можете задать их любым удобным для Вас способом:
							            </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 34px 15px 10px 15px;">
                            <table cellpadding="0" cellspacing="0" width="100%">
                                <tbody>
                                    <tr>
                                        <td style="width: 23px; padding-top: 12px;  padding-bottom: 10px;">
                                            <img src="/images/digest2018/email.jpg" width="16">
                                        </td>
                                        <td>
                                            <a style="font-size: 14px; font-family: tahoma, geneva, sans-serif;  color: #426192; text-decoration: none;"
                                               href="mailto:<?=EMAIL_ADDRESS?>"><?=EMAIL_ADDRESS?></a>
                                        </td>
                                        <td style="font-size: 14px; font-family: tahoma, geneva, sans-serif; ">
                                            Москва <b>+7 (495) 609-6967</b>
                                        </td>
                                        <td style="font-size: 14px; font-family: tahoma, geneva, sans-serif; ">
                                            Санкт-Петербург <b>+7 (812) 457-1044</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            style="width: 23px; padding-top: 2px; padding-top: 12px;  padding-bottom: 10px;">
                                            <img src="/images/digest2018/world.jpg" width="16">
                                        </td>
                                        <td>
                                            <a style="font-size: 14px; font-family: tahoma, geneva, sans-serif;  color: #426192; text-decoration: none;"
                                               href="https://www.luxoft-training.ru/">www.luxoft-training.ru</a>
                                        </td>
                                        <td style="font-size: 14px; font-family: tahoma, geneva, sans-serif; ">
                                            Омск <b>+7 (3812) 33-23-08</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            style="width: 23px; padding-top: 2px; padding-top: 12px;  padding-bottom: 10px;">
                                            &nbsp;
                                        </td>
                                        <td>
                                            &nbsp; </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="padding: 20px 15px 10px 15px; font-size: 11px; font-family: tahoma, geneva, sans-serif;  color: rgb(55, 55, 55); padding-bottom: 10px;">
                            Мы приносим извинения, если эта информация попала к Вам по ошибке. Если Вы не хотите больше
                            получать никаких информационных сообщений от Luxoft Training, то Вы можете отписаться, перейдя
                            по следующей <a style="font-family: tahoma, geneva, sans-serif;  color: #373737; "
                                            href="https://www.luxoft-training.ru/unsubscribe/?mid=#MAIL_ID#&amp;mhash=#MAIL_MD5#">ссылке</a>
                            для автоматической отписки.
                        </td>
                    </tr>
                </tbody>
            </table>
        </span>
    </div>
    <!--Конец почтового шаблона-->
</div>
<div class="btn-copy"></div>
<script>
    $(document).on('click','.btn-copy', function () {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($('.digest__message-body').html()).select();
        document.execCommand("copy");
        $temp.remove();
        window.alert('Дайджест скопирован!')
    });
</script>
