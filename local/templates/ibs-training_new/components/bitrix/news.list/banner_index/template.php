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
$this->setFrameMode(true);
?>

<?php
$imagePath = $this->GetFolder() . '/img/img.png';
?>

<div class="banner">
    <div class="overlay"></div>
    <div class="banner-content">

            <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/main_page/top_left_text.php', [], ['MODE' => 'html', 'NAME' => 'Главная страница. Верхний текст.']); ?>


                <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/main_page/right_btn.php', [], ['MODE' => 'html', 'NAME' => 'Главная страница. Правая кнопка.']); ?>

    </div>
</div>

<style>
    /* Основной контейнер баннера */
    .banner {
        position: relative;
        width: 100%;
        height: 749px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: linear-gradient(0deg, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), var(--bg-image);
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        isolation: isolate;
        overflow: hidden;
    }

    /* Переменная для фонового изображения */
    .banner {
        --bg-image: url('<?= htmlspecialcharsbx($imagePath) ?>');
    }

    /* Наложение (темный оверлей) */
    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(0deg, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3));
        z-index: 0;
    }

    /* Контейнер содержимого баннера */
    .banner-content {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding: 0 77px;
        gap: 32px;
        width: 100%;
        max-width: 1840px;
        height: 324px;
        top: 70px; /* Для позиционирования относительно центра */
        z-index: 1;
    }

    /* Текст баннера */
    .banner-text {
        width: 100%;
        max-width: 1059px;
        height: auto;
        min-height: 208px;
        margin: 0;

        /* Типографика */
        font-family: 'Noto Sans', Arial, sans-serif;
        font-style: normal;
        font-weight: 500;
        font-size: 34px;
        line-height: 52px;
        color: #FFFFFF;

        /* Адаптивный перенос строк */
        white-space: pre-line;
    }

    /* Кнопка баннера */
    .banner-button {
        display: flex;
        flex-direction: row;
        align-items: center;
        padding: 16px 40px 16px 0;
        gap: 32px;

        /* Размеры */
        width: 835.33px;
        height: 84px;
        max-width: 100%;
        box-sizing: border-box;

        /* Градиент */
        background: linear-gradient(90deg, #2F6298 0%, #438DB0 100%);

        /* Позиционирование */
        position: relative;
        overflow: hidden;

        /* Анимация */
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        text-decoration: none;
    }

    /* Вертикальная линия в кнопке */
    .banner-button::before {
        content: '';
        position: absolute;
        left: 0;
        top: 16px;
        bottom: 16px;
        width: 1.33px;
        background: linear-gradient(180deg, #2F6298 0%, #438DB0 100%);
    }

    /* Текст внутри кнопки */
    .banner-button-text {
        width: 762px;
        height: 52px;

        /* Типографика */
        font-family: 'Noto Sans', Arial, sans-serif;
        font-style: normal;
        font-weight: 500;
        font-size: 32px;
        line-height: 52px;
        color: #FFFFFF;

        /* Выравнивание */
        display: flex;
        align-items: center;
        padding-left: 40px;
    }

    /* Эффекты при наведении на кнопку */
    .banner-button:hover {
        background: linear-gradient(90deg, #1a4a7a 0%, #2f6b8a 100%);
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
    }

    .banner-button:hover::before {
        background: linear-gradient(180deg, #1a4a7a 0%, #2f6b8a 100%);
    }

    .banner-button:active {
        transform: translateY(-1px);
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
    }

    /* ===== АДАПТИВНОСТЬ ===== */

    /* Для экранов до 1600px */
    @media (max-width: 1600px) {
        .banner-content {
            padding: 0 60px;
            max-width: 1500px;
        }

        .banner-text {
            font-size: 30px;
            line-height: 46px;
            max-width: 900px;
        }

        .banner-button {
            width: 700px;
            height: 72px;
        }

        .banner-button-text {
            font-size: 30px;
            line-height: 46px;
            width: 640px;
            height: 46px;
        }
    }

    /* Для экранов до 1200px */
    @media (max-width: 1200px) {
        .banner {
            height: 600px;
        }

        .banner-content {
            padding: 0 40px;
            max-width: 100%;
            height: auto;
            top: 0;
            gap: 24px;
        }

        .banner-text {
            font-size: 26px;
            line-height: 40px;
            max-width: 100%;
            min-height: 160px;
        }

        .banner-button {
            width: 100%;
            height: 68px;
            padding: 14px 30px 14px 0;
            gap: 24px;
        }

        .banner-button-text {
            font-size: 26px;
            line-height: 40px;
            width: 100%;
            height: 40px;
            padding-left: 30px;
        }

        .banner-button::before {
            top: 14px;
            bottom: 14px;
        }
    }

    /* Для планшетов (768px - 992px) */
    @media (max-width: 992px) {
        .banner {
            height: 500px;
        }

        .banner-content {
            padding: 0 30px;
            gap: 20px;
        }

        .banner-text {
            font-size: 22px;
            line-height: 36px;
            min-height: 140px;
        }

        .banner-button {
            height: 60px;
            padding: 12px 25px 12px 0;
            gap: 20px;
        }

        .banner-button-text {
            font-size: 22px;
            line-height: 36px;
            height: 36px;
            padding-left: 25px;
        }

        .banner-button::before {
            top: 12px;
            bottom: 12px;
        }
    }

    /* Для мобильных (до 768px) */
    @media (max-width: 768px) {
        .banner {
            height: 400px;
        }

        .banner-content {
            padding: 0 20px;
            gap: 16px;
        }

        .banner-text {
            font-size: 18px;
            line-height: 28px;
            min-height: auto;
        }

        .banner-button {
            height: 52px;
            padding: 10px 20px 10px 0;
            gap: 16px;
        }

        .banner-button-text {
            font-size: 18px;
            line-height: 28px;
            height: 28px;
            padding-left: 20px;
        }

        .banner-button::before {
            top: 10px;
            bottom: 10px;
        }
    }

    /* Для маленьких мобильных (до 480px) */
    @media (max-width: 480px) {
        .banner {
            height: 350px;
        }

        .banner-content {
            padding: 0 16px;
            gap: 12px;
        }

        .banner-text {
            font-size: 16px;
            line-height: 24px;
        }

        .banner-button {
            flex-direction: column;
            align-items: flex-start;
            height: auto;
            min-height: 52px;
            padding: 12px 16px;
            gap: 12px;
        }

        .banner-button-text {
            font-size: 16px;
            line-height: 24px;
            height: auto;
            padding-left: 0;
            width: 100%;
        }

        .banner-button::before {
            width: 100%;
            height: 1.33px;
            top: 0;
            left: 0;
            right: 0;
            bottom: auto;
            background: linear-gradient(90deg, #2F6298 0%, #438DB0 100%);
        }
    }

    /* Для очень маленьких экранов (до 360px) */
    @media (max-width: 360px) {
        .banner {
            height: 300px;
        }

        .banner-content {
            padding: 0 12px;
        }

        .banner-text {
            font-size: 14px;
            line-height: 22px;
        }

        .banner-button-text {
            font-size: 14px;
            line-height: 22px;
        }
    }
</style>