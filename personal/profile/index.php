<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Настройки");
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
            <h1 class="lk-header__title">Настройки</h1>
        </div>
        <div class="frame-851213393">
            <div class="lk-content">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.profile",
                    "profile-lk",
                    array(
                        "SET_TITLE" => "Y",
                        "USER_PROPERTY" => array(
                            0 => "UF_TELEGRAM",
                        ),
                        "SEND_INFO" => "N",
                        "CHECK_RIGHTS" => "N",
                        "USER_PROPERTY_NAME" => "",
                        "AJAX_MODE" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "AJAX_OPTION_HISTORY" => "N"
                    ),
                    false
                );?>

            </div>

        </div>
    </div>
    </div>
    <style>
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
            .lk-update-btn svg {
                width: 20px;
                height: 20px;
            }


        }
        @media screen and (max-width: 480px) {
            .lk-header__title {
                font-size: 18px;
                line-height: 28px;
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


    </style>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>