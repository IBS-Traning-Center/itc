<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta http-equiv="Content-Type" content="text/html; charset=<?=LANG_CHARSET;?>" />
<meta property="og:image" content="http://ibs-training.ru/images/logo.gif" />
<?$APPLICATION->ShowMeta("robots")?>
<?$APPLICATION->ShowMeta("keywords")?>
<?$APPLICATION->ShowMeta("description")?>
<!--[IF IE]>
	<script type="text/javascript" src="/bitrix/templates/en/js/mashajs/ierange.js"></script>
<![ENDIF]-->
<script type="text/javascript" src="/bitrix/templates/en/js_main/css_browser_selector.js"></script>
<script type="text/javascript" src="/color.js"></script>

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
<!--
<script type="text/javascript" src="/bitrix/templates/en/jquery-latest.pack.js"></script>
<script type="text/javascript" src="/bitrix/templates/en/thickbox-compressed.js"></script>
<link rel="stylesheet" type="text/css" href="/bitrix/templates/en/thickbox.css" media="screen" />
-->
<!--
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
-->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://cdn.jquerytools.org/1.2.1/all/jquery.tools.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_TEMPLATE_PATH ?>/js/jq_scripts.js"></script>
<script type="text/javascript" src="<?php echo SITE_TEMPLATE_PATH ?>/js/jquery.countdown.js"></script>
<script type="text/javascript" src="<?php echo SITE_TEMPLATE_PATH ?>/js/jquery.radio.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_TEMPLATE_PATH ?>/js/jquery.tagcanvas.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_TEMPLATE_PATH ?>/js/fancybox/jquery.fancybox-1.3.1.pack.js"></script>
<link rel="stylesheet" href="<?php echo SITE_TEMPLATE_PATH ?>/js/fancybox/jquery.fancybox-1.3.1.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo SITE_TEMPLATE_PATH ?>/radio.css" type="text/css" media="screen" />
<script type="text/javascript" src="/bitrix/js/additional/jquery.cluetip.js"></script>
<link rel="stylesheet" type="text/css" href="/bitrix/js/additional/jquery.cluetip.css" />
<script type="text/javascript" src="/bitrix/templates/en/ddaccordion.js"></script>
<script type="text/javascript" src="/bitrix/templates/en/jquery.toggleElements.pack.js"></script>
<link rel="stylesheet" type="text/css" href="/bitrix/templates/en/togglelement.css" />
<link rel="stylesheet" type="text/css" media="print" href="/bitrix/templates/en/print.css" />
<link rel="alternate stylesheet" type="text/css" media="screen,projection" href="/bitrix/templates/en/print.css" title="print" disabled="disabled" />



<!--[if lte IE 6]>
<link rel="stylesheet" type="text/css" href="/bitrix/templates/en/menu_ie6.css" />
<script type="text/javascript" src="/bitrix/templates/en/ADxMenu.js"></script>
<script type="text/javascript" src="/bitrix/templates/en/ie6.js"></script>
<![endif]-->
<link rel="alternate" type="application/rss+xml" title="Учебный Центр Luxoft RSS Feed" href="http://feeds.feedburner.com/Luxoft" />
<link rel="stylesheet" type="text/css" media="screen" href="/bitrix/templates/en/menu.css" />
<link rel="icon" href="/images/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />

</head>
<body id="layout_default">
	<script type="text/javascript">
    $(document).ready(function(){
        $('.fancybox').fancybox();
		$('.dyn-link').each(function(){
				$(this).attr("href", $(this).attr("href")+"?rand="+Math.floor(Math.random()*1000));
			})
		$('.price-radio input[type="radio"]').change(function() {
			//console.info('YES');
			$('#cat-price-download').attr("href", "/files/"+$(this).attr('data-file')+"?rand="+Math.floor(Math.random()*1000));
		});
		$('.price-down').styler();

    });
	</script>
	<div id="panel"><?$APPLICATION->ShowPanel();?></div>
		<div id="container">
         <div id="header">
         <?$APPLICATION->IncludeFile(
					$APPLICATION->GetTemplatePath("/bitrix/templates/en/include_areas_main/header.html"),
					Array(),
					Array("MODE"=>"php")
		);?>
		</div> <!-- end id = header  -->
		<div id="content"> <!--     -->
				<div id="left_menu"><!--  -->
				<?$APPLICATION->IncludeComponent("luxoft:menu", "left_hidden", Array(
					"ROOT_MENU_TYPE"	=>	"left",
					"MAX_LEVEL"	=>	"3",
					"CHILD_MENU_TYPE"	=>	"left",
					"USE_EXT"	=>	"Y"
					)
				);?>


<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
	"AREA_FILE_SHOW" => "sect",
	"AREA_FILE_SUFFIX" => "area_left",
	"AREA_FILE_RECURSIVE" => "Y",
	"EDIT_TEMPLATE" => ""
	),
	false
);?>

				</div><!-- end id = left_menu  -->
     			<div id="column2"> <!-- content main part-->
     			<div id="title">
   					<? @$blue_title=$APPLICATION->GetPageProperty("blue_title");?>
    				<h1><? ShowCustomTitle('blue_title'); ?></h1>
    				<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "luxoft_breadcrumb", array(
	"START_FROM" => "1",
	"PATH" => "",
	"SITE_ID" => "-"
	),
	false
);?>
				             <?
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
							  <? } ?>
				</div><!-- end id = title-->
	            <?$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
	"AREA_FILE_SHOW" => "page",
	"AREA_FILE_SUFFIX" => "highlight",
	"EDIT_TEMPLATE" => "page_highlight.php"
	),
	false
);?>

				<?
				$cur_dir = $APPLICATION->GetCurDir();
				$cur_page = $APPLICATION->GetCurPage();
				?>

				<?
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
	 				<div id="insert">
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
						<? } ?>

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
							  <? } ?>
			    	<? } ?>
