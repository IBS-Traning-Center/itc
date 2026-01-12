<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
use Local\Util\Functions;
$this->setFrameMode(true);
?>
<section class="lk-section">
    <h2 class="lk-section__title">Курсы</h2>

    <div class="lk-cards">
        <div class="lk-card course">
            <div class="lk-card__body">
                <div class="lk-card__meta">
                    <span class="lk-card__code">DEV-001_NET</span>
                    <span class="lk-badge">24 часа</span>
                </div>

                <div class="lk-card__meta-secondary">
                    <div class="lk-card__date-secondary">
                        <?= Functions::buildSVG(
                            'date',
                            'local/templates/ibs-training_new/components/bitrix/news.list/courses-lk/ico'
                        ) ?>
                        <span class="lk-card__date-text-secondary"> 14 декабря 2025 — 14 января 2026</span>
                    </div>

                </div>

                <div class="lk-card__title">
                    Системный аналитик
                </div>
                <a href="#" class="lk-card__btn">Скачать документ</a>
            </div>
        </div>

        <div class="lk-card course">
            <div class="lk-card__body">
                <div class="lk-card__meta">
                    <span class="lk-card__code">DEV-001_NET</span>
                    <span class="lk-badge">24 часа</span>
                </div>

                <div class="lk-card__meta-secondary">
                    <div class="lk-card__date-secondary">
                        <?= Functions::buildSVG(
                            'date',
                            'local/templates/ibs-training_new/components/bitrix/news.list/courses-lk/ico'
                        ) ?>
                        <span class="lk-card__date-text-secondary"> 14 декабря 2025 — 14 января 2026</span>
                    </div>

                </div>

                <div class="lk-card__title">
                    Бизнес-аналитик
                </div>
                <a href="#" class="lk-card__btn">Скачать диплом</a>
            </div>
        </div>
    </div>
</section>
