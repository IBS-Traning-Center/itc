<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

global $APPLICATION;

$APPLICATION->SetPageProperty('BANNER_TITLE', 'Проверка сертификата');
$APPLICATION->SetPageProperty('BACKGROUND_COLOR_BANNER', '#F8F7F7');
$APPLICATION->SetPageProperty('keywords', 'УЦ IBS, Учебный центр IBS, IBS Training, учебный центр ibs, сертификат УЦ IBS, сертификат Учебный центр IBS, сертификат IBS Training, проверка сертификата Учебный центр IBS, проверка сертификата УЦ IBS, проверка сертификата IBS Training');
$APPLICATION->SetPageProperty('description', 'Проверка сертификата УЦ IBS');
$APPLICATION->SetTitle('Проверка сертификата');
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
    </div>
</div>

<div class="text-page-block">
    <div class="container">
        <p style="font-size: 32px;line-height: 44px;margin-bottom: 16px;">Укажите фамилию и номер сертификата. Формат: FF00-00000</p>
        <form>
            <input type="text" pattern="[А-я]" placeholder="Введите фамилию" required/>
            <input type="text" maxlength="10" pattern="[A-Z]{2}[0-9]{2}-[0-9]{5}" placeholder="Введите номер сертификата" required/>
            <input type="submit" value="Проверить"/>
        </form>
    </div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>