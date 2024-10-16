<?php
use Bitrix\Main\Localization\Loc;
/**
 * @var CBitrixComponent $this
 * @var array $arParams
 * @var array $arResult
 * @var string $componentPath
 * @var string $componentName
 * @var string $componentTemplate
 * @global CDatabase $DB
 * @global CUser $USER
 * @global CMain $APPLICATION
 **/
?>
<div class="course-recommendations course-detail__container">
    <div class="course-recommendations__header">
        <div class="course-recommendations__title"><?=Loc::getMessage('TITLE_RECOMMENDATIONS')?></div>
    </div>
    <div class="course-recommendations__main">
        <?php foreach ($arResult['recommended'] as $recommendedItem) {?>
            <div class="course-recommendations__item"><?=$recommendedItem?></div>
        <?php }?>
    </div>
</div>
