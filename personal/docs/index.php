<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Мои документы");
?><div class="lk-layout">
 <aside class="lk-sidebar">
	<?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"personal_menu",
	Array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "left",
		"COMPONENT_TEMPLATE" => "personal_menu",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => [],
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "left",
		"USE_EXT" => "N"
	)
);?> </aside>
	<div class="lk-content-main">
		<div class="lk-header">
			<h1 class="lk-header__title">Мои документы</h1>
		</div>
		<div class="frame-851213393">
			<div class="lk-content">
				<div class="lk-header-row">
					<div class="lk-tabs">
 <button class="lk-tab is-active">Все</button> <button class="lk-tab">Сертификация</button> <button class="lk-tab">Курсы</button> <button class="lk-tab">Программы</button>
					</div>
					<div class="lk-header__right">
 <span class="lk-update-date">Обновлено 19.09.2025</span> <a href="#" class="lk-update-btn">
						Обновить информацию </a>
					</div>
				</div>
				 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"sert-lk",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "Y",
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
		"COMPONENT_TEMPLATE" => "sert-lk",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => [0=>"",1=>"",],
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => $_REQUEST["ID"],
		"IBLOCK_TYPE" => "catalog",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
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
		"PROPERTY_CODE" => [0=>"",1=>"",],
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N"
	)
);?> <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"courses-lk",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "Y",
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
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => [0=>"",1=>"",],
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => $_REQUEST["ID"],
		"IBLOCK_TYPE" => "catalog",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
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
		"PROPERTY_CODE" => [0=>"",1=>"",],
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N"
	)
);?> <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"programms-lk",
Array()
);?>
                <div class="lk-notification">
                    Показаны записи только после 1 января 2025 года. Если вы проходили обучение или сертификацию до этой даты, то вы можете запросить документы об образовании через форму
                </div>
			</div>

        </div>
	</div>
