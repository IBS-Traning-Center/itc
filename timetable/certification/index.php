<?php
declare(strict_types=1);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle('Расписание Российского центра сертификации ИТ-специалистов');
$APPLICATION->SetPageProperty("title", "Сертификация");
/**
 * @global CMain $APPLICATION
 */
?>
<div class="top-page-banner timetable sertification" style="background-color: <?= $APPLICATION->GetPageProperty('BACKGROUND_COLOR_BANNER') ?>">
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
            <h1><?= $APPLICATION->GetPageProperty('title') ?></h1>
        </div>
    </div>
   
    <div class="container">
        <div class="timetable-type-wrap">
            <?$APPLICATION->IncludeComponent("bitrix:menu", "right-menu-more", Array(
                "ROOT_MENU_TYPE" => "left",	// Тип меню для первого уровня
                "MAX_LEVEL" => "1",	// Уровень вложенности меню
                "CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
                "USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
            ),
                false
            );?>
        </div>   
    </div>
</div>
<section id="content" class="not-main-page">
    <?php
    $APPLICATION->IncludeComponent(
        'itc:certification.list',
        '',
        [],
        false
    );
    ?>
</section>
<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");