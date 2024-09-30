<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

global $APPLICATION;

$APPLICATION->SetPageProperty('BANNER_TITLE', 'Разработка тестов для IT-специалистов по ключевым компетенциям');
$APPLICATION->SetPageProperty('BACKGROUND_COLOR_BANNER', '#F8F7F7');
$APPLICATION->SetTitle('Тестирование сотрудников IT-подразделения');
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
            <p class="f-32"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing/heading_text.php', [], ['MODE' => 'html', 'NAME' => 'Текст под заголовком']); ?></p>
        </div>
        <div class="buttons-block-banner">
            <a class="btn-main size-l" href="#mainFeedbackFormBlock">
                <span class="f-24">Получить консультацию</span>
            </a>
        </div>
    </div>
</div>


<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>