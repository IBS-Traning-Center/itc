<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=<?=LANG_CHARSET;?>" />
    <meta property="og:image" content="https://ibs-training.ru/images/logo.gif" />
    <?$APPLICATION->ShowMeta("robots")?>
    <?$APPLICATION->ShowMeta("keywords")?>
    <?$APPLICATION->ShowMeta("description")?>
    <!--[IF IE]>
    <script type="text/javascript" src="/bitrix/templates/personal/js/en/mashajs/ierange.js"></script>
    <![ENDIF]-->
    <script type="text/javascript" src="/bitrix/templates/.default/en/js_main/css_browser_selector.js"></script>
    <script type="text/javascript" src="/color.js"></script>
	<link rel="stylesheet" href="/local/assets/css/audit.css" />
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400italic,400,600,700&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>
    <? @$title=$APPLICATION->GetPageProperty("title");?>
    <title><?  ShowCustomTitle('title');
        $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumb_for_header", Array(
                "START_FROM"	=>	"0",
                "PATH"	=>	"",
                "SITE_ID"	=>	"en"
            ),
            $component,
            array("HIDE_ICONS" => "Y")
        );?></title>
    <?$APPLICATION->ShowCSS();?>
    <?$APPLICATION->ShowHeadStrings()?>
    <?$APPLICATION->ShowHeadScripts()?>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
    <script type="text/javascript" src="/bitrix/js/additional/jquery.cluetip.js"></script>
	<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/ellipsis.js"></script>
	<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery.formstyler.js"></script>
	<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery-ui-1.9.2.custom.js"></script>
	<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery.bpopup.min.js"></script>
	<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/code.js"></script>


    <link rel="stylesheet" type="text/css" href="/bitrix/js/additional/jquery.cluetip.css" />
    <script type="text/javascript" src="/bitrix/templates/.default/en/ddaccordion.js"></script>
    <script type="text/javascript" src="/bitrix/templates/.default/en/jquery.toggleElements.pack.js"></script>
    <link rel="stylesheet" type="text/css" href="/bitrix/templates/.default/en/togglelement.css" />
	<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/css/jquery-ui-1.9.2.css" />
	<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/css/jquery.formstyler.css" />

    <link rel="stylesheet" type="text/css" media="print" href="/bitrix/templates/.default/en/print.css" />
    <link rel="alternate stylesheet" type="text/css" media="screen,projection" href="/bitrix/templates/.default/en/print.css" title="print" disabled="disabled" />



    <!--[if lte IE 6]>
    <link rel="stylesheet" type="text/css" href="/bitrix/templates/personal/css/en/menu_ie6.css" />
    <script type="text/javascript" src="/bitrix/templates/personal/js/en/ADxMenu.js"></script>
    <script type="text/javascript" src="/bitrix/templates/personal/js/en/ie6.js"></script>
    <![endif]-->
    <link rel="alternate" type="application/rss+xml" title="Учебный Центр Luxoft RSS Feed" href="http://feeds.feedburner.com/Luxoft" />
    <link rel="stylesheet" type="text/css" media="screen" href="/bitrix/templates/.default/en/menu.css" />
    <link rel="icon" href="/images/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
</head>
<body id="layout_default">

<div id="panel"><?$APPLICATION->ShowPanel();?></div>
<div id="header" class="main">
    <?$APPLICATION->IncludeFile(
        $APPLICATION->GetTemplatePath("/bitrix/templates/personal/include_areas/header-new.html"),
        Array(),
        Array("MODE"=>"php")
    );?>

