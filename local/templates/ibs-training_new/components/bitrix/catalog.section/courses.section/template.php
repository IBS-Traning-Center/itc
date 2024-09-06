<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;
use Local\Util\Functions;

global $APPLICATION;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $templateFolder
 * @var string $componentPath
*/

Loc::loadMessages(__FILE__);

$this->setFrameMode(true);

if (!empty($arResult['ITEMS'])) : ?>
    <div class="section-course-block">
        <?php foreach ($arResult['ITEMS'] as $key => $item) : ?>
            <a href="/kurs/<?= $item['XML_ID'] ?>/" class="course-block">
                <div class="course-top-block">
                    <?php if ($item['PROPERTIES']['course_code']['VALUE']) : ?>
                        <p class="f-14 course-code">
                            <?= $item['PROPERTIES']['course_code']['VALUE'] ?>
                        </p>
                    <?php endif; ?>
                    <div class="course-tags">
                        <?php if ($item['PROPERTIES']['COMPLEXITY']['VALUE']) : ?>
                            <div class="course-tag">
                                <span class="f-16">
                                    <?= $item['PROPERTIES']['COMPLEXITY']['VALUE'] ?>
                                </span>
                            </div>
                        <?php endif; ?>
                        <?php if ($item['PROPERTIES']['course_duration']['VALUE']) : ?>
                            <div class="course-tag">
                                <span class="f-16">
                                    <?= Functions::numWord($item['PROPERTIES']['course_duration']['VALUE'], ['час', 'часа', 'часов']) ?>
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <p class="f-24 course-name">
                    <?= $item['NAME'] ?>
                </p>
                <?php if ($item['PROPERTIES']['short_descr']['VALUE']) : ?>
                    <p class="f-16 course-description">
                        <?= HTMLToTxt($item['PROPERTIES']['short_descr']['VALUE']) ?>
                    </p>
                <?php endif; ?>
                <div class="course-bottom-block">
                    <?php
                        $oldCoursePrice = round($item['OLD_PRICE']) ?: null;
                        $coursePrice = round($item['PROPERTIES']['course_price']['VALUE']) ?: null;

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
                    <?php if ($item['PROPERTIES']['IS_NEW']['VALUE']) : ?>
                        <div class="is_new-course-block">
                            <?= Functions::buildSVG('is_new', $templateFolder . '/images') ?>
                            <span class="f-16"><?= Loc::getMessage('IS_NEW_COURSE') ?></span>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="mobile-bottom-block">
                    <div class="course-tags">
                        <?php if ($item['PROPERTIES']['COMPLEXITY']['VALUE']) : ?>
                            <div class="course-tag">
                                <span class="f-16">
                                    <?= $item['PROPERTIES']['COMPLEXITY']['VALUE'] ?>
                                </span>
                            </div>
                        <?php endif; ?>
                        <?php if ($item['PROPERTIES']['course_duration']['VALUE']) : ?>
                            <div class="course-tag">
                                <span class="f-16">
                                    <?= Functions::numWord($item['PROPERTIES']['course_duration']['VALUE'], ['час', 'часа', 'часов']) ?>
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if ($item['PROPERTIES']['IS_NEW']['VALUE']) : ?>
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