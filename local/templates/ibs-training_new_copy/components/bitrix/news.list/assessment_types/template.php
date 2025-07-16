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

<div class="tabs--wrapper d-lg-none mb-0">
	<div class="tabs">
		<div class="tabs__item active" data-tab="testing">Тестирование</div>
		<div class="tabs__item" data-tab="expert">Экспертная оценка</div>
		<div class="tabs__item" data-tab="cert">Сертификация</div>
	</div>
</div>

<div class="row assessment_types__head d-none d-lg-flex">
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

	$dataCode = '';
	
	if(!empty($arItem['PROPERTIES']['TESTING']['VALUE'])) {
		$dataCode .= ' testing';
	}

	if(!empty($arItem['PROPERTIES']['EXPERT']['VALUE'])) {
		$dataCode .= ' expert';
	}

	if(!empty($arItem['PROPERTIES']['CERT']['VALUE'])) {
		$dataCode .= ' cert';
	}

	if($arItem['PROPERTIES']['TEXT_UPPER']['VALUE'] === 'Y') {
		$textClass = 'big-text';
	}
?>
	<div class="row assessment_types__item <?=$textClass?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>" data-code="<?=trim($dataCode);?>">
		<div class="col-12 col-lg-4 assessment_types__item__cell">
			<p class="assessment_types__item__title"><?=$arItem['NAME']?></p>
			<div class="assessment_types__item__desc"><?=$arItem['PREVIEW_TEXT']?></div>

			<?
			if(!empty($arItem['PROPERTIES']['TESTING']['VALUE']) && $arItem['PROPERTIES']['TESTING']['VALUE'] !== 'Y') {
				?><div data-subcode="testing" class="d-lg-none"><?=$arItem['PROPERTIES']['TESTING']['VALUE'];?></div><?
			}
			if(!empty($arItem['PROPERTIES']['EXPERT']['VALUE']) && $arItem['PROPERTIES']['EXPERT']['VALUE'] !== 'Y') {
				?><div data-subcode="expert" style="display: none;"><?=$arItem['PROPERTIES']['EXPERT']['VALUE'];?></div><?
			}
			if(!empty($arItem['PROPERTIES']['CERT']['VALUE']) && $arItem['PROPERTIES']['CERT']['VALUE'] !== 'Y') {
				?><div data-subcode="cert" style="display: none;"><?=$arItem['PROPERTIES']['CERT']['VALUE'];?></div><?
			}
			?>
		</div>

		<div class="col-8 assessment_types__props d-none d-lg-block">
			<div class="row">
				<div class="col-4 assessment_types__item__cell">
					<?
					if(!empty($arItem['PROPERTIES']['TESTING']['VALUE'])):
						if($arItem['PROPERTIES']['TESTING']['VALUE'] === 'Y') {
						?>
							<img src="<?=SITE_TEMPLATE_PATH?>/assets/images/icons/blue_agree.svg" alt="Да">
						<?} else {?>
							<?=$arItem['PROPERTIES']['TESTING']['VALUE'];?>
						<?}
					else:?>
						<span>&mdash;</span>
					<?endif;?>
				</div>

				<div class="col-4 assessment_types__item__cell">
					<?
					if(!empty($arItem['PROPERTIES']['EXPERT']['VALUE'])):
						if($arItem['PROPERTIES']['EXPERT']['VALUE'] === 'Y') {
						?>
							<img src="<?=SITE_TEMPLATE_PATH?>/assets/images/icons/blue_agree.svg" alt="Да">
						<?} else {?>
							<?=$arItem['PROPERTIES']['EXPERT']['VALUE'];?>
						<?}
					else: ?>
						<span>&mdash;</span>
					<?endif;?>
				</div>

				<div class="col-4 assessment_types__item__cell">
					<?
					if(!empty($arItem['PROPERTIES']['CERT']['VALUE'])):
						if($arItem['PROPERTIES']['CERT']['VALUE'] === 'Y') {
						?>
							<img src="<?=SITE_TEMPLATE_PATH?>/assets/images/icons/blue_agree.svg" alt="Да">
						<?} else {?>
							<?=$arItem['PROPERTIES']['CERT']['VALUE'];?>
						<?}
					else: ?>
						<span>&mdash;</span>
					<?endif;?>
				</div>
			</div>
		</div>
	</div>

	<? unset($dataCode); ?>
<?endforeach;?>

<div class="row assessment_types__item d-none d-lg-flex <?=$textClass?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
	<div class="col-4 assessment_types__item__cell">

	</div>

	<div class="col-8 assessment_types__props">
		<div class="row">
			<div class="col-4 assessment_types__item__cell">
				<a class="btn-main btn--dark bg--blue" data-scroll="mainFeedbackFormBlock" data-type="testing">Оставить заявку</a>
			</div>

			<div class="col-4 assessment_types__item__cell">
				<a class="btn-main btn--dark bg--blue" data-scroll="mainFeedbackFormBlock" data-type="expert">Оставить заявку</a>
			</div>

			<div class="col-4 assessment_types__item__cell">
				<a class="btn-main btn--dark bg--blue" data-scroll="mainFeedbackFormBlock" data-type="cert">Оставить заявку</a>
			</div>
		</div>
	</div>
</div>