</div>
<div id="main">
     <!-- end id = header  -->
    <div class="frame"> <!--     -->
        <div id="sidebar">

            <div style="margin-bottom: 20px;"><!--  -->
                <?if (!preg_match("#^/personal_test/learning/course/#", $APPLICATION->GetCurDir())) {?>
				<div style="margin-bottom: 20px;">

					<?$APPLICATION->IncludeComponent("luxoft:menu", "left_hidden", array(
						"ROOT_MENU_TYPE" => "left",
						"MAX_LEVEL" => "1",
						"CHILD_MENU_TYPE" => "left_addon",
						"USE_EXT" => "Y"
						),
						false
					);?>
                </div>
				<?}?>
                <?$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
                        "AREA_FILE_SHOW" => "sect",
                        "AREA_FILE_SUFFIX" => "area_left",
                        "AREA_FILE_RECURSIVE" => "Y",
                        "EDIT_TEMPLATE" => ""
                    ),
                    false
                );?>
            </div>
        </div><!-- end id = left_menu  -->
        <div id="content"> <!-- content main part-->

                <?/*
                //ID = 6  = Group ID which has access to right inc area
                $arGroups = $USER->GetUserGroupArray();
                $denyEditor = array_search(6, $arGroups);
                if ($denyEditor)
                {
                    $scriptname=$_SERVER["SCRIPT_NAME"];
                    $changed_scriptname = str_replace(".php","_highlight.php",$scriptname);
                    $changed_scriptname = str_replace(".html","._highlight.php",$changed_scriptname);
                    if ($USER->IsAdmin()) {} else {?>
                        <span style="margin:0px; padding:0px; cursor:pointer;"  class="popupitem">
										<a title="Добавить (редактироать) включаемую область для текущей страницы" href="javascript:(new BX.CAdminDialog(
										{'content_url':'/bitrix/admin/public_file_edit.php?lang=ru&amp;from=main.include&amp;path=<?=$changed_scriptname?>&amp;template=page_highlight.php&amp;site=<?=SITE_ID?>&amp;back_url=<?=$scriptname?>%3Fbitrix_include_areas%3DY%26bitrix_show_mode%3Dconfigure',
										'width':'800',
										'height':'600'
										})).Show()">
                                            <img height="20" border="0" width="20" alt="Добавить (редактироать) включаемую область для текущей страницы" src="/bitrix/images/iblock/icons/edit_element.gif"></a>
									</span>
                    <? } ?>
                <? } */?>

            <?/*$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
                    "AREA_FILE_SHOW" => "page",
                    "AREA_FILE_SUFFIX" => "highlight",
                    "EDIT_TEMPLATE" => "page_highlight.php"
                ),
                false
            );*/?>

            <?
            $cur_dir = $APPLICATION->GetCurDir();
            $cur_page = $APPLICATION->GetCurPage();
            ?>

            <?/*
            if (strlen($_SERVER["REAL_FILE_PATH"])>0){
                $filename = $_SERVER["DOCUMENT_ROOT"].$_SERVER["REAL_FILE_PATH"];
            } else {
                $filename = $_SERVER["DOCUMENT_ROOT"].$_SERVER["SCRIPT_NAME"];
            }
            if ((preg_match("#/kurs/#", $filename)) || (preg_match('#/events/actions/#', $filename))) {
                $filename1 = str_replace(".php", "._inc.php",$filename);
            } else {
                $filename1 = str_replace(".html", "._inc.php",$filename);
            }

            $filename2 = str_replace(".html", "._inc10.php",$filename);
            if (((file_exists($filename2) or (file_exists($filename1)))
                and ((strstr($filename1, '_inc')) or (strstr($filename2, '_inc'))) ) ) {  ?>
            <style type="text/css">
                #mainpart  {width:530px;}
                .learn_more {width:655px; }
                .ie6 .learn_more {width:440px; }
            </style>
            <div class="clear"></div>
            <?/*<div id="insert">
                <?
                $arGroups = $USER->GetUserGroupArray();
                $denyEditor = array_search(6, $arGroups);
                if ($denyEditor)
                {
                    $scriptname=$_SERVER["SCRIPT_NAME"];
                    $changed_scriptname = str_replace(".php","_inc.php",$scriptname);
                    $changed_scriptname = str_replace(".html","._inc.php",$changed_scriptname);
                    if ($USER->IsAdmin()) {} else {?>
                        <?if (strstr($_SERVER["REQUEST_URI"], '/school/')) {} else {?>
                            <span style="margin:0px; padding:0px; cursor:pointer; position:absolute;"  class="popupitem">
										<a title="Добавить (редактироать) включаемую область для текущей страницы" href="javascript:(new BX.CAdminDialog(
										{'content_url':'/bitrix/admin/public_file_edit.php?lang=ru&amp;from=main.include&amp;path=<?=$changed_scriptname?>&amp;template=page_inc.php&amp;site=<?=SITE_ID?>&amp;back_url=<?=$scriptname?>%3Fbitrix_include_areas%3DY%26bitrix_show_mode%3Dconfigure',
										'width':'800',
										'height':'600'
										})).Show()">
                                            <img height="20" border="0" width="20" alt="Добавить (редактироать) включаемую область для текущей страницы" src="/bitrix/images/iblock/icons/edit_element.gif"></a>
									</span>
                        <? } ?>
                    <? } ?>
                <? } ?>
                <?$APPLICATION->IncludeComponent("bitrix:main.include", "", Array(
                        "AREA_FILE_SHOW"	=>	"page",
                        "AREA_FILE_SUFFIX"	=>	"inc",
                        "EDIT_MODE"	=>	"text",
                        "EDIT_TEMPLATE"	=>	""
                    )
                );?>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "page",
                        "AREA_FILE_SUFFIX" => "inc10",
                        "EDIT_MODE" => "text",
                        "EDIT_TEMPLATE" => ""
                    )
                );?>
            </div><!-- end id = insert-->
			?>
            <div id="mainpart">

                <? } else { ?>
                <?  global $USER;
                if ($USER->IsAdmin()) { ?>
                    <div id="insert">
                        <?$APPLICATION->IncludeComponent("bitrix:main.include", "template2", Array(
                                "AREA_FILE_SHOW" => "page",	// Показывать включаемую область
                                "AREA_FILE_SUFFIX" => "inc",	// Суффикс имени файла включаемой области
                                "EDIT_MODE" => "text",
                                "EDIT_TEMPLATE" => "",	// Шаблон области по умолчанию
                            ),
                            false
                        );?>
                    </div><!-- end id = insert-->
                <? } */?>

                <?/*
                $arGroups = $USER->GetUserGroupArray();
                $denyEditor = array_search(6, $arGroups);
                if ($denyEditor)
                {
                    $scriptname=$_SERVER["SCRIPT_NAME"];
                    $changed_scriptname = str_replace(".php","_inc.php",$scriptname);
                    $changed_scriptname = str_replace(".html","._inc.php",$changed_scriptname);
                    if ($USER->IsAdmin()) {} else {?>
                        <?if (strstr($_SERVER["REQUEST_URI"], '/school/')) {} else {?>
                            <div id="insert">
									<span style="margin:0px; padding:0px; cursor:pointer; position:absolute;"  class="popupitem">
										<a title="Добавить (редактировать) включаемую область для текущей страницы" href="javascript:(new BX.CAdminDialog(
										{'content_url':'/bitrix/admin/public_file_edit.php?lang=ru&amp;from=main.include&amp;path=<?=$changed_scriptname?>&amp;template=page_inc.php&amp;site=<?=SITE_ID?>&amp;back_url=<?=$scriptname?>%3Fbitrix_include_areas%3DY%26bitrix_show_mode%3Dconfigure',
										'width':'800',
										'height':'600'
										})).Show()">
                                            <img height="15" border="0" width="15" alt="Добавить (редактировать) включаемую область для текущей страницы" src="/bitrix/images/iblock/icons/edit_element.gif"></a>
									</span>
                            </div>
                        <? } ?>
                    <? } ?>
                <? } */?>
