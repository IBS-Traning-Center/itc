<?php

use \Bitrix\Main\Localization\Loc;
use Local\Util\Functions;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

Loc::loadMessages(__FILE__);

/** @var $arParams */
/** @var $arResult */
/** @var $templateFolder */

global $APPLICATION;

$APPLICATION->SetPageProperty('title', $arResult['NAME']);
$APPLICATION->SetTitle($arResult['NAME']);
$APPLICATION->AddChainItem($arResult['NAME'], '');

$this->setFrameMode(false);
$settings = Functions::getSiteSettings();

if (!empty($arResult)) : ?>
    <div class="top-page-banner section-complex-page">
        <div class="container">
            <div class="banner-content">
                <?php $APPLICATION->IncludeComponent(
                    'bitrix:breadcrumb',
                    'bread',
                    [
                        'START_FROM' => '0',
                        'PATH' => '',
                        'SITE_ID' => 's1',
                    ],
                    false
                ); ?>
                <span class="f-16 courses-count"><?= Functions::numWord(count($arResult['COURSES']), ['курс', 'курса', 'курсов']) ?></span>
                <h1><?= $APPLICATION->GetTitle() ?></h1>
                <?php if ($arResult['COMPLEXITY']) : ?>
                    <div class="complexity-block">
                        <?php foreach ($arResult['COMPLEXITY'] as $complexity) : ?>
                            <div class="complexity-item">
                                <span class="f-16"><?= $complexity ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <?php if ($arResult['SHORT_DESCRIPTION']) : ?>
                    <p class="f-32"><?= $arResult['SHORT_DESCRIPTION'] ?></p>
                <?php endif; ?>
                <div class="course-info-block">
                    <div class="top-course-info_item">
                        <div class="top-course-info_item-icon">
                            <?= Functions::buildSVG('diplom_icon', $templateFolder . '/images') ?>
                        </div>
                        <div class="top-course-info_item-text">
                            <p class="f-20"><?= Loc::getMessage('DIPLOM_TEXT') ?></p>
                            <p class="f-20 show-diplom-btn"><?= Loc::getMessage('DIPLOM_BTN_SHOW_TEXT') ?></p>
                        </div>
                    </div>
                    <?php if ($arResult['DURATION']) : ?>
                        <div class="top-course-info_item">
                            <div class="top-course-info_item-icon">
                                <?= Functions::buildSVG('time_icon', $templateFolder . '/images') ?>
                            </div>
                            <div class="top-course-info_item-text">
                                <p class="f-20"><?= Loc::getMessage('HOUR_COUNT_TEXT', ['#COUNT#' => $arResult['DURATION']]) ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ($arResult['COURSE_FORMAT']) : ?>
                        <div class="top-course-info_item">
                            <div class="top-course-info_item-icon">
                                <?= Functions::buildSVG('online_icon', $templateFolder . '/images') ?>
                            </div>
                            <div class="top-course-info_item-text">
                                <p class="f-20"><?= $arResult['COURSE_FORMAT'] ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="btn-banner-block">
                <?php if ($arResult['PRICE']) : ?>
                    <h2 class="course-price"><?= $arResult['PRICE'] . ' ₽' ?></h2>
                <?php endif; ?>
                <?php if ($arResult['PRICE_UR']) : ?>
                    <p class="f-20 course-ur-price"><?= Loc::getMessage('COURSE_UR_PRICE', ['#PRICE#' => $arResult['PRICE_UR']]) ?></p>
                <?php endif; ?>
                <?php if ($settings['MONEY_RETURN_LINK']) : ?>
                    <a class="f-16 return-money" href="<?= $settings['MONEY_RETURN_LINK'] ?>"><?= Loc::getMessage('RETURN_MONEY_TEXT') ?></a>
                <?php endif; ?>
                <div class="buttons-block">
                    <button class="btn-main size-l open-sign-modal">
                        <span class="f-24"><?= Loc::getMessage('MAIN_BTN_TEXT') ?></span>
                    </button>
                    <button class="btn-main open-sign-modal">
                        <span class="f-16"><?= Loc::getMessage('DEMO_BTN_TEXT') ?></span>
                    </button>
                    <button class="btn-main open-sign-modal">
                        <span class="f-16"><?= Loc::getMessage('TEST_BTN_TEXT') ?></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="main-content-complex-course container">
        <div class="left-block">
            <?php if ($arResult['DESCRIPTION']) : ?>
                <h2><?= Loc::getMessage('DESCRIPTION_COURSE_TITLE') ?></h2>
                <div class="f-20">
                    <?= $arResult['DESCRIPTION'] ?>
                </div>
            <?php endif; ?>
            <?php if (!empty($arResult['WHO_COURSE'])) : ?>
                <h2><?= Loc::getMessage('WHO_COURSE_TITLE') ?></h2>
                <div class="who-course-block">
                    <?php foreach ($arResult['WHO_COURSE'] as $item) : ?>
                        <div class="who-course-item">
                            <img src="<?= $item['UF_PICTURE'] ?>" alt="<?= $item['UF_NAME'] ?>">
                            <span class="f-20"><?= $item['UF_NAME'] ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <?php if (!empty($arResult['COURSES'])) : ?>
                <h2><?= Loc::getMessage('COURSES_LINK_TITLE') ?></h2>
                <div class="linked-courses-block">
                    <?php foreach ($arResult['COURSES'] as $course) : ?>
                        <div class="linked-course-item">
                            <div class="linked-course-content">
                                <?php if ($course['CODE']) : ?>
                                    <span class="f-16 num"><?= $course['CODE'] ?></span>
                                <?php endif; ?>
                                <p class="f-32 course-name"><?= $course['NAME'] ?></p>
                                <?= Functions::buildSVG('arrow_right_icon', $templateFolder . '/images') ?>
                            </div>
                            <div class="linked-course-hide-block">
                                <?php if ($course['COMPLEXITY'] || $course['DURATION']) : ?>
                                    <div class="hidden-tags-block">
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
                                <?php endif; ?>
                                <div class="hidden-description-block">
                                    <?php if ($course['DESCRIPTION']) : ?>
                                        <p class="f-16"><?= $course['DESCRIPTION'] ?></p>
                                    <?php endif; ?>
                                    <a href="/kurs/<?= $course['XML_ID'] ?>/" class="linked-course-link">
                                        <span class="f-16"><?= Loc::getMessage('LINKED_COURSE_LINK_TEXT') ?></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <div class="mobile-buttons-block">
                <?php if ($arResult['PRICE']) : ?>
                    <h2 class="course-price"><?= $arResult['PRICE'] . ' ₽' ?></h2>
                <?php endif; ?>
                <?php if ($arResult['PRICE_UR']) : ?>
                    <p class="f-20 course-ur-price"><?= Loc::getMessage('COURSE_UR_PRICE', ['#PRICE#' => $arResult['PRICE_UR']]) ?></p>
                <?php endif; ?>
                <?php if ($settings['MONEY_RETURN_LINK']) : ?>
                    <a class="f-16 return-money" href="<?= $settings['MONEY_RETURN_LINK'] ?>"><?= Loc::getMessage('RETURN_MONEY_TEXT') ?></a>
                <?php endif; ?>
                <div class="buttons-block">
                    <button class="btn-main size-l open-sign-modal">
                        <span class="f-24"><?= Loc::getMessage('MAIN_BTN_TEXT') ?></span>
                    </button>
                    <button class="btn-main open-sign-modal">
                        <span class="f-16"><?= Loc::getMessage('DEMO_BTN_TEXT') ?></span>
                    </button>
                    <button class="btn-main open-sign-modal">
                        <span class="f-16"><?= Loc::getMessage('TEST_BTN_TEXT') ?></span>
                    </button>
                </div>
            </div>
        </div>
        <div class="right-block">
            <?php if ($arResult['PRICE']) : ?>
                <h2 class="course-price"><?= $arResult['PRICE'] . ' ₽' ?></h2>
            <?php endif; ?>
            <?php if ($arResult['PRICE_UR']) : ?>
                <p class="f-20 course-ur-price"><?= Loc::getMessage('COURSE_UR_PRICE', ['#PRICE#' => $arResult['PRICE_UR']]) ?></p>
            <?php endif; ?>
            <?php if ($settings['MONEY_RETURN_LINK']) : ?>
                <a class="f-16 return-money" href="<?= $settings['MONEY_RETURN_LINK'] ?>"><?= Loc::getMessage('RETURN_MONEY_TEXT') ?></a>
            <?php endif; ?>
            <div class="buttons-block">
                <button class="btn-main size-l open-sign-modal">
                    <span class="f-24"><?= Loc::getMessage('MAIN_BTN_TEXT') ?></span>
                </button>
                <button class="btn-main open-sign-modal">
                    <span class="f-16"><?= Loc::getMessage('DEMO_BTN_TEXT') ?></span>
                </button>
                <button class="btn-main open-sign-modal">
                    <span class="f-16"><?= Loc::getMessage('TEST_BTN_TEXT') ?></span>
                </button>
            </div>
        </div>
    </div>
    <?php if (!empty($arResult['TARIFFS'])) : ?>
        <div class="tariffs-block">
            <div class="container">
                <h2><?= Loc::getMessage('TARIFFS_BLOCK_TITLE') ?></h2>
                <div class="tariffs-items">
                    <?php foreach ($arResult['TARIFFS'] as $tariff) : ?>
                        <div class="tariff-item">
                            <?php if ($tariff['TYPE']) : ?>
                                <h3><?= $tariff['TYPE'] ?></h3>
                            <?php endif; ?>
                            <?php if ($tariff['SHORT_DESCRIPTION']) : ?>
                                <p class="f-20 tariff-short-description"><?= $tariff['SHORT_DESCRIPTION'] ?></p>
                            <?php endif; ?>
                            <?php if ($tariff['DESCRIPTION']) : ?>
                                <div class="f-20 tariff-description">
                                    <?= $tariff['DESCRIPTION'] ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($tariff['PRICE'] || $tariff['TIME_PRICE']) : ?>
                                <div class="tariff-price-block">
                                    <?php if ($tariff['PRICE']) : ?>
                                        <div class="main-price">
                                            <span class="f-20"><?= Loc::getMessage('TARIFF_PRICE_BLOCK_TEXT') ?></span>
                                            <span class="price-text"><?= $tariff['PRICE'] . ' ₽' ?></span>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($tariff['TIME_PRICE']) : ?>
                                        <div class="time-price">
                                            <span class="f-20"><?= Loc::getMessage('TARIFF_TIME_PRICE_BLOCK_TEXT') ?></span>
                                            <span class="price-text"><?= $tariff['PRICE'] . ' ₽/мес.' ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($tariff['FOOTNOTE'] && $tariff['FOOTNOTE']['TEXT']) : ?>
                                <div class="footnote-block">
                                    <?= $tariff['FOOTNOTE']['TEXT'] ?>
                                </div>
                            <?php endif; ?>
                            <div class="sign-tariff-btn">
                                <span class="f-16"><?= Loc::getMessage('SIGN_TARIFF_BTN_TEXT') ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if ($arResult['COURSES']) : ?>
        <div class="linked-courses-slider">
            <h2 class="container"><?= Loc::getMessage('LINKED_COURSES_BLOCK_TITLE') ?></h2>
            <div class="linked-courses-content">
                <?php foreach ($arResult['COURSES'] as $course) : ?>
                    <a href="/kurs/<?= $course['XML_ID'] ?>/" class="course-block">
                        <div class="top-course-block">
                            <?php if ($course['CODE']) : ?>
                                <span class="f-14 course-code"><?= $course['CODE'] ?></span>
                            <?php endif; ?>
                            <?php if ($course['COMPLEXITY'] || $course['DURATION']) : ?>
                                <div class="tags-course-block">
                                    <?php if ($course['COMPLEXITY']) : ?>
                                        <div class="course-tag">
                                            <span class="f-16"><?= $course['COMPLEXITY'] ?></span>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($course['DURATION']) : ?>
                                        <div class="course-tag">
                                            <span class="f-16"><?= Functions::numWord($course['DURATION'], ['час', 'часа', 'часов']) ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <p class="f-24 course-name"><?= $course['NAME'] ?></p>
                        <?php if ($course['DESCRIPTION']) : ?>
                            <p class="f-16 course-description"><?= $course['DESCRIPTION'] ?></p>
                        <?php endif; ?>
                        <?php if ($course['PRICE']) : ?>
                            <p class="course-price"><?= $course['PRICE'] . ' ₽' ?></p>
                        <?php endif; ?>
                        <?php if ($course['COMPLEXITY'] || $course['DURATION']) : ?>
                            <div class="mobile-tags-course-block">
                                <?php if ($course['COMPLEXITY']) : ?>
                                    <div class="course-tag">
                                        <span class="f-16"><?= $course['COMPLEXITY'] ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if ($course['DURATION']) : ?>
                                    <div class="course-tag">
                                        <span class="f-16"><?= Functions::numWord($course['DURATION'], ['час', 'часа', 'часов']) ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>
