<?


if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
{
    die();
}

use Bitrix\Main\Localization\Loc;
use Local\Util\Functions;

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
$this->setFrameMode(true);?>

<script src="https://yastatic.net/share2/share.js"></script>

<div class="detail-text-wrapper">	
    <div class="detail-text-content">
        <?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
            <div class="time-n-comment"><?=$arResult["DISPLAY_ACTIVE_FROM"]?><?= Functions::buildSVG('icon-eye', $templateFolder . '/images') ?> <?=$arResult["SHOW_COUNTER"]?></div>
        <?endif;?>
        <div class="preview-text-element">
            <?= $arResult['PREVIEW_TEXT'];?>
        </div>
        <div class="detail-images-element">
            <? foreach($arResult['PROPERTIES']['PREVIEW_PICTURES_CARD']['VALUE'] as $img){ ?>
                <img src="<?= CFile::GetPath($img);?>" alt="<?= $arResult['NAME'];?>">
            <?}?>
        </div>
        <div class="detail-text-element">
            <?= $arResult['DETAIL_TEXT'];?>
        </div>
    </div>

    <div class="detail-text-sidebar"> 
        <div class="detail-social-title"><?= Loc::getMessage('TELLING_FRIENDS')?></div>
        <div class="ya-share2" data-curtain data-size="l" data-shape="round" data-services="vkontakte,odnoklassniki,twitter,moimir"></div>   
    </div>
</div>