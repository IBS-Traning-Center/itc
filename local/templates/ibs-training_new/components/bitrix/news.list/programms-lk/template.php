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
?><section class="lk-section">
    <h2 class="lk-section__title">Программы</h2>

    <div class="lk-cards-prog">

        <div class="lk-card program">
            <div class="lk-card__icon big">

                <div class="certificate-number">AA00-00000</div>
            </div>

            <div class="lk-card__body">
                <!-- МЕТА-ИНФОРМАЦИЯ -->
                <div class="lk-card__meta">
                    <div class="lk-card__meta-info">
                        <div class="lk-card__date">
                            <span class="lk-card__date-text">  <?= Functions::buildSVG(
                                    'date',
                                    'local/templates/ibs-training_new/components/bitrix/news.list/programms-lk/ico'
                                ) ?>Выдано 10.02.2025</span>
                        </div>
                        <div class="lk-card__duration">
                            <span class="lk-card__duration-text"><?= Functions::buildSVG(
                                    'time',
                                    'local/templates/ibs-training_new/components/bitrix/news.list/programms-lk/ico'
                                ) ?>Длительность: 284 ч</span>
                        </div>
                    </div>
                    <span class="lk-badge">Team Lead</span>
                </div>

                <!-- ИНФОРМАЦИЯ О КУРСЕ -->
                <div class="lk-card__info">
                    <div class="lk-card__abbr">JVA-PRG-002</div>
                    <div class="lk-card__title">Java-разработчик. Middle Developer</div>
                    <div class="lk-card__subtitle">Уровень «Профессионал»</div>
                </div>

                <!-- КНОПКА И СРОК ДЕЙСТВИЯ -->
                <div class="lk-card__actions">
                    <a href="#" class="lk-card__btn">Скачать диплом</a>
                </div>
            </div>
        </div>
    </div>
</section>
