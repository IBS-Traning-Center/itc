<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?php
function numDeclin($text,$type,$numero)
{
$declins = array();
$declins["I"] = array("","а","ы");
$declins["Ik1"] = array("ок","ка","ки");
$declins["Ik2"] = array("ек","ка","ки");
$declins["II"] = array("ов","","а");
$declins["IIn"] = array("й","е","я");
$declins["IIj"] = array("ев","й","я");
$declins["III"] = array("ей","ь","и");
$declins["IIIer"] = array("ерей","ь","ери");

$lc=substr($numero,strlen($numero)-1,1);
if(strlen($numero)>"1" && substr($numero,strlen($numero)-2,1)=="1")
	{$cntr = $declins[$type][0];}
elseif($lc=="1")
	{$cntr = $declins[$type][1];}
elseif($lc>"1" && $lc<"5")
	{$cntr = $declins[$type][2];}
else
	{$cntr = $declins[$type][0];}

return $numero." ".$text.$cntr;
}
?>

<table cellSpacing="0" cellPadding="5" border="0" class="edu">
	<tr class="edu_header">
		<td vAlign=top><p align=center>Направление</p></td>
		<td vAlign=top width="100%">
			<p align="left">Количество</p>
		</td>
	</tr>
	<? $ii = 0; ?>
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<? $ii=$ii+1; ?>

		<?
		$arFilter = array(
			"IBLOCK_ID" => "6",
			"ACTIVE"=>"Y",
			"PROPERTY_COURSE_IDCATEGORY" => $arItem["ID"],
			"PROPERTY_FLAG_CATALOG_SHOW" => 119,
			"PROPERTY_COURSE_FORMAT" => 102
		);
		$arOrder = array();
		$arSelect = array("ID");
		$db_elements = CIblockELement::GetList($arOrder, $arFilter, false, false, $arSelect);
		$countCourses = $db_elements->SelectedRowsCount();
		?>
		<tr  class="ewTableAltRow"  onmouseover='ew_mouseover(this);' onmouseout='ew_mouseout(this);'>
		<td width="70%">
		<p align="left">
		<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
			<a href="<?if (strlen($arItem["PROPERTIES"]["OWN_LINK_PAGE"]["VALUE"])>0){?><?=$arItem["PROPERTIES"]["OWN_LINK_PAGE"]["VALUE"]?>"><? } else {?><?echo $arItem["DETAIL_PAGE_URL"]?>"><? } ?><?echo $arItem["NAME"]?></a>
		<?endif;?>
		</p></td>
		<td width=30%>
		<p align="left"><?if ($arItem['ID'] == 9323){?><? echo  numDeclin("курс","II",83); ?> в каталоге<? } else {?><? echo  numDeclin("курс","II",$countCourses); ?> в каталоге<? } ?></p></td></tr>
	<?endforeach;?>
</table>


