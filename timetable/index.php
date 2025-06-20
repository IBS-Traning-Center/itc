<?php

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetPageProperty("description", "Ближайшие курсы для IT-специалистов.");
$APPLICATION->SetPageProperty("title", "Расписание");

use Local\Util\Functions;
/*
    Для Weekly формируем страницу без цен
*/
if (!isset($_SESSION['SHOW_PRICE'])){
    $_SESSION['SHOW_PRICE'] = "Y";
}

if (isset($_REQUEST['SHOW_PRICE'])) {
    if (($_REQUEST['SHOW_PRICE'] == "Y") or ($_REQUEST['SHOW_PRICE'] == "N")){
        $_SESSION['SHOW_PRICE'] = $_REQUEST['SHOW_PRICE'];
    }
}

$APPLICATION->SetPageProperty("id_city", $id_city);

$id_type = 2;    //курсы
$bOnline = false;
$ID_IBLOCK = 9;
if (isset($_GET["type"])) {
    switch ($_GET["type"]) {
        case "courses":
            $id_type = 2;
            $ID_IBLOCK = 9;
            
            break;
        case "events":
            $id_type =3;
            $ID_IBLOCK = 65;
            $APPLICATION->SetPageProperty("title", "Бесплатные семинары");
            $APPLICATION->AddChainItem("Бесплатные семинары");
            break;
        case "schools":
            $id_type =1;
            break;
        case "online":
            $id_type =4;
            break;
    }
}

if (isset($_GET["online"])) {
    $bOnline  = true;
}
//echo "$bOnline =bOnline";
/* поиск колв-ва */


// создаем объект
$obCache = new CPHPCache;
// время кеширования - 30 минут
$life_time = 5*60;
// формируем идентификатор кеша в зависимости от всех параметров
// которые могут повлиять на результирующий HTML
$cache_id = 5743;

