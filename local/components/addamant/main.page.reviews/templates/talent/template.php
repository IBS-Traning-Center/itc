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

if (!empty($arResult['STUDENTS_REVIEWS'])) : ?>
    <div class="reviews-talent-block">
        <div class="container">
            <div class="main-page-heading"><?= Loc::getMessage('BLOCK_TITLE') ?></div>
            <div class="reviews-content">
                <?php if (!empty($arResult['STUDENTS_REVIEWS'])) : ?>
                    <div id="studentReviewContent">
                        <?php foreach ($arResult['STUDENTS_REVIEWS'] as $key => $review) : 
                            if($review['SHOW_ON_TALENT'] !== 'Y')
                                continue;?>
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
