<?

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Каталог курсов по направлениям | Luxoft Training");
$APPLICATION->SetPageProperty(
    "keywords",
    "тренинги,  процессы разработки, управление требованиями, разработка ПО, тестирование ПО, java, архитектура ПО, oracle, BEA, курсы, обучение в области разработки ПО"
);
$APPLICATION->SetPageProperty(
    "description",
    "Курсы программирования от экспертов-практиков в Luxoft Training. Примеры разработки реальных проектов. Обучение программистов, тестировщиков, аналитиков, менеджеров проектов. Повышение квалификации для ИТ-специалистов."
);
$APPLICATION->SetTitle("Каталог курсов по направлениям");
?>
<script type="text/javascript" src="/static/js/section.js"></script>
<link href="/bitrix/ext/tabs/templates/.default/style.css" type="text/css" rel="stylesheet">
<div class="tabsection-container-default">
    <div class="bg-main-wrap overflow-hidden" style="background: url('/static/images/bg-catalog.jpg') center 0; background-size: cover;">
        <div class="frame ">
            <? $APPLICATION->IncludeComponent(
                "bitrix:breadcrumb",
                "bread",
                array(
                    "START_FROM" => "0",
                    // Номер пункта, начиная с которого будет построена навигационная цепочка
                    "PATH" => "",
                    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                    "SITE_ID" => "ru",
                    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                ),
                false
            ); ?>
            <div class="clearfix heading-white">
                <h1>Каталог курсов по направлениям</h1>
                <div class="catalog-info-links">
                    <?php $randomString = \Bitrix\Main\Security\Random::getString(10);?>
                    <a target="_blank" class="js-tracking" data-type="Catalog" data-action="CatalogDownload"
                       href="/files/ibs-training-catalog.pdf?=<?=$randomString?>"><i class="fa fa-book" aria-hidden="true"></i>
                        Скачать каталог</a>
                </div>
            </div>
            <? $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "right-menu-more",
                array(
                    "ROOT_MENU_TYPE" => "left",    // Тип меню для первого уровня
                    "MAX_LEVEL" => "1",    // Уровень вложенности меню
                    "CHILD_MENU_TYPE" => "left",    // Тип меню для остальных уровней
                    "USE_EXT" => "Y",    // Подключать файлы с именами вида .тип_меню.menu_ext.php
                ),
                false
            ); ?>
            <div id="banner" class="banner-main-page">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:advertising.banner",
                    ".default",
                    array(
                        "COMPONENT_TEMPLATE" => ".default",
                        "TYPE" => "ON_MAIN",
                        "NOINDEX" => "Y",
                        "QUANTITY" => "1",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "0"
                    ),
                    false
                ); ?>
            </div>
            <? $APPLICATION->IncludeComponent(
                "bitrix:catalog.section.list",
                "course-section-new",
                array(
                    "IBLOCK_TYPE" => "edu_const",
                    "IBLOCK_ID" => "94",
                    "SECTION_ID" => "",
                    "COUNT_ELEMENTS" => "Y",
                    "TOP_DEPTH" => "4",
                    "SECTION_FIELDS" => array(
                        0 => "",
                        1 => "",
                    ),
                    "SECTION_USER_FIELDS" => array(
                        0 => "",
                        1 => "",
                    ),
                    "SECTION_URL" => "",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "36000000",
                    "CACHE_GROUPS" => "Y",
                    "ADD_SECTIONS_CHAIN" => "Y"
                ),
                false
            ); ?></div>
    </div>
    <? if (strlen($_REQUEST["qcat"]) > 0) {
        $APPLICATION->IncludeComponent(
            "luxoft:super.component",
            "section-items-list-search",
            array(
                "CACHE_TYPE" => "N",    // Тип кеширования
                "CACHE_TIME" => "3600",    // Время кеширования (сек.)
                "ID_IBLOCK" => "94",    // Идентификатор Инфоблока
                "SORT_BY" => "SORT",
                "SECTION_CODE" => ""
            ),
            false
        );
    } ?>
