<?php require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');

global $APPLICATION;

$APPLICATION->SetPageProperty('BANNER_TITLE', 'Сведения об образовательной организации');
$APPLICATION->SetPageProperty('BACKGROUND_COLOR_BANNER', '#F8F7F7');
$APPLICATION->SetPageProperty('keywords', 'УЦ IBS, Учебный центр IBS, IBS Training, как проехать Учебный центр IBS, как проехать IBS Training, контакты Учебный центр IBS, контакты IBS Training, телефон Учебный центр IBS, телефон IBS Training, Учебный центр IBS Москва, IBS Training Москва, Учебный центр IBS Санкт-Петербург, IBS Training Санкт-Петербург, Учебный центр IBS Омск, IBS Training Омск, адрес Учебный центр IBS, адрес IBS Training, адрес УЦ IBS, учебный центр ibs');
$APPLICATION->SetPageProperty('description', 'Обучение в сфере разработки и внедрения ПО: онлайн, Москва, Санкт-Петербург, Омск.');
$APPLICATION->SetTitle('Руководство. Педагогический состав');


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
        <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/contacts/management/management.php', [], ['MODE' => 'html', 'NAME' => 'Руководство. Педагогический состав']); ?>
    </div>
</div>

<?php require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');?>