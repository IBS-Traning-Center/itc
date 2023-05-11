<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="lux_all_courses">
<table cellSpacing="0" cellPadding="5" border="0" class="edu">
	<? $ii = 0; ?>
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<? $ii=$ii+1; ?>
		<tr class="">
		<td>
		<div class="lux_course_category">
			<!--<?/*<a href="<?if (strlen($arItem["PROPERTIES"]["OWN_LINK_PAGE"]["VALUE"])>0){?><?=$arItem["PROPERTIES"]["OWN_LINK_PAGE"]["VALUE"]?>"><? } else {?><?echo $arItem["DETAIL_PAGE_URL"]?>"><? } ?>*/?>-->
		<?if (!strlen($arItem["PROPERTIES"]["OWN_LINK_PAGE"]["VALUE"])>0){?><?echo $arItem["NAME"]?><? }?>
			<!--<?/*</a>*/?>-->
		</div>
		<?
		$arFilter = array(
			"IBLOCK_ID" => "6",
			"ACTIVE"=>"Y",
			"PROPERTY_COURSE_IDCATEGORY" => $arItem["ID"],
			"PROPERTY_FLAG_CATALOG_SHOW" => 119,
			"PROPERTY_COURSE_FORMAT" => 102
		);
		$arOrder = array("CODE" => "ASC");
		$arSelect = array("ID", "NAME", "CODE");
		$res = CIblockELement::GetList($arOrder, $arFilter, false, false, $arSelect);
		while($ob = $res->GetNextElement())
		{
			$arFields = $ob->GetFields();?>
			<div class="lux_course"><span class="lux_code_name"><a href="http://ibs-training.ru/training/catalog/course.html?ID=<?=$arFields['ID']?>"><?=$arFields['CODE']?> <?=$arFields['NAME']?></a></span></div>
		<?	//print_r($arFields);
		}
		?>
		</td>
		</tr>
	<?endforeach;?>
</table>
</div>


