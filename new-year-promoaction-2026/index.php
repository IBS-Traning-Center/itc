<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
/**
 * @var $APPLICATION ;
 */
$APPLICATION->SetPageProperty("DONT_SHOW_PAGE_TOP", "Y");
$APPLICATION->SetTitle("Новогодняя ярмарка ИТ-мастеров"); ?>
<div class="banner">
    <div class="banner__view">
        <div class="banner__info">
            <div class="banner__title section-box__title">
                <b>Новогодняя ярмарка ИТ-мастеров</b>
            </div>
            <div class="banner__description">
                Добро пожаловать на праздничную ярмарку!<br>
                Загляните в каждую лавку — там вас ждут тёплые пожелания и первые подсказки.
                Найдите все секретные слова на страницах сайта, соберите из них волшебную фразу и получите двойной подарок: курс «Техники управления временем» + скидку 30% на любой курс из расписания!<br>
                Удачи в поисках!
            </div>
            <div class="banner__mobile-text">Нажимай на сооружения для выбора</div>
        </div>
        <img src="Artboard.jpg" class="banner__image">
        <img src="Artboard_mobile.jpg" class="banner__image _mobile">
        <?include ('svg_mobile.php')?>
        <?include ('svg.php')?>
        <div class="promo-modal" id="promo-modal-1">
            <div class="promo-modal__box">
                <div class="promo-modal__close"></div>
                <div class="promo-modal__title"><a href="/catalog/direction/razrabotka_po_java/">Кафе «Андеграунд Апплетов»</a></div>
                <div class="promo-modal__description">Пусть ваши приложения работают стабильнее JVM на Solaris, а новые фреймворки приносят только радость. Желаем JIT-овой оптимизации во всех начинаниях!</div>
            </div>
        </div>
        <div class="promo-modal" id="promo-modal-2">
            <div class="promo-modal__box">
                <div class="promo-modal__close"></div>
                <div class="promo-modal__title"><a href="/catalog/direction/razrabotka_po_web/">Студия «Живые Интерфейсы»</a></div>
                <div class="promo-modal__description">Пусть ваши интерфейсы будут интуитивными, а код — чистым. Пусть в новом году каждая ваша страница попадает прямо в сердца пользователей!</div>
            </div>
        </div>
        <div class="promo-modal" id="promo-modal-3">
            <div class="promo-modal__box">
                <div class="promo-modal__close"></div>
                <div class="promo-modal__title"><a href="/catalog/direction/biznes-analiz/">Площадь Переговоров</a></div>
                <div class="promo-modal__description">Желаем, чтобы количество встреч стремилось к MVP, а консенсус находился раньше дедлайна. Лёгких стейкхолдеров и железобетонных аргументов в новом году!</div>
                <div class="promo-modal__promo"><b>Подсказка: BA-PRG-002</b></div>
            </div>
        </div>
        <div class="promo-modal" id="promo-modal-4">
            <div class="promo-modal__box">
                <div class="promo-modal__close"></div>
                <div class="promo-modal__title"><a href="/catalog/direction/AI/">Фабрика Нейронных сетей</a></div>
                <div class="promo-modal__description">Пусть ваши нейросети сходятся быстрее, а loss-функции стремятся к нулю. Желаем в новом году датасетов без шума и моделей, которые генерализуют как надо!</div>
                <div class="promo-modal__promo"><b>Подсказка: AI-008</b></div>
            </div>
        </div>
        <div class="promo-modal" id="promo-modal-5">
            <div class="promo-modal__box">
                <div class="promo-modal__close"></div>
                <div class="promo-modal__title"><a href="/catalog/direction/testirovanie/">Тир «Ловушка для багов»</a></div>
                <div class="promo-modal__description">Желаем, чтобы баги сдавались без боя, а тикетов «Reopened» было ноль! Стабильных билдов, легких автотестов и интересных дефектов!</div>
            </div>
        </div>
        <div class="promo-modal" id="promo-modal-6">
            <div class="promo-modal__box">
                <div class="promo-modal__close"></div>
                <div class="promo-modal__title"><a href="/catalog/direction/arkhitektura-po/">Мастерская «Чертоги и фундаменты»</a></div>
                <div class="promo-modal__description">Пусть ваши фундаменты держат любые нагрузки, а идеи находят понимание у команды и заказчиков. Удачного вам года и решений без техдолга!</div>
                <div class="promo-modal__promo"><b>Подсказка: ARC-001</b></div>
            </div>
        </div>
        <div class="promo-modal" id="promo-modal-7">
            <div class="promo-modal__box">
                <div class="promo-modal__close"></div>
                <div class="promo-modal__title"><a href="/catalog/direction/sovremennye-metody-upravleniya-dannymi-bigdata-ml/">Архив и хранилище</a></div>
                <div class="promo-modal__description">Желаем, чтобы миграции проходили гладко, а индексы всегда попадали в цель. Мощных кластеров и предсказуемых нагрузок в новом году!</div>
            </div>
        </div>
        <div class="promo-modal" id="promo-modal-8">
            <div class="promo-modal__box">
                <div class="promo-modal__close"></div>
                <div class="promo-modal__title"><a href="/catalog/direction/sistemnyy-analiz/">Ателье «Ясные мысли»</a></div>
                <div class="promo-modal__description">Желаем, чтобы даже самый сложный процесс раскладывался по полочкам, а ваши диаграммы понимали с первого взгляда. Чистых вам спецификаций и спокойного года!</div>
                <div class="promo-modal__promo"><b>Подсказка: REQ-070</b></div>
            </div>
        </div>
        <div class="promo-modal" id="promo-modal-9">
            <div class="promo-modal__box">
                <div class="promo-modal__close"></div>
                <div class="promo-modal__title"><a href="/sertifikatsiya/">Палата мер и весов</a></div>
                <div class="promo-modal__description">Да прибудет с вами сила официальных стандартов, а ваш профессиональный путь будет отмечен крутыми возможностями. Точных целей и безупречных результатов!</div>
                <div class="promo-modal__promo"><b>Подсказка: Сертификация</b></div>
            </div>
        </div>
        <div class="promo-modal" id="promo-modal-10">
            <div class="promo-modal__box">
                <div class="promo-modal__close"></div>
                <div class="promo-modal__title"><a href="/catalog/direction/devops-i-administrirovanie/">Командный центр автоматизации и мониторинга</a></div>
                <div class="promo-modal__description">Чтобы ваши пайплайны работали быстрее мысли, а SLA стремилось к 100%. Пусть новый год принесёт время на прорывные эксперименты, а не на тушение пожаров!</div>
            </div>
        </div>
        <div class="promo-modal" id="promo-modal-11">
            <div class="promo-modal__box">
                <div class="promo-modal__close"></div>
                <div class="promo-modal__title"><a href="/catalog/direction/upravlenie_proektami_razrabotki_po/">Бар «Проектный штаб»</a></div>
                <div class="promo-modal__description">Пусть ваши брифы будут ясными, а команда — сплочённой. Желаем в новом году проектов с отличными бюджетами и клиентами, которые не меняют ТЗ после каждого созвона!</div>
            </div>
        </div>
    </div>
