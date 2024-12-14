<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true){
	die();
}

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
<div id="blog-list" class="blog-list">
<!--RestartBuffer-->
<?foreach($arResult["ITEMS"] as $key => $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="blog-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<a href="<?= $arItem["DETAIL_PAGE_URL"]?>">
			<? if($arItem['PROPERTIES']['PREVIEW_PICTURES_CARD']['VALUE'][0] !== NULL){?>
				<span class="blog-img" style="background-image: url('<?= CFile::GetPath($arItem['PROPERTIES']['PREVIEW_PICTURES_CARD']['VALUE'][0])?>');"></span>
			<?}?>
			<span class="blog-text">
				<span class="blog-top">
					<span class="blog-preview-title"><?= $arItem["NAME"]?></span>
					<span class="blog-preview-text">
						<?= strip_tags($arItem['PREVIEW_TEXT'])?>
					</span>
				</span>
				<div class="bottom-news-item-block">
                    <?php if ($arItem['TAGS']) : ?>
                        <div class="tags-block">
                            <?php foreach ($arItem['TAGS'] as $tag) : ?>
                                <span class="f-16"><?= $tag['UF_NAME'] ?></span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <span class="date-create f-16"><?= $arItem['DATE_CREATE'] ?></span>
                </div>
			</span>
		</a>
	</div>
<?endforeach;?>

<?php
	$paramName = 'PAGEN_'.$arResult['NAV_RESULT']->NavNum;
	$paramValue = $arResult['NAV_RESULT']->NavPageNomer;
	$pageCount = $arResult['NAV_RESULT']->NavPageCount;
	
	if ($paramValue < $pageCount) {
	    $paramValue = (int) $paramValue + 1;
	    $url = htmlspecialcharsbx(
	        $APPLICATION->GetCurPageParam(
	            sprintf('%s=%s', $paramName, $paramValue), 
	            array($paramName, 'AJAX_PAGE',)
	        )
	    );
	    echo sprintf('<div class="ajax-pager-wrap">
	                      	<a class="ajax-pager-link" data-wrapper-class="blog-list" href="%s">
						  		<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" clip-rule="evenodd" d="M11 6H34V34H11V36H34H36V34V6V4H34H6H4V6H6H11Z" fill="#0827C4"/>
								</svg>
							</a>
	                  </div>',
	        $url);
	}
?>
<!--RestartBuffer-->
</div>