// если кеш есть и он ещё не истек, то
if($obCache->InitCache($life_time, $cache_id, "/")) {
    // получаем закешированные переменные
    $vars = $obCache->GetVars();
    $sch_in_moscow = $vars["sch_in_moscow"];
    $sch_in_omsk = $vars["sch_in_omsk"];
    $sch_in_spb = $vars["sch_in_spb"];
    $sch_in_kiev = $vars["sch_in_kiev"];
    $sch_in_odessa = $vars["sch_in_odessa"];
    $sch_in_dnepr = $vars["sch_in_dnepr"];
    $sch_in_online = $vars["sch_in_online"];
    $res_in_moscow = $vars["res_in_moscow"];
    $res_in_omsk = $vars["res_in_omsk"];
    $res_in_spb = $vars["res_in_spb"];
    $res_in_kiev = $vars["res_in_kiev"];
    $res_in_odessa = $vars["res_in_odessa"];
    $res_in_dnepr = $vars["res_in_dnepr"];
    $res_in_online = $vars["res_in_online"];
    $res_in_novorossiysk = $vars["res_in_novorossiysk"];
    $sch_in_novorossiysk = $vars["sch_in_novorossiysk"];
    $res_in_minsk = $vars["res_in_minsk"];
    $sch_in_minsk = $vars["sch_in_minsk"];
    $res_in_nijni = $vars["res_in_nijni"];
    $sch_in_nijni = $vars["sch_in_nijni"];
    $res_in_nsk = $vars["res_in_nsk"];
    $sch_in_nsk = $vars["sch_in_nsk"];
    // иначе обращаемся к базе
}
else
{
    if(CModule::IncludeModule("iblock"))
    {
        $arGroupBy  = Array();$arOrder = Array();
        $arSelectFields = Array("ID");
        $arFilter = Array("IBLOCK_ID"=>10, "ACTIVE"=>"Y", "PROPERTY_city"=>5741, ">=PROPERTY_startdate" => ConvertDateTime(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()), "YYYY-MM-DD", "ru"));
        $sch_in_moscow = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);
        $arFilter = Array("IBLOCK_ID"=>10, "ACTIVE"=>"Y", "PROPERTY_city"=>5742, ">=PROPERTY_startdate" => ConvertDateTime(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()), "YYYY-MM-DD", "ru"));
        $sch_in_omsk = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);
        $arFilter = Array("IBLOCK_ID"=>10, "ACTIVE"=>"Y", "PROPERTY_city"=>5744, ">=PROPERTY_startdate" => ConvertDateTime(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()), "YYYY-MM-DD", "ru"));
        $sch_in_spb = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);
        $arFilter = Array("IBLOCK_ID"=>10, "ACTIVE"=>"Y", "PROPERTY_city"=>5745, ">=PROPERTY_startdate" => ConvertDateTime(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()), "YYYY-MM-DD", "ru"));
        $sch_in_kiev = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);
        $arFilter = Array("IBLOCK_ID"=>10, "ACTIVE"=>"Y", "PROPERTY_city"=>5746, ">=PROPERTY_startdate" => ConvertDateTime(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()), "YYYY-MM-DD", "ru"));
        $sch_in_odessa = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);
        $arFilter = Array("IBLOCK_ID"=>10, "ACTIVE"=>"Y", "PROPERTY_city"=>5747, ">=PROPERTY_startdate" => ConvertDateTime(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()), "YYYY-MM-DD", "ru"));
        $sch_in_dnepr = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);
        $arFilter = Array("IBLOCK_ID"=>10, "ACTIVE"=>"Y", "PROPERTY_city"=>14909, ">=PROPERTY_startdate" => ConvertDateTime(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()), "YYYY-MM-DD", "ru"));
        $sch_in_online = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);
        $arFilter = Array("IBLOCK_ID"=>10, "ACTIVE"=>"Y", "PROPERTY_city"=>CITY_ID_NOVOROSSIYSK, ">=PROPERTY_startdate" => ConvertDateTime(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()), "YYYY-MM-DD", "ru"));
        $sch_in_novorossiysk = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);
        $arFilter = Array("IBLOCK_ID"=>10, "ACTIVE"=>"Y", "PROPERTY_city"=>CITY_ID_MINSK, ">=PROPERTY_startdate" => ConvertDateTime(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()), "YYYY-MM-DD", "ru"));
        $sch_in_minsk = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);
        $arFilter = Array("IBLOCK_ID"=>10, "ACTIVE"=>"Y", "PROPERTY_city"=>CITY_ID_NOVOSIBIRSK, ">=PROPERTY_startdate" => ConvertDateTime(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()), "YYYY-MM-DD", "ru"));
        $sch_in_nsk = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);
        $arFilter = Array("IBLOCK_ID"=>10, "ACTIVE"=>"Y", "PROPERTY_city"=>48573, ">=PROPERTY_startdate" => ConvertDateTime(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()), "YYYY-MM-DD", "ru"));
        $sch_in_nijni = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);

        $arGroupBy  = Array();$arOrder = Array();
        $arSelectFields = Array("ID");
        $arFilter = Array("IBLOCK_ID"=>9, "ACTIVE"=>"Y", "PROPERTY_city"=>5741, ">=PROPERTY_startdate" => ConvertDateTime(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()), "YYYY-MM-DD", "ru"));
        $res_in_moscow = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);
        $arFilter = Array("IBLOCK_ID"=>9, "ACTIVE"=>"Y", "PROPERTY_city"=>5742, ">=PROPERTY_startdate" => ConvertDateTime(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()), "YYYY-MM-DD", "ru"));
        $res_in_omsk = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);
        $arFilter = Array("IBLOCK_ID"=>9, "ACTIVE"=>"Y", "PROPERTY_city"=>5744, ">=PROPERTY_startdate" => ConvertDateTime(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()), "YYYY-MM-DD", "ru"));
        $res_in_spb = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);
        $arFilter = Array("IBLOCK_ID"=>9, "ACTIVE"=>"Y", "PROPERTY_city"=>5745, ">=PROPERTY_startdate" => ConvertDateTime(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()), "YYYY-MM-DD", "ru"));
        $res_in_kiev = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);
        $arFilter = Array("IBLOCK_ID"=>9, "ACTIVE"=>"Y", "PROPERTY_city"=>5746, ">=PROPERTY_startdate" => ConvertDateTime(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()), "YYYY-MM-DD", "ru"));
        $res_in_odessa = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);
        $arFilter = Array("IBLOCK_ID"=>9, "ACTIVE"=>"Y", "PROPERTY_city"=>5747, ">=PROPERTY_startdate" => ConvertDateTime(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()), "YYYY-MM-DD", "ru"));
        $res_in_dnepr = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);
        $arFilter = Array("IBLOCK_ID"=>9, "ACTIVE"=>"Y", "PROPERTY_city"=>14909, ">=PROPERTY_startdate" => ConvertDateTime(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()), "YYYY-MM-DD", "ru"));
        $res_in_online = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);
        $arFilter = Array("IBLOCK_ID"=>9, "ACTIVE"=>"Y", "PROPERTY_city"=>CITY_ID_NOVOROSSIYSK, ">=PROPERTY_startdate" => ConvertDateTime(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()), "YYYY-MM-DD", "ru"));
        $res_in_novorossiysk = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);
        $arFilter = Array("IBLOCK_ID"=>9, "ACTIVE"=>"Y", "PROPERTY_city"=>48573, ">=PROPERTY_startdate" => ConvertDateTime(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()), "YYYY-MM-DD", "ru"));
        $res_in_nijni = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);

        $arFilter = Array("IBLOCK_ID"=>9, "ACTIVE"=>"Y", "PROPERTY_city"=>CITY_ID_MINSK, ">=PROPERTY_startdate" => ConvertDateTime(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()), "YYYY-MM-DD", "ru"));
        $res_in_minsk = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);
        $arFilter = Array("IBLOCK_ID"=>9, "ACTIVE"=>"Y", "PROPERTY_city"=>CITY_ID_NOVOSIBIRSK, ">=PROPERTY_startdate" => ConvertDateTime(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()), "YYYY-MM-DD", "ru"));
        $res_in_nsk = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);
    }
}
// начинаем буферизирование вывода
if($obCache->StartDataCache()) {
    // записываем предварительно буферизированный вывод в файл кеша
    // вместе с дополнительной переменной
    $obCache->EndDataCache(array(
        "sch_in_moscow"    => $sch_in_moscow,
        "sch_in_omsk"    => $sch_in_omsk,
        "sch_in_spb"    => $sch_in_spb,
        "sch_in_kiev"    => $sch_in_kiev,
        "sch_in_odessa"    => $sch_in_odessa,
        "sch_in_dnepr"    => $sch_in_dnepr,
        "sch_in_online"    => $sch_in_online,
        "sch_in_novorossiysk"    => $sch_in_novorossiysk,
        "res_in_moscow"    => $res_in_moscow,
        "res_in_omsk"    => $res_in_omsk,
        "res_in_spb"    => $res_in_spb,
        "res_in_kiev"    => $res_in_kiev,
        "res_in_odessa"    => $res_in_odessa,
        "res_in_dnepr"    => $res_in_dnepr,
        "res_in_online"    => $res_in_online,
        "res_in_novorossiysk"    => $res_in_novorossiysk,
        "res_in_minsk"    => $res_in_minsk,
        "sch_in_minsk"    => $sch_in_minsk,
        "res_in_nijni"	=>$res_in_nijni,
        "sch_in_nijni"	=>$sch_in_nijni,
        "res_in_nsk"    => $res_in_nsk,
        "sch_in_nsk"    => $sch_in_nsk,
    ));
}
//iwrite($res_in_online);
// for minsk: "res_in_minsk"    => $res_in_minsk,
//$id_city ="5741" //Москва
/*
5742  - омск
5744  - спб
5745  - киев
5746  - одесса
5747   - днепр
14909 - онлайн
*/
if ($_REQUEST["type"] == "online")
{
    $id_city = 14909;
}
if ($id_city != 14909)
{
    $id_city = $_SESSION["cityID"];
}

