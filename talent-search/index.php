<?php

use Bitrix\Main\Page\Asset;

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');

global $APPLICATION;
Asset::getInstance()->addCss(SITE_DIR . 'local/assets/css/talent/talent.css');

$APPLICATION->SetPageProperty('DONT_SHOW_PAGE_TOP', 'Y');
$APPLICATION->SetPageProperty('blue_title', 'Сотрудничество с IBS Training Center');
$APPLICATION->SetPageProperty('title', 'Стань тренером в IBS Training Center');
$APPLICATION->SetPageProperty('description', 'Присоединяйтесь к команде наших преподавателей и укрепите свою репутацию настоящего эксперта! Больше возможностей и преимуществ - стать IT-тренером');
$APPLICATION->SetTitle('Стань тренером');
?>

<div class="top-page-banner talent-page">
    <div class="container">
        <div class="banner-content">
            <?php $APPLICATION->IncludeComponent(
                'bitrix:breadcrumb',
                'bread',
                [
                    'START_FROM' => '0',
                    'PATH' => '',
                    'SITE_ID' => 's1',
                ],
                false
            ); ?>
            <h1><?= $APPLICATION->GetTitle() ?></h1>
            <p class="f-32"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/heading_text.php', [], ['MODE' => 'html', 'NAME' => 'Текст под заголовком']); ?></p>
            <div class="trainer-modal">
                <span class="f-24">Стать тренером</span>
            </div>
        </div>
        <div class="banner-image">
            <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/heading_img.php', [], ['MODE' => 'html', 'NAME' => 'Картинка под заголовком']); ?>
        </div>
    </div>
