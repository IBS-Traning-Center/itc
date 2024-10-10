<?php require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');

global $APPLICATION;

$APPLICATION->SetPageProperty('BANNER_TITLE', 'Сведения об образовательной организации');
$APPLICATION->SetPageProperty('BACKGROUND_COLOR_BANNER', '#F8F7F7');
$APPLICATION->SetPageProperty('keywords', 'Адрес УЦ Luxoft, как проехать Luxoft, контакты Люксофт, телефон Люксофт, Luxoft Москва, luxoft Киев, Люксофт Омск, Luxoft Training, адрес Luxoft Training');
$APPLICATION->SetPageProperty('description', 'Курсы по программированию: Москва, Санкт-Петербург, Омск, Киев, Днепропетровск, Одесса.');
$APPLICATION->SetTitle('Контакты');


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
        <?php $APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"map.list", 
            array(
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "ADD_SECTIONS_CHAIN" => "N",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "3600",
                "CACHE_TYPE" => "N",
                "CHECK_DATES" => "Y",
                "DETAIL_URL" => "",
                "DISPLAY_BOTTOM_PAGER" => "N",
                "DISPLAY_DATE" => "Y",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "DISPLAY_TOP_PAGER" => "N",
                "FIELD_CODE" => array(
                    0 => "",
                    1 => "",
                ),
                "FILTER_NAME" => "",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "IBLOCK_ID" => "119",
                "IBLOCK_TYPE" => "land",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "INCLUDE_SUBSECTIONS" => "N",
                "MESSAGE_404" => "",
                "NEWS_COUNT" => "20",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => ".default",
                "PAGER_TITLE" => "Новости",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "PREVIEW_TRUNCATE_LEN" => "",
                "PROPERTY_CODE" => array(
                    0 => "MAP",
                    1 => "",
                ),
                "SET_BROWSER_TITLE" => "N",
                "SET_LAST_MODIFIED" => "N",
                "SET_META_DESCRIPTION" => "N",
                "SET_META_KEYWORDS" => "N",
                "SET_STATUS_404" => "N",
                "SET_TITLE" => "N",
                "SHOW_404" => "N",
                "SORT_BY1" => "SORT",
                "SORT_BY2" => "ID",
                "SORT_ORDER1" => "ASC",
                "SORT_ORDER2" => "DESC",
                "STRICT_SECTION_CHECK" => "N",
                "COMPONENT_TEMPLATE" => "map.list"
            ),
            false
        );?>
    </div>
</div>

<?php require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');?>