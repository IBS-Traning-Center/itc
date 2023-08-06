<?php
use Bitrix\Main\Localization\Loc;
/**
 * @var CBitrixComponent $this
 * @var array $arParams
 * @var array $arResult
 * @var string $componentPath
 * @var string $templateFolder
 * @var string $componentName
 * @var string $componentTemplate
 * @global CDatabase $DB
 * @global CUser $USER
 * @global CMain $APPLICATION
 **/
?>
<div class="course-content course-detail__container">
    <?php if($arResult['content']['description']) {?>
    <div id="description" class="course-content__block">
        <h2 class="course-content-block__title"><?=Loc::getMessage('CONTENT_TITLE_DESCRIPTION')?></h2>
        <?=$arResult['content']['description']?>
    </div>
    <?php }?>

    <?php if($arResult['certificate'] && $arResult['certificate'] !== 'not') {?>

        <? if ($GLOBALS["APPLICATION"]->GetCurPage(true) == '/kurs/BPM.html'):?>
    <div class="course-content__block <?=$arResult['isBabok'] ? 'course-certificate-group' : '';?>">
        <div class="course-certificate">
            <div class="course-certificate__icon">
                <img width="50" src="<?="{$templateFolder}/src/images/course/detail/icons/certificate-lt-id.png"?>" alt="">
            </div>
            <div class="course-certificate__text">После прохождения программы </br>выдается
                диплом о профессиональной переподготовки государственного образца
            </div>
        </div>
    </div>

        <?else:?>
            <div class="course-content__block <?=$arResult['isBabok'] ? 'course-certificate-group' : '';?>">
                <div class="course-certificate">
                    <?php switch ($arResult['certificate']) {
                        case 'lt':?>
                            <?php if ((int)$arResult['duration'] < 16) {?>
                                <div class="course-certificate__icon">
                                    <img src="<?="{$templateFolder}/src/images/course/detail/icons/certificate-lt.png"?>" alt="">
                                </div>
                                <div class="course-certificate__text"><?=Loc::getMessage('CERTIFICATE_LT')?></div>
                            <?php } else {?>
                                <div class="course-certificate__icon">
                                    <img width="50" src="<?="{$templateFolder}/src/images/course/detail/icons/certificate-lt-id.png"?>" alt="">
                                </div>
                                <div class="course-certificate__text"><?=Loc::getMessage('CERTIFICATE_LT_ID')?></div>
                            <?php }?>
                            <?php break;
                        case 'icagile':?>
                            <div class="course-certificate__icon">
                                <img src="<?="{$templateFolder}/src/images/course/detail/icons/certificate-icagile.png"?>" alt="">
                            </div>
                            <div class="course-certificate__text"><?=Loc::getMessage('CERTIFICATE_ICAGILE')?></div>
                            <?php break;
                        case 'iiba':?>
                            <div class="course-certificate__icon">
                                <img src="<?="{$templateFolder}/src/images/course/detail/icons/certificate-iiba.png"?>" alt="">
                            </div>
                            <div class="course-certificate__text"><?=Loc::getMessage('CERTIFICATE_IIBA')?></div>
                            <?php break;
                        case 'istqb':?>
                            <div class="course-certificate__icon">
                                <img src="<?="{$templateFolder}/src/images/course/detail/icons/certificate-istqb.png"?>" alt="">
                            </div>
                            <div class="course-certificate__text"><?=Loc::getMessage('CERTIFICATE_ISTQB')?></div>
                            <?php break;
                        case 'psm':?>
                            <div class="course-certificate__icon">
                                <img src="<?="{$templateFolder}/src/images/course/detail/icons/certificate-psm.png"?>" alt="">
                            </div>
                            <div class="course-certificate__text"><?=Loc::getMessage('CERTIFICATE_PSM')?></div>
                            <?php break;
                        case 'saf':?>
                            <div class="course-certificate__icon">
                                <img src="<?="{$templateFolder}/src/images/course/detail/icons/certificate-saf.png"?>" alt="">
                            </div>
                            <div class="course-certificate__text"><?=Loc::getMessage('CERTIFICATE_SAF')?></div>
                            <?php break;
                    }?>
                </div>
                <?php if ($arResult['isBabok']) {?>
                    <div class="course-certificate <?=$arResult['isBabok'] ? 'course-certificate_babok-book' : '';?>">
                        <div class="course-certificate__icon">
                            <img width="58" src="<?="{$templateFolder}/src/images/course/detail/icons/babok-book.png"?>" alt="">
                        </div>
                        <div class="course-certificate__text">Руководство&nbsp;<a href="https://ibs-training.ru/babok-book/" target="_blank">BABOK</a>&nbsp;на&nbsp;русском<br> языке&nbsp;бесплатно</div>
                    </div>
                <?php }?>
            </div>
        <?endif?>

    <?php }?>

    <?php if($arResult['content']['objectives']) {?>
    <div id="objectives" class="course-content__block">
        <h2><?=Loc::getMessage('CONTENT_TITLE_OBJECTIVES')?></h2>
        <div class="course-content">
            <?=$arResult['content']['objectives']?>
        </div>
    </div>
    <?php }?>


    <?php if($arResult['content']['audience']) {?>
    <div id="audience" class="course-content__block">
        <h2><?=Loc::getMessage('CONTENT_TITLE_AUDIENCE')?></h2>
        <div class="course-content">
        <?=$arResult['content']['audience']?>
        </div>
    </div>
    <?php }?>


    <?php if($arResult['content']['prerequisites']) {?>
    <div id="prerequisites" class="course-content__block">
        <h2><?=Loc::getMessage('CONTENT_TITLE_PREREQUISITES')?></h2>
        <div class="course-content">
        <?=$arResult['content']['prerequisites']?>
        </div>
    </div>
    <?php }?>

    <?php if($arResult['content']['roadmapBlocks']) {?>
    <div id="roadmap" class="course-content__block">
        <h2><?=Loc::getMessage('CONTENT_TITLE_ROADMAP')?></h2>
        <div class="course-detail__accordion">
            <ul class="course-accordion">
                <?php foreach ($arResult['content']['roadmapBlocks'] as $roadmapBlock) {?>
                    <li class="course-accordion__item">
                        <div class="course-accordion-item <?php if(!trim($roadmapBlock['description'])) {?>course-accordion-item_empty<?php }?>">
                            <h3 class="course-accordion-item__header"><?=$roadmapBlock['title']?></h3>
                            <?php if(trim($roadmapBlock['description'])) {?>
                                <div class="course-accordion-item__body course-content"><?=$roadmapBlock['description']?></div>
                            <?php }?>
                        </div>
                    </li>
                <?php }?>
                <div class="js-course-roadmap-show course-detail__button course-detail__button_h-s course-detail__button_color-blue"
                     data-alternative-text="<?=Loc::getMessage('HIDE_ENTIRE')?>">
                    <span><?=Loc::getMessage('SHOW_ENTIRE')?></span>
                </div>
            </ul>
        </div>
    </div>
    <?php }
    elseif($arResult['content']['roadmap'])
    {?>
    <div id="roadmap" class="course-content__block">
        <h2><?=Loc::getMessage('CONTENT_TITLE_ROADMAP')?></h2>
        <div class="course-content">
        <?=$arResult['content']['roadmap']?>
        </div>
    </div>
    <?php }?>
    <?php if($arResult['content']['note']) {?>
        <div class="course-content__block">
            <h2><?=Loc::getMessage('CONTENT_TITLE_NOTE')?></h2>
            <div class="course-content">
            <?=$arResult['content']['note']?>
            </div>
        </div>
    <?php }?>
</div>