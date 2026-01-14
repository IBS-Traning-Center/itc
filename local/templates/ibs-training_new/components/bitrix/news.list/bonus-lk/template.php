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
<div class="lk-layout">
    <div class="lk-layout">
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
            );?>
        </aside>

        <div class="lk-content-main">
            <div class="lk-header">
                <h1 class="lk-header__title">Бонусные баллы</h1>

                <div class="bonus-points-header">
                    <div class="bp-points-info">
                        <div class="bp-current-points">У вас 3000 баллов</div>
                        <div class="bp-warning">
                            <div class="bp-icon-warning">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.5015 7C17.0015 10 16.0015 12 14.4415 12.51C14.9166 8.61202 13.9683 3.66937 9.91149 2C10.6215 3.5 11.0015 5.5 7.24149 7.8C1.17412 11.5114 2.86426 20.5214 10.6215 22C7.91716 20.1536 9.55562 16.1317 11.0015 14C11.0015 16.4839 16.5015 18.5 13.4215 22C21.0015 20 22.0015 10.5 15.5015 7Z" fill="#BF031B"></path>
                                </svg>
                            </div>
                            <div class="bp-warning-text">
                                <div>3 000 баллов сгорят 1 августа в 12:00</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bonus-points-section">
                <div class="bp-main-content">

                    <div class="bp-section-container">
                        <div class="bp-section-header">
                            <h2 class="bp-section-title">Что такое баллы и как их копить</h2>
                            <p class="bp-section-text">
                                Если коротко, то баллы это деньги. 1 балл = 1 рубль. Баллами вы можете оплачивать часть курсов, которые хотите купить. Бонусные баллы начисляются только физическим лицам.
                            </p>
                        </div>

                        <div class="bp-cards-grid">

                            <div class="bp-card">
                                <div class="bp-card-number">1</div>
                                <div class="bp-card-content">
                                    <h3 class="bp-card-title">Рекомендуйте наши курсы</h3>
                                    <p class="bp-card-text">
                                        Если по вашей рекомендации Юридическое или Физическое лицо купит любой курс, то <strong>вы получите 20% баллами</strong> от стоимости купленного курса без НДС<br><br>
                                        Для получения бонусов напишите нам на <a href="mailto:education@ibs.ru">education@ibs.ru</a> и укажите какой курс порекомендовали
                                    </p>
                                </div>
                            </div>

                            <div class="bp-card">
                                <div class="bp-card-number">2</div>
                                <div class="bp-card-content">
                                    <h3 class="bp-card-title">Проходите курсы сами</h3>
                                    <p class="bp-card-text">
                                        Вы получите <strong>5% баллами</strong> от суммы купленного вами курса<br><br>
                                        Баллы начисляются автоматически в течение 20 календарных дней после оплаты курса
                                    </p>
                                </div>
                            </div>

                            <div class="bp-card">
                                <div class="bp-card-number">3</div>
                                <div class="bp-card-content">
                                    <h3 class="bp-card-title">1000 баллов за 1 отзыв</h3>
                                    <p class="bp-card-text">
                                        Оставляйте отзывы на наши услуги и курсы на TutorTop. Отзывы, <a href="https://irrecommed.yandex.ru/" target="_blank">Irrecommed. Яндекс.</a> и в соцсетях — получайте <strong>1000 баллов за каждый отзыв</strong> на оплату следующий услуги
                                    </p>
                                </div>
                            </div>

                            <div class="bp-card">
                                <div class="bp-card-number">4</div>
                                <div class="bp-card-content">
                                    <h3 class="bp-card-title">500 баллов за регистрацию</h3>
                                    <p class="bp-card-text">
                                        Для новых клиентов физлиц — приветственный бонус <strong>500 баллов</strong> при регистрации
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bp-section-container">
                        <div class="bp-section-header">
                            <h2 class="bp-section-title">Как тратить баллы</h2>
                            <p class="bp-section-text">
                                При покупке курса вы можете оплатить до 90% его стоимости накопленными баллами. Баллы, которые не были потрачены в течение года после получения, сгорают. Мы напомним за 3 месяца и за 1 месяц о скором сгорании баллов.<br><br>
                                Минимальная стоимость счета к оплате не менее 2000 рублей (от стоимости курса без НДС). Не распространяется на курсы в самостоятельном формате (с кодом SELF).<br><br>
                                Если с учетом применения бонусов стоимость курса оказывается меньше 2000 рублей, то оставшиеся бонусы переходят на покупку следующего курса.<br><br>
                                Баллы суммируются со скидкой для физлиц 10%. Баллы сохраняются в течение 1 года с момента начала последнего обучения.
                            </p>
                        </div>
                    </div>

                    <div class="bp-section-container">
                        <div class="bp-section-header">
                            <h2 class="bp-section-title">История начисления и списания баллов</h2>
                        </div>

                        <div class="bp-history-container">
                            <div class="bp-history-item">
                                <div class="bp-history-date">1 июля 2024</div>
                                <div class="bp-history-text">Начислено 30 баллов за покупку курса <a href="https://irrecommed.yandex.ru/" target="_blank">«Шаблоны проектирования GoF. Редакция для .NET»</a></div>
                            </div>

                            <div class="bp-history-item">
                                <div class="bp-history-date">1 июля 2024</div>
                                <div class="bp-history-text">Списанно 30 баллов на оплату курса <a href="https://irrecommed.yandex.ru/" target="_blank">«Шаблоны проектирования GoF. Редакция для .NET»</a></div>
                            </div>

                            <div class="bp-history-item">
                                <div class="bp-history-date">1 июля 2024</div>
                                <div class="bp-history-text">Списанно 30 баллов по истечению срока действия</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>