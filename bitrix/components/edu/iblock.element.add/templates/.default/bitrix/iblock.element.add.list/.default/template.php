<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

//echo "<pre>"; print_r($arParams); echo "</pre>";
//echo "<pre>"; print_r($arResult); echo "</pre>";
$colspan = 2;
if ($arResult["CAN_EDIT"] == "Y") $colspan++;
if ($arResult["CAN_DELETE"] == "Y") $colspan++;
?>
<?if (strlen($arResult["MESSAGE"]) > 0):?>
	<?=ShowNote($arResult["MESSAGE"])?>
<?endif?>
<noindex>
<span class="links">
<?if ($arParams["MAX_USER_ENTRIES"] > 0 && $arResult["ELEMENTS_COUNT"] < $arParams["MAX_USER_ENTRIES"]):?><a href="<?=$arParams["EDIT_URL"]?>?edit=Y<?if ((isset($_GET["ID"])) and (is_numeric($_GET["ID"]))){?>&ID=<?=$_GET["ID"]?><? } ?><?if ((isset($_GET["SECTION_ID"])) and (is_numeric($_GET["SECTION_ID"]))){?>&SECTION_ID=<?=$_GET["SECTION_ID"]?><? } ?>"><?=$arParams["PROPERTY_TEXT_TO_DO"]?></a><?else:?><?=GetMessage("IBLOCK_LIST_CANT_ADD_MORE")?><?endif?>
</span>
</noindex>

