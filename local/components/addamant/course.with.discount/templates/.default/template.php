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

$defaultCourseImage = $templateFolder . '/images/default_course_image.png';

if (!empty($arResult['COURSES'])) : ?>
    <div class="courses-with-discount-block">
        <?php
            $dopClass = '';

            if (count($arResult['COURSES']) == 1) {
                $dopClass = 'one-elem';
            } elseif (count($arResult['COURSES']) == 2) {
                $dopClass = 'two-elem';
            } elseif (count($arResult['COURSES']) > 2) {
                $dopClass = 'more-elem';
            }
        ?>
        <div class="discount-courses-block container">
            <div id="coursesDiscountSlider" class="<?= $dopClass ?>">
                <?php foreach ($arResult['COURSES'] as $course) : ?>
                    <a href="/kurs/<?= $course['XML_ID'] ?>.html" class="discount-course-item">
                        <div class="image-block">
                            <img src="<?= $course['PICTURE'] ?: $defaultCourseImage ?>" alt="<?= $course['NAME'] ?>">
                        </div>
                        <div class="course-info-block">
                            <div class="course-middle-block">
                                <div class="course-text-info">
                                    <p class="f-32 course-name"><?= $course['NAME'] ?></p>
                                    <?php if ($course['DESCRIPTION']) : ?>
                                        <p class="f-20 course-description">
                                            <?= HTMLToTxt($course['DESCRIPTION']) ?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                                <?php if ($course['COURSE_DURATION'] || $course['COMPLEXITY']) : ?>
                                    <div class="course-tags">
                                        <?php if ($course['COURSE_DURATION']) : ?>
                                            <div class="course-tag-duration">
                                                <div class="course-tag">
                                                    <span class="f-16"><?= Functions::numWord($course['COURSE_DURATION'], ['час', 'часа', 'часов']) ?></span>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($course['COMPLEXITY']) : ?>
                                            <div class="course-tags-complexity">
                                                <div class="course-tag">
                                                    <span class="f-16"><?= $course['COMPLEXITY'] ?></span>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="course-bottom-block">
                                <?php if ($course['OLD_PRICE']) : ?>
                                    <p class="f-20 old-course-price"><?= number_format($course['OLD_PRICE'], 0, '', ' ') ?></p>
                                <?php endif; ?>
                                <?php if ($course['NEW_PRICE']) : ?>
                                    <p class="f-32 new-course-price"><?= number_format($course['NEW_PRICE'], 0, '', ' ') . ' ₽' ?></p>
                                <?php endif; ?>
                                <?php if ($course['IS_NEW'] === 'Y') : ?>
                                    <div class="is-new-course">
                                        <?= Functions::buildSVG('is_new', $templateFolder . '/images') ?>
                                        <span class="f-16"><?= Loc::getMessage('IS_NEW_TEXT') ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="bottom-mobile-block">
                                <?php if ($course['COURSE_DURATION'] || $course['COMPLEXITY']) : ?>
                                    <div class="course-tags">
                                        <?php if ($course['COURSE_DURATION']) : ?>
                                            <div class="course-tag-duration">
                                                <div class="course-tag">
                                                    <span class="f-16"><?= Functions::numWord($course['COURSE_DURATION'], ['час', 'часа', 'часов']) ?></span>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($course['COMPLEXITY']) : ?>
                                            <div class="course-tags-complexity">
                                                <div class="course-tag">
                                                    <span class="f-16"><?= $course['COMPLEXITY'] ?></span>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php //if ($course['IS_NEW'] === 'Y') : ?>
                                        <div class="is-new-course">
                                            <?= Functions::buildSVG('is_new', $templateFolder . '/images') ?>
                                            <span class="f-16"><?= Loc::getMessage('IS_NEW_TEXT') ?></span>
                                        </div>
                                    <?php //endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if ($course['DISCOUNT_PERCENT']) : ?>
                            <div class="discount-percent-course">
                                <?= Functions::buildSVG('discount', $templateFolder . '/images') ?>
                                <span class="f-16"><?= Loc::getMessage('DISCOUNT_TEXT') . ' ' . $course['DISCOUNT_PERCENT'] . '%' ?></span>
                            </div>
                        <?php endif; ?>
                    </a>
                <?php endforeach; ?>
            </div>
            <?php if (count($arResult['COURSES']) > 2) : ?>
                <div class="slick-slider-arrows-block"></div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>