</div>
<?$APPLICATION->IncludeComponent(
    "bitrix:form.result.new",
    "doc_form",
    [
        "CACHE_TIME" => "3600",
        "CACHE_TYPE" => "A",
        "CHAIN_ITEM_LINK" => "",
        "CHAIN_ITEM_TEXT" => "",
        "EDIT_URL" => "",
        "IGNORE_CUSTOM_TEMPLATE" => "N",
        "LIST_URL" => "",
        "SEF_MODE" => "N",
        "SUCCESS_URL" => "",
        "USE_EXTENDED_ERRORS" => "N",
        "WEB_FORM_ID" => "54",
        "COMPONENT_TEMPLATE" => "doc_form",
        "VARIABLE_ALIASES" => [
            "WEB_FORM_ID" => "WEB_FORM_ID",
            "RESULT_ID" => "RESULT_ID",
        ]
    ],
    false
);?>
    <style>
        .lk-notification {

            max-width: 100%;
            min-height: 48px;
            margin: 24px 0;
            padding: 12px 16px;
            font-family: 'Inter', sans-serif;
            font-style: normal;
            font-weight: 400;
            font-size: 16px;
            line-height: 24px;
            color: #000000;
            background: #FFFFFF;
            box-sizing: border-box;
            flex: none;
            align-self: stretch;
            flex-grow: 0;
        }

        @media screen and (max-width: 1440px) {
            .lk-notification {
                width: 100%;
            }
        }

        @media screen and (max-width: 768px) {
            .lk-notification {
                font-size: 14px;
                line-height: 20px;
                padding: 10px 12px;
                margin: 16px 0;
            }
        }

        @media screen and (max-width: 480px) {
            .lk-notification {
                font-size: 12px;
                line-height: 18px;
                padding: 8px 10px;
                margin: 12px 0;
            }
        }
        .lk-layout {
            display: flex;
            align-items: flex-start;
            width: 100%;
            min-height: 100vh;
            background: #fff;
        }

        .lk-sidebar {
            width: 454px;
            flex-shrink: 0;
            background: #fff;
        }

        .lk-content-main {
            display: flex;
            flex-direction: column;
            width: 100%;
            min-height: 100vh;
        }

        .frame-851213393 {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding: 0px;
            gap: 40px;
            width: 100%;
            flex: none;
            order: 1;
            align-self: stretch;
            flex-grow: 0;
        }

        .lk-content {
            flex: 1;
            padding: 24px 32px;
            width: 100%;
            box-sizing: border-box;
        }

        .lk-header {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding: 56px;
            gap: 32px;
            background: #2B418B;
            width: 100%;
            box-sizing: border-box;
        }

        .lk-header__title {
            font-family: 'Noto Sans', sans-serif;
            font-style: normal;
            font-weight: 400;
            font-size: 80px;
            line-height: 92px;
            color: #FFFFFF;
            margin: 0;
        }

        .lk-header-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 24px 0 32px;
            width: 100%;
            flex-wrap: wrap;
            gap: 16px;
        }

        .lk-tabs {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            padding: 0px;
            gap: 4px;
            width: auto;
            height: 40px;
            flex: none;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .lk-tab {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            padding: 8px 16px;
            height: 40px;
            font-family: 'Noto Sans', sans-serif;
            font-style: normal;
            font-weight: 400;
            font-size: 16px;
            line-height: 24px;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s;
            flex: none;
            white-space: nowrap;
            min-width: fit-content;
            box-sizing: border-box;
        }

        .lk-tab.is-active {
            background: #000000;
            color: #FFFFFF;
        }

        .lk-tab:not(.is-active) {
            background: #F0F0F0;
            color: #000000;
        }

        .lk-header__right {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .lk-update-date {
            font-family: 'Noto Sans', sans-serif;
            font-style: normal;
            font-weight: 400;
            font-size: 14px;
            line-height: 20px;
            color: #666666;
            white-space: nowrap;
        }

        .lk-update-btn {
            font-family: 'Noto Sans', sans-serif;
            font-style: normal;
            font-weight: 500;
            font-size: 16px;
            line-height: 24px;
            color: #2B418B;
            text-decoration: none;
            transition: opacity 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
        }

        .lk-update-btn:hover {
            opacity: 0.8;
            text-decoration: underline;
        }

        .lk-update-btn svg {
            flex-shrink: 0;
        }

        @media screen and (max-width: 1024px) {
            .lk-sidebar {
                width: 300px;
            }

            .lk-header {
                padding: 40px 32px;
            }

            .lk-header__title {
                font-size: 60px;
                line-height: 72px;
            }

            .lk-content {
                padding: 20px 24px;
            }

            .lk-tabs {
                width: 100%;
                overflow-x: auto;
            }

            .lk-header-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
            }

            .lk-header__right {
                width: 100%;
                justify-content: space-between;
            }
        }

        @media screen and (max-width: 768px) {
            .lk-layout {
                flex-direction: column;
            }

            .lk-sidebar {
                width: 100%;
                position: fixed;
                top: 0;
                left: -100%;
                height: 100vh;
                z-index: 999;
                transition: left 0.3s ease;
                overflow-y: auto;
                box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            }

            .lk-sidebar.active {
                left: 0;
            }


            .lk-header {
                padding: 16px;
                gap: 32px;
                border-radius: 0;
                margin-top: 0;
            }

            .lk-header__title {
                font-family: 'Noto Sans', sans-serif;
                font-style: normal;
                font-weight: 700;
                font-size: 20px;
                line-height: 32px;
                width: 100%;
                height: 32px;
            }

            .frame-851213393 {
                gap: 24px;
            }

            .lk-content {
                padding: 16px;
            }

            .lk-header-row {
                margin: 16px 0 24px;
            }

            .lk-tabs {
                width: 100%;
                height: auto;
                flex-wrap: nowrap;
                overflow-x: auto;
                padding-bottom: 4px;
            }

            .lk-tab {
                padding: 6px 12px;
                height: 36px;
                font-size: 14px;
                line-height: 20px;
            }

            .lk-header__right {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
                width: 100%;
            }

            .lk-update-date {
                font-size: 12px;
                line-height: 18px;
            }

            .lk-update-btn {
                font-size: 14px;
                line-height: 20px;
            }

            .lk-update-btn svg {
                width: 20px;
                height: 20px;
            }

            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0,0,0,0.5);
                z-index: 998;
            }

            .sidebar-overlay.active {
                display: block;
            }
        }

        @media screen and (max-width: 480px) {
            .lk-header__title {
                font-size: 18px;
                line-height: 28px;
            }

            .lk-tabs {
                gap: 2px;
            }

            .lk-tab {
                padding: 4px 8px;
                font-size: 12px;
                height: 32px;
            }

            .lk-content {
                padding: 12px;
            }

            .lk-update-btn span {
                display: none;
            }

            .lk-update-btn svg {
                margin-right: 0;
            }
        }


    </style><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>