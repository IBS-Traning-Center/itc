<?php require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');

global $APPLICATION;

$APPLICATION->SetPageProperty('BANNER_TITLE', 'Сведения об образовательной организации');
$APPLICATION->SetPageProperty('BACKGROUND_COLOR_BANNER', '#F8F7F7');
$APPLICATION->SetPageProperty('keywords', 'Адрес УЦ Luxoft, как проехать Luxoft, контакты Люксофт, телефон Люксофт, Luxoft Москва, luxoft Киев, Люксофт Омск, Luxoft Training, адрес Luxoft Training');
$APPLICATION->SetPageProperty('description', 'Курсы по программированию: Москва, Санкт-Петербург, Омск, Киев, Днепропетровск, Одесса.');
$APPLICATION->SetTitle('Материально-техническое обеспечение');


?>
<div class="top-page-banner" style="background-color: <?= $APPLICATION->GetPageProperty('BACKGROUND_COLOR_BANNER') ?>">
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
            <h1><?= $APPLICATION->GetPageProperty('BANNER_TITLE') ?></h1>
        </div>
        <div class="buttons-block-banner">
            <a class="btn-main size-l" data-scroll="mainFeedbackFormBlock">
                <span class="f-24">Получить консультацию</span>
            </a>
        </div>
    </div>
</div>

<div class="text-page-block container">
    <div class="left-text-menu-block">
        <?php $APPLICATION->IncludeComponent(
            'bitrix:menu',
            'left.menu',
            [
                'ROOT_MENU_TYPE' => 'left',
                'MAX_LEVEL' => '1',
                'CHILD_MENU_TYPE' => 'left',
                'USE_EXT' => 'Y'
            ]
        ); ?>
    </div>
    <div class="main-text-content">
        <h2><?= $APPLICATION->GetTitle() ?></h2>
        <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/contacts/support/support.php', [], ['MODE' => 'html', 'NAME' => 'Материально-техническое обеспечение']); ?>
        <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/contacts/support/support_table1.php', [], ['MODE' => 'html', 'NAME' => 'Материально-техническое обеспечение. Таблица 1']); ?>
        <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/contacts/support/support_table1_mobile.php', [], ['MODE' => 'html', 'NAME' => 'Материально-техническое обеспечение. Таблица 1 мобильная']); ?>
        <div class="text-with-icon">
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="16" cy="16" r="9.5" stroke="#0827C4"/>
                <line x1="16" y1="11" x2="16" y2="18" stroke="#0827C4"/>
                <circle cx="16" cy="21" r="1" fill="#0827C4"/>
            </svg>
            <p class="f-20"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/contacts/support/support_icon_text.php', [], ['MODE' => 'html', 'NAME' => 'Материально-техническое обеспечение. Текст']); ?></p>
        </div>
        <ul class="custom-ul">
            <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/contacts/support/support_ul.php', [], ['MODE' => 'html', 'NAME' => 'Материально-техническое обеспечение. Список']); ?>
        </ul>
        <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/contacts/support/support_table2.php', [], ['MODE' => 'html', 'NAME' => 'Материально-техническое обеспечение. Таблица 2']); ?>
        <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/contacts/support/support_table2_mobile.php', [], ['MODE' => 'html', 'NAME' => 'Материально-техническое обеспечение. Таблица 2 мобильная']); ?>
    </div>
</div>

<?php require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');?>