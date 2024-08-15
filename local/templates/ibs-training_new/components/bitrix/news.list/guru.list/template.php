<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<div class="row guru">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="medium-2 item-guru">
			<div class="item-guru-inner clearfix">
				<div class="trainer-picture">
					<img src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>" alt=""/>
				</div>
				<div class="trainer-short-description">
					<a class="trainer-link" href="javascript:void(0)"><?=$arItem['PROPERTIES']['expert_name']['VALUE']?> <?=$arItem["NAME"]?></a>
					<div class="who-is"><?=nl2br($arItem['PROPERTIES']['expert_short']['VALUE'])?></div>
					<?if (strlen($arItem['PROPERTIES']['HTML_AREA_NEW']['VALUE']["TEXT"])>0) {?>
						<?=htmlspecialchars_decode($arItem['PROPERTIES']['HTML_AREA_NEW']['VALUE']["TEXT"])?>
					<?}?>
				</div>
			</div>
	</div>
	
<?endforeach;?>
</div>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>