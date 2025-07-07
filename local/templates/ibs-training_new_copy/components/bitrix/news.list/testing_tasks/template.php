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
<div class="row g-4 g-xxl-5">
	<?
	$arFilter = Array('IBLOCK_ID'=>$arParams['IBLOCK_ID'], 'IBLOCK_TYPE'=>$arParams['IBLOCK_TYPE']);
	$arSelect = Array('ID', 'NAME');
	$db_list = CIBlockSection::GetList(
		Array("SORT"=>"ASC"), 
		$arFilter,
		false,
		$arSelect,
		false
	);

	while($ar_result = $db_list->GetNext()) {
		?>
		<div class="col-12 col-lg-6">
			<p class="testing-tasks__list__title"><?=$ar_result['NAME'];?></p>

			<ul class="testing-tasks__list">
				<?foreach($arResult["ITEMS"] as $key => $arItem) {
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				
					if($arItem["IBLOCK_SECTION_ID"] == $ar_result['ID']) {?>
						<li id="<?=$this->GetEditAreaId($arItem['ID']);?>"><?=$arItem['NAME'];?></li>
					<?}?>
				<?}?>
			</ul>
		</div>
	<?}?>
</div>