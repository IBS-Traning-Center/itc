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

<section class="basically spaces 1">
	<div class="container">
		<h2 class="title--h2"><?$APPLICATION->IncludeFile(SITE_DIR . 'include/certification/cert-detail-for-what-title.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок блока с табами']); ?></h2>
		<div class="tabs--wrapper">	
			<div class="tabs">
				<?
				$subSectionKey = 0;
				foreach($arResult['SUBSECTION_TABS'] as $key => $subSection) {?>
					<div class="tabs__item<?=($subSectionKey === 0) ? ' active' : '';?>" data-tab="<?=$subSection["CODE"]?>"><?=$subSection['NAME'];?></div>
					<?
					$subSectionKey++;
				}?>
			</div>
		</div>
 
		<?
		foreach ($arResult['SUBSECTIONS'] as $key => $section) {?>
			
			<ul class="basically__list" data-code="<?=$section['CODE']?>"<?=($key > 0) ? ' style="display: none;"' : '';?>>
				<?
				foreach($section['SUBSECTION_LIST'] as $element) {

					$elementEditLink = 
						"/bitrix/admin/iblock_element_edit.php?" . http_build_query([
						'IBLOCK_ID' => $arParams['IBLOCK_ID'],
						'type' => $arParams['IBLOCK_TYPE'], // должен точно соответствовать типу инфоблока
						'ID' => $element['ID'],
						'lang' => LANGUAGE_ID,
						'bxpublic' => 'Y', // важный параметр для публичной части
						'from_module' => 'iblock'
					]);

					$elementDeleteLink = 
						"/bitrix/admin/iblock_element_edit.php?" . http_build_query([
						'IBLOCK_ID' => $arParams['IBLOCK_ID'],
						'type' => $arParams['IBLOCK_TYPE'], // должен точно соответствовать типу инфоблока
						'ID' => $element['ID'],
						'lang' => LANGUAGE_ID,
						'bxpublic' => 'Y', // важный параметр для публичной части
						'from_module' => 'iblock',
						'action' => 'delete'
					]);
						
					$this->AddEditAction(
						$element['ID'], 
						$elementEditLink, 
						CIBlock::GetArrayByID($arParams['IBLOCK_ID'], "ELEMENT_EDIT"));
					
					$this->AddDeleteAction(
						$element['ID'], 
						$elementDeleteLink, 
						CIBlock::GetArrayByID($arParams['IBLOCK_ID'], "ELEMENT_DELETE"),
						array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
						?>

						<li id="<?=$this->GetEditAreaId($element['ID']);?>"><?=$element['NAME'];?></li>
				<?}
			?>
			</ul>
		<?}?>	
		

		<div class="basically__btns">
			<?$APPLICATION->IncludeFile(SITE_DIR . 'include/certification/cert-detail-for-what-btn.php', [], ['MODE' => 'html', 'NAME' => 'Кнопка под блоком с табами']); ?>
		</div>
	</div>
</section>