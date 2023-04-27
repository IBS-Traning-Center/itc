<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (count($arResult["ITEMS"])>0) {?>
<div class="message">
	<?$arItem=$arResult["ITEMS"][0]?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="info" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<p><?echo $arItem["PREVIEW_TEXT"];?></p>
	</div>

<?if (count($arResult["ITEMS"])>1) {?>
<a href="#" class="more">Ещё <?=count($arResult["ITEMS"])-1?> сообщения</a>
<?}?>
<a data-id="<?=$arItem["ID"]?>" class="notif-readed" href="javascript:void(0)">Отметить как прочитанное</a>
</div>
<?}?>