</div>
<p class="banner__after">Знания — это волшебство, которое меняет реальность. На нашей праздничной ярмарке каждая мастерская открывает путь к новым навыкам, а игра помогает найти свой уникальный ключ к успеху.</p>
<div class="person-background">
    <div class="person">
        <div class="image">
            <img src="rules.png" alt="">
        </div>
        <div class="holder">
            <p class="banner__after">Как принять участие и получить подарки:</p>
            <div class="person-background">
                <ul class="promo-modal__list">
                    <li class="promo-modal__item"><b>Найдите подсказки</b>: Исследуйте страницы курсов на нашем сайте и соберите 5 секретных слов.</li>
                    <li class="promo-modal__item"><b>Соберите фразу</b>: Составьте из найденных слов фразу-ключ.</li>
                    <li class="promo-modal__item"><b>Отправьте</b>: Введите полученную фразу в форму ниже и отправьте заявку.</li>
                    <li class="promo-modal__item"><b>Получите</b>: В ответном письме мы пришлем вам доступ к self-курсу «Техники управления временем», а также персональный промокод на скидку 30% на любой курс из расписания.</li>
                </ul>
            </div>
            <p class="banner__after">Условия акции:</p>
            <div class="holder">
                <ul class="promo-modal__list">
                    <li class="promo-modal__item">Акция действует с 10 декабря 2025 года по 31 января 2026 года включительно.</li>
                    <li class="promo-modal__item">Доступ к self-курсу «Техники управления временем» предоставляется на 3 месяца.</li>
                    <li class="promo-modal__item">Скидка активируется персональным промокодом, который необходимо применить при оформлении заявки на курс на сайте <a href="https://ibs-training.ru/">ibs-training.ru</a>.</li>
                    <li class="promo-modal__item">Промокод действует на бронирование любого курса из расписания с 15.12.2025 до 31.03.2026. Срок действия промокода истекает 31.01.2026.</li>
                    <li class="promo-modal__item">Скидка действует на новые заявки от физических лиц и не суммируется с другими акциями.</li>
                    <li class="promo-modal__item">Корпоративные клиенты могут получить скидку, обратившись к своему персональному менеджеру.</li>
                    <li class="promo-modal__item">Заявку можно подать не позднее чем за 2 недели до начала обучения. Учебный центр оставляет за собой право в одностороннем порядке изменить даты проведения курса.</li>
                    <li class="promo-modal__item">Количество мест в группах ограничено.</li>
                    <li class="promo-modal__item">Все вопросы по участию в акции можно задать по email: <a href="mailto:<?=EMAIL_ADDRESS?>"><?=EMAIL_ADDRESS?></a>.</li>
                </ul>
            </div>
            <p class="banner__after">Действуйте, мастера!<br>Ваши новые горизонты уже ждут.</p>
        </div>
    </div>
