<?php

use Local\Util\ComponentHelper;
use Local\Util\Functions;
use Bitrix\Main\Localization\Loc;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
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

Loc::loadMessages(__FILE__);

$title = $arResult['REQUEST']['QUERY'] ? 'Результат поиска «' . $arResult['REQUEST']['QUERY'] .'»' : 'Результат поиска';
$titleH2 = $arResult['REQUEST']['QUERY'] ? 'Результат поиска <span>«' . $arResult['REQUEST']['QUERY'] .'»</span>' : 'Результат поиска';

$APPLICATION->SetTitle($title);
$APPLICATION->AddChainItem($title, '');
?>

<div class="search-block container">
    <?php $APPLICATION->IncludeComponent(
        'bitrix:breadcrumb',
        'bread',
        [
            'START_FROM' => '0',
            'PATH' => '',
            'SITE_ID' => 's1'
        ]
    ); ?>

    <h2><?= $titleH2 ?></h2>

    <?php if (!empty($arResult['SEARCH'])) : ?>
        <?php if (!empty($arResult['COURSES'])) : ?>
            <h3><?= Loc::getMessage('COURSE_BLOCK_TITLE') ?></h3>
            <div class="section-course-block">
                <?php foreach ($arResult['COURSES'] as $course) : ?>
                    <a href="/kurs/<?= $course['XML_ID'] ?>/" class="course-block">
                        <div class="course-top-block">
                            <?php if ($course['CODE']) : ?>
                                <p class="f-14 course-code">
                                    <?= $course['CODE'] ?>
                                </p>
                            <?php endif; ?>
                            <div class="course-tags">
                                <?php if ($course['COMPLEXITY']) : ?>
                                    <div class="course-tag">
                                        <span class="f-16">
                                            <?= $course['COMPLEXITY'] ?>
                                        </span>
                                    </div>
                                <?php endif; ?>
                                <?php if ($course['DURATION']) : ?>
                                    <div class="course-tag">
                                        <span class="f-16">
                                            <?= Functions::numWord($course['DURATION'], ['час', 'часа', 'часов']) ?>
                                        </span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <p class="f-24 course-name">
                            <?= $course['NAME'] ?>
                        </p>
                        <?php if ($course['DESCRIPTION']) : ?>
                            <p class="f-16 course-description">
                                <?= HTMLToTxt($course['DESCRIPTION']) ?>
                            </p>
                        <?php endif; ?>
                        <div class="course-bottom-block">
                            <?php
                            $oldCoursePrice = round($course['OLD_PRICE']) ?: null;
                            $coursePrice = round($course['PRICE']) ?: null;

                            if (
                                !is_null($oldCoursePrice) &&
                                !is_null($coursePrice) &&
                                $coursePrice < $oldCoursePrice
                            ) : ?>
                                <span class="f-20 old-course-price"><?= $oldCoursePrice ?></span>
                                <span class="f-24 new-course-price"><?= $coursePrice ?> ₽</span>
                            <?php elseif ($coursePrice > 0) : ?>
                                <span class="f-24 new-course-price"><?= $coursePrice ?> ₽</span>
                            <?php else : ?>
                                <span class="f-24 new-course-price"><?= Loc::getMessage('FREE_TEXT_COURSE') ?></span>
                            <?php endif;
                            ?>
                            <?php if ($course['IS_NEW']) : ?>
                                <div class="is_new-course-block">
                                    <?= Functions::buildSVG('is_new', $templateFolder . '/images') ?>
                                    <span class="f-16"><?= Loc::getMessage('IS_NEW_COURSE') ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mobile-bottom-block">
                            <div class="course-tags">
                                <?php if ($course['COMPLEXITY']) : ?>
                                    <div class="course-tag">
                                        <span class="f-16">
                                            <?= $course['COMPLEXITY'] ?>
                                        </span>
                                    </div>
                                <?php endif; ?>
                                <?php if ($course['DURATION']) : ?>
                                    <div class="course-tag">
                                        <span class="f-16">
                                            <?= Functions::numWord($course['DURATION'], ['час', 'часа', 'часов']) ?>
                                        </span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php if ($course['IS_NEW']) : ?>
                                <div class="is_new-course-block">
                                    <?= Functions::buildSVG('is_new', $templateFolder . '/images') ?>
                                    <span class="f-16"><?= Loc::getMessage('IS_NEW_COURSE') ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($arResult['TRAINERS'])) : ?>
            <h3><?= Loc::getMessage('TRAINERS_BLOCK_TITLE') ?></h3>
            <div class="trainers-block">
                <div class="big-trainer-cards-block">
                    <?php foreach ($arResult['TRAINERS'] as $key => $item) : ?>
                        <a href="/about/experts/<?= $item['CODE'] ?>/" class="trainer-item">
                            <?php if ($item['PICTURE']) : ?>
                                <div class="trainer-image-block">
                                    <img src="<?= $item['PICTURE'] ?>" alt="<?= $item['NAME'] ?>">
                                </div>
                            <?php else : ?>
                                <div class="trainer-image-block no-photo">
                                    <span><?= $item['INITIALS'] ?></span>
                                </div>
                            <?php endif; ?>
                            <div class="info-trainer-block">
                                <p class="f-32"><?= $item['NAME'] ?></p>
                                <?php if ($item['DESCRIPTION']) : ?>
                                    <p class="f-20"><?= $item['DESCRIPTION'] ?></p>
                                <?php endif; ?>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if (!empty($arResult['NEWS'])) : ?>
            <h3><?= Loc::getMessage('NEWS_BLOCK_TITLE') ?></h3>
            <div id="blog-list" class="blog-list">
                <?php foreach ($arResult['NEWS'] as $key => $arItem) : ?>
                    <div class="blog-item">
                        <a href="/about/news/<?= $arItem["CODE"] ?>/">
                            <?php if ($arItem['PICTURE']) : ?>
                                <span class="blog-img" style="background-image: url('<?= $arItem['PICTURE'] ?>');"></span>
                            <?php endif; ?>
                            <span class="blog-text">
                                <span class="blog-top">
                                    <span class="blog-preview-title"><?= $arItem['NAME']?></span>
                                    <?php if ($arItem['DESCRIPTION']) : ?>
                                        <span class="blog-preview-text">
                                            <?= HTMLToTxt($arItem['DESCRIPTION'])?>
                                        </span>
                                    <?php endif; ?>
                                </span>
                                <span class="blog-bottom">
                                    <?php if (!empty($arItem['TAGS'])) : ?>
                                        <div class="news-tags-block">
                                            <?php foreach ($arItem['TAGS'] as $tag) : ?>
                                                <span><?= $tag['UF_NAME'] ?></span>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                    <span class="news-date-create"><?= $arItem['DATE_CREATE']?></span>
                                </span>
                            </span>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    <?php else : ?>
        <?= Loc::getMessage('EMPTY_RESULT_TEXT') ?>
    <?php endif; ?>
</div>
