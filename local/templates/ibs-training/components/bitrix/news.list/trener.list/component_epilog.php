<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$title=$APPLICATION->GetPageProperty("title")?>
<?if (intval($_REQUEST["PAGEN_1"])>1) {?>
	<?$APPLICATION->SetPageProperty("title", $title." страница ".intval($_REQUEST["PAGEN_1"]));?>
<?}?>
