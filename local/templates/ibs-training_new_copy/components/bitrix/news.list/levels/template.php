<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Loader;

Loader::includeModule('iblock');

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

<section class="levels" id="levels">
	<div class="container">
		<h2 class="title--h2"><?$APPLICATION->IncludeFile(SITE_DIR . 'include/h2-levels.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок Ур. сертификации']); ?></h2>

		<div class="levels__row">
			<?foreach($arResult["ITEMS"] as $key => $arItem):
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
				<div class="levels__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<div class="levels__item__content">
						<div>
							<div class="levels__item__head">
								<div>
									<div class="levels__item__title">
										<span><?=$arItem['PROPERTIES']['UP_TITLE']['VALUE']?></span>
										<p><?=$arItem['NAME']?></p>
									</div>
									
									<div class="levels__item__cost">
										<span>Стоимость:</span>
										<b><?=$arItem['PROPERTIES']['COST']['VALUE']?></b>
									</div>
								</div>
			
								<div>
									<img 
										src="<?=CFile::GetPath($arItem['PROPERTIES']['ICON']['VALUE'])?>" 
										alt="<?=$arItem['NAME']?>" 
										class="levels__item__image"
									>
			
									<div class="levels__item__period">
										<span>Сертификат действует</span>
										<b><?=$arItem['PROPERTIES']['PERIOD']['VALUE']?></b>
									</div>
								</div>
							</div>
		
							<div class="levels__item__props">
								<p class="levels__item__props__title"><?=$arItem['PROPERTIES']['PROPS_TITLE']['VALUE']?></p>
		
								<ul class="levels__item__props__list">
								<?
								$arFilter = Array(
									"IBLOCK_ID"=>intval($arItem['PROPERTIES']['PROPS']['LINK_IBLOCK_ID']), 
									"ID" => $arItem['PROPERTIES']['PROPS']['VALUE']);
								$arSelect = Array("ID", "NAME", "PROPERTY_ICON", "PROPERTY_VAL");
								$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
								while($ob = $res->GetNextElement())
								{
									$prop = $ob->GetFields();
									?>
										<li>
											<img src="<?=CFile::GetPath($prop['PROPERTY_ICON_VALUE'])?>" alt="icon">
											<p>
												<span><?=$prop['NAME']?></span>
												<b><?=$prop['PROPERTY_VAL_VALUE']?></b>
											</p>
										</li>
									<?
								}
								?>
								</ul>
							</div>

							<div class="levels__item__desc--mobile">
								<div class="levels__item__showmore--mobile">
									<p>Показать подробнее</p>
								</div>

								<div class="levels__item__desc--mobile__text" style="display: none;">
									<?=$arItem['PREVIEW_TEXT'];?>
								</div>
							</div>
		
							<div class="levels__item__btns">
								<?
								foreach ($arItem['PROPERTIES']['BUTTONS_CODE']['~VALUE'] as $key => $btn) {
									echo $btn['TEXT'];
								}
								?>
							</div>

							<div class="levels__item__modal">
								<div class="levels__item__modal--bg"></div>

								<div class="levels__item__modal--window">
									<span class="levels__item__modal--window__close"></span>

									<?=$arItem['PROPERTIES']['MODAL_FORM_CODE']['~VALUE']['TEXT'];?>

									<?
									$APPLICATION->IncludeComponent(
										"bitrix:form.result.new",
										"levels_modal_form",
										array(
											"CUSTOM_ID" => 'levelsItemModalForm'.ucfirst($arItem['PROPERTIES']['TYPE']['VALUE_XML_ID']),
											"CUSTOM_CLASSES" => "",
											"CACHE_TIME" => "3600",
											"CACHE_TYPE" => "A",
											"CHAIN_ITEM_LINK" => "",
											"CHAIN_ITEM_TEXT" => "",
											"EDIT_URL" => "",
											"IGNORE_CUSTOM_TEMPLATE" => "N",
											"LIST_URL" => "",
											"SEF_MODE" => "N",
											"SUCCESS_URL" => "",
											"AJAX_MODE" => "Y",
											"USE_EXTENDED_ERRORS" => "N",
											"VARIABLE_ALIASES" => array("RESULT_ID" => "RESULT_ID", "WEB_FORM_ID" => "WEB_FORM_ID"),
											"WEB_FORM_ID" => "50"
										));
									?>
								</div>
							</div>
						</div>

						<div class="levels__item__desc" style="display: none;">
							<?=$arItem['PREVIEW_TEXT'];?>
						</div>
					</div>

					<div class="levels__item__showmore">
						<p>Показать подробнее</p>
					</div>
				</div>
			<?endforeach;?>
		</div>
	</div>
</section>