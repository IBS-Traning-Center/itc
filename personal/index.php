<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Персональный раздел");
//?>

    <div class="frame-851212741">
        <?$APPLICATION->IncludeComponent(
            "bitrix:menu",
            "personal_menu",
            [
                "ALLOW_MULTI_SELECT" => "N",
                "CHILD_MENU_TYPE" => "left",
                "DELAY" => "N",
                "MAX_LEVEL" => "1",
                "MENU_CACHE_GET_VARS" => [
                ],
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_TYPE" => "N",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "ROOT_MENU_TYPE" => "left",
                "USE_EXT" => "N",
                "COMPONENT_TEMPLATE" => "personal_menu"
            ],
            false
        );?>

        <!-- Основной контент -->
        <div class="frame-851212766">
            <!-- Верхняя панель со статистикой -->
            <div class="frame-851212738">
                <div class="stat-card">
                    <div class="frame-851213208">
                        <div class="stat-number green">3</div>
                        <div class="stat-title">Курса пройдено</div>
                    </div>
                    <button class="btn-outline">
                        <span class="btn-text">Мои документы</span>
                    </button>
                </div>

                <div class="stat-card">
                    <div class="frame-851213207">
                        <div class="stat-number grey">0</div>
                        <div class="stat-title">Программ пройдено</div>
                    </div>
                    <button class="btn-outline">
                        <span class="btn-text">Программы обучения</span>
                    </button>
                </div>

                <div class="stat-card">
                    <div class="frame-851213207">
                        <div class="stat-number green">1</div>
                        <div class="stat-title">Сертификация пройдена</div>
                    </div>
                    <button class="btn-outline">
                        <span class="btn-text">Мои сертификаты</span>
                    </button>
                </div>

                <div class="stat-card">
                    <div class="frame-851213206">
                        <div class="stat-number green">3000</div>
                        <div class="stat-title">Баллов на счёте</div>
                    </div>
                    <div class="frame-851213202">
                    </div>
                    <button class="btn-outline">
                        <span class="btn-text">Мои баллы</span>
                    </button>
                </div>
            </div>

        </div>
    </div>
    <style>
        .frame-851212741 {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            padding: 0px;
            width: 1920px;
            height: 1976px;
            background: #FFFFFF;
            flex: none;
            order: 1;
            flex-grow: 0;
        }
        .frame-851212766 {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding: 0px;
            width: 1450px;
            height: 1976px;
            flex: none;
            order: 1;
            flex-grow: 0;
        }
        .frame-851212738 {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            padding: 48px 56px;
            gap: 16px;
            width: 1450px;
            height: 394px;
            background: #2B418B;
            flex: none;
            order: 0;
            align-self: stretch;
            flex-grow: 0;
        }

        .stat-card {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding: 24px;
            gap: 16px;
            width: 326.5px;
            height: 298px;
            background: #FFFFFF;
            border-radius: 0px;
            flex: none;
            order: 0;
            flex-grow: 1;
        }

        .stat-card:last-child {
            width: 310.5px;
            flex-grow: 0;
        }

        .frame-851213208,
        .frame-851213207,
        .frame-851213206 {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding: 0px;
            flex: none;
            order: 0;
            align-self: stretch;
            flex-grow: 1;
        }

        .stat-number {
            width: 100%;
            height: 84px;
            font-family: 'Stag Sans';
            font-style: normal;
            font-weight: 300;
            font-size: 80px;
            line-height: 84px;
            display: block;
            align-items: center;
            text-align: center;
            flex: none;
            order: 0;
            align-self: stretch;
            flex-grow: 0;
        }

        .stat-number.green {
            color: #4C9F69;
        }

        .stat-number.grey {
            color: #B2B2B2;
        }

        .stat-title {
            width: 100%;
            height: 64px;
            font-family: 'Noto Sans';
            font-style: normal;
            font-weight: 400;
            font-size: 20px;
            line-height: 32px;
            text-align: center;
            color: #000000;
            flex: none;
            order: 1;
            align-self: stretch;
            flex-grow: 0;
        }

        .btn-outline{
            box-sizing: border-box;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            padding: 32px 16px;
            gap: 10px;
            width: 100%;
            height: 54px;
            flex: none;
            order: 1;
            align-self: stretch;
            flex-grow: 0;
            cursor: pointer;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-outline {
            background: #FFFFFF;
            border: 1px solid #2B418B;
        }


        .btn-text {
            font-family: 'Noto Sans';
            font-style: normal;
            font-weight: 400;
            font-size: 16px;
            line-height: 24px;
            color: #2B418B;
            flex: none;
            order: 0;
            flex-grow: 0;
        }


        .btn-outline:hover {
            background: #2B418B;
            border-color: #2B418B;
            box-shadow: 0 4px 12px rgba(43, 65, 139, 0.25);
        }
        .btn-outline:hover .btn-text {
            color: #FFFFFF;
        }

        .course-card.featured .course-code {
            color: #FFFFFF;
        }
        .course-card:not(.featured) .course-code {
            color: #000000;
        }

        @media (max-width: 1919px) {
            .frame-851212741 {
                width: 100%;
                height: auto;
            }

            .frame-851212766 {
                width: 75%;
                height: auto;
            }

            .frame-851212738,
            .courses-section {
                width: 100%;
                height: auto;
            }
        }
        @media (max-width: 768px) {
            .frame-851212741 {
                flex-direction: column;
            }
            .frame-851212766 {
                width: 100%;
            }

            .frame-851212738 {
                flex-wrap: wrap;
                padding: 24px;
            }

            .stat-card {
                width: calc(50% - 8px);
                margin-bottom: 16px;
            }
        }
    </style>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>