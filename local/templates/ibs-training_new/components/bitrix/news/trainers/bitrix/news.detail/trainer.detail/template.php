<?php

use Bitrix\Main\Localization\Loc;
use Local\Util\Functions;
use Local\Util\ComponentHelper;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) {
    die();
}

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$this->setFrameMode(true);

$fullName = $arResult['NAME'];
$chainFullName = $arResult['NAME'];
if ($arResult && $arResult['PROPERTIES']['expert_name']['VALUE']) {
    $fullName = $fullName . '<span>' . $arResult['PROPERTIES']['expert_name']['VALUE'] . '</span>';
    $chainFullName = $chainFullName . ' ' . $arResult['PROPERTIES']['expert_name']['VALUE'];
}

$APPLICATION->AddChainItem($chainFullName, '');

Loc::loadMessages(__FILE__);

if ($arResult) : ?>
    <div class="top-page-banner" style="background-color: <?= $APPLICATION->GetPageProperty('BACKGROUND_COLOR_BANNER') ?>">
        <div class="container">
            <div class="banner-content">
                <?php
                    $helper = new ComponentHelper($component);
                    $helper->deferredCall('ShowNavChain');
                ?>
                <?php if ($arResult['DETAIL_PICTURE']['SRC']) : ?>
                    <img class="mobile-trainer-picture" src="<?= $arResult['DETAIL_PICTURE']['SRC'] ?>" alt="<?= $fullName ?>">
                <?php endif; ?>
                <h1><?= $fullName ?></h1>
                <div class="trainer-tags">
                    <?php if ($arResult['PROPERTIES']['KNOW_LEVEL']['VALUE']) : ?>
                        <div class="know-level-block">
                            <?= Functions::buildSVG('know_level_icon', $templateFolder . '/images') ?>
                            <span class="f-20"><?= $arResult['PROPERTIES']['KNOW_LEVEL']['VALUE'] ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if ($arResult['PROPERTIES']['expert_title']['VALUE']) : ?>
                        <div class="expert-text-block">
                            <?= Functions::buildSVG('expert_icon', $templateFolder . '/images') ?>
                            <span class="f-20"><?= $arResult['PROPERTIES']['expert_title']['VALUE'] ?></span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="buttons-block-banner">
                <?php if ($arResult['DETAIL_PICTURE']['SRC']) : ?>
                    <img src="<?= $arResult['DETAIL_PICTURE']['SRC'] ?>" alt="<?= $fullName ?>">
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="detail-trainer-block container">
        <?php if ($arResult['DETAIL_TEXT']) : ?>
            <div class="detail-text-block f-20">
                <?= $arResult['DETAIL_TEXT'] ?>
            </div>
        <?php endif; ?>
        <?php if (
                $arResult['PROPERTIES']['ABOUT_PROJECTS']['~VALUE'] &&
                $arResult['PROPERTIES']['ABOUT_PROJECTS']['~VALUE']['TEXT']
        ) : ?>
            <div class="about-projects-block">
                <h3><?= Loc::getMessage('ABOUT_PROJECTS_TITLE') ?></h3>
                <div class="f-20">
                    <?= $arResult['PROPERTIES']['ABOUT_PROJECTS']['~VALUE']['TEXT'] ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if (!empty($arResult['PROPERTIES']['HTML_CERTIFIED']['VALUE'])) : ?>
            <div class="certificates-block">
                <h3><?= Loc::getMessage('CERTIFICATES_TITLE') ?></h3>
                <ul class="certificates-content custom-trainer-ul">
                    <?php foreach ($arResult['PROPERTIES']['HTML_CERTIFIED']['VALUE'] as $values) : ?>
                        <?php foreach ($values as $value) : ?>
                            <?php if ($value != "HTML" && $value != "TEXT") : ?>
                                <li class="f-20"><?= $value ?></li>
                             <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <?php if ($arResult['PROPERTIES']['ORGANIZATIONS_TRAINER']['VALUE']) : ?>
            <?php if ($arResult['PROPERTIES']['expert_name']['VALUE']) : ?>
                <h5 class="f-20 f-bold"><?= Loc::getMessage('TRAINERS_ORGANIZATIONS_TITLE', ['#NAME#' => $arResult['PROPERTIES']['expert_name']['VALUE']]) ?></h5>
            <?php else : ?>
                <h5 class="f-20 f-bold"><?= Loc::getMessage('TRAINERS_ORGANIZATIONS_TITLE', ['#NAME#' => $arResult['NAME']]) ?></h5>
            <?php endif; ?>
            <ul class="custom-trainer-ul trainer-org">
                <?php foreach ($arResult['PROPERTIES']['ORGANIZATIONS_TRAINER']['VALUE'] as $value) : ?>
                    <li class="f-20"><?= $value ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <?php if (
                $arResult['PROPERTIES']['HTML_AREA']['~VALUE'] &&
                $arResult['PROPERTIES']['HTML_AREA']['~VALUE']['TEXT']
        ) : ?>
            <h5 class="f-20 f-bold"><?= Loc::getMessage('IMPORTANT_AREAS_TITLE') ?></h5>
            <?= $arResult['PROPERTIES']['HTML_AREA']['~VALUE']['TEXT'] ?>
        <?php endif; ?>
    </div>

    <?php if (!empty($arResult['CERTIFICATES']) || !empty($arResult['VIDEO'])) : ?>
        <div class="trainer-gray-block">
            <div class="container">
                <?php if (!empty($arResult['CERTIFICATES'])) : ?>
                    <div class="certificates-block">
                        <h3><?= Loc::getMessage('CERTIFICATE_BLOCK_TITLE') ?></h3>
                        <div class="certificates-container">
                            <?php foreach ($arResult['CERTIFICATES'] as $key => $certificate) : ?>
                                <a data-fancybox="certificate" href="<?= $certificate['PICTURE'] ?>" class="certificate-item">
                                    <img src="<?= $certificate['PICTURE'] ?>" alt="<?= $certificate['NAME'] ?>">
                                    <?= Functions::buildSVG('hover_icon_certificate', $templateFolder . '/images') ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (!empty($arResult['VIDEOS'])) : ?>
                    <div class="videos-block">
                        <h3><?= Loc::getMessage('VIDEOS_BLOCK_TITLE') ?></h3>
                        <div class="videos-items">
                            <?php foreach ($arResult['VIDEOS'] as $key => $video) : ?>
                                <?php if ($video['PLATFORM'] == 'rutube'): ?>
                                    <a class="video-item">
                                    <iframe src="https://rutube.ru/play/embed/<?= $video['ID'] ?>" frameBorder="0" allow="clipboard-write; autoplay" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                                    <span class="f-24"><?= $video['UF_NAME'] ?></span>
                                    </a>
                                <?php endif; ?>
                                <?php if ($video['PLATFORM'] == 'youtube'): ?>
                                    <a data-fancybox="video" href="<?= $video['UF_VIDEO_LINK'] ?>" class="video-item">
                                        <img alt="<?= $video['UF_NAME'] ?>" src="<?= CFile::GetPath($video['UF_PICTURE']) ?>">
                                        <span class="f-24"><?= $video['UF_NAME'] ?></span>
                                    </a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
    <?php if (!empty($arResult['COURSES'])) : ?>
        <div class="trainer-courses">
            <h3 class="container"><?= Loc::getMessage('TRAINER_COURSE_BLOCK_TITLE') ?></h3>
            <div class="trainer-courses-block">
                <?php foreach ($arResult['COURSES'] as $course) : ?>
                    <a href="/kurs/<?= $course['XML_ID'] ?>/" class="trainer-courses-item">
                        <div class="top-course-block">
                            <span class="f-14 course-code"><?= $course['CODE'] ?></span>
                            <div class="tags-course-block">
                                <?php if ($course['COMPLEXITY']) : ?>
                                    <div class="tag-block">
                                        <span class="f-16"><?= $course['COMPLEXITY'] ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if ($course['DURATION']) : ?>
                                    <div class="tag-block">
                                        <span class="f-16"><?= Functions::numWord($course['DURATION'], ['час', 'часа', 'часов']) ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <p class="course-name f-24"><?= $course['NAME'] ?></p>
                        <?php if ($course['DESCRIPTION']) : ?>
                            <p class="course-description f-16"><?= HTMLToTxt($course['DESCRIPTION']) ?></p>
                        <?php endif; ?>
                        <?php if ($course['PRICE']) : ?>
                            <p class="course-price f-24"><?= $course['PRICE'] . ' ₽' ?></p>
                        <?php endif; ?>
                        <div class="mobile-tags-course-block">
                            <?php if ($course['COMPLEXITY']) : ?>
                                <div class="tag-block">
                                    <span class="f-16"><?= $course['COMPLEXITY'] ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if ($course['DURATION']) : ?>
                                <div class="tag-block">
                                    <span class="f-16"><?= Functions::numWord($course['DURATION'], ['час', 'часа', 'часов']) ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>
<?php $helper->saveCache(); ?>
