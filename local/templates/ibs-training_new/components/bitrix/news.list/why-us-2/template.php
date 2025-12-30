<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
$this->setFrameMode(true);
?>

<section class="why-us-section <?=$arParams['CUSTOM_CLASS'];?>">
    <div class="why-us__container">

        <h2 class="why-us__main-title">
            <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/about/program-goals-title.php', [], ['MODE' => 'html']); ?>
        </h2>

        <div class="why-us__accent">
            <h3 class="why-us__accent-title">
                <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/about/program-goals-blue-title.php', [], ['MODE' => 'html']); ?>
            </h3>
        </div>

        <div class="why-us__grid">
            <?foreach($arResult["ITEMS"] as $key => $arItem):
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), ['CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')]);
                ?>
                <div class="why-us__card" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <?if(!empty($arItem['PROPERTIES']['ICON']['VALUE'])):?>
                        <div class="why-us__icon">
                            <img src="<?=CFile::GetPath($arItem['PROPERTIES']['ICON']['VALUE']);?>" alt="">
                        </div>
                    <?endif;?>

                    <div class="why-us__content">
                        <?if(!empty($arItem['NAME'])):?>
                            <div class="why-us__card-title"><?=$arItem['NAME'];?></div>
                        <?endif;?>

                        <?if(!empty($arItem['PREVIEW_TEXT'])):?>
                            <div class="why-us__card-desc"><?=$arItem['PREVIEW_TEXT'];?></div>
                        <?endif;?>
                    </div>
                </div>
            <?endforeach;?>
        </div>

    </div>
</section>