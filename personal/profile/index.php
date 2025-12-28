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
    

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>