$data = date("Y-m-d H:i:s");
$GLOBALS["arrFilter"]["IBLOCK_ID"] = 9;
$GLOBALS["arrFilter"] = array("PROPERTY_city" => array($id_city, 14909), "ACTIVE" => "Y", ">PROPERTY_startdate" => $data);

if (strlen($_REQUEST["qcat"]) > 0)
{
    $GLOBALS["arrFilter"][] = array("LOGIC" => "OR", array("NAME" => "%" . $_REQUEST["qcat"] . "%"), array("PROPERTY_course_code" => $_REQUEST["qcat"] . "%"));
}

$arFilter = $GLOBALS["arrFilter"];
$arFilter["IBLOCK_ID"] = 9;

$arSelect = Array("ID", "NAME", "PROPERTY_schedule_course_type", "PROPERTY_schedule_course_type.NAME");

$res = CIBlockElement::GetList(Array(), $arFilter, array("PROPERTY_schedule_course_type"), false, $arSelect);
while ($ob = $res->GetNextElement())
{
    $arFields = $ob->GetFields();
    $res1 = CIBlockElement::GetByID($arFields["PROPERTY_SCHEDULE_COURSE_TYPE_VALUE"]);
    if ($ar_res1 = $res1->GetNext())
     if (is_array($_REQUEST["cat"]) && in_array($arFields["PROPERTY_SCHEDULE_COURSE_TYPE_VALUE"], $_REQUEST["cat"]))
     {
         $arSelected[] = array("ID" => $arFields["PROPERTY_SCHEDULE_COURSE_TYPE_VALUE"], "NAME" => $ar_res1['NAME']);
     }
    $arCat[] = array("ID" => $arFields["PROPERTY_SCHEDULE_COURSE_TYPE_VALUE"], "NAME" => $ar_res1['NAME']);
}

