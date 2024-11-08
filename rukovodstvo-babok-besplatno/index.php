<?php

use Bitrix\Main\Page\Asset;

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');

Asset::getInstance()->addCss(SITE_DIR . 'local/assets/css/babok/babok.css');

global $APPLICATION;
$APPLICATION->SetTitle('Руководство BABOK бесплатно');
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
                <a class="btn-main size-l" data-scroll="mainFeedbackFormBlock">
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
                    <div class="flex-babok">
                        <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/banok/what_babok_icon_2.php', [], ['MODE' => 'html', 'NAME' => 'Что такое BABOK Иконка']); ?>
                        <p class="f-20"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/banok/what_babok_text_2.php', [], ['MODE' => 'html', 'NAME' => 'Что такое BABOK Текст']); ?></p>
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
    <div class="babok-block telegram">
        <?php $APPLICATION->IncludeComponent(
            "addamant:telegram.subscribe",
            ".default",
            Array(
                "CACHE_TIME" => "3600",
                "CACHE_TYPE" => "A",
                'SUBSCRIBE_TITLE' => '',
                'SUBSCRIBE_LINK' => '#'
            )
        );?>
    </div>
</div>

<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>