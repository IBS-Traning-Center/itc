<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("blue_title", "Новости обучения разработке ПО");
$APPLICATION->SetPageProperty("title", "Новости обучения программированию");
$APPLICATION->SetPageProperty("keywords", "Новости УЦ IBS, Учебный центр IBS, ИБС, УЦ ИБС, дистанционное обучение, корпоративное обучение, IT семинары, ИТ конференции");
$APPLICATION->SetPageProperty("description", "Новости Учебного центра ИБС: бесплатные семинары, конференции, курсы для программистов, оплата услуг обучения");
$APPLICATION->SetPageProperty("description", "Новости Учебного центра ИБС: бесплатные семинары, конференции, курсы для программистов, оплата услуг обучения");
$APPLICATION->SetPageProperty("SHOW_FULL_PAGE", "Y");

$APPLICATION->SetTitle("Новости обучения разработке ПО");
?>

<div class="bg-main-wrap" style="background: url('/static/images/bg-catalog.jpg') center 0; background-size: cover;">
		<div class="frame">
			<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "bread", Array(
				"START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
					"PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
					"SITE_ID" => "s1",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
				),
				false
			);?>
			<div class="clearfix heading-white">
				<h1>Блоги</h1>
			</div>
			
			<div class="search-item-catalog">
				<form>
					<input type="text" name="news-search" value="<?=$_REQUEST["news-search"]?>" placeholder="Поиск по блогу" />
				</form>
				<?/*<div class="tags">
					<ul>
						<li><a href="#">.NET</a></li>
						<li><a href="#">Agile</a></li>
						<li><a href="#">AOP</a></li>
						<li><a href="#">Architicture</a></li>
						<li><a href="#">async</a></li>
						<li><a href="#">automation</a></li>
						<li><a href="#">Automatization</a></li>
						<li><a href="#">Build Enviroment</a></li>
						<li><a href="#">C#</a></li>
						<li><a href="#">C++</a></li>
					</ul>
				</div>
				*/?>
			</div>
			<div class="clearfix">

			<ul class="addition-menu no-y-margin float-left">
				<li <?if ($_REQUEST["filter"]!="popular") {?>class="active"<?}?>><a  href="<?=$APPLICATION->GetCurPageParam("", array("filter"))?>">Все записи </a></li>
				<li <?if ($_REQUEST["filter"]=="popular") {?>class="active"<?}?>><a href="<?=$APPLICATION->GetCurPageParam("filter=popular", array("filter"))?>">Популярные </a></li> 
			</ul>

			<div class="float-right mobile-hidden">Сортировка по:
				<div class="simple-select">
					<a class="title dropdown-link" href="#"><?if ($_REQUEST["sort"]=="popular") {?>популярности<?} else {?>дате<?}?> <i class="fa fa-caret-down" aria-hidden="true"></i></a>
					<ul class="dropdown">
						<li><a href="<?=$APPLICATION->GetCurPageParam("sort=date", array("sort")); ?>">дате</a></li>
						<li><a href="<?=$APPLICATION->GetCurPageParam("sort=popular", array("sort")); ?>">популярности</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<?GLOBAL $arrFilter;?>
<?if (strlen($_REQUEST["news-search"])>0) {
	$arrFilter=array(array("LOGIC"=> "OR", array("NAME"=> "%".$_REQUEST["news-search"]."%"), array("DETAIL_TEXT"=> "%".$_REQUEST["news-search"]."%")));
}?>
<?$sort="ACTIVE_FROM"?>
<?if ($_REQUEST["sort"]=="popular") {?>
	<?$sort="SHOW_COUNTER"?>
<?}?>
<?GLOBAL $arrFilter;?>
<?if ($_REQUEST["filter"]=="popular") {?>
	<?$arrFilter[">SHOW_COUNTER"]="3000"?>
<?}?>
<?
$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "press_releases",
    array(
        "IBLOCK_TYPE" => "edu",
        "IBLOCK_ID" => "23",
        "NEWS_COUNT" => "10",
        "SORT_BY1" => $sort,
        "SORT_ORDER1" => "DESC",
        "SORT_BY2" => "SORT",
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
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
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
        "PAGER_TEMPLATE" => "",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "N",
        "DISPLAY_PICTURE" => "N",
        "DISPLAY_PREVIEW_TEXT" => "N",
        "AJAX_OPTION_ADDITIONAL" => ""
    ),
    false
); ?>
    <style>
        .section-box._subscribe {
            padding: 0;
        }
        .section-box._subscribe .section-box__container {
            transform: scale(0.7);
        }
    </style>
    <section class="section-box _subscribe">
        <div class="section-box__container container">
            <div class="section-box__header">
                <div class="section-box__title _white">Как не пропустить <b>самое интересное?</b></div>
                <div class="section-box__subtitle _white">Подписывайтесь на наш ежемесячный дайджест!</div>
            </div>
            <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH.'/include/subscribe.php', [], ['MODE' => 'html']);?>
        </div>
    </section>
<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");