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
            <div class="reviews-tabs-title main-page-heading"><?= Loc::getMessage('BLOCK_TITLE') ?></div>
            <div class="reviews-tabs-block">
                <div class="tabs">
                    <?php if (!empty($arResult['COMPANY_REVIEWS'])) : ?>
                        <div id="companyReviewsTab" class="tab-item active">
                            <span class="f-16"><?= Loc::getMessage('COMPANY_REVIEWS_TAB_TEXT') ?></span>
                        </div>
                        <div class="link-block">
                            <a href="/reviews/">
                                <span><?= Loc::getMessage('LINK_ALL_REVIEWS_TEXT') ?></span>
                                <?= Functions::buildSVG('review-arrow', $templateFolder . '/images') ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($arResult['STUDENTS_REVIEWS'])) : ?>
                        <div id="studentsReviewsTab" class="tab-item<?= (empty($arResult['COMPANY_REVIEWS'])) ? ' active' : '' ?>">
                            <span class="f-16"><?= Loc::getMessage('STUDENTS_REVIEWS_TAB_TEXT') ?></span>
                        </div>
                        <div class="link-block">
                            <a href="/reviews/">
                                <span><?= Loc::getMessage('LINK_ALL_REVIEWS_TEXT') ?></span>
                                <?= Functions::buildSVG('review-arrow', $templateFolder . '/images') ?>
                            </a>
                        </div>
                    <?php endif; ?>
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
                                            <video width="402" height="394" muted="" loop="" disablepictureinpicture="" webkit-playsinline="" playsinline="" pip="false">
                                                <source src="<?= $review['VIDEO'] ?>#t=0.001">
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
                                                    <span><?= $review['REVIEW_USER_NAME'] ?><?= $review['USER_NAME'] . ' ' . $review['USER_SURNAME'] ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php elseif ($review['PREVIEW_TEXT']) : ?>
                                        <div class="review-text-block">
                                            <?php if($review['COURSE_NAME']):?>
                                                <div class="review-course-info">
                                                    <?= Loc::getMessage('COURSE')?> <a href="<?= $review['COURSE_LINK']?>"><?= $review['COURSE_NAME']?></a>
                                                </div>
                                            <?php endif; ?>
                                            <div class="main-text">
                                                <span class="company-text" data-id="<?= $review['ID'] ?>"><?= $review['PREVIEW_TEXT'] ?></span>
                                            </div>
                                            <div class="micro-elem">
                                                <?= Functions::buildSVG('arrow-element', $templateFolder . '/images') ?>
                                            </div>
                                            <?php if($review['PDF_FILE']):?>
                                                <div class="review-pdf-link">
                                                    <a href="<?= $review['PDF_FILE']?>" target="_blank"><?= Loc::getMessage('PDF_TEXT_LINK')?></a>
                                                </div>
                                            <?php endif;?>
                                        </div>
                                        <div class="user-info-block">
                                            <?php if ($review['PREVIEW_PICTURE']) : ?>
                                                <div class="user-image">
                                                    <img src="<?= CFile::GetPath($review["PREVIEW_PICTURE"]); ?>" alt="">
                                                </div>
                                            <?php endif; ?>
                                            <div class="user-text-info">
                                                <span class="company-name"><?= $review['NAME'] ?></span>
                                                <span class="full-name"><?= $review['REVIEW_USER_NAME'] ?></span>
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
                                            <video width="402" height="394" muted="" loop="" disablepictureinpicture="" webkit-playsinline="" playsinline="" pip="false">
                                                <source src="<?= $review['VIDEO'] ?>#t=0.001">
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
                                                    <span><?= $review['REVIEW_USER_NAME'] ?><?= $review['USER_NAME'] . ' ' . $review['USER_SURNAME'] ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php elseif ($review['USER_REVIEW']) : ?>
                                        <div class="review-text-block">
                                            <?php if($review['COURSE_NAME']):?>
                                                <div class="review-course-info">
                                                    <?= Loc::getMessage('COURSE')?> <a href="<?= $review['COURSE_LINK']?>"><?= $review['COURSE_NAME']?></a>
                                                </div>
                                            <?php endif; ?>
                                            <div class="main-text">
                                                <span class="student-text" data-id="<?= $review['ID'] ?>"><?= $review['USER_REVIEW'] ?></span>
                                            </div>
                                            <div class="micro-elem">
                                                <?= Functions::buildSVG('arrow-element', $templateFolder . '/images') ?>
                                            </div>
                                        </div>
                                        <div class="user-info-block">
                                            <?php if ($review['PREVIEW_PICTURE']) : ?>
                                                <div class="user-image">
                                                    <img src="<?= CFile::GetPath($review["PREVIEW_PICTURE"]); ?>" alt="">
                                                </div>
                                            <?php endif; ?>
                                            <div class="user-text-info">
                                                <span class="full-name"><?= $review['USER_NAME'] . ' ' . $review['USER_SURNAME'] ?></span>
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
