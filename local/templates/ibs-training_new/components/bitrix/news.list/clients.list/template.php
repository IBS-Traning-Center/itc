<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="success-story-list">

    <? foreach ($arResult["ITEMS"] as $arItem): ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div id="<?= $this->GetEditAreaId($arItem['ID']); ?>" class="success-item">
            <div style="background: #fff  url(<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>) center center no-repeat; background-size: 120px auto;"
                 class="success-picture">
            </div>
            <div class="succes-name">
                <? echo $arItem["NAME"] ?>
            </div>
            <? if (false) {?>
                <div class="success-description">
                    <p><? echo $arItem["PREVIEW_TEXT"]; ?></p>
                    <a class="file pdf" href="<?= CFile::GetPath($arItem['PROPERTIES']['PDF_FILE']['VALUE']); ?>">Читать</a>
                </div>
            <? }?>
        </div>

    <? endforeach; ?>

</div>
