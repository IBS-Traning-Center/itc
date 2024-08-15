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
IncludeTemplateLangFile(__FILE__);?>
<div class="news-cards">
    <div class="news-cards__list">
        <? $newsIndex = 0;
        foreach ($arResult['ITEMS'] as $arItem) {
            switch ($newsIndex) {
                case 0:
                    $cardType = '_type-2-1';
                    break;
                case 1:
                    $cardType = '_type-1-2';
                    break;
                default:
                    $cardType = '_type-1-1';
            }?>
            <div class="news-cards__item <?=$cardType?>">
                <div class="news-cards__item-view">
                    <div class="news-cards__item-image _type-1-1" style="background-image: url('<?=$arItem['PREVIEW_PICTURES_CARD'][2]?>')"></div>
                    <div class="news-cards__item-image _type-1-2" style="background-image: url('<?=$arItem['PREVIEW_PICTURES_CARD'][1]?>')"></div>
                    <div class="news-cards__item-image _type-2-1" style="background-image: url('<?=$arItem['PREVIEW_PICTURES_CARD'][0]?>')"></div>
                </div>
                <div class="news-cards__item-info">
                    <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="news-cards__item-link"></a>
                    <div class="news-cards__item-title"><?=$arItem['NAME']?></div>
                    <div class="news-cards__item-description"><?=TruncateText($arItem['PREVIEW_TEXT'], 140)?></div>
                    <div class="news-cards__item-category"><?=$arItem['PROPERTIES']['CATEGORY']['VALUE']?></div>
                    <div class="news-cards__item-read-more">
                        <div class="button _white"><span><?=GetMessage('READ_MORE')?></span></div>
                    </div>
                    <?if(!empty($arItem['ACTIVE_FROM'])) {
                        $time = strtotime($arItem['ACTIVE_FROM']);
                        $currentDate = (!empty($time)) ? date('d.m.Y', $time) : '';?>
                        <div class="news-cards__item-date"><?=$currentDate?></div>
                    <?}?>
                </div>
            </div>
        <?$newsIndex++;}?>
        <div class="news-cards__item _type-1-1 _type-more">
            <a href="/news/" class="news-cards__item-link"></a>
            <div class="news-cards__item-info">
                <div class="news-cards__item-view-all">
                    <?=GetMessage('READ')?><br>
                    <b><?=GetMessage('NEWS')?></b>
                </div>
            </div>
        </div>
    </div>
</div>

