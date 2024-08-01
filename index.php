<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
global $USER, $APPLICATION;
$APPLICATION->SetPageProperty("title", "Обучение по разработке ПО | IBS Training Center");
$APPLICATION->SetPageProperty("keywords", "курсы для программистов,  учебный центр IBS, уц ibs, дистанционное обучение, корпоративное обучение");
$APPLICATION->SetPageProperty("description", "Обучение для программистов, аналитиков, менеджеров проектов: тренинги, курсы, бесплатные семинары и вебинары, конференции");
$APPLICATION->SetTitle("IBS Training Center: Курсы и тренинги для программистов, аналитиков, менеджеров проектов, тестировщиков. Разработка ПО, обучение, учебный центр");?>
<?php
if(false) {?>
    <style>
        .text_links .links {
            display: none;
        }
    </style>
    <script>
        $(document).ready(function () {
            $(".socialnet").one("click", function () {
                pageTracker._trackEvent('SocialButton', 'Main', 'All');
            });
            $("#s_youtube").click(function () {
                pageTracker._trackEvent('SocialButton', 'Main', 'Youtube');
            });
            $("#s_rss").click(function () {
                pageTracker._trackEvent('SocialButton', 'Main', 'RSS');
            });
            $("#s_vkontakte").click(function () {
                pageTracker._trackEvent('SocialButton', 'Main', 'Vkontakte');
            });


        })
    </script>
<?php
} else {
    $GLOBALS['arFilterIndexNewsList'] = ['!PROPERTY_NOT_SHOW_HOME_PAGE_VALUE' => 'Да'];?>
    <section class="section-box _slider">
        <?$APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "2020_main-slider",
            Array(
                "COMPONENT_TEMPLATE" => ".default",
                "IBLOCK_TYPE" => "edu_const",
                "IBLOCK_ID" => "173",
                "NEWS_COUNT" => "999",
                "SORT_BY1" => "SORT",
                "SORT_ORDER1" => "ASC",
                "SORT_BY2" => "ACTIVE_FROM",
                "SORT_ORDER2" => "DESC",
                "FILTER_NAME" => "",
                "FIELD_CODE" => array("*"),
                "PROPERTY_CODE" => array("*"),
                "CHECK_DATES" => "Y",
                "DETAIL_URL" => "",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "36000000",
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "Y",
                "PREVIEW_TRUNCATE_LEN" => "",
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "SET_TITLE" => "N",
                "SET_BROWSER_TITLE" => "N",
                "SET_META_KEYWORDS" => "N",
                "SET_META_DESCRIPTION" => "N",
                "SET_LAST_MODIFIED" => "N",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "ADD_SECTIONS_CHAIN" => "N",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "ru_home_slider",
                "INCLUDE_SUBSECTIONS" => "Y",
                "DISPLAY_DATE" => "Y",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "PAGER_TEMPLATE" => ".default",
                "DISPLAY_TOP_PAGER" => "N",
                "DISPLAY_BOTTOM_PAGER" => "N",
                "PAGER_TITLE" => "Новости",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "SET_STATUS_404" => "N",
                "SHOW_404" => "N",
                "MESSAGE_404" => ""
            )
        );?>
    </section>
    <section class="section-box _groups-courses">
        <div class="section-box__container container">
            <div class="section-box__inner">
                <div class="section-box__header">
                    <div class="section-box__title">Наши <b>сервисы и продукты</b></div>
                    <div class="section-box__subtitle">
                        <p>Хотите, чтобы IT-проект был разработан в срок, а продукт успешно вышел на рынок? Это достигается во многом благодаря высоким профессиональным качествам IT-команды и правильно выстроенным бизнес-процессам.</p>
                        <p>IBS Training Center поможет вам в короткие сроки оценить профессиональные навыки всей команды IT-разработки и прокачать их до требуемого уровня.
                            В результате проектная команда - аналитики, архитекторы, разработчики, тестировщики, BigData/DevOps инженеры и др. - сможет выйти в прод в нужные для заказчика сроки и с требуемым уровнем качества ПО без раздувания бюджета.</p>
                        <p>В отличие от других провайдеров обучения мы учим тому, что успешно делаем сами более 20 лет!</p>
                    </div>
                </div>
            </div>
            <div class="section-box__content">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "2020_groups-courses",
                    Array(
                        "COMPONENT_TEMPLATE" => ".default",
                        "IBLOCK_TYPE" => "edu_const",
                        "IBLOCK_ID" => "173",
                        "NEWS_COUNT" => "999",
                        "SORT_BY1" => "SORT",
                        "SORT_ORDER1" => "ASC",
                        "SORT_BY2" => "ACTIVE_FROM",
                        "SORT_ORDER2" => "DESC",
                        "FILTER_NAME" => "",
                        "FIELD_CODE" => array("*"),
                        "PROPERTY_CODE" => array("*"),
                        "CHECK_DATES" => "Y",
                        "DETAIL_URL" => "",
                        "AJAX_MODE" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "AJAX_OPTION_HISTORY" => "N",
                        "AJAX_OPTION_ADDITIONAL" => "",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "36000000",
                        "CACHE_FILTER" => "N",
                        "CACHE_GROUPS" => "Y",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "ACTIVE_DATE_FORMAT" => "d.m.Y",
                        "SET_TITLE" => "N",
                        "SET_BROWSER_TITLE" => "N",
                        "SET_META_KEYWORDS" => "N",
                        "SET_META_DESCRIPTION" => "N",
                        "SET_LAST_MODIFIED" => "N",
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "ADD_SECTIONS_CHAIN" => "N",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                        "PARENT_SECTION" => "",
                        "PARENT_SECTION_CODE" => "ru_home_groups-courses",
                        "INCLUDE_SUBSECTIONS" => "Y",
                        "DISPLAY_DATE" => "Y",
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => "Y",
                        "DISPLAY_PREVIEW_TEXT" => "Y",
                        "PAGER_TEMPLATE" => ".default",
                        "DISPLAY_TOP_PAGER" => "N",
                        "DISPLAY_BOTTOM_PAGER" => "N",
                        "PAGER_TITLE" => "Новости",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "PAGER_BASE_LINK_ENABLE" => "N",
                        "SET_STATUS_404" => "N",
                        "SHOW_404" => "N",
                        "MESSAGE_404" => ""
                    )
                );?>
            </div>
        </div>
    </section>
    <section class="section-box _categories-course">
        <div class="section-box__container container">
            <div class="section-box__header">
                <div class="section-box__title _white"><b>Направления обучения</b></div>
            </div>
            <div class="section-box__content">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "2020_categories-courses",
                    Array(
                        "COMPONENT_TEMPLATE" => ".default",
                        "IBLOCK_TYPE" => "edu_const",
                        "IBLOCK_ID" => "173",
                        "NEWS_COUNT" => "999",
                        "SORT_BY1" => "SORT",
                        "SORT_ORDER1" => "ASC",
                        "SORT_BY2" => "ACTIVE_FROM",
                        "SORT_ORDER2" => "DESC",
                        "FILTER_NAME" => "",
                        "FIELD_CODE" => array("*"),
                        "PROPERTY_CODE" => array("*"),
                        "CHECK_DATES" => "Y",
                        "DETAIL_URL" => "",
                        "AJAX_MODE" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "AJAX_OPTION_HISTORY" => "N",
                        "AJAX_OPTION_ADDITIONAL" => "",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "36000000",
                        "CACHE_FILTER" => "N",
                        "CACHE_GROUPS" => "Y",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "ACTIVE_DATE_FORMAT" => "d.m.Y",
                        "SET_TITLE" => "N",
                        "SET_BROWSER_TITLE" => "N",
                        "SET_META_KEYWORDS" => "N",
                        "SET_META_DESCRIPTION" => "N",
                        "SET_LAST_MODIFIED" => "N",
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "ADD_SECTIONS_CHAIN" => "N",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                        "PARENT_SECTION" => "",
                        "PARENT_SECTION_CODE" => "ru_home_categories-course",
                        "INCLUDE_SUBSECTIONS" => "Y",
                        "DISPLAY_DATE" => "Y",
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => "Y",
                        "DISPLAY_PREVIEW_TEXT" => "Y",
                        "PAGER_TEMPLATE" => ".default",
                        "DISPLAY_TOP_PAGER" => "N",
                        "DISPLAY_BOTTOM_PAGER" => "N",
                        "PAGER_TITLE" => "Новости",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "PAGER_BASE_LINK_ENABLE" => "N",
                        "SET_STATUS_404" => "N",
                        "SHOW_404" => "N",
                        "MESSAGE_404" => ""
                    )
                );?>
            </div>
            <div class="section-box__footer _button">
                <a href="/training/katalog_kursov/" class="button _b-white _w-full"><span>Перейти в полный каталог</span></a>
            </div>
        </div>
    </section>
    <section class="section-box _solutions">
        <div class="section-box__container container">
            <div class="section-box__header">
                <div class="section-box__title"><b>Новые</b> курсы</div>
            </div>
            <div class="section-box__content">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "2020_teaser-cards",
                    Array(
                        "COMPONENT_TEMPLATE" => ".default",
                        "IBLOCK_TYPE" => "edu_const",
                        "IBLOCK_ID" => "173",
                        "NEWS_COUNT" => "999",
                        "SORT_BY1" => "SORT",
                        "SORT_ORDER1" => "ASC",
                        "SORT_BY2" => "ACTIVE_FROM",
                        "SORT_ORDER2" => "DESC",
                        "FILTER_NAME" => "",
                        "FIELD_CODE" => array("*"),
                        "PROPERTY_CODE" => array("*"),
                        "CHECK_DATES" => "Y",
                        "DETAIL_URL" => "",
                        "AJAX_MODE" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "AJAX_OPTION_HISTORY" => "N",
                        "AJAX_OPTION_ADDITIONAL" => "",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "36000000",
                        "CACHE_FILTER" => "N",
                        "CACHE_GROUPS" => "Y",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "ACTIVE_DATE_FORMAT" => "d.m.Y",
                        "SET_TITLE" => "N",
                        "SET_BROWSER_TITLE" => "N",
                        "SET_META_KEYWORDS" => "N",
                        "SET_META_DESCRIPTION" => "N",
                        "SET_LAST_MODIFIED" => "N",
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "ADD_SECTIONS_CHAIN" => "N",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                        "PARENT_SECTION" => "",
                        "PARENT_SECTION_CODE" => "ru_home_teaser-cards",
                        "INCLUDE_SUBSECTIONS" => "Y",
                        "DISPLAY_DATE" => "Y",
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => "Y",
                        "DISPLAY_PREVIEW_TEXT" => "Y",
                        "PAGER_TEMPLATE" => ".default",
                        "DISPLAY_TOP_PAGER" => "N",
                        "DISPLAY_BOTTOM_PAGER" => "N",
                        "PAGER_TITLE" => "Новости",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "PAGER_BASE_LINK_ENABLE" => "N",
                        "SET_STATUS_404" => "N",
                        "SHOW_404" => "N",
                        "MESSAGE_404" => ""
                    )
                );?>
            </div>
            <div class="section-box__footer _button">
                <a href="/timetable/" class="button _b-blue _w-full"><span>Смотреть курсы в расписании</span></a>
            </div>
        </div>
    </section>
    <section class="section-box _callback-mini-background">
        <div class="section-box__container container">
            <div class="section-box__header">
                <div class="section-box__title _white"><b>Ищете нестандартное решение?</b><br>
                    Наши эксперты помогут!</div>
            </div>
            <div class="section-box__content">
                <?=$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH.'/include/callback-mini.php', [], ['MODE' => 'html']);?>
            </div>
        </div>
    </section>
    <?php
    if (false) {?>
        <section class="section-box _certificate-group">
            <div class="section-box__container container">
                <div class="section-box__header">
                    <div class="section-box__title">Наши <b>сертификации</b></div>
                </div>
                <div class="section-box__content">
                    <?php
                    $APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "2020_certifications",
                        Array(
                            "COMPONENT_TEMPLATE" => ".default",
                            "IBLOCK_TYPE" => "edu_const",
                            "IBLOCK_ID" => "173",
                            "NEWS_COUNT" => "999",
                            "SORT_BY1" => "SORT",
                            "SORT_ORDER1" => "ASC",
                            "SORT_BY2" => "ACTIVE_FROM",
                            "SORT_ORDER2" => "DESC",
                            "FILTER_NAME" => "",
                            "FIELD_CODE" => array("*"),
                            "PROPERTY_CODE" => array("*"),
                            "CHECK_DATES" => "Y",
                            "DETAIL_URL" => "",
                            "AJAX_MODE" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "36000000",
                            "CACHE_FILTER" => "N",
                            "CACHE_GROUPS" => "Y",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "SET_TITLE" => "N",
                            "SET_BROWSER_TITLE" => "N",
                            "SET_META_KEYWORDS" => "N",
                            "SET_META_DESCRIPTION" => "N",
                            "SET_LAST_MODIFIED" => "N",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "PARENT_SECTION" => "",
                            "PARENT_SECTION_CODE" => "ru_home_certificates",
                            "INCLUDE_SUBSECTIONS" => "Y",
                            "DISPLAY_DATE" => "Y",
                            "DISPLAY_NAME" => "Y",
                            "DISPLAY_PICTURE" => "Y",
                            "DISPLAY_PREVIEW_TEXT" => "Y",
                            "PAGER_TEMPLATE" => ".default",
                            "DISPLAY_TOP_PAGER" => "N",
                            "DISPLAY_BOTTOM_PAGER" => "N",
                            "PAGER_TITLE" => "Новости",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "SET_STATUS_404" => "N",
                            "SHOW_404" => "N",
                            "MESSAGE_404" => ""
                        )
                    );
                    ?>
                </div>
            </div>
        </section>
    <?php } ?>
    <section class="section-box _news">
        <div class="section-box__container container">
            <div class="section-box__header">
                <div class="section-box__title">Новости - <b>Статьи</b> - Блог</div>
            </div>
            <div class="section-box__content">
                <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"2020_news_cards", 
	array(
		"COMPONENT_TEMPLATE" => "2020_news_cards",
		"IBLOCK_TYPE" => "edu",
		"IBLOCK_ID" => "23",
		"NEWS_COUNT" => "5",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "ID",
		"SORT_ORDER2" => "DESC",
		"FILTER_NAME" => "arFilterIndexNewsList",
		"FIELD_CODE" => array(
			0 => "",
			1 => "*",
			2 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "*",
			2 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"STRICT_SECTION_CHECK" => "N"
	),
	false
);?>
            </div>
        </div>
    </section>
    <section class="section-box _subscribe">
        <div class="section-box__container container">
            <div class="section-box__header">
                <div class="section-box__title _white">Как не пропустить <b>самое интересное?</b></div>
                <div class="section-box__subtitle _white">Подписывайтесь на наш ежемесячный дайджест!</div>
            </div>
            <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH.'/include/subscribe.php', [], ['MODE' => 'html']);?>
        </div>
    </section>
<?php
}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>