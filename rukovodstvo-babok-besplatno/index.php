<?php

use Bitrix\Main\Page\Asset;

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');

Asset::getInstance()->addCss(SITE_DIR . 'local/assets/css/babok/babok.css');

global $APPLICATION;
$APPLICATION->SetTitle('«Руководство BABOK» на русском языке бесплатно');
$APPLICATION->SetPageProperty("description", "Получите бумажный вариант BABOK Guide на русском языке бесплатно. Пройдите обучение на курсах BABOK, получите необходимые часы профессионального развития (PD hours) для сертификации IIBA, а также бумажную версию «Руководства BABOK» на русском языке в подарок!");
?>

<div class="ruk-babok">
    <div class="top-page-banner">
        <div class="container">
            <div class="banner-content">
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
                <h1><?= $APPLICATION->GetTitle() ?></h1>
                <p class="f-32"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/banok/banner_text.php', [], ['MODE' => 'html', 'NAME' => 'Текст на баннере']); ?></p>
                <a class="btn-main size-l" data-scroll="callback-contacts">
                    <span class="f-24">Оставить заявку</span>
                </a>
            </div>
            <div class="buttons-block-banner">
                <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/banok/banner_image.php', [], ['MODE' => 'html', 'NAME' => 'Картинка на баннере']); ?>
            </div>
        </div>
    </div>
    <div class="possibilities-babok">
        <div class="container">
            <div class="babok-block possib">
                <h2 class="margin-bottom56"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/banok/poss_heading.php', [], ['MODE' => 'html', 'NAME' => 'Возможности Заголовок']); ?></h2>
                <p class="f-32"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/banok/poss_text.php', [], ['MODE' => 'html', 'NAME' => 'Возможности Текст']); ?></p>
            </div>
            <div class="what-babok">
                <h2><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/banok/what_babok_heading.php', [], ['MODE' => 'html', 'NAME' => 'Что такое BABOK Заголовок']); ?></h2>
                <div>
                    <div class="with-border f-20 margin-bottom56">
                        <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/banok/what_babok_text_border.php', [], ['MODE' => 'html', 'NAME' => 'Что такое BABOK Текст']); ?>
                    </div>
                    <div class="flex-babok margin-bottom56">
                        <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/banok/what_babok_icon_1.php', [], ['MODE' => 'html', 'NAME' => 'Что такое BABOK Иконка']); ?>
                        <p class="f-20"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/banok/what_babok_text_1.php', [], ['MODE' => 'html', 'NAME' => 'Что такое BABOK Текст']); ?></p>
                    </div>
                    <div class="flex-babok margin-bottom56">
                        <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/banok/what_babok_icon_2.php', [], ['MODE' => 'html', 'NAME' => 'Что такое BABOK Иконка']); ?>
                        <p class="f-20"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/banok/what_babok_text_2.php', [], ['MODE' => 'html', 'NAME' => 'Что такое BABOK Текст']); ?></p>
                    </div>
                    <div class="flex-babok">
                        <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/banok/what_babok_icon_3.php', [], ['MODE' => 'html', 'NAME' => 'Что такое BABOK Иконка']); ?>
                        <p class="f-20"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/banok/what_babok_text_3.php', [], ['MODE' => 'html', 'NAME' => 'Что такое BABOK Текст']); ?></p>
                    </div>
                </div>
                <div class="what-babok-image">
                    <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/banok/what_babok_image.php', [], ['MODE' => 'html', 'NAME' => 'Что такое BABOK Картинка']); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="babok-block">
        <div class="container">
            <div class="rule-block">
                <h2 class="margin-bottom32"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/banok/rule_heading.php', [], ['MODE' => 'html', 'NAME' => 'Правила Заголовок']); ?></h2>
                <?php $APPLICATION->IncludeComponent(
                    'addamant:babok.rules',
                    '.default',
                    [
                        'CACHE_TIME' => '36000000',
                        'CACHE_TYPE' => 'A',
                    ]
                ); ?>
            </div>
        </div>
    </div>
<section id="banner" class="banner-main-page">
    <?$APPLICATION->IncludeComponent(
        "bitrix:advertising.banner",
        ".default",
        array(
            "TYPE" => "ON_MAIN",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "0"
        ),
        false
    );?>
</section>
<div id="callback-contacts">
    <section class="section-box _callback-contacts">
        <div class="section-box__container container">
            <div class="section-box__header">
                <div class="section-box__title">
                    <b>Зарегистрируйтесь на <a href="/catalog/complex/kp_BA_Middle/" target="_blank">программу</a>, пройдите обучение<br>и получите книгу «Руководство BABOK»</b>
                </div>
            </div>
            <div class="section-box__content">
                <form class="form callback-mini" name="callback-contacts" data-form-type="webform" data-form-id="38">
                    <div class="form__success">
                        <div class="form__success-message">
                            <b>Спасибо.</b>
                            <br>
                            Ваш запрос был получен.
                        </div>
                    </div>
                    <div class="form__content">
                        <div class="fields">
                            <?= bitrix_sessid_post() ?>
                            <input type="hidden" name="addField" value="">
                            <input type="hidden" name="school" value="Промостраница">
                            <div class="form-row">
                                <label class="field-box"> <input class="field" type="text" name="name" placeholder="Имя" value=""></label>
                                <label class="field-box"> <input class="field" type="text" name="company" placeholder="Компания" value=""></label>
                            </div>
                            <div class="form-row">
                                <label class="field-box"> <input class="field" type="text" name="email" placeholder="E-mail" value=""></label>
                                <label class="field-box"> <input class="field" type="tel" name="phone" placeholder="Телефон" value=""></label>
                            </div>
                            <div class="form-row">
                                <label class="field-box _wide">
                                    <textarea class="field" name="message" placeholder="Сообщение"></textarea>
                                </label>
                            </div>
                            <input class="field" type="hidden" name="cid" id="clientID" value="">
                            <br>
                            <label class="agree-text" style="color: #003979">
                                <input name="agree" value="N" type="checkbox">Ознакомлен с <a style="text-decoration: underline;" target="_blank" href="/privacy-policy/">политикой обработки персональных данных</a>
                            </label>
                            <label class="agree-text" required style="color: #003979">
                                <input required name="agree-2" value="N" type="checkbox">Cоглашаюсь с <a style="text-decoration: underline; color: #fb9024" target="_blank" href="/agree_of_subject/">условиями обработки персональных данных</a>
                            </label>
                        </div>
                        <button type="submit" class="button _submit _w-full _size-l">Отправить</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    </div>
    <div class="babok-block telegram">
        <?php $APPLICATION->IncludeComponent(
	"addamant:telegram.subscribe", 
	".default", 
	array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"SUBSCRIBE_TITLE" => "",
		"SUBSCRIBE_LINK" => "https://t.me/IBS_Training_Center",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>
    </div>
</div>

<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>