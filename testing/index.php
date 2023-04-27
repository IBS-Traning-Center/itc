<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Тестирование сотрудников IT-подразделения");
?>
<div class="bg-main-wrap" style="background: url('/static/images/test-bg.jpg') center; background-size: cover;">
<div class="frame">
    <? $APPLICATION->IncludeComponent(
        "bitrix:breadcrumb",
        "bread",
        array(
            "START_FROM" => "0",
            "PATH" => "",
            "SITE_ID" => "s1"
        )
    ); ?>
    <div class="clearfix heading-white">
        <h1>Разработка тестов для IT-специалистов по<br>
            ключевым компетенциям</h1>
    </div>
    <div class="heading-text">
        Довольно часто перед HR-подразделением ставится непростая, но важная и необходимая для роста компании задача
        – тестирование сотрудников IT-департамента с целью оценки их знаний на соответствие занимаемой должности. В
        IT-отрасли множество направлений: архитекторы ПО, разработчики, специалисты по тестированию ПО, системные и
        бизнес-аналитики, системные и сетевые администраторы, менеджеры проектов и многие другие.<br>
        Существует множество нюансов для каждой из ролей исходя из отрасли вашего бизнеса. IBS Training Center
        предлагает&nbsp;воспользоваться нашим опытом и знаниями, а также многолетней экспертизой в области
        разработки ПО для подготовки специальных тестов для IT-подразделения вашей компании.
    </div>
</div>
</div>
<div class="bg not-main-page gray" id="content">
    <div class="frame">
        <div class="testing-header">
            Когда нужна оценка персонала?
        </div>
        <div class="row testing">
            <div class="small-2">
                <ul>
                    <li>найм сотрудника</li>
                    <li>продвижение на новую должность</li>
                    <li>создание программ развития и обучения</li>
                </ul>
            </div>
            <div class="small-2">
                <ul>
                    <li>отбор в кадровый резерв</li>
                    <li>проверка соответствия сотрудника занимаемой должности</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="bg-main-wrap" id="content-2" style="background: url('/static/images/bg-test.jpg') center;">
    <div class="frame">
        <div class="exp-heading">
            Экспертиза IBS Training Center в области разработки тестов –&nbsp;это:
        </div>
        <div class="row testing-exp">
            <div class="small-2">
                <ul>
                    <li class="icon-1">Собственная методика по созданию тестов для <br>
                        оценки различных компетенций и ролей
                    </li>
                    <li class="icon-2">Сотрудничество на постоянной основе с <br>
                        лучшими экспертами компании&nbsp;и <br>
                        внешними специалистами
                    </li>
                    <li class="icon-3">Разработка тестов с учетом специфики вашей <br>
                        компании
                    </li>
                </ul>
            </div>
            <div class="small-2">
                <div class="big-block">
                    <div class="number">
                        8 000
                    </div>
                    ПРОТЕСТИРОВАННЫХ СОТРУДНИКОВ
                </div>
                <div class="big-block">
                    <div class="number">
                        170+&nbsp;
                    </div>
                    РАЗРАБОТАННЫХ ТЕСТОВ
                </div>
            </div>
        </div>
    </div>
</div>
<div class="not-main-page gray overflow-hidden" id="content-3">
    <div class="frame padding-bottom">
        <div class="exp-heading">
            Схема процесса разработки профессиональных тестов
        </div>
        <div class="test-proccess">
        </div>
        <a class="video-play"
           style="margin-top: 40px; font-size: 20px; text-decoration: none; border-bottom: 1px dashed; line-height: 1.3;"
           href="https://www.youtube.com/embed/64Jtjpyly5I" data-id="gallery">Посмотреть видео о процессе разработки
            кастомизированных тестов</a>
    </div>
    <script type="text/javascript">
        $('document').ready(function () {
            $('.video-play').fancybox({'type': 'iframe', "allowfullscreen": "true", "width": 900, "height": 620});
        })
    </script>
