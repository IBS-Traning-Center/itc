<?php
use Bitrix\Main\Localization\Loc;
/**
 * @var CBitrixComponent $this
 * @var array $arParams
 * @var array $arResult
 * @var string $componentPath
 * @var string $componentName
 * @var string $componentTemplate
 * @var string $templateFolder
 * @global CDatabase $DB
 * @global CUser $USER
 * @global CMain $APPLICATION
 **/
?>
<div class="course-teasers course-detail__container">
    <div class="course-teasers__header">
        <div class="course-teasers__title"><?=Loc::getMessage('TITLE_TEASERS')?></div>
    </div>
    <div class="course-teasers__main">
        <div class="course-teaser">
            <div class="course-teaser__view">
                <img src="<?=$templateFolder?>/src/images/course/detail/teasers/expertise.svg" alt="" class="course-teaser__icon">
            </div>
            <div class="course-teaser__content">
                <div class="course-teaser__title"><?=Loc::getMessage('TEASER_1_TITLE')?></div>
                <div class="course-teaser__description"><?=Loc::getMessage('TEASER_1_DESCRIPTION')?></div>
            </div>
        </div>
        <? if ($GLOBALS["APPLICATION"]->GetCurPage(true) == '/kurs/BPM.html'):?>

<div class="course-teaser">
            <div class="course-teaser__view">
                <img src="<?=$templateFolder?>/src/images/course/detail/teasers/sdo.png" alt="" class="course-teaser__icon">
            </div>
            <div class="course-teaser__content">
                <div class="course-teaser__title">СДО</div>
                <div class="course-teaser__description">Изучайте материалы самостоятельно в СДО и участвуйте в практических семинарах.</div>
            </div>
            </div>

<?else:?>

<div class="course-teaser">
            <div class="course-teaser__view">
                <img src="<?=$templateFolder?>/src/images/course/detail/teasers/live.svg" alt="" class="course-teaser__icon">
            </div>
            <div class="course-teaser__content">
                <div class="course-teaser__title"><?=Loc::getMessage('TEASER_2_TITLE')?></div>
                <div class="course-teaser__description"><?=Loc::getMessage('TEASER_2_DESCRIPTION')?></div>
            </div>
        </div>

<?endif?>
        <div class="course-teaser">
            <div class="course-teaser__view">
                <img src="<?=$templateFolder?>/src/images/course/detail/teasers/practice.svg" alt="" class="course-teaser__icon">
            </div>
            <div class="course-teaser__content">
                <div class="course-teaser__title"><?=Loc::getMessage('TEASER_3_TITLE')?></div>
                <div class="course-teaser__description"><?=Loc::getMessage('TEASER_3_DESCRIPTION')?></div>
            </div>
        </div>

        <?php if($arResult['certificate'] !== 'lt') {?>
            <div class="course-teaser">
                <div class="course-teaser__view">
                    <img src="<?=$templateFolder?>/src/images/course/detail/teasers/certified.svg" alt="" class="course-teaser__icon">
                </div>
                <div class="course-teaser__content">
                    <div class="course-teaser__title"><?=Loc::getMessage('TEASER_CERTIFICATE')?></div>
                    <?php switch ($arResult['certificate']) {
                        case 'icagile':?>
                            <div class="course-teaser__description"><?=Loc::getMessage('TEASER_CERTIFICATE_ICAGILE')?></div>
                            <?php break;
                        case 'iiba':?>
                            <div class="course-teaser__description"><?=Loc::getMessage('TEASER_CERTIFICATE_IIBA')?></div>
                            <?php break;
                        case 'istqb':?>
                            <div class="course-teaser__description"><?=Loc::getMessage('TEASER_CERTIFICATE_ISTQB')?></div>
                            <?php break;
                        case 'psm':?>
                            <div class="course-teaser__description"><?=Loc::getMessage('TEASER_CERTIFICATE_PSM')?></div>
                            <?php break;
                        case 'saf':?>
                            <div class="course-teaser__description"><?=Loc::getMessage('TEASER_CERTIFICATE_SAF')?></div>
                        <?php break;
                    }?>
                </div>
            </div>
        <?php }?>
    </div>
</div>
