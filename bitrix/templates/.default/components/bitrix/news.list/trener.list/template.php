<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?$index = 2;?>
<div class="clear">&nbsp;</div>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="news-list-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">



<div class="team_member l w370" >
<? if (strlen($arItem["PREVIEW_PICTURE"]["SRC"]) > 0) {?><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"  title="<?=$arItem["NAME"]?>" width="80" /></a><? } else {?><? } ?>
  <h2><?=$arItem["NAME"]?> <?=$arItem['PROPERTIES']['expert_name']['VALUE']?></h2>
 	  <?=nl2br($arItem['PROPERTIES']['expert_short']['VALUE'])?><br /> <br />


  <p><span class="links"><a href="<?=$arItem["DETAIL_PAGE_URL"]?>">подробнее</a></span></p>
</div>


<?if ( $index % 2 > 0 )  {?>
<div class="clear botborder"></div>

<? } ?>
<?$index = $index + 1;?>

	</div>
<?endforeach;?>
<div class="clear"></div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>