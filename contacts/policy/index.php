<?php require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');

global $APPLICATION;

$APPLICATION->SetPageProperty('BANNER_TITLE', 'Сведения об образовательной организации');
$APPLICATION->SetPageProperty('BACKGROUND_COLOR_BANNER', '#F8F7F7');
$APPLICATION->SetPageProperty('keywords', 'Адрес УЦ Luxoft, как проехать Luxoft, контакты Люксофт, телефон Люксофт, Luxoft Москва, luxoft Киев, Люксофт Омск, Luxoft Training, адрес Luxoft Training');
$APPLICATION->SetPageProperty('description', 'Курсы по программированию: Москва, Санкт-Петербург, Омск, Киев, Днепропетровск, Одесса.');
$APPLICATION->SetTitle('Политика в сфере персональных данных');


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
            <a class="btn-main size-l" href="#mainFeedbackFormBlock">
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
        <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/contacts/policy/policy.php', [], ['MODE' => 'html', 'NAME' => 'Политика в сфере персональных данных']); ?>
        <div class="quote-block">
            <div class="icon">
                <svg width="64" height="48" viewBox="0 0 64 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.3191 25.4443C12.1313 36.043 3.18539 41.7003 0 43.2472L1.49722 47.0588C7.48612 45.0182 25.1637 37.1599 25.41 15.4871V15.4852H25.4118V0H0.485393V25.4443H14.3191ZM52.7332 25.4443C50.5453 36.043 41.5995 41.7003 38.4141 43.2472L39.9113 47.0588C45.9002 45.0182 63.5778 37.1599 63.824 15.4852H63.8258V0H38.8995V25.4443H52.7332Z" fill="#0827C4"/>
                </svg>
            </div>
            <div class="text">
                <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/contacts/policy/policy_quote.php', [], ['MODE' => 'html', 'NAME' => 'Политика в сфере персональных данных. Цитата']); ?>
            </div>
        </div>
    </div>
</div>

<?php require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');?>