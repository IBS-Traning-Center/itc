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
<ul class="reviewer-list">
                       
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	 <li class="reviewer-list-item">
                            <article class="reviewer-card">
                                <header class="reviewer-card-header">
                                    <h3 class="reviewer-name"><?=$arItem["NAME"]?></h3>
                                    <div class="reviewer-role"><?=$arItem["PROPERTIES"]["STATUS"]["VALUE"]?></div>
                                    <div class="reviewer-position"><?=$arItem["PROPERTIES"]["COURSE_NAME"]["VALUE"]?></div>
                                </header>
                                <p><?=$arItem["PREVIEW_TEXT"]?>
                                </p>
                            </article>
                        </li>
	

<?endforeach;?>

</ul>
