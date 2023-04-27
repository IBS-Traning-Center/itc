<?php
declare(strict_types=1);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle('Расписание Российского центра сертификации ИТ-специалистов');
/**
 * @global CMain $APPLICATION
 */
?>
    <section class="bg-main-wrap" style="background: url('/static/images/bg-catalog.jpg') center 0; background-size: cover;">
        <div class="frame">
            <div class="breadcrumbs clearfix">
                <a class="breadcrumb-item" href="/">Главная</a>
                <a class="breadcrumb-item" href="/timetable/">Раcписание</a>
                <a class="breadcrumb-item" href="#">Сертификация</a>

            </div>
            <div class="clearfix heading-white">
                <h1>Расписание сертификации</h1>
            </div>
            <?php
            $APPLICATION->IncludeComponent("bitrix:menu", "right-menu-more", Array(
                "ROOT_MENU_TYPE" => "left",	// Тип меню для первого уровня
                "MAX_LEVEL" => "1",	// Уровень вложенности меню
                "CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
                "USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
            ),
                false
            );?>
        </div>
    </section>
    <?php
    $APPLICATION->IncludeComponent(
        'itc:certification.list',
        '',
        [],
        false
    );
    ?>
<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");