?>
<?$APPLICATION->IncludeComponent("bitrix:form.result.new", "send_price_list_2", Array(
    "SEF_MODE" => "Y",	// Включить поддержку ЧПУ
    "WEB_FORM_ID" => "24",	// ID веб-формы
    "SUCCESS_URL" => "",	// Страница с сообщением об успешной отправке
    "CHAIN_ITEM_TEXT" => "",	// Название дополнительного пункта в навигационной цепочке
    "CHAIN_ITEM_LINK" => "",	// Ссылка на дополнительном пункте в навигационной цепочке
    "IGNORE_CUSTOM_TEMPLATE" => "Y",	// Игнорировать свой шаблон
    "USE_EXTENDED_ERRORS" => "Y",	// Использовать расширенный вывод сообщений об ошибках
    "CACHE_TYPE" => "A",	// Тип кеширования
    "CACHE_TIME" => "3600",	// Время кеширования (сек.)
    "SEF_FOLDER" => "/",	// Каталог ЧПУ (относительно корня сайта)
    "VARIABLE_ALIASES" => ""
),
    false
);?>
<div class="top-page-banner timetable" style="background-color: <?= $APPLICATION->GetPageProperty('BACKGROUND_COLOR_BANNER') ?>">
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
   
    <div class="container<?= (isset($_GET["type"]) && $_GET["type"]=='events')?' events':''?>">
        <?switch ($_SESSION["cityID"]) {
            case CITY_ID_SPB:
                $file="luxoft_training_price_spb.xls?radn=".rand();
                break;
            case CITY_ID_OMSK:
                $file="luxoft_training_price_omsk.xls?radn=".rand();
                break;
            case CITY_ID_KIEV:
                $file="luxoft_training_price_kiev.xls?radn=".rand();
                break;
            case CITY_ID_ODESSA:
                $file="luxoft_training_price_odessa.xls?radn=".rand();
                break;
            case CITY_ID_DNEPR:
                $file="luxoft_training_price_dnepropetrovsk.xls?radn=".rand();
                break;
            default:
                $file="luxoft_training_price_moscow.xls?radn=".rand();
        }?>
        <div class='timetable-filter-type-wrap'>
            <div class="timetable-filter-type-close"></div>
            <div class="timetable-type-wrap">
                <div class="timetable-type-title">Тип курсов</div>
                <?$APPLICATION->IncludeComponent("bitrix:menu", "right-menu-more", Array(
                    "ROOT_MENU_TYPE" => "left",	// Тип меню для первого уровня
                    "MAX_LEVEL" => "1",	// Уровень вложенности меню
                    "CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
                    "USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                ),
                    false
                );?>
                <div class="catalog-info-links">
                    <a onclick="$('.send-price-form-area').show(); return;"> <?= Functions::buildSVG('download-catalog', SITE_TEMPLATE_PATH. '/assets/images/icons')?> Скачать прайс</a>
                </div>
            </div>            
            <div class="timetable-filter-wrap">
                <div <?if ($_REQUEST["type"]=="online") {?> style="margin-left: 0;"<?}?> class="simple-select category-picker">
                    <div class="timetable-filter-title">Направления</div>
                    <ul>
                        <li><a class="<?= ($_REQUEST["cat"]=='' || $_REQUEST["cat"]==NULL)? 'active':''; ?>" href="/timetable/">Все курсы</a></li>
                        <?foreach ($arCat as $catergory) {?>
                            <li style="display: none;"><a data-id="<?=$catergory["ID"]?>" <?=(is_array($_REQUEST["cat"]) && in_array($catergory["ID"], $_REQUEST["cat"]))? 'class="active"':''?> href="javascript:void(0)"><?=$catergory["NAME"]?></a></li>
                        <?}?>
                    </ul>
                    <div class="more-item" style="display: none;">
                        <span>Показать ещё</span><?= Functions::buildSVG('arrow-down', SITE_TEMPLATE_PATH. '/assets/images/icons')?>
                    </div>  
                </div>  
                <div class="search-item-catalog">
                    <form id="filter">
                        <input type="text" name="qcat" value="<?=$_REQUEST["qcat"]?>" placeholder="Поиск курса" />
                        <?= Functions::buildSVG('search-loop', SITE_TEMPLATE_PATH. '/assets/images/icons')?>
                        <?foreach ($arCat as $catergory) {?>
                            <input style="display: none;" type="checkbox" class="no_redraw" <?=(is_array($_REQUEST["cat"]) && in_array($catergory["ID"], $_REQUEST["cat"]))? 'checked="checked"':''?> value="<?=$catergory["ID"]?>" name="cat[]" />
                        <?}?>
                    </form>
                </div>
            </div>
            <div class="timetable-filter-type-submit btn-main size-l">Показать</div>
        </div>
        <div class="timetable-filter-type-shadow">
        </div>
        <div class="timetable-filter-type-mobile">
            <div class="timetable-filter-type-btn btn-main size-l">Фильтр</div>
            <div class="catalog-info-links">
                <a onclick="$('.send-price-form-area').show(); return;"> <?= Functions::buildSVG('download-catalog', SITE_TEMPLATE_PATH. '/assets/images/icons')?> Скачать прайс</a>
            </div>
        </div>
    </div>
</div>
<? 
$banner_type = "ON_MAIN";
if($_REQUEST["cat"][0] == '83005' || $_REQUEST["cat"][0] == '5723'){
	$banner_type = "ONLY_FOR_CAT_83005_5723";
}?>
    <section id="banner" class="banner-main-page"><?$APPLICATION->IncludeComponent(
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
);?></section>

<?
if ($_REQUEST["type"]=="online")
{
    $id_city=14909;
}

if ($id_city!=14909)
{
    $id_city=$_SESSION["cityID"];
}

if (($id_type==2) or ($id_type==4))
{
    if (isset($_GET["by_date"])) { ?>
        <section id="content" class="not-main-page">
            <?$APPLICATION->IncludeComponent("edu:events.calendar.custom", "edu_calendar_trainings_by_cat", 
                [
                    "IBLOCK_TYPE"	=>	"edu",
                    "PROPERTY_CITYCHECK"	=>	$id_city,
                    "IBLOCK_ID"	=>	$ID_IBLOCK, /*"9",*/
                    "MONTH_VAR_NAME"	=>	"month",
                    "YEAR_VAR_NAME"	=>	"year",
                    "WEEK_START"	=>	"1",
                    "SHOW_YEAR"	=>	"N",
                    "SHOW_TIME"	=>	"N",
                    "TITLE_LEN"	=>	"200",
                    "SHOW_CURRENT_DATE"	=>	"Y",
                    "SHOW_MONTH_LIST"	=>	"N",
                    "NEWS_COUNT"	=>	"0",
                    "DETAIL_URL"	=>	"news_detail.php?ID=#ELEMENT_ID#",
                    "AJAX_MODE"	=>	"Y",
                    "AJAX_OPTION_SHADOW"	=>	"Y",
                    "AJAX_OPTION_JUMP"	=>	"N",
                    "AJAX_OPTION_STYLE"	=>	"Y",
                    "AJAX_OPTION_HISTORY"	=>	"N",
                    "CACHE_TYPE"	=>	"A",
                    "CACHE_TIME"	=>	"3600",
                    "DATE_FIELD"	=>	"PROPERTY_STARTDATE",
                    "TYPE"	=>	"EVENTS",
                    "SET_TITLE"	=>	"N"
                ]
            );?>
        </section>
    <? } else {?>
        <section id="content" class="not-main-page">
            <div class="container">
                <div class="timetable-menu">
                    <div class="simple-select">
                        <a class="title dropdown-link" href=""><span>Выберите направление</span><?= Functions::buildSVG('arrow-down', SITE_TEMPLATE_PATH. '/assets/images/icons')?></a>
                        <?if ($_REQUEST["type"]!="online") {?>
                            <ul class='timetable-menu-ul dropdown'>
                                <li class="active"><a href="/timetable/">Полное расписание</a></li>
                                <li><a href="/timetable/quarter/">Расписание на квартал</a></li>
                            </ul>
                        <?}?>
                    </div>
                    <div class="sorting-wrap">
                        <span>Сортировка по: </span> <a <?if ($_REQUEST["sort"]!="direction") {?>class="active"<?}?> href="<?=$APPLICATION->GetCurPageParam("sort=date", array("sort"));?>">Дате</a><a <?if ($_REQUEST["sort"]=="direction") {?>class="active"<?}?> href="<?=$APPLICATION->GetCurPageParam("sort=direction", array("sort"));?>">Направлению</a>
                    </div>
                </div>
                <?//}?>

                <?$data  = date("Y-m-d H:i:s");
                $GLOBALS["arrFilter"] =array("PROPERTY_city" => array($id_city, 14909), "ACTIVE" => "Y" ,">PROPERTY_startdate" => $data);
                if (strlen($_REQUEST["qcat"])>0)
                {
                    $GLOBALS["arrFilter"][]=array("LOGIC"=>"OR", array("NAME"=> "%".$_REQUEST["qcat"]."%"), array("PROPERTY_course_code"=> "%".$_REQUEST["qcat"]."%"));
                }
                if (is_array($_REQUEST["cat"]) && count($_REQUEST["cat"])>0)
                {
                    $GLOBALS["arrFilter"]["PROPERTY_SCHEDULE_COURSE_TYPE"]=$_REQUEST["cat"];
                }
                if ($_REQUEST["sort"]!="direction")
                {
                    $sorting="PROPERTY_startdate";
                }
                else
                {
                    $sorting="PROPERTY_SCHEDULE_COURSE_TYPE";
                }

                $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "edu_ru_all_city_schedule_cources_cal",
                    Array(
                        "IBLOCK_TYPE" => "edu",	// Тип информационного блока (используется только для проверки)
                        "IBLOCK_ID" => "9",	// Код информационного блока
                        "NEWS_COUNT" => "30",	// Количество новостей на странице
                        "SORT_BY1" => $sorting,	// Поле для первой сортировки новостей
                        "SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей
                        "SORT_BY2" => "PROPERTY_startdate",	// Поле для второй сортировки новостей
                        "SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
                        "FILTER_NAME" => "arrFilter",	// Фильтр
                        "FIELD_CODE" => array(	// Поля
                            0 => "",
                            1 => "",
                        ),
                        "SHOW_PRICE" => $_SESSION['SHOW_PRICE'],
                        "PROPERTY_CODE" => array(	// Свойства
                            0 => "course_сode",
                            1 => "startdate",
                            2 => "enddate",
                            3 => "schedule_time",
                            4 => "schedule_description",
                            5 => "schedule_price",
                            6 => "schedule_duration",
                            7 => "hot_checkbox",
                            8 => "prschedule_startdate",
                            9 => "prschedule_enddate",
                            10 => "prschedule_time",
                            11 => "prschedule_desc",
                            12 => "",
                        ),
                        "CHECK_DATES" => "N",	// Показывать только активные на данный момент элементы
                        "DETAIL_URL" => "/edu/catalog/course.html?ID=#ELEMENT_ID#",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
                        "AJAX_MODE" => "N",	// Включить режим AJAX
                        "AJAX_OPTION_SHADOW" => "Y",	// Включить затенение
                        "AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
                        "AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
                        "AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
                        "CACHE_TYPE" => "A",	// Тип кеширования
                        "CACHE_TIME" => "36000",	// Время кеширования (сек.)
                        "CACHE_FILTER" => "Y",	// Кэшировать при установленном фильтре
                        "PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
                        "ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
                        "DISPLAY_PANEL" => "N",	// Добавлять в админ. панель кнопки для данного компонента
                        "SET_TITLE" => "N",	// Устанавливать заголовок страницы
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
                        "ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
                        "PARENT_SECTION" => "",	// ID раздела
                        "PARENT_SECTION_CODE" => "",	// Код раздела
                        "DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
                        "DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
                        "PAGER_TITLE" => "",	// Название категорий
                        "PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
                        "PAGER_TEMPLATE" => "",	// Название шаблона
                        "PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
                        "DISPLAY_DATE" => "N",
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => "N",
                        "DISPLAY_PREVIEW_TEXT" => "N",
                        "AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
                    )
                );?>
            </div>
        </section>
    <? }
}
if ($id_type==3)
{
    if (!isset($_GET["by_date"])) {
        ?>

        <div class="edu_sort"></div>

        <?
        $GLOBALS["arrFilterS"] = array("ACTIVE" => "Y", ">=PROPERTY_startdate" => ConvertDateTime(date("d.m.Y H:i:s"), "YYYY-MM-DD HH:MM:SS"));
        if (strlen($_REQUEST["qcat"])>0)
        {
            $GLOBALS["arrFilterS"][]=array("LOGIC"=>"OR", array("NAME"=> "%".$_REQUEST["qcat"]."%"));
        }
        ?>

        <section id="content" class="not-main-page">
            <div class="container">
               <div class="timetable-menu">
                    <div class="simple-select">
                        <a class="title dropdown-link" href=""><span>Предстоящие семинары</span><?= Functions::buildSVG('arrow-down', SITE_TEMPLATE_PATH. '/assets/images/icons')?></a>
                        <ul class='timetable-menu-ul dropdown'>
                            <li class="active"><a href="/timetable/?type=events">Предстоящие семинары</a></li>
                            <li><a href="/timetable/past-seminars/">Прошедшие семинары</a></li>
                        </ul>
                    </div>
                </div>
                <?$APPLICATION->IncludeComponent(
                	"edu:news.list", 
                	"edu_seminars_webinars", 
                	array(
                		"IBLOCK_TYPE" => "edu",
                		"IBLOCK_ID" => "7",
                		"PROPERTY_CITYCHECK" => "0",
                		"PROPERTY_DATECHECK" => "0",
                		"NEWS_COUNT" => "20",
                		"SORT_BY1" => "PROPERTY_startdate",
                		"SORT_ORDER1" => "ASC",
                		"SORT_BY2" => "SORT",
                		"SORT_ORDER2" => "ASC",
                		"FILTER_NAME" => "",
                		"FIELD_CODE" => array(
                			0 => "",
                			1 => "",
                		),
                		"PROPERTY_CODE" => array(
                			0 => "location",
                			1 => "lecturer",
                			2 => "startdate",
                			3 => "enddate",
                			4 => "time",
                			5 => "description",
                			6 => "content",
                			7 => "titlefile",
                			8 => "file_old",
                			9 => "",
                		),
                		"DETAIL_URL" => "/training/seminar/#ELEMENT_ID#/",
                		"AJAX_MODE" => "N",
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
                		"DISPLAY_TOP_PAGER" => "N",
                		"DISPLAY_BOTTOM_PAGER" => "N",
                		"PAGER_TITLE" => "Новости",
                		"PAGER_SHOW_ALWAYS" => "N",
                		"PAGER_TEMPLATE" => "",
                		"PAGER_DESC_NUMBERING" => "N",
                		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                		"DISPLAY_DATE" => "Y",
                		"DISPLAY_NAME" => "Y",
                		"DISPLAY_PICTURE" => "Y",
                		"DISPLAY_PREVIEW_TEXT" => "Y",
                		"AJAX_OPTION_ADDITIONAL" => "",
                		"COMPONENT_TEMPLATE" => "edu_seminars_webinars",
                		"PROPERTY_TYPECHECK" => "324"
                	),
                	false
                );?>
            </div>
        </section>
        <?
    }
}
?>

    <script>
        $(document).ready(function() {
            $(".cities ul li a.without").closest('li').hide();
        });
    </script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>