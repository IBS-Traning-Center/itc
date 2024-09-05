<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;
use Local\Util\Functions;

/**
 * @var CBitrixComponent $this
 * @var array $arParams
 * @var array $arResult
 * @var string $componentPath
 * @var string $componentName
 * @var string $componentTemplate
 * @global CUser $USER
 * @global CMain $APPLICATION
 * @var string $templateFolder
 **/

Loc::loadMessages(__FILE__);

$settings = Functions::getSiteSettings();
?>

<div class="course-detail-block">
    <div class="top-page-banner course-detail">
        <div class="container">
            <div class="banner-content">
                <div class="left-banner-block">
                    <p class="f-16 course-code"><?= $arResult['code'] ?: '' ?></p>
                    <h1><?= $arResult['name'] ?: '' ?></h1>
                    <?php if ($arResult['complexity'] || $arResult['is_new']) : ?>
                        <div class="tags-banner-block">
                            <?php if ($arResult['complexity']) : ?>
                                <div class="banner-tag">
                                    <span class="f-16"><?= $arResult['complexity'] ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if ($arResult['is_new']) : ?>
                                <div class="banner-tag">
                                    <?= Functions::buildSVG('new_icon', $templateFolder . '/images') ?>
                                    <span class="f-16"><?= Loc::getMessage('NEW_COURSE_TEXT') ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($arResult['content']['shortDescription']) : ?>
                        <p class="f-32 short-description"><?= $arResult['content']['shortDescription'] ?></p>
                    <?php endif; ?>
                    <div class="top-course-info">
                        <div class="top-course-info_item">
                            <div class="top-course-info_item-icon">
                                <?= Functions::buildSVG('diplom_icon', $templateFolder . '/images') ?>
                            </div>
                            <div class="top-course-info_item-text">
                                <p class="f-20"><?= Loc::getMessage('DIPLOM_TEXT') ?></p>
                                <p class="f-20 show-diplom-btn"><?= Loc::getMessage('DIPLOM_BTN_SHOW_TEXT') ?></p>
                            </div>
                        </div>
                        <?php if ($arResult['duration']) : ?>
                            <div class="top-course-info_item">
                                <div class="top-course-info_item-icon">
                                    <?= Functions::buildSVG('time_icon', $templateFolder . '/images') ?>
                                </div>
                                <div class="top-course-info_item-text">
                                    <p class="f-20"><?= Loc::getMessage('HOUR_COUNT_TEXT', ['#COUNT#' => $arResult['duration']]) ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($arResult['city']) : ?>
                            <div class="top-course-info_item">
                                <div class="top-course-info_item-icon">
                                    <?= Functions::buildSVG('online_icon', $templateFolder . '/images') ?>
                                </div>
                                <div class="top-course-info_item-text">
                                    <p class="f-20"><?= $arResult['city'] ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="right-banner-block">
                    <div class="price-course-block">
                        <?php if (
                            !empty($arResult['schedule'][0]['sale']) && !empty($arResult['sale']) &&
                            $arResult['schedule'][0]['sale']['price'] < $arResult['sale']['price']
                        ) : ?>
                            <p class="f-24 old-course-price">
                                <?= $arResult['sale']['price'] ?>
                            </p>
                            <p class="course-price">
                                <?= $arResult['schedule'][0]['sale']['price'] . ' ₽' ?>
                            </p>
                        <?php elseif (!empty($arResult['sale'])) : ?>
                            <h2 class="course-price">
                                <?= $arResult['sale']['price'] . ' ₽' ?>
                            </h2>
                        <?php endif; ?>
                    </div>
                    <?php if (
                        $arResult['schedule'][0]['sale']['price_ur'] && $arResult['price_ur'] &&
                        $arResult['schedule'][0]['sale']['price_ur'] < $arResult['price_ur']
                    ) : ?>
                        <p class="f-20"><?= Loc::getMessage('PRICE_UR_TEXT', ['#PRICE#' => $arResult['schedule'][0]['sale']['price_ur']]) ?></p>
                    <?php elseif ($arResult['price_ur']) : ?>
                        <p class="f-20"><?= Loc::getMessage('PRICE_UR_TEXT', ['#PRICE#' => $arResult['price_ur']]) ?></p>
                    <?php endif; ?>
                    <?php if ($settings['MONEY_RETURN_LINK']) : ?>
                        <a href="<?= $settings['MONEY_RETURN_LINK'] ?>" class="f-16 return-money-block"><?= Loc::getMessage('RETURN_MONEY_TEXT') ?></a>
                    <?php endif; ?>
                    <?php ?>
                    <a href="#sign" class="btn-main size-l">
                        <span class="f-24"><?= Loc::getMessage('SIGN_TEXT_BTN') ?></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="course-content container">
        <div class="left-content-block">
            <?php if ($arResult['language'] == 'Английский') : ?>
                <div class="info-lang-block">
                    <h5 class="f-bold f-20"><?= Loc::getMessage('LANG_BLOCK_TITLE') ?></h5>
                    <p class="f-16"><?= Loc::getMessage('LANG_BLOCK_TEXT') ?></p>
                    <a class="f-16" target="_blank" href="https://rutube.ru/channel/30034572/videos/"><?= Loc::getMessage('LANG_BLOCK_LINK_TEXT') ?></a>
                </div>
            <?php endif; ?>
            <?php if ($arResult['content']['description']) : ?>
                <h2><?= Loc::getMessage('ABOUT_COURSE_TITLE') ?></h2>
                <div class="f-20"><?= $arResult['content']['description'] ?></div>
            <?php endif; ?>
            <?php if ($arResult['for_course'] && is_array($arResult['for_course'])) : ?>
                <h2><?= Loc::getMessage('FOR_COURSE_TITLE') ?></h2>
                <div class="for-course-block">
                    <?php foreach ($arResult['for_course'] as $item) : ?>
                        <div class="for-course-item">
                            <img src="<?= $item['UF_PICTURE'] ?>" alt="<?= $item['UF_NAME'] ?>">
                            <span class="f-20"><?= $item['UF_NAME'] ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <?php if ($arResult['skills_course'] && is_array($arResult['skills_course'])) : ?>
                <h2><?= Loc::getMessage('SKILLS_IMPROVED_TITLE') ?></h2>
                <div class="skills-improved-block">
                    <?php foreach ($arResult['skills_course'] as $item) : ?>
                        <div class="skill-course-item">
                            <span class="f-16"><?= $item['UF_NAME'] ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <?php if (!empty($arResult['content']['roadmapBlocks'])) : ?>
                <h2><?= Loc::getMessage('THEMES_TITLE') ?></h2>
                <div class="themes-block">
                    <?php foreach ($arResult['content']['roadmapBlocks'] as $num => $roadItem) : ?>
                        <?php $num++; ?>
                        <div class="theme-item-block">
                            <div class="theme-item-content">
                                <span class="f-16 num"><?= ($num < 10) ? '0' . $num : $num ?></span>
                                <span class="f-32"><?= $roadItem['title'] ?></span>
                                <div class="theme-item-icons-block">
                                    <div class="arrow">
                                        <?= Functions::buildSVG('arrow', $templateFolder . '/images') ?>
                                    </div>
                                    <div class="minus">
                                        <?= Functions::buildSVG('minus', $templateFolder . '/images') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="theme-hidden-content">
                                <?= $roadItem['description'] ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <div class="mobile-detail-course-info-block">
                <div class="price-course-block">
                    <?php if (
                        !empty($arResult['schedule'][0]['sale']) && !empty($arResult['sale']) &&
                        $arResult['schedule'][0]['sale']['price'] < $arResult['sale']['price']
                    ) : ?>
                        <p class="f-24 old-course-price">
                            <?= $arResult['sale']['price'] ?>
                        </p>
                        <p class="course-price">
                            <?= $arResult['schedule'][0]['sale']['price'] . ' ₽' ?>
                        </p>
                    <?php elseif (!empty($arResult['sale'])) : ?>
                        <h2 class="course-price">
                            <?= $arResult['sale']['price'] . ' ₽' ?>
                        </h2>
                    <?php endif; ?>
                </div>
                <?php if (
                    $arResult['schedule'][0]['sale']['price_ur'] && $arResult['price_ur'] &&
                    $arResult['schedule'][0]['sale']['price_ur'] < $arResult['price_ur']
                ) : ?>
                    <p class="f-20"><?= Loc::getMessage('PRICE_UR_TEXT', ['#PRICE#' => $arResult['schedule'][0]['sale']['price_ur']]) ?></p>
                <?php elseif ($arResult['price_ur']) : ?>
                    <p class="f-20"><?= Loc::getMessage('PRICE_UR_TEXT', ['#PRICE#' => $arResult['price_ur']]) ?></p>
                <?php endif; ?>
                <?php if ($settings['MONEY_RETURN_LINK']) : ?>
                    <a href="<?= $settings['MONEY_RETURN_LINK'] ?>" class="f-16 return-money-block"><?= Loc::getMessage('RETURN_MONEY_TEXT') ?></a>
                <?php endif; ?>
                <?php ?>
                <a href="#sign" class="btn-main size-l">
                    <span class="f-24"><?= Loc::getMessage('SIGN_TEXT_BTN') ?></span>
                </a>
            </div>
            <?php if (!empty($arResult['what_learn'])) : ?>
                <h2><?= Loc::getMessage('WHAT_LEARN_TITLE') ?></h2>
                <div class="what-learn-block">
                    <?php foreach ($arResult['what_learn'] as $num => $value) : ?>
                        <?php $num++; ?>
                        <div class="what-learn-item">
                            <span class="f-16 num"><?= ($num < 10) ? '0' . $num : $num ?></span>
                            <span class="f-20"><?= $value ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <?php if ($arResult['schedule'][0]['trainer']) : ?>
                <?php $trainer = $arResult['schedule'][0]['trainer']; ?>
                <h2><?= Loc::getMessage('COURSE_LEADER_TITLE') ?></h2>
                <div class="leader-block">
                    <div class="top-leader-block">
                        <div class="trainer-image-block">
                            <img src="<?= $trainer['PICTURE'] ?>" alt="<?= $trainer['NAME'] ?>">
                        </div>
                        <div class="trainer-info-block">
                            <h3><?= $trainer['NAME'] ? $trainer['SURNAME'] . ' ' . $trainer['NAME'] : $trainer['SURNAME'] ?></h3>
                            <?php if ($trainer['SHORT_DESCRIPTION']) : ?>
                                <div class="trainer-short-desc-block">
                                    <span class="f-18"><?= $trainer['SHORT_DESCRIPTION'] ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if ($trainer['LEVEL']) : ?>
                                <p class="f-20"><?= $trainer['LEVEL'] ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="trainer-main-info-block">
                        <?php if (!empty($trainer['EXPERIENCE'])) : ?>
                            <div class="first-experience-block">
                                <?= $trainer['EXPERIENCE'][0]['TEXT'] ?>
                            </div>
                            <div class="trainer-experience-block">
                                <?php foreach ($trainer['EXPERIENCE'] as $key => $value) : ?>
                                    <?php if ($key == 0) {
                                        continue;
                                    } ?>
                                    <div class="trainer-experience-item">
                                        <?= $value['TEXT'] ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($trainer['ABOUT_PROJECTS'])) : ?>
                            <h4><?= Loc::getMessage('ABOUT_PROJECTS_TITLE') ?></h4>
                            <div class="about-projects-block">
                                <?= $trainer['ABOUT_PROJECTS']['TEXT'] ?>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($trainer['CLIENTS'])) : ?>
                            <h4><?= Loc::getMessage('COMPANY_TITLE') ?></h4>
                            <div class="clients-block">
                                <?php foreach ($trainer['CLIENTS'] as $client) : ?>
                                    <div class="clients-item">
                                        <?php if ($client['PICTURE']) : ?>
                                            <img src="<?= $client['PICTURE'] ?>" alt="<?= $client['NAME'] ?>">
                                        <?php else : ?>
                                            <p class="f-20"><?= $client['NAME'] ?></p>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($trainer['CERTIFICATES'])) : ?>
                            <h4><?= Loc::getMessage('CERT_TITLE') ?></h4>
                            <div class="cert-block">
                                <?php foreach ($trainer['CERTIFICATES'] as $cert) : ?>
                                    <div class="cert-item">
                                        <?php if ($cert['PICTURE']) : ?>
                                            <div class="cert-picture">
                                                <img src="<?= $cert['PICTURE'] ?>">
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($cert['TEXT']) : ?>
                                            <p class="f-20"><?= $cert['TEXT'] ?></p>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($trainer['TRAINER_ORG'])) : ?>
                            <?php $name = $trainer['NAME'] ?: $trainer['SURNAME'] ?>
                            <h4><?= Loc::getMessage('ORG_MEMBER', ['#NAME#' => $name]) ?></h4>
                            <ul class="trainer-org">
                                <?php foreach ($trainer['TRAINER_ORG'] as $org) : ?>
                                    <li><?= $org ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="right-content-block">
            <div class="price-course-block">
                <?php if (
                    !empty($arResult['schedule'][0]['sale']) && !empty($arResult['sale']) &&
                    $arResult['schedule'][0]['sale']['price'] < $arResult['sale']['price']
                ) : ?>
                    <p class="f-24 old-course-price">
                        <?= $arResult['sale']['price'] ?>
                    </p>
                    <p class="course-price">
                        <?= $arResult['schedule'][0]['sale']['price'] . ' ₽' ?>
                    </p>
                <?php elseif (!empty($arResult['sale'])) : ?>
                    <h2 class="course-price">
                        <?= $arResult['sale']['price'] . ' ₽' ?>
                    </h2>
                <?php endif; ?>
            </div>
            <?php if (
                $arResult['schedule'][0]['sale']['price_ur'] && $arResult['price_ur'] &&
                $arResult['schedule'][0]['sale']['price_ur'] < $arResult['price_ur']
            ) : ?>
                <p class="f-20"><?= Loc::getMessage('PRICE_UR_TEXT', ['#PRICE#' => $arResult['schedule'][0]['sale']['price_ur']]) ?></p>
            <?php elseif ($arResult['price_ur']) : ?>
                <p class="f-20"><?= Loc::getMessage('PRICE_UR_TEXT', ['#PRICE#' => $arResult['price_ur']]) ?></p>
            <?php endif; ?>
            <?php if ($settings['MONEY_RETURN_LINK']) : ?>
                <a href="<?= $settings['MONEY_RETURN_LINK'] ?>" class="f-16 return-money-block"><?= Loc::getMessage('RETURN_MONEY_TEXT') ?></a>
            <?php endif; ?>
            <?php ?>
            <a href="#sign" class="btn-main size-l">
                <span class="f-24"><?= Loc::getMessage('SIGN_TEXT_BTN') ?></span>
            </a>
        </div>
    </div>
