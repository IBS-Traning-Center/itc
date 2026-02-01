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

<div class="frame-851212741">
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
    );?>
    <div class="frame-851212766">
        <div class="stats-container">
            <div class="stats-wrapper">
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-number green">
                            3
                        </div>
                        <div class="stat-title">
                            Курса пройдено
                        </div>
                    </div>
                    <div class="cont-butt">
                        <button onclick="window.location.href='/catalog/'" class="btn-outline" type="button">
                            Программы обучения
                        </button>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-number grey">
                            0
                        </div>
                        <div class="stat-title">
                            Программ пройдено
                        </div>
                    </div>
                    <div class="cont-butt">
                        <button onclick="window.location.href='/catalog/complex/'" class="btn-outline" type="button">Программы обучения</button>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-number green">
                            1
                        </div>
                        <div class="stat-title">
                            Сертификация пройдена
                        </div>
                    </div>
                    <button onclick="window.location.href='/sertifikatsiya/'" class="btn-outline" type="button"> <span class="btn-text">Мои сертификаты</span> </button>
                </div>
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-number green">
                            <?= $arResult['CURRENT_BALANCE']?>
                        </div>
                        <div class="stat-cont-balance">
                        <div class="stat-title">
                            Баллов на счёте
                        </div>
                        <div class="balance-title">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.5015 7C17.0015 10 16.0015 12 14.4415 12.51C14.9166 8.61202 13.9683 3.66937 9.91149 2C10.6215 3.5 11.0015 5.5 7.24149 7.8C1.17412 11.5114 2.86426 20.5214 10.6215 22C7.91716 20.1536 9.55562 16.1317 11.0015 14C11.0015 16.4839 16.5015 18.5 13.4215 22C21.0015 20 22.0015 10.5 15.5015 7Z" fill="#BF031B"/>
                            </svg>

                            <div class="balance-text">
                                <?php
                                $balance = number_format($arResult['BURN_INFO']['amount'], 0, '.', ' ');
                                $burnAmount = number_format($arResult['BURN_INFO']['amount'], 0, '.', ' ');

                                $burnTimestamp = $arResult['BURN_INFO']['timestamp'];
                                $currentTimestamp = time();
                                $daysLeft = ceil(($burnTimestamp - $currentTimestamp) / (60 * 60 * 24));

                                if ($daysLeft > 0) {
                                    echo $balance . ' Б сгорят через ' . $daysLeft . ' дней <a href="/personal/bonus/" class="burn-link">Как потратить</a>';
                                } else {
                                    echo $balance . ' Баллов на счёте';
                                }
                                ?>
                            </div>
                        </div>
                        </div>
                    </div>
                    <button onclick="window.location.href='/catalog/'" class="btn-outline" type="button"> <span class="btn-text">Мои баллы</span> </button>
                </div>
            </div>
        </div>
        <div class="recommended-courses-section">
            <div class="lk-header-top">
                <h2 class="lk-section__title">Рекомендуемые курсы</h2>
                <div class="adjust-recommendations">
                    <span class="icon-adjust"> <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<circle cx="9" cy="8" r="3" stroke="#2B418B"/>
<line x1="21" y1="8.5" x2="12" y2="8.5" stroke="#2B418B"/>
<line x1="6" y1="8.5" x2="3" y2="8.5" stroke="#2B418B"/>
<circle cx="3" cy="3" r="3" transform="matrix(-1 0 0 1 19 13)" stroke="#2B418B"/>
<line y1="-0.5" x2="10" y2="-0.5" transform="matrix(1 0 0 -1 3 16)" stroke="#2B418B"/>
<line y1="-0.5" x2="2" y2="-0.5" transform="matrix(1 0 0 -1 19 16)" stroke="#2B418B"/>
</svg>
</span> <a href="#" class="link">Настроить рекомендации</a>
                </div>
            </div>
            <div class="courses-grid">
                <?foreach($arResult["ITEMS"] as $arItem):?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div class="course-card" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                        <div class="course-info">
                            <div class="top-row">
                                <span class="course-code">
                                    <?=$arItem["DISPLAY_PROPERTIES"]["course_code"]["DISPLAY_VALUE"]?>
                                </span>
                                <div class="tags">
                                    <span class="tag">Middle</span>
                                    <span class="tag">
                                        <?=$arItem["DISPLAY_PROPERTIES"]["schedule_duration"]["DISPLAY_VALUE"]?> часа
                                    </span>
                                </div>
                            </div>
                            <div class="datetime-row">
                                <div class="date">
                                    <span class="icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect x="3.75" y="3.75" width="16.5" height="16.5" stroke="black" stroke-width="1.5"/>
<line x1="4" y1="8.25" x2="20" y2="8.25" stroke="black" stroke-width="1.5"/>
<rect x="7" y="11" width="2" height="2" fill="black"/>
<rect x="11" y="11" width="2" height="2" fill="black"/>
<rect x="15" y="11" width="2" height="2" fill="black"/>
<rect x="7" y="15" width="2" height="2" fill="black"/>
<rect x="11" y="15" width="2" height="2" fill="black"/>
<rect x="15" y="15" width="2" height="2" fill="black"/>
</svg>
</span>
                                    <?=$arItem["DISPLAY_PROPERTIES"]["startdate"]["DISPLAY_VALUE"]?> — <?=$arItem["DISPLAY_PROPERTIES"]["enddate"]["DISPLAY_VALUE"]?>
                                </div>
                                <div class="time">
                                    <span class="icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<circle cx="12" cy="12" r="9.5" stroke="black"/>
