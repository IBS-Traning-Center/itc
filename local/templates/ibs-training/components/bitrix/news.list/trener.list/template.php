<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<div class="trainers-list row">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="news-list-item small-2" id="<?=$this->GetEditAreaId($arItem['ID']);?>">



    <div >
<? if (strlen($arItem["DETAIL_PICTURE"]["SRC"]) > 0) {?><a class="float-left" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$arItem["DETAIL_PICTURE"]["ALT"]?>"  title="<?=$arItem["NAME"]?>" width="100" /></a><? } else {?><? } ?>
        <a class="trainer-head" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?> <?=$arItem['PROPERTIES']['expert_name']['VALUE']?></a> <br />
 	     <?=nl2br($arItem['PROPERTIES']['expert_short']['VALUE'])?><br />

</div>


</div>
<?endforeach;?>
</div>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>