</div>
<div id="sign">
    <?php
        $coursePrice = 0;
        $oldPrice = 0;
        $urPrice = 0;

        if (
            !empty($arResult['schedule'][0]['sale']) && !empty($arResult['sale']) &&
            $arResult['schedule'][0]['sale']['price'] < $arResult['sale']['price']
        ) {
            $coursePrice = $arResult['schedule'][0]['sale']['price'];
            $oldPrice = $arResult['sale']['price'];
        } elseif (!empty($arResult['sale'])) {
            $coursePrice = $arResult['sale']['price'];
        }

        if (
            $arResult['schedule'][0]['sale']['price_ur'] && $arResult['price_ur'] &&
            $arResult['schedule'][0]['sale']['price_ur'] < $arResult['price_ur']
        ) {
            $urPrice = $arResult['schedule'][0]['sale']['price_ur'];
        } elseif ($arResult['price_ur']) {
            $urPrice = $arResult['price_ur'];
        }

        $schedule = [];
        if ($arResult['schedule']) {
            foreach ($arResult['schedule'] as $item) {
                $date = $item['date']['start'] . ', ' . $item['city'];
                $schedule[] = $date;
            }
        }
    ?>
    <?php $APPLICATION->IncludeComponent(
        "bitrix:form.result.new",
        "sign.course",
        Array(
            "CACHE_TIME" => "3600",
            "CACHE_TYPE" => "A",
            "CHAIN_ITEM_LINK" => "",
            "CHAIN_ITEM_TEXT" => "",
            "EDIT_URL" => "",
            "IGNORE_CUSTOM_TEMPLATE" => "N",
            "LIST_URL" => "",
            "SEF_MODE" => "N",
            "SUCCESS_URL" => "",
            "AJAX_MODE" => "Y",
            "USE_EXTENDED_ERRORS" => "N",
            "VARIABLE_ALIASES" => Array("RESULT_ID"=>"RESULT_ID","WEB_FORM_ID"=>"WEB_FORM_ID"),
            "WEB_FORM_ID" => "40",
            "COURSE_ID" => $arResult['id'],
            "COURSE_PRICE" => $coursePrice,
            "OLD_PRICE" => $oldPrice,
            "UR_PRICE" => $urPrice,
            'DATES' => $schedule
        )
    );?>
