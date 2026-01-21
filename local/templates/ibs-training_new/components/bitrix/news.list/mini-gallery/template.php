<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use \Bitrix\Main\Localization\Loc;
use Local\Util\Functions;

Loc::loadMessages(__FILE__);

/** @var $arParams */
/** @var $arResult */
/** @var $templateFolder */

$this->setFrameMode(false);

$showItemText = false;
$bottomTitle = false;

if($arParams['BOTTOM_TITLE'] == intval(1)) {
    $bottomTitle = true;
}

if (!empty($arResult['ITEMS'])) :?>
    <div class="mini-gallery__slider">
        <div class="swiper-wrapper">
            <?foreach ($arResult['ITEMS'] as $key => $item) :
                $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                
                if(!empty($item['PREVIEW_TEXT']) && $arParams['ITEMS_TEXT'] == intval(1)) {
                    $showItemText = true;
                }
            ?>
                <div class="swiper-slide mini-gallery__item<?=($showItemText) ? ' flex-sm-row w-500' : '';?><?=($bottomTitle) ? ' w-800' : '';?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <? if($arParams['USE_IMAGES_GALLERY'] === 'Y') {?>
                        <a href="<?=(!empty($item['DETAIL_PICTURE']['SRC'])) ? $item['DETAIL_PICTURE']['SRC'] : $item['PREVIEW_PICTURE']['SRC'] ?>" 
                            data-fancybox
                            >
                    <?}?>

                        <img src="<?= $item['PREVIEW_PICTURE']['SRC']?>" alt="<?= $item['NAME']?>">
                        
                    <? if($arParams['USE_IMAGES_GALLERY'] === 'Y') {?>
                        </a>
                    <?}?>

                    <?if($showItemText) {?>
                        <div>
                            <p class="mini-gallery__item__title"><?=$item['NAME'];?></p>
                            <div class="mini-gallery__item__desc">
                                <?=$item['PREVIEW_TEXT'];?>
                            </div>
                        </div>
                    <?}?>

                    <?if($bottomTitle && !($showItemText)) {?>
                        <div>
                            <p class="mini-gallery__item__title"><?=$item['NAME'];?></p>
                        </div>
                    <?}?>
                </div>
            <?endforeach;?>
        </div>
        <div class="swiper-pagination"></div>
    </div>
<?endif;?>