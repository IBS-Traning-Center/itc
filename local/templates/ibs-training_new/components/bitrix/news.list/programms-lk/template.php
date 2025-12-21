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
<style>
    /* Базовые стили для всех устройств */
    .lk-card.course .lk-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 16px;
        width: 114px;
        height: 40px;
        background: #FFFFFF;
        font-family: 'Noto Sans', sans-serif;
        font-style: normal;
        font-weight: 400;
        font-size: 16px;
        line-height: 24px;
        color: #000000;
        white-space: nowrap;
        margin: 0 24px 0 0;
    }

    .lk-card.course .lk-card__meta > span:last-child:not(.lk-badge) {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 16px;
        width: 64px;
        height: 40px;
        background: #FFFFFF;
        font-family: 'Noto Sans', sans-serif;
        font-style: normal;
        font-weight: 400;
        font-size: 16px;
        line-height: 24px;
        color: #000000;
        white-space: nowrap;
    }

    .lk-card.course .lk-card__title {
        width: 100%;
        height: auto;
        min-height: 33px;
        font-family: 'Noto Sans', sans-serif;
        font-style: normal;
        font-weight: 400;
        font-size: 24px;
        line-height: 1.3;
        color: #2B418B;
        margin: 0;
    }

    .lk-card.course .lk-card__subtitle {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 8px;
        width: 100%;
        height: 30px;
        font-family: 'Noto Sans', sans-serif;
        font-style: normal;
        font-weight: 400;
        font-size: 14px;
        line-height: 19px;
        color: #000000;
        margin: 0;
    }

    .lk-card.course .lk-card__subtitle::before {
        content: "";
        width: 30px;
        height: 30px;
        background: linear-gradient(90deg, #2F6298 0%, #438DB0 100%);
        border-radius: 50%;
        display: inline-block;
        flex-shrink: 0;
        position: relative;
    }

    .lk-card.course .lk-card__subtitle::after {
        content: "А";
        position: absolute;
        width: 30px;
        height: 30px;
        font-family: 'Noto Sans', sans-serif;
        font-style: normal;
        font-weight: 400;
        font-size: 14px;
        line-height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: #FFFFFF;
    }

    .lk-card.course .lk-card__btn {
        box-sizing: border-box;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        padding: 16px;
        gap: 10px;
        width: 100%;
        height: 54px;
        background: #FFFFFF;
        border: 1px solid #2B418B;
        text-decoration: none;
        font-family: 'Noto Sans', sans-serif;
        font-style: normal;
        font-weight: 400;
        font-size: 16px;
        line-height: 24px;
        color: #2B418B;
        transition: all 0.2s;
    }

    .lk-card.course .lk-card__btn:hover {
        background: #2B418B;
        color: #FFFFFF;
    }

    /* ИКОНКА/ИЗОБРАЖЕНИЕ СЕРТИФИКАТА */
    .lk-card__icon {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 0px;
        gap: 8px;
        width: 139px;
        height: 167px;
        flex: none;
    }

    /* ТЕЛО КАРТОЧКИ */
    .lk-card__body {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding: 0px;
        gap: 16px;
        width: 450px;
        height: auto;
        min-height: 228px;
        flex: none;
        align-self: stretch;
        flex-grow: 1;
    }

    /* МЕТА-ИНФОРМАЦИЯ (верхняя строка) */
    .lk-card__meta {
        display: flex;
        flex-direction: row;
        align-items: center;
        padding: 0px;
        gap: 2px;
        width: 100%;
        height: auto;
        min-height: 31px;
        flex: none;
        align-self: stretch;
        justify-content: space-between;
        flex-wrap: wrap;
    }

    /* КОНТЕЙНЕР ДЛЯ ДАТЫ И ДЛИТЕЛЬНОСТИ */
    .lk-card__meta-info {
        display: flex;
        flex-direction: row;
        align-items: center;
        padding: 0px;
        gap: 16px;
        width: auto;
        max-width: 361px;
        height: auto;
        min-height: 24px;
        flex: none;
        flex-grow: 1;
        flex-wrap: wrap;
    }

    /* БЛОК С ДАТОЙ */
    .lk-card__date {
        display: flex;
        flex-direction: row;
        align-items: center;
        padding: 0px;
        gap: 4px;
        width: auto;
        max-width: 157px;
        height: 24px;
        flex: none;
        position: relative;
    }

    .lk-card__date-text {
        width: auto;
        max-width: 161px;
        height: 19px;
        font-family: 'Noto Sans', sans-serif;
        font-style: normal;
        font-weight: 400;
        font-size: 14px;
        line-height: 19px;
        color: #000000;
        display: flex;
        align-items: center;
        white-space: nowrap;
    }

    /* БЛОК С ДЛИТЕЛЬНОСТЬЮ */
    .lk-card__duration {
        display: flex;
        flex-direction: row;
        align-items: center;
        padding: 2px 0px;
        gap: 4px;
        width: auto;
        max-width: 163px;
        height: 24px;
        flex: none;
        position: relative;
    }

    .lk-card__duration-text {
        width: auto;
        max-width: 180px;
        height: 19px;
        font-family: 'Noto Sans', sans-serif;
        font-style: normal;
        font-weight: 400;
        font-size: 14px;
        line-height: 19px;
        color: #000000;
        display: flex;
        align-items: center;
        white-space: nowrap;
    }

    /* БЕЙДЖ (Team Lead) */
    .lk-badge {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        padding: 6px 12px;
        width: auto;
        min-width: 87px;
        height: 31px;
        background: #FFFFFF;
        flex: none;
    }

    .lk-badge span {
        width: auto;
        height: 19px;
        font-family: 'Noto Sans', sans-serif;
        font-style: normal;
        font-weight: 400;
        font-size: 14px;
        line-height: 19px;
        color: #000000;
        display: flex;
        align-items: center;
    }

    /* ЗАГОЛОВОК И ПОДЗАГОЛОВОК */
    .lk-card__info {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding: 0px;
        gap: 4px;
        width: 100%;
        max-width: 450px;
        height: auto;
        min-height: 76px;
        flex: none;
        align-self: stretch;
    }

    /* АББРЕВИАТУРА (BA) */
    .lk-card__abbr {
        width: auto;
        max-width: 90px;
        height: 19px;
        font-family: 'Noto Sans', sans-serif;
        font-style: normal;
        font-weight: 400;
        font-size: 14px;
        line-height: 19px;
        color: #000000;
        display: flex;
        align-items: center;
    }

    /* ОСНОВНОЙ ЗАГОЛОВОК */
    .lk-card__title {
        width: 100%;
        height: auto;
        min-height: 30px;
        font-family: 'Noto Sans', sans-serif;
        font-style: normal;
        font-weight: 400;
        font-size: 22px;
        line-height: 1.3;
        color: #2B418B;
        margin: 0;
        align-self: stretch;
    }

    /* ПОДЗАГОЛОВОК */
    .lk-card__subtitle {
        width: auto;
        max-width: 176px;
        height: 19px;
        font-family: 'Noto Sans', sans-serif;
        font-style: normal;
        font-weight: 400;
        font-size: 14px;
        line-height: 19px;
        color: #000000;
        display: flex;
        align-items: center;
    }

    /* НИЖНИЙ БЛОК (кнопка и срок действия) */
    .lk-card__actions {
        display: flex;
        flex-direction: row;
        align-items: center;
        padding: 0px;
        gap: 16px;
        width: 100%;
        max-width: 450px;
        height: auto;
        min-height: 54px;
        flex: none;
        align-self: stretch;
    }

    /* КНОПКА СКАЧАТЬ */
    .lk-card__btn {
        box-sizing: border-box;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        padding: 16px 24px;
        gap: 10px;
        width: 100%;
        max-width: 236px;
        height: 54px;
        background: #FFFFFF;
        border: 1px solid #2B418B;
        border-radius: 0px;
        text-decoration: none;
        flex: none;
    }

    .lk-card__btn span {
        width: auto;
        max-width: 156px;
        height: 24px;
        font-family: 'Noto Sans', sans-serif;
        font-style: normal;
        font-weight: 400;
        font-size: 16px;
        line-height: 24px;
        color: #2B418B;
        display: flex;
        align-items: center;
        justify-content: center;
        white-space: nowrap;
    }

    /* СРОК ДЕЙСТВИЯ СЕРТИФИКАТА */
    .lk-card__expiry {
        width: 100%;
        max-width: 198px;
        height: 48px;
        font-family: 'Inter', sans-serif;
        font-style: normal;
        font-weight: 400;
        font-size: 16px;
        line-height: 24px;
        color: #000000;
        display: flex;
        align-items: center;
        flex: none;
        flex-grow: 1;
    }

    /* SECTION */
    .lk-section {
        margin-bottom: 48px;
        width: 100%;
        padding: 0 16px;
        box-sizing: border-box;
    }

    .lk-section__title {
        font-family: Noto Sans;
        font-weight: 500;
        font-size: 34px;
        line-height: 1.2;
        margin-bottom: 16px;
        word-wrap: break-word;
    }

    /* CARD */
    .lk-card {
        display: flex;
        flex-direction: row;
        gap: 16px;
        background: #f5f5f5;
        padding: 16px;
        width: 100%;
        box-sizing: border-box;
    }

    /* Медиа-запрос для 480px и меньше */
    @media screen and (max-width: 480px) {
        .lk-section {
            padding: 0 12px;
            margin-bottom: 32px;
        }

        .lk-section__title {
            font-size: 24px;
            line-height: 1.3;
            margin-bottom: 12px;
        }

        .lk-card {
            flex-direction: column;
            padding: 12px;
            gap: 12px;
        }

        .lk-card__icon {
            width: 100%;
            height: auto;
            min-height: 140px;
            justify-content: center;
        }

        .lk-card__icon.big {
            width: 100%;
            max-width: 139px;
            margin: 0 auto;
        }

        .certificate-number {
            font-size: 14px;
            word-break: break-all;
            text-align: center;
        }

        .lk-card__body {
            width: 100%;
            height: auto;
            gap: 12px;
        }

        .lk-card__meta {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
            height: auto;
        }

        .lk-card__meta-info {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
            width: 100%;
        }

        .lk-card__date,
        .lk-card__duration {
            width: 100%;
            max-width: 100%;
        }

        .lk-card__date-text,
        .lk-card__duration-text {
            width: 100%;
            max-width: 100%;
            font-size: 13px;
        }

        .lk-badge {
            margin-top: 4px;
            align-self: flex-start;
        }

        .lk-card__info {
            width: 100%;
            height: auto;
            gap: 8px;
        }

        .lk-card__abbr {
            font-size: 13px;
        }

        .lk-card__title {
            font-size: 18px;
            line-height: 1.3;
        }

        .lk-card__subtitle {
            font-size: 13px;
            width: 100%;
            max-width: 100%;
        }

        .lk-card__actions {
            flex-direction: column;
            width: 100%;
            gap: 12px;
        }

        .lk-card__btn {
            width: 100%;
            max-width: 100%;
            padding: 14px;
            height: 48px;
            font-size: 15px;
        }

        /* Стили для .lk-card.course на мобильных */
        .lk-card.course .lk-card__title {
            font-size: 18px;
            line-height: 1.3;
        }

        .lk-card.course .lk-card__btn {
            width: 100%;
            padding: 14px;
            height: 48px;
            font-size: 15px;
        }

        .lk-card.course .lk-card__subtitle {
            height: auto;
            min-height: 30px;
            flex-wrap: wrap;
        }

        .lk-card.course .lk-badge {
            width: auto;
            padding: 6px 12px;
            height: 35px;
            margin: 4px 0;
        }
    }

    /* Дополнительный медиа-запрос для очень маленьких экранов */
    @media screen and (max-width: 360px) {
        .lk-section {
            padding: 0 8px;
        }

        .lk-section__title {
            font-size: 20px;
        }

        .lk-card__title {
            font-size: 16px;
        }

        .lk-card.course .lk-card__title {
            font-size: 16px;
        }

        .lk-card__date-text,
        .lk-card__duration-text,
        .lk-card__abbr,
        .lk-card__subtitle {
            font-size: 12px;
        }

        .lk-card__btn,
        .lk-card.course .lk-card__btn {
            font-size: 14px;
            padding: 12px;
            height: 44px;
        }
    }
</style>