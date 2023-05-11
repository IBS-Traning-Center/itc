<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//iwrite($arResult);
?>
<?unset($arResult['34']);?>
<?
if(!$_REQUEST["letter"] && $arParams["SHOW_ALL"])
	$_REQUEST["letter"]="all";
?>
<table class="abcd" cellspacing="3" cellpadding="2">
<tr>
<?if($arParams["SHOW_NUMBER"] && $arParams["GROUP_NUMBER"] && $arParams["GROUP_NUMBER_FLAG"]):?>
<td class="abcd">
	<?if($_REQUEST["letter"]!="number"):?>
		<a href='<?=$APPLICATION->GetCurPageParam("letter=number", array("letter"));?>'>
	<?endif;?>[0-9]
	<?if($_REQUEST["letter"]!="number"):?></a>
	<?endif;?>
</td>
<?endif;?>
<?if($arParams["SHOW_ENG"] && $arParams["GROUP_ENG"] && $arParams["GROUP_ENG_FLAG"]):?>
<td class="abcd"><?if($_REQUEST["letter"]!="eng"):?><a href='<?=$APPLICATION->GetCurPageParam("letter=eng", array("letter"));?>'><?endif;?>A-Z<?if($_REQUEST["letter"]!="eng"):?></a><?endif;?></td>
<?endif;?>
<?if($arParams["SHOW_RUS"] && $arParams["GROUP_RUS"] && $arParams["GROUP_RUS_FLAG"]):?>
<td class="abcd"><?if($_REQUEST["letter"]!="rus"):?><a href='<?=$APPLICATION->GetCurPageParam("letter=rus", array("letter"));?>'><?endif;?>А-Я<?if($_REQUEST["letter"]!="rus"):?></a><?endif;?></td>
<?endif;?>
<?foreach($arResult as $key=>$value):?>
<td class="abcd"><?if($_REQUEST["letter"]!=$value):?><a href='<?=$APPLICATION->GetCurPageParam("letter=".$value, array("letter"));?>'><?endif;?><?=$value?><?if($_REQUEST["letter"]!=$value):?></a><?endif;?></td>
<?endforeach;?>
<?if($arParams["SHOW_ALL"]):?>
<td class="abcd"><?if($_REQUEST["letter"]!="all"):?><a href='<?=$APPLICATION->GetCurPageParam("letter=all", array("letter"));?>'><?endif;?>Все<?if($_REQUEST["letter"]!="all"):?></a><?endif;?></td>
<?endif;?>
</tr>
</table>