</div>
<style>
    #obj-1, [data-name='obj-1'],
    #obj-2, [data-name='obj-2'],
    #obj-3, [data-name='obj-3'],
    #obj-4, [data-name='obj-4'],
    #obj-5, [data-name='obj-5'],
    #obj-6, [data-name='obj-6'],
    #obj-7, [data-name='obj-7'],
    #obj-8, [data-name='obj-8'],
    #obj-9, [data-name='obj-9'],
    #obj-10, [data-name='obj-10'],
    #obj-11  [data-name='obj-11'] {
        cursor:pointer;
    }

    #obj-1,#obj-2,#obj-3,#obj-4,#obj-5,#obj-6,#obj-7,#obj-8,#obj-9,#obj-10,#obj-11,
    [data-name='obj-1'], [data-name='obj-2'], [data-name='obj-3'], [data-name='obj-4'], [data-name='obj-5'], [data-name='obj-6'], [data-name='obj-7'], [data-name='obj-8'], [data-name='obj-9'], [data-name='obj-10'], [data-name='obj-11'] {
        transition: 0.3s;
        opacity: 0;
    }
    #shadow {
        transition: 0.3s;
        opacity: 0;
    }

    .promo-modal {
        position: absolute;
        opacity: 0;
        visibility: hidden;
        transition: 0.3s;
        padding: 3%;
        padding-right: 0;
        box-sizing: content-box;
        z-index: 9;
    }
    .promo-modal.visibility {
        opacity: 1;
        visibility: visible;
        transition: 0.3s;
    }

    .promo-modal__box {
        max-width: 640px;
        border-radius: 40px;
        border: 2px solid #ff8611;
        background: #fff;
        padding: 3% 6%;
        z-index: 999;
    }

    .promo-modal__title {
        font-size: 24px;
        margin-bottom: 16px;
        font-weight: 700;
        opacity: 0.85;
        text-align: center;
        color: #f26f21;
    }
    .promo-modal__description {
        font-size: 16px;
        color: #1c427a;
        margin-bottom: 16px;
        line-height: 1.2;
    }
    .promo-modal__item {
        position: relative;
        padding-left: 8px;
        margin-bottom: 8px;
        font-size: 16px;
    }
    .promo-modal__item:before {
        content: '';
        display: block;
        width: 4px;
        height: 4px;
        border-radius: 50%;
        background: #f26f21;
        position: absolute;
        left: 0;
        top: 50%;
        margin-top: -2px;
    }

    .promo-modal__item:last-of-type {
        margin-bottom: 16px;
    }

    .promo-modal__item b {
        color: #ff8611;
        font-weight: 600;
    }

    .promo-modal__promo {
        display: block;
        color: #ff8611;
        cursor: pointer;
        text-align: center;
    }
    .promo-modal__promo b {
        font-weight: 700;
        font-size: 20px;
    }

    #promo-modal-1 {
        top: 50%;
        left: 43%;
        width: 27%;
    }

    #promo-modal-2 {
        top: 50%;
        left: 26%;
        width: 24%;
    }

    #promo-modal-3 {
        top: 52%;
        left: 23.6%;
        width: 26%;
        padding-left: 0;
        padding-bottom: 3%;
    }

    #promo-modal-4 {
        top: 35%;
        left: 27%;
        width: 30%;
        padding-left: 0;
        padding-right: 3%;
    }

    #promo-modal-5 {
        top: 52%;
        left: 29.5%;
        width: 30%;
        padding-left: 0;
        padding-right: 3%;
    }

    #promo-modal-6 {
        top: 44%;
        left: 14.5%;
        width: 30%;
        padding-left: 0;
        padding-right: 3%;
    }

    #promo-modal-7 {
        top: 55%;
        left: 61%;
        width: 28%;
        padding-left: 0;
        padding-right: 3%;
    }

    #promo-modal-8 {
        top: 52%;
        left: 18%;
        width: 32%;
    }

    #promo-modal-9 {
        top: 52%;
        left: 51.5%;
        width: 30%;
        padding-left: 0;
        padding-right: 3%;
    }

    #promo-modal-10 {
        top: 50%;
        left: 42%;
        width: 27%;
        padding-right: 3%;
        padding-left: 0;
    }

    #promo-modal-11 {
        top: 56%;
        left: 20.5%;
        width: 32%;
        padding-left: 0;
        padding-right: 3%;
    }

    .banner {
        position: relative;
    }

    .banner__view > svg {
        position: absolute;
        top: 0;
        left: 0;
        transform: translateY(-36%);
        margin-bottom: -33.2%;
        z-index: 9;
    }

    .banner__info {
        width: 100%;
        position: absolute;
        height: 100%;
        top: 0;
        left: 0;
        text-align: center;
        color: #fff;
        z-index: 9;
    }

    .banner__title {
        font-size: 56px;
        color: #fff;
        padding: 42px 0;
    }
    .banner__description {
        font-size: 25px;
        line-height: 1.4;
        max-width: 1220px;
        margin: 0 auto 32px;
    }

    .banner__view {
        overflow: hidden;
    }

    .banner__image {
        display: block;
        width: 100%;
        max-width: 100%;
        margin: 0 auto;
        transform: translateY(-36%);
        margin-bottom: -33.2%;
    }

    .banner__after {
        width: 85%;
        font-size: 40px;
        text-align: center;
        padding: 26px 0;
        color: #1c427a;
        margin: 0 auto;
    }
    .banner__mobile-text {
        display: none;
    }

    .person-background {
        padding: 0 0 36px 0;
        width: 100%;
        background: url(bg-b.png) no-repeat 0 100%;
    }

    .person {
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 85%;
        flex-direction: row;
    }

    .holder {
        line-height: 1.6;
        font-size: 20px;
    }

    .person {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .person .image {
        border-radius: 50%;
        margin: 0 70px 0 0;
    }

    .person .image img {
        width: auto;
        height: auto;
        max-width: 280px;
        max-height: 100%;
        display: block;
        padding-right: 30px;
    }

    .person p {
        margin: 0 0 10px;
        display: block;
    }

    ._mobile {
        display: none;
    }
    .promo-modal__close {
        display: none;
    }

    .holder .promo-modal__item:before {
        top: 10px;
        margin-top: 0;
        left: -5px;
    }

    @media (max-width: 1679px) {
        .banner__title {
            font-size: 48px;
        }
        .banner__description {
            font-size: 32px;
        }
        .banner__image {
            transform: translateY(-32%);
            margin-bottom: -33.2%;
        }
        .banner__view > svg {
            transform: translateY(-32%);
            margin-bottom: -33.2%;
        }
        #promo-modal-1 {
            top: 46%;
            left: 43%;
            width: 43%;
        }
        #promo-modal-2 {
            top: 46%;
            left: 26%;
            width: 38%;
        }
        #promo-modal-3 {
            top: 48%;
            left: 16%;
            width: 40%;
            padding-left: 0;
            padding-bottom: 3%;
        }
        #promo-modal-4 {
            top: 37%;
            left: 15%;
            width: 42%;
            padding-left: 0;
            padding-right: 3%;
        }
        #promo-modal-5 {
            top: 50%;
            left: 19.5%;
            width: 40%;
            padding-left: 0;
            padding-right: 3%;
        }
        #promo-modal-6 {
            top: 45%;
            left: 3.5%;
            width: 41%;
            padding-left: 0;
            padding-right: 3%;
        }
        #promo-modal-7 {
            top: 55%;
            left: 48%;
            width: 41%;
            padding-left: 0;
            padding-right: 3%;
        }
        #promo-modal-8 {
            top: 53%;
            left: 18%;
            width: 48%;
        }
        #promo-modal-9 {
            top: 52%;
            left: 34%;
            width: 48%;
            padding-left: 0;
            padding-right: 3%;
        }
        #promo-modal-10 {
            top: 47%;
            left: 20.5%;
            width: 48%;
            padding-right: 3%;
            padding-left: 0;
        }
        #promo-modal-11 {
            top: 56%;
            left: 4.5%;
            width: 48%;
            padding-left: 0;
            padding-right: 3%;
        }
    }
    @media (max-width: 1023px) {
        .banner__view > svg,
        .banner__image {
            display: none;
        }
        .banner__view > svg._mobile,
        .banner__image._mobile {
            display: block;
        }
        .banner__title {}
        .banner__description {}
        .banner__mobile-text {
            font-size: 16px;
            display: block;
        }
    }
    @media (max-width: 767px) {
        .search {
            height: 156px;
        }
        .person {
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .banner__title {
            font-size: 26px;
            padding: 16px 0;
        }
        .banner__description {
            font-size: 16px;
            padding: 0 16px 0;
        }
        .banner__image {
            margin-bottom: -55.2%;
        }

        .person .image {
            margin-right: 0;
        }
        .person .image img {
            max-width: ;
            padding-right: 0;
        }

        .promo-modal {
            top: 34%!important;
            left: 3%!important;
            right: 3%!important;
            width: 94%!important;
            padding-left: 0!important;
            padding-right: 0!important;
        }
        .promo-modal__close {
            display: block;
            position: absolute;
            top: 0;
            right: 0;
            width: 46px;
            height: 40px;
            background: #f26f21 url(close.svg) 52% 46% / auto 36% no-repeat;
            z-index: 9;
            border-radius: 0 0 0 26px;
        }
        .promo-modal__box {
            overflow: hidden;
            position: relative;
            border-radius: 26px;
            padding: 3% 9% 3% 3%;
        }
        .promo-modal__title {
            font-size: 20px;
            text-align: left;
        }
        .banner__after {
            width: 100%;
            font-size: 22px;
            padding: 16px;
        }
        .person .image {
            margin-bottom: 24px;
            padding: 24px 0;
        }
        .person .image img {
            width: 100%;
            max-width: 160px;
        }
        .holder {
            font-size: 14px;
        }
    }
</style>
<script>
    var $target = null
    $('#obj-1,#obj-2,#obj-3,#obj-4,#obj-5,#obj-6,#obj-7,#obj-8,#obj-9,#obj-10,#obj-11,#shadow').hover(
        function (e) {
            e.stopPropagation()

            if($target != null && $target.data('id') !== $(this).attr('id')) {
                var idModal = $target.data('id');
                $('#' + idModal).removeClass('visibility')
                $target.css('opacity', '0');
                $('#shadow').css('opacity', '0');
            }
            if($(this).attr('id') !== 'shadow') {
                $target = $(this);
                e.stopPropagation();
                var idModal = $(this).data('id');
                $('#' + idModal).addClass('visibility')
                $(this).css('opacity', '1');
                $('#shadow').css('opacity', '1');
            }
        },
        function (e) {
            e.stopPropagation();
            if($(this).data('id') !== $(e.toElement).attr('id')) {
                var idModal = $target.data('id');
                $('#' + idModal).removeClass('visibility')
                $target.css('opacity', '0');
                $('#shadow').css('opacity', '0');
            }
        }
    );
    $('[data-name="obj-1"],[data-name="obj-2"],[data-name="obj-3"],[data-name="obj-4"],[data-name="obj-5"],[data-name="obj-6"],[data-name="obj-7"],[data-name="obj-8"],[data-name="obj-9"],[data-name="obj-10"],[data-name="obj-11"]').on('click', function (e) {
        e.stopPropagation();
        var idModal = $(this).data('id');
        $('#' + idModal).addClass('visibility')
        $(this).css('opacity', '1');
    })
    $('.promo-modal__close').on('click', function () {
        var idModal = $(this).closest('.promo-modal').attr('id');
        $(this).closest('.promo-modal').removeClass('visibility');
        $('[data-id='+idModal+']').css('opacity', '0');
    })
</script>
    <?php $APPLICATION->IncludeComponent(
        "bitrix:form.result.new",
        "main.feedback",
        array(
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
            "VARIABLE_ALIASES" => array("RESULT_ID" => "RESULT_ID", "WEB_FORM_ID" => "WEB_FORM_ID"),
                "WEB_FORM_ID" => "53",
                "MAGNET_LEAD_NAME" => 'Лид. Новогодняя ярмарка ИТ-специалистов',
                "MAGNET_CODE" => '702051',
        )
    ); ?>
<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>