</div>
<?php $APPLICATION->IncludeComponent(
    "addamant:main.page.reviews",
    ".default",
    Array(
        "CACHE_TIME" => "3600",
        "CACHE_TYPE" => "A",
        'BLOCK_TITLE' => 'Отзывы о курсе',
        'KVAL_LINK' => '#',
        'NEEDLE_COURSE_ID' => $arResult['id']
    )
);?>
<?php if ($arResult['courses']) : ?>
    <div class="container linked-courses-title-block">
        <h2><?= Loc::getMessage('LINKED_CORSES_TITLE') ?></h2>
    </div>
    <div class="linked-courses-block">
        <?php foreach ($arResult['courses'] as $course) : ?>
            <a href="<?= $course['link'] ?>" class="linked-course-block">
                <div class="linked-course-top-block">
                    <?php if ($course['code']) : ?>
                        <span class="f-14"><?= $course['code'] ?></span>
                    <?php endif; ?>
                    <?php if ($course['duration']) : ?>
                        <div class="linked-course-duration">
                            <span class="f-16"><?= Functions::numWord($course['duration'], ['час', 'часа', 'часов']) ?></span>
                        </div>
                    <?php endif; ?>
                </div>
                <p class="f-24 course-name"><?= $course['name'] ?></p>
                <?php if ($course['description']) : ?>
                    <p class="f-16 course-description"><?= $course['description'] ?></p>
                <?php endif; ?>
                <div class="linked-course-bottom-block">
                    <?php if ($course['complexity']) : ?>
                        <div class="linked-course-complexity">
                            <span class="f-16"><?= 'от ' . $course['complexity'] ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if ($course['price']) : ?>
                        <p class="f-24 course-price"><?= $course['price'] . ' ₽' ?></p>
                    <?php endif; ?>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<div class="our-students-block">
    <div class="container">
        <h2><?= Loc::getMessage('OUT_STUDENTS_TITLE') ?></h2>
    </div>
    <?php $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "our.clients",
        Array(
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "ADD_SECTIONS_CHAIN" => "N",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "Y",
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "A",
            "CHECK_DATES" => "Y",
            "DETAIL_URL" => "",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "DISPLAY_TOP_PAGER" => "N",
            "FIELD_CODE" => array("",""),
            "FILTER_NAME" => "",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "IBLOCK_ID" => "63",
            "IBLOCK_TYPE" => "edu",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "INCLUDE_SUBSECTIONS" => "Y",
            "MESSAGE_404" => "",
            "NEWS_COUNT" => "500",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => ".default",
            "PAGER_TITLE" => "Новости",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "PREVIEW_TRUNCATE_LEN" => "",
            "PROPERTY_CODE" => array("",""),
            "SET_BROWSER_TITLE" => "N",
            "SET_LAST_MODIFIED" => "N",
            "SET_META_DESCRIPTION" => "N",
            "SET_META_KEYWORDS" => "N",
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "N",
            "SHOW_404" => "N",
            "SORT_BY1" => "SORT",
            "SORT_BY2" => "ID",
            "SORT_ORDER1" => "DESC",
            "SORT_ORDER2" => "ASC",
            "STRICT_SECTION_CHECK" => "N"
        )
    );?>
</div>
<div class="diploma-modal">
    <div class="diploma-modal-content">
        <img src="<?= $templateFolder . '/images/diplom.png' ?>">
    </div>
</div>
<div class="diploma-modal-close-btn">
    <?= Functions::buildSVG('close-modal-icon', $templateFolder . '/images') ?>
</div>
<div class="background-modal"></div>