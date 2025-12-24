<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);
?>
<link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css">
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<div id="ibs-services-component">
<div class="ibs-services-block">
    <div class="ibs-services-container">
        <div class="ibs-services-grid ibs-services-grid--desktop">
            <?php foreach ($arResult['ITEMS'] as $item): ?>
                <?php
                $link           = $item['PROPERTIES']['LINK']['VALUE'] ?? '#';
                $previewText    = $item['PREVIEW_TEXT'] ?? '';
                $previewPicture = $item['PREVIEW_PICTURE']['SRC'] ?? '';
                $bgImage        = $previewPicture;
                ?>
                <a href="<?= $link ?>" class="ibs-services-card">
                    <?php if ($bgImage): ?>
                        <div class="ibs-services-card__bg-blur" style="background-image: url('<?= $bgImage ?>');"></div>
                    <?php endif; ?>
                    <div class="ibs-services-card__overlay"></div>

                    <div class="ibs-services-card__title">
                        <h3 class="ibs-services-card__title-text"><?= $item['NAME'] ?></h3>
                    </div>

                    <?php if ($previewPicture): ?>
                        <div class="ibs-services-card__image-wrapper">
                            <img src="<?= $previewPicture ?>" alt="<?= htmlspecialcharsbx($item['NAME']) ?>" class="ibs-services-card__image">
                        </div>
                    <?php endif; ?>

                    <?php if ($previewText): ?>
                        <div class="ibs-services-card__hover-content">
                            <div class="ibs-services-card__hover-inner">
                                <p class="ibs-services-card__description"><?= $previewText ?></p>
                                <div class="ibs-services-card__btn">Узнать больше</div>
                            </div>
                        </div>
                    <?php endif; ?>
                </a>
            <?php endforeach; ?>
        </div>
        <div class="ibs-services-slider-wrapper">
            <div class="ibs-services-slider swiper">
                <div class="swiper-wrapper">
                    <?php foreach ($arResult['ITEMS'] as $item): ?>
                        <?php
                        $link           = $item['PROPERTIES']['LINK']['VALUE'] ?? '#';
                        $previewText    = $item['PREVIEW_TEXT'] ?? '';
                        $previewPicture = $item['PREVIEW_PICTURE']['SRC'] ?? '';
                        $bgImage        = $previewPicture;
                        ?>
                        <div class="swiper-slide">
                            <a href="<?= $link ?>" class="ibs-services-card ibs-services-card--slider">
                                <?php if ($bgImage): ?>
                                    <div class="ibs-services-card__bg-blur" style="background-image: url('<?= $bgImage ?>');"></div>
                                <?php endif; ?>
                                <div class="ibs-services-card__overlay"></div>

                                <div class="ibs-services-card__title">
                                    <h3 class="ibs-services-card__title-text"><?= $item['NAME'] ?></h3>
                                </div>

                                <?php if ($previewPicture): ?>
                                    <div class="ibs-services-card__image-wrapper">
                                        <img src="<?= $previewPicture ?>" alt="<?= htmlspecialcharsbx($item['NAME']) ?>" class="ibs-services-card__image">
                                    </div>
                                <?php endif; ?>

                                <?php if ($previewText): ?>
                                    <div class="ibs-services-card__hover-content">
                                        <div class="ibs-services-card__hover-inner">
                                            <p class="ibs-services-card__description"><?= $previewText ?></p>
                                            <div class="ibs-services-card__btn">Узнать больше</div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="ibs-services-slider__navigation">
                <button class="ibs-services-slider__arrow ibs-services-slider__arrow--prev">
                    <svg width="45" height="9" viewBox="0 0 45 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M6.42857 3.85714V0L0 4.5L6.42857 9V5.14286H45V3.85714H6.42857Z" fill="black"/>
                    </svg>

                </button>

                <div class="ibs-services-slider__pagination"></div>

                <button class="ibs-services-slider__arrow ibs-services-slider__arrow--next">
                    <svg width="45" height="9" viewBox="0 0 45 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M38.5714 3.85714V0L45 4.5L38.5714 9V5.14286H0V3.85714H38.5714Z" fill="black"/>
                    </svg>

                </button>
            </div>
        </div>

    </div>
</div>
</div>