<line x1="11.5" y1="12" x2="11.5" y2="5" stroke="black"/>
<path d="M18 12V13H11V12H18Z" fill="black"/>
</svg>
</span>
                                    <?=$arItem["DISPLAY_PROPERTIES"]["schedule_time"]["DISPLAY_VALUE"]?>
                                </div>
                            </div>
                        </div>
                        <div class="lk-card__title">
                            <?=$arItem["NAME"]?>
                        </div>
                        <?if($arItem["PREVIEW_TEXT"]):?>
                            <p>
                                <?=$arItem["PREVIEW_TEXT"]?>
                            </p>
                        <?endif;?>
                        <div class="trainer">

                            <?php
                            if ($arItem["PROPERTIES"]["teacher"]["VALUE"]):
                                $arFilter = array("IBLOCK_ID" => 56, "ID" => $arItem["PROPERTIES"]["teacher"]["VALUE"]);
                                $arSelect = array("ID", "NAME", "PREVIEW_TEXT", "DETAIL_TEXT", "PREVIEW_PICTURE");
                                $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);

                                if ($teacher = $res->GetNext()):
                                    ?>
                                    <div class="avatar gradient">
                                        <?=mb_substr($teacher["NAME"], 0, 1)?>
                                    </div>
                                    <span>Тренер — <a href="/teachers/<?=$teacher["ID"]?>/"><?=$teacher["NAME"]?></a></span>
                                <?php
                                endif;
                            endif;
                            ?>
                        </div>
                        <div class="description">
                            При разработке программных систем разработчики принимают множество решений...
                        </div>
                        <div class="price-row">
                            <div class="price-block">
                                <?if($arItem["DISPLAY_PROPERTIES"]["schedule_price"]["DISPLAY_VALUE"]):?>
                                    <span class="current-price"><?=number_format($arItem["DISPLAY_PROPERTIES"]["schedule_price"]["DISPLAY_VALUE"], 0, '', ' ')?> ₽</span>
                                <?endif;?>
                            </div>
                            <?if($arItem["PROPERTIES"]["course_sale"]["VALUE"]):?>
                                <span class="badge discount">Скидка</span>
                            <?endif;?>
                        </div>
                        <?if($arItem["DISPLAY_PROPERTIES"]["CAN_BUY"]["VALUE"] == "Да"):?>
                            <button class="btn btn-dark">В корзину</button>
                        <?endif;?>
                    </div>
                <?endforeach;?>
            </div>
            <div class="course-card view-more">
                    <button onclick="window.location.href='/catalog/'" class="btn-view-more" type="button">
                    Смотреть все
                    1 345 курсов
                </button>
            </div>
        </div>
    </div>
</div>
<div id="recommendationModal-custom" class="recommendation-modal" style="display: none;">
    <div class="recommendation-modal-container">
        <div class="recommendation-modal-content">
            <div class="recommendation-modal-close-btn">
                <span class="recommendation-close-icon"></span>
            </div>
            <div class="recommendation-modal-header">
                <h2 class="recommendation-modal-title">Настройка рекомендаций курсов</h2>
            </div>
            <form id="recommendationForm-custom" class="recommendation-form">
                <div class="recommendation-form-section">
                    <div class="recommendation-input-group">
                        <div class="recommendation-input-wrapper">
                            <select id="specialty-custom" name="specialty" class="recommendation-form-input recommendation-select" data-no-jqselect="true">
                                <option value="">Направление</option>
                                <?php foreach ($arResult['MODAL_CATEGORIES'] as $id => $name): ?>
                                    <option value="<?= htmlspecialcharsbx($id) ?>"><?= htmlspecialcharsbx($name) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="recommendation-error-text" style="display: none;"></div>
                        </div>
                    </div>

                    <div class="recommendation-price-range-group">
                        <div class="recommendation-input-wrapper">
                            <input type="number" id="price_from-custom" name="price_from" min="0"
                                   class="recommendation-form-input recommendation-price-input"
                                   placeholder="Цена от"
                                   data-no-jqselect="true">
                            <div class="recommendation-error-text" style="display: none;"></div>
                        </div>

                        <div class="recommendation-range-separator">—</div>

                        <div class="recommendation-input-wrapper">
                            <input type="number" id="price_to-custom" name="price_to" min="0"
                                   class="recommendation-form-input recommendation-price-input"
                                   placeholder="Цена до"
                                   data-no-jqselect="true">
                            <div class="recommendation-error-text" style="display: none;"></div>
                        </div>
                    </div>
                </div>

                <div class="recommendation-modal-actions">
                    <button type="submit" class="recommendation-save-btn">
                        <span class="recommendation-btn-text">Сохранить</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
