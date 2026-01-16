<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Персональный раздел");
?>

    <div class="frame-851212741">
        <?$APPLICATION->IncludeComponent(
            "bitrix:menu",
            "personal_menu",
            [
                "ALLOW_MULTI_SELECT" => "N",
                "CHILD_MENU_TYPE" => "left",
                "DELAY" => "N",
                "MAX_LEVEL" => "1",
                "MENU_CACHE_GET_VARS" => [],
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_TYPE" => "N",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "ROOT_MENU_TYPE" => "left",
                "USE_EXT" => "N",
                "COMPONENT_TEMPLATE" => "personal_menu"
            ],
            false
        );?>

        <div class="frame-851212766">
            <div class="stats-container">
                <div class="stats-wrapper">
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-number green">3</div>
                            <div class="stat-title">Курса пройдено</div>
                        </div>
                        <div class="cont-butt">
                            <button class="btn-outline">Программы обучения</button>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-number grey">0</div>
                            <div class="stat-title">Программ пройдено</div>
                        </div>
                        <div class="cont-butt">
                            <button class="btn-outline">Программы обучения</button>
                        </div>

                    </div>
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-number green">1</div>
                            <div class="stat-title">Сертификация пройдена</div>
                        </div>
                        <button class="btn-outline">
                            <span class="btn-text">Мои сертификаты</span>
                        </button>
                    </div>
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-number green">3000</div>
                            <div class="stat-title">Баллов на счёте</div>
                        </div>
                        <button class="btn-outline">
                            <span class="btn-text">Мои баллы</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .frame-851212741 {
            display: flex;
            flex-direction: row;
            width: 100%;
            background: #fff;
        }

        .frame-851212766 {
            flex: 1;
            min-width: 0;
        }
        .stats-container {
            width: 100%;
            background: #2B418B;
            padding: 48px 56px;
        }

        .stats-wrapper {
            display: flex;
            flex-wrap: nowrap;
            gap: 16px;
            max-width: 1450px;
            margin: 0 auto;
        }
        .stat-card {
            flex: 0 0 326px;
            width: 326px;
            height: 298px;
            background: #FFFFFF;
            padding: 24px;
            display: flex;
            flex-direction: column;
            gap: 24px;
            border-radius: 0;
            box-sizing: border-box;
        }

        .stat-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            flex-grow: 1;
        }

        .stat-number {
            font-family: 'Stag Sans', 'Arial', sans-serif;
            font-weight: 300;
            font-size: 80px;
            line-height: 1;
            color: inherit;
        }

        .stat-number.green { color: #4C9F69; }
        .stat-number.grey  { color: #B2B2B2; }

        .stat-title {
            font-family: 'Noto Sans', sans-serif;
            font-weight: 400;
            font-size: 20px;
            line-height: 28px;
            text-align: center;
            color: #000;
        }

        .btn-outline {
            width: 100%;
            height: 54px;
            background: #FFFFFF;
            border: 1px solid #2B418B;
            color: #2B418B;
            font-family: 'Noto Sans', sans-serif;
            font-size: 16px;
            font-weight: 400;
            cursor: pointer;
            transition: all 0.25s;
        }

        .btn-outline:hover {
            background: #2B418B;
            color: white;
        }
        @media (max-width: 1200px) {
            .stats-container {
                padding: 32px 16px 32px 16px;
                background: #2B418B;
            }

            .stats-wrapper {
                display: flex;
                flex-wrap: nowrap;
                overflow-x: auto;
                scroll-snap-type: x mandatory;
                scroll-behavior: smooth;
                -webkit-overflow-scrolling: touch;
                gap: 16px;
                padding: 0 0 8px 0;
                scrollbar-width: thin;
                scrollbar-color: rgba(255,255,255,0.3) rgba(43,65,139,0.4);
                max-width: 100%;
                margin: 0;
            }

            .stats-wrapper::-webkit-scrollbar {
                height: 8px;
            }
            .stats-wrapper::-webkit-scrollbar-track {
                background: rgba(43,65,139,0.4);
                border-radius: 4px;
            }
            .stats-wrapper::-webkit-scrollbar-thumb {
                background: rgba(255,255,255,0.3);
                border-radius: 4px;
            }
            .stat-card {
                flex: 0 0 270px;
                width: 270px;
                height: 172px;
                background: #FFFFFF;
                padding: 8px 16px 16px;
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 8px;
                border-radius: 0;
                box-sizing: border-box;
                scroll-snap-align: start;
                scroll-snap-stop: always;
            }
            .stat-header {
                display: flex;
                flex-direction: row;
                align-items: center;
                padding: 0;
                gap: 12px;
                width: 100%;
                height: 52px;
                flex: none;
                order: 0;
                align-self: stretch;
            }
            .stat-number {
                width: auto;
                min-width: 20px;
                height: 52px;
                font-family: 'Noto Sans';
                font-style: normal;
                font-weight: 500;
                font-size: 34px;
                line-height: 52px;
                display: flex;
                align-items: center;
                background: linear-gradient(90deg, #2F6298 0%, #438DB0 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                color: transparent;
                flex: none;
                order: 0;
            }
            .stat-number.green,
            .stat-number.grey {
                color: transparent;
                background: linear-gradient(90deg, #2F6298 0%, #438DB0 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }
            .stat-title {
                width: 100%;
                height: 22px;
                font-family: 'Noto Sans';
                font-style: normal;
                font-weight: 400;
                font-size: 16px;
                line-height: 22px;
                text-transform: capitalize;
                color: #000000;
                flex: none;
                order: 1;
                flex-grow: 1;
                text-align: left;
                white-space: normal;
            }

            .cont-butt {
                width: 100%;
            }

            .btn-outline {
                box-sizing: border-box;
                display: flex;
                flex-direction: row;
                justify-content: center;
                align-items: center;
                padding: 8px 16px;
                width: 100%;
                height: 40px;
                background: #FFFFFF;
                border: 1px solid #2B418B;
                font-family: 'Noto Sans';
                font-style: normal;
                font-weight: 400;
                font-size: 16px;
                line-height: 24px;
                color: #2B418B;
                cursor: pointer;
                transition: all 0.25s;
                flex: none;
                order: 1;
                align-self: stretch;
            }

            .btn-outline:hover {
                background: #2B418B;
                color: white;
            }
            .btn-text {
                width: auto;
                height: 24px;
                flex: none;
                order: 0;
                flex-grow: 0;
            }
        }
        @media (max-width: 480px) {
            .stats-container {
                padding: 24px 12px;
            }


            .stat-number {
                font-size: 32px;
                height: 48px;
                line-height: 48px;
            }
        }
        @media (max-width: 480px) {
            .stat-card {
                flex: 0 0 72vw;
                width: 86vw;
            }

            .stat-number {
                font-size: 42px;
            }
        }
    </style>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>