</div>
<div class="talent-section">
    <div class="container">
        <div class="images-icons-block">
            <div class="item">
                <div class="icon-block">
                    <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/icon_1.php', [], ['MODE' => 'html', 'NAME' => 'Иконка 1']); ?>
                </div>
                <p class="f-32"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/icon_title_1.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок иконки 1']); ?></p>
                <p class="f-20"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/icon_text_1.php', [], ['MODE' => 'html', 'NAME' => 'Текст иконки 1']); ?></p>
            </div>
            <div class="item">
                <div class="icon-block">
                    <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/icon_2.php', [], ['MODE' => 'html', 'NAME' => 'Иконка 2']); ?>
                </div>
                <p class="f-32"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/icon_title_2.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок иконки 2']); ?></p>
                <p class="f-20"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/icon_text_2.php', [], ['MODE' => 'html', 'NAME' => 'Текст иконки 2']); ?></p>
            </div>
            <div class="item">
                <div class="icon-block">
                    <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/icon_3.php', [], ['MODE' => 'html', 'NAME' => 'Иконка 3']); ?>
                </div>
                <p class="f-32"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/icon_title_3.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок иконки 3']); ?></p>
                <p class="f-20"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/icon_text_3.php', [], ['MODE' => 'html', 'NAME' => 'Текст иконки 3']); ?></p>
            </div>
        </div>
        <div class="talent-grid-block talent-content">
            <h2 class="margin-bottom56"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/center_heading.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок Цифра экспертов']); ?></h2>
            <div class="grid-talent-4">
                <div>
                    <h2><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/center_h2_text_1.php', [], ['MODE' => 'html', 'NAME' => 'Текст Цифра экспертов']); ?></h2>
                    <p class="f-32"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/center_p_text_1.php', [], ['MODE' => 'html', 'NAME' => 'Текст Цифра экспертов']); ?></p>
                </div>
                <div>
                    <h2><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/center_h2_text_2.php', [], ['MODE' => 'html', 'NAME' => 'Текст Цифра экспертов']); ?></h2>
                    <p class="f-32"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/center_p_text_2.php', [], ['MODE' => 'html', 'NAME' => 'Текст Цифра экспертов']); ?></p>
                </div>
                <div>
                    <h2><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/center_h2_text_3.php', [], ['MODE' => 'html', 'NAME' => 'Текст Цифра экспертов']); ?></h2>
                    <p class="f-32"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/center_p_text_3.php', [], ['MODE' => 'html', 'NAME' => 'Текст Цифра экспертов']); ?></p>
                </div>
                <div>
                    <h2><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/center_h2_text_4.php', [], ['MODE' => 'html', 'NAME' => 'Текст Цифра экспертов']); ?></h2>
                    <p class="f-32"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/center_p_text_4.php', [], ['MODE' => 'html', 'NAME' => 'Текст Цифра экспертов']); ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="talent-team talent-content">
        <div class="container">
            <div class="talent-team-left">
                <h2><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/team_h2.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок Наша команда']); ?></h2>
                <p class="f-32"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/team_tags.php', [], ['MODE' => 'html', 'NAME' => 'Теги команды']); ?></p>
                <? $APPLICATION->IncludeComponent(
                	"addamant:slider.section.trener",
                	"slider",
                	array(
                		"CACHE_TIME" => "3600",
                		"CACHE_TYPE" => "A",
                		"CATALOG_LINK_TITLE_TRENER_PAGE" => "/catalog/",
                		"IBLOCKS_IDS_TITLE_TRENER_PAGE" => "94"
                	)
                ); ?>
            </div>
            <div class="talent-team-right">
                <h3><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/team_h3.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок Стань тренером']); ?></h3>
                <div class="item">
                    <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/team_icon.php', [], ['MODE' => 'html', 'NAME' => 'Иконка Стань тренером']); ?>
                    <p class="f-32"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/team_text_1.php', [], ['MODE' => 'html', 'NAME' => 'Текст Стань тренером']); ?></p>
                </div>
                <div class="item">
                    <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/team_icon.php', [], ['MODE' => 'html', 'NAME' => 'Иконка Стань тренером']); ?>
                    <p class="f-32"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/team_text_2.php', [], ['MODE' => 'html', 'NAME' => 'Текст Стань тренером']); ?></p>
                </div>
                <div class="item">
                    <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/team_icon.php', [], ['MODE' => 'html', 'NAME' => 'Иконка Стань тренером']); ?>
                    <p class="f-32"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/team_text_3.php', [], ['MODE' => 'html', 'NAME' => 'Текст Стань тренером']); ?></p>
                </div>
                <div class="item">
                    <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/team_icon.php', [], ['MODE' => 'html', 'NAME' => 'Иконка Стань тренером']); ?>
                    <p class="f-32"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/team_text_4.php', [], ['MODE' => 'html', 'NAME' => 'Текст Стань тренером']); ?></p>
                </div>
                <div class="trainer-modal">
                    <span class="f-24">Стать тренером</span>
                </div>
            </div>
        </div>
    </div>
    <div class="talent-come">
        <div class="container">
            <div class="talent-content">
                <h2><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/come_heading.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок Тебе предстоит']); ?></h2>
                <div class="grid-talent">
                    <div class="item">
                        <div class="talent-come-icon">
                            <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/come_icon_1.php', [], ['MODE' => 'html', 'NAME' => 'Иконка Тебе предстоит']); ?>
                        </div>
                        <p class="f-32"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/come_text_1.php', [], ['MODE' => 'html', 'NAME' => 'Текст Тебе предстоит']); ?></p>
                    </div>
                    <div class="item">
                        <div class="talent-come-icon">
                            <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/come_icon_2.php', [], ['MODE' => 'html', 'NAME' => 'Иконка Тебе предстоит']); ?>
                        </div>
                        <p class="f-32"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/come_text_2.php', [], ['MODE' => 'html', 'NAME' => 'Текст Тебе предстоит']); ?></p>
                    </div>
                    <div class="item">
                        <div class="talent-come-icon">
                            <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/come_icon_3.php', [], ['MODE' => 'html', 'NAME' => 'Иконка Тебе предстоит']); ?>
                        </div>
                        <p class="f-32"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/come_text_3.php', [], ['MODE' => 'html', 'NAME' => 'Текст Тебе предстоит']); ?></p>
                    </div>
                    <div class="item">
                        <div class="talent-come-icon">
                            <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/come_icon_4.php', [], ['MODE' => 'html', 'NAME' => 'Иконка Тебе предстоит']); ?>
                        </div>
                        <p class="f-32"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/come_text_4.php', [], ['MODE' => 'html', 'NAME' => 'Текст Тебе предстоит']); ?></p>
                    </div>
                    <div class="item">
                        <div class="talent-come-icon">
                            <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/come_icon_5.php', [], ['MODE' => 'html', 'NAME' => 'Иконка Тебе предстоит']); ?>
                        </div>
                        <p class="f-32"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/come_text_5.php', [], ['MODE' => 'html', 'NAME' => 'Текст Тебе предстоит']); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="talent-get">
        <div class="container">
            <div class="talent-content talent-grid-block">
                <h2><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/get_heading.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок Ты получаешь']); ?></h2>
                <div class="get-grid-block">
                    <div class="item">
                        <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/get_icon.php', [], ['MODE' => 'html', 'NAME' => 'Иконка Ты получаешь']); ?>
                        <p class="f-20"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/get_text_1.php', [], ['MODE' => 'html', 'NAME' => 'Текст Ты получаешь']); ?></p>
                    </div>
                    <div class="item">
                        <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/get_icon.php', [], ['MODE' => 'html', 'NAME' => 'Иконка Ты получаешь']); ?>
                        <p class="f-20"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/get_text_2.php', [], ['MODE' => 'html', 'NAME' => 'Текст Ты получаешь']); ?></p>
                    </div>
                    <div class="item">
                        <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/get_icon.php', [], ['MODE' => 'html', 'NAME' => 'Иконка Ты получаешь']); ?>
                        <p class="f-20"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/get_text_3.php', [], ['MODE' => 'html', 'NAME' => 'Текст Ты получаешь']); ?></p>
                    </div>
                    <div class="item">
                        <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/get_icon.php', [], ['MODE' => 'html', 'NAME' => 'Иконка Ты получаешь']); ?>
                        <p class="f-20"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/get_text_4.php', [], ['MODE' => 'html', 'NAME' => 'Текст Ты получаешь']); ?></p>
                    </div>
                    <div class="item">
                        <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/get_icon.php', [], ['MODE' => 'html', 'NAME' => 'Иконка Ты получаешь']); ?>
                        <p class="f-20"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/get_text_5.php', [], ['MODE' => 'html', 'NAME' => 'Текст Ты получаешь']); ?></p>
                    </div>
                    <div class="item">
                        <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/get_icon.php', [], ['MODE' => 'html', 'NAME' => 'Иконка Ты получаешь']); ?>
                        <p class="f-20"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/get_text_6.php', [], ['MODE' => 'html', 'NAME' => 'Текст Ты получаешь']); ?></p>
                    </div>
                    <div class="item">
                        <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/get_icon.php', [], ['MODE' => 'html', 'NAME' => 'Иконка Ты получаешь']); ?>
                        <p class="f-20"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/get_text_7.php', [], ['MODE' => 'html', 'NAME' => 'Текст Ты получаешь']); ?></p>
                    </div>
                    <div class="item">
                        <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/get_icon.php', [], ['MODE' => 'html', 'NAME' => 'Иконка Ты получаешь']); ?>
                        <p class="f-20"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/get_text_8.php', [], ['MODE' => 'html', 'NAME' => 'Текст Ты получаешь']); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="out-client talent-content">
        <div class="container">
            <h2 class="margin-bottom56"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/our_client_heading.php', [], ['MODE' => 'html', 'NAME' => 'Наши клиенты заголовок']); ?></h2>
            <p class="f-32 margin-bottom48"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/our_client_description.php', [], ['MODE' => 'html', 'NAME' => 'Наши клиенты описание']); ?></p>
        </div>
        <div class="our-client-slider">
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
    </div>
    <div class="start-work talent-content">
        <div class="container">
            <h2 class="margin-bottom56"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/start_heading.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок Начало сотрудничества']); ?></h2>
            <ul class="margin-bottom56"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/start_ul.php', [], ['MODE' => 'html', 'NAME' => 'Текст Начало сотрудничества']); ?></ul>
            <p class="f-32 margin-bottom32"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/start_heading_learn.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок Начало сотрудничества, Обучение']); ?></p>
            <div class="talent-grid-2 margin-bottom56">
                <div>
                    <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/start_icon_1.php', [], ['MODE' => 'html', 'NAME' => 'Обучение Иконка']); ?>
                    <p class="f-20"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/start_text_1.php', [], ['MODE' => 'html', 'NAME' => 'Обучение Текст']); ?></p>
                </div>
                <div>
                    <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/start_icon_2.php', [], ['MODE' => 'html', 'NAME' => 'Обучение Иконка']); ?>
                    <p class="f-20"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/start_text_2.php', [], ['MODE' => 'html', 'NAME' => 'Обучение Текст']); ?></p>
                </div>
            </div>
            <div class="talent-flex-2">
                <div class="btn-main size-l trainer-modal">
                    <span class="f-24">Стать тренером</span>
                </div>
                <p class="f-16"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/talent/start_form_text.php', [], ['MODE' => 'html', 'NAME' => 'Обучение Форма текст']); ?></p>
            </div>
        </div>
    </div>
    <div class="talent-content telegram">
        <?php $APPLICATION->IncludeComponent(
	"addamant:telegram.subscribe", 
	".default", 
	array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"SUBSCRIBE_TITLE" => "",
		"SUBSCRIBE_LINK" => "https://t.me/IBS_Training_Center",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>
    </div>
</div>

<?php $APPLICATION->IncludeComponent(
    "bitrix:form.result.new",
    "become.coach",
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
        "WEB_FORM_ID" => "42"
    )
);?>

<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>