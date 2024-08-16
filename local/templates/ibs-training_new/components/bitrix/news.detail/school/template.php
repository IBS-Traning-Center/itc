<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>
    <div id="header">
        <strong class="logo"><a href="/">LUXOFT TRAINING</a></strong>
        <a href="#overlay-form" class="btn">Зарегистрироваться</a>
        <ul id="nav">
            <li><a href="/summer-promo-2021/">Все летние школы</a></li>
            <li><a href="#s3">Программа</a></li>
            <li><a href="#s1">Тренеры</a></li>
            <li><a href="#s5">Стоимость</a></li>
        </ul>
    </div>

	<div id="main">
        <div class="banner" data-parallax="scroll" style="background-image: url('<?= CFile::GetPath($arResult["PROPERTIES"]["BANNER_COVER"]["VALUE"]) ?>')">
            <div class="wrapper wrapper_<?=$arResult['CODE']?>">
                <?php
                if($arResult["PROPERTIES"]["BANNER_BEFORE_TITLE"]["VALUE"]) {?>
                    <p class="banner__title"><?=$arResult["PROPERTIES"]["BANNER_BEFORE_TITLE"]["VALUE"]?></p>
                <?php }?>
                <?php if($arResult["PROPERTIES"]["BANNER_TITLE"]["VALUE"]) {?>
                    <h1><?=$arResult["PROPERTIES"]["BANNER_TITLE"]["VALUE"]?></h1>
                <?php }?>
                <?php if($arResult["PROPERTIES"]["BANNER_SUBTITLE"]["VALUE"]) {?>
                    <p class="banner__subtitle"><?=$arResult["PROPERTIES"]["BANNER_SUBTITLE"]["VALUE"]?></p>
                <?php }?>
                <p class="banner__date"><?=$arResult['SCHOOL_DATE']?></p>
                <a href="#overlay-form" class="btn">Зарегистрироваться</a>
                <div class="banner__image">
                    <img src="/summer-school/images/rules_detail.svg" alt="">
                </div>
            </div>
        </div>
    </div>
    <?php
    if($arResult["PROPERTIES"]["BANNER_DESCRIPTION"]["VALUE"]) {?>
        <div class="banner__description"><?=$arResult["PROPERTIES"]["BANNER_DESCRIPTION"]["~VALUE"]['TEXT']?></div>
    <?php }?>
    <div class="program">
        <div class="program-b">
            <div class="wrapper">
                <div class="blockrow" id="s3">
                <h2>программа</h2>
                <?php
                if ($arResult["PROPERTIES"]["BLOCK_DESCRIPTION"]["VALUE"]) {?>
                <div class="blockrow">
                    <h3><span class="ico"><img src="/summer-school/images/description@1x.png" alt=""></span>Описание</h3>
                    <?=htmlspecialchars_decode($arResult["PROPERTIES"]["BLOCK_DESCRIPTION"]["VALUE"]["TEXT"])?>
                </div>
                <?php }?>
                <?php
                if ($arResult["PROPERTIES"]["BLOCK_PURPOSE"]["VALUE"]) {?>
                <div class="blockrow">
                    <h3><span class="ico"><img src="/summer-school/images/goals@1x.png" alt=""></span>Цели</h3>
                    <?=htmlspecialchars_decode($arResult["PROPERTIES"]["BLOCK_PURPOSE"]["VALUE"]["TEXT"])?>
                </div>
                <?php }?>
                <?php
                if ($arResult["PROPERTIES"]["BLOCK_THEMES"]["VALUE"]) {?>
                <div class="blockrow">
                    <h3><span class="ico"><img src="/summer-school/images/themes@1x.png" alt=""></span>Разбираемые Темы</h3>
                    <?=htmlspecialchars_decode($arResult["PROPERTIES"]["BLOCK_THEMES"]["VALUE"]["TEXT"])?>
                </div>
                <?php }?>
                <?php
                if ($arResult["PROPERTIES"]["BLOCK_TECHNOLOGY"]["VALUE"]) {?>
                <div class="blockrow">
                    <h3><span class="ico"><img src="/summer-school/images/toolstools@1x.png" alt=""></span>Инструменты и Технологии</h3>
                    <?=htmlspecialchars_decode($arResult["PROPERTIES"]["BLOCK_TECHNOLOGY"]["VALUE"]["TEXT"])?>
                </div>
                <?php }?>
                <?php
                if($arResult["PROPERTIES"]["BLOCK_AUDIENCE"]["VALUE"]) {?>
                <div class="blockrow">
                    <h3><span class="ico"><img src="/summer-school/images/target_audience@1x.png" alt=""></span>Целевая Аудитория</h3>
                    <?=htmlspecialchars_decode($arResult["PROPERTIES"]["BLOCK_AUDIENCE"]["VALUE"]["TEXT"])?>
                </div>
                <?php }?>
                </div>
                <div id="s1">
                    <?php
                    if($arResult['SCHOOL_TEACHERS']) {?>
                        <div class="blockrow">
                                <h3><span class="ico"><img src="/summer-school/images/tutor_icon.png" alt="" style="width: 32px;"></span>Тренеры</h3>
                            <?foreach ($arResult['SCHOOL_TEACHERS'] as $teacher) {?>
                                <div class="person">
                                    <div class="image">
                                        <img src="<?=$teacher['DETAIL_PICTURE']?>" alt="<?=$teacher['NAME']?>">
                                    </div>
                                    <div class="holder trainer-content  ">
                                        <div class="trainer-description">
                                            <h3 class="holder__head"><?=$teacher['NAME']?></h3>
                                            <?if($teacher['PROPERTY_EXPERT_SHORT_VALUE']) {?>
                                            <div class="holder__short-description">
                                                <?=$teacher['PROPERTY_EXPERT_SHORT_VALUE']?>
                                            </div>
                                            <?}?>
                                            <?if($teacher['DETAIL_TEXT']) {?>
                                            <div class="holder__description">
                                                <?=$teacher['DETAIL_TEXT']?>
                                            </div>
                                            <div class="open-link"><a href="#" tabindex="0">Развернуть</a></div>
                                            <?}?>
                                        </div>
                                    </div>
                                </div>
                            <?}?>
                        </div>
                        <?php
                    }?>
                </div>
                <div class="blockrow">
                    <h3><span class="ico"><img src="/summer-school/images/ico05.png" alt=""></span>Состав школы</h3>
                    <div class="table" style="padding-top: 0px; width: 100%;" >
                        <table>
                            <thead>
                            <tr>
                                <th>Название</th>
                                <th>место</th>
                                <th>дата</th>
                                <th>кол-во часов</th>
                                <th>стоимость</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach($arResult['SCHOOL_SCHEDULE'] as $schoolSchedule){?>
                                <tr style="border-bottom: 1px solid #d1dde8">
                                    <td style="border-top:0;"><a target="_blank" href="/kurs/<?=$schoolSchedule["XML_ID"]?>.html"><?=$schoolSchedule["CODE"]?> <?=$schoolSchedule["NAME"]?></a></td>
                                    <td>Онлайн</td>
                                    <?php
                                    if($schoolSchedule["START_DATE"]) {?>
                                        <td><?=$schoolSchedule["START_DATE"]?><?php
                                            if($schoolSchedule["END_DATE"]){?>-<br><?=$schoolSchedule["END_DATE"]?><?php
                                            }?></td>
                                    <?php
                                    } else {?>
                                        <td>Даты на согласовании</td>
                                    <?php
                                    }?>
                                    <td><?=$schoolSchedule["DURATION"]?></td>
                                    <td>
                                        <span style="white-space: nowrap"><?=number_format($schoolSchedule["PRICE"], 0, '', ' ');?> руб.</span>
                                        <?php
                                        if($schoolSchedule["PRICE_UA"]) {?>
                                            <br>
                                            <span style="white-space: nowrap"><?=number_format($schoolSchedule["PRICE_UA"], 0, '', ' ');?> грн.</span>
                                        <?php
                                        }?>
                                    </td>
                                    <td style="border-top:0;"><a class="btn" style="font-size: 15px; line-height: 35px;" target="_blank" href="/kurs/<?=$schoolSchedule["XML_ID"]?>.html">Подробнее</a></td>
                                </tr>
                            <?php
                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
                if($arResult["TOTAL_PRICE"]) {?>
                <div class="price" id="s5">
                    <h2><span>стоимость школы</span></h2>
                    <?php
                    if($arResult['SALE']) {?>
                    <div class="dates">
                        <?php
                        if ($arResult['SALE']) {?>
                            <span>
                                Цена по акции
                                <strong style="color: #d65a50; font-size: 30px"><?=$arResult['SALE']["SUM"]?>&nbsp;руб.</strong>
                                <strong style="color: #d65a50; font-size: 30px"><?=$arResult['SALE']["SUM_UA"]?>&nbsp;грн.</strong>
                            </span>
                        <?php
                        }?>
                        <span>
                            Стандартная цена
                            <strong><?=$arResult["TOTAL_PRICE"]?>&nbsp;руб.</strong>
                            <strong><?=$arResult["TOTAL_PRICE_UA"]?>&nbsp;грн.</strong>
                        </span>
                    </div>
                    <div class="slider">
                        <div class="bar"></div>
                    </div>
                    <?php
                    }?>
                </div>
                <?php
                }?>
                <div class="centered" >
                    <a href="#overlay-form" class="btn">Зарегистрироваться</a>
                </div>
                <div class="bonuses">
                    <div class="bonus-img"><img src="../images/bonus-cert.png"></div>
                    <div class="bonus-txt">После окончания каждого курса выдаётся сертификат на бланке Luxoft Training</div>
                </div>
            </div>
        </div>
    </div>
    <section class="section-box _callback-contacts">
        <div class="section-box__container container">
            <div class="section-box__header">
                <div class="section-box__title"><b>Остались вопросы?</b><br>
                    Получите консультацию менеджера
                </div>
            </div>
            <div class="section-box__content">
                <form class="form callback-mini" name="callback-contacts" data-form-type="webform" data-form-id="37">
                    <div class="form__success">
                        <div class="form__success-message" style="padding: 15px"><b>Спасибо!</b><br>
                            Ваш запрос был получен.<br>
                            В ближайшее время с вами свяжется менеджер<br>
                            <br>
                        </div>
                    </div>
                    <div class="form__content">
                        <div class="fields">
                            <?=bitrix_sessid_post()?>
                            <input type="hidden" name="addField" value="">
                            <input type="hidden" name="school" value="<?=$arResult['NAME']?>">
                            <div class="form-row">
                                <label class="field-box">
                                    <input class="field" type="text" name="name" placeholder="Имя" value="">
                                </label>
                                <label class="field-box">
                                    <input class="field" type="text" name="company" placeholder="Компания" value="">
                                </label>
                            </div>
                            <div class="form-row">
                                <label class="field-box">
                                    <input class="field" type="text" name="email" placeholder="E-mail" value="">
                                </label>
                                <label class="field-box">
                                    <input class="field" type="tel" name="phone" placeholder="Телефон" value="">
                                </label>
                            </div>
                            <div class="form-row">
                                <label class="field-box _wide">
                                    <textarea class="field" name="message" placeholder="Сообщение"></textarea>
                                </label>
                            </div>
                            <br>
                            <label class="agree-text" style="color: #003979"><input checked="checked" name="agree" value="Y" type="checkbox">Настоящим я подтверждаю, что я ознакомлен с <a style="text-decoration: underline;" target="_blank" href="/terms-of-use/">Условиями использования</a>, условия мне понятны и я согласен соблюдать их.</label><br/>
                            <label class="agree-text" style="color: #003979"><input checked="checked" name="agree-2" value="Y" type="checkbox">Я ознакомлен с порядком обработки моих персональных данных согласно <a style="text-decoration: underline; color: #fb9024" target="_blank" href="/privacy-policy/">Политике в сфере персональных данных</a>.</label>
                        </div>
                        <button type="submit" class="button _submit _w-full _size-l"><span>Отправить</span></button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <div class="overlay" id="overlay-form" style="box-sizing: content-box">
        <div class="close"><img src="../images/ico-close.png"></div>
        <div class="over-head">РЕГИСТРАЦИЯ УЧАСТНИКА</div>
        <div style="clear:both"></div>
        <a name="form_b"></a>
        <style type="text/css">.myform {overflow: visible !important;}</style>
        <div id="stylized" class="myform">
            <form name="summer-school" data-form-type="webform" action="/" method="post" enctype="multipart/form-data">
                <?=bitrix_sessid_post()?>
                <input type="hidden" name="addField" value="">
                <input type="hidden" name="MESSAGE_ID" value="231" />
                <input type="hidden" name="NAME" value="Летние школы ‘21 - <?=$arResult['NAME']?>" />
                <input type="hidden" name="MODIFIED_BY" value="<?=$USER->GetID()?>" />
                <input type="hidden" name="IBLOCK_ID" value="64" />
                <input type="hidden" name="ACTIVE" value="Y" />
                <input type="hidden" name="PROPERTY_type" value="79" />
                <input type="hidden" name="PROPERTY_SCHOOL_NAME" value="<?=$arResult["PROPERTIES"]["BANNER_BEFORE_TITLE"]["VALUE"]?>" />
                <input type="hidden" name="PROPERTY_DURATION" value="<?=$arResult['TOTAL_DURATION']?>" />
                <input type="hidden" name="PROPERTY_DATES" value="<?=$arResult['SCHOOL_DATE']?>" />
                <input type="hidden" name="PROPERTY_TIME_EVENT" value="4 часа" />
                <input type="hidden" name="PROPERTY_COST"  value="<?=$arResult['SALE']['SUM']?>" />
                <input type="hidden" name="PROPERTY_COST_UA"  value="<?=$arResult['SALE']['SUM_UA']?>" />
                <input type="hidden" name="PROPERTY_LINK_DISCOUNT" value="<?=$arResult['SALE']['PERCENT']?>" />
                <input type="hidden" name="PROPERTY_CAT_COURSE" value="<?=$arResult['COURSE_ID']?>" />
                <input type="hidden" name="PROPERTY_SCHEDULE_ID"  value="<?=$arResult['SCHEDULE_ID']?>">
                <?if($USER->IsAuthorized()) {?>
                <input type="hidden" name="PROPERTY_USER_ID" value="<?=$USER->GetID()?>" />
                <?}?>
                <div class="field-wrap">
                    ФИО:<span class="req">*</span><br>
                    <input type="text" class="required" name="PROPERTY_fullname" value="" size="25">
                </div>
                <div class="field-wrap" style="width:188px; margin-right: 9px; float: left;">
                    E-mail:<span class="req">*</span><br>
                    <input type="text" value="" style="width: 172px" class="required email" name="PROPERTY_email" size="25">
                </div>
                <div class="field-wrap" style="width:188px; float: left;">
                    Телефон:<span class="req">*</span><br>
                    <input type="text" class="required js-mask-phone" style="width: 205px" value="" name="PROPERTY_telephone" size="25">
                </div>
                <div style="clear:both"></div>
                <div class="field-wrap">
                    Компания:<span class="req">*</span><br>
                    <input type="text" class="required" value="" name="PROPERTY_company" size="25">
                    <div style="display: none;" class="it-label">Сотрудники компании Luxoft подают заявки на курсы и
                        тренинги через систему LuxTalent для получения подтверждения от PPM
                    </div>
                </div>
                <div class="field-wrap">
                    Город:<span class="req">*</span><br>
                    <input type="text" class="required" value="" name="PROPERTY_city" size="25">
                </div>
                <div class="field-wrap">
                    Комментарий:<br>
                    <textarea cols="60" rows="2" name="PROPERTY_COMMENT"></textarea>
                </div>
                <label class="agree-text">
                    <input id="form-reg-agree" checked="checked" name="agree" value="Y" type="checkbox"> Настоящим я подтверждаю, что я ознакомлен с <a style="color: #535353; text-decoration: underline;" target="_blank" href="/terms-of-use/">Условиями использования</a>, условия мне понятны и я согласен
                    соблюдать их.</label>
                <br>
                <label class="agree-text">
                    <input id="form-reg-two" checked="checked" name="agree-2" value="Y" type="checkbox"> Я ознакомлен с порядком обработки моих персональных
                    данных согласно <a style="color: #535353; text-decoration: underline;" target="_blank" href="/privacy-policy/">Политике в сфере персональных данных</a>.
                </label>
                <br>
                <br>
                <input value="Зарегистрироваться" type="submit" class="but main-test-button" id="submit_button_register" name="iblock_submit_tab-record-link">
                <label class="sign-in main-reg-button" id="message_sending" style="display:none; text-align:center;background: #F3F3F3;color:black!important;">Данные отправляются...</label>
            </form>
            <div class="clear"></div>
        </div>
    </div>
    <div class="popup" id="success">
        <div class="popup-t">
            <a href="#" class="close"></a>
            <h3>Вы успешно зарегистрированы!</h3>
        </div>
    </div>
    <style>
        .overlay input[type="text"].error,
        .overlay textarea.error {
            border-color: #f00!important;
        }

        .person .holder {
            position: relative;
        }
        .open-link {
            bottom: -20px;
            background: url(/local/assets/images/white-shadow.png) repeat-x;
            height: 82px;
            position: absolute;
            left: 0;
            text-align: center;
            width: 100%;
            padding-top: 48px;
        }
        .open-link a {
            display: block;
            background: #fff;
        }

        .banner .wrapper {
            max-width: 90%;
            margin-left: auto;
            margin-right: auto;
        }
        .banner .wrapper > * {
            position: relative;
            z-index: 9;
        }
        .section-box__title {
            font-size: 40px;
        }
        .bonus-txt {
            font-size: 21px;
        }
        .banner h1 {
            font-size: 42px;
        }
        .banner__subtitle {
            color: #fff;
            font-size: 32px;
            line-height: 1.2;
            font-weight: 400;
        }
        .slider {
            margin: 0 0 60px;
        }
        .blockrow {
            margin-bottom: 40px;
        }

        .banner {
            position: relative;
            background-position: left bottom;
            background-size: 100% auto;
            background-repeat: no-repeat;
            background-color: #6f9b99;
        }
        .banner__description {
            font-size: 38px;
            color: #fff;
        }
        .banner__description * {
            color: #fff;
            line-height: 1.2;
        }
        .banner__image {
            position: absolute!important;
            z-index: 0!important;
            width: 31%;
            height: 0;
            padding-bottom: 25.5%;
            right: 4%;
            left: auto;
            bottom: 4%;
            margin: auto;
        }
        .wrapper_software-architect .banner__image,
        .wrapper_java-senior .banner__image,
        .wrapper_react .banner__image {
            right: auto;
            left: 4%;
        }

        .blockrow h3 {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            font-size: 32px;
        }

        .banner__all-hours,
        .banner__lessons,
        .banner__hours-day,
        .banner__lesson-type {
            position: relative;
            margin: 0 50px;
        }

        .banner__description {
            margin-left: auto;
            margin-right: auto;
            background-color: #6f9b99;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0 0 60px;
        }

        .banner__all-hours:before,
        .banner__lessons:before,
        .banner__hours-day:before,
        .banner__lesson-type:before {
            content: '';
            display: block;
            width: 64px;
            height: 48px;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            margin: auto;
            background-position: center;
            background-repeat: no-repeat;
            background-size: contain;
            margin-bottom: 15px;
        }
        .banner__all-hours:before {
            background-image: url("/summer-school/images/all-hours.svg");
        }
        .banner__lessons:before {
            background-image: url("/summer-school/images/lessons.svg");
        }
        .banner__hours-day:before {
            background-image: url("/summer-school/images/hours-day.svg");
        }
        .banner__lesson-type:before {
            background-image: url("/summer-school/images/online.svg");
        }

        input[type="text"],
        input[type="tel"],
        input[type="email"],
        input[type="password"],
        textarea.field  ,{
            border: 1.5px solid #7a8891;
            border-radius: 10px;
            height: 44px;
            padding: 0 22px;
            outline: none;
            position: relative;
            font-size: 16px;
            font-family: 'Open Sans', sans-serif;
            width:100%;
        }
        .over-head{
            font-family: 'Open Sans', sans-serif !important;

        }
        .field-wrap, .agree-text{
            font-family: 'Open Sans', sans-serif !important;
            font-size: 12px !important;
            border-radius: 10px;

        }
        .overlay .but{
            font-family: 'Open Sans', sans-serif !important;

        }
        .overlay input[type="text"], .overlay textarea{
            margin-top: 4px;
            border-radius: 10px;
            border: 1px solid #d1dde9 !important;
            font-family: 'Open Sans', sans-serif !important;
            font-size: 14px !important;

        }
        .overlay input[type="text"]:focus, .overlay textarea:focus{
            border-color: #008ed7 !important;
        }
        .overlay textarea{
            resize: none;
            height: 100px;
        }
        .btn{
            transition: all .2s;
        }
        .btn:hover{
            color: #fff !important
        }
        .trainer-content.open .open-link{
            background: none;
        }
        .trainer-content.open .trainer-description{
            height: auto;
        }
        .trainer-description {
            line-height: 1.2;
            font-size: 13px;
            color: #3d3d3d;
            overflow: hidden;
        }
        .holder__description {
            height: 80px;
            /*display: none;*/
            padding-bottom: 0;
            transition: all 0.2s;
        }
        .holder__description.open {
           height: auto;
            padding-bottom: 35px;
            transition: all 0.2s;
        }
        .form .form-row .field-box input{
            border: 1px solid transparent
            transition: all .2s;
        }
        .form .form-row .field-box input:focus{
            border-color: #008ed7 !important
        }
        .form textarea.field{
            font-family:Arial !important;
            font-size: 13px;
            font-weight: 400;
        }
        .form textarea:focus::-webkit-input-placeholder {
            color: transparent
        }

        .form textarea:focus::-moz-placeholder {
            color: transparent
        }

        .form textarea:focus:-moz-placeholder {
            color: transparent
        }

        .form textarea:focus:-ms-input-placeholder {
            color: transparent
        }
        .banner .btn:hover{
            box-shadow: none !important ;
        }
    </style>
    <script>
        console.log(<?=CUtil::PhpToJSObject($arResult['$dates'])?>)
        $(function () {
            $(document).on('click', '.open-link a', function (e) {
                e.preventDefault()
                var $this = $(this)

                if($this.parents('.trainer-description').find('.holder__description').hasClass('open')) {
                    $(this).text('Развернуть')
                    $this.parents('.trainer-description').find('.holder__description').removeClass('open');
                } else  {
                    $(this).text('Свернуть')
                    $this.parents('.trainer-description').find('.holder__description').addClass('open');
                }
            })
        })
        console.log(<?=CUtil::PhpToJSObject($arResult['TOTAL_DURATION'])?>);
    </script>
