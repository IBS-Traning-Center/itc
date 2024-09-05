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

if (!empty($arResult['STUDENTS_REVIEWS']) || !empty($arResult['COMPANY_REVIEWS'])) : ?>
    <div class="reviews-main-block">
        <div class="container">
            <div class="reviews-top-block">
                <h1><?= $arResult['BLOCK_TITLE'] ?: Loc::getMessage('BLOCK_TITLE') ?></h1>
                <div class="reviews-top-block_buttons">
                    <a href="<?= $arResult['KVAL_LINK'] ?: '' ?>" class="btn-main size-l">
                        <span class="f-24"><?= Loc::getMessage('BTN_KVAL_TEXT') ?></span>
                    </a>
                    <span class="f-24"><?= Loc::getMessage('UNDER_BTN_TEXT') ?></span>
                </div>
            </div>
            <div class="reviews-tabs-block">
                <div class="tabs">
                    <?php if (!empty($arResult['COMPANY_REVIEWS'])) : ?>
                        <div id="companyReviewsTab" class="active">
                            <span class="f-16"><?= Loc::getMessage('COMPANY_REVIEWS_TAB_TEXT') ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($arResult['STUDENTS_REVIEWS'])) : ?>
                        <div id="studentsReviewsTab" class="<?= (empty($arResult['COMPANY_REVIEWS'])) ? 'active' : '' ?>">
                            <span class="f-16"><?= Loc::getMessage('STUDENTS_REVIEWS_TAB_TEXT') ?></span>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="link-block">
                    <a href="/reviews/">
                        <span><?= Loc::getMessage('LINK_ALL_REVIEWS_TEXT') ?></span>
                        <?= Functions::buildSVG('review-arrow', $templateFolder . '/images') ?>
                    </a>
                </div>
            </div>
            <div class="reviews-content">
                <?php if (!empty($arResult['COMPANY_REVIEWS'])) : ?>
                    <div id="companyReviewContent" class="active">
                        <?php foreach ($arResult['COMPANY_REVIEWS'] as $key => $review) : ?>
                            <?php if ($review['VIDEO'] || $review['PREVIEW_TEXT']) : ?>
                                <div class="review-item">
                                    <?php if ($review['VIDEO']) : ?>
                                        <div class="reviews-video">
                                            <video width="402" height="394">
                                                <source src="<?= $review['VIDEO'] ?>">
                                            </video>
                                            <div class="custom-controls">
                                                <div class="buttons-block">
                                                    <div class="start-video-btn">
                                                        <?= Functions::buildSVG('start-btn-icon', $templateFolder . '/images') ?>
                                                    </div>
                                                    <div class="stop-video-btn">
                                                        <?= Functions::buildSVG('stop-btn-icon', $templateFolder . '/images') ?>
                                                    </div>
                                                </div>
                                                <div class="current-video-time" data-review-id="<?= $key ?>">
                                                    <div class="current-video-time_back"></div>
                                                    <span class="f-20"><?= $review['REVIEW_USER_NAME'] ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php elseif ($review['PREVIEW_TEXT']) : ?>
                                        <div class="review-text-block">
                                            <div class="main-text">
                                                <span class="f-20" data-id="<?= $review['ID'] ?>"><?= $review['PREVIEW_TEXT'] ?></span>
                                                <div class="micro-elem">
                                                    <?= Functions::buildSVG('micro_elem', $templateFolder . '/images') ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="user-info-block">
                                            <?php if ($review['PREVIEW_PICTURE']) : ?>
                                                <div class="user-image">
                                                    <img src="<?= CFile::GetPath($review["PREVIEW_PICTURE"]); ?>" alt="">
                                                </div>
                                            <?php endif; ?>
                                            <div class="user-text-info">
                                                <span class="full-name f-20"><?= $review['REVIEW_USER_NAME'] ?></span>
                                                <span class="company-name f-20"><?= $review['NAME'] ?></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <?php if (!empty($arResult['STUDENTS_REVIEWS'])) : ?>
                    <div id="studentReviewContent" class="<?= (empty($arResult['COMPANY_REVIEWS'])) ? 'active' : '' ?>">
                        <?php foreach ($arResult['STUDENTS_REVIEWS'] as $key => $review) : ?>
                            <?php if ($review['VIDEO'] || $review['USER_REVIEW']) : ?>
                                <div class="review-item">
                                    <?php if ($review['VIDEO']) : ?>
                                        <div class="reviews-video">
                                            <video width="362" height="504">
                                                <source src="<?= $review['VIDEO'] ?>">
                                            </video>
                                            <div class="custom-controls">
                                                <div class="buttons-block">
                                                    <div class="start-video-btn">
                                                        <?= Functions::buildSVG('start-btn-icon', $templateFolder . '/images') ?>
                                                    </div>
                                                    <div class="stop-video-btn">
                                                        <?= Functions::buildSVG('stop-btn-icon', $templateFolder . '/images') ?>
                                                    </div>
                                                </div>
                                                <div class="current-video-time" data-review-id="<?= $key ?>">
                                                    <div class="current-video-time_back"></div>
                                                    <span class="f-20"><?= $review['REVIEW_USER_NAME'] ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php elseif ($review['USER_REVIEW']) : ?>
                                        <div class="review-text-block">
                                            <div class="main-text">
                                                <span class="f-20" data-id="<?= $review['ID'] ?>"><?= $review['USER_REVIEW'] ?></span>
                                                <div class="micro-elem">
                                                    <?= Functions::buildSVG('micro_elem', $templateFolder . '/images') ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="user-info-block">
                                            <?php if ($review['PREVIEW_PICTURE']) : ?>
                                                <div class="user-image">
                                                    <img src="<?= CFile::GetPath($review["PREVIEW_PICTURE"]); ?>" alt="">
                                                </div>
                                            <?php endif; ?>
                                            <div class="user-text-info">
                                                <span class="full-name f-20"><?= $review['USER_NAME'] . ' ' . $review['USER_SURNAME'] ?></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
