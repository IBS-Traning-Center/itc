<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (count($arResult["ITEMS"])>0) {?>
<div id="testimonials" class="bg not-main-page dark-gray">
			<div class="frame padding-bottom">
				<div class="testi-heading">
					Отзывы:
				</div>
				<div class="masonry row">
					<?foreach($arResult["ITEMS"] as $arItem):?>
					<div class="testimonal-item">
						<div class="name-test-item"><?if (($arItem["PROPERTIES"]["client"]["VALUE"] == D_DIFF_ELEMENT_PRIVATEMAN)
		or	($arItem["PROPERTIES"]["client"]["VALUE"] == "")) {?>

		<?if (strlen($arItem["PROPERTIES"]["surname"]["VALUE"])>0) {?>
			<?=$arItem["PROPERTIES"]["surname"]["VALUE"]?> <?=$arItem["PROPERTIES"]["name"]["VALUE"]?>
		<? } else {?>
			Участник тренинга
		<? } ?>
	<? } else { ?>
		Компания <?=$arResult['CLIENTS'][$arItem['ID']]['NAME']?>
		<?if (strlen($arResult['CLIENTS'][$arItem['ID']]['CITY'])>0){?>
			(<?=$arResult['CLIENTS'][$arItem['ID']]['CITY']?>)
		<? } ?>
    <? } ?></div>
						<div class="testimonal-text">
							<?=nl2br($arItem["PROPERTIES"]["review"]["VALUE"]);?>
						</div>
					</div>
					<?endforeach;?>
					
				</div>
			</div>
</div>
<?}?>