</div>
<? /*
<div id="ready" class="bg-main-wrap" style="background: url('/static/images/bg-test.jpg') center;">
<div class="frame">
    <div class="exp-heading big">
         Готовые тесты
    </div>
    <div class="tests-list">
        <div class="test-title-roles">
             Роли
        </div>
<a class="link-test-to" target="_blank" href="/land-new/?ROLES[]=223#tests">Аналитик в ИТ</a> <a class="link-test-to" target="_blank" href="/land-new/?ROLES[]=235#tests">Java-разработчик</a> <a class="link-test-to" target="_blank" href="/land-new/?ROLES[]=234#tests">Программист</a> <a class="link-test-to" target="_blank" href="/babok-testing/">Бизнес-аналитик (BABOK)</a>
    </div>
</div>
</div>
*/
?>
<div class="not-main-page gray overflow-hidden">
    <div class="frame padding-bottom">
        <div class="videoWrapper">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/SuLpIvHKyAs" frameborder="0"
                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen="">
            </iframe>
        </div>
    </div>
    <div class="frame padding-bottom">
        <div class="course-main-info">
            <h2 id="auditory">Примеры разработанных тестов</h2>
            <h3>Тесты по языкам программирования / инструментам разработки</h3>
            <ul>
                <li>Java, JavaScript, Scala, ASP.Net, C/C++, C#, SQL, PL/SQL, Teradata, XML, Android, IOS, Windows
                    Phone, Hadoop, Spark, Python, IBM WebSphere, SAS, ABAP и др.
                </li>
            </ul>
            <h3>Тесты по ролям</h3>
            <ul>
                <li>ИТ-аналитики</li>
                <li>Бизнес-аналитики</li>
                <li>Архитекторы ПО</li>
                <li>Разработчики</li>
                <li>Линейные руководители</li>
                <li>Тестировщики (автоматизированное, ручное, нагрузочное тестирование)</li>
                <li>Администраторы (ОС Windows, Unix/Linux, баз данных, тестовых сред, серверов приложений)</li>
                <li>Инженеры технической поддержки</li>
                <li>Технические писатели</li>
                <li>Специалисты по информационной безопасности</li>
                <li>Эксперты по технологиям финансовых рынков</li>
                <li>Методологи</li>
                <li>Процессные инженеры</li>
                <li>и др.</li>
            </ul>
            <h3>Тесты на знание</h3>
            <ul>
                <li>Предметных областей в банковской и инвестиционных сферах</li>
                <li>Русского языка</li>
                <li>Английского языка для ИТ-специалистов</li>
            </ul>
        </div>
    </div>
</div>
<div class="bg-main-wrap" style="background: url('/static/images/testing-big.jpg') center; background-size: cover;">
    <div class="frame">
        <div class="row">
            <div class="medium-2 price-information padding-bottom">
                <? /*<div class="price-heading">
                 Стоимость
            </div>
             Стоимость разработки одного теста - от<br>
            <div class="price">
                 95 000 <span class="rouble-sign">1</span>
            </div>
<span class="no-nds">(без НДС)</span><br>
             Стоимость рассчитывается в зависимости от сроков разработки, количества компетенций и вопросов в каждом блоке. Для расчета свяжитесь, пожалуйста, с менеджером учебного центра:<br>
            <?*/ ?>
                <div class="map-info">
                    <div class="email">
                        <h3>Электронный адрес</h3>
                        <a href="mailto:<?= EMAIL_ADDRESS ?>"><?= EMAIL_ADDRESS ?></a>
                    </div>
                    <div class="phones">
                        <h3>Телефоны</h3>
                        <a href="tel:+7 (495) 609-6967">+7 (495) 609-6967</a>
                    </div>
                </div>
                <div class="price-heading">
                    Сроки
                </div>
                Средний срок выполнения работ – 2–4 месяца в зависимости от количества ролей, компетенций и
                потенциально возможного количества планируемых встреч с рабочими группами заказчика.
            </div>
            <? //if ($_REQUEST["WEB_FORM_ID"]=="15" && $_REQUEST["formresult"]=="addok") { LocalRedirect('/upload/Testirovenie_it_podrazdeleniya.pdf');}?>
            <div class="medium-2 padding-bottom">
                <div class="form-reg" id="register-test">
                    <h4>Узнать стоимость разработки теста</h4>
                    <div class="label-gray-12">
                        Для расчета стоимости разработки тестов, пожалуйста, оставьте свои контакты. Менеджер
                        учебного центра свяжется с вами и ответит на ваши вопросы, связанные с тестированием
                        сотрудников ИТ-подразделения.
                    </div>
                    <? $APPLICATION->IncludeComponent(
                        "luxoft:form.result.new.nospam",
                        "test-send",
                        array(
                            "WEB_FORM_ID" => "15",
                            "IGNORE_CUSTOM_TEMPLATE" => "Y",
                            "USE_EXTENDED_ERRORS" => "Y",
                            "SEF_MODE" => "N",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "3600",
                            "LIST_URL" => "",
                            "EDIT_URL" => "",
                            "SUCCESS_URL" => "",
                            "CHAIN_ITEM_TEXT" => "",
                            "CHAIN_ITEM_LINK" => "",
                            "VARIABLE_ALIASES" => array("WEB_FORM_ID" => "WEB_FORM_ID", "RESULT_ID" => "RESULT_ID",)
                        )
                    ); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>