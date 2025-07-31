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

<section class="fundamental">
	<div class="container">
		<h2 class="title--h2 text-center">
		<?$APPLICATION->IncludeFile(SITE_DIR . 'include/fundamental-title.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок Фундаментально']); ?>
		</h2>

		<div class="row g-4 justify-content-center">
			<?foreach($arResult["ITEMS"] as $key => $arItem):
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
				<div class="col-12 col-lg-4">
					<div class="fundamental__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
						<h3 class="fundamental__item__title"><?=$arItem['NAME']?></h3>

						<div class="fundamental__item__desc"><?=$arItem['PREVIEW_TEXT']?></div>
					</div>
				</div>
			<?endforeach;?>
		</div>
	</div>
</section>