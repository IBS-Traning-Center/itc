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
$this->setFrameMode(true);
?>

<div class="row assessment_types__head">
	<div class="col-4"></div>
	<div class="col-8">
		<div class="row">
			<div class="col-4 assessment_types__head__item"><?=$arResult["ITEMS"][0]['PROPERTIES']['TESTING']['NAME']?></div>
			<div class="col-4 assessment_types__head__item"><?=$arResult["ITEMS"][0]['PROPERTIES']['EXPERT']['NAME']?></div>
			<div class="col-4 assessment_types__head__item"><?=$arResult["ITEMS"][0]['PROPERTIES']['CERT']['NAME']?></div>
		</div>
	</div>
</div>

<?foreach($arResult["ITEMS"] as $key => $arItem):
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

	if($arItem['PROPERTIES']['TEXT_UPPER']['VALUE'] === 'Y') {
		$textClass = 'big-text';
	}
?>
	<div class="row assessment_types__item <?=$textClass?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<div class="col-4 assessment_types__item__cell">
			<p class="assessment_types__item__title"><?=$arItem['NAME']?></p>
			<div class="assessment_types__item__desc"><?=$arItem['PREVIEW_TEXT']?></div>
		</div>

		<div class="col-8 assessment_types__props">
			<div class="row">
				<div class="col-4 assessment_types__item__cell">
					<?
					if($arItem['PROPERTIES']['TESTING']['VALUE'] === 'Y') {
					?>
						<img src="<?=SITE_TEMPLATE_PATH?>/assets/images/icons/blue_agree.svg" alt="Да">
					<?} else {?>
						<?=$arItem['PROPERTIES']['TESTING']['VALUE']?>
					<?}?>
				</div>

				<div class="col-4 assessment_types__item__cell">
					<?
					if($arItem['PROPERTIES']['EXPERT']['VALUE'] === 'Y') {
					?>
						<img src="<?=SITE_TEMPLATE_PATH?>/assets/images/icons/blue_agree.svg" alt="Да">
					<?} else {?>
						<?=$arItem['PROPERTIES']['EXPERT']['VALUE']?>
					<?}?>
				</div>

				<div class="col-4 assessment_types__item__cell">
					<?
					if($arItem['PROPERTIES']['CERT']['VALUE'] === 'Y') {
					?>
						<img src="<?=SITE_TEMPLATE_PATH?>/assets/images/icons/blue_agree.svg" alt="Да">
					<?} else {?>
						<?=$arItem['PROPERTIES']['CERT']['VALUE']?>
					<?}?>
				</div>
			</div>
		</div>
	</div>
<?endforeach;?>

<div class="row assessment_types__item <?=$textClass?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<div class="col-4 assessment_types__item__cell">

		</div>

		<div class="col-8 assessment_types__props">
			<div class="row">
				<div class="col-4 assessment_types__item__cell">
					<a href="" class="btn--dark bg--blue" style="color: white !important;">Оставить заявку</a>
				</div>

				<div class="col-4 assessment_types__item__cell">
					<a href="" class="btn--dark bg--blue" style="color: white !important;">Оставить заявку</a>
				</div>

				<div class="col-4 assessment_types__item__cell">
					<a href="" class="btn--dark bg--blue" style="color: white !important;">Оставить заявку</a>
				</div>
			</div>
		</div>
	</div>