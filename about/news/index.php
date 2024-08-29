<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

use Local\Util\Functions;
$APPLICATION->SetPageProperty("blue_title", "Новости обучения разработке ПО");
$APPLICATION->SetPageProperty("title", "Жизнь УЦ IBS");
$APPLICATION->SetPageProperty("keywords", "Новости УЦ IBS, Учебный центр IBS, ИБС, УЦ ИБС, дистанционное обучение, корпоративное обучение, IT семинары, ИТ конференции");
$APPLICATION->SetPageProperty("description", "Новости Учебного центра ИБС: бесплатные семинары, конференции, курсы для программистов, оплата услуг обучения");
$APPLICATION->SetPageProperty("description", "Новости Учебного центра ИБС: бесплатные семинары, конференции, курсы для программистов, оплата услуг обучения");
$APPLICATION->SetPageProperty("SHOW_FULL_PAGE", "Y");
$APPLICATION->SetTitle("Жизнь УЦ IBS");
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
            <h1><?= $APPLICATION->GetPageProperty('title') ?></h1>
        </div>
    </div>
    <div class="container search-item-block">
		<ul class="addition-menu">
			<li <?if ($_REQUEST["type"]=="") {?>class="active"<?}?>><a  href="<?=$APPLICATION->GetCurPageParam("", array("type"))?>">Все материалы</a></li>
			<li <?if ($_REQUEST["type"]=="blog") {?>class="active"<?}?>><a href="<?=$APPLICATION->GetCurPageParam("type=blog", array("type"))?>">Блог</a></li>
            <li <?if ($_REQUEST["type"]=="news") {?>class="active"<?}?>><a href="<?=$APPLICATION->GetCurPageParam("type=news", array("type"))?>">Новости</a></li> 
		</ul>
        <div class="search-item-catalog">
			<form>
				<input type="text" name="news-search" value="<?=$_REQUEST["news-search"]?>" placeholder="Поиск по материалам" />
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M19.6425 11.0896C19.6425 15.919 15.7276 19.8339 10.8982 19.8339C6.06883 19.8339 2.15387 15.919 2.15387 11.0896C2.15387 6.26024 6.06883 2.34528 10.8982 2.34528C15.7276 2.34528 19.6425 6.26024 19.6425 11.0896ZM17.5412 18.6838C15.7665 20.2376 13.4422 21.1792 10.8982 21.1792C5.32585 21.1792 0.808594 16.6619 0.808594 11.0896C0.808594 5.51725 5.32585 1 10.8982 1C16.4705 1 20.9878 5.51725 20.9878 11.0896C20.9878 13.6336 20.0462 15.9579 18.4924 17.7326L22.8086 22.0488L21.8573 23.0001L17.5412 18.6838Z" fill="black"/>
                </svg>
			</form>
		</div>
		<?/*div class="float-right mobile-hidden">Сортировка по:
			<div class="simple-select">
				<a class="title dropdown-link" href="#"><?if ($_REQUEST["sort"]=="popular") {?>популярности<?} else {?>дате<?}?> <i class="fa fa-caret-down" aria-hidden="true"></i></a>
				<ul class="dropdown">
					<li><a href="<?=$APPLICATION->GetCurPageParam("sort=date", array("sort")); ?>">дате</a></li>
					<li><a href="<?=$APPLICATION->GetCurPageParam("sort=popular", array("sort")); ?>">популярности</a></li>
				</ul>
			</div>
		</div*/?>
    </div>
</div>
<?GLOBAL $arrFilter;?>
<?if (strlen($_REQUEST["news-search"]) !== NULL) {
    	$arrFilter = [
            [
                "LOGIC"=> "OR", 
                ["NAME"=> "%".$_REQUEST["news-search"]."%"], 
                ["DETAIL_TEXT"=> "%".$_REQUEST["news-search"]."%"]
            ]
        ];
        if($_REQUEST["type"] == 'blog'){
            $arrFilter[] = ["PROPERTY_news_type_VALUE"=> "Интересная статья"];
        }elseif($_REQUEST["type"] == 'news'){
            $arrFilter[] = [
                [
                    "LOGIC"=> "OR", 
                    ["PROPERTY_news_type_VALUE"=> "Новости УЦ"], 
                    ["PROPERTY_news_type_VALUE"=> "Анонсы (тренингов, мероприятий)"]
                ]
            ];
        }
}else{
        if($_REQUEST["type"] == 'blog'){
            $arrFilter = [
                ["PROPERTY_news_type_VALUE"=> "Интересная статья"], 
            ];
        }elseif($_REQUEST["type"] == 'news'){
            $arrFilter = [
                [
                    "LOGIC"=> "OR", 
                    ["PROPERTY_news_type_VALUE"=> "Новости УЦ"], 
                    ["PROPERTY_news_type_VALUE"=> "Анонсы (тренингов, мероприятий)"]
                ]
            ];
        }
}?>
<div class="container">
    <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"press_releases", 
	array(
		"IBLOCK_TYPE" => "edu",
		"IBLOCK_ID" => "23",
		"NEWS_COUNT" => "8",
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "NAME",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "arrFilter",
		"FIELD_CODE" => array(
			0 => "SHOW_COUNTER",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "abstract",
			2 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "/about/news/#ELEMENT_CODE#/",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_FILTER" => "N",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "j F Y",
		"DISPLAY_PANEL" => "N",
		"SET_TITLE" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "orange",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "press_releases",
		"CACHE_GROUPS" => "Y",
		"SET_BROWSER_TITLE" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_META_DESCRIPTION" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"STRICT_SECTION_CHECK" => "N",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
	false
); ?>
</div>
<div class="container">
    <div class="text-page-block telegram-block">
    <?php $APPLICATION->IncludeFile(
        SITE_DIR . 'include/subcribe_telegram.php', 
        [
            'telegram' => Functions::buildSVG('telegram-big', SITE_TEMPLATE_PATH. '/assets/images/icons'),
        ], 
        ['MODE' => 'html']);
    ?>
    </div>
</div>
<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");