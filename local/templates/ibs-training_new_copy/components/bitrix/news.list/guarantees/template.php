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

	<section class="guarantees">
		<div class="container">
			<div class="row">
				<div class="col-12 col-lg-6">
					<?
					$sectionWhyUs = [];
					$arFilter = Array('IBLOCK_ID'=>intval(201), 'IBLOCK_TYPE'=>'edu_const', 'ID'=>intval($arParams['PARENT_SECTION']));
					$arSelect = Array('ID', 'NAME', 'PICTURE', 'UF_*');
					$db_list = CIBlockSection::GetList(
						Array("SORT"=>"ASC"), 
						$arFilter,
						false,
						$arSelect,
						false
					);
					
					while($ar_result = $db_list->GetNext())
					{
						$sectionWhyUs = $ar_result;
					}

					?>
					
					<h2 class="title--h2"><?=$sectionWhyUs['UF_BLOCK_TITLE']?></h2>
					
					<div class="guarantees__content">
						<?if(!empty($sectionWhyUs['PICTURE'])) {?>
							<img src="<?=CFile::GetPath($sectionWhyUs['PICTURE'])?>" alt="<?=$sectionWhyUs['NAME']?>" class="guarantees__image">
							<?}?>
							<p><?=$sectionWhyUs['NAME']?></p>
						</div>
					</div>
					
					<div class="col-12 col-lg-6">
						<ul class="guarantees__list">
							<?foreach($arResult["ITEMS"] as $key => $arItem):
								$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
								$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
								
								// echo '<pre>';
								// var_dump($arItem['PROPERTIES']['NUMBER']['VALUE']);
								// echo '</pre>';
						?>
								<li id="<?=$this->GetEditAreaId($arItem['ID']);?>">
									<span><?=$arItem['PROPERTIES']['NUMBER']['VALUE'];?></span>
									<?=$arItem['NAME']?>
								</li>
						<?endforeach;?>
					</ul>
				</div>
			</div>
		</div>
	</section>

<?endif;?>