<?GLOBAL $USER;?>
<?if ($APPLICATION->GetCurDir()!="/personal_test/test-information/" && $USER->IsAuthorized()) {?>

<?$USERID=$USER->GetID();?>
<?GLOBAL $arrFilter;?>
<?$arrFilter["PROPERTY_USER"]=$USERID;?>


<?
$arFilter = Array("IBLOCK_ID"=>108, "PROPERTY_USER"=>$USERID, "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement()){
$arFields = $ob->GetFields();
$arRegK = [];
$arProps = $ob->GetProperties();
if (intval($arProps["SCH_COURSE"]["VALUE"])>0) {
	$arRegistered[]=$arProps["SCH_COURSE"]["VALUE"];
}
$arRegK[]=$arProps["COURSE"]["VALUE"];
	if (strlen($arProps["CERT"]["VALUE"])>0) {
		$arCert[]=$arProps["SCH_COURSE"]["VALUE"];
	}

}



$arSelect=array("IBLOCK_ID", "NAME", "ID", "PROPERTY_CITY", "PROPERTY_COURSE", "PROPERTY_CATEGORY");
$arFilter = Array("IBLOCK_ID"=>107,  "PROPERTY_USER"=> $USER->GetID(), "ACTIVE"=>"Y");
$pes = CIBlockElement::GetList(Array("NAME"=>"ASC"), $arFilter, false, false, $arSelect);
while ($ob = $pes->GetNextElement()) {
		$arFields=$ob->GetFields();
		$arProps=$ob->GetProperties();
		$arRecommend["city"]=$arProps["CITY"]["VALUE"];
		$arRecommend["category"]=$arProps["CATEGORY"]["VALUE"];
		if (intval($arFields["PROPERTY_COURSE_VALUE"])>0) {
			$res = CIBlockElement::GetProperty(6, $arFields["PROPERTY_COURSE_VALUE"], "sort", "asc", array("CODE" => "ID_LINKED_COURSES"));
			while ($ob = $res->GetNext())
			{
				$arLinked[] = $ob['VALUE'];
			}
		}


}

$cache = new CPHPCache();
$cache_time = 3600;
if (is_array($arRecommend["category"])) {
    $cache_id = 'reccat'.implode('_',$arRecommend["category"]);
}

$cache_path = '/reccomend/';
if ($cache_time > 0 && is_array($arRecommend["category"]) && $cache->InitCache($cache_time, $cache_id, $cache_path))
{
   $res = $cache->GetVars();

   if (is_array($res["linked"]) && (count($res["linked"]) > 0))
	  $additLinked=$res["linked"];
	  if (count($arLinked)==0) {
		$arLinked=array();
	  }
	  $arLinked=array_merge($additLinked, $arLinked);

}
/*if ($USER->IsAdmin()) {
	print_r($arLinked);
}*/
if (!is_array($additLinked) && is_array($arRecommend["category"]))
{
  $arLinked=array_diff($arLinked, array("", 0));
  $arSelect=array("NAME", "ID", "PROPERTY_PP_COURSE");
  $arFilter = Array("IBLOCK_ID"=>94, "SECTION_ID"=> $arRecommend["category"]);
  $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
  while ($arFields=$res->GetNext()) {
		$arLinked[]=$arFields["PROPERTY_PP_COURSE_VALUE"];
   }
   if ($cache_time > 0)
   {
         $cache->StartDataCache($cache_time, $cache_id, $cache_path);
         $cache->EndDataCache(array("linked"=>$arLinked));
   }
}


if (is_array($arRegK)) {
    $arRegK=array_unique($arRegK);
}
GLOBAL $arReg;
GLOBAL $arLinked;
GLOBAL $arRegK;
GLOBAL $arRecommend;
if (is_array($arRecommend["city"])) {
    $arRecommend["city"]=array_diff($arRecommend["city"],array('', 0));
}

$arSelect=array("NAME", "ID");
$arRecCourse[]=1;
$arFilter = Array("IBLOCK_ID"=>9, array(">PROPERTY_startdate"=>date("Y-m-d"),  "PROPERTY_CITY"=>$arRecommend["city"], "ACTIVE"=>"Y", "PROPERTY_schedule_course"=> $arLinked));
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>15), $arSelect);
while ($arFields=$res->GetNext()) {
		$arRecCourse[]=$arFields["ID"];
	}



GLOBAL $arRec;
if (is_array($arRegistered)) {
    $arReg=array_unique($arRegistered);
}

$arRec=array_unique($arRecCourse);
} else {
	//echo "123";
}
//print_r($arRegAll);

?>
