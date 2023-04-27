<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(false);
?>


	<div class="selected-items">
	<div class="items-line clearfix" style="text-align: center;">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>

					
						<div class="test-item" style="display: inline-block; float: none !important;">
								<div class="text-name">
									<?=$arItem["NAME"]?>
								</div>
								
								<div class="buy-wrapper clearfix">
									<a class="buy-link" data-link="/ajax/add_test_to_basket.php?id=<?echo $arItem["ID"]?>&quantity=1&action=ADD2BASKET" href="/ajax/add_test_to_basket.php?id=<?echo $arItem["ID"]?>&quantity=1&action=BUY">Оформить</a>
									<a class="buy-more-info" href="#show-<?=$arItem["ID"]?>">Подробнее</a>
								</div>
					
						</div>
						

	<?endforeach;?>
</div>
<div class="items-description hidden-wrap">
	<div class="close-wrapper">
		<a class="close-button" href="#"></a>
	</div>					
						
<?foreach($arResult["ITEMS"] as $arItem):?>
						
						<div class="tabs" id="show-<?=$arItem["ID"]?>">
							<div class="tab-content">
								<?=$arItem["PREVIEW_TEXT"]?>
							</div>
							<div class="additional-content">
							
								<?/*if ($arParams["IBLOCK_ID"]!="138") {?>
									<p>Тест разработан на основе профессиональных <?if ($arItem["ID"]==74097) {?><a target="_blank" href="http://fgosvo.ru/uploadfiles/profstandart/06.004.pdf"><?} else {?><a target="_blank" href="/upload/06.022.pdf"><?}?>стандартов</a> Российской Федерации</p>
								<?}*/?>
								<a class="btn blue-big" href="/ajax/add_test_to_basket.php?id=<?echo $arItem["ID"]?>&quantity=1&action=BUY">Пройти тест</a>
							</div>
						</div>
<?endforeach;?>
</div>
</div>
