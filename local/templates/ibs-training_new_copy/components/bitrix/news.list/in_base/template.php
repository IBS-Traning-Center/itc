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

if($arResult['ITEMS']) :
?>
	<div class="row mb-0">
		<div class="col-12">
			<h2 class="title--h2">
				<?				
				$section = CIBlockSection::GetByID($arParams['PARENT_SECTION'])->Fetch();
				if ($section && $section['IBLOCK_ID'] == $arParams['IBLOCK_ID']) {
					echo $section['NAME'];
				} else {
					echo "Раздел не найден или не принадлежит указанному инфоблоку";
				}
				?>
			</h2>

			<ul class="basically__list mb-0">
				<?foreach($arResult["ITEMS"] as $key => $arItem){
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
					<li id="<?=$this->GetEditAreaId($arItem['ID']);?>"><?=$arItem['NAME'];?></li>
					<?
				}
				?>
			</ul>
		</div>
	</div>

<?endif;?>