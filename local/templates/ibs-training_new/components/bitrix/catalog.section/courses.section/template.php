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
            <?php

            $showCartButton = $item['SHOW_CART_BUTTON'] ?? false;
            ?>
            <div class="course-block-wrapper">
                <a href="/kurs/<?= $item['XML_ID'] ?>.html" class="course-block">
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
                        <?php if ($item['PROPERTIES']['PRICE_ON_REQUEST']['VALUE']) : ?>
                            <span class="f-24 new-course-price"><?= Loc::getMessage('PRICE_ON_REQUEST') ?></span>
                        <?php endif; ?>
                        <?php if (!$item['PROPERTIES']['PRICE_ON_REQUEST']['VALUE']) : ?>
                            <?php
                            $oldCoursePrice = round($item['OLD_PRICE']) ?: null;
                            $coursePrice = round($item['PROPERTIES']['course_price']['VALUE']) ?: null;

                            if (
                                !is_null($oldCoursePrice) &&
                                !is_null($coursePrice) &&
                                $coursePrice < $oldCoursePrice
                            ) : ?>
                                <span class="f-20 old-course-price"><?= number_format($oldCoursePrice, 0, '', ' '); ?></span>
                                <span class="f-24 new-course-price"><?= number_format($coursePrice, 0, '', ' '); ?> ₽</span>
                            <?php elseif ($coursePrice > 0) : ?>
                                <span class="f-24 new-course-price"><?= number_format($coursePrice, 0, '', ' '); ?> ₽</span>
                            <?php else : ?>
                                <span class="f-24 new-course-price"><?= Loc::getMessage('FREE_TEXT_COURSE') ?></span>
                            <?php endif;
                            ?>
                        <?php endif; ?>
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

                    <?php if ($showCartButton) { ?>
                        <button
                                class="btn-add-to-cart add-to-cart-btn"
                                data-course-id="<?= $item['ID'] ?>"
                                data-course-name="<?= htmlspecialcharsbx($item['NAME']) ?>"
                                data-course-price="<?= $item['SCHEDULE_PRICE'] ?? 0 ?>"
                                data-schedule-id="<?= $item['SCHEDULE_ID'] ?? 0 ?>"
                                data-schedule-name="<?= htmlspecialcharsbx($item['SCHEDULE_NAME'] ?? '') ?>"
                                data-schedule-start="<?= $item['SCHEDULE_START_DATE'] ?? '' ?>"
                                data-schedule-end="<?= $item['SCHEDULE_END_DATE'] ?? '' ?>"
                        >
                            В корзину
                        </button>
<?php }?>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>