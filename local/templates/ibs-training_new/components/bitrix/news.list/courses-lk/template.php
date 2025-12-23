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
                    <span class="lk-badge">Team Lead</span>
                    <span class="lk-card__duration">24 ч</span>
                </div>

                <div class="lk-card__meta-secondary">
                    <div class="lk-card__date-secondary">
                        <?= Functions::buildSVG(
                            'date',
                            'local/templates/ibs-training_new/components/bitrix/news.list/courses-lk/ico'
                        ) ?>
                        <span class="lk-card__date-text-secondary"> 14 июля 2025 (через 5 дней)</span>
                    </div>
                    <div class="lk-card__time-secondary">

                        <span class="lk-card__time-text-secondary">  <?= Functions::buildSVG(
                                'time',
                                'local/templates/ibs-training_new/components/bitrix/news.list/courses-lk/ico'
                            ) ?>14:00–18:00</span>
                    </div>
                </div>

                <div class="lk-card__title">
                    Шаблоны проектирования GoF. Редакция для .NET
                </div>
                <div class="lk-card__text">
                    При разработке программных систем разработчики принимают множество решений...
                </div>
                <div class="lk-card__subtitle">
                    Тренер — <a href="/">Иванов Евгений</a>
                </div>

                <div class="lk-card__price">39 900 ₽</div>

                <a href="#" class="lk-card__btn">Скачать документ</a>
            </div>
        </div>

        <div class="lk-card course">
            <div class="lk-card__body">
                <div class="lk-card__meta">
                    <span class="lk-card__code">DEV-001_NET</span>
                    <span class="lk-badge">Team Lead</span>
                    <span class="lk-card__duration">24 ч</span>
                </div>

                <div class="lk-card__meta-secondary">
                    <div class="lk-card__date-secondary">
                        <?= Functions::buildSVG(
                            'date',
                            'local/templates/ibs-training_new/components/bitrix/news.list/courses-lk/ico'
                        ) ?>
                        <span class="lk-card__date-text-secondary"> 14 июля 2025 (через 5 дней)</span>
                    </div>
                    <div class="lk-card__time-secondary">

                        <span class="lk-card__time-text-secondary">  <?= Functions::buildSVG(
                                'time',
                                'local/templates/ibs-training_new/components/bitrix/news.list/courses-lk/ico'
                            ) ?>14:00–18:00</span>
                    </div>
                </div>

                <div class="lk-card__title">
                    Шаблоны проектирования GoF. Редакция для .NET
                </div>
                <div class="lk-card__text">
                    При разработке программных систем разработчики принимают множество решений...
                </div>
                <div class="lk-card__subtitle">
                    Тренер — <a href="/">Иванов Евгений</a>
                </div>

                <div class="lk-card__price">39 900 ₽</div>

                <a href="#" class="lk-card__btn">Скачать документ</a>
            </div>
        </div>
    </div>
</section>