</div>
<style>
    .section-box._callback-mini-background {
        padding: 0;
    }
    .section-box._callback-mini-background .section-box__container {
        transform: scale(0.7);
    }
</style>
<section class="section-box _callback-mini-background">
    <div class="section-box__container container">
        <div class="section-box__header">
            <div class="section-box__title _white"><b>Ищете нестандартное решение?</b><br>
                Наши эксперты помогут!</div>
        </div>
        <div class="section-box__content">
            <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH.'/include/callback-mini.php', [], ['MODE' => 'html']);?>
        </div>
    </div>
</section>
<script type="text/javascript" src="http://flesler-plugins.googlecode.com/files/jquery.scrollTo-1.4.2-min.js"></script>
<script>
    $(document).ready(function () {
        var currentHash;
        currentHash = window.location.hash.slice(1);

        if (currentHash === 'methodology') {
            $("#tr_catalog ul li#cat_522").removeClass('expandable').addClass('collapsable');
            $("#tr_catalog ul li#cat_522 div.hitarea").removeClass('expandable-hitarea').addClass('collapsable-hitarea');
            $("#tr_catalog ul li#cat_522 ul").show();
            $.scrollTo('#tr_catalog ul li#cat_522', 800);
        }

        if (currentHash === 'test') {
            $("#tr_catalog ul li#cat_461").removeClass('expandable').addClass('collapsable');
            $("#tr_catalog ul li#cat_461 div.hitarea").removeClass('expandable-hitarea').addClass('collapsable-hitarea');
            $("#tr_catalog ul li#cat_461 ul").show();
            $.scrollTo('#tr_catalog ul li#cat_461', 800);
        }
        if (currentHash === 'pm') {
            $("#tr_catalog ul li#cat_530").removeClass('expandable').addClass('collapsable');
            $("#tr_catalog ul li#cat_530 div.hitarea").removeClass('expandable-hitarea').addClass('collapsable-hitarea');
            $("#tr_catalog ul li#cat_530 ul").show();
            $.scrollTo('#tr_catalog ul li#cat_530', 800);
        }
        if (currentHash === 'developer') {
            $("#tr_catalog ul li#cat_482").removeClass('expandable').addClass('collapsable');
            $("#tr_catalog ul li#cat_482 div.hitarea").removeClass('expandable-hitarea').addClass('collapsable-hitarea');
            $("#tr_catalog ul li#cat_482 ul").show();
            $.scrollTo('#tr_catalog ul li#cat_482', 800);
        }
        if (currentHash === 'itservice') {
            $("#tr_catalog ul li#cat_520").removeClass('expandable').addClass('collapsable');
            $("#tr_catalog ul li#cat_520 div.hitarea").removeClass('expandable-hitarea').addClass('collapsable-hitarea');
            $("#tr_catalog ul li#cat_520 ul").show();
            $.scrollTo('#tr_catalog ul li#cat_520', 800);
        }
        if (currentHash === 'analytics') {
            $("#tr_catalog ul li#cat_448").removeClass('expandable').addClass('collapsable');
            $("#tr_catalog ul li#cat_448 div.hitarea").removeClass('expandable-hitarea').addClass('collapsable-hitarea');
            $("#tr_catalog ul li#cat_448 ul").show();
            $.scrollTo('#tr_catalog ul li#cat_448', 800);
        }
        if (currentHash === 'developer-java') {
            $("#tr_catalog ul li#cat_482").removeClass('expandable').addClass('collapsable');
            $("#tr_catalog ul li#cat_482").find('div.hitarea:first').removeClass('expandable-hitarea').addClass('collapsable-hitarea');
            $("#tr_catalog ul li#cat_482").find('ul:first').show();
            $("#tr_catalog ul li#cat_526").removeClass('expandable').addClass('collapsable');
            $("#tr_catalog ul li#cat_526").find('div.hitarea:first').removeClass('expandable-hitarea').addClass('collapsable-hitarea');
            $("#tr_catalog ul li#cat_526").find('ul:first').show();
            $.scrollTo('#tr_catalog ul li#cat_526', 800);
        }

        if (currentHash === 'developer-net') {
            $("#tr_catalog ul li#cat_482").removeClass('expandable').addClass('collapsable');
            $("#tr_catalog ul li#cat_482").find('div.hitarea:first').removeClass('expandable-hitarea').addClass('collapsable-hitarea');
            $("#tr_catalog ul li#cat_482").find('ul:first').show();
            $("#tr_catalog ul li#cat_524").removeClass('expandable').addClass('collapsable');
            $("#tr_catalog ul li#cat_524").find('div.hitarea:first').removeClass('expandable-hitarea').addClass('collapsable-hitarea');
            $("#tr_catalog ul li#cat_524").find('ul:first').show();
            $.scrollTo('#tr_catalog ul li#cat_524', 800);
        }

        if (currentHash === 'arch') {
            $("#tr_catalog ul li#cat_529").removeClass('expandable').addClass('collapsable');
            $("#tr_catalog ul li#cat_529 div.hitarea").removeClass('expandable-hitarea').addClass('collapsable-hitarea');
            $("#tr_catalog ul li#cat_529 ul").show();
            $.scrollTo('#tr_catalog ul li#cat_529', 800);
        }
        if (currentHash === 'admin') {
            $("#tr_catalog ul li#cat_509").removeClass('expandable').addClass('collapsable');
            $("#tr_catalog ul li#cat_509 div.hitarea").removeClass('expandable-hitarea').addClass('collapsable-hitarea');
            $("#tr_catalog ul li#cat_509 ul").show();
            $.scrollTo('#tr_catalog ul li#cat_509', 800);
        }
        if (currentHash === 'business') {
            $("#tr_catalog ul li#cat_584").removeClass('expandable').addClass('collapsable');
            $("#tr_catalog ul li#cat_584 div.hitarea").removeClass('expandable-hitarea').addClass('collapsable-hitarea');
            $("#tr_catalog ul li#cat_584 ul").show();
            $.scrollTo('#tr_catalog ul li#cat_584', 800);
        }
        if (currentHash === 'soft') {
            $("#tr_catalog ul li#cat_521").removeClass('expandable').addClass('collapsable');
            $("#tr_catalog ul li#cat_512 div.hitarea").removeClass('expandable-hitarea').addClass('collapsable-hitarea');
            $("#tr_catalog ul li#cat_521 ul").show();
            $.scrollTo('#tr_catalog ul li#cat_521', 800);
        }
        if (currentHash === 'exp') {
            $("#tr_catalog ul li#cat_533").removeClass('expandable').addClass('collapsable');
            $("#tr_catalog ul li#cat_533 div.hitarea").removeClass('expandable-hitarea').addClass('collapsable-hitarea');
            $("#tr_catalog ul li#cat_533 ul").show();
            $.scrollTo('#tr_catalog ul li#cat_533', 800);
        }
        if (currentHash === 'recrut') {
            $("#tr_catalog ul li#cat_590").removeClass('expandable').addClass('collapsable');
            $("#tr_catalog ul li#cat_590 div.hitarea").removeClass('expandable-hitarea').addClass('collapsable-hitarea');
            $("#tr_catalog ul li#cat_590 ul").show();
            $.scrollTo('#tr_catalog ul li#cat_590', 800);
        }
        if (currentHash === 'sec') {
            $("#tr_catalog ul li#cat_609").removeClass('expandable').addClass('collapsable');
            $("#tr_catalog ul li#cat_609 div.hitarea").removeClass('expandable-hitarea').addClass('collapsable-hitarea');
            $("#tr_catalog ul li#cat_609 ul").show();
            $.scrollTo('#tr_catalog ul li#cat_609', 800);
        }
    